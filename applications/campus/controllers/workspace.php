<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * workspace.php
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

namespace Application\Campus\Controllers;

use Platform;

/**
 * Workspace CRUD action controller for Campus 
 *
 * The workspace class implements the action controller that manages the creation, 
 * view and edit of workspaces within the campus application.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Workspace extends Platform\Controller {

    public function __construct() {
        parent::__construct();

        $this->model = $this->load->model('workspace');
        $this->view = $this->load->view('workspace');

        $_workspace = $this->input->getVar("workspace", '');
        
        if (!empty($_workspace)):
            $workspace = $this->model->loadObjectByURI($_workspace);
            $this->output->setPageTitle($workspace->getPropertyValue('workspace_name'));

            $workspace_ = $workspace->getPropertyData();
            $this->output->set('workspace', $workspace_);
        endif;
    }

    public function index() {
        return $this->directory();
    }

    public function overview() {


        \Library\Event::trigger('beforeWorkspaceOverviewDisplay', $this);

        $today = $this->output->layout("workspace/overview");
        $this->output->addToPosition("dashboard", $today);

        //$view->display();      
        //$this->output();

        return $this->view->display();
    }

    public function people() {
        return $this->load->view('workspace')->display();
    }

    public function time() {
        return $this->load->view('workspace')->display();
    }

    public function survey() {
        return $this->load->view('workspace')->display();
    }

    /**
     * The default fallback method. 
     * @return  void
     */
    public function directory() {
        $this->output->setPageTitle(_("Workspaces"));
        $model = $this->load->model("workspace", "campus"); //This will change of project but for now
        $workspaces = $model->getObjectsList("workspace");
        $items = array();
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $workspaces->fetchAssoc()) {
            $items["items"][] = $row;
        }

        //print_R($items);

        $this->set("workspaces", $items);

        $directory = $this->output->layout("workspaces");
        $this->output->addToPosition("dashboard", $directory);

        $this->load->view('workspace')->directory();
    }

    /**
     * Creates a new workspace
     * @return void
     */
    public function create() {

        $this->view = $this->load->view("workspace");
        $this->model = $this->load->model("workspace");

        $this->output->setPageTitle(_("New Workspace"));

        //Save New workspace;
        if ($this->input->methodIs("post")) {

            //If a file has been submitted for profile photo, save that first
            $attachmentfile = $this->input->data("files");
            if (!empty($attachmentfile['workspace_coverphoto']['size'])):
                //Do we have a file?
                $attachment = $this->load->model("attachments", "system");
                $attachment->setAllowedTypes(array("gif" => '', "jpeg" => '', "jpg" => '', "png" => ''));
                $attachment->setOwnerNameId($this->user->get("user_name_id"));

                $attachment->store($attachmentfile['workspace_coverphoto']);
                //Now store the worrkspace photo to the database;
                $attachmentUri = $attachment->getLastSavedObjectURI();
            endif;

            //validate workspace info;
            $name = $this->input->getString('workspace_name');
            $privacy = $this->input->getString('workspace_privacy');
            $shortDescr = $this->input->getString('workspace_short_descr');
            $longDescr = $this->input->getFormattedString("workspace_long_descr", "", "post", true);

            if (empty($name) || empty($privacy) || empty($shortDescr)):
                $this->alert("Incomplete workspace data recieved, Please complete the required fields(*)", '', 'error');
                $this->redirect($this->input->getReferer());
                return false; //useless
            endif;

            $this->model->setPropertyValue("workspace_creator", $this->user->get('user_name_id'));
            $this->model->setPropertyValue("workspace_name", $name);
            $this->model->setPropertyValue("workspace_privacy", $privacy);
            $this->model->setPropertyValue("workspace_short_descr", $shortDescr);

            if (!empty($attachmentUri))
                $this->model->setPropertyValue("workspace_cover_photo", $attachmentUri);

            //set the data;
            if (!empty($longDescr))
                $this->model->setPropertyValue("workspace_long_descr", $longDescr);

            //Save the message
            if (!$this->model->saveObject(null, "workspace")) {
                return $this->returnRequest("The workspace could not be created, an error occured", "error");
            }
            //Now store the worrkspace photo to the database;
            $workspaceUri = $this->model->getLastSavedObjectURI();
            if (!empty($workspaceUri)) {
                $this->alert("Welcome to your new workspace", '', 'success');
                $workspaceUrl = "/campus/workspace:{$workspaceUri}/workspace/overview/";
                $this->redirect($workspaceUrl);
                return true; //useless
            }
        }

        $this->view->editor(
            array("id" => "workspace", "title" => "Status", "layout" => "forms/workspace", "icon-class" => "icon-lightbulb")
        );
        $layout = $this->output->layout('forms/form', 'system');
        $this->output->addToPosition("dashboard", $layout);

        $this->view->directory();
    }

    /**
     * Get's an instance of the Workspace controller only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Workspace}
     * 
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
