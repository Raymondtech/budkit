<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * system.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\Settings\Views;

/**
 * Settings View class
 * 
 * Draws system configuration screens
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class System extends \Platform\View {


    /**
     * The default settings display method
     * @param string $panel
     * @return boolean
     */
    public function display($panel = "") {
        return $this->output->addToPosition("body", $panel);
    }

    /**
     * Displays the settings form
     * @param string $form
     * @param string $title
     * @param string $app
     * @return void
     */
    final public function form($form = 'system/configuration', $title = "System Configuration", $app = 'settings') {

        $this->output->setPageTitle($title);

        $sidebar = null; //$this->output->layout("settings/sidebar");
        $body = $this->output->layout($form, $app);

        $this->output->addMenuGroupToPosition("side", "settingsmenu");
        $this->output->addToPosition("body", $body);
        $this->output->addToPosition("side", $sidebar);

        $this->display();
    }

    /**
     * Returns an instance of the settings view class
     * @staticvar object $instance
     * @return object Settings
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