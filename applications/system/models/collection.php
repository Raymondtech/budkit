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

namespace Application\System\Models;

use Platform;
use Library;

/**
 * Options management model
 *
 * Manages system options
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Collection extends Platform\Entity {

    public function __construct() {

        parent::__construct();
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel(
            array(
                "collection_title" => array("Collection Title", "mediumtext", 100),
                "collection_items" => array("Collection Items", "longtext", 2000),
                "collection_thumbnail" => array("Collection Thumbnail", "mediumtext", 200),
                "collection_size" => array("Collection Size", "smallint", 10),
                "collection_description" => array("Collection Description", "mediumtext", 200),
                "collection_tags" => array("Collection Tags", "mediumtext", 100),
                "collection_owner" => array("Collection Owner", "mediumtext", 100)
            ), "collection"
        );
        //$this->definePropertyModel( $dataModel ); use this to set a new data models or use extendPropertyModel to extend existing models
        //$this->defineValueGroup("attachment"); //Tell the system we are using a proxy table
    }
    
    /**
     * Default display method for every model 
     * @return boolean false
     */
    public function display() {
        return false;
    }
    
    /**
     * Models a collection activity object for activity feeds
     * 
     * @param type $activityObject
     * @param type $activityObjectType
     * @param type $activityObjectId
     * 
     * return void;
     */
    public static function activityObject(&$activityObject, $activityObjectType, $activityObjectURI){
        
        //If the activity object is not a collection! skip it
        $objectTypeshaystack = array("collection");
        $thisModel  = new self;
        if(!in_array($activityObjectType, $objectTypeshaystack)) return; //Nothing to do here if we can't deal with it!
            //1.Load the collection!
            $collection         = $thisModel->loadObjectByURI( $activityObjectURI );
            $collectionObject   = new Activity\Collection;
            //2.Get all the elements in the collection, limit 5 if more than 5
            
            //3.Trigger their timeline display
            $collectionObject->set("objectType", "collection"); 
            $collectionObject->set("uri", $collection->getObjectURI());
            
            //Now lets populate our collection with Items
            $collectionItems = $collection->getPropertyValue("collection_items");
            $collectionItemize = explode(",", $collectionItems);
            $collectionObject->set("totalItems", count($collectionItemize));
            
            if(is_array($collectionItemize)&&!empty($collectionItemize)){
                $items = array();
                foreach($collectionItemize as $item){
                    $itemObject = new Activity\MediaLink; 
                    //@TODO Will probably need to query for objectType of items in collection?
                    $itemObjectURL = !empty($item)?"/system/object/{$item}/":"http://placeskull.com/100/100/999999" ;
                    $itemObject->set("url", $itemObjectURL );
                    $itemObject->set("uri", $item );
                    $itemObject->set("height", null);
                    $itemObject->set("width", null);
                    $items[] = $itemObject::getArray();
                    unset($itemObject);
                }
                $collectionObject->set("items", $items);
            }
            //Now set the collection Object as the activity Object
            $activityObject = $collectionObject;
            
            unset($collection);
            unset($collectionObject);
            
            //All done
            return true;
    }

    /**
     * Get's an instance of the activity model
     * @staticvar object $instance
     * @return object \Application\System\Models\Options 
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

