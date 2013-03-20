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
class Timeline extends System\Media  {

    /**
     * The timeline stream
     * 
     * @return type
     */
    public function stream(){
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
                $this->alert(_("You post has been saved and publised"), null, "success");
            }
        }
        //Returns the request back tot the reffer;
        $this->returnRequest();
    }
    /**
     * Alias for listing all media posts;
     * @return Timeline::stream()
     */
    public function read() {
        return $this->stream();
    }
    /**
     * Lists all published activities within this timeline;
     * @return void; 
     */
    public function index() {       
        $this->output->setPageTitle( _("Timeline") );       
        //Get the view;
        $view = $this->load->view('media');        
        $user = \Platform\User::getInstance();
        $model      = $this->load->model('media');
        $activities = $model->getAll();   
        
        $this->set("activities", $activities);   
        $this->set("user", $user);
        
        $timeline = $this->output->layout("timeline");
        //$timelineside = $this->output->layout("timelinenotes");
             
        $this->output->addToPosition("dashboard", $timeline);
        //$this->output->addToPosition("aside", $timelineside );
             
        $view->display(); //sample call;        
        //$this->output();
    }
    /**
     * Deletes an media from the timeline;
     * @return Timeline::read();
     */
    public function delete() {
        $this->alert(_("Could not delete your post."), _("There seems to be a problem with authenticating this session"), "error");
        return $this->read();
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

