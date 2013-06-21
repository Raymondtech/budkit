<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * dropbox.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform\Authenticate\OAuth\Provider;

use Platform\Authenticate\OAuth;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Phil Sturgeon (Original Author)
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @license    http://philsturgeon.co.uk/code/dbad-license
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Dropbox extends OAuth\Provider {

    public $name = 'dropbox';

    public function urlRequestToken() {
        return 'https://api.dropbox.com/1/oauth/request_token';
    }

    public function urlAuthorize() {
        return 'http://www.dropbox.com/1/oauth/authorize';
    }

    public function urlAccessToken() {
        return 'https://api.dropbox.com/1/oauth/access_token';
    }

    public function getUserInfo(OAuth\Consumer $consumer, OAuth\Token $token) {
        // Create a new GET request with the required parameters
        $request = OAuth\Request::forge('resource', 'GET', 'https://api.dropbox.com/1/account/info', array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->access_token,
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);
        $user = json_decode($request->execute());

        // Create a response from the request
        return array(
            'uid' => $token->uid,
            'name' => $user->display_name,
            'email' => $user->email,
            'location' => $user->country,
        );
    }
}