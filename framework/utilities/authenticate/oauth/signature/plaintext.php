<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * plaintext.php
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
 * The PLAINTEXT signature does not provide any security protection and should
 * only be used over a secure channel such as HTTPS.
 *
 * @category   Utility
 * @author     Kohana Team
 * @author     Phil Sturgeon (Original Author)
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @copyright  (c) 2010 Kohana Team
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @license    http://kohanaframework.org/license
 * @license    http://philsturgeon.co.uk/code/dbad-license
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class PLAINTEXT extends OAuth\Signature {

    protected $name = 'PLAINTEXT';

    /**
     * Generate a plaintext signature for the request _without_ the base string.
     *
     *     $sig = $signature->sign($request, $consumer, $token);
     *
     * [!!] This method implements [OAuth 1.0 Spec 9.4.1](http://oauth.net/core/1.0/#rfc.section.9.4.1).
     *
     * @param   Request   request
     * @param   Consumer  consumer
     * @param   Token     token
     * @return  $this
     */
    public function sign(OAuth\Request $request, OAuth\Consumer $consumer, OAuth\Token $token = NULL) {
        // Use the signing key as the signature
        return $this->key($consumer, $token);
    }

    /**
     * Verify a plaintext signature.
     *
     *     if ( ! $signature->verify($signature, $request, $consumer, $token))
     *     {
     *         throw new \Platform\Exception('Failed to verify signature');
     *     }
     *
     * [!!] This method implements [OAuth 1.0 Spec 9.4.2](http://oauth.net/core/1.0/#rfc.section.9.4.2).
     *
     * @param   string          signature to verify
     * @param   Request   request
     * @param   Consumer  consumer
     * @param   Token     token
     * @return  boolean
     */
    public function verify($signature, OAuth\Request $request, OAuth\Consumer $consumer, OAuth\Token $token = NULL) {
        return $signature === $this->key($consumer, $token);
    }

}
