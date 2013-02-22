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
namespace Application\Member\Controllers;

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
        
        //$this->output->addToPosition("side", $sidebar);
        $user = \Platform\User::getInstance();
        $model      = $this->load->model('activity','system');
        $activities = $model->getAll();   
        
        $this->set("activities", $activities);   
        $this->set("dashboard", array("title"=>"Activity stream" ) );
        $this->set("user", $user);
        
        $body = $this->output->layout('messages/lists');
        $this->output->addToPosition("body", $body);
    }

    /**
     * Gets private messages and displays the members inbox
     * @return void
     */
    public function inbox() {
        $this->output->setPageTitle(_("Inbox"));
        return $this->index();
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

        $view = $this->load->view("index");
        $view->newUserAccountForm();
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
