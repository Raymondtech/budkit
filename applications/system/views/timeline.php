<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * timeline.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\System\Views;

use Platform;

/**
 * Timeline View class
 * 
 * Displays a timeline of activities
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Timeline extends Platform\View {
    
    /**
     * Displays the default timeline
     * @return void
     */
    public function display(){
        
        $activity   = $this->output->layout("timeline");
        $tips       = $this->output->layout("recommendations");
        //$dashboard  = Controllers\Start\Dashboard::getInstance();
        $this->output->addToPosition("aside", $tips);
        $this->output->addToPosition("body", $activity);
       
    }
    
   /**
    * Returns an instance of the activity class
    * @staticvar object $instance
    * @return object Timeline
    */
   final static function getInstance(){
       
        static $instance;       
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;
        $instance =  new self();
        return $instance;
    }   
}