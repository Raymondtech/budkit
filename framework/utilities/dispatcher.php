<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * application.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/dispatcher
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform;

use Library;
//use Application\System;
//use Application\System\Controllers;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/dispatcher
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Dispatcher extends \Library\Object {

    /**
     * The Refering page
     * @var string
     */
    public $referer;

    /**
     * The query being executed
     * @var string 
     */
    public $query;

    /**
     * The resolved task
     * @var type 
     */
    public  $task;

    /**
     * The route map
     * @var array 
     */
    protected $route;
    

    public function __construct() {
        //Determines the referer
    }


    //@TODO create request, execute action, add parameter
    //for dynamic request re-routing
    public function createRequest() {
        
    }

    public function executeRequest() {
        
    }

    public function addRequestParameter() {
        
    }

    /**
     * Returns the Refering URL
     * 
     * @return string;
     */
    public static function getReferingURL() {

        $input = \Library\Input::getInstance();
        $referer = $input->getString("HTTP_REFERER", "/", "session");

        return $referer;
    }

    /**
     * Executres the routed request
     * @param <type> $route
     */
    public function execute($route) {
            
        // get the base controller
        require_once FSPATH . 'framework' . DS . 'utilities' . DS . 'controller' . EXT;
        
        //Get user preferences
        Library\Config::getUserPreferences();

        $application = $route->getApplication();
        $controller = $route->getController();
        $method = $route->getMethod();

        $class = "Application\\" . ucfirst($application) . "\Controllers\\" . ucfirst($controller);

        //Check for singularity;
        if (!class_exists($class)) {
            $word = Inflector::pluralize($controller);
            if ($word == $controller) {
                $word = Inflector::singularize($word);
                //@TODO Correct the controller defined in route 
            }
            $class = "Application\\" . ucfirst($application) . "\Controllers\\" . ucfirst($word);
        }
        //print_R(\Library\Config::getParams());
        $this->route = $route;
        $this->task = $class::getInstance();
       

        //Execute the method;
        $argmts = $route->getParameter("arguments");
        $argmts = empty($argmts) ? array() : $argmts;

        //First check if the method is actually a subtask of the controller, i.e 
        //i.e if a subcontroller exists to the main controller

        $_subTask = $class . "\\" . ucfirst($method);
        $_subMethod = (count($argmts) > 0 && isset($argmts[0]) ) ? $argmts[0] : 'index';

        //Change the route, to represent the subtask being requested!
        if (class_exists($_subTask)) {

            if (method_exists($_subTask, $_subMethod)) {
                $class = $_subTask;
                $this->task = $class::getInstance();
                $method = $_subMethod;
                //echo $_subMethod;
                //remove the first argument from the 
                if (isset($argmts[0]) && $argmts[0] == $_subMethod) {
                    unset($argmts[0]);
                }
            }
        }

        if (!method_exists($class, $method)) {
            if (method_exists($class, "index")) {
                $method = 'index';
            } else {
                throw new \Platform\Exception("Method $method does not exists in $class");
            }
        }
        //If the request arguments have changed, modify in Router
        //Using array merge to reset the indices       
        $route->setParameter("arguments", array_merge(array(), $argmts)); 
        $route->setParameter("subtask", $method);
        
        if($this->task->config->getParam( "installed", NULL, "database" )):
            //Check Permissions only if we are not installing?
            //Attach the permission observer
            $this->task->attach("\Platform\Authorize\Permission");
            $this->task->actionStateAs('view'); //View Permissions will always be checked! 
            
        endif; 
        
        //@TODO Should we Allow onBeforeDispatch to modify $this->task?
        Library\Event::trigger('beforeDispatch', $route);
        
        //Register the session lastRequestURL;
        //$referer = $this->task->input->getString("HTTP_REFERER","/","server");
        \Library\Session::set("lastRequestURL", $this->task->input->getString("HTTP_REFERER","/","server"));
        
        \call_user_func_array(array($this->task, $method), (array) $argmts);
        //Try throw exception;
    }

    /**
     * Redirects the browser if set by the controller
     *
     * @param type $url
     * @param type $code
     * @param type $message
     * @return type 
     */
    public function redirect($url = '', $code = 302, $message = '') {

        //Before Dispatch Event
        Library\Event::trigger('beforeRedirect');
        //echo $url;
        //print_R($this->route);
        $redirect = empty($url) ? trim($this->task->redirect) : $url;

        if (empty($redirect))
            return;

        //Now redirect
        return $this->route->redirect($redirect, $code, $message);
    }

    /**
     * Loads an instance of the Dispatcher
     * @return Dispatch
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