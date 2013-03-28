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
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Entity extends Model {

    protected $propertyData = array();
    protected $propertyModel = array();
    protected $objectId = NULL;
    protected $objectType = NULL;
    protected $objectURI = NULL;
    protected $valueGroup = NULL; //property value groups can be sub categorised;
    protected $listLimit = NULL;
    protected $listStart = NULL;
    protected $listOderByStatement = NULL;
    protected $listLookUpConditions = array();
    protected static $withConditions = false;
    
    protected $savedObjectURI = NULL;

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Sets the property Value before save
     * 
     * @param string $property Proprety ID or Property Name
     * @param type $value
     */
    public function setPropertyValue($property, $value = NULL, $objectId = NULL) {

        $property = strtolower($property);
        //1. Check that the property exists in $dataModel;
        if (!array_key_exists($property, $this->propertyModel))
            return false; //@TODO Raise error? specified column not found
        //2. Validate the Value?
        //3. Store the value with the property name in $propertyData;
        if (empty($objectId) || (int) $objectId == $this->objectId):
            $this->propertyData[$property] = $value;
        //elseif(!empty($objectId)):
        //@TODO Go to the database set the property value for this object
        endif;

        return $this;
    }

    /**
     * Set the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function setObjectType($objectType) {
        $this->objectType = $objectType;
        return $this;
    }
    /**
     * Get the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function getObjecType() {
        return $this->objectType;
    }
    /**
     * Set the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function setLastSavedObjectURI($objectId) {
        $this->savedObjectURI = $objectId;
        return $this;
    }
    
    /**
     * Get the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function getLastSavedObjectURI() {
        return $this->savedObjectURI;
    }

    /**
     * Set the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function setObjectId($objectId) {
        $this->objectId = $objectId;
        return $this;
    }
    
    /**
     * Get the Entity Type for the current Entity
     * 
     * @param string $entityType
     * @return void
     */
    public function getObjectId() {
        return $this->objectId;
    }
    /**
     * 
     * @param type $objectURI
     * @return \Platform\Entity
     */
    public function setObjectURI($objectURI) {
        $this->objectURI = $objectURI;
        return $this;
    }

        /**
     * 
     * @param type $objectURI
     * @return \Platform\Entity
     */
    public function getObjectURI() {
        return $this->objectURI;
 
    }
    /**
     * Returns the property definition for a given property by name
     * Use {static::getProperNameFromId} to get the propery name from an Id
     * 
     * @param string $propertyName
     * @return array
     * 
     */
    public function getPropertyDefinition($propertyName) {
        
    }
    

    /**
     * Returns an entity property value by propery name if exists
     * 
     * @param string $propertyName
     * @param interger $entityId
     * @return mixed
     */
    public function getPropertyValue($propertyName, $objectId = null) {
        
        //You can return this protected properties as objects too.
        if(in_array($propertyName, array("objectId","objectType","objectURI")) && isset($this->$propertyName)){
            return $this->$propertyName;
        }

        $property = strtolower($propertyName);
        //1. Check that the property exists in $dataModel;
        if (!array_key_exists($property, $this->propertyModel))
            return false; //@TODO Raise error? specified column not found
        //2. if isset objectId and object is this object, check value in propertyData
        if ((!empty($objectId) && (int) $objectId == $this->objectId ) || empty($objectId)) {
            //IF we have a property that is not defined go get 
            if (!isset($this->propertyData[$property]) ) {
                //@TODO Database QUERY with objectId
                //Remember that this will most likely be used for 'un-modeled' data
                return;
            }
            //If we already have the property set and the objectId is empty
            return $this->propertyData[$property];
        }
        //3. If we have an Id and its not the same go back to the DB
        //if we have an id
        return;
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
    public function getObjectsByPropertyValueBetween($property, $valueA, $valueB, array $select, $objectType = NULL, $objectURI = NULL, $objectId = NULL) {

        if (empty($property) || empty($valueA) || empty($valueB) || empty($select))
            return false; //We must have eactly one property value pair defined 

        $query = static::getObjectQuery($select,"?{$this->valueGroup}property_values", $objectId, $objectType, $objectURI);

        $query .="\nGROUP BY o.object_id";
        $query .= "\nHAVING {$property} BETWEEN {$valueA} AND {$valueB}"; //@TODO check if we are comparing dates and use CAST() to convert to dates 


        $results = $this->database->prepare($query)->execute();

        return $results;
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
    public function getObjectsByPropertyValueLike($property, $value, array $select = array(), $objectType = NULL, $objectURI = NULL, $objectId = NULL) {

        if (empty($property) || empty($value))
            return NULL; //We must have eactly one property value pair defined 
        $select = (empty($select)) ? array( $property ) : array_merge( array( $property ) , $select); //If we have an empty select use the values from property;
        $query = static::getObjectQuery($select,"?{$this->valueGroup}property_values", $objectId, $objectType, $objectURI);

        $query .="\nGROUP BY o.object_id";
        $query .= "\nHAVING {$property} LIKE '%{$value}%'";


        $results = $this->database->prepare($query)->execute();

        return $results;
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
    public function getObjectsByPropertyValueMatch(array $properties, array $values, array $select = array(), $objectType = NULL, $objectURI = NULL, $objectId = NULL) {

        if (empty($properties) || empty($values))
            return false; //We must have eactly one property value pair defined 
        $select = array_merge($properties, $select); //If we have an empty select use the values from property;
        $query = static::getObjectQuery($select,"?{$this->valueGroup}property_values", $objectId, $objectType, $objectType);

        $query .="\nGROUP BY o.object_id";
        $p = count($properties);
        $v = count($values);
        if (!empty($properties) && !empty($values) && $p === $v):
            $query .= "\nHAVING\t";
            $having = false;
            for ($i = 0; $i < $p; $i++):
                $query .= ($having) ? "\tAND\t" : "";
                $query .= "{$properties[$i]} = " . $this->database->quote($values[$i]);
                $having = true;
            endfor;
        endif;

        $results = $this->database->prepare($query)->execute();

        return $results;
    }
    
    /**
     * Sets lists limit for page'd lists
     * 
     * @param type $limit
     * @return \Platform\Entity
     */
    final public function setListLimit( $limit = 10 ){
        $this->listLimit = intval( $limit );
        return $this;
    }
    
    /**
     * Set list start for page'd lists
     * 
     * @param type $start
     * @return \Platform\Entity
     */
    final public function setListStart( $start = 0 ){
        $this->listStart = intval( $start );
        return $this;
    }
    
    /**
     * Sets the list order direction
     * 
     * @param type $fields comma seperated list, or array 
     * @param type $direction
     * @return \Platform\Entity
     */
    final public function setListOrderBy($fields, $direction="ASC"){
      
        $direction = (in_array(strtoupper(trim($direction)), array('ASC', 'DESC'), TRUE)) ? ' ' . $direction : ' ASC';
        $orderby = NULL;
        //Clean up the order by field list
        if (!empty($fields) && !is_array( $fields)) {
            $temp = array();
            foreach (explode(',', $fields) as $part) {
                $part = trim($part);
                $temp[] = $part;
            }

            $orderby = implode(', ', $temp);
        } else if (is_array( $fields )) {
            $temp = array();
            foreach($fields as $field){
                $part = trim($field);
                $temp[] = $part;
            }
            $orderby = implode(', ', $temp);
        }
        
        
        
        if(!empty($orderby)){  
            $this->listOrderByStatement = "\nORDER BY ". $orderby . $direction;
        }
        //Return this object
        return $this;
    }
    
    /**
     * Returns the list orderby statement if any defined or NULL if none
     * 
     * @return string
     */
    final public function getListOrderByStatement(){
        return $this->listOrderByStatement;
    }
   
    final public function setListLookUpConditions(){
        return $this;
    }

    /**
     * Returns objects lists table with attributes list and values
     * 
     * @param type $objectType
     * @param type $attributes
     * @return type $statement
     * 
     */
    final public function getObjectsList($objectType, $properties = array() ) {

        $query = static::getObjectQuery($properties,"?{$this->valueGroup}property_values", NULL, $objectType );
        
        //echo($this->withConditions) ;
        
        
        
        $query .="\nGROUP BY o.object_id";
        $query .= $this->getListOrderByStatement();

        $results = $this->database->prepare($query)->execute();

        return $results;
    }
    
    
    final public function getObjectById($objectId, $properties = array()){
        if (empty($properties)):
            if (!empty($this->propertyModel))
                $properties = array_keys($this->propertyModel);
        endif;
        
        $query = static::getObjectQuery($properties, "?{$this->valueGroup}property_values");
        $query .="\nWHERE o.object_id='{$objectId}' GROUP BY o.object_id";

        $results = $this->database->prepare($query)->execute();
        
        return $results;
    }

    /**
     * Return an Unique Object with or without attributes attributes
     * 
     * @param type $objectId
     * @param type $attributes
     */
    public function loadObjectByURI($objectURI, $properties = array()) {

        if (empty($properties)):
            if (!empty($this->propertyModel))
                $properties = array_keys($this->propertyModel);
        endif;

        $query = static::getObjectQuery($properties,"?{$this->valueGroup}property_values");
        $query .="\nWHERE o.object_uri='{$objectURI}' GROUP BY o.object_id";

        $results = $this->database->prepare($query)->execute();

        $n = 0;
        $object = new Entity();
        $object->definePropertyModel($this->propertyModel);

        while ($row = $results->fetchAssoc()) {
            foreach ($row as $property => $value):
                if (strtolower($property) == "object_type") {
                    $object->setObjectType($value);
                    continue;
                }
                if (strtolower($property) == "object_id") {
                    $object->setObjectId($value);
                    continue;
                }
                if (strtolower($property) == "object_uri") {
                    $object->setObjectURI($value);
                    continue;
                }
                $object->setPropertyValue($property, $value);
            endforeach;
            $n++;
        }
        return $object;
    }

    /**
     * Return an Unique Object with or without attributes attributes
     * 
     * @param type $objectId
     * @param type $attributes
     */
    public function loadObjectById($objectId, $properties = array()) {

        $results = $this->getObjectById($objectId, $properties );
        //If success, store the object id in
        $n = 0;
        $object = new Entity();
        $object->definePropertyModel($this->propertyModel);

        while ($row = $results->fetchAssoc()) {
            foreach ($row as $property => $value):
                if (strtolower($property) == "object_type") {
                    $object->setObjectType($value);
                    continue;
                }
                if (strtolower($property) == "object_id") {
                    $object->setObjectId($value);
                    continue;
                }
                if (strtolower($property) == "object_uri") {
                    $object->setObjectURI($value);
                    continue;
                }
                $object->setPropertyValue($property, $value);
            endforeach;
            $n++;
        }
        return $object;
    }

    /**
     * Builds the original portion of the Object Query without conditions
     * 
     * @param type $properties
     * @param type $vtable
     * @param type $objectId
     * @param type $objectType
     * @param type $objectURI
     * @return string
     */
    final private static function getObjectQuery($properties, $vtable = '?property_values', $objectId=NULL, $objectType=NULL, $objectURI=NULL) {
        //Join Query
        $query  = "SELECT o.object_id, o.object_uri, o.object_type";

        if (!empty($properties)):
            //Loop through the attributes you need
            $i = 0;
            $count = \sizeof($properties);
            //echo $count;
            $query .= ",";
            foreach ($properties as $alias => $attribute):
                $alias = (is_int($alias)) ? $attribute : $alias;
                $query .= "\nMAX(IF(p.property_name = '{$attribute}', v.value_data, null)) AS {$alias}";
                if ($i + 1 < $count):
                    $query .= ",";
                    $i++;
                endif;
            endforeach;

            //The data Joins
            $query .= "\nFROM {$vtable} v"
                    . "\nLEFT JOIN ?properties p ON p.property_id = v.property_id"
                    . "\nLEFT JOIN ?objects o ON o.object_id=v.object_id";
        else:
            $query .="\nFROM ?objects o";
        endif;
        
        static::$withConditions = false;
        if (!empty($objectId) || !empty($objectURI) || !empty($objectType)):
            $query .="\nWHERE";
            if (!empty($objectType)):
                $query .= "\to.object_type='{$objectType}'";
                static::$withConditions = TRUE;
            endif;
            if (!empty($objectURI)):
                $query .= (static::$withConditions) ? "\t AND" : "";
                $query .= "\to.object_uri='{$objectURI}'";
                static::$withConditions = TRUE;
            endif;
            if (!empty($objectId)):
                $query .= (static::$withConditions) ? "\t AND \t" : "";
                $query .= "\to.object_id='{$objectId}'";
                static::$withConditions = TRUE;
            endif;
        endif;
        
        return $query;
    }

    final public function bindPropertyData() {
        
    }
    
    /**
     * Saves an object to the EAV database
     * 
     * @param type $objectURI
     * @param type $objectType
     * @return boolean
     */
    final public function saveObject($objectURI = NULL, $objectType = NULL, $objectId = NULL) {

        //Get a randomstring for the objectURI
        $objectURI = empty($objectURI) ?  Framework::getRandomString(6) : $objectURI;
        $objectType =  empty($objectType) ?   'entity' : $objectType;
        //$objectId = empty($objectId) ?  (!empty($this->objectId) ? $this->objectId : null ) : $objectId;
        //Ensure we have all the properties
        if (empty($this->propertyModel) ||empty($this->propertyData))
            return false; //We have nothing to save
        //Use a transaction;
        $this->database->startTransaction();
        $pquery = "INSERT IGNORE INTO ?properties (property_name, property_label, property_datatype, property_charsize, property_default, property_indexed) VALUES\n";
        $pqueryV= array();
        foreach ($this->propertyModel as $property => $definition) {
            $values  = array($this->database->quote( $property), $this->database->quote($definition[0]), $this->database->quote($definition[1]) ); //Name, Label, DataType
            $values[]=(isset($definition[2]) )? $this->database->quote($definition[2]) : $this->database->quote(""); //Charsize
            $values[]=(isset($definition[3]) )? $this->database->quote($definition[3]) : $this->database->quote(""); //Default
            $values[]=(isset($definition[4]) && $definition[4] )? $this->database->quote(1) : $this->database->quote(0); //Indexed
    
            $pqueryV[] = " (" .implode(', ', $values)." )" ;
        }
        $pquery .= implode(', ', $pqueryV);
        
        //update the properties
        $this->database->query( $pquery );
        
        
        
        //If objectId is NULL then NEW Create new object
        if (empty($objectId)):
            
            Library\Log::_( "Object ID is ", $objectId );
        
            $timestamp = \Library\Date\Time::stamp();
            $oquery = $this->database->insert("?objects",array("object_uri" => $this->database->quote($objectURI), "object_type" => $this->database->quote($objectType), "object_created_on"=> $this->database->quote( $timestamp )), FALSE, NULL, FALSE);
            $this->database->query( $oquery );

            $this->setLastSavedObjectURI($objectURI);
        endif;

        //If property exists and value doesnt insert new value row
        //If property exists and value exists update value
        //if propert does not exists, insert property and insert value
        $vtable = "?{$this->valueGroup}property_values";
        
        $iquery = "REPLACE INTO {$vtable} (property_id, object_id, value_data)";
        $iqueryV= array();
        foreach ($this->propertyData as $propertyName=>$valueData):
            //@TODO validate the data?
            if(empty($valueData)) continue; //There is no point in storing empty values;
            //@TODO also check that value data has data for fields demarkated as allowempty=false;
            $iqueryV[] = "\nSELECT p.property_id, o.object_id, {$this->database->quote($valueData)}  FROM `?properties` AS p JOIN `?objects` AS o WHERE o.object_uri={$this->database->quote($objectURI)} AND p.property_name={$this->database->quote($propertyName)}" ;
        endforeach;
        $iquery .= implode("\nUNION ALL", $iqueryV);
        
        $this->database->query( $iquery );
        
        //Update the object URI so the last update field is auto updated
        //$this->database->exec( "UPDATE ?objects SET objected_updated_on=CURRENT_TIMESTAMP" WHERE object_uri=" );

        if (!$this->database->commitTransaction()) {
            static::setError($this->database->getError());
            return false;
        }
        return true;
    }

    /**
     * Returns the current data model
     * 
     * @return type
     */
    final public function getPropertyModel() {
        return $this->propertyModel;
    }
    
    
    /**
     * Returns the current data model values
     * 
     * @return type
     */
    final public function getPropertyData() {
        return $this->propertyData;
    }

    /**
     * Extends the parent data model
     * Allows the current object to use parent object properties
     * 
     * @param type $dataModel array(property_name=>array("label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>FALSE, "allowempty"=>FALSE))
     * 
     */
    final public function extendPropertyModel($dataModel = array(), $objectType = "object") {

        $this->propertyModel = array_merge($this->propertyModel, $dataModel);
        $this->setObjectType($objectType);

        return $this;
    }

    /**
     * Creates a completely new data model.
     * Any Properties not explicitly described for this object will be ignored
     * 
     * @param type $dataModel
     */
    final public function definePropertyModel($dataModel = array(), $objectType = "object") {

        $this->propertyModel = $dataModel;
        $this->setObjectType($objectType);

        return $this;
    }
    
    /**
     * Defines a sub table for value data;
     * 
     * @param type $valueGroup
     */
    final public function defineValueGroup( $valueGroup = NULL){
       $this->valueGroup    = !empty($valueGroup) ? trim( $valueGroup )."_" : NULL;
       //you must have this proxy table created at setup
    }
    
    /**
     * Returns the value group
     * 
     * @return string
     */
    final public function getValueGroup(){
        return $this->valueGroup;
    }

    /**
     * Pivot this entity into a sparse matrix
     * @return array associative array
     * 
     */
    public function display() {
        //@TODO: Renders the display data, as per other models
        return;
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