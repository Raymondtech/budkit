<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * attachments.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 * 
 */

namespace Application\System\Controllers\Media;

use Application\System\Controllers as System;

/**
 * Attachment management CRUD action controller for system content 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of attachments within various posts/media types.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Attachments extends System\Media {

    /**
     * Displays the global system attachment uploader form 
     * @todo    Complete the implementation of the global file upload action
     * @return  void;
     */
    final public function form() {

        //Display the upload form   
        $view = $this->load->view("index");
        //$dashboard  = Controllers\Start\Dashboard::getInstance();
        //$this->output->set("upload", array( "title"=>"Upload Page Title" ));
        //If uploading, i.e if post, get files and passto model
        if ($this->input->methodIs("post")) {
            echo 'We are uploading';
            $attachment = $this->load->model("attachments");
        }
    }

    final public function create() {

        $params = func_get_args();
        $object = array();
        //Check that form was submitted with the POST method
        if ($this->input->methodIs("post") && isset($params[0])) { //param 0 is the name of the input file field
            $message = "The attachment has been saved successfully";
            $messageType = "success";

            $attachment = $this->load->model("attachments", "system");
            $attachment->setOwnerNameId($this->user->get("user_name_id"));
            $attachmentfile = $this->input->data("files");

            $this->set("uploaded", $attachmentfile);
            $this->set("uploaded-name", $params[0]);

            $attachment->store($attachmentfile[$params[0]]); //Get the first item in the file array;
            //Now store the users photo to the database;
            $attachmentURI = $attachment->getLastSavedObjectURI();
            $attachmentURL = \Library\Uri::internal("/system/object/{$attachmentURI}");

            $object = array(
                "uri" => $attachmentURI,
                "src" => $attachmentURL
            );
            $this->set("object", $object);

            return $this->output->display(); //If we have succesfully uploaded the attachment display
        }

        $this->output->setResponseCode(HTTP_BAD_REQUEST);
        $this->alert("This method accepts only POST data", "HTTP BAD REQUEST", "error");

        return $object;
    }

    public function shared() {
        //List all attachments i don't own that are shared with me
        return $this->gallery();
    }

    /*
     * All system attachments
     * 
     * @return void;
     */

    public function gallery() {

        $this->output->setPageTitle(_("Attachments"));

        $model = $this->load->model("attachments", "system");
        $attachments = $model->setListLookUpConditions("attachment_owner", array($this->user->get("user_name_id")))
                ->setListOrderBy("o.object_created_on", "DESC")
                ->getObjectsList("attachment");
        $model->setPagination(); //Set the pagination vars
        $items = array("totalItems" => 0);
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $attachments->fetchAssoc()) {
            $row['attachment_url'] = "/system/object/{$row['object_uri']}";
            $items["items"][] = $row;
            $items["totalItems"]++;
        }
        if ((int)$items["totalItems"] > 0)
            $this->set("gallery", $items);

        $gallery = $this->output->layout("media/gallery");
        $this->output->addToPosition("dashboard", $gallery);

        $this->load->view("media")->display();
    }

    /**
     * Returns the upload progress
     * Calculates and returns the upload progress
     * 
     * @return void;
     */
    final public function uploadprogress() {

        $params = func_get_args();
        $progress = array();
        //Check that form was submitted with the POST method
        if ($this->input->methodIs("get") && isset($params[0])) {
            $progress["recieved"] = \Library\Session::getUploadProgress($params[0]);
            $progress["prefix"] = ini_get("session.upload_progress.prefix") . $params[0];

            $progress["session"] = $_SESSION;
            $this->set("progress", $progress);

            return $this->output->display(); //Return the uploadprogress;
        }

        $this->output->setResponseCode(HTTP_BAD_REQUEST);
        $this->alert("This method accepts only GET data and one parameter corresponding to the upload form identifier", "HTTP BAD REQUEST", "error");

        return false;
    }

    /**
     * Gets an instance of the command class
     * @staticvar self $instance
     * @return an instance of {@link Attachments}
     * 
     */
    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self;

        return $instance;
    }

}

