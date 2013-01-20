<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * event.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   View
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/application
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */
namespace Application\System\Views\Content;

use Platform;
use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   View
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/application
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Event extends \Platform\View{
    
    public function __construct(){
        
        //Construct the parent
        parent::__construct();
        
        $this->output->setPageTitle("Events");
        
    }
    
    public function display(){
                //parse Layout Demo;
        //$sidebar      = $this->output->layout( "index_sidebar" );
        $dashboard      = $this->output->layout( "dashboard" , "system" );
        $sidebar        = $this->output->layout( "sidebar" , "system"  );
  
        $this->output->addToPosition("side",   $sidebar);
        $this->output->addToPosition("body",    $dashboard);
    }
    
    public function drawCalendar(){
        
        
        $this->set("dashboard", array("title"=>"Event Calendar" ) );
           
        $calendar = $this->output->layout( "content/events/calendar" );
      
        $this->output->addToPosition("dashboard", $calendar);
        
        //We are showing this on the dashboard
        $this->load->view('index')->display();
      
    }
    
    
    /**
     * The new article create form
     * 
     */
    public function createform(){
        
        //Page Title
         $this->output->setPageTitle("Events | Create new Event");
                 
        //form
        $form  = $this->output->layout( "events/form" );
        
        //The default installation box;
        //$this->output->addToPosition("left",    $sidebar);
        
        $this->output->addToPosition("dashboard",   $form);
        
        
        
        return $this->display();
    }
    
    public static function getInstance(){
        
        static $instance;
        
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;

        $instance =  new self();

        return $instance;
    }
}


