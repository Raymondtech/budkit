<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * model.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/model
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform;

use Library;

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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/model
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Entity extends Model {
    /*
     * Name of primary table
     */

    protected $entityTableName = 'objects';
    protected $entityFieldId = 'object_id';
    /*
     * Eav model objects
     */
    protected $dataModel = array();

    /*
     * Name of attribute table
     */
    protected $attributeTableName = 'properties';
    protected $attributeFieldId = 'property_id';
    protected $attributeFieldType = 'property_type';
    protected $attributeFieldName = 'property_name';

    /**
     * Attributes model
     * @var Zend_Db_Table_Abstract
     */
    protected $attributeModel;
    protected $attributes;
    protected $cache = false;
    protected $cacheData = array();
    

    public static function setAttribute() {
        
    }

    public static function setAttributeValue() {
        
    }

    /**
     * Returns the property definition for a given property by name
     * Use {static::getProperNameFromId} to get the propery name from an Id
     * 
     * @param string $propertyName
     * @return array
     * 
     */
    public static function getAttribute($attributeName) {
        
    }

    /**
     * Returns a property name from the propery Id
     * 
     * @param interger $propertyId
     * @return string
     */
    public static function getAttributeNameFromId($attributeId) {
        
    }

    /**
     * Returns an entity property value by propery name if exists
     * 
     * @param string $propertyName
     * @param interger $entityId
     * @return mixed
     */
    public static function getAttributeValue($attributeName, $entityId = null) {
        
    }

    /**
     * Returns an entity property value by entity id. If entityId is null use current entity id
     * 
     * @param interger $propertyId
     * @param interger $entityId
     * @return mixed if property value exist, null if not exists
     */
    public static function getAttributeValueById($attributeId, $entityId = null) {
        
    }

    /**
     * Set the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public static function setobjectType($entityType) {
        static::$type = $entityType;
    }

    public static function getObject() {
        
    }

    public static function setObject() {
        
    }

    /**
     * Use this when saving data to a virtual table
     * 
     */
    public static function bindDataValues() {
        
    }

    final public static function saveEntity() {
        
    }

    /**
     * Pivot this entity into a sparse matrix
     * @return array associative array
     * 
     */
    public function display() {
        //@TODO: Renders the display data, as per other models
    }

    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self();

        return $instance;
    }

}