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
 */
namespace Application\Member\Views;

/**
 * Member Profile View
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Profile extends \Platform\View {
    
    /**
     * The default view display
     * @return void
     */
    final public function display(){
        //The default method
    }
    
    /**
     * Displays the member profile page
     * @return void
     */
    public function profilePage(){
         //To set the pate title use
        
        $this->output->setLayout("profile");
  
        $profile        = $this->output->layout("profile" );

        $this->output->addToPosition("body" , $profile);

    }

    /**
     * Returns an instance of the profile page view class
     * @staticvar object $instance
     * @return object Profile
     */
    public static function getInstance() {
        
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;
        $instance = new self();

        return $instance;
    }

}

