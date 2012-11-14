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
        $this->definePropertyModel(array(
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
     * Adds a new activity object to the database
     * 
     * @return boolean Returns true on save, or false on failure
     */
    public function addActivity() {
        
        $inputModel = $this->getPropertyModel();
        //@TODO determine the user has permission to post;
        $this->setPropertyValue("activity_actor", $this->user->get("user_id"));
        $this->setPropertyValue("activity_published", \Library\Date\Time::stamp());
        
        foreach($inputModel as $property=>$definition):
            $value = $this->input->getVar($property );
            if(!empty($value)):
                $this->setPropertyValue($property, $value);
            endif;
        endforeach;
        
        if(!$this->saveObject()){
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

