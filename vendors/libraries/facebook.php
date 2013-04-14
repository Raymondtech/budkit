<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * facebook.php
 *
 * Requires PHP version 5.3
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/i18n
 * @since      Class available since Release 1.0.0 Jan 15, 2012 3:09:41 AM
 * 
 */

namespace Library;

/**
 * Proxy library class for the facebook SDK
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Libraries
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/i18n
 * @since      Class available since Release 1.0.0 Jan 15, 2012 3:09:41 AM
 */
class Facebook {

    static $instance;
    static $sdkInstance;

    public static function getSDKInstance() {

        if (is_object(static::$sdkInstance) && is_a(static::$sdkInstance, '\Facebook'))
            return static::$sdkInstance;

        //Probably use a configuratio but naa..
        $sdkPath = pathinfo(__FILE__, PATHINFO_DIRNAME) . DS . "facebook" . DS . "facebook.php";
        $sdkConfig = Config::getInstance();

        require_once( $sdkPath );

        $appId = $sdkConfig->getParam("app-id", 'YOUR_APP_ID', 'facebook');
        $secret = $sdkConfig->getParam("app-secret", 'YOUR_APP_SECRET', 'facebook');
        //$config['cookie'] = true; 
        //$config['fileUpload'] = false; // optional
        //$shared = $sdkConfig->getParam("app-shared-session", true , 'facebook');
        //if(!empty($shared)) $config['sharedSession'] = true;
        //$config['trustForwarded'] = true;

        static::$sdkInstance = new \Facebook(array(
                    'appId' => $appId,
                    'secret' => $secret,
                ));

        return static::$sdkInstance;
    }

    public static function getInstance() {
        if (is_object(static::$instance) && is_a(static::$instance, '\Library\Facebook'))
            return static::$instance;
        static::$instance = new self();
        return static::$instance;
    }

}
