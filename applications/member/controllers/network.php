<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * group.php
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
 * Group CRUD action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Network extends \Platform\Controller {

    /**
     * The default group action
     * @return boolean
     */
    public function index() {
               
        return $this->directory();
    }

    
    /**
     * Displays the member network
     * 
     * @return void;
     */
    public function directory() {
        
        $this->output->setPageTitle(_("Members"));
        
        $view  = $this->load->view("network");
        $model = $this->load->model("profile", "member");

        $users = $model->setListOrderBy("o.object_created_on", "DESC")->getObjectsList("user");
        $model->setPagination(); //Set the pagination vars
        $items = array("totalItems" => 0,"title"=>"Members");
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $users->fetchAssoc()) {
            $row['user_url'] = "/system/object/{$row['object_uri']}";
            $items["members"][] = $row;
            $items["totalItems"]++;
        }
        if($items['totalItems']>0)  $this->set("gallery", $items);

        $gallery = $this->output->layout("members");
        $this->output->addToPosition("body", $gallery);

        $view->display();
    }

    /**
     * Returns an instance of the Group CRUD action conroller
     * @staticvar object $instance
     * @return object Group
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
