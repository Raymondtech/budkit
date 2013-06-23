<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * oauth.php
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

namespace Platform\Authenticate;

use Platform\Authenticate\OAuth;
use Library;
use Platform;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utiltity
 * @author     Phil Sturgeon
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @license    http://philsturgeon.co.uk/code/dbad-license
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class OAuth extends Platform\Authenticate {

    /**
     * @var  string  OAuth compliance version
     */
    public static $version = '1.0';

    public static function provider($name, array $options = NULL) {

        $name = ucfirst(strtolower($name));
        $class = 'Platform\Authenticate\OAuth\Provider\\' . $name;

        if (!class_exists($class))
            return false;

        return new $class($options);
    }

    public static function consumer(array $options = NULL) {
        return new OAuth\Consumer($options);
    }

    /**
     * Returns the output of a remote URL. Any [curl option](http://php.net/curl_setopt)
     * may be used.
     *
     *     // Do a simple GET request
     *     $data = Remote::get($url);
     *
     *     // Do a POST request
     *     $data = Remote::get($url, array(
     *         CURLOPT_POST       => TRUE,
     *         CURLOPT_POSTFIELDS => http_build_query($array),
     *     ));
     *
     * @param   string   remote URL
     * @param   array    curl options
     * @return  string
     * @throws  Exception
     */
    public static function remote($url, array $options = NULL) {
        // The transfer must always be returned
        $options[CURLOPT_RETURNTRANSFER] = TRUE;
        // Open a new remote connection
        $remote = curl_init($url);

        // Set connection options
        if (!curl_setopt_array($remote, $options)) {
            throw new \Platform\Exception('Failed to set CURL options, check CURL documentation: http://php.net/curl_setopt_array');
        }

        // Get the response
        $response = curl_exec($remote);
        
        // Get the response information
        $code = curl_getinfo($remote, CURLINFO_HTTP_CODE);

        if ($code AND ($code < 200 OR $code > 299)) {
            $error = $response;
        } elseif ($response === FALSE) {
            $error = curl_error($remote);
        }

        // Close the connection
        curl_close($remote);

        if (isset($error)) {
            throw new \Platform\Exception(sprintf('Error fetching remote %s [ status %s ] %s', $url, $code, $error));
        }

        return $response;
    }

    /**
     * RFC3986 compatible version of urlencode. Passing an array will encode
     * all of the values in the array. Array keys will not be encoded.
     *
     *     $input = OAuth::urlencode($input);
     *
     * Multi-dimensional arrays are not allowed!
     *
     * [!!] This method implements [OAuth 1.0 Spec 5.1](http://oauth.net/core/1.0/#rfc.section.5.1).
     *
     * @param   mixed   input string or array
     * @return  mixed
     */
    public static function urlencode($input) {
        if (is_array($input)) {
            // Encode the values of the array
            return array_map(array(__CLASS__, 'urlencode'), $input);
        }

        // Encode the input
        $input = rawurlencode($input);

        return $input;
    }

    /**
     * RFC3986 complaint version of urldecode. Passing an array will decode
     * all of the values in the array. Array keys will not be encoded.
     *
     *     $input = OAuth::urldecode($input);
     *
     * Multi-dimensional arrays are not allowed!
     *
     * [!!] This method implements [OAuth 1.0 Spec 5.1](http://oauth.net/core/1.0/#rfc.section.5.1).
     *
     * @param   mixed  input string or array
     * @return  mixed
     */
    public static function urldecode($input) {
        if (is_array($input)) {
            // Decode the values of the array
            return array_map(array(__CLASS__, 'urldecode'), $input);
        }

        // Decode the input
        return rawurldecode($input);
    }

    /**
     * Normalize all request parameters into a string.
     *
     *     $query = OAuth::normalizeParams($params);
     *
     * [!!] This method implements [OAuth 1.0 Spec 9.1.1](http://oauth.net/core/1.0/#rfc.section.9.1.1).
     *
     * @param   array   request parameters
     * @return  string
     * @uses    OAuth::urlencode
     */
    public static function normalizeParams(array $params = NULL) {
        if (!$params) {
            // Nothing to do
            return '';
        }

        // Encode the parameter keys and values
        $keys = OAuth::urlencode(array_keys($params));
        $values = OAuth::urlencode(array_values($params));

        // Recombine the parameters
        $params = array_combine($keys, $values);

        // OAuth Spec 9.1.1 (1)
        // "Parameters are sorted by name, using lexicographical byte value ordering."
        uksort($params, 'strcmp');

        // Create a new query string
        $query = array();

        foreach ($params as $name => $value) {
            if (is_array($value)) {
                // OAuth Spec 9.1.1 (1)
                // "If two or more parameters share the same name, they are sorted by their value."
                $value = natsort($value);

                foreach ($value as $duplicate) {
                    $query[] = $name . '=' . $duplicate;
                }
            } else {
                $query[] = $name . '=' . $value;
            }
        }

        return implode('&', $query);
    }

    /**
     * Parse the query string out of the URL and return it as parameters.
     * All GET parameters must be removed from the request URL when building
     * the base string and added to the request parameters.
     *
     *     // parsed parameters: array('oauth_key' => 'abcdef123456789')
     *     list($url, $params) = OAuth::parseUrl('http://example.com/oauth/access?oauth_key=abcdef123456789');
     *
     * [!!] This implements [OAuth Spec 9.1.1](http://oauth.net/core/1.0/#rfc.section.9.1.1).
     *
     * @param   string  URL to parse
     * @return  array   (clean_url, params)
     * @uses    OAuth::parseParams
     */
    public static function parseUrl($url) {
        if ($query = parse_url($url, PHP_URL_QUERY)) {
            // Remove the query string from the URL
            list($url) = explode('?', $url, 2);

            // Parse the query string as request parameters
            $params = OAuth::parseParams($query);
        } else {
            // No parameters are present
            $params = array();
        }

        return array($url, $params);
    }

    /**
     * Parse the parameters in a string and return an array. Duplicates are
     * converted into indexed arrays.
     *
     *     // Parsed: array('a' => '1', 'b' => '2', 'c' => '3')
     *     $params = OAuth::parseParams('a=1,b=2,c=3');
     *
     *     // Parsed: array('a' => array('1', '2'), 'c' => '3')
     *     $params = OAuth::parseParams('a=1,a=2,c=3');
     *
     * @param   string  parameter string
     * @return  array
     */
    public static function parseParams($params) {
        // Split the parameters by &
        $params = explode('&', trim($params));

        // Create an array of parsed parameters
        $parsed = array();

        foreach ($params as $param) {
            // Split the parameter into name and value
            list($name, $value) = explode('=', $param, 2);

            // Decode the name and value
            $name = OAuth::urldecode($name);
            $value = OAuth::urldecode($value);
            if (isset($parsed[$name])) {
                if (!is_array($parsed[$name])) {
                    // Convert the parameter to an array
                    $parsed[$name] = array($parsed[$name]);
                }

                // Add a new duplicate parameter
                $parsed[$name][] = $value;
            } else {
                // Add a new parameter
                $parsed[$name] = $value;
            }
        }

        return $parsed;
    }

    /**
     * Validates a user oauth credentials
     * 
     * @param type $credentials
     * @param type $input
     */
    public function attest($credentials, $action) {

        //authentication;
        $credentials = array(); //we do not need usernames and passwords here;
        $version = $action->input->getString('version', '1.0');

        switch ($version) {
            case "1.0":
                static::$version = "1.0";
                $credentials = $this->attestOld($credentials, $action);
                break;
            case "2.0":

                static::$version = "2.0";
                //Provision the provider                
                $provider = $action->input->getString('provider', NULL); //must be defined
                $id = Library\Config::getParam("client-id", "", $provider);
                $secret = Library\Config::getParam("client-secret", "", $provider);
                //if no provider or provider not supported throw an error;
                if (empty($provider) OR empty($id) OR empty($secret)):
                    $this->setError(_t('Undefined OAuth Provider or Provider Not Supported. Unable to Authenticate'));
                    return false;
                endif;

                //Create the server;
                $server = $this->provider($provider, array(
                    'id' => $id,
                    'secret' => $secret,
                )); //Load the provider;
                //@TODO can we modify the callback?
                if (!$action->input->getString("code")):
                    $action->redirect($server->authorize());
                else:
                    try {
                        $token          = $server->access($action->input->getString("code"));
                        $user           = $server->getUserInfo($token);                       
                        if(!empty($user)):
                            $credentials = array($provider=>array("token"=>$action->output->serialize($token), "user"=>$user) );
                        endif;
                    } catch (\Platform\Exception $e) {
                        $this->setError(_( 'Could not authenticate you using this method: ' . $e) );
                        return false;
                    }
                endif;
                break;
            default:
                throw new \Platform\Exception("Unsupported OAuth Version {$version}");
                break;
        }
        
        if(!is_array($credentials)||empty($credentials)):
            $this->setError(_t("Could not authenticate via the suggested method"));
            return false;
        endif;
        
        $provider   = array_shift(array_keys($credentials));
        $credential = array_shift($credentials); 
        
        //Match credentials and prepare
        if(!$this->matchCredentials($provider, $credential)){
            //@TODO Save Provider details to session and 
            $session = Library\Session::getInstance();
            
            $session->set('tmp_auth', array($provider=>$credential ) ); //Store the temporary authentication settings
            $message = sprintf('We have been unable to match a registered user with the %s credentials provided. Please sign in with an existing account to pair your %s details or register a new account', $provider, $provider);
            $action->alert( $message, "", "info");
            
            return false;
        }
        
        //Check user credentials against database; if not exists, create one;
        //Populate the authenticated class
        return true;
    }
    
    protected function matchCredentials($provider, array $credentials){
        
        //We need at least the token;
        if(!isset($credentials['token'])) return false;
        
        //Prepare to search user_objects
        $objects   = \Platform\Entity::getInstance();   
        $objects->defineValueGroup("user"); 
        
        $statement     = $objects->getObjectsByPropertyValueMatch( array("user_{$provider}_uid"), array( $credentials['user']['uid'] ) , array("user_name_id", "user_email","user_first_name","user_last_name","user_middle_name"));
        $result        = $statement->execute();
        
        //If we did not find any user with this id or password;
        if ((int) $result->getAffectedRows() < 1) {
            return false;
        }

        //Get the user object;
        $userobject = $result->fetchObject();
        
        //Gets an instance of the session object
        $session = Library\Session::getInstance();
        $authenticate = Platform\Authenticate::getInstance();

        //Destroy this session
        //$session->gc($session->getId());
        $authenticate->authenticated = true;
        $authenticate->type = 'oauth';
        $authenticate->user_id = $userobject->object_id;
        $authenticate->user_name_id = $userobject->user_name_id;
        $authenticate->user_email = $userobject->user_email;
        $authenticate->user_first_name = $userobject->user_first_name;
        $authenticate->user_last_name = $userobject->user_last_name;
        $authenticate->user_full_name    = implode(' ', array($userobject->user_first_name, $userobject->user_middle_name, $userobject->user_last_name) );

        //Update
        $session->set("handler", $authenticate, "auth");
        $session->lock("auth");
        $session->update($session->getId());

        return true;
        
    }

    /**
     * An Attest Method for OAuth1.0
     * 
     * @param type $credentials
     * @param type $action
     * @deprecated since release;
     * 
     */
    protected function attestOld($credentials, $action) {
        //authentication;
        $credentials = array(); //we do not need usernames and passwords here;
        $input = $action->input;
        $provider = $input->getString('provider', NULL); //must be defined

        $server = $this->provider($provider); //Load the provider;
        //if no provider or provider not supported throw an error;
        if (empty($provider) OR !$server):
            $this->setError(_t('Undefined OAuth Provider or Provider Not Supported. Unable to Authenticate'));
            return false;
        endif;

        //1. Instantiate the consumer
        $session = Library\Session::getInstance();
        $key = Library\Config::getParam("consumer-key", "", $provider);
        $secret = Library\Config::getParam("consumer-secret", "", $provider);
        $callback = Library\Uri::externalize("/system/authenticate/login/handler:oauth/provider:{$provider}/");

        //Create the consumer providing a Key and secret from config;
        $consumer = $this->consumer(array("key" => $key, "secret" => $secret));

        //@TODO check that we have a valid consumer created; else, through an error;
        if (!$input->getString("oauth_token")):
            //Add the callback URL to the consumer;
            $consumer->callback($callback);
            //Get a Request Token from the consumer;
            $token = $server->requestToken($consumer);

            //Store the token and Redirect for authorization
            $session->set('oauth_token', $token, "auth"); //session class automatically serializes this data;
            $action->redirect($server->authorize($token, array('oauth_callback' => $callback)));
        else:
            //Recover the request token from session;
            $token = $session->get('oauth_token', "auth");
            if (!empty($token) && $token->accessToken !== $input->getString('oauth_token')):
                $this->setError(_t('Unverifiable request token does not match source. Unable to Authenticate'));
                return false;
            endif;
            //Get the verifieer;
            $verifier = $input->getString('oauth_verifier');
            //Store the verifier in the token
            $token->verifier($verifier);
            //Exchange the Request Token for an access token
            $atoken = $server->accessToken($consumer, $token);

            //get user info and load into credentials;
            $user = $server->getUserInfo($consumer, $atoken);

            if(!empty($user)):
                $credentials  = array($provider=>array("token"=>$action->output->serialize($atoken), "user"=>$user));
            endif;
        endif;

        if (empty($credentials)):
            $this->setError(_t('Could not authenticate the user with the credentials supplied'));
            return false;
        endif;

        return $credentials;
    }

    /**
     * Returns an instance of the oauth class
     * 
     * @staticvar self $instance
     * @param type $id
     * @return self 
     */
    public static function getInstance($config = array()) {

        //getargs , $clientKey, $clientSecret, $signatureMethod, $uriType;
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self($config);

        return $instance;
    }

}