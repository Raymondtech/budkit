<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * signature.php
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
abstract class Signature {

    /**
     * Create a new signature object by name.
     *
     *     $signature = Signature::forge('HMAC-SHA1');
     *
     * @param   string  signature name: HMAC-SHA1, PLAINTEXT, etc
     * @param   array   signature options
     * @return  Signature
     */
    public static function forge($name, array $options = NULL) {
        $name = str_replace('-', '_', $name);

        // Create the class name as a base of this class
        $class = '\Platform\Authenticate\OAuth\Signature\\' . $name;

        class_exists($class);

        return new $class($options);
    }

    /**
     * @var  string  signature name: HMAC-SHA1, PLAINTEXT, etc
     */
    protected $name;

    /**
     * Return the value of any protected class variables.
     *
     *     $name = $signature->name;
     *
     * @param   string  variable name
     * @return  mixed
     */
    public function __get($key) {
        return $this->$key;
    }

    /**
     * Get a signing key from a consumer and token.
     *
     *     $key = $signature->key($consumer, $token);
     *
     * [!!] This method implements the signing key of [OAuth 1.0 Spec 9](http://oauth.net/core/1.0/#rfc.section.9).
     *
     * @param   Consumer  consumer
     * @param   Token     token
     * @return  string
     * @uses    OAuth::urlencode
     */
    public function key(Consumer $consumer, Token $token = NULL) {
        $key = OAuth::urlencode($consumer->secret) . '&';

        if ($token) {
            $key .= Authenticate\OAuth::urlencode($token->secret);
        }

        return $key;
    }

    abstract public function sign(Request $request, Consumer $consumer, Token $token = NULL);

    abstract public function verify($signature, Request $request, Consumer $consumer, Token $token = NULL);
}
