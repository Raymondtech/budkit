<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * object.php
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

namespace Application\System\Controllers;

/**
 * The Object controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Object extends \Platform\Controller {
    
    /**
     * The default fallback method. 
     * @return void
     */
    public function index() {
        
        //The method is the object unique ID
        $entity     = \Platform\Entity::getInstance();
        $resourceId = $this->router->getMethod();
        $params     = func_get_args();
        
        $object     = $entity->loadObjectByURI( $resourceId ); //@todo Validate URI
        //$objectType = $object->getPropertyValue("objectType");
        //Loads all the system objects;
        \Library\Event::trigger("beforeObjectLoad", $object , $params);

    }
    
    public function rate(){
        
        
    }


    /**
     * Gets an instance of the search class
     * @staticvar self $instance
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

