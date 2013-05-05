<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * member.php
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
namespace Application\Settings\Controllers;

/**
 * The Member Settings parent action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Member extends \Platform\Controller {

    
    /**
     * Displays the default setting form
     * @return void
     */
    public function index() {
        return $this->form();
    }

    /**
     * Displays the default account settings form
     * @return void
     */
    public function form(){  
        $view   = $this->load->view( 'member' ); 
        return $view->form('member/account');
    }
    

    /**
     * Returns an instance of the Settings class
     * @staticvar objects $instance
     * @return object Settings
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
