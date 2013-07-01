<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * cache.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/date
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/date
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Cache extends Object {

    static $instance;
    
    public function __construct($driver='file'){}
    public static function hasDriver($driver){}
    public static function read($id){}
    public static function delete($id){}
    public static function save($id, $data, $expires = 60){}
    public static function clean(){}
    public static function readMeta($id){}
    public static function info(){}

    /**
     * Returns an instance of the cache Class
     * 
     * @staticvar \Library\Cache $instance
     * @return \Library\Cache
     */
    public static function getInstance( $driver = 'file' ) {
        //If the class was already instantiated, just return it
        if (isset(static::$instance))
            return static::$instance;
        static::$instance = new Cache( $driver );
        return static::$instance;
    }
}