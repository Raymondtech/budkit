<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * authorize.php
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

namespace Platform\Authenticate\OAuth\Token;

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
class Authorize extends OAuth\Token {

    protected $name = 'authorize';

    /**
     * @var  string  code
     */
    protected $code;

    /**
     * @var  string  redirect_uri
     */
    protected $redirectUri;

    /**
     * Sets the token, expiry, etc values.
     *
     * @param   array   token options
     * @return  void
     */
    public function __construct(array $options) {

        if (!isset($options['code'])) {
            throw new \Platform\Exception('Required option not passed: code');
        } elseif (!isset($options['redirect_uri'])) {
            throw new \Platform\Exception('Required option not passed: redirect_uri');
        }

        $this->code = $options['code'];
        $this->redirectUri = $options['redirect_uri'];
    }

    /**
     * Sets the token, expiry, etc values.
     *
     * @param   array  $options   token options
     *
     * @throws Exception if required options are missing
     */
    public static function getInstance(array $options = null) {
        return new Authorize($options);
    }

    /**
     * Returns the token key.
     * @return  string
     */
    public function __toString() {
        return (string) $this->code;
    }

}