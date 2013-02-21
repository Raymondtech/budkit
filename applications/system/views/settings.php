<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * settings.php
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
class Settings extends Platform\View {

    /**
     * Displays the configuration form
     * @return boolean
     */
    public function configurationForm() {

        $this->output->setPageTitle(_("System Preferences"));
        //$aside  = "Settings Instructions";
        $panel = $this->output->layout('Settings/configuration');
        //$this->output->addToPosition("aside", $aside);
        return $this->display($panel);
    }

    /**
     * Displays the navigation configuration form
     * @return boolean
     */
    public function navigationConfigForm() {

        //1. The page Title
        $this->output->setPageTitle(_("Navigation settings"));
        $menus = \Platform\Navigator::getAllMenus();
        $this->set("menus", $menus);
        unset($menus);
        //5. The layout
        $panel = $this->output->layout('settings/navigation');

        //6. Display
        return $this->display($panel);
    }

    /**
     * Displays the appearance configuration form
     * @return boolean
     */
    public function appearanceConfigForm() {

        $this->output->setPageTitle(_("Appearance Settings"));
        //Get the Menus
        $menus = \Platform\Navigator::getAllMenus();
        $this->set("menus", $menus);

        $panel = $this->output->layout('settings/appearance');

        return $this->display($panel);
    }

    /**
     * Displays the moderation configuration settings
     * @return type
     */
    public function moderationConfigForm() {

        $this->output->setPageTitle(_("Moderation Settings"));
        $panel = $this->output->layout('settings/moderation');
        return $this->display($panel);
    }

    /**
     * Displays the input configuration form
     * @return boolean
     */
    public function inputConfigForm() {

        $this->output->setPageTitle(_("Input Settings"));
        $panel = $this->output->layout('settings/input');

        return $this->display($panel);
    }

    /**
     * Displays the maintenance configuration form
     * @return boolean
     */
    public function maintenanceConfigForm() {

        $this->output->setPageTitle(_("Maintenance Settings"));
        $panel = $this->output->layout('settings/maintenance');

        return $this->display($panel);
    }

    /**
     * The default settings display method
     * @param string $panel
     * @return boolean
     */
    public function display($panel = "") {
        return $this->output->addToPosition("body", $panel);
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