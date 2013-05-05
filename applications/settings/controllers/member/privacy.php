<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * privacy.php
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
 * The sub actions controller for privacy settings
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Privacy extends Settings\Member {

    /**
     * Displays the privacy settings form
     * @return void
     */
    public function index() {

        $view = $this->load->view('member');

        return $view->form("member/privacy", "Privacy settings");
    }

    /**
     * Privacy Lists
     */
    public function groups($edit = null) {

        $view = $this->load->view('member');
        $params = $this->getRequestArgs();

        //1. Load the model
        $group = $this->load->model("groups");

        //2. If we are editing the authority, save
        if ($this->input->methodIs("post")):
            if (!$group->store($edit, $params)) {
                $errors = $this->getErrorString();
                $this->alert($errors, null, "error");
            } $this->alert(_("Changes to your privacy groups have been saved successfully"), "", "success");
            $this->redirect($this->output->link("/settings/member/privacy/groups"));
        endif;

        //3. Get the authorities list
        $groups = $group->getGroups();
        if (!empty($groups)): //If we have privacy groups
            $this->set("groups", $groups);
        endif;

        return $view->form("member/groups", "Privacy Groups");
    }

    /**
     * Privacy Lists
     */
    public function group() {
        $view = $this->load->view('member');
        return $view->form("member/privacy", "Privacy lists");
    }

    public function update() {

        if ($this->input->methodIs("post")) {

            $message = "Your privacy preferences have now been updated";
            $messageType = "success";

            //If we can get profile data
            //Get the data;
            if (($data = $this->input->getArray("privacy", array(), "post") ) == FALSE) {
                $this->alert("No input data recieved", 'Something went wrong', 'error');
                $this->redirect($this->input->getReferer());
                return false; //useless
            }

            //Set the data;
            if (is_array($data) && !empty($data)):
                foreach ($data as $key => $value):
                    //@TODO is this a save way to do this?
                    //Where does the validation happen?
                    $this->config->setParam($key, $value, "privacy");
                endforeach;
            endif;

            //preference model
            $preferences = $this->load->model("preferences", "settings");
            if (!$preferences->save("privacy")) {
                $message = "Could not update your privacy settings";
                $messageType = "error";
            }
        }
        //die;
        $this->alert($message, "", $messageType);
        return $this->returnRequest();
    }

    /**
     * Returns an instance of the privacy settings action class
     * @staticvar object $instance
     * @return object Privacy
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
