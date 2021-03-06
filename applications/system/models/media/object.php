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

namespace Application\System\Models\Media;

use Platform;
use Library;

/**
 * Media stream object model
 *
 * Provides a model to activity stream objects
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Object {

    /**
     * An Arrray of one or more additional associated objects
     * @var array 
     */
    public static $attachments = array();

    /**
     * A single object describing the entity that created or authored the object
     * @var object 
     */
    public static $author = NULL;

    /**
     * Natural language description of the object. Can contain HTML Markup and other visual elements
     * such as thumbmail images
     * @var string 
     */
    public static $content = "";

    /**
     * String specifying the display name of the contained object. This is REQUIREd for all objects of type "user"
     * and where the objectType property is not specified;
     * @var string 
     */
    public static $displayName = "";

    /**
     * Provides a permermanent unique identifier for this object
     * @var interger 
     */
    public static $id = "";

    /**
     * A media link or a resource providing visual reperesentatino of this object
     * @var object 
     */
    public static $image = NULL;

    /**
     * Identifies the object type 
     * @var string 
     */
    public static $objectType = "";

    /**
     * The date and time the object was published. 
     * @var string  
     */
    public static $published = "";

    /**
     * Natural language summarization of the object
     * @var string
     */
    public static $summary = "";

    /**
     * An IRI identifying a resource providing an HTML representation of the object. 
     * @var string 
     */
    public static $uri;

    /**
     * Returns an array with object properties names as keys. 
     * Empty property values are omitted
     * 
     * @return type
     */
    public static function getArray() {
        $object = new \ReflectionClass('\Application\System\Models\Media\Object');
        $properties = $object->getProperties(\ReflectionProperty::IS_PUBLIC);
        $array = array();

        foreach ($properties as $property) {
            $value = $property->getValue();
            if (!empty($value)) {
                $array[$property->getName()] = $value;
            }
        }
        return $array;
    }

    /**
     * Sets an object class property
     * 
     * @param type $property
     * @param type $value
     */
    public static function set($property, $value = NULL) {

        $object = new \ReflectionClass('\Application\System\Models\Media\Object');
        $object->setStaticPropertyValue($property, $value);

        return true;
    }

    /**
     * Gets an object class property
     * 
     * @param type $property
     * @param type $default
     */
    public static function get($property, $default = NULL) {

        $object = new \ReflectionClass('\Application\System\Models\Media\Object');
        $value = $object->getStaticPropertyValue($property);

        //If there is no value return the default
        return (empty($value)) ? $default : $value;
    }
    
    /**
     * Creates a new instance of the activity Object Type
     * @return \self
     */
    public static function getNewInstance(){
        return new self;
    }

    /**
     * Returns an instsance of the object model
     * @staticvar object $instance
     * @return object Object
     */
    public static function getInstance( $recreate = false ) {

        if($recreate) return new self; //If we want to force create a new object
        
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;
        $instance = new self;
        return $instance;
    }

}