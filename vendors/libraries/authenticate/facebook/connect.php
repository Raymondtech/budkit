<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * connect.php
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

namespace Library\Authenticate\Facebook;

use Library;

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
class Connect extends \Library\Authenticate {

    /**
     * Attest that the username and password are valid
     * 
     * @param array $credentials
     * @return boolean true or false; 
     */
    public function attest($credentials) {

        $facebook = Library\Facebook::getSDKInstance(); //gets an instance of the facebook SDK
        // Create our Application instance (replace this with your appId and secret).
        //1. Get the UserID
        $user = $facebook->getUser();
        echo "attest";
        

        die;


        // If we have a $user id here, it means we know the user is logged into
        // Facebook, but we don't know if the access token is valid. An access
        // token is invalid if the user logged out of Facebook.
        //2. Check we have a user with that ID
        //3. If no user and credentials is empty redirect to a canvas page and asking for additional information;
        //4. If more information submitted with $credentials, and credentials are valid? add user to database and store, 
        //5. if not valid, redirect to signup page
        // We may or may not have this data based on whether the user is logged in.

        return true;
    }

    /**
     * Returns an instance of the authenticate DBAuth class
     * 
     * @staticvar self $instance
     * @param type $id
     * @return self 
     */
    public static function getInstance($id = null) {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self();

        return $instance;
    }

}