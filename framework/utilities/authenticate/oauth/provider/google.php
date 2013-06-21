<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * google.php
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
class Google extends OAuth\Provider {

    public $name = 'google';

    /**
     * @var  string  scope separator, most use "," but some like Google are spaces
     */
    public $scopeSeperator = ' ';

    public function urlRequestToken() {
        return 'https://www.google.com/accounts/OAuthGetRequestToken';
    }

    public function urlAuthorize() {
        return 'https://www.google.com/accounts/OAuthAuthorizeToken';
    }

    public function urlAccessToken() {
        return 'https://www.google.com/accounts/OAuthGetAccessToken';
    }

    public function __construct(array $options = array()) {
        // Now make sure we have the default scope to get user data
        $options['scope'] = \Arr::merge(
                        // We need this default feed to get the authenticated users basic information
                        // array('https://www.googleapis.com/auth/plus.me'),
                        array('https://www.google.com/m8/feeds'),
                        // And take either a string and array it, or empty array to merge into
                        (array) \Arr::get($options, 'scope', array())
        );

        parent::__construct($options);
    }

    public function getUserInfo(OAuth\Consumer $consumer, OAuth\Token $token) {
        // Create a new GET request with the required parameters
        $request = Request::forge('resource', 'GET', 'https://www.google.com/m8/feeds/contacts/default/full?max-results=1&alt=json', array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->access_token,
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);

        $response = json_decode($request->execute(), true);

        // Fetch data parts
        $email = \Arr::get($response, 'feed.id.$t');
        $name = \Arr::get($response, 'feed.author.0.name.$t');
        $name == '(unknown)' and $name = $email;

        return array(
            'uid' => $email,
            'nickname' => \Inflector::friendly_title($name),
            'name' => $name,
            'email' => $email,
            'location' => null,
            'image' => null,
            'description' => null,
            'urls' => array(),
        );
    }

}