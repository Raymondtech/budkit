<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * extensions.php
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
 * Extensions view parent class
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Extensions extends Platform\View {

    /**
     * Draws the extensions installation form
     * @return void
     */
    public function installExtensions() {

        //To set the pate title use
        $this->output->setPageTitle("Add Extension");
        //$sidebar    = $this->output->layout( "index_sidebar" );
        $dashboard = $this->output->layout("extensions/new");
        //The default installation box;
        //$this->output->addToPosition("left",    $sidebar);

        $this->display($dashboard);
    }

    /**
     * Draws the extension update form
     * @return void
     */
    public function updateExtensions() {

        //To set the pate title use
        $this->output->setPageTitle("Update Extensions");
        $sidebar = $this->output->layout("index_sidebar");
        $dashboard = $this->output->layout("extensions_updates");

        //The default installation box;
        $this->output->addToPosition("left", $sidebar);
        $this->output->addToPosition("body", $dashboard);
    }

    /**
     * Draws a list of installed extensions
     * @return void
     */
    public function lists() {

        //To set the pate title use
        $this->output->setPageTitle("Installed Extensions");
        $dashboard = $this->output->layout("extensions/lists");

        $this->display($dashboard);
    }

    /**
     * Draws the extension repository lists
     * @return void
     */
    public function repositories() {

        //To set the pate title use
        $this->output->setPageTitle("Extension Repositories");
        $dashboard = $this->output->layout("extensions/repositories");

        $this->display($dashboard);
    }

    /**
     * The default model display. Prints the extensions view to screen
     * @param string $panel
     * @return boolean
     */
    public function display($panel = "") {
        return $this->output->addToPosition("body", $panel);
    }

    /**
     * Returns an instance of the Extensions view class
     * @staticvar object $instance
     * @return object Extensions
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