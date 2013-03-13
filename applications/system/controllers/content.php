<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * content.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\System\Controllers;

/**
 * The parent action controller for all system content types
 *
 * Defines common action methods for the managing the default system content types
 * It is important that you inherit the key features defined in this class
 * when defining content types
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
Class Content extends \Platform\Controller {

    /**
     * The default fall back method. Probably overwritten in child classes
     * @return boolean false 
     */
    public function index() {
        return false;
    }

    public function create($action = "") {
        
        //create action types
        $actions = array(
            "drop" , "snap" , "text" , "import"
        );
        //form
        $_form  = !in_array($action, $actions) ? "drop" : $action ;
        $form   = $this->output->layout("content/form/{$_form}");

        $this->output->addToPosition("dashboard", $form);
        $this->output->setPageTitle(_("Add New Content"));
        
        $this->load->view('index')->display(); //sample call;   
        //$this->output->addToPosition("right", $right );
    }

    /**
     * Returns an instance of the content controller
     * @staticvar self $instance
     * @return Content 
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

