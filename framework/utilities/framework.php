<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * framework.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/framework
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform;

use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/framework
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Framework extends Library\Object {

    /**
     * Localization
     * 
     * @var array 
     */
    static $object = array();

    /*
     * The class constructor
     * @return void
     */

    public function __construct() {
        $classes = array(
            'i18n' => 'Library\i18n'
        );

        foreach ($classes as $var => $class) {
            $this->$var = $class::getInstance();
        }
    }

    /**
     * Generates a random hex collor
     * 
     * @return type
     */
    final public static function getRandomColor() {
        $letters = "1234567890ABCDEF";
        while (strlen($str) < 6) {
            $pos = rand(1, 16);
            $str .= $letters{$pos};
        }
        return $str;
    }

    /**
     * Returns a random string
     * 
     * @param type $length
     * @return string
     */
    final public static function getRandomString($length = 10, $lowercase = false) {

        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($lowercase):
            $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
        endif;
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    /**
     * Gets an instance of the Framework Class
     * 
     * @staticvar self $instance
     * @return self 
     */
    public static function getInstance() {

        static $instance;

        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new Framework();

        return $instance;
    }

}