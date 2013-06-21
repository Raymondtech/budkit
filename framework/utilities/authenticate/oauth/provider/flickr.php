<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * flickr.php
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
class Flickr extends OAuth\Provider {

    public $name = 'flickr';
    public $uidKey = 'user_nsid';

    public function urlRequestToken() {
        return 'http://www.flickr.com/services/oauth/request_token';
    }

    public function urlAuthorize() {
        return 'http://www.flickr.com/services/oauth/authorize';
    }

    public function urlAccessToken() {
        return 'http://www.flickr.com/services/oauth/access_token';
    }

    public function getUserInfo(OAuth\Consumer $consumer, OAuth\Token $token) {
        // Create a new GET request with the required parameters
        $request = OAuth\Request::forge('resource', 'GET', 'http://api.flickr.com/services/rest', array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->access_token,
                    'nojsoncallback' => 1,
                    'format' => 'json',
                    'user_id' => $token->uid,
                    'method' => 'flickr.people.getInfo',
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);

        $response = json_decode($request->execute(), true);
        $user = $response['person'];

        // Create a response from the request
        return array(
            'uid' => $user['nsid'],
            'name' => isset($user['realname']['_content']) ? $user['realname']['_content'] : $user['username']['_content'],
            'nickname' => $user['username']['_content'],
            'location' => isset($user['location']['_content']) ? $user['location']['_content'] : NULL,
            'image' => $user['iconserver'] ? "http://farm{$user['iconfarm']}.staticflickr.com/{$user['iconserver']}/buddyicons/{$user['nsid']}.jpg" : NULL,
            'urls' => array(
                'photos' => $user['photosurl']['_content'],
                'profile' => $user['profileurl']['_content'],
            ),
        );
    }

}