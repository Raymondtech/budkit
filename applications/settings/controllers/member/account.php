<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * account.php
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
namespace Application\Settings\Controllers\Member;

use \Application\Settings\Controllers as Settings;
/**
 * The sub actions controller for managing account settings
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Account extends Settings\Member {

    
    public function __construct() {
        parent::__construct();
        $this->email = \Platform\Mailer::getInstance();
    }
    
    /**
     * Displays the account settings form
     * @return void
     */
    public function index(){      
 
        $user = \Platform\User::getInstance();

        $view = $this->load->view('member');
        $_profile = $this->load->model('profile', 'member');
        $profile  = $_profile->loadObjectByURI( $user->get("user_name_id"), array_keys($_profile->getPropertyModel()));

        $data = $profile->getPropertyData();

        //overload user var with profile data
        $this->set("account", $data); //Sets the profile data;
        
        $this->email->from('budkit@budkit.org', 'Budkit Social');
        $this->email->to('livingstonefultang@gmail.com'); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 
        $this->email->setProtocol('sendmail');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');	

        $this->email->send();
        
        
        return $view->form();    
    }
        /**
     * Updates an existing account
     * @return boolean
     */
    public function update() {

        //1. Load the model
        $account = $this->load->model("user", "member");
        $encrypt = \Library\Encrypt::getInstance();

        //2. Prevalidate passwords and other stuff;
        $username = $this->input->getString("user_first_name", "", "post", FALSE, array());
        $usernameid = $this->input->getString("user_name_id", "", "post", FALSE, array());
        $userpass = $this->input->getString("user_password", "", "post", FALSE, array());
        $userpass2 = $this->input->getString("user_password_2", "", "post", FALSE, array());
        $useremail = $this->input->getString("user_email", "", "post", FALSE, array());
        //3. Encrypt validated password if new users!
        //4. If not new user, check user has update permission on this user
        //5. MailOut

        if (empty($userpass) || empty($username) || empty($usernameid) || empty($useremail)) {
            //Display a message telling them what can't be empty
            $this->alert(_t('Please provide at least a Name, Username, E-mail and Password'), _t('Not enough information!'), "error");
            return false;
        }

        //3. Encrypt validated password if new users!
        //4. If not new user, check user has update permission on this user
        //5. MailOut

        if (empty($userpass) || empty($username) || empty($usernameid) || empty($useremail)) {
            //Display a message telling them what can't be empty
            $this->alert(_t('Please provide at least a Name, Username, E-mail and Password'));
            return false;
        }

        //Validate the passwords
        if ($userpass <> $userpass2) {
            $this->alert(_t('The user passwords do not match'));
            return false;
        }

        //6. Store the user
        if(!$account->store($this->input->data("post")) ):
            $this->alert( $this->getError() );
            return false;
        endif;
        
        
        return true;
        //7. Browser Messages
        //Return to index
        //return $this->view();
    }
    
    public function resetkey(){
        
        $random     = \Platform\Framework::getRandomString(32);
        $user       = $this->load->model("user", "member");
 
        if(!$user->update($this->user->get('user_name_id') , array("user_api_key"=>$random))){
            $this->alert($user->getError(),"An Error Occured","error");
            $this->returnRequest();
        }   
        
        $this->alert("Your API Key has now been changed to {$random}. Keep it Safe","API Key changed","success");  
        $this->returnRequest();
    }


    /**
     * Deletes a member account
     * @todo Member account deleting
     * @return void
     */
    public function delete(){}

    /**
     * Returns an instance of the account settings action controller
     * @staticvar object $instance
     * @return object Account
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
