<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * session.php
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
namespace Application\System\Controllers;

/**
 * Action Controller for managing member sessions
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Authenticate extends \Platform\Controller {

    /**
     * This action controller does not need an index
     * @return void
     */
    public function index() {
        //@TODO raise an error!
    }
    
    /**
     * Creates a new user
     * @return void
     */
    public function create(){
        //If user has indicated its not them, clear the temp auth details;
        $cleartemp  = $this->input->getInt("cleartemp");
        if($cleartemp):
            \Library\Session::remove("tmp_auth");
        endif;
        
        $view = $this->load->view("authenticate");
        //Get the member account controller;
        if($this->input->methodIs('post')):
            $account = $this->load->controller("member\account", "settings"); //The member account controlle
            if($account->update()){
                $this->alert("The account has been created. Please check your email on what to do next. If your account has already been verified, you can now log-in below","Fantastico!","success");
                $this->redirect("/sign-in"); //Now signIn
            }
        endif;
        $view->newUserAccountForm();
    }
    
    /**
     * Returns an instance of the session action controller
     * @staticvar object $instance
     * @return object Session
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
