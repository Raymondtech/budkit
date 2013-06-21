
<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * tumblr.php
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
 * OAuth Tumblr Provider
 *
 * Documents for implementing Tumblr OAuth can be found at
 * <http://tumblr.com/api>.
 *
 * [!!] This class does not implement the Tumblr API. It is only an
 * implementation of standard OAuth with Tumblr as the service provider.
 *
 * @category   Utility
 * @author     Fuel Development Team
 * @author     Phil Sturgeon (Original Author)
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @license    http://philsturgeon.co.uk/code/dbad-license
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Tumblr extends OAuth\Provider {

    public $name = 'tumblr';

    public function urlRequestToken() {
        return 'http://www.tumblr.com/oauth/request_token';
    }

    public function urlAuthorize() {
        return 'http://www.tumblr.com/oauth/authorize';
    }

    public function urlAccessToken() {
        return 'http://www.tumblr.com/oauth/access_token';
    }

    public function getUserInfo(OAuth\Consumer $consumer, OAuth\Token $token) {
        // Create a new GET request with the required parameters
        $request = OAuth\Request::forge('resource', 'GET', 'http://api.tumblr.com/v2/user/info', array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->access_token,
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);
        $response = json_decode($request->execute());
        $status = current($response);
        $response = next($response);
        $user = $response->user;

        // Create a response from the request
        return array(
            'uid' => $user->name, // Tumblr doesn't provide a unique key other than name
            'name' => $user->name,
            'likes' => $user->likes,
            'following' => $user->following,
            'default_post_format' => $user->default_post_format,
        );
    }

}