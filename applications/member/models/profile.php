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

namespace Application\Member\Models;

/**
 * The profile EAV model. Extends the User model
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Profile extends User {
   
    /**
     * Constructs the Profile Object model
     * @return void
     */
    public function __construct() {  
        parent::__construct();   
        //Extend the User Object Model
        $this->extendPropertyModel(array(
           "dob" => array("Date of Birth", "date")
        ));
    }

    /**
     * Returns an instance of the profile object model
     * 
     * @staticvar object $instance
     * @return object Profile
     */
    public static function getInstance(){      
        static $instance;    
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;
        $instance =  new self();
        return $instance;
    }
    
}


