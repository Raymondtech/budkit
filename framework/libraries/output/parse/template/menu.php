<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * loop.php
 *
 * Requires PHP version 5.3
 *
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/layout
 * @since      Class available since Release 1.0.0 Feb 5, 2012 10:15:29 PM
 *
 */

namespace Library\Output\Parse\Template;

use Library;
use Library\Output;
use Library\Output\Parse;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Libraries
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/layout
 * @since      Class available since Release 1.0.0 Feb 5, 2012 10:15:29 PM
 */
class Menu extends Parse\Template {
    /*
     * @var object
     */

    static $instance,
    
           $hasActive = false;

    /**
     * Execute the layout
     * 
     * @param type $parser
     * @param type $tag
     * @return type
     */
    public static function execute($parser, $tag, $writer) {

        //We must have the menu id
        if (!isset($tag['ID']))
            return null;
        $menuId   = $tag['ID'];
        $menuType = (isset($tag['TYPE'])) ? trim($tag['TYPE']) : null;
        $menuLtr = (isset($tag['POSITION'])) ? trim($tag['POSITION']) : "";
        $menuDepth = (isset($tag['LEVEL'])) ? trim($tag['LEVEL']) : 2;

        $database = Library\Database::getInstance();
        $uniqueId = $tag['ID'];

        //1. Get all menu items for this menu id from the table
        $menuItems = \Platform\Navigator::menu($uniqueId);

        if (empty($menuItems))
            return null;

        //print_R($menuItems);
        unset($tag['NAMESPACE']);
        unset($tag['TYPE']);
        unset($tag['POSITION']);

        $tag['ELEMENT'] = 'ul';
        $tag['CLASS'] = "nav $menuType $menuLtr {$tag['CLASS']}"; //Add any developer defined classes to the element;
        $tag['CHILDREN'] = static::element((array) $menuItems, $menuType, $menuDepth, $menuLtr);

        //print_R($tag);
        //Always return the modified element
        return $tag;
    }

    /**
     * Create element
     * 
     * @param type $menuItems
     * @return type 
     */
    public static function element($menuItems, $menuType = "nav", $menuDepth = 2, $menuPosition = '', $menuLevelParent = true) {

        $li = array();
        $parent = 0;
        $id = 0;

        //$hasActive  = false;
        foreach ($menuItems as $item) {
            
            //@TODO Menu Plugins
            //Search for all plugin placemarkers in menu item names
            //Search for (?<=\$\{)([a-zA-Z]+)(?=\}) and replace with data
            if (preg_match_all('/(?:(?<=\%\{)).*?(?=\})/i', $item['menu_title'], $matches)) {
                $placemarkers = (is_array($matches) && isset($matches[0])) ? $matches[0] : array();
                foreach ($placemarkers as $k => $dataid) {
                    //@TODO Now call all menu items plugins
                    $item['menu_title'] = $dataid;
                }
                //Replace with data;
                continue;
            }

            //@TODO check if this is the current menu item and set it as active
            $query = \Library\Uri::getInstance()->getQuery();
            $active = ( \Library\Uri::internal($item['menu_url']) <> \Library\Uri::internal($query) ) ? false : true;
            static::$hasActive = ($active && !static::$hasActive)? true : false; 
            
          
            $link = array(
                "ELEMENT" => 'li',
                "CLASS" => ((isset($item['menu_classes']) && !empty($item['menu_classes'])) ? $item['menu_classes'] : "") . (($active) ? " active" : "").' link-'.str_replace(array(" ","(",")","-","&","%",",","#" ), '-', strtolower($item['menu_title'])),
                "CHILDREN" => array(
                    array(
                        "ELEMENT" => "a",
                        "HREF" => !empty($item['menu_url']) ? \Library\Uri::internal($item['menu_url']) : '#',
                        "CDATA" => $item['menu_title']
                    )
                )
            );
                   
            //Ammend active path if tab is active;
            //@TODO am i a child? who is my parent?
            //@TODO build a tag
            if ($active):
                $id = $item['menu_id'];
                $parent = $item['menu_parent_id'];
            endif;


            //Count children
            if (isset($item['children']) && count($item['children']) > 0 && $menuLevelParent ) {
                $link['CLASS'] .= ' nav-header';
                $link['CDATA'] = $item['menu_title'];
                unset($link['CHILDREN']);
                $children = static::element((array) $item['children'], $menuType, $menuDepth, $menuPosition, false);
                $li[]   = $link;
                $li     = array_merge($li , $children);
            }else{
                $li[] = $link;
            }

            
            //$li[] = $link;
        }

        return $li;
    }

    /**
     * Returns an instantiated Instance of the layout class
     *
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     *
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance
     * @return object layout
     */
    public static function getInstance() {

        if (is_object(static::$instance) && is_a(static::$instance, 'Menu'))
            return static::$instance;

        static::$instance = new self();

        return static::$instance;
    }

}

