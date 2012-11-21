<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * date.php
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
class Date extends Object {
    /*
     * @var string
     */

    protected static $timestamp;

    /**
     * Returns todays date timestamp
     * 
     * @return string
     */
    public static function today(){
        
        date_default_timezone_set('UTC');
        
        return date('d/M/Y');
    }

    /**
     * Returns yesterdays date timestamp
     * 
     * @return string
     */
    public static function yesterday() {}

    /**
     * Translated from string to date
     * 
     * @param string $timestring
     * @return string A well formated date 
     */
    public static function translate($timestring) {
        //toggles between a valid timestamp and a string
        //attempts to create a timestamp from a string
        return strtotime($timestring);
    }

    /**
     * Returns the timestamp for the current date
     * 
     * @return string
     */
    public static function getTime() {
        //returns the timestamp for the current date
    }

    /**
     * Get's an instance of the Date time object
     * 
     * @staticvar self $instance
     * @return self 
     */
    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self();

        return $instance;
    }

}