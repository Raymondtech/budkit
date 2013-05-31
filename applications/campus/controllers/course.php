<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * course.php
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
class Course extends Platform\Controller {

    public function __construct() {
        
        parent::__construct();

        $this->model = $this->load->model('workspace');
        $this->view = $this->load->view('course');

        $_course = $this->input->getVar("course", '');

        if (!empty($_course)):
            $course = $this->model->loadObjectByURI($_course);
            $this->output->setPageTitle($course->getPropertyValue('workspace_name'));

            $course_ = $course->getPropertyData();
            $this->output->set('course', $course_);
        endif;
    }

    public function index() {
        return $this->directory();
    }

    public function overview() {

        \Library\Event::trigger('beforeCourseOverviewDisplay', $this);

        $today = $this->output->layout("course/overview");
        
        $this->output->addToPosition("dashboard", $today);

        //$view->display();      
        //$this->output();
        //If not enrolled, do not show aside menu
        //return $this->load->view('index', 'system')->dashboard();

        return $this->view->display(false); //if not registered, show false;
    }

    public function people() {
        return $this->load->view('course')->display();
    }

    public function tasks() {
        return $this->load->view('course')->display();
    }

    public function timeline() {
        return $this->load->view('course')->display();
    }

    public function portfolio() {
        return $this->load->view('course')->display();
    }

    /**
     * The default fallback method. 
     * @return  void
     */
    public function directory() {

        $this->output->setPageTitle(_("Courses"));
        $model = $this->load->model("workspace", "campus"); //This will change of project but for now
        $workspaces = $model->getObjectsList("workspace");
        $items = array();
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $workspaces->fetchAssoc()) {
            $row['workspace_cover_photo'] = "/system/object/{$row['workspace_cover_photo']}";
            $items["items"][] = $row;
        }

        //print_R($items);

        $this->set("workspaces", $items);

        $directory = $this->output->layout("courses");
        $this->output->addToPosition("dashboard", $directory);

        $this->load->view('workspace')->directory();
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
