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
    public function access() {

        $facebook = \Library\Facebook::getSDKInstance(); //gets an instance of the facebook SDK
        $user = $facebook->getUser();

        if (!$user) {
            //Generate facebook URL?
            $args['scope'] = 'read_friendlists,email,offline_access';
            $args['redirect_uri'] = "http://" . \Library\Config::getParam('host') . $this->output->link('/facebook/authenticate/validate');
            $loginUrl = $facebook->getLoginUrl($args);

            $this->redirect($loginUrl);
            //else, get handler and attest authentication;
        }
        //if we have a user validate
        return $this->validate();
    }

    /**
     * 
     */
    public function validate() {

        $facebook = \Library\Facebook::getSDKInstance(); //gets an instance of the facebook SDK
        $user     = $facebook->getUser();
        $model    = $this->load->model("profile", "facebook");
        
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $profile = $facebook->api('/me');
                print_R($profile);
            } catch (FacebookApiException $e) {
                \Platform\Debugger::log($e); //set the error
                $user = null;
            }
            die;              
            $this->redirect( $this->output->link("/system/media/timeline") );
        }
        $this->alert("We were unable to sign you in using facebook, please try again or use an alternative login method", "", "error");
        $this->redirect("/system/authenticate/login");
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

