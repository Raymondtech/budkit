<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * start.php
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

namespace Application\System\Controllers;

/**
 * Start Controller
 *
 * This class implements the actions required for displaying system start pages 
 * including the dashboard and frontpages.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Start extends \Platform\Controller {

    /**
     * Displays the dashboard, 
     * @ return void;
     */
    public function index() {
  
        $view = $this->load->view('index') ;        
        $this->output->setPageTitle(_("Dashboard"));

        $model = $this->load->model("attachments", "system");
        $attachments = $model->setListLookUpConditions("attachment_owner", $this->user->get("user_name_id"))
                ->setListOrderBy("o.object_created_on", "DESC")
                ->setListLimit(10)
                ->getObjectsList("attachment");
        $items = array("totalItems" => 0);
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $attachments->fetchAssoc()) {
            $row['attachment_url'] = "/system/object/{$row['object_uri']}";
            $items["items"][] = $row;
            $items["totalItems"]++;
        }
        if ((int)$items["totalItems"] > 0) $this->set("gallery", $items);
        $gallery = $this->output->layout("media/gallery/widget");
        
        $this->output->set("widget", array(
            "title"=>"Recent Documents",
            "body" =>$gallery,
            "footer"=>'<a href="'.\Library\Uri::internal("/system/media/attachments/gallery").'">View Documents</a>'
        ));
        $widget = $this->output->layout("widget");
        
        \Library\Event::trigger('beforeDashboardDisplay', $this);
        
        $this->output->addToPosition("dashwidgets", $widget);
        $today = $this->output->layout("start");
        
        $this->output->addToPosition("dashboard", $today);
        $this->load->view("index")->display();      
        //$this->output();
    }
   

    /**
     * Returns and instantiated Instance of the __CLASS__ class
     * 
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     * 
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance 
     * @return object __CLASS__
     */
    public static function getInstance() {

        $class = __CLASS__;

        if (is_object(static::$instance) && is_a(static::$instance, $class))
            return static::$instance;

        static::$instance = new $class;

        return static::$instance;
    }
}

