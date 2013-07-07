<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * member.php
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
 * Member Settings View
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Member extends \Platform\View {

    /**
     * Default settings display
     * @return void 
     */
    final public function display() {
        //The default method
        //$this->output->addToPosition("aside", "Sidebar");
    }

    /**
     * Displays the settings form
     * @param string $form
     * @param string $title
     * @param string $app
     * @return void
     */
    final public function form($form = 'member/account', $title="Account settings", $app = 'settings') {

        $this->output->setPageTitle($title);

        //$sidebar = null; //$this->output->layout("settings/sidebar");
        $body = $this->output->layout($form, $app);
        
        $this->output->addMenuGroupToPosition("side", "settingsmenu","nav-list", array(), false, false);
        $this->output->addToPosition("body", $body);
        //$this->output->addToPosition("side", $sidebar);
        
        $this->display();
    }

    /**
     * Instance of the settings view class
     * 
     * @staticvar object $instance
     * @return object \Application\Member\Views\Settings
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

