<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * manager.php
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
 * Manager View
 * 
 * Draws system managements and configuration screens
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Network extends Platform\View {

    /**
     * Displays form required for adding a new network node
     * @return boolean
     */
    public function addNetworkMember() {

        $this->output->setPageTitle(_("Add Network Member"));
        $panel = $this->output->layout('network/add');

        return $this->display($panel);
    }

    /**
     * Draws a lists of network members to screen
     * @return boolean
     */
    public function listNetworkMembers() {

        $this->output->setPageTitle(_("Network Members"));
        $panel = $this->output->layout('network/lists');

        return $this->display($panel);
    }

    public function analytics() {

        $this->output->setPageTitle(_("Network Analytics"));
        $panel = $this->output->layout('network/analytics');

        return $this->display($panel);
    }

    /**
     * Draws the accesscontrol management screen
     * @return boolean
     */
    public function accessControl() {
        //1. The page Title
        $this->output->setPageTitle(_("Access Control Settings"));
        //2. Load Model
        $model = $this->load->model("authority");
        //3. Get the authorities list
        $authorities = $model->getAuthorities();
        //4. Set Properties
        $this->set("authorities", $authorities);
        //5. The layout
        $panel = $this->output->layout('network/permissions');

        //6. Display
        return $this->display($panel);
    }

    /**
     * Draws the network graph to screen
     * @return boolean
     */
    public function relationships() {

        $this->output->setPageTitle(_("Network Graph"));
        $panel = $this->output->layout('network/relationships');

        return $this->display($panel);
    }

    /**
     * The default network view display method
     * @param string $panel
     * @return boolean
     */
    public function display($panel = "") {
        return $this->output->addToPosition("body", $panel);
    }

    /**
     * Returns an instance of the Network View Class
     * @staticvar object $instance
     * @return Network
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