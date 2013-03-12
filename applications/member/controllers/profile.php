<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * profile.php
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
 * Profile parent CRUD action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Profile extends \Platform\Controller {

    /**
     * Displays the member profile
     * @todo Profile display
     * @return false;
     */
    public function index() {
               /**View Profile**/
                
        $user     = \Platform\User::getInstance();
        
        $username = $this->router->getMethod();
        $view     = $this->load->view('profile');
        $profile  = $this->load->model('profile');
        $profile  = $profile->loadObjectByURI( $this->user->get("user_name_id"), array_keys($profile->getPropertyModel()));
        
        $data     = $profile->getPropertyData();
        
        $this->set("profile", $data ); //Sets the profile data;
        //$row->setPropertyValue("first_name", "Livingstone");
        //$row->saveObject();
        
        $view->profilePage();
    }
    
        /**
     * Displays the profile timeline
     * @return @return false
     */
    public function timeline(){
        
        $this->output->setPageTitle( _("Activity stream") );       
        //Get the view;
          
        $user = \Platform\User::getInstance();
        $model      = $this->load->model('activity' , 'system');
        $activities = $model->getAll();   
        $profile  = $this->load->model('profile');
        $profile  = $profile->loadObjectByURI( $user->get("user_name_id"), array_keys($profile->getPropertyModel()));
        
        $data     = $profile->getPropertyData();
        
        $this->set("profile", $data ); //Sets the profile data;
        $this->set("activities", $activities);   
        $this->set("dashboard", array("title"=>"Activity stream" ) );
        $this->set("user", $user);
        

            
        $activity   = $this->output->layout("system/activity/timeline");
        $this->output->addToPosition("body", $activity);
        
        return $this->index();
        
    }
    
    /**
     * Displays the basic profile inforation
     * @todo Profile Information
     * @return void
     */
    public function information(){
        return $this->index();
    }
    
    
    /**
     * Displays the profile's achievement
     * @return void
     */    
    public function achievements(){       
        echo "achievements";
        return $this->index();
    }
    
    
    /**
     * Displays the profile network graph
     * @return void
     */   
    public function network(){
        echo "network";
        return $this->index();
    }


    /**
     * Use for displaysing profiles requested using vanity username profile calls, e.g /member/profile/livingstone.fultang
     * @param string $name
     * @param string $arguments
     * @return void
     */
    final public function __call($name, $arguments) {
        
        //check if this is a valid userid or usernameid
            //If it is a valid user, show the view page,
            return $this->index( );
            //If its is NOT a valid user, return the 404 not found page
    }
    
    
    /**
     * Returns an instance of the Profile action controller
     * @staticvar object $instance
     * @return object
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
