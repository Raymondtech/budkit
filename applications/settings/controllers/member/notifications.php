<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * notifications.php
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
namespace Application\Member\Controllers\Settings;
use \Application\Member\Controllers as Member;
/**
 * The sub actions controller for notification settings
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Notifications extends Member\Settings {

    /**
     * Displays the notification settings
     * @return void
     */
    public function index() {           
        $view   = $this->load->view( 'settings' );
        return $view->form("settings/notifications", "Notificaiton settings");
    }

    /**
     * Gets an instance of the notifications settings actions controller
     * @staticvar object $instance
     * @return object Notifications
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
