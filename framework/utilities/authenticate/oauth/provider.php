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
     * @var  string  additional request parameters to be used for remote requests
     */
    public $callback;

    /**
     * @var  string  the method to use when requesting tokens
     */
    protected $method = 'GET';

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

        if (!$this->name) {
            // Attempt to guess the name from the class name
            $this->name = strtolower(get_class($this));
        }

        //The required options are different for OAuth versions
        if (version_compare(Authenticate\OAuth::$version . ".0", "2.0.0", "<")): //So if using OAuth version lessthan 2 check signatures;

            if (isset($options['signature'])) {
                // Set the signature method name or object
                $this->signature = $options['signature'];
            }

            if (!is_object($this->signature)):
                // Convert the signature name into an object
                $this->signature = Signature::forge($this->signature);
            endif;
        else:
            if (empty($options['id'])) {
                throw new \Platform\Exception('Required option not provided: id');
            }

            $this->clientId = $options['id'];

            isset($options['callback']) and $this->callback = $options['callback'];
            isset($options['secret']) and $this->clientSecret = $options['secret'];
            isset($options['scope']) and $this->scope = $options['scope'];

            $this->redirectUri = \Library\Uri::externalize("/system/authenticate/login/handler:oauth/version:2.0/provider:{$this->name}/");

        endif;
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
    abstract public function getUserInfo();

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
     * Parameter getter and setter. Setting the value to `NULL` will remove it.
     *
     *     // Set the "oauth_consumer_key" to a new value
     *     $request->param('oauth_consumer_key', $key);
     *
     *     // Get the "oauth_consumer_key" value
     *     $key = $request->param('oauth_consumer_key');
     *
     * @param   string   parameter name
     * @param   mixed    parameter value
     * @param   boolean  allow duplicates?
     * @return  mixed    when getting
     * @return  $this    when setting
     * @uses    Arr::get
     */
    public function param($name, $value = NULL, $duplicate = FALSE) {
        if ($value === NULL) {
            // Get the parameter
            return isset($this->params[$name]) ? $this->params[$name] : null;
        }

        if (isset($this->params[$name]) AND $duplicate) {
            if (!is_array($this->params[$name])) {
                // Convert the parameter into an array
                $this->params[$name] = array($this->params[$name]);
            }

            // Add the duplicate value
            $this->params[$name][] = $value;
        } else {
            // Set the parameter value
            $this->params[$name] = $value;
        }

        return $this;
    }

    /**
     * Set multiple parameters.
     *
     *     $request->params($params);
     *
     * @param   array    parameters
     * @param   boolean  allow duplicates?
     * @return  $this
     * @uses    Request::param
     */
    public function params(array $params, $duplicate = FALSE) {
        foreach ($params as $name => $value) {
            $this->param($name, $value, $duplicate);
        }

        return $this;
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
    public function authorize(Token\Request $token = NULL, array $options = NULL) {

        //The required options are different for OAuth versions
        if (version_compare(Authenticate\OAuth::$version . ".0", "2.0.0", "<")):
            //So if using OAuth version lessthan 2 check signatures;
            //Create a new GET request for a request token with the required parameters
            $request = Request::forge('authorize', 'GET', $this->urlAuthorize(), array(
                        'oauth_token' => $token->accessToken,
            ));
            if ($options) {
                // Load user parameters
                $request->params($options);
            }
            return $request->asUrl();

        else:
            $state = md5(uniqid(rand(), true));
            \Library\Session::set('state', $state, "auth");

            $params = array(
                'client_id' => $this->clientId,
                'redirect_uri' => isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirectUri,
                'state' => $state,
                'scope' => is_array($this->scope) ? implode($this->scopeSeperator, $this->scope) : $this->scope,
                'response_type' => 'code',
                'approval_prompt' => 'auto' // - google force-recheck
            );

            $params = array_merge($params, $this->params);

            //@TODO Return the authorize URL, Handler will need to redirect
            return $this->urlAuthorize() . '?' . http_build_query($params);
        endif;
    }

    /*
     * Get access to the API
     *
     * @param	string	The access code
     * @return	object	Success or failure along with the response details
     */

    public function access($code, $options = array()) {
        $params = array(
            'client_id' => trim($this->clientId),
            'client_secret' => trim($this->clientSecret),
            'grant_type' => isset($options['grant_type']) ? $options['grant_type'] : 'authorization_code',
        );

        $params = array_merge($params, $this->params);

        switch ($params['grant_type']) {
            case 'authorization_code':
                $params['code'] = $code;
                $params['redirect_uri'] = isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirectUri;
                break;

            case 'refresh_token':
                $params['refresh_token'] = $code;
                break;
        }

        $response = null;
        $url = $this->urlAccessToken();

        switch ($this->method) {
            case 'GET':

                // Need to switch to Request library, but need to test it on one that works
                $url .= '?' . http_build_query($params);
                $response = file_get_contents($url);
                parse_str($response, $return);
                break;

            case 'POST':
                //NOTE this is a faking the post data; but is actually sending via GET;
                //$remote  = $url;
                //$params['redirect_uri']  = Authenticate\OAuth::urlencode( $params['redirect_uri'] );
                //$params['client_secret'] = $this->clientSecret;
                $post =  Authenticate\OAuth::normalizeParams($params);

                $response = Authenticate\OAuth::remote($url, array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_FAILONERROR => false,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POST => true, //POST DATA
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded'
                    ),
                    CURLOPT_POSTFIELDS => $post
                ));
                $return = json_decode($response, true);
                
                break;
            default:
                throw new \Platform\Exception("Method '{$this->method}' must be either GET or POST");
        }

        if (!empty($return['error'])) {
            throw new \Platform\Exception($return);
        }

        switch (trim($params['grant_type'])) {
            case 'authorization_code':
                $token = Token::factory('access', $return);
                break;
            case 'refresh_token':
                $token = Token::factory('refresh', $return);
                break;
        }
        
        return $token;
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
                    'oauth_token' => $token->accessToken,
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