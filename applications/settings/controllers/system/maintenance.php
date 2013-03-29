<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * maintenance.php
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
 * Admin settings action controller
 *
 * Displays and update system configuration settings. 
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @todo      System manage action methods
 */
class Maintenance extends Settings\System {
    
    public function index(){
        
        $this->output->setPageTitle(_("System Maintenance"));
        //$aside  = "Settings Instructions"; 
        $view = $this->load->view('system');
        
        $view->form('system/maintenance',"System Maintenance");
        
    }
    
    public function reset(){
        
        //1.Verify Capatcha;
        //2.Require authentication
        //3.Check User is superadministrator
        //4.Delete setup.ini
        //Job DOne
        
        $this->redirect("/setup/install/step1"); //This will take them to installer
    }
    
    public function check(){
        $update = '<a href="/settings/system/maintenance/update">Please update now</a>';
        //Check
        $this->alert($update,"Version 0.9.2 is available.", "info");
        //
        return  $this->index();
    }
    
    
    public function update(){
        //Check
        $this->alert("BudKit 0.9.2 installed successfully.","Update Complete", "success");
        //
        return  $this->index();
    }
    
    /**
     * Gets an instance of the Update Controller
     * 
     * @staticvar object $instance
     * @return object \Application\Setup\Controllers\Update 
     */
    public static function getInstance() {
        
        static $instance;
        
        //If the class was already instantiated, just return it
        if (isset(static::$instance))
            return static::$instance;

        static::$instance = new self;
        
        return static::$instance;
    }

}