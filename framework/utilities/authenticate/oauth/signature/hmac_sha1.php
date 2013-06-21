<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * hmac-sha1.php
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

namespace Platform\Authenticate\OAuth\Signature;

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
class HMAC_SHA1 extends OAuth\Signature {

    protected $name = 'HMAC-SHA1';

    /**
     * Generate a signed hash of the base string using the consumer and token
     * as the signing key.
     *
     *     $sig = $signature->sign($request, $consumer, $token);
     *
     * [!!] This method implements [OAuth 1.0 Spec 9.2.1](http://oauth.net/core/1.0/#rfc.section.9.2.1).
     *
     * @param   Request   request
     * @param   Consumer  consumer
     * @param   Token     token
     * @return  string
     * @uses    Signature::key
     */
    public function sign(OAuth\Request $request, OAuth\Consumer $consumer, OAuth\Token $token = NULL) {
        // Get the signing key
        $key = $this->key($consumer, $token);

        // Get the base string for the signature
        $baseString = $request->baseString();

        // Sign the base string using the key
        return base64_encode(hash_hmac('sha1', $baseString, $key, TRUE));
    }

    /**
     * Verify a HMAC-SHA1 signature.
     *
     *     if ( ! $signature->verify($signature, $request, $consumer, $token))
     *     {
     *         throw new \Platform\Exception('Failed to verify signature');
     *     }
     *
     * [!!] This method implements [OAuth 1.0 Spec 9.2.2](http://oauth.net/core/1.0/#rfc.section.9.2.2).
     *
     * @param   string          signature to verify
     * @param   Request   request
     * @param   Consumer  consumer
     * @param   Token     token
     * @return  boolean
     */
    public function verify($signature, OAuth\Request $request, OAuth\Consumer $consumer, OAuth\Token $token = NULL) {
        return $signature === $this->sign($request, $consumer, $token);
    }

}
