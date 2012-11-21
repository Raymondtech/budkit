<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * appearance.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */
namespace Application\System\Controllers\Start;

use Platform;
use Library;
use Application\System\Views as View;
use Application\System\Controllers as System;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */
class Dashboard extends System\Start {
    
    
    public function content(){
        
        echo "Content flow";

        
        return $this->index();
    }
    
    
        
    public function activity(){
        
        $this->output->setPageTitle( _("Acivity Stream") );
        
        $model      = $this->load->model('activity');
        $activities = $model->getAll();        
        $this->set("activities", $activities);   
        
        $activity   = $this->output->layout("system/timeline");
        $this->output->addToPosition("dashboard", $activity);
        
        
        return $this->index();
    }
    
    
        
    public function notifications(){
        
       $this->output->setPageTitle( _("Task and Notifications") );
        $view = $this->load->view("index");
        
        $dashboard       = $this->output->layout('notifications');
        $this->output->addToPosition("dashboard" , $dashboard);
        
        return $this->index();
    }
    
    
        
    public function analytics(){
        
        echo "Analytics";

        
        return $this->index();
    }
    
    
    
    public function index(){

        $view = $this->load->view('index') ;   
        $this->set("user2", "livingstone");
        
        $view->dashboard() ; //sample call;        
        //$this->output();
        
    }
    
    /**
     * Returns an instance of the appearance class
     * 
     * @staticvar self $instance
     * @return self 
     */
    public static function  getInstance() {
        
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;

        $instance =  new self;

        return $instance;   
    }
}

