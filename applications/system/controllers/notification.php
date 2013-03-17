<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * notification.php
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
 * CAction controller for managing system notifications 
 *
 * This class implements the action controller that manages the creation and
 * view of system notifications.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Notification extends \Platform\Controller {

    /**
     * The default fallback method. 
     * @return See Notifications::list()
     */
    public function index() {
        
        $this->output->setPageTitle(_("Task and Notifications"));
        $view = $this->load->view("index");
        $body = $this->output->layout('notifications');
        $this->output->addToPosition("body", $body);
    }

    /**
     * Creates a new system notification. 
     * @todo    Implement the Notifications creation workflow
     * @return  Void
     */
    public function create() {
        
    }

    /**
     * Displays a new notification. 
     * @todo    Implement the Notifications view workflow
     * @return  Void
     */
    public function view() {
        echo "viewing account";
    }

    /**
     * Deletes a notification
     * @todo Delete notifications
     * @return void;
     */
    public function delete() {
        
    }

    /**
     * Displays a lists of notifications
     * @todo Notificaitons lists
     * @return void
     */
    public function lists() {
        
    }

    /**
     * Gets an instance of the notificaiton controller
     * @staticvar self $instance
     * @return Notification 
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
