<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * photo.php
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
 * Photo CRUD action controller for system media 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of photo.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Photo extends System\Media {

    /**
     * Displays the form required to creates a new photo. 
     * @todo    Implement the create photo action method
     * @return  \Application\System\Views\Media\Photo::createForm()
     */
    public function create() {
        $view = $this->load->view('photo');
        return $view->createform();
    }

    /**
     * Updates an existing photo.
     * @todo    Implement the photo update action method
     * @return  void
     */
    public function update() {
        
    }

    /**
     * Edits an existing photo.
     * @todo    Implement the photo edit action method
     * @return  void
     */
    public function edit() {
        
    }

    /**
     * Displays an collection media.
     * @todo    Implement the collection read action method
     * @return  void
     */
    public function view($photoURI = null) {
        //Throws an error if no collectionId is passed
        //Loads the collectionItem from the databse
        $model = $this->load->model("attachments");
        $attachment = $model->loadObjectByURI($photoURI);
        $item   = $attachment->getPropertyData();
        $item['object_uri'] = $attachment->getObjectURI();
        //Set the photo display properties     
        $this->output->setPageTitle($attachment->getPropertyValue("attachment_title"));
        $this->set("item", $item);
        
        print_R($item);
        
        //Get the format of the item;
        $format = $this->router->getFormat();
        $photo = $this->output->layout("media/photos/photo");

        switch ($format):
            case "raw":
                //Add the collection to the placeholder image;
                $this->output->addToPosition("placeholder", $photo); //Add the collection to the placeholder
                //Raw displays whatever is in the body block only; 
                $slide = $this->output->layout("media/slider");
                $this->output->addToPosition("body", $slide);
                break;
            default:
                //Raw displays whatever is in the body block only; 
                $photo = $this->output->layout("media/item");
                $this->output->addToPosition("body", $photo);
                break;
        endswitch;
        $this->load->view("media")->display();
    }

    /**
     * Displays a gallery of media items. 
     * @return void
     */
    public function gallery() {

        $this->output->setPageTitle(_("Photos"));

        $today = $this->output->layout("media/gallery");
        $this->output->addToPosition("dashboard", $today);


        $this->load->view("media")->display();
    }

    /**
     * Deletes an existing photo.
     * @todo    Implement the photo delete action method
     * @return  void
     */
    public function delete() {
        
    }

    /**
     * Get's an instance of the photo controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Photo}
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
