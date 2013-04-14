<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * audio.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 * 
 */

namespace Application\Facebook\Controllers;

final class Authenticate extends \Platform\Controller {

    /**
     * The default fall-back method. 
     * @return boolean
     */
    public function index() {
        return false;
    }
  
    /**
     * 
     */
    public function attest() {

        $facebook = \Library\Facebook::getSDKInstance(); //gets an instance of the facebook SDK
        $user = $facebook->getUser();
     
        $naitik = $facebook->api('/naitik');

        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $profile = $facebook->api('/me');print_R($profile);
            } catch (FacebookApiException $e) {
                \Platform\Debugger::log($e); //set the error
                //$user = null;
            }
            
            if (!empty($profile)):
                $model = $this->load->model("authenticate", "facebook");
            //1. check that we have a user in the databse with user_facebook_id = 
            //2. Due to our data eav data model where the user_facebook_id has no unique key, we allow the user to use the same facebook acount on multiple accounts
            //3. If there is no user redirect to new sign up form;
            endif;
            $this->redirect($this->output->link("/system/media/timeline"));
        }
        $this->alert("We were unable to sign you in using facebook, please try again or use an alternative login method", "", "error");
        //$this->redirect("/system/authenticate/login");
        
        print_R($_REQUEST);
    }

    /**
     * Get's an instance of the audio controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Action}
     * 
     */
    public static function getInstance() {
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;
        $instance = new self;
        return $instance;
    }

}

