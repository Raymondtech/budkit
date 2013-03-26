<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * network.php
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
 * Network action controller
 *
 * Network actions, including relationship management and analytics. 
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @todo      System manage action methods
 */
class Permissions extends Settings\System {

    /**
     * Displays a list of network authority groups
     * @todo Implement the ability to modify groups
     * @param string $edit
     * @return void
     */
    public function index($edit = "") {

        $view   = $this->load->view('system');
        $params = $this->getRequestArgs();
        
        //1. Load the model
        $authority = $this->load->model("authority");
        
        //2. If we are editing the authority, save
        if ($this->input->methodIs("post")):
            if(!$authority->store( $edit , $params)){
                $errors = $this->getErrorString();
                $this->alert($errors, null , "error");
            }  $this->alert(_("Changes have been saved successfully"), "", "success");        
            $this->redirect( $this->output->link("/settings/system/permissions") );
        endif;

        //3. Get the authorities list
        $authorities = $authority->getAuthorities();
        //4. Set Properties
        $this->set("authorities", $authorities);
        //5. The layout
        $view->form('system/permissions', "Permissions");

    }
    
    public function authorities($edit = "") {

        $view   = $this->load->view('system');
        $params = $this->getRequestArgs();
        
        //1. Load the model
        $authority = $this->load->model("authority");
        
        //2. If we are editing the authority, save
        if ($this->input->methodIs("post")):
            if(!$authority->store( $edit , $params)){
                $errors = $this->getErrorString();
                $this->alert($errors, null , "error");
            }  $this->alert(_("Changes have been saved successfully"), "", "success");        
            $this->redirect( $this->output->link("/settings/system/permissions/authorities") );
        endif;
       
        //3. Get the authorities list
        $authorities = $authority->getAuthorities();
        
        //print_r($authorities);
        //4. Set Properties
        $this->set("authorities", $authorities);
        //5. The layout
        $view->form('system/authorities', 'Authorities');

    }

    /**
     * Gets an instance of the network class
     * @staticvar object $instance
     * @return object Network
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

