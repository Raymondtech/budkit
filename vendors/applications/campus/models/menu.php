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

namespace Application\Campus\Models;

/**
 * The User EAV model. 
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

    public function __construct() {
        parent::__construct();
    }

    /**
     * Adds Dynamic menu items
     * @param type $menuId
     * @param type $menuItems
     */
    public static function hook(&$menuId, &$menuItems) {
        if ($menuId === 'dashboardmenu') {
            array_push($menuItems, array(
                "menu_title" => "Workspace",
                "menu_url" => "/campus/workspace/project"
                    )
            );
        } elseif ($menuId === 'campusmenu') {
            
            //Add items to the profile menu;
            //print_r($menuItems);
            array_push($menuItems, array(
                "menu_title" => "Workspace",
                    "children" => array(
                        array("menu_title" => "Projects", "menu_url" => "/campus/workspace/project","menu_count"=>7),
                        array("menu_title" => "Calendar", "menu_url" => "/campus/workspace/calendar"),
                        array("menu_title" => "Courses", "menu_url" => "/campus/workspace/course"),
                        array("menu_title" => "Tasks", "menu_url" => "/campus/workspace/task", "menu_count"=>10), //add  menu_count_unimportant=true to remove highlight
                        array("menu_title" => "Portfolio", "menu_url" => "/campus/workspace/portfolio"),
                    // array("menu_title" => "Collections", "menu_url" => "/system/media/collection/gallery")
                    )
                )
            );
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

