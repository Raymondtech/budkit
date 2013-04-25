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

namespace Application\Member\Controllers;

/**
 * Profile parent CRUD action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Profile extends \Platform\Controller {

    public function __construct() {
        parent::__construct();
        $profile = $this->getMemberProfile();
        $this->set("profile", $profile);
        
    }

    /**
     * Displays the member profile
     * @todo Profile display
     * @return false;
     */
    public function index() {
        $view = $this->load->view('profile');
        $view->profilePage();
    }

    /**
     * Displays the profile timeline
     * @return @return false
     */
    public function timeline() {

        $this->output->setPageTitle(_("Timeline"));
        //Get the view;
        $model = $this->load->model('media', 'system');
        $activities = $model->getAll();

        $this->set("activities", $activities);
        //$this->set("dashboard", array("title" => "Activity stream"));

        $media = $this->output->layout("profile/timeline");
        $this->output->addToPosition("body", $media);

        return $this->index();
    }


    /**
     * Gets the Requested Profile 
     * 
     * @return object
     */
    protected function getMemberProfile() {

        $user = $this->get('user')->get("user_name_id"); //Get Platform user nameId
        $member = $this->input->getVar("member", "", $member);

        $model = $this->load->model("profile");
        $profile = $model->loadObjectByURI($member);
        $data = $profile->getPropertyData();

        //Determine the profile user's fullname
        $data['user_full_name'] = $model->getFullName(
                $profile->getPropertyValue("user_first_name"), 
                $profile->getPropertyValue("user_middle_name"), 
                $profile->getPropertyValue("user_last_name")
        );

        //Remove the userpassword;
        unset($data['user_password']);
        unset($data['user_api_key']);

        return (array) $data;
    }

    /**
     * Displays the profile's achievement
     * @return void
     */
    public function achievements() {
        echo "achievements";
        return $this->index();
    }

    /**
     * Displays the profile network graph
     * @return void
     */
    public function network() {
        echo "network";
        return $this->index();
    }

    /**
     * Returns an instance of the Profile action controller
     * @staticvar object $instance
     * @return object
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
