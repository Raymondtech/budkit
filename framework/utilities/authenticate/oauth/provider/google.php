<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * google.php
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

namespace Platform\Authenticate\OAuth\Provider;

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
class Google extends OAuth\Provider {

    public $name = 'google';

    /**
     * @var  string  scope separator, most use "," but some like Google are spaces
     */
    public $scopeSeperator = ' ';

    /**
     * @var  string  the method to use when requesting tokens
     */
    public $method = 'POST';

    public function urlAuthorize() {
        return 'https://accounts.google.com/o/oauth2/auth';
    }

    public function urlAccessToken() {
        return 'https://accounts.google.com/o/oauth2/token';
    }

    public function urlRequestToken() {
       //Not Needed for OAuth2.0;
    }
    
    public function __construct(array $options = array()) {
        // Now make sure we have the default scope to get user data
        empty($options['scope']) and $options['scope'] = array(
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/userinfo.email'
        );

        // Array it if its string
        $options['scope'] = (array) $options['scope'];

        parent::__construct($options);
    }

    /*
     * Get access to the API
     *
     * @param	string	The access code
     * @return	object	Success or failure along with the response details
     */

    public function access($code, $options = array()) {
        
        //$this->params = array('approval_prompt'=>'force'); //force prompt
        
        if ($code === null) {
            throw new \Platform\Exception('Expected Authorization Code from ' . ucfirst($this->name) . ' is missing');
        }
        return parent::access($code, $options);
    }

    public function getUserInfo() {
        
        $token = func_get_arg(0); //Consumer 

        if (!is_a($token, '\Platform\Authenticate\OAuth\Token\Access'))
            throw new \Platform\Exception('First Argument Passed to getUserInfo must be of type OAuth\Token\Access');

        $url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&' . http_build_query(array(
                    'access_token' => $token->accessToken,
        ));

        $user = json_decode(file_get_contents($url), true);
        return array(
            'uid' => $user['id'],
            'nickname' => url_title($user['name'], '_', true),
            'name' => $user['name'],
            'first_name' => $user['given_name'],
            'last_name' => $user['family_name'],
            'email' => $user['email'],
            'location' => null,
            'image' => (isset($user['picture'])) ? $user['picture'] : null,
            'description' => null,
            'urls' => array(),
        );
    }

}