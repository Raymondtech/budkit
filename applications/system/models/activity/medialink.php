<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * medialink.php
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

namespace Application\System\Models\Activity;

use Platform;
use Library;

/**
 * Media Link Model Class
 *
 * Some types of objects may have an alternative visual representation in the 
 * form of an image, video or embedded HTML fragments. A Media Link represents a 
 * hyperlink to such resources.
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class MediaLink{
    
        /**
     * Identifies the object type 
     * @var string 
     */
    public static $objectType = "medialink";

    /**
     * A hint to the consumer about the length, in seconds of the media resource identified by the url property. 
     * A media link may contain a duration property when the target resource is a time-based media item such as an audio or video
     * @var interger
     */
    public static $duration = 0;

    /**
     * A hint to the consumer about the height, in pixels of the media resource identified by the url property. 
     * A media link may contain a height property when the targe resource is a visual mediat item such as an image, video or embeddable HTML page.
     * @var interger
     */
    public static $height = 0;

    /**
     * A media link MUST have a URL property.
     * @var string 
     */
    public static $url = "/";

    /**
     * An IRI identifying a resource providing an HTML representation of the object. 
     * @var string 
     */
    public static $uri;
    
    /**
     * A hint to the consumer about the width, in pixels of the media resource identified by the url peroperty. 
     * A media link may contain a width property when the target resource is a visual media item such as an image, video or embeddable HTML page
     * @var interger 
     */
    public static $width = 0;

    /**
     * Returns an array with object properties names as keys. 
     * Empty property values are omitted
     * 
     * @return type
     */
    public static function getArray() {
        
        $object     = new \ReflectionClass( '\Application\System\Models\Activity\Medialink' );
        $properties = $object->getProperties( \ReflectionProperty::IS_PUBLIC);
        $array      = array();
        
        foreach($properties as $property){
           $value = $property->getValue();
           if(!empty($value)){
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
        
        $object = new \ReflectionClass( '\Application\System\Models\Activity\Medialink' );
        $object->setStaticPropertyValue( $property , $value );
        
        return true;
    }

    /**
     * Gets an object class property
     * 
     * @param type $property
     * @param type $default
     */
    public static function get($property, $default = NULL) {
        
        $object = new \ReflectionClass( '\Application\System\Models\Activity\Medialink' );
        $value  = $object->getStaticPropertyValue( $property );
        
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
     * Returns an instance of the media link model
     * @return object Medialink
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