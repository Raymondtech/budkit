<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * project.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\Campus\Views;

/**
 * Workspace Sub View class
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * ˙
 */
final class Course extends \Platform\View {

    public function directory() {

        $dashboard = $this->output->layout("dashboard", "system");
        //$rightaside     = $this->output->layout( "cpanel"  );
        // $this->output->addMenuGroupToPosition("side", "dashboardmenu");
        $this->output->addToPosition("body", $dashboard);
    }

    /**
     * Workspace view display
     * @return void
     */
    public function display() {

        //To specify a layout, else default will be used
        //$this->setLayout("page");
        //To get a previously set property;
        //echo $this->get("user2");
        //TODO only set if not already set To set the pate title use
        //$this->output->setPageTitle("Welcome to diddat");
        //to add some js file
        //$this->output->addScript("some.js");
        //to add some js file
        //$this->output->addStyle("some.css");
        //to output just the layout use
        //$this->output->raw();
        //to output just the xml use
        //$this->output->xml();
        //to output as json use
        //$this->output->json();
        //parse Layout Demo;
        //$sidebar      = $this->output->layout( "index_sidebar" );
        $dashboard = $this->output->layout("dashboard", "system");

        //$rightaside     = $this->output->layout( "cpanel"  );
        $this->output->addMenuGroupToPosition("aside", "coursemenu", "nav-list", array(), false, false);
        //$this->output->addMenuGroupToPosition("side", "dashboardmenu");

        $this->output->addToPosition("body", $dashboard);
    }

    /**
     * Gets an instance of the workspace class
     * @staticvar object $instance
     * @return object Workspace
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

