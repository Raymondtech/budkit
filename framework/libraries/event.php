<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * event.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/event
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/event
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Event extends \Library\Object {

    /**
     * Stores all registered Event hooks
     * @var array 
     */
    //public static $hooks = array();

    /**
     * Loads system event hooks
     * 
     * @param string $ext
     * @param string $path
     */
    public static function loadHooks($ext = '.inc', $path = "") {

        $hooks = FSPATH . 'hooks' . $ext;

        if (!\Library\Folder\Files::isFile($hooks)) {
            Log::_('The main system hook file hook' . $ext . ' does not exist.');
            return false;
        }
        //Load the hook file
        require_once( $hooks );
        //Find all the config files in apps
        $_ahooks = \Library\Folder::itemizeFind("hooks.inc", APPPATH, 0, TRUE, 1);
        $_vhooks = \Library\Folder::itemizeFind("hooks.inc", VENDORPATH."applications".DS, 0, TRUE, 1);   
        //$_lhooks Library Hooks?
        $_hooks  = array_merge($_ahooks, $_vhooks);
        //print_R($routers);
        foreach ($_hooks as $i => $_hooksFile) {
            if (!\Library\Folder::is($_hooksFile)) {
                //include the individual app hooks
                @require_once rtrim($_hooksFile, DS);
            }
        }
    }

    /**
     * Gets an instance of the Library\Exception Object
     * 
     * @static self $instance
     * @return self 
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

