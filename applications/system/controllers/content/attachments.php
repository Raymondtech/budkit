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
namespace Application\System\Controllers\Content;
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
class Attachments extends System\Content {

    /**
     * The default fallback method. 
     * Displays the global system attachment uploader 
     * @return Attachments::upload()
     */
    public function index() {
        return $this->upload();
    }
    /**
     * Displays the global system attachment uploader form 
     * @todo    Complete the implementation of the global file upload action
     * @return  void;
     */
    final public function upload() {
                
        //If uploading, i.e if post, get files and passto model
         if ($this->input->methodIs("post")) {
             echo 'We are uploading';
         }
        
        //Display the upload form   
        $view = $this->load->view("index");
        //$dashboard  = Controllers\Start\Dashboard::getInstance();
        //$this->output->set("upload", array( "title"=>"Upload Page Title" ));
        echo 'Uploading Content';

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

