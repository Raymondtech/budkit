<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * admin.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */
namespace Application\System\Views;
use Platform;

/**
 * Admin view parent class
 *
 * Provides additional methods for managing administrative panel views. 
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Admin extends Platform\View {

    /**
     * Admin view constructor
     * @return void
     */
    public function __construct() {

        parent::__construct();
        
        //To set the pate title use
        $this->output->setPageTitle("Dashboard");
        $sidebar  = $this->output->layout("adminbar");
        
        $this->output->addToPosition("side", $sidebar);
        
        //Draw the table at the end when all the parameters have been entered!
        //register_shutdown_function( array('Application\System\Views\Admin' , 'drawAdminPage'));
        //\Library\Event::register("onShutdown", "Application\System\Views\Admin::drawAdminPage" );
      
    }
    

    /**
     * The admin dashboard master table & widgetboard
     * @return void
     */
    public static function drawAdminPage() {

        $output = Library\Output::getInstance();
        $router = \Library\Router::getInstance();
        
        //The default installation box;
        //$toolbar = $output->layout("admin_toolbar");
        //$board = $output->layout("admin", "system");
        //Add admin Toolbar
        //$output->addToPosition('topsection', $toolbar);
        //$output->addToPosition('body', $board);
        
        //because this method runs at shutdown, it overwrites the output format
        //so json and others will always return raw, which is not what we want
        //therefore we lock these formats and prevent them from being overidden
        $format = $router->getFormat();
        $lock   = array("json","pdf","xml"); 
        
        if(!in_array($format, $lock)){ $output->setFormat("raw"); }
                      
        //$output->setFormat("raw");
        $output->setLayout("admin");
        
    }

    /**
     * The default page view method. Displays an admin page
     * @return void
     */
    public function display() {

        //To specify a layout, else default will be used
        //$this->setLayout("page");
        //To get a previously set property;
        //echo $this->get("user2");
        //To set the pate title use
        $this->output->setPageTitle("Welcome to diddat");

        //to add some js file
        $this->output->addScript("some.js");

        //to add some js file
        $this->output->addStyle("some.css");

        //to output just the layout use
        //$this->output->raw();
        //to output just the xml use
        //$this->output->xml();
        //to output as json use
        //$this->output->json();
        //parse Layout Demo;
        //$sidebar    = $this->output->layout( "index_sidebar" );
        $dashboard = $this->output->layout("index");
        // $sideroll   = $this->output->layout( "dashroll"  );
        //The default installation box;
        $this->output->addToPosition("left", $sidebar);
        $this->output->addToPosition("right", $sideroll);
        $this->output->addToPosition("body", $dashboard);
    }

    /**
     * Returns an instance of the admin view class
     * @staticvar object $instance
     * @return object Admin
     */
    final static function getInstance() {
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;
        $instance = new self();
        return $instance;
    }
}