<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * system.php
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

namespace Application\Settings\Controllers;

/**
 * The Member Settings parent action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class System extends \Platform\Controller {

    /**
     * Displays the default setting form
     * @return void
     */
    public function index() {
        return $this->form();
    }

    /**
     * Displays the configuration form
     * @return boolean
     */
    public function form() {
        $this->output->setPageTitle(_("System Preferences"));
        //$aside  = "Settings Instructions"; 
        $view = $this->load->view('system');
        return $view->form('system/configuration');
    }

    /**
     * Saves configuraiton settings
     * @return boolean
     */
    public function save() {

        $referer = $this->input->getReferer();
        $view = $this->load->view('system');
        $options = $this->load->model('options');

        //Check that we have post data;
        if (!$this->input->methodIs("post")) {
            $this->alert("No configuration data recieved", 'Something went wrong', 'error');
            $this->redirect($referer);
            return false;
        }
        //Get the data;
        if (($data = $this->input->getArray("options", array(), "post") ) == FALSE) {
            $this->alert("No input data recieved", 'Something went wrong', 'error');
            $this->redirect($referer);
            return false; //useless
        }

        //Check that we have a group value
//        if(($group = $this->input->getString("options_group", "system-config", "post") ) == FALSE ){
//            $this->alert("No input data group recieved",'Settings not saved','error' );
//            $this->redirect( $referer );
//            return false; //useless
//        }
        //Check we have all the information we need!
        if (!$options->save($data, null)) {
            $this->alert($options->getError(), 'Something went wrong', 'error');
            $this->redirect($referer);
            return false;
        }
        //Report on state saved
        $this->alert("Your configuration settings have now been saved", "All systems go", "success");
        $this->returnRequest(); //Redirect back to the page sending in the data;

        return true;
    }

    /**
     * Returns an instance of the Settings class
     * @staticvar objects $instance
     * @return object Settings
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
