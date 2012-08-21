<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * observer.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/object
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 *
 */

namespace Library;

use Platform;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/object
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Observer extends \Library\Object {

    /**
     * The Action controller propergating action to listerners
     * and being executed
     * 
     * @var type 
     */
    public $controller;

    /**
     * The listerners listening to the actions performed by this controller
     * @var type 
     */
    protected static $listeners = array();

    /**
     * Alias Observer method to add listerner
     * An example of a listerner is the Authorize library class
     * 
     * @return void
     */
    static public function attach() {
        return static::addListerner();
    }

    /**
     * Method to add listerner to an action controller
     * 
     * @return boolean true if added, false if not added
     */
    static public function addListerner() {
        
    }

    /**
     * Tells listeners an action is about to be executed
     * i.e Notifies listerners an action has taken plage
     * 
     * @return void
     */
    static public function announce() {
        
    }

    /**
     * Tells listeners an action has finished being executed
     * i.e Notifies listerners an action has taken plage
     * 
     * @return void
     */
    static public function report() {
        
    }

    /**
     * Gets an instance of the registry element
     *
     * @staticvar self $instance
     * @param type $name
     * @return self
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
