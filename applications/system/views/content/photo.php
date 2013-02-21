<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * photo.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\System\Views\Content;
use \Application\System\Views;

/**
 * Photo Sub View class
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Photo extends Views\Content {

    /**
     * Constructs the photo subview class
     * @return void
     */
    public function __construct() {
        //Construct the parent
        parent::__construct();
        $this->output->setPageTitle("Photos");
    }

    /**
     * Photo view display
     * @return void
     */
    public function display() {
        //parse Layout Demo;
        //$sidebar      = $this->output->layout( "index_sidebar" );
        $dashboard = $this->output->layout("dashboard", "system");
        $sidebar = $this->output->layout("sidebar", "system");

        $this->output->addToPosition("side", $sidebar);
        $this->output->addToPosition("body", $dashboard);
    }

    /**
     * Displays the Photo upload form
     * @return boolean
     */
    public function createform() {
        //Photo
        $this->output->setPageTitle("Photos | Upload more photos");

        $form = $this->output->layout("photos/form");
        $this->output->addToPosition("dashboard", $form);

        return $this->display();
    }

    /**
     * Returns an instance of the photo subview class
     * @staticvar object $instance
     * @return object Photo
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

