<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * authenticate.php
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

namespace Application\Facebook\Models;

/**
 * Models the system menu items for display
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Authenticate extends \Platform\Entity {

    /**
     * Returns the login Link, also hooked to beforeLoginFormDraw to add alternative login methods
     * 
     * @param type $alternatives
     */
    public function addLoginLink(&$alternatives = array()) {

        if (!is_array($alternatives))
            return;

        $facebook = \Library\Facebook::getSDKInstance(); //gets an instance of the facebook SDK

        //Generate facebook URL?
        $args['scope'] = 'read_friendlists,email,offline_access';
        $args['redirect_uri'] = "http://" . \Library\Config::getParam('host') . \Library\Uri::internal('/facebook/authenticate/attest');
        $loginUrl = $facebook->getLoginUrl( $args );

        $fblogin = array(
            "link" => $loginUrl,
            "title" => "facebook",
            "uid" => "facebook"
        );

        //add facebook to the list of alternative logins
        $alternatives[] = $fblogin;

        return $loginUrl;
    }

    /**
     * This model has no data to display
     * @return boolean
     */
    public function display() {
        return false;
    }

    /**
     * Returns an instance of the user EAV model
     * @staticvar object $instance
     * @return object User
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

