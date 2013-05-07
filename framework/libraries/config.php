<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * config.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library;

use Platform;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Config extends Object {

    /**
     * @var mixed 
     */
    private static $params;

    /**
     * @var mixed 
     */
    private static $preferences;

    /**
     * The Config Database Adaptor
     * @var type 
     */
    public static $database;

    /**
     * The Config XML Adaptor
     * @var type 
     */
    public static $xml;

    /**
     * The Config INI Adaptor
     * @var type 
     */
    public static $ini;

    /**
     * Constructor for the cofig library
     * 
     * @return void;
     */
    public function __construct() {

        static::$database = static::getDatabase();
        static::$xml = static::getXML();
        static::$ini = static::getIni();
    }

    /**
     * Returns the configuration array
     * 
     * @return array 
     */
    final public static function getParams() {
        return static::$params;
    }

    /**
     * Sets a param in a configuration section section.
     * 
     * Use setParamSection to create a section
     * if it does not exists before creating one. Use hasParamSection to check for
     * the existence of that specific section before creating one.
     * 
     * @param string $name The name of the param to update
     * @param mixed $value The value of the param
     * @param string $section Default section is the system section
     * @return Return false if the section does not exists. 
     */
    public static function setParam($name, $value = NULL, $section = "system") {

        //Instantiate
        //$config = (!isset($this) || !is_a($this, "Library\Config")) ? self::getInstance() : $this;

        if (!isset(static::$params[$section])) {
            return false;
            //we already have it;
        }

        //Set the param;
        static::$params[$section][$name] = $value;

        //Return $this
        return static::getInstance();
    }

    /**
     * Returns a config Item, from configuration
     * 
     * @param type $name
     * @param type $default
     * @param type $section
     * @param type $adapter 
     */
    public static function getParam($name, $default = '', $section = 'general', $callback = NULL) {
        //validate item before using
        //$config = (!isset($this) || !is_a($this, "Library\Config")) ? self::getInstance() : $this;

        if (empty($section) && isset(static::$params[$name])) {
            return static::$params[$name];
        }
        //Attempt to get from the database?
        $params = static::getParamSection($section);

        //If we have a group;
        if (is_array($params) && isset($params[$name])) {
            return $params[$name];
        }
        //Empty
        return $default;
    }

    /**
     * Sets Param section to the config array, or replaces one if already exists
     * 
     * NOTE: You will need to explicitly saveParams with a handler to add this conifugration permanently
     * 
     * Example: 
     * The following usage will add an save configuration data on the fly to the database;
     * $config->setParamSection("userdata", array("param1"=>"param1value") );
     * $config->database->saveParams("userdata");
     * 
     * 
     * @param type $name
     * @param type $params 
     */
    public static function setParamSection($section, $params = array()) {

        static $objects = array();

        //We can only handle arrays at this time
        if (!is_array($params))
            return false;

        //Instantiate
        //$config = (!isset($this) || !is_a($this, "Library\Config")) ? self::getInstance() : $this;
        //We
        static::$params[$section] = $params;

        return static::getInstance();
    }

    /**
     * Returns a config group/section element
     * 
     * @param type $section
     * @return type 
     */
    public static function getParamSection($section) {

        //Instantiate
        //$config = (!isset($this) || !is_a($this, "Library\Config")) ? self::getInstance() : $this;

        if (isset(static::$params[$section])) {
            return static::$params[$section];
            //we already have it;
        }
        $_config = static::getConfig();

        if (!isset($_config[$section])) {
            $cfgSection = FALSE;
        } else {
            $cfgSection = static::$params[$section] = $_config[$section];
        }

        return $cfgSection;
    }

    /**
     * Preferences are user configs stored in site-users-folders
     *  
     * @param type $user_name_id
     * @return array
     */
    public static function getUserPreferences($user_name_id = NULL, $refresh = FALSE, $merge=true) {

        $preferences = array();
        $dirname = static::getParam("site-users-folder", "/users");
        $user = Platform\User::getInstance();
        $username = $user->get('user_name_id');

        //if no platform user
        if (empty($username) && empty($user_name_id))
            return $preferences;

        //Determine the preferences folder
        $prefuser = empty($user_name_id) ? $username : $user_name_id;
        $prefdir = str_replace(array('/', '\\'), DS, FSPATH . $dirname . DS . $prefuser . DS . 'preferences');

        if (!$refresh && isset(static::$preferences[$prefuser])) {
            $preferences = static::$preferences[$prefuser];
        } else {
            //Get parsable configurations
            $_inis = Folder::itemize($prefdir . DS);
            $file = Folder::getFile();
            //Loop through all the preferences files
            foreach ($_inis as $ini):
                if ($file->setFile($ini)) {
                    if (strtolower($file->getExtension()) === "ini") {
                        $_ini = static::getIni();
                        if ($_ini->readParams($ini) !== FALSE) {
                            $params = $_ini->getParams($ini);
                            $preferences = static::mergeParams($preferences, $params);
                        }
                    }
                }
            //continue;
            endforeach;
            static::$preferences[$prefuser] = $preferences;
        }

        //Store or return?
        if (!empty($user_name_id) && ($user_name_id <> $username))
            return $preferences;

        //if usernameid is same as platform user, then merge params
        $userpref = ($merge)?static::mergeParams(static::$params, $preferences):$preferences;
        
        return $userpref;
        
    }

    /**
     * Loads all the system configuration
     * 
     * @staticvar type $configarray
     * @param type $ext
     * @param type $path
     * @return type 
     */
    public static function getConfig($ext = '.inc', $path = "") {

        static $configarray;

        if (!isset($configarray)) {

            if (!\Library\Folder\Files::isFile(FSPATH . 'config' . $ext)) {
                exit('The configuration file config' . $ext . ' does not exist.');
            }
            //Empty config array;
            $config = array();

            require_once(FSPATH . 'config' . $ext );

            //Get parsable configurations
            $_INIs = \Library\Folder::itemize(FSPATH . 'config' . DS);
            $file = \Library\Folder::getFile();

            foreach ($_INIs as $ini):
                if ($file->setFile($ini)) {
                    if (strtolower($file->getExtension()) === "ini") {
                        $_INI = static::getIni();
                        if ($_INI->readParams($ini) !== FALSE) {
                            //print_R($INI);
                            $params = $_INI->getParams($ini);
                            //$config = array_merge($config, $params);
                            $config = static::mergeParams($config, $params);
                        }
                    }
                }
            //continue;
            endforeach;


            //Find all the config files in apps
            $configs = \Library\Folder::itemizeFind("config.inc", APPPATH, 0, TRUE, 1);

            //print_R($routers);
            foreach ($configs as $i => $configFile) {
                if (!\Library\Folder::is($configFile)) {
                    //include the individual app routes
                    @include rtrim($configFile, DS);
                }
            }

            if (!isset($config) OR !is_array($config)) {
                exit('Your config file does not appear to be formatted correctly.');
            }


            $configarray = & $config;
        }
        return $configarray;
    }

    /**
     * 
     * @param type $section
     * @param type $autoload
     */
    public static function getDBParams() {

        if ((bool) static::getParam("installed", false, "database")):

            $_DB = static::getDatabase();
            //print_R(Config::getParams());

            $_DB->readParams();
            $params = $_DB->getParams();
            static::$params = static::mergeParams(static::$params, $params);

        endif;
    }

    /**
     * Recursively Merges two params arrays, overwriting values in params1 with those in params2
     * 
     * @param type $params1
     * @param type $params2
     */
    public static function mergeParams($params1, $params2) {

        foreach ($params2 as $key => $value) {
            if (array_key_exists($key, $params1) && is_array($value)):
                $params1[$key] = static::mergeParams($params1[$key], $params2[$key]);
            else:
                $params1[$key] = $value;
            endif;
        }

        return $params1;
    }

    /**
     * Parses a config definition file
     * 
     * @param string $xml
     * @param string $type 
     * @return boolean false if no config found or config object if found
     */
    public static function getDefinition($xml, $type) {

        //@TODO; Replaces the entire parameters class and function suite 
        $XmlParser = new \Library\Folder\Files\Xml\Parser($xml, true);

        $DOCUMENT = $XmlParser::getDocument();
        $CONFIG = $DOCUMENT->ROOT->config;

        if ($CONFIG) {
            //Check that there is an attribute typ;
            //$CONFIG;

            return $CONFIG;
        }
        return false;
    }

    /**
     * Returns an instance of the INI config file handler
     * 
     * @return type 
     */
    private static function getIni() {
        return Config\Ini::getInstance();
    }

    /**
     * Returns an instance of the Database config handler
     * 
     * @return type 
     */
    private static function getDatabase() {
        return Config\Database::getInstance();
    }

    /**
     * Returns an instance of the XML config file handler
     * 
     * @return type 
     */
    private static function getXML() {
        return Config\Xml::getInstance();
    }

    /**
     * Gets an instance of the config element
     * @property-read object $instance 
     * @property-write object $instance 
     * @staticvar self $instance
     * @return self 
     */
    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $params = static::getConfig();

        $instance = new self();
        static::$params = $params; //Store Params form config files;

        static::getDBParams();

        return $instance;
    }

}