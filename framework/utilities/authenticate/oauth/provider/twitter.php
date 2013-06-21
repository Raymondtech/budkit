<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * twitter.php
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
class Twitter extends OAuth\Provider {

    public $name = 'twitter';
    public $uidKey = 'user_id';

    public function urlRequestToken() {
        return 'https://api.twitter.com/oauth/request_token';
    }

    public function urlAuthorize() {
        return 'https://api.twitter.com/oauth/authenticate';
    }

    public function urlAccessToken() {
        return 'https://api.twitter.com/oauth/access_token';
    }

    public function getUserInfo(OAuth\Consumer $consumer, OAuth\Token $token) {
        // Create a new GET request with the required parameters
        $request = OAuth\Request::forge('resource', 'GET', 'http://api.twitter.com/1.1/users/lookup.json', array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->access_token,
                    'user_id' => $token->uid,
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);

        $user = current(json_decode($request->execute()));

        // Create a response from the request
        return array(
            'uid' => $token->uid,
            'nickname' => $user->screen_name,
            'name' => $user->name ? $user->name : $user->screen_name,
            'location' => $user->location,
            'image' => $user->profile_image_url,
            'description' => $user->description,
            'urls' => array(
                'Website' => $user->url,
                'Twitter' => 'http://twitter.com/' . $user->screen_name,
            ),
        );
    }

}
