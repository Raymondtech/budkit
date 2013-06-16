<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * timeline.php
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
 * Timeline action controller 
 *
 * This class implements the action controller for displaying media streams.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Timeline extends System\Media {

    
    public function __construct() {
        parent::__construct();       
        $this->output->setPageTitle(_("Timeline"));
    }
    /**
     * The timeline stream
     * 
     * @return type
     */
    public function stream() {
        return $this->index();
    }

    /**
     * Creates a new media in the defined timeline. 
     * @return  \Platform\Controller::returnRequest()
     */
    public function create() {

        //Is the user authenticated?
        $this->requireAuthentication();
        //Is the input method submitted via POST;

        if ($this->input->methodIs("post")) {
            $model = $this->load->model("media");
            //@1 Check where the form is comming from
            //@2 Validate the user permission
            //@3 Privacy settings, If posting to wall can the user post to the wall
            //@4 Add the post;
            if (!$model->addMedia()) {
                $this->alert(_("Could not add your post"), null, "error");
            } else {
                $mediaURI = $model->getLastSavedObjectURI();
                $mediaURL = \Library\Uri::internal("/system/media/timeline/view/$mediaURI");
                $this->alert(sprintf(_("Your post has been saved and publised. <a href=\"%s\">View Post</a>"), $mediaURL), null, "success");
            }
        }
        //Returns the request back tot the reffer;
        $this->returnRequest();
    }

    /**
     * Displays a media Item.
     * 
     * @todo    Implement the collection read action method
     * @return  void
     */
    public function view($itemURI = null, $type="media") {
        //Throws an error if no collectionId is passed
        $_model = ($type=="attachment")? "attachments" : $type;
        //Loads the collectionItem from the databse
        $model = $this->load->model($_model);
        $collection = $model->getMedia($type, $itemURI);
        //Set the photo display properties     
        
        //static::canAccess( $itemURI );
        
        //print_R($_SESSION);
        
        $first = reset($collection['items']);
        $this->set("activities", $collection);

        if (!isset($first['summary']) || empty($first['summary'])):
            $now = \Library\Date\Time::stamp();
            $time = \Library\Date\Time::difference(strtotime($first['published']), strtotime($now));
            $title = sprintf("%s by %s", $time, $first['actor']['displayName']);
        else:
            $title = $first['summary'];
        endif;
        
        $this->output->setPageTitle($title);
        
        //If commentcount is greater than 1
        $mediaModel = $this->load->model("media", 'system');
        $comments = $mediaModel->setListLookUpConditions("media_target", $itemURI)->getAll();

        $this->set("comments", $comments);
        $this->set("comment_target", $itemURI);
        $format = $this->router->getFormat();
        if($type==="attachment"):
            switch ($format):
                case "raw":
                    $mediaObject = $this->output->layout("media/photos/photo");
                    //Add the collection to the placeholder image;
                    $this->output->addToPosition("placeholder", $mediaObject); //Add the collection to the placeholder
                    //Raw displays whatever is in the body block only; 
                    $slide = $this->output->layout("media/slider");
                    $this->output->addToPosition("body", $slide);
                    break;
                default:
                    $attachments = $this->load->controller("media\\attachments", "system");
                    return $attachments->gallery();
                    break;
            endswitch;
        endif;
        
        return $this->index();
    }

    /**
     * Lists all published activities within this timeline;
     * @return void; 
     */
    public function index( $display = true) {
        
        //$_SESSION['somevalue'] = 'This is a value';
        //Get the view;
        $view = $this->load->view('index');
        $user = \Platform\User::getInstance();
        $model = $this->load->model('media');

        $activities = $model->setListLookUpConditions("media_target", "")->getAll();
        $model->setPagination(); //Set the pagination vars

        $this->set("timeline", $activities);
        //$this->set("user", $user);

        $view->editor();//Generate the forms;
        $timeline = $this->output->layout("timeline");
        //$timelineside = $this->output->layout("timelinenotes");

        $this->output->addToPosition("dashboard", $timeline);
        //$this->output->addToPosition("aside", $timelineside );
        if($display) $view->display(); //sample call;        
        //$this->output();
    }

    /**
     * Deletes an media from the timeline;
     * @return Timeline::read();
     */
    public function delete() {
        $this->alert(_("Could not delete your post."), _("There seems to be a problem with authenticating this session"), "error");
        return $this->index();
    }

    /**
     * Gets an instance of the timeline controller
     * @staticvar self $instance
     * @return Timeline 
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

