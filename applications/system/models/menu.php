<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * menu.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 * 
 */

namespace Application\System\Models;

/**
 * Models the system menu items for display
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Menu extends \Platform\Model {

    /**
     * Adds Dynamic media menu items
     * @param type $menuId
     * @param type $menuItems
     */
    public static function media(&$menuId, &$menuItems){
        //Add the default upload links
        if ($menuId === 'mediamenu') {
            //Add items to the profile menu;
            array_unshift($menuItems, array(
                "menu_title" => "Content",
                "children" => array(
                    array("menu_title" => "Timeline", "menu_url" => "/system/media/timeline"),
                    array("menu_title" => "Collections", "menu_url" => "/system/media/collection/gallery")
                )
                    ), array(
                "menu_title" => "Add New",
                "children" => array(
                    array("menu_title" => "Drag and Drop", "menu_url" => "/system/media/create"),
                    array("menu_title" => "Text Editor", "menu_url" => "/system/media/create/text"),
                    array("menu_title" => "Import", "menu_url" => "/system/media/create/import"),
                    array("menu_title" => "Snap", "menu_url" => "/system/media/create/snap")
                )
            ));
        }
    }

    /**
     * This model has no data to display
     * @return boolean
     */
    public function display() {
        return false;
    }

    /**
     * Returns an instance of the user EAV model
     * @staticvar object $instance
     * @return object User
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

