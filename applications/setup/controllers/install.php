<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * install.php
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
namespace Application\Setup\Controllers;

/**
 * Install actions controller 
 *
 * This class implements a controller for managing the installation process.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Install extends \Platform\Controller {
    
    /**
     *  Holds an instance of the Install object.
     * @var object
     */
    static $instance;
    
    /**
     * The default index action. Displays step 1 of the installation process
     * @return void
     */
    public function index(){
        return $this->step1();
    }
    
    /**
     * Step1 of the installation process. Displays the end user license 
     * @return void
     */
    public function step1(){      
        $view = $this->load->view('process') ; 
        //this is step 1;
        $this->set("step", "1");
        $view->index() ; //sample call;        
        //To set the page title use
        $this->output->setPageTitle(_t("Installation | EULA"));
   
        return;
        
    }
    
    /**
     * Step2 of the installation process. Validates that the EULA has been 
     * accepted from step 1. Performs a validation of the system requirements.
     * @todo This method does not at this stage stop the installation proces on any failures
     * @return void
     */
    public function step2(){
        
        //Processes step 1
        $view   = $this->load->view('process') ;
        $model  = $this->load->model('requirements');
         
        $this->set("checker" , $model );
        $this->set("step", "2");
        
        //If we have not accepted the terms and conditions.
        //Redirect back and explain
        if(!$this->input->getBoolean("eula_accept")){
            $this->alert(_t('You must read and accept the End User License Agreement (EULA) to proceed with installation'),'','error');
            $this->redirect("/install/step1");
        }
        
        //Get Requirements
        //$requirements = $this->config->getParam("requirements", array(), "install");
        require_once(APPPATH . 'setup'.DS. 'requirements.inc' );
        
        $this->set("requirements", $requirements);
       
        $view->index() ; //sample call;
        $this->output->setPageTitle( _t("Installation | Requirements") );
        
    }
    
    /**
     * Step3 of the installation process. Displays the database configuration form
     * @return void
     */
    public function step3(){
        
        $view = $this->load->view('process') ;
        
        //this is step 1;
        $this->set("step", "3");
        
        //To set the pate title use
        $this->output->setPageTitle(_t("Installation | Database Config Settings"  ));
        $view->index() ; //sample call;
        
    }
    
    /**
     * Step4. Performs the database table setup. Please note that this method does not
     * actually create or overwrite the database and as such the database must already exists.
     * If Database setup is successful, will display the master user setup form
     * 
     * @return void
     */
    public function step4(){
        
        $view       = $this->load->view('process') ;
        $install    = $this->load->model('install') ;
        
        if (!$this->input->methodIs("post")) {
            $this->alert( _t("No user data recieved"),_t('Something went wrong'),'error' );
            $this->redirect("/install/step3");
        }

        //Check we have all the information we need!
        if(!$install->run()){
            $this->alert( $install->getError(),_t('Something went wrong'),'error');
            $this->redirect("/install/step3");
        }
        $this->alert( _t("Awesome! Your database is all setup and ready. Now complete the details below to create a master user account. Please use a valid email address"),"","info");
        //sample call; this is step 1;
        $this->set("step", "4");
        
        $this->output->setPageTitle(_t("Installation | Final Things"));
        $view->index() ; 
        
    }
    
    /**
     * Step5. Registers an account for the master user/superadministrator. IF 
     * Successfull will display a summary of the completed install process
     * 
     * @return void
     */
    public function step5(){
        
        $view       = $this->load->view('process') ;
        $install    = $this->load->model('install') ;
        
        if (!$this->input->methodIs("post")) {
            $this->alert(_t("No user data recieved"),_t('Something went wrong'),'error' );
            $this->redirect("/install/step3");
        }

        //Check we have all the information we need!
        if(!$install->superadmin()){
            $this->alert($install->getError(),_t('Something went wrong'),'error');
            $this->set("step", "4");
            $view->index() ; 
            return $this->output->setPageTitle(_t("Installation | Final Things"));
        }
        $this->alert(_t("Fantastico. All systems ready to go. Please make a note of the information below. If possible print this screen and keep it for your records") ,"","success");
        
        //Return the install report as launch
        $this->output->setPageTitle(_t("Installation Complete"));
        
        return $view->readme();
    }
    
    /**
     * Returns an instance of the Install action controller
     * @return object Install
     */
    public static function  getInstance() {
        
        static::$instance;
        //If the class was already instantiated, just return it
        if (isset(static::$instance) ) return static::$instance ;
        static::$instance =  new self;
        return static::$instance;   
    }
}

