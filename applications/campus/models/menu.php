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

        $user = \Platform\User::getInstance();
        $input = \Library\Input::getInstance();
        $input->getRequestVars();


        if ($menuId === 'workspacemenu') {
            $workspace = $input->getVar("workspace", '');
            array_push($menuItems, array(
                "menu_title" => "Workspace",
                "children" => array(
                    array("menu_title" => "Overview", "menu_url" => "/campus/workspaces/" . (!empty($workspace) ? "workspace:{$workspace}/" : NULL) . "overview"),
                    array("menu_title" => "Tasks", "menu_url" => "/campus/workspaces/" . (!empty($workspace) ? "workspace:{$workspace}/" : NULL) . "tasks"),
                    array("menu_title" => "Discussions", "menu_url" => "/campus/workspaces/" . (!empty($workspace) ? "workspace:{$workspace}/" : NULL) . "timeline"),
                    array("menu_title" => "Calendar", "menu_url" => "/campus/workspaces/" . (!empty($workspace) ? "workspace:{$workspace}/" : NULL) . "calendar"),
                    array("menu_title" => "Documents", "menu_url" => "/campus/workspaces/" . (!empty($workspace) ? "workspace:{$workspace}/" : NULL) . "documents"),
                    array("menu_title" => "People", "menu_url" => "/campus/workspaces/" . (!empty($workspace) ? "workspace:{$workspace}/" : NULL) . "people", "menu_count" => 10), //add  menu_count_unimportant=true to remove highlight
                )
                    )
            );
        } elseif ($menuId === 'dashboardmenu') {
            array_push($menuItems, array(
                "menu_title" => "Groups",
                "menu_url" => "/campus/workspace/gallery"
                    )
            );
        } elseif ($menuId === 'coursemenu') {
            $course = $input->getVar("course", '');
            array_push($menuItems, array(
                "menu_title" => "Course",
                "children" => array(
                    array("menu_title" => "Overview", "menu_url" => "/campus/courses/" . (!empty($course) ? "course:{$course}/" : NULL) . "overview"),
                    array("menu_title" => "Activities", "menu_url" => "/campus/courses/" . (!empty($course) ? "course:{$course}/" : NULL) . "tasks"),
                    array("menu_title" => "Discussions", "menu_url" => "/campus/courses/" . (!empty($course) ? "course:{$course}/" : NULL) . "timeline"),
                    array("menu_title" => "Documents", "menu_url" => "/campus/courses/" . (!empty($course) ? "course:{$course}/" : NULL) . "documents"),
                    array("menu_title" => "Participants", "menu_url" => "/campus/courses/" . (!empty($course) ? "course:{$course}/" : NULL) . "people", "menu_count" => 10), //add  menu_count_unimportant=true to remove highlight
                    array("menu_title" => "Achievements", "menu_url" => "/campus/courses/" . (!empty($course) ? "course:{$course}/" : NULL) . "portfolio")
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

