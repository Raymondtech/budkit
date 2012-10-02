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

    protected $properties = array();
    protected $cache = false;
    protected $cacheData = array();
    protected $dataModel = array();

    /**
     * Sets the property Value before save
     * 
     * @param string $property Proprety ID or Property Name
     * @param type $value
     */
    public function setProperty($property, $value = NULL) {

        return $this;
    }

    /**
     * Set the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function setobjectType($objectType) {
        $this->type = $objectType;

        return $this;
    }

    /**
     * Returns the property definition for a given property by name
     * Use {static::getProperNameFromId} to get the propery name from an Id
     * 
     * @param string $propertyName
     * @return array
     * 
     */
    public function getProperty($propertyName) {
        
    }

    /**
     * Returns a property name from the property Id
     * 
     * @param interger $propertyId
     * @return string
     */
    public function getPropertyNameFromId($propertyId) {
        
    }

    /**
     * Returns the unique property Id from property Name
     * @param type $propertyName
     */
    public function getPropertyIdFromName($propertyName) {
        
    }

    /**
     * Returns an entity property value by propery name if exists
     * 
     * @param string $propertyName
     * @param interger $entityId
     * @return mixed
     */
    public function getPropertyValue($propertyName, $objectId = null) {
        
    }

    /**
     * Returns an entity property value by entity id. If entityId is null use current entity id
     * 
     * @param interger $propertyId
     * @param interger $entityId
     * @return mixed if property value exist, null if not exists
     */
    public function getPropertyValueById($propertyId, $objectId = null) {
        
    }
    
    /**
     * Return Object lists with matched properties between two values
     * 
     * @param type $property
     * @param type $valueA
     * @param type $valueB
     * @param type $select
     * @param type $objectType
     * @param type $objectURI
     * @param type $objectId
     */
    public function getObjectsByPropertyValueBetween($property, $valueA, $valueB, $select=array(),$objectType = NULL, $objectURI = NULL, $objectId = NULL) {
        
        if(empty($property)|| empty($valueA) || empty($valueB)|| empty($select) ) return false; //We must have eactly one property value pair defined 
        
        $query = static::getObjectQuery($select);
        $where = false;
        if(!empty($objectId)||!empty($objectURI)||!empty($objectType)):
            $query .="\nWHERE";
            if(!empty($objectType)):
                 $query .= "\to.object_type='{$objectType}'";
                 $where  = TRUE;
            endif;
            if(!empty($objectURI)):
                 $query .= ($where)? "\t AND" : "";
                 $query .= "\to.object_uri='{$objectURI}'";
                 $where = TRUE;
            endif;
            if(!empty($objectId)):
                 $query .= ($where)? "\t AND \t" : "";
                 $query .= "\to.object_id='{$objectId}'";
                 $where = TRUE;
            endif;
        endif;
        
        $query .="\nGROUP BY o.object_id";
        $query .= "\nHAVING {$property} BETWEEN {$valueA} AND {$valueB}"; //@TODO check if we are comparing dates and use CAST() to convert to dates 


        $results = $this->database->prepare($query)->execute();

        while( $row = $results->fetchAssoc()){
            print_R($row);
        }
    }
        
    /**
     * Return Object lists with properties values similar to defined value (in part or whole)
     * 
     * @param type $property the property name or alias used in searching. MUST be included in the select array. @TODO group concat property array for searching in multiple fields
     * @param type $value the value of the propery name being searched for;
     * @param type $select
     * @param type $objectType
     * @param type $objectURI
     * @param type $objectId
     */
    public function getObjectsByPropertyValueLike($property, $value, $select=array(), $objectType = NULL, $objectURI = NULL, $objectId = NULL) {
        
        if(empty($property)|| empty($value) || empty($select) ) return false; //We must have eactly one property value pair defined 
        
        $query = static::getObjectQuery($select);
        $where = false;
        if(!empty($objectId)||!empty($objectURI)||!empty($objectType)):
            $query .="\nWHERE";
            if(!empty($objectType)):
                 $query .= "\to.object_type='{$objectType}'";
                 $where  = TRUE;
            endif;
            if(!empty($objectURI)):
                 $query .= ($where)? "\t AND" : "";
                 $query .= "\to.object_uri='{$objectURI}'";
                 $where = TRUE;
            endif;
            if(!empty($objectId)):
                 $query .= ($where)? "\t AND \t" : "";
                 $query .= "\to.object_id='{$objectId}'";
                 $where = TRUE;
            endif;
        endif;
        $query .="\nGROUP BY o.object_id";
        $query .= "\nHAVING {$property} LIKE '%{$value}%'";


        $results = $this->database->prepare($query)->execute();

        while( $row = $results->fetchAssoc()){
            print_R($row);
        }
    }
    
    /**
     * Return Object lists with properties matching the given value
     * 
     * @param type $properties list of properties to match to values, must have exactly a value pair in the values array and must be included in the select array
     * @param type $values
     * @param type $select
     * @param type $objectType
     * @param type $objectURI
     * @param type $objectId
     */
    public function getObjectsByPropertyValueMatch($properties = array(), $values = array(), $select=array(), $objectType = NULL, $objectURI = NULL, $objectId = NULL) {
        
        if(empty($properties)|| empty($values)) return false; //We must have eactly one property value pair defined 
        $select= (empty($select)) ? $properties : $select ; //If we have an empty select use the values from property;
        $query = static::getObjectQuery($select);
        $where = false;
        if(!empty($objectId)||!empty($objectURI)||!empty($objectType)):
            $query .="\nWHERE";
            if(!empty($objectType)):
                 $query .= "\to.object_type='{$objectType}'";
                 $where  = TRUE;
            endif;
            if(!empty($objectURI)):
                 $query .= ($where)? "\t AND" : "";
                 $query .= "\to.object_uri='{$objectURI}'";
                 $where = TRUE;
            endif;
            if(!empty($objectId)):
                 $query .= ($where)? "\t AND \t" : "";
                 $query .= "\to.object_id='{$objectId}'";
                 $where = TRUE;
            endif;
        endif;
        
        $query .="\nGROUP BY o.object_id";
        $p =count($properties);
        $v =count( $values);
        if(!empty($properties) && !empty($values) && $p === $v):
            $query .= "\nHAVING\t";
            $having = false; 
            for($i=0;$i<$p;$i++):
                $query .= ($having)? "\tAND\t" : "";
                $query .= "{$properties[$i]} = ".$this->database->quote( $values[$i] );
                $having = true;
            endfor;
        endif;
       
        $results = $this->database->prepare($query)->execute();

        while( $row = $results->fetchAssoc()){
            print_R($row);
        }
    }

    /**
     * Returns objects lists table with attributes list and values
     * 
     * @param type $objectType
     * @param type $attributes
     * @return type $statement
     * 
     */
    final public function getObjectsList($objectType, $properties = array()) {
        
        $query = static::getObjectQuery($properties);
        $query .="\nWHERE o.object_type='{$objectType}' GROUP BY o.object_id";

        $results = $this->database->prepare($query)->execute();

        while( $row = $results->fetchAssoc()){
            print_R($row);
        }
    }
    
      /**
     * Return an Unique Object with or without attributes attributes
     * 
     * @param type $objectId
     * @param type $attributes
     */
    public function getObjectByURI($objectURI, $properties = array()) {
        
        $query = static::getObjectQuery($properties);
        $query .="\nWHERE o.object_uri='{$objectURI}' GROUP BY o.object_id";

        $results = $this->database->prepare($query)->execute();

        while( $row = $results->fetchAssoc()){
            print_R($row);
        }
    }
    
    /**
     * Return an Unique Object with or without attributes attributes
     * 
     * @param type $objectId
     * @param type $attributes
     */
    public function getObjectById($objectId, $properties = array()) {
        
        $query = static::getObjectQuery($properties);
        $query .="\nWHERE o.object_id='{$objectId}' GROUP BY o.object_id";

        $results = $this->database->prepare($query)->execute();

        while( $row = $results->fetchAssoc()){
            print_R($row);
        }
    }

    /**
     * Builds the original portion of the Object Query without conditions
     * 
     * @param type $properties
     * @return string
     */
    final private static function getObjectQuery( $properties ){
        //Join Query
        $query = "SELECT o.object_id, o.object_uri, o.object_type,";

        //If we are querying for attributes
        $count = count($properties);
        if (!empty($properties) || $count < 1):
            //Loop through the attributes you need
            $i = 0;
            foreach ($properties as $alias => $attribute):
                $alias = (is_int($alias)) ? $attribute : $alias;
                $query .= "\nMAX(IF(p.property_name = '{$attribute}', v.value_data, null)) AS {$alias}";
                if ($i + 1 < $count):
                    $query .= ",";
                    $i++;
                endif;
            endforeach;

            //The data Joins
            $query .= "\nFROM ?property_values v"
                    . "\nLEFT JOIN ?properties p ON p.property_id = v.property_id"
                    . "\nLEFT JOIN ?objects o ON o.object_id=v.object_id";
        else:
            $query .="\nFROM ?objetcs";
        endif;
        
        return $query;
    }
    
    
    
    final public function save() {
        
    }
    
    /**
     * Returns the current data model
     * 
     * @return type
     */
    final public function getDataModel(){
        return $this->dataModel;
    }
    
    /**
     * Extends the parent data model
     * Allows the current object to use parent object properties
     * 
     * @param type $dataModel
     */
    final public function extendDataModel($dataModel = array()){
        
        $this->dataModel = array_merge($this->dataModel, $dataModel );
        
        return $this;
  
    }
    
    /**
     * Creates a completely new data model.
     * Any Properties not explicitly described for this object will be ignored
     * 
     * @param type $dataModel
     */
    final public function newDataModel( $dataModel = array() ){
        
        $this->dataModel = $dataModel;
        return $this;
        
    }

    /**
     * Pivot this entity into a sparse matrix
     * @return array associative array
     * 
     */
    public function display() {
        //@TODO: Renders the display data, as per other models
        return false;
    }

    /**
     * Return an instance of the Object
     * 
     * @staticvar self $instance
     * @return \self
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