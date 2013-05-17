<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * user.php
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

namespace Application\Member\Models;

/**
 * The User EAV model. 
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class User extends \Platform\Entity {

    public function __construct() {
        parent::__construct();
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->extendPropertyModel(
                array(
            "user_first_name" => array("First Name", "mediumtext", 50),
            "user_middle_name" => array("Middle Name", "mediumtext", 50),
            "user_last_name" => array("Last Name", "mediumtext", 50),
            "user_name_id" => array("Username", "mediumtext", 50),
            "user_password" => array("Password", "varchar", 2000),
            "user_api_key" => array("API Key", "varchar", 100),
            "user_email" => array("Email", "varchar", 100),
            "user_dob_day" => array("Day of Birth", "varchar", 10),
            "user_dob_month" => array("Month of Birth", "varchar", 10),
            "user_dob_year" => array("Year of Birth", "varchar", 10),
            "user_timezone" => array("Timezone", "varchar", 10),
            "user_locale" => array("Locale", "varchar", 10),
                    "user_verification"=> array("Verification Code", "varchar", 50)
                ), "user"
        );
        //$this->definePropertyModel( $dataModel ); use this to set a new data models
        $this->defineValueGroup("user"); //Tell the system we are using a proxy table
    }

    /**
     * Returns the full name of the loaded Profile
     * 
     * @param type $first The default First Name
     * @param type $middle The default Middle Name
     * @param type $last The default Last Name
     * @return type
     */
    public function getFullName($first = NULL, $middle = NULL, $last = NULL) {

        $user_first_name = $this->getPropertyValue("user_first_name");
        $user_middle_name = $this->getPropertyValue("user_middle_name");
        $user_last_name = $this->getPropertyValue("user_last_name");
        $user_full_name = implode(' ', array(empty($user_first_name) ? $first : $user_first_name, empty($user_middle_name) ? $middle : $user_middle_name, empty($user_last_name)?$last:$user_last_name ));

        if (!empty($user_full_name)) {
            return $user_full_name;
        }
    }
    
    /**
     * Updates the user profile data
     * 
     * @param type $username
     * @param type $data
     */
    public function update($usernameId, $data = array()) {

        if (empty($usernameId))
            return false;

        $existing = (array) $this->getPropertyData();
        $data = empty($data) ? $existing : array_merge($data, $existing);

        //Load the username; 
        $profile = $this->loadObjectByURI($usernameId, array_keys($this->getPropertyModel()));
        $this->setObjectId($profile->getObjectId());
        $this->setObjectURI($profile->getObjectURI());

        $profileData = $profile->getPropertyData();

        $updatedProfile = array_merge($profileData, $data);
        foreach ($updatedProfile as $property => $value):
            $this->setPropertyValue($property, $value);
        endforeach;
        $data = $this->getPropertyData();
        $this->defineValueGroup("user");
        //die;
        if (!$this->saveObject($this->getPropertyValue("user_name_id"), "user", $this->getObjectId())) {
            //Null because the system can autogenerate an ID for this attachment    
            $profile->setError("Could not save the profile data");
            return false;
        }

        return true;
    }

    /**
     * Store the user data in the database
     * 
     * @param array $data
     * @return boolean
     * @throws \Platform\Exception 
     */
    public function store($data) {

        $encrypt = \Library\Encrypt::getInstance();
        $authority = $this->config->getParam("site-default-authority", NULL);

        $data['user_password'] = $encrypt->hash($data['user_password']);

        foreach ($data as $property => $value):
            $this->setPropertyValue($property, $value);
        endforeach;

        if (!$this->saveObject($this->getPropertyValue("user_name_id"), "user")) {
            //There is a problem!
            return false;
        }
        //Default Permission Group?
        if (!empty($authority)) {
            $query = "INSERT INTO ?objects_authority( authority_id, object_id ) SELECT {$this->database->quote((int) $authority)}, object_id FROM ?objects WHERE object_uri={$this->database->quote($this->getPropertyValue("user_name_id"))}";
            $this->database->exec($query);
        }


        return true;
    }

    /**
     * Returns a user datastore row
     * @todo User EAV model load
     * @return void
     */
    public function load() {
        
    }

    /**
     * Deletes a user record from the datastore
     * @todo User delete
     * @return void
     */
    public function delete() {
        
    }

    /**
     * Validates user data before store
     * @todo User data validate
     * @return void
     */
    public function validate() {
        
    }

    /**
     * Returns an instance of the user EAV model
     * @staticvar object $instance
     * @return object User
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

