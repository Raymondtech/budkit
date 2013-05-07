<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * relation.php
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

namespace Application\Member\Controllers\Network;

use Application\Member\Controllers as Member;

/**
 * The Member Relationship action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Relation extends Member\Network {

    public function index() {
        parent::index();
    }

    public function suggestions() {

        return $this->index();
    }

    public function followers() {

        $view = $this->load->view("network");
        //Profile Information Title;
        $this->output->setPageTitle(sprintf(_("%s | Followers"), $this->user->get('user_full_name')));

        //Profile Model
        $relations = $this->load->model("relations", "member");
        $followers = $relations->getFollowers($this->user->get('user_name_id'));

        //print_r($following);  
        $followers['title'] = "Followers";
        if ($followers['totalItems'] > 0)
            $this->set("gallery", $followers);

        $members = $this->output->layout("members");
        $this->output->addToPosition("body", $members);

        $view->display();
    }

    public function following() {

        $view = $this->load->view("network");
        //Profile Information Title;
        $this->output->setPageTitle(sprintf(_("%s | Following"), $this->user->get('user_full_name')));

        //Profile Model
        $relations = $this->load->model("relations", "member");
        $followees = $relations->getFollowing($this->user->get('user_name_id'));
        //print_r($following); 
        $followees['title'] = "Following";
        if ($followees['totalItems'] > 0)
            $this->set("gallery", $followees);

        $members = $this->output->layout("members");
        $this->output->addToPosition("body", $members);

        $view->display();
    }

    public function request() {
        //Invites etc
        return $this->index();
    }

    /**
     * Follows a member
     * 
     * @param type $memberURI
     */
    public function follow($memberURI = NULL) {

        //Do we know who we are trying to follow?
        if (empty($memberURI) || $memberURI == $this->user->get('user_name_id')):
            $this->alert("Unable to determine the member to follow", "", "error");
            return $this->returnRequest();
        endif;

        $model = $this->load->model("relations");

        if (!$model->addFollow($this->user->get('user_name_id'), $memberURI)) {
            $this->alert("An error has occured and we were unable to follow @$memberURI", "", "error");
            return $this->returnRequest();
        }

        //Returns the request back tot the reffer;
        $this->alert(sprintf("You are now following @%s", $memberURI), "", "success");


        return $this->returnRequest();
    }

    public function unfollow($memberURI = NULL) {
        //Do we know who we are trying to follow?
        if (empty($memberURI)):
            $this->alert("Unable to determine the member to unfollow", "", "error");
            return $this->returnRequest();
        endif;

        if ($this->input->methodIs("post")) {
            $model = $this->load->model("relations");
        }
        //Returns the request back tot the reffer;
        $this->alert(sprintf("You are no longer following @%s", $memberURI), "", "success");


        return $this->returnRequest();
    }

    /**
     * Returns an instance of the Settings class
     * @staticvar objects $instance
     * @return object Settings
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
