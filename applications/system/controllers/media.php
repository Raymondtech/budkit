<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * media.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 */

namespace Application\System\Controllers;

/**
 * The parent action controller for all system media types
 *
 * Defines common action methods for the managing the default system media types
 * It is important that you inherit the key features defined in this class
 * when defining media types
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
Class Media extends \Platform\Controller {

    public function index() {
        return false;
    }

    public function create($action = NULL) {
        return $this->edit($action);
    }

    public function edit($form = NULL) {
        
        $this->output->setPageTitle(_("Add New Media"));        
        $this->view = $this->load->view('media');
        


         //Adds the default forms to the view forms list unless one is specified   
//        \Library\Event::register("beforeEditorDisplay", function(&$formlist = array()) use($forms){
//            $formlist =  array_merge( $formlist, $forms);
//        });
        
        //form
        $this->view->editor( $form );
        $layout = $this->output->layout('forms/form', 'system');

        $this->output->addToPosition("dashboard", $layout);

        $this->view->display(); //sample call;   
        //$this->output->addToPosition("right", $right );
    }

    public function timeline() {
        $timeline = $this->load->controller("media\\timeline", "system");
        return $timeline->index();
    }

    /**
     * Displays an collection media.
     * @todo    Implement the collection read action method
     * @return  void
     */
    public function view($mediaObjectURI = null) {
        $timeline = $this->load->controller("media\\timeline", "system");
        return $timeline->view($mediaObjectURI,"attachment");
    }

    /**
     * Returns an instance of the media controller
     * @staticvar self $instance
     * @return Media 
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

