<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * preferences.php
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

namespace Application\Settings\Models;

/**
 * User Preferences management model
 *
 * Manages system options
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Preferences extends \Platform\Model {

    /**
     * Default display method for every model 
     * @return boolean false
     */
    public function display() {
        return false;
    }

    /**
     * Saves options to the database, inserting if none exists or updating on duplicate key
     * 
     * @param array $options An array of options
     * @param string $group A unique string representing the options group
     * @return boolean
     */
    public function save($group, $folder = null) {

        //Save the user config
        $configini = \Library\Config::$ini;
        $fileHandler = \Library\Folder\Files::getInstance();
        $userfolders = $this->config->getParam('site-users-folder', '/users');

        $prefdir = FSPATH . $userfolders . DS . $this->user->get("user_name_id") . DS . 'preferences' . DS;

        if (!$fileHandler->is($prefdir, true)) { //if its not a folder
            $folderHandler = \Library\Folder::getInstance();
            if (!$folderHandler->create($prefdir)) {
                $this->setError(_("Could not create the target uploads folder. Please check that you have write permissions"));
                throw new \Platform\Exception($this->getError());
            }
        }

        $paramsfolder = str_replace(array('/', '\\'), DS, $prefdir);
        $paramsconf = array( $group );
        $filename = $group.".ini";
        if ($configini::saveParams($filename, $paramsconf, $paramsfolder) == FALSE) {
            $this->setError($this->config->getError());
            return false;
        }
        
        return true;
    }

    /**
     * Get's an instance of the activity model
     * @staticvar object $instance
     * @return object \Application\System\Models\Options 
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

