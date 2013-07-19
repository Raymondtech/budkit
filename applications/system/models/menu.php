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
    public static function media(&$menuId, &$menuItems) {

        //$user = \Platform\User::getInstance();
        //$username = $user->get("user_name_id");

        //Add the default upload links
        switch ($menuId):

            case "dashboardmenu":
                //Counts
                //$attachments = Attachments::getInstance();
                //$mycount = $attachments->setListLookUpConditions("attachment_owner", array($username))->getObjectsListCount("attachment");

                //if (empty($mycount))
               $mycount = NULL;

                //Display bookmarks
                $bookmarks = array(
                    "menu_title" => "Bookmarks",
                    "children" => array(
                        array("menu_title" => "Timeline", "menu_url" => "/system/media/timeline"),
                        array("menu_title" => "Messages", "menu_url" => "/system/messages/inbox"),
                        array("menu_title" => "Documents", "menu_url" => "/system/media/attachments/gallery", "menu_count" => $mycount ),  // 
                        array("menu_title" => "People", "menu_url" => "/member/network/directory"),
                    )
                );
                $menuItems[] = $bookmarks;
                break;
            case "messagesmenu":
                $startHere = & reset($menuItems);
                //Add Timeline;
                array_unshift($startHere['children'], array("menu_title" => "Inbox", "menu_url" => "/system/messages/inbox" , "menu_count" => 2));
                //Display bookmarks
                $bookmarks = array(
                    "menu_title" => "Bookmarks",
                    "children" => array(
                        array("menu_title" => "Forums", "menu_url" => "/system/messages/forums"),
                        array("menu_title" => "Sent", "menu_url" => "/system/messages/sent"),  // 
                        array("menu_title" => "Trash", "menu_url" => "/system/messages/trash"),
                    )
                );
                $menuItems[] = $bookmarks;
                
                array_shift($menuItems);
                array_unshift($menuItems, $startHere);
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

