<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * template.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/template
 * @since      Class available since Release 1.0.0 Jan 28, 2012 2:03:47 PM
 *
 */

namespace Library\Output\Parse;

use Library;
use Library\Output;
use Library\Folder\Files\Xml as Xml;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/template
 * @since      Class available since Release 1.0.0 Jan 28, 2012 2:03:47 PM
 */
abstract class Template extends Output\Parse {
    /*
     * @var object
     */

    static $instance;

    /**
     * Loaded and imported layouts
     * @var type
     */
    static $layouts = array();

    /**
     * Already parsed
     * @var type
     */
    static $parsed;
    static $output = array();
    static $variables = array();
    static $writer;
    static $imports = array();
    static $importing = false;
    //Tell the getdata method we are loop
    static $looping = array();
    //Specify a loopid for the pvariables
    static $currentloopid = null;

    /**
     * Persisten variables
     * @var type 
     */
    static $pvariables = array();

    /**
     * Useful data modifiers for altering attribute data values
     * 
     * @var type 
     */
    static $allowedDataModifiers = array(
        "query" => "getQueryData",
        "i18n" => "getI18nString",
        "array" => "getArrayFromString",
        "config" => "getConfigParam"
    );

    /**
     * Returns data by executing a database query. 
     * e.g ${query|SELECT * FROM ?users WHERE user_name_id="joshua"}
     * 
     * @param type $path
     * @param type $default
     */
    final public static function getQueryData($path, $default = "") {
        //echo $path;

        return $rows = [1 => "Rudolf", 2, 3, 4, 5];
    }

    /**
     * Returns a defined config param value
     * 
     * @param type $path
     * @param type $default
     * @todo  Default values from config data attribute call
     */
    final public static function getConfigParam($path, $default = "") {

        $parts = explode('.', $path, 2);
        $section = reset($parts);
        $key = end($parts);

        $data = Library\Config::getParam($key, $default, $section);

        return $data;
    }

    /**
     * Converts a data string to an array
     * 
     * @param type $path
     * @param type $default
     * @return type
     */
    final public static function getArrayFromString($path, $default = "") {
        //echo $path;
        echo $path;



        return $data;
    }

    /**
     * Translates the resulting string that follows the modifier
     * 
     * @param type $path
     * @param type $default
     */
    final public static function getI18nString($path, $default = "") {
        return $path;
    }

    final public static function getDataAttributeContent($attribute, $content) {

        $parsed = array();
        $matches = array();

        //Search for (?<=\$\{)([a-zA-Z]+)(?=\}) and replace with data
        if (preg_match_all('/(?:(?<=\$\{)).*?(?=\})/i', $content, $matches)) {

            $searches = array();
            $replace = array();
            $placemarkers = (is_array($matches) && isset($matches[0])) ? $matches[0] : array();

            foreach ($placemarkers as $placemarker):
                //search for modifiers
                $parts = explode("|", $placemarker, 2);
                $modifier = (is_array($parts) && count($parts) > 1) ? reset($parts) : null;
                if (!empty($modifier)):
                    if (array_key_exists($modifier, static::$allowedDataModifiers)):
                        $method = static::$allowedDataModifiers[$modifier];
                        $path = end($parts);
                        $replace[] = self::$method($path);
                    endif;
                else:
                    //if no modifier found e.g ${modifier|dataid} is found use the default method getData;
                    $replace[] = self::getData(strval($placemarker)); //default is null                  
                endif;
                $searches[] = '${' . $placemarker . '}';
            endforeach;
            //Replace with data;
            $parsed['searches'] = $searches;
            $parsed['replace'] = $replace;
            //$parsed['']    = $content;
        }
        return $parsed;
    }

    /**
     * Useful for preserving data states and iterations in template loops
     * 
     * @param type $path
     * @param type $default
     * @return type 
     */
    final public static function getPersistentData($path) {


        $id = explode('.', $path);
        $value = isset(static::$currentloopid) ? static::$pvariables[static::$currentloopid] : array();

        //From string representation to array;	 
        foreach ($id as $i => $index) {
            if (!isset($value[$index])) {
                //If we can't find the element, return the default value;
                return null;
            };
            $value = $value[$index];
        }

        return $value;
    }

    /**
     * Adds menuItems to Blocks at runtime
     * 
     * @param type $menuNameId
     * @param type $default
     * @return type
     */
    final public static function getBlockMenuGroup($menuNameId, $default = array()) {

        //Get an instance of the Output Document class. 
        //We will need this for templates?
        static::$output = Library\Output::getInstance();
        static::$menugroups = static::$output->getMenuGroups();

        $menu = isset(static::$menugroups[$menuNameId]) ? static::$menugroups[$menuNameId] : $default;


        return (!empty($menu) ) ? $menu : $default;
    }

    /**
     * Execute other template parsers on an element
     * 
     * @param type $element
     * @param type $writter
     * @param type $parser
     * @return type
     */
    final public static function callback($element, $writer) {
    
        //print_r($element);
        //generate xml;
        $xmlParser = new Xml\Parser("", true, true, static::$methods);
        $xmlDocument = $xmlParser::getDocument();
        $xmlString  = $xmlDocument->toXML($element, "1.0", "UTF-8");
        
        //now get the tree
        $xmlParsed = new Xml\Parser($xmlString, true, true, static::$methods);
        $xmlPDocument = $xmlParsed::getRootElement();
        
        //print_r($xmlPDocument); die;
        
        return $element;
    }

    /**
     * Generic get Data method
     * 
     * @param type $path
     * @param type $default
     * @return type 
     */
    final public static function getData($path, $default = "") {

        //Get an instance of the Output Document class. 
        //We will need this for templates?
        static::$output = Library\Output::getInstance();
        static::$variables = static::$output->getVariables();

        //Modified data variables
        $parts = explode("|", $path, 2);
        if (isset($parts[1])) {
            $modifier = $parts[0];
            if (array_key_exists($modifier, static::$allowedDataModifiers)):
                $method = static::$allowedDataModifiers[$modifier];
                $path = end($parts);
                return self::$method($path);
            endif;
        }

        $id = explode('.', $path);
        $value = static::$variables;

        //if trying to access parent data from within a loop element, the first element 
        //in the path should be _ e.g _.blah.blah.
        $first = reset($id);
        $loop = static::$currentloopid;
        if (isset(static::$looping[$loop]) && static::$looping[$loop] && $first <> "_") {
            $return = self::getPersistentData($path, $default);
            if (!empty($return))
                return $return;
            if (empty($return) && !static::$importing)
                return $default;
            //if(empty($value) && static::$importing) $value = static::$variables;
        }

        //From string representation to array;	 
        foreach ($id as $i => $index) {

            if (is_object($value)) {
                if (!isset($value->$index)) {
                    return $default;
                    break;
                }
                $value = $value->$index;
                continue;
            }

            if (!isset($value[$index])) {

                //If we can't find the element, return the default value;
                return $default;
                break;
            };
            $value = $value[$index];
        }

        //Parse  here?
        //$value = Template::_( $value );

        return (!empty($value) ) ? $value : $default;
    }

    /**
     * Returns and instantiated Instance of the template class
     *
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     *
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance
     * @return object template
     */
    public static function getInstance($buffer = NULL) {

        if (is_object(static::$instance) && is_a(static::$instance, 'template'))
            return static::$instance;

        static::$instance = new self();

        return static::$instance;
    }

}

