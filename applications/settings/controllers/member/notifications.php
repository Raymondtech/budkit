<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * notifications.php
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
 * The sub actions controller for notification settings
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Notifications extends Settings\Member {

    /**
     * Displays the notification settings
     * @return void
     */
    public function index() {
        
        $view = $this->load->view('member');
        
        $this->email = \Platform\Mailer::getInstance();
        
        $this->email->from('social@budkit.org', 'Budkit Social');
        $this->email->to('livingstonefultang@gmail.com'); 
        $this->email->cc('livingstonefultang@outlook.com'); 
        $this->email->bcc('l.k.f.fultang@ncl.ac.uk'); 

        $this->email->subject('Budkit test notification mail');
        $this->email->message('This is a test notification email, Just to make sure we can send out emails too');	

        //$this->email->send();
        
        return $view->form("member/notifications", "Notificaiton settings");
    }
    

    public function update() {
        
        if ($this->input->methodIs("post")) {
            $message = "Your notifications preferences have now been updated";
            $messageType = "success";
            //If we can get profile data
            //Get the data;
            if (($data = $this->input->getArray("notifications", array(), "post") ) == FALSE) {
                $this->alert("No input data recieved", 'Something went wrong', 'error');
                $this->redirect($this->input->getReferer());
                return false; //useless
            }       
            //Set the data;
            if (is_array($data) && !empty($data)):
                foreach ($data as $key => $value):
                    //@TODO is this a save way to do this?
                    //Where does the validation happen?
                    $this->config->setParam($key, $value, "notifications");
                endforeach;
            endif;
            //preference model
            $preferences = $this->load->model("preferences","settings");
            if(!$preferences->save("notifications")){
                $message = "Could not update your notification settings";
                $messageType = "error";
            }
        }
        //die;
        $this->alert($message, "", $messageType);
        return $this->returnRequest();
    }

    /**
     * Gets an instance of the notifications settings actions controller
     * @staticvar object $instance
     * @return object Notifications
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
