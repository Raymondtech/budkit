<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * event.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\System\Views\Content;
use \Application\System\Views;

/**
 * Event Sub View class
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Event extends Views\Content{
    
    /**
     * Events view constructor
     * @return void
     */
    public function __construct(){       
        //Construct the parent
        parent::__construct();       
        $this->output->setPageTitle("Events");      
    }
    
    /**
     * Event view display
     * @return void
     */
    public function display(){
        //parse Layout Demo;
        //$sidebar      = $this->output->layout( "index_sidebar" );
        $dashboard      = $this->output->layout( "dashboard" , "system" );
        $sidebar        = $this->output->layout( "sidebar" , "system"  );
        
        $this->output->addToPosition("side",   $sidebar);
        $this->output->addToPosition("body",    $dashboard);
    }
    
    /**
     * Displays the event calendar
     * @return void
     */
    public function drawCalendar(){
    
        $this->set("dashboard", array("title"=>"Event Calendar" ) );        
        $calendar = $this->output->layout( "content/events/calendar" );     
        $this->output->addToPosition("body",    $calendar);   
    }
    
    
    /**
     * The new article create form
     * @return void
     */
    public function createform(){       
        //Page Title
         $this->output->setPageTitle("Events | Create new Event");
                
        //form
        $form  = $this->output->layout( "events/form" );  
        $this->output->addToPosition("dashboard",   $form);
     
        return $this->display();
    }
    
    /**
     * Gets an instance of the event class
     * @staticvar object $instance
     * @return object Event
     */
    public static function getInstance(){
        
        static $instance;     
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;
        $instance =  new self();

        return $instance;
    }
}


