<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * settings.php
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

namespace Application\System\Controllers\Admin;
use Application\System\Controllers as System;

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
class Settings extends System\Admin {
    
    /**
     * Displays the configuration form
     * @return void
     */
    public function configuration() {
        //2. Load Model
        $model = $this->load->model("authority");
        //3. Get the authorities list
        $authorities = $model->getAuthorities();
        //4. Set Properties
        $this->set("authorities", $authorities);
        $form = $this->load->view('settings');

        $form->configurationForm();
    }

    /**
     * Displays the appearance configuration form
     * @return void
     */
    public function appearance() {
        $form = $this->load->view('settings');
        $form->appearanceConfigForm();
    }

    /**
     * Displays the navigation settings
     * @return void
     */
    public function navigation(){
       $form = $this->load->view('settings');
       $form->navigationConfigForm();
    }

    /**
     * Displays the moderation queue configuration settings
     * @return void
     */
    public function moderation() {
        $form = $this->load->view('settings');
        $form->moderationConfigForm();
    }
    
    /**
     * Saves configuraiton settings
     * @return boolean
     */
    public function save(){
        
        $referer    = $this->input->getReferer();
        $view       = $this->load->view('settings') ;
        $options    = $this->load->model('options') ;
        
        //Check that we have post data;
        if (!$this->input->methodIs("post")) {
            $this->alert("No configuration data recieved",'Something went wrong','error' );
            $this->redirect( $referer );
            return false;
        }
        //Get the data;
        if(($data = $this->input->getArray("options", array(), "post") ) == FALSE ){
            $this->alert("No input data recieved",'Something went wrong','error' );
            $this->redirect( $referer );
            return false; //useless
        }
        
        //Check that we have a group value
//        if(($group = $this->input->getString("options_group", "system-config", "post") ) == FALSE ){
//            $this->alert("No input data group recieved",'Settings not saved','error' );
//            $this->redirect( $referer );
//            return false; //useless
//        }
        //Check we have all the information we need!
        if(!$options->save( $data , null)){
            $this->alert($options->getError(),'Something went wrong','error');
            $this->redirect( $referer );
            return false;
        }
        //Report on state saved
        $this->alert( "Your configuration settings have now been saved","Everthing worked","success");
        $this->redirect( $referer ); //Redirect back to the page sending in the data;
        
        return true;
    }

    /**
     * Displays the input setting form
     * @todo admin input form
     * @return void
     */
    public function input() {
        $form = $this->load->view('settings');
        $form->inputConfigForm();
    }

    /**
     * Displays the maintenance settings form 
     * @return void
     */
    public function maintenance() {
        $form = $this->load->view('settings');
        $form->maintenanceConfigForm();
    }

    /**
     * Gets an instance of the settings action controller
     * @staticvar object $instance
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

