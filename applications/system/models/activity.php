<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * activity.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Application\System\Models;

use Platform;
use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Model
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/controller
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Activity extends Platform\Entity {

    static $_verbs = array(
        "post"
    );

    public function __construct() {

        parent::__construct();

        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel( array(
            "activity_published" => array("Published", "datetime", 50),
            "activity_content" => array("Content", "varchar", 1000),
            "activity_summary" => array("Summary", "mediumtext", 50, NULL),
            "activity_comment_status" => array("Allow Comments", "tinyint", 1, 0), //*
            "activity_parent" => array("Parent", "smallint", 10, 0), //*
            "activity_generator" => array("Generator", "mediumtext", 100),
            "activity_provider" => array("Provider", "mediumtext", 100),
            "activity_mentions" => array("Mentions", "varchar", 1000), //*
            "activity_actor" => array("Actor", "varchar", 1000),
            "activity_verb" => array("Verb", "mediumtext", 20, "post"),
            "activity_geotags" => array("Geotags", "varchar", 1000), //*
            "activity_object" => array("Object", "varchar", 1000),
            "activity_target" => array("Target", "varchar", 1000),
            "activity_permissions" => array("Permissions", "mediumtext", 50), //* //allo:{},deny:{}
        ), "activity");

        $this->defineValueGroup("activity");
    }

    /**
     * Returns all the published activity stories
     * 
     * @return type
     */
    public function getAll() {
        
        //Get the object list
        $objects = $this->getActivityObjectsList()->fetchAll();
        $activities = Activity\Collection::getInstance();
        

        //Parse the activities;
        foreach ($objects as $object) {

            //1. Collections
            //2.0 THE ACTOR
            $actorObject = Activity\Object::getInstance();
            $actorName   = implode(' ', array($object['user_first_name'], $object['user_last_name']) );
            $actorObject->set("objectType", "user"); //@TODO Not only User objects can be actors! You will need to be able to allow other apps to be actors
            $actorObject->set("displayName", $actorName ); 
            $actorObject->set("id", $object['activity_actor']);
            $actorObject->set("uri", $object['user_name_id']);
            
            $actorImage  = Activity\MediaLink::getInstance();
            $actorImage->set("url", "http://placeskull.com/50/50/2554C7");
            $actorImage->set("height", 48);
            $actorImage->set("width", 48);
            $actorObject->set("image", $actorImage::getArray());

            $object['activity_actor'] =  $actorObject::getArray();
            //Remove user model sensitive Data
            foreach( array_keys( $this->load->model("user","member")->getPropertyModel() ) as $private ):
                unset($object[$private]);
            endforeach;
            
            //CleanUp
            foreach( $object as $key=>$value):
                    $object[str_replace(array('activity_','object_'), '', $key)] = $value;
                    unset($object[$key]);
            endforeach;
            
            $items      = $activities->get("items", array());
            $items[]    = $object;
            
            //print_R($items);
            
            $activities->set("items", $items);
            $activities->set("totalItems", count($items) );
            
        }
        $collection = $activities::getArray();
        
        return $collection;
    }

    public function getActivityObjectsList($objectId = NULL, $objectURI = NULL) {
        //Join Query
        $objectType = 'activity';
        $query = "SELECT o.object_id, o.object_uri, o.object_type,";
        //If we are querying for attributes
        $_properties = $this->getPropertyModel();
        $properties = array_keys((array) $_properties);
        
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

            //Join the UserObjects Properties
            $_actorProperties = $this->load->model("user", "member")->getPropertyModel();
            $actorProperties = array_diff(array_keys($_actorProperties), array("user_password", "user_api_key", "user_email"));
            $count = count($actorProperties);
            if (!empty($actorProperties) || $count < 1):
                $query .= ","; //after the last activity property   
                $i = 0;
                foreach ($actorProperties as $alias => $attribute):
                    $alias = (is_int($alias)) ? $attribute : $alias;
                    $query .= "\nMAX(IF(l.property_name = '{$attribute}', u.value_data, null)) AS {$alias}";
                    if ($i + 1 < $count):
                        $query .= ",";
                        $i++;
                    endif;
                endforeach;
            endif;

            //The data Joins
            $query .= "\nFROM ?activity_property_values v"
            . "\nLEFT JOIN ?properties p ON p.property_id = v.property_id"
            . "\nLEFT JOIN ?objects o ON o.object_id=v.object_id"

            //Join the UserObjects Properties tables on userid=actorid
            . "\nLEFT JOIN ?objects q ON q.object_id=v.value_data AND p.property_name ='activity_actor'"
            . "\nLEFT JOIN ?user_property_values u ON u.object_id=q.object_id"
            . "\nLEFT JOIN ?properties l ON l.property_id = u.property_id";

        else:
            $query .="\nFROM ?objetcs";
        endif;

        $withConditions = false;

        if (!empty($objectId) || !empty($objectURI) || !empty($objectType)):
            $query .="\nWHERE";
            if (!empty($objectType)):
                $query .= "\to.object_type='{$objectType}'";
                $withConditions = TRUE;
            endif;
            if (!empty($objectURI)):
                $query .= ($withConditions) ? "\t AND" : "";
                $query .= "\to.object_uri='{$objectURI}'";
                $withConditions = TRUE;
            endif;
            if (!empty($objectId)):
                $query .= ($withConditions) ? "\t AND \t" : "";
                $query .= "\to.object_id='{$objectId}'";
                $withConditions = TRUE;
            endif;
        endif;

        $query .="\nGROUP BY o.object_id";
        $query .= $this->setListOrderBy(array("o.object_updated_on"), "DESC")->getListOrderByStatement();

        return $this->database->prepare($query)->execute();
    }

    /**
     * Adds a new activity object to the database
     * 
     * @return boolean Returns true on save, or false on failure
     */
    public function addActivity() {

        $inputModel = $this->getPropertyModel();
        //

        foreach ($inputModel as $property => $definition):
            $value = $this->input->getVar($property);
            if (!empty($value)):
                $this->setPropertyValue($property, $value);
            endif;
        endforeach;

        //@TODO determine the user has permission to post;
        $this->setPropertyValue("activity_actor", $this->user->get("user_id"));
        $this->setPropertyValue("activity_published", \Library\Date\Time::stamp());


        //Search for media link
        $targetObject = Activity\Object::getInstance();
        $mediaLink = Activity\MediaLink::getInstance();

        //Determine the target

        if (!$this->saveObject()) {
            //There is a problem! the error will be in $this->getError();
            return false;
        }
        return true;
    }

    /**
     * Get's an instance of the activity model
     * 
     * @staticvar self $instance
     * @return \Application\System\Models\self 
     */
    public static function getInstance() {

        static $instance;

        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self;

        return $instance;
    }

    /**
     * Default display method for every model 
     */
    public function display() {
        var_dump($this->propertyData); //@TODO Temporary just for testing
    }

}

