<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * access.php
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

namespace Platform\Authenticate\OAuth\Request;

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
class Access extends OAuth\Request {

    protected $name = 'access';
    protected $required = array(
        'oauth_consumer_key' => TRUE,
        'oauth_token' => TRUE,
        'oauth_signature_method' => TRUE,
        'oauth_signature' => TRUE,
        'oauth_timestamp' => TRUE,
        'oauth_nonce' => TRUE,
        // 'oauth_verifier'         => TRUE,
        'oauth_version' => TRUE,
    );

    public function execute(array $options = NULL) {
        
        return new OAuth\Response(parent::execute($options));
    }

}