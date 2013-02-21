<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * collection.php
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
 * Activity stream collection model class
 *
 * An Activity Stream is a collection one or more individual activities. This provides
 * methods for modelling a collection of activities within a stream. A "collection" 
 * is a generic list of Objects of any object type. The objectType of each item 
 * in the collection MAY be omitted if the type of object can be established 
 * through context. The collection is used primarily as the root of an Activity Streams
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Collection {

    /**
     * A non negative interger specifying the total number of activities within a stream
     * The Stream serialization may contain a "count" property
     * @var interger 
     */
    public static $totalItems = 0;

    /**
     * An array containing a listing of objects of any object type. 
     * If used in combiniation with the url property, the items array can be used to provide a subset 
     * of objects that can be found in the resource identified by the url
     * @var array
     */
    public static $items = array();

    /**
     * An IRI [RFC3987] Referencing a document containing the full listing of objects in this collection
     * @var string 
     */
    public static $url = "/";

    /**
     * Returns an array with object properties names as keys. 
     * Empty property values are omitted
     * 
     * @return array of items in collection
     */
    public static function getArray() {
        $object = new \ReflectionClass('\Application\System\Models\Activity\Collection');
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
     * @param string $property
     * @param mixed $value
     */
    public static function set($property, $value = NULL) {

        $object = new \ReflectionClass('\Application\System\Models\Activity\Collection');
        $object->setStaticPropertyValue($property, $value);

        return true;
    }

    /**
     * Gets an object class property
     * 
     * @param string $property
     * @param mixed $default
     */
    public static function get($property, $default = NULL) {

        $object = new \ReflectionClass('\Application\System\Models\Activity\Collection');
        $value = $object->getStaticPropertyValue($property);

        //If there is no value return the default
        return (empty($value)) ? $default : $value;
    }

    /**
     * Returns an instance of the Collection Class
     * @return object Collection
     */
    public static function getInstance() {
        $instance = new self();
        return $instance;
    }

}