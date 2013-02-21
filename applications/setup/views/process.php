<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * process.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */
namespace Application\Setup\Views;
use Platform;

/**
 * Install process views
 *
 * Provides additional methods for managing installation views. 
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Process extends Platform\View {

    /**
     * Constructs the install view class
     * @return void
     */
    public function __construct() {
        parent::__construct();
        //To set the pate title use
        //$this->output->setPageTitle("Setup");
        $this->output->setLayout("canvas");
    }

    /**
     * The default install view
     * @return void
     */
    public function display() {
        return $this->index();
    }

    /**
     * The default installation page view i.e step1
     * @return  void
     */
    public function index() {

        //To specify a layout, else default will be used
        //$this->setLayout("page");
        //To get a previously set property;
        //echo $this->get("user2");
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
        $form = $this->output->layout("form");

        //The default installation box;
        $this->output->addToPosition("body", $form);
    }
    
    /**
     * Displays a readme at the end of the installation process
     * @return void
     */
    public function readme(){
        
        //Displays the readme file after installation
        $readme = $this->output->layout("readme");
        $this->output->addToPosition("body", $readme );
        
    }
    
    /**
     * Returns an instance of the installation process view
     * @staticvar object $instance
     * @return object Process
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