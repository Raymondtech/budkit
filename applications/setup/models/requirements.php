<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * requirements.php
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

namespace Application\Setup\Models;

use Platform;
use Library;

/**
 * Performs system requirements test
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Requirements extends Platform\Model {

    /**
     * This model has no data to display
     * @return boolean
     */
    public function display() {
        return false;
    }
    
    /**
     * Test file upload size limits
     * @todo Implement file upload system requirements test at install
     */
    public function testFileUploads(){}
    
    /**
     * Test for available memore
     * @todo Implement system memory test at install
     */
    public function testMemory(){}  
    
    /**
     * Test float?
     */
    public function testFloat(){}

    /**
     * Checks required modules
     * 
     * @param string $name
     * @param array $directive
     * @return boolean 
     */
    public function testModule($name, $directive = array()) {

        $return = array(
            "title" => $directive['title'], "name" => $name, "current" => "", "test" => false
        );

        if (is_array($directive)) {
            //If the extension is loaded
            if (!extension_loaded($name)) {
                $return["current"] = _t("Not Loaded");
                //If we require this module loaded, then fail
                if ($directive["loaded"]) {
                    $return["test"] = false;
                }
                //If we require this module to be installed
                if ($directive["installed"] && function_exists('dl')) {
                    if (!dl($name)) {
                        $return["test"] = false;
                        $return["current"] = _t("Not Installed");
                    }
                }
            } else {
                $return["current"] = _("Loaded");
                if ($directive["loaded"]) {
                    $return["test"] = true;
                }
            }

            //@TODO If we have alternative modules
            if (!$return['test'] && isset($directive['alternate'])) {
                //$altName = 
            }
        }

        return $return;
    }

    /**
     * Test for folder permissions
     * @param string $path
     * @param array $directive
     * @return boolean
     */
    public function testFolderPermissions($path, $directive = array()) {
        
        //Test install directory is writable, readable
        //Test we are not trying to overide an installation
        $return = array(
            "title" => $directive['path'], "name" => $name, "current" => _t("Not Writable"), "test" => false
        );

        if (is_array($directive)) {
            //If the extension is loaded
            $return['status']     = ((bool)$directive['writable']) ? "Writable" : "Not Writable";
           if(\Library\Folder\Files::isWritable($path) && (bool)$directive['writable']){
               $return['current'] = _t("Is Writable") ;
               $return['test']    =  true;
           }elseif(!\Library\Folder\Files::isWritable($path) && !(bool)$directive['writable']){
              $return['test']     =  true; 
           }
           
           if(\Library\Folder\Files::isWritable($path)){
               $return['current'] = _t("Is Writable");
           }
        }
        //Return test result;
        return $return;
        
    }

    /**
     * Test PHP Directives before install
     * 
     * @param string $name
     * @param array $directive
     * @return boolean 
     */
    public function testDirective($name, $directive = array()) {

        $return = array(
            "title" => $name, "status" => (!$directive['status']) ? 'Off' : 'On', "current" => "", "test" => true
        );

        //For now we can only check boolean variables
        if (isset($name) && !empty($name) && is_array($directive)) {

            $return['current'] = ini_get($name);
            $setting = ($return['current'] == 0 || strtolower($return['current']) === 'off' || empty($return['current']) || !$return['current']) ? false : true;

            //Test
            if ($directive['status'] <> $setting) {
                $return['test'] = false;
            }

            //Literalize
            $return['current'] = (!$setting) ? _t('Off') : _t('On');
        }

        return $return;
    }

    /**
     * Checks the current version 
     * 
     * @param string $component
     * @return boolean
     */
    public function checkVersion($component) {

        return version_compare($component['current'], $component['version'], $component['minimal']);
    }

    /**
     * Returns an instance of the requirements model
     * 
     * @staticvar object $instance
     * @return object Requirements
     */
    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self;
        return $instance;
    }
}

