<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * media.php
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
 * Media stream object model
 *
 * In its simplest form, an media consists of an actor, a verb, an an object, 
 * and a target. It tells the story of a person performing an action on or with 
 * an object -- "Geraldine posted a photo to her album" or "John shared a video". 
 * In most cases these components will be explicit, but they may also be implied.
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Media extends Platform\Entity {

    /**
     * Static array of default system verbs
     * @var array 
     */
    static $_verbs = array(
        "post"
    );

    /**
     * The media stream model constructor. 
     * @return void
     */
    public function __construct() {

        parent::__construct();

        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel(array(
            "media_published" => array("Published", "datetime", 50),
            "media_content" => array("Content", "varchar", 1000),
            "media_summary" => array("Summary", "mediumtext", 50, NULL),
            "media_comment_status" => array("Allow Comments", "tinyint", 1, 0), //*
            "media_parent" => array("Parent", "smallint", 10, 0), //*
            "media_generator" => array("Generator", "mediumtext", 100),
            "media_provider" => array("Provider", "mediumtext", 100),
            "media_mentions" => array("Mentions", "varchar", 1000), //*
            "media_actor" => array("Actor", "varchar", 1000),
            "media_verb" => array("Verb", "mediumtext", 20, "post"),
            "media_geotags" => array("Geotags", "varchar", 1000), //*
            "media_object" => array("Object", "varchar", 1000),
            "media_target" => array("Target", "varchar", 1000),
            "media_permissions" => array("Permissions", "mediumtext", 50), //* //allo:{},deny:{}
                ), "media");

        $this->defineValueGroup("media");
    }

    /**
     * Gets a collection with a single item;
     * 
     * @param type $objectType
     * @param type $objectURI
     * @param type $objectId
     * @return type
     */
    public function getMedia($objectType = 'media', $objectURI = NULL, $objectId = NULL) {
        //An alias method for getall
        return $this->getAll($objectType, $objectURI, $objectId);
    }

    /**
     * Returns all the published media stories
     * @return array An array of media stream objects see {@link Media\Collecion}
     */
    public function getAll($objectType = 'media', $objectURI = NULL, $objectId = NULL) {

        //Get the object list of items which have no target for the timeline;
        //The timeline is for root objects only, any item with a target is the result of an interaction
        //For instance blah commented on itemtarget etc... and should be shown on a seperate activity feed
        $objects =  $this->setListLookUpConditions("media_target", "")->getMediaObjectsList($objectType, $objectURI, $objectId)->fetchAll();
        $items = array(); 

        //Parse the mediacollections;
        foreach ($objects as $object) {
            $object = $this->getActor($object, $object['media_actor']);
            //$object['media_object'] = $this->getObject($object['media_object'], $object['media_content']); //add to the collection
            $object['media_comment_target'] = $object['object_uri']; 
            //CleanUp
            foreach ($object as $key => $value):             
                $object[str_replace(array('media_', 'object_'), '', $key)] = $value;
                unset($object[$key]);
            endforeach;

            $items[] = $object;
        }
        $mediacollections = new Media\Collection;
        $mediacollections->set("items", $items); //update the collection
        $mediacollections->set("totalItems", count($items));

        $collection = $mediacollections::getArray();
        //print_r($collection);

        return $collection;
    }

    /**
     * Prepares and executes a database query for fetching media objects
     * @param interger $objectId
     * @param string $objectURI
     * @return object Database resultset
     */
    public function getMediaObjectsList($objectType = 'media', $objectURI = NULL, $objectId = NULL) {
        //Join Query
        //$objectType = 'media';
        $query = "SELECT o.object_id, o.object_uri, o.object_type, o.object_created_on, o.object_updated_on, o.object_status";
        //If we are querying for attributes
        $_properties = $this->getPropertyModel();
        $properties = array_keys((array) $_properties);

        $count = count($properties);
        if (!empty($properties) || $count < 1):
            //Loop through the attributes you need
            $i = 0;
            $query .= ",";
            foreach ($properties as $alias => $attribute):
                $alias = (is_int($alias)) ? $attribute : $alias;
                $query .= "\nMAX(IF(p.property_name = '{$attribute}', v.value_data, null)) AS {$alias}";
                if ($i + 1 < $count):
                    $query .= ",";
                    $i++;
                endif;
            endforeach;

            //Join the UserObjects Properties
            $_actorProperties = $this->load->model("profile", "member")->getPropertyModel();
            $actorProperties = array_diff(array_keys($_actorProperties), array("user_password", "user_api_key", "user_email"));
            $count = count($actorProperties);
            if (!empty($actorProperties) || $count < 1):
                $query .= ","; //after the last media property   
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
            $query .= "\nFROM ?media_property_values v"
                    . "\nLEFT JOIN ?properties p ON p.property_id = v.property_id"
                    . "\nLEFT JOIN ?objects o ON o.object_id=v.object_id"
                    //Join the UserObjects Properties tables on userid=actorid
                    . "\nLEFT JOIN ?objects q ON q.object_id=v.value_data AND p.property_name ='media_actor'"
                    . "\nLEFT JOIN ?user_property_values u ON u.object_id=q.object_id"
                    . "\nLEFT JOIN ?properties l ON l.property_id = u.property_id"
            ;

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
        $query .= $this->getListLookUpConditionsClause();
        $query .= $this->setListOrderBy(array("o.object_updated_on"), "DESC")->getListOrderByStatement();
        $query .= $this->getLimitClause();
        
        $total   = $this->getObjectsListCount($objectType, $properties, $objectURI, $objectId); //Count first
        $results = $this->database->prepare($query)->execute();
        
        //ALWAYS RESET;
        $this->resetListLookUpConditions();           
        $this->setListTotal( $total );

        return $results;
    }

    public function getActor($object, $actorId) {

        if (!is_array($object) || !isset($object['user_name_id']))
            return null;

        //2.0 THE ACTOR
        $actorObject = new Media\Object;
        $actorName = implode(' ', array($object['user_first_name'], $object['user_last_name']));
        $actorObject->set("objectType", "user"); //@TODO Not only User objects can be actors! You will need to be able to allow other apps to be actors
        $actorObject->set("displayName", $actorName);
        $actorObject->set("id", $actorId);
        $actorObject->set("uri", $object['user_name_id']);

        $actorImage = Media\MediaLink::getNew();
        $actorImageEntity = $this->load->model("attachments", "system")->loadObjectByURI($object['user_photo']);
        $actorImageURL = !empty($object['user_photo']) ? "/system/object/{$object['user_photo']}/resize/50/50" : "http://placeskull.com/50/50/999999";
        $actorImage->set("type", $actorImageEntity->getPropertyValue("attachment_type"));
        $actorImage->set("url", $actorImageURL);
        $actorImage->set("height", 50);
        $actorImage->set("width", 50);
        $actorObject->set("image", $actorImage::getArray());

        $object['media_actor'] = $actorObject::getArray();
        //Remove user model sensitive Data
        foreach (array_keys($this->load->model("user", "member")->getPropertyModel()) as $private):
            unset($object[$private]);
        endforeach;

        return $object;
    }

    /**
     * Wraps a media entity with accesorry data, like author, attachments, targets, etc...
     * 
     * @param type $object
     * @return type
     */
    public function getObject($objectURI, $string = NULL) {

        //1. getActor
        //Media Object;;
        //First get the nature of the media object;
        $subjectEntity = Platform\Entity::getInstance(); //An empty entity here because it is impossible to guess the properties of this object
        $mediaObject = $subjectEntity->loadObjectByURI($objectURI, array()); //Then we load the object    
        $mediaObjectURI = $mediaObject->getObjectURI();
        $object = NULL;

        if (!empty($mediaObjectURI)):
            //Create an media object, and fire an event asking callbacks to complete the media object
            $mediaSubject = new Media\Object;
            $mediaObjectType = $mediaObject->getObjectType();
            //Fire the event, passing the mediaSubject by reference
            //Although it looks stupid to need to find out the nature of the media subject before trigger
            //It actually provides an extra exclusion for callback so not all callbacks go to the database
            //so for instance if we found an media subject was a collection, callbacks can first check if the 
            //trigger is to model a collection before diving ing
            \Library\Event::trigger("onMediaSubjectModel", $mediaSubject, $mediaObjectType, $mediaObjectURI);
            //You never know what callbacks will do to your subject so we just check
            //that the media subject is what we think it is, i.e an media object

            if (is_object($mediaSubject) && method_exists($mediaSubject, "getArray")):
                $object = $mediaSubject::getArray(); //If it is then we can set the media object output vars
            endif;
        else:
            //If there no explicitly defined mediaObjects, in media_object
            //parse media_content for medialinks
            //Parse media targets medialinks
            //@todo;
            $mediaLinks = Media\MediaLink::parse($string);

        endif;
        
        return $object;
    }

    /**
     * Adds a new media object to the database
     * @return boolean Returns true on save, or false on failure
     */
    public function addMedia() {

        $inputModel = $this->getPropertyModel();
        //

        foreach ($inputModel as $property => $definition):
            $value = $this->input->getVar( $property );
            if (!empty($value)):
                $this->setPropertyValue($property, $value);
            endif;
        endforeach;

        //Allow some HTML in media content;
        $mediaContent = $this->input->getFormattedString("media_content","","post",true );
        
        $this->setPropertyValue("media_content", $mediaContent );
        
        //@TODO determine the user has permission to post;
        $this->setPropertyValue("media_actor", $this->user->get("user_id"));
        $this->setPropertyValue("media_published", \Library\Date\Time::stamp());

        //@TODO
        //Search for media link
        $targetObject = Media\Object::getInstance();
        $mediaLink = Media\MediaLink::getInstance();
        $mediaObject = null;

        //Look for attachedObjects;
        $attachments = $this->input->getArray("attachment");

        if (is_array($attachments) && !empty($attachments)) {
            if (sizeof($attachments) > 1) {
                //Create a collection and link to the object iD
                $collection = $this->load->model("collection", "system");
                $collection->setPropertyValue("collection_items", implode(',', $attachments));
                $collection->setPropertyValue("collection_size", count($attachments));
                $collection->setPropertyValue("collection_owner", $this->user->get("user_name_id"));
                //Should we add the media body to the collection description? there is really no need to, 
                //As every item will need to be described in details later
                if (!$collection->saveObject(null, "collection")) {
                    $this->setError("Could not save attached objects");
                    $mediaObject = NULL;
                }
                //If however we could save, then get the last saved object ID;
                $mediaObject = $collection->getLastSavedObjectURI();
                unset($collection); //destroys the collection object?       
            } else {
                $oneobject = reset($attachments); //Validate. String only
                $mediaObject = !$this->validate->alphaNumeric($oneobject) ? null : $oneobject; //Maybe a much harder validation
            }
            $this->setPropertyValue("media_object", $mediaObject);
        }

        //Determine the target
        if (!$this->saveObject(null, "media")) {
            //There is a problem! the error will be in $this->getError();
            return false;
        }
        return true;
    }

    /**
     * Get's an instance of the media model
     * @staticvar object $instance
     * @return object \Application\System\Models\Media 
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
     * @return void;
     */
    public function display() {
        var_dump($this->propertyData); //@TODO Temporary just for testing
    }

}

