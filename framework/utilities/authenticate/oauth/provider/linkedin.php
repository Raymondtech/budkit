<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * linkedin.php
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
 * OAuth LinkedIn Provider
 *
 * Documents for implementing LinkedIn OAuth can be found at
 * <http://dev.twitter.com/pages/auth>.
 *
 * [!!] This class does not implement the LinkedIn API. It is only an
 * implementation of standard OAuth with Twitter as the service provider.
 *
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
class Linkedin extends OAuth\Provider {

    public $name = 'linkedin';

    public function urlRequestToken() {
        return 'https://api.linkedin.com/uas/oauth/requestToken';
    }

    public function urlAuthorize() {
        return 'https://api.linkedin.com/uas/oauth/authorize';
    }

    public function urlAccessToken() {
        return 'https://api.linkedin.com/uas/oauth/accessToken';
    }

    public function getUserInfo() {
        
        $consumer = func_get_arg(0); //Consumer 
        $token = func_get_arg(1); //Token;
      
        if (!is_a($consumer, '\Platform\Authenticate\OAuth\Consumer'))
            throw new \Platform\Exception('First Argument Passed to getUserInfo must be of type OAuth\Consumer');
        if (!is_a($token, '\Platform\Authenticate\OAuth\Token'))
            throw new \Platform\Exception('Second Argument Passed to getUserInfo must be of type OAuth\Token');

        
        // Create a new GET request with the required parameters
        $url = 'https://api.linkedin.com/v1/people/~:(id,first-name,last-name,headline,member-url-resources,picture-url,location,public-profile-url)';
        $request = OAuth\Request::forge('resource', 'GET', $url, array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->accessToken,
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);

        $user = OAuth\Format::factory($request->execute(), 'xml')->to_array();

        // Create a response from the request
        return array(
            'uid' => $user['id'],
            'name' => $user['first-name'] . ' ' . $user['last-name'],
            'nickname' => end(explode('/', $user['public-profile-url'])),
            'description' => $user['headline'],
            'location' => isset($user['location']['name']) ? $user['location']['name'] : null,
            'urls' => array(
                'Linked In' => $user['public-profile-url'],
            ),
        );
    }

}