<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * admin.php
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
 * The parent system admin action controller.  
 *
 * This class implements the action controller for key system administrative task.
 * Every other action is implemented in their respective subclasses.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Admin extends \Platform\Controller {

    /**
     * Admin action controller constructor
     * @return void
     */
    public function __construct() {
       
        parent::__construct();     
        //Construct the parent
        $this->set('pageid', 'adminpage');       
        $this->view = $this->load->view('admin');
    }
    /**
     * The default fall back method
     * @return boolean false 
     */
    public function index() {
        return false;
    }
    /**
     * Returns an instance of the admin controller
     * @staticvar self $instance
     * @return Admin 
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

