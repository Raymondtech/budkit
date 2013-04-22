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

namespace Application\Member\Models;

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


        $user = User::getInstance();
        $username = $user->get("user_name_id");

        //Add the default upload links
        switch ($menuId):
            case 'peoplemenu':
                //Counts
                $mycount = $user->getObjectsListCount("user");

                if (empty($mycount))
                    $mycount = NULL;
                //Add items to the profile menu;
                array_unshift($menuItems, array(
                    "menu_title" => "Network",
                    "children" => array(
                        array("menu_title" => "Members", "menu_url" => "/member/network/directory","menu_count" => $mycount),
                        array("menu_title" => "Following", "menu_url" => "/member/network/relation/following"),
                        array("menu_title" => "Followers", "menu_url" => "/member/network/relation/followers"),
                        array("menu_title" => "Requests", "menu_url" => "/member/network/relation/requests")
                    )
                        ), array(
                    "menu_title" => "Communities",
                    "children" => array(
                        array("menu_title" => "Directory", "menu_url" => "/member/network/community/directory"),
                        array("menu_title" => "Memberships", "menu_url" => "/member/network/community/membership")
                    )
                ));
                break;
            case 'profilemenu':
                //Add items to the profile menu;
                array_unshift($menuItems, Array(
                    "menu_title" => "Home",
                    "menu_url" => "/member:{$username}/profile/view"
                ));
                break;
        endswitch;
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

