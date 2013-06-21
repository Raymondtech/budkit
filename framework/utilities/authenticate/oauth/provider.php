<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * providers.php
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

namespace Platform\Authenticate\OAuth;

use Platform\Authenticate;

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
abstract class Provider {

    /**
     * @var  string  provider name
     */
    public $name;

    /**
     * @var  string  signature type
     */
    protected $signature = 'HMAC-SHA1';

    /**
     * @var  string  uid key name
     */
    public $uidKey = 'uid';

    /**
     * @var  array  additional request parameters to be used for remote requests
     */
    protected $params = array();

    /**
     * @var  string  scope separator, most use "," but some like Google are spaces
     */
    public $scopeSeperator = ',';

    /**
     * Overloads default class properties from the options.
     *
     * Any of the provider options can be set here:
     *
     * Type      | Option        | Description                                    | Default Value
     * ----------|---------------|------------------------------------------------|-----------------
     * mixed     | signature     | Signature method name or object                | provider default
     *
     * @param   array   provider options
     * @return  void
     */
    public function __construct(array $options = NULL) {
        if (isset($options['signature'])) {
            // Set the signature method name or object
            $this->signature = $options['signature'];
        }

        if (!is_object($this->signature)) {
            // Convert the signature name into an object
            $this->signature = Signature::forge($this->signature);
        }

        if (!$this->name) {
            // Attempt to guess the name from the class name
            $this->name = strtolower(substr(get_class($this), strlen('Provider_')));
        }
    }

    /**
     * Return the value of any protected class variable.
     *
     *     // Get the provider signature
     *     $signature = $provider->signature;
     *
     * @param   string  variable name
     * @return  mixed
     */
    public function __get($key) {
        return $this->$key;
    }

    /**
     * Returns the request token URL for the provider.
     *
     *     $url = $provider->url_request_token();
     *
     * @return  string
     */
    abstract public function urlRequestToken();

    /**
     * Returns the authorization URL for the provider.
     *
     *     $url = $provider->url_authorize();
     *
     * @return  string
     */
    abstract public function urlAuthorize();

    /**
     * Returns the access token endpoint for the provider.
     *
     *     $url = $provider->url_access_token();
     *
     * @return  string
     */
    abstract public function urlAccessToken();

    /**
     * Returns basic information about the user.
     *
     *     $url = $provider->get_user_info();
     *
     * @return  string
     */
    abstract public function getUserInfo(Consumer $consumer, Token $token);

    /**
     * Ask for a request token from the OAuth provider.
     *
     *     $token = $provider->request_token($consumer);
     *
     * @param   Consumer  consumer
     * @param   array           additional request parameters
     * @return  Token_Request
     * @uses    Request_Token
     */
    public function requestToken(Consumer $consumer, array $params = NULL) {
        // Create a new GET request for a request token with the required parameters
        $request = Request::forge('token', 'GET', $this->urlRequestToken(), array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_callback' => $consumer->callback,
                    'scope' => is_array($consumer->scope) ? implode($this->scopeSeperator, $consumer->scope) : $consumer->scope,
        ));

        if ($params) {
            // Load user parameters
            $request->params($params);
        }

        // Sign the request using only the consumer, no token is available yet
        $request->sign($this->signature, $consumer);

        // Create a response from the request
        $response = $request->execute();

        // Store this token somewhere useful
        return Token::forge('request', array(
                    'access_token' => $response->param('oauth_token'),
                    'secret' => $response->param('oauth_token_secret'),
        ));
    }

    /**
     * Get the authorization URL for the request token.
     *
     *     Response::redirect($provider->authorize_url($token));
     *
     * @param   Token_Request  token
     * @param   array                additional request parameters
     * @return  string
     */
    public function authorize(Token\Request $token, array $params = NULL) {
        // Create a new GET request for a request token with the required parameters
        $request = Request::forge('authorize', 'GET', $this->urlAuthorize(), array(
                    'oauth_token' => $token->access_token,
        ));

        if ($params) {
            // Load user parameters
            $request->params($params);
        }

        return $request->asUrl();
    }

    /**
     * Exchange the request token for an access token.
     *
     *     $token = $provider->access_token($consumer, $token);
     *
     * @param   Consumer       consumer
     * @param   Token_Request  token
     * @param   array                additional request parameters
     * @return  Token_Access
     */
    public function accessToken(Consumer $consumer, Token\Request $token, array $params = NULL) {
        // Create a new GET request for a request token with the required parameters
        $request = Request::forge('access', 'GET', $this->urlAccessToken(), array(
                    'oauth_consumer_key' => $consumer->key,
                    'oauth_token' => $token->access_token,
                    'oauth_verifier' => $token->verifier,
        ));

        if ($params) {
            // Load user parameters
            $request->params($params);
        }

        // Sign the request using only the consumer, no token is available yet
        $request->sign($this->signature, $consumer, $token);

        // Create a response from the request
        $response = $request->execute();

        // Store this token somewhere useful
        return Token::forge('access', array(
                    'access_token' => $response->param('oauth_token'),
                    'secret' => $response->param('oauth_token_secret'),
                    'uid' => $response->param($this->uidKey) ? $response->param($this->uidKey) : get_instance()->input->get_post($this->uidKey),
        ));
    }

}