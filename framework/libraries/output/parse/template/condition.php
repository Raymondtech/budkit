<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * condition.php
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
class Condition extends Parse\Template {
    /*
     * @var object
     */

    static $instance;

    /**
     * Defines the class constructor
     * Used to preload pre-requisites for the element class
     *
     * @return object element
     */
    public function __constructor() {
        
    }

    private static function _compare($tag) {

        $data = isset($tag['DATA']) ? self::getData($tag['DATA']) : null;
        $value = $tag['VALUE'];
        $operator = strtolower($tag['OPERATOR']);
       
        $element = null;
        $test = false;
        switch ($operator):
            case "equals":
                if( ( isset($tag['COUNT']) && (bool)$tag['COUNT'] ) && sizeof($data) == intval($value) ) $test = true;
                else if ($value == $data) $test = true;
                break;
            case "greaterthan":
                if (( isset($tag['COUNT']) && (bool)$tag['COUNT'] ) && sizeof($data) > intval($value))
                    $test = true;
                break;
            case "lessthan":
                if (( isset($tag['COUNT']) && (bool)$tag['COUNT'] ) && sizeof($data) < intval($value))
                    $test = true;
                break;
        endswitch;
                
        //If the boolean value of value is equal to data then condition is met
        if ($test) {
            //Get the layout name; and save it!
            if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
                static::$writer->writeRaw($tag['CDATA']);
            endif;
            //Get the layout name; and save it!
            if (isset($tag['CHILDREN'])):
                $element = $tag['CHILDREN'];
            endif;
        }
        //Else remove the tag from the tree;
        return $element;
    }

    private static function _boolean($tag) {

        $data = isset($tag['DATA']) ? self::getData($tag['DATA']) : null;
        $value = $tag['VALUE'];
        $element = null;

        //If the boolean value of value is equal to data then condition is met
        if ((bool) $data == (bool) $value) {
            //Get the layout name; and save it!
            if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
                static::$writer->writeRaw($tag['CDATA']);
            endif;

            //Get the layout name; and save it!
            if (isset($tag['CHILDREN'])):
                $element = $tag['CHILDREN'];
            endif;
        }
        //Else remove the tag from the tree;
        return $element;
    }

    private static function _isset($tag) {

        $data = isset($tag['DATA']) ? self::getData($tag['DATA']) : null;
        $value = $tag['VALUE'];
        $datatest = (empty($data) || is_null($data)) ? false : true;
        $element = null;

        //If the boolean value of value is equal to data then condition is met
        if ((bool) $datatest == (bool) $value) {
            //Get the layout name; and save it!
            if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
                static::$writer->writeRaw($tag['CDATA']);
            endif;

            //Get the layout name; and save it!
            if (isset($tag['CHILDREN'])):
                $element = $tag['CHILDREN'];
            endif;
        }
        //Else remove the tag from the tree;
        return $element;
    }

    /**
     * Checks if data equals
     * 
     * @param type $tag
     * @return type
     */
    private static function _equals($tag) {

        $data = isset($tag['DATA']) ? self::getData($tag['DATA']) : null;
        $value = $tag['VALUE'];
        $datatest = ($data == $value) ? true : false;
        $element = null;

        //If the boolean value of value is equal to data then condition is met
        if ((bool) $datatest == (bool) $value) {
            //Get the layout name; and save it!
            if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
                static::$writer->writeRaw($tag['CDATA']);
            endif;

            //Get the layout name; and save it!
            if (isset($tag['CHILDREN'])):
                $element = $tag['CHILDREN'];
            endif;
        }
        //Else remove the tag from the tree;
        return $element;
    }

    /**
     * Checks if data equals
     * 
     * @param type $tag
     * @return type
     */
    private static function _isnot($tag) {

        $data = isset($tag['DATA']) ? self::getData($tag['DATA']) : null;
        $value = $tag['VALUE'];
        $datatest = ($data !== $value) ? true : false;
        $element = null;

        //If the boolean value of value is equal to data then condition is met
        if ((bool) $datatest == (bool) $value) {
            //Get the layout name; and save it!
            if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
                static::$writer->writeRaw($tag['CDATA']);
            endif;

            //Get the layout name; and save it!
            if (isset($tag['CHILDREN'])):
                $element = $tag['CHILDREN'];
            endif;
        }
        //Else remove the tag from the tree;
        return $element;
    }

    private static function _empty($tag) {

        $data = isset($tag['DATA']) ? self::getData($tag['DATA']) : null;
        $value = $tag['VALUE'];
        $datatest = (empty($data) !== (bool) $value) ? true : false;
        $element = null;

        //If the boolean value of value is equal to data then condition is met
        if ((bool) $datatest == (bool) $value) {
            //Get the layout name; and save it!
            if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
                static::$writer->writeRaw($tag['CDATA']);
            endif;

            //Get the layout name; and save it!
            if (isset($tag['CHILDREN'])):
                $element = $tag['CHILDREN'];
            endif;
        }
        //Else remove the tag from the tree;
        return $element;
    }

    /**
     * Execute the layout
     * 
     * @param type $parser
     * @param type $tag
     * @return type
     */
    public static function execute($parser, $tag, $writer) {

        static::$writer = $writer;

        $method = isset($tag['TEST']) ? $tag['TEST'] : 'compare';
        $submethods = array("boolean", "compare", "isset", "empty", "equals", "isnot");
        $_method = "_" . $method;

        //Check that the method exists!
        //If there is no value remove from the true;
        if (!isset($tag['VALUE']) || !isset($tag['DATA'])) {
            return null;
        }

        if (method_exists(self::getInstance(), $_method) && in_array(strtolower($method), $submethods)) :
            $tag = static::$_method($tag);
        endif;

        return $tag;
    }

    /**
     * Returns and instantiated Instance of the layout class
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

        if (is_object(static::$instance) && is_a(static::$instance, 'Condition'))
            return static::$instance;

        static::$instance = new self();

        return static::$instance;
    }

}

