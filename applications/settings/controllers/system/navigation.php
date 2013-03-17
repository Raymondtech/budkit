<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * appearance.php
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

namespace Application\Settings\Controllers\System;

use \Application\Settings\Controllers as Settings;

/**
 * Action controller for managing system appearance 
 *
 * This class implements an interface for experessing admin defined system appearance
 * settings. 
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Navigation extends Settings\System {
    

    /**
     * Displays the appearance configuration form
     * @return boolean
     */
    public function index() {

        //Get the Menus
        $menus = \Platform\Navigator::getAllMenus();
        $this->set("menus", $menus);
    
        $view   = $this->load->view( 'system' ); 
        return $view->form('system/navigation', _("Navigation Settings"));    
    }
    
    /**
     * Returns an instance of the appearance class
     * 
     * @staticvar object $instance
     * @return object Appearance
     */
    public static function  getInstance() {   
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;
        $instance =  new self;
        return $instance;   
    }
}

