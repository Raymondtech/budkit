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
class Access extends OAuth\Token {

    protected $name = 'access';

    /**
     * @var  string  access_token
     */
    protected $accessToken;

    /**
     * @var  int  expires
     */
    protected $expires;

    /**
     * @var  string  refresh_token
     */
    protected $refreshToken;

    /**
     * @var  string  uid
     */
    protected $uid;

    /**
     * Sets the token, expiry, etc values.
     *
     * @param   array  $options   token options
     *
     * @throws Exception if required options are missing
     */
    public function __construct(array $options = null) {

        if (version_compare( OAuth::$version . ".0", "2.0.0", "<")): //So if using OAuth version lessthan 2 check signatures;
            return parent::__construct( $options );
        else:
            
            if (!isset($options['access_token'])) {
                throw new \Platform\Exception('Required option not passed: access_token' . PHP_EOL . print_r($options, true));
            }

            // if ( ! isset($options['expires_in']) and ! isset($options['expires']))
            // {
            // 	throw new Exception('We do not know when this access_token will expire');
            // }


            $this->accessToken = $options['access_token'];

            // Some providers (not many) give the uid here, so lets take it
            isset($options['uid']) and $this->uid = $options['uid'];

            //Vkontakte uses user_id instead of uid
            isset($options['user_id']) and $this->uid = $options['user_id'];

            //Mailru uses x_mailru_vid instead of uid
            isset($options['x_mailru_vid']) and $this->uid = $options['x_mailru_vid'];

            // We need to know when the token expires, add num. seconds to current time
            isset($options['expires_in']) and $this->expires = time() + ((int) $options['expires_in']);

            // Facebook is just being a spec ignoring jerk
            isset($options['expires']) and $this->expires = time() + ((int) $options['expires']);

            // Grab a refresh token so we can update access tokens when they expires
            isset($options['refresh_token']) and $this->refreshToken = $options['refresh_token'];

        endif;
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