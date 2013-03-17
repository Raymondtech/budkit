<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * session.php
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
 * Action Controller for managing member sessions
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Session extends \Platform\Controller {

    /**
     * This action controller does not need an index
     * @return void
     */
    public function index() {
        //@TODO raise an error!
    }
    
    /**
     * Stops a member session
     * @return void
     */
    public function stop(){
        $this->logout();
    }

    /**
     * Starts a user session. Displays a form to collection authentication details
     * and authenticates the user. 
     * @return void
     */
    public function start() {
        return $this->login();
    }
    
    /**
     * Returns an instance of the session action controller
     * @staticvar object $instance
     * @return object Session
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
