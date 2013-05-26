<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * calendar.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\Campus\Views;

/**
 * Calendar Sub View class
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Calendar extends \Platform\View{
    

    
    /**
     * Calendar view display
     * @return void
     */
    public function display(){
        
             //To specify a layout, else default will be used
        //$this->setLayout("page");
        //To get a previously set property;
        //echo $this->get("user2");
        //TODO only set if not already set To set the pate title use
        //$this->output->setPageTitle("Welcome to diddat");
        //to add some js file
        $this->output->addScript("/default/assets/js/plugins/fullcalendar/fullcalendar.js");
        $this->output->addStyle("/default/assets/js/plugins/fullcalendar/fullcalendar.css");

        //to output just the layout use
        //$this->output->raw();
        //to output just the xml use
        //$this->output->xml();
        //to output as json use
        //$this->output->json();
        //parse Layout Demo;
        //$sidebar      = $this->output->layout( "index_sidebar" );
        $dashboard = $this->output->layout("dashboard", "system");
        
        //print_R($dashboard);
        
        $sidebar = null;
        //$rightaside     = $this->output->layout( "cpanel"  );
        
        //$this->output->addMenuGroupToPosition("side", "dashboardmenu");
        $this->output->addToPosition("side", $sidebar);
        $this->output->addMenuGroupToPosition("aside", "workspacemenu","nav-list", array(), false, false);
        $this->output->addToPosition("body", $dashboard);
        //$this->output->addToPosition("aside",   $rightaside );
        
    }
    
    /**
     * Displays the calendar calendar
     * @return void
     */
    public function drawCalendar(){
        
        $this->output->setPageTitle( _("Workspace Calendar"));            
        $calendar = $this->output->layout( "workspace/events/calendar" );       
        $this->output->addToPosition("dashboard", $calendar); 
        
        return $this->display();
    }
    
    
    /**
     * The new article create form
     * @return void
     */
    public function createform(){       
        //Page Title
         $this->output->setPageTitle("Calendars | Create new Calendar");
                
        //form
        $form  = $this->output->layout( "workspace/events" );  
        $this->output->addToPosition("dashboard",   $form);
     
        return $this->display();
    }
    
    /**
     * Gets an instance of the calendar class
     * @staticvar object $instance
     * @return object Calendar
     */
    public static function getInstance(){
        
        static $instance;     
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;
        $instance =  new self();

        return $instance;
    }
}


