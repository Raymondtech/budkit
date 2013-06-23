<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * facebook.php
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
class Facebook extends OAuth\Provider {

    protected $scope = array('offline_access', 'email', 'read_stream');
    
    public $name = 'facebook';

    public function urlRequestToken() {
        //Not Needed for OAuth2.0;
    }

    public function urlAuthorize() {
        return 'https://www.facebook.com/dialog/oauth';
    }

    public function urlAccessToken() {
        return 'https://graph.facebook.com/oauth/access_token';
    }

    public function getUserInfo() {

        $token =& func_get_arg(0); //Consumer 

        if (!is_a($token, '\Platform\Authenticate\OAuth\Token\Access'))
            throw new \Platform\Exception('First Argument Passed to getUserInfo must be of type OAuth\Token\Access');

        $url = 'https://graph.facebook.com/me?' . http_build_query(array(
              'access_token' => $token->accessToken,
        ));
        
        //Get long lived token;

        $user = json_decode( file_get_contents($url) );

        // Create a response from the request
        return array(
            'uid' => $user->id,
            'nickname' => isset($user->username) ? $user->username : null,
            'name' => $user->name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => isset($user->email) ? $user->email : null,
            'location' => isset($user->hometown->name) ? $user->hometown->name : null,
            'description' => isset($user->bio) ? $user->bio : null,
            'image' => 'https://graph.facebook.com/me/picture?type=normal&access_token=' . $token->accessToken,
            'urls' => array(
                'Facebook' => $user->link,
            ),
        );
    }

}