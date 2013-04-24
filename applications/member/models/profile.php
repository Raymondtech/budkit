<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * profile.php
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
 * The profile EAV model. Extends the User model
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Profile extends User {

    /**
     * Constructs the Profile Object model
     * @return void
     */
    public function __construct() {

        parent::__construct();
        //Extend the User Object Model
        $this->extendPropertyModel(array(
            "user_photo" => array("Profile Photo", "mediumtext", 10),
            "user_biography" => array("Background and Biography", "text", 500),
            "user_headline" => array("Headline", "mediumtext", 100),
            "user_website" => array("Website URL", "mediumtext", 100)
        ), "user");
        $this->defineValueGroup("user");
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
        
        $existing   = (array)$this->getPropertyData();
        $data       = empty($data)? $existing: array_merge($data, $existing);
        
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
     * Returns an instance of the profile object model
     * 
     * @staticvar object $instance
     * @return object Profile
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

