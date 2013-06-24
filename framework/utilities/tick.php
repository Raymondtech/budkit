<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * tick.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/log
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 *
 */

namespace Platform;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/log
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Tick extends \Library\Object {

    /**
     * Ticks a user perfomed action
     * 
     * @TODO relegate this function to the log class
     * 
     * @param type $class
     * @param type $params
     * @param type $usernameid
     * @param type $decrement
     * @return type
     */
    public static function record($class, array $params = array(), $usernameid = NULL, $decrement = false) {

        //If the usernameid is not defined, use 
        $config = \Library\Config::getInstance();
        $input = \Library\Input::getInstance();
        $file = \Library\Folder\Files::getInstance();
        $uIp = $input->getVar('REMOTE_ADDR', \IS\STRING, '', 'server');
        $udir = $config->getParam('site-users-folder', '/users');

        if (empty($class)):
            return false; //We need to know the class to tick
        endif;
        
        //The User Params;
        $stats = FSPATH . $udir . DS . (empty($usernameid) ? User::getInstance()->get("user_name_id") : $usernameid) . DS . '.stats' . DS . $class . DS;
        if (!$file->is($stats, true)) { //if its not a folder
            $folder = \Library\Folder::getInstance();
            if (!$folder->create($stats)) {
                Debugger::log(_("Could not create the Stats folder. Please check that you have write permissions"));
                return false;
            }
        }
        //Prepare the file;
        $_file = $stats.date("Y-m-d") . ".log";
        if (!$file->isFile($_file)):
            if (!($statsfile = $file::create($_file) )):
                Debugger::log(_("Could not create the {$class} stats file. Please check that you have write permissions"));
                return false;
            endif;
        endif;
        
        //Store the tick
        $tick = array_merge(array("time"=>time(), "ip"=>$uIp , "inc"=>(!$decrement)?"+1":"-1"), $params);
        $line = json_encode($tick);     
        if (!$file::write($_file, PHP_EOL.$line, "a+")) {
            $config->setError( _t("Could not write out to the stats file"));
            return false;
        }
        
        return;
    }

}