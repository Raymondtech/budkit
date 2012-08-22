<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * action.php
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
abstract class Action extends \Library\Object {

    /**
     * The State of an action controller propergated to observers
     * 
     * @var type 
     */
    protected static $state;
    
    protected static $stateParams;

    /**
     * The observers listening to the actions performed by this controller
     * 
     * @var type 
     */
    protected static $observers = array();

    /**
     * Attaches an observer to an action class
     * 
     * @param type $observer
     * 
     * @return void
     */
    static public function attach($observer) {

        //Search to ensure this observer has not already been attached
        $i = array_search($observer, static::$observers);
        if ($i === false) {
            static::$observers[] = $observer;
        }
    }

    /**
     * Detaches an observer from a list of observers
     * 
     * @param type $observer
     */
    static public function detach($observer) {
        if (!empty(static::$observers)) {
            $i = array_search($observer, static::$observers);
            if ($i !== false) {
                unset(static::$observers[$i]);
            }
        }
    }

    /**
     * Tells listeners an action is about to be executed
     * i.e Notifies listerners an action has taken place
     * 
     * @return void
     */
    static public function actionStateAs($state, $params = array()) {
        
        static::$state       = $state;
        static::$stateParams = $params;
        static::notify();
    }

    /**
     * Returns the current action controller state
     * 
     * @return type
     */
    static public function getState() {
        return static::$state;
    }

    /**
     * Returns a list of attached observers
     * 
     * @return type
     */
    static public function getObservers() {
        return static::$observers;
    }

    /**
     * Notifies listerners of a change in state
     * 
     * @return void
     */
    static private function notify() {
        if (!empty(static::$observers)) {
            foreach (static::$observers as $observer) {
                $state  = static::getState();
                $action = static::getInstance();
                $user   = Platform\User::getInstance();
                $route  = $action->router->url;
                
                //print_R($action->router);
                
                $params = array_merge(array("action"=>$action, "user"=>$user, "route"=>$route ), static::$stateParams );
                $observer::execute( $state, $params );
                unset($params);
            }
        }
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
