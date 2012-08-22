<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * database.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/config
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library\Config;

use Library;
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/config
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Database extends \Library\Object  {
    
    static protected $params = array();
    
    public static function getParams(){

        return static::$params;
    }
    
    public static function saveParams(){}
    
    /**
     * Reads the database configuration 
     * 
     * @return void
     */
    public static function readParams(){
        
        //print_R(static::$params);
        $database   = \Library\Database::getInstance();
        //$token = (string) $input->getCookie($sessId);
        $statement  = $database->select("`option_group_id` as `section`,`option_name` as `param`, `option_value` as `value`")->from("?options")->where("option_autoload", $database->quote("yes"))->prepare();
        $result     = $statement->execute();

        //Create the database config param
        while($option = $result->fetchArray()){
            static::$params[$option['section']][$option["param"]] = $option["value"];
        }
        //Do we have a session that fits this criteria in the db? if not destroy
        
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

        $instance = new self();
        $instance->readParams();

        return $instance;
    }

}