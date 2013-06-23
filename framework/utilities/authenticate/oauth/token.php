<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * token.php
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

use Library;

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
abstract class Token {

    /**
     * @var  string  token type name: request, access
     */
    protected $name;

    /**
     * @var  string  token key
     */
    protected $accessToken;

    /**
     * @var  string  token secret
     */
    protected $secret;

    /**
     * @var  string  uid
     */
    protected $uid;

    /**
     * Sets the token and secret values.
     *
     * @param   array   token options
     * @return  void
     */
    public function __construct(array $options = NULL) {
        
        if (!isset($options['access_token'])) {
            throw new \Platform\Exception('Required option not passed: access_token');
        }

        if (!isset($options['secret'])) {
            throw new \Platform\Exception('Required option not passed: secret');
        }

        $this->accessToken = $options['access_token'];
        $this->secret = $options['secret'];

        // If we have a uid lets use it
        isset($options['uid']) and $this->uid = $options['uid'];
    }

    /**
     * Create a new token object.
     *
     *     $token = Token::forge($name);
     *
     * @param   string  token type
     * @param   array   token options
     * @return  Token
     */
    public static function forge($name, array $options = NULL) {

        $name = ucfirst(strtolower($name));
        $class = '\Platform\Authenticate\OAuth\Token\\' . $name;
        return new $class($options);
    }

    /**
     * Alias for Token::forge. Create a new token object.
     *
     *     $token = Token::factory($name);
     *
     * @param   string  $name     token type
     * @param   array   $options  token options
     * @return  OAuth2_Token
     */
    public static function factory($name = 'access', array $options = null) {
        
        $name = ucfirst(strtolower($name));     
        $class = '\Platform\Authenticate\OAuth\Token\\' . $name;
               
        return new $class($options);
    }

    /**
     * Return the value of any protected class variable.
     *
     *     // Get the token secret
     *     $secret = $token->secret;
     *
     * @param   string  variable name
     * @return  mixed
     */
    public function __get($key) {
        return isset($this->$key) ? $this->$key : null;
    }

    /**
     * Return a boolean if the property is set
     *
     *     // Get the token secret
     *     if ($token->secret) exit('YAY SECRET');
     *
     * @param   string  variable name
     * @return  bool
     */
    public function __isset($key) {
        return isset($this->$key);
    }

    /**
     * Returns the token key.
     *
     * @return  string
     */
    public function __toString() {
        return (string) $this->accessToken;
    }

}
