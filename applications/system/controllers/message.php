<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * message.php
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
namespace Application\System\Controllers;

/**
 * Messages CRUD action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Message extends \Platform\Controller {

    /**
     * Messages index action
     * @return void
     */
    public function index() {
         return $this->inbox();
    }

    /**
     * Gets private messages and displays the members inbox
     * @return void
     */
    public function inbox() {
        
        $this->output->setPageTitle(_("Private Messages"));
        
        $model      = $this->load->model('media','system');
        $activities = $model->setListOrderBy(array("o.object_updated_on"), "ASC")->getAll();   
        
        $this->set("activities", $activities);   
        
        $layout = $this->output->layout('messages/inbox');
        $this->output->addToPosition("dashboard", $layout);
        
        $this->load->view("message")->display(); 
    }

    /**
     * Fetches a list of messages the member has sent to other members
     * @return void
     */
    public function sent() {
        $this->output->setPageTitle(_("Sent Messages"));
        return $this->index();
    }

    /**
     * Fetches messages trashed by the member
     * @return void
     */
    public function trash() {
        $this->output->setPageTitle(_("Trashed Messages"));
        return $this->index();
    }

    /**
     * Fetches instant messages
     * @return void
     */
    public function live() {
        $this->output->setPageTitle(_("Live discussions"));
        return $this->index();
    }

    /**
     * Fetches all unsent messages saved as draft
     * @return void
     */
    public function drafts() {
        $this->output->setPageTitle(_("Saved Messages"));
        return $this->index();
    }

    /**
     * Creates a new private message
     * @return void
     */
    public function create() {

        $this->output->setPageTitle(_("New Message"));
        
        //If we are submitting a form
        if ($this->input->methodIs("post")) {
            //1. Check that the each participant exists;
            //2. Check that we have a subject;
            //3. Create a message object;
            //3b. Deal with attachments
            //5. Create a media object;
            //6. Notifications and alerts
            $post = $this->input->data('post'); 
            
            print_r($post);
            
            die;
        }
        
        $layout = $this->output->layout('messages/compose');
        $this->output->addToPosition("dashboard", $layout);
        
        $this->load->view("message")->display(); 
    }


    /**
     * Returns an instsance of the message action controller
     * @staticvar object $instance
     * @return object Message
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
