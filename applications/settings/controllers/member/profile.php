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

namespace Application\Settings\Controllers\Member;

use \Application\Settings\Controllers as Settings;

/**
 * The sub actions controller for managing profile settings
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Profile extends Settings\Member {

    /**
     * Displays the user profile settings
     * @return void
     */
    public function index() {

        $user = \Platform\User::getInstance();

        $view = $this->load->view('member');
        $profile = $this->load->model('profile', 'member');
        $profile = $profile->loadObjectByURI( $user->get("user_name_id"), array_keys($profile->getPropertyModel()));

        $data = $profile->getPropertyData();

        $this->set("profile", $data); //Sets the profile data;

        return $view->form("member/profile", "Profile settings");
    }

    /**
     * Updates a user profile
     * @return type
     */
    public function update() {

        //Get the platform user and ensure that they 
        //are who they say they are
        //$user = \Platform\User::getInstance();
        //Check that form was submitted with the POST method
        if ($this->input->methodIs("post")) {

            $message = "Your profile settings have now been updated";
            $messageType = "success";
            
            //If a file has been submitted for profile photo, save that first
            $attachmentfile = $this->input->data("files");
                if(!empty($attachmentfile['profilephoto']['size'])):

                //Do we have a file?
                $attachment = $this->load->model("attachments", "system");
                $attachment->setAllowedTypes(array("gif", "jpeg", "jpg", "png"));
                $attachment->setOwnerNameId($this->user->get("user_name_id"));

                $attachment->store($attachmentfile['profilephoto']);

                //Now store the users photo to the database;
                $attachmentURI = $attachment->getLastSavedObjectURI();
            endif;

            //unset($attachment);
            $profile = $this->load->model('profile', "member");

            //If we can get profile data
            //Get the data;
            if (($data = $this->input->getArray("profile", array(), "post") ) == FALSE) {
                $this->alert("No input data recieved", 'Something went wrong', 'error');
                $this->redirect( $this->input->getReferer() );
                return false; //useless
            }
            
            //Set the data;
            if(is_array($data)&&!empty($data)):
                foreach($data as $key=>$value):
                    //@TODO is this a save way to do this?
                    //Where does the validation happen?
                    $profile->setPropertyValue($key, $value);
                endforeach;
            endif;

            //Save the attachment
            if (!empty($attachmentURI)) {
                //echo $attachmentURI;
                $profile->setPropertyValue("user_photo", $attachmentURI);
            }
            if (!$profile->update($this->user->get("user_name_id"))) {
                $message = "Could not update your profile photo";
                $messageType = "error";
            }
        }

        //die;
        $this->alert($message, "", $messageType);

        //die;
        //Return the user back to the profile update form
        return $this->redirect("/settings/member/profile");
    }

    /**
     * Returns an instance of the profile settings sub action controller
     * @staticvar object $instance
     * @return object Profile
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
