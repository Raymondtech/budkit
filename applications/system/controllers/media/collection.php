<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * collection.php
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
namespace Application\System\Controllers\Media;
use Application\System\Controllers as System;
/**
 * Media collection management CRUD action controller for system media 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of media collections of various posts/media types.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Collection extends System\Media {

    /**
     * The default fall-back method. 
     * @return Collection::read()
     */
    public function index() {
        $view = $this->load->view('collection');
    }
    /**
     * Displays the form required to creates a new collection. 
     * @todo    Implement the create action method
     * @return  {@link \Application\System\Views\Media\Collection::createForm()}
     */
    public function create() {
        $view = $this->load->view('collection');
        return $view->createform();
    }
    /**
     * Updates details of an existing collection.
     * @todo    Implement the collection media update action method
     * @return  void
     */
    public function update($collectionid = null) {
        //There many ways to get the arguents passed here
        $args1 = func_get_args();
        $args = $this->getRequestArgs();
        //print_R($args); print_r($args1); echo $videoid;
    }
    /**
     * Displays an collection media.
     * @todo    Implement the collection read action method
     * @return  void
     */
    public function browse( $collectionId = null ) {
        return $this->index();
    }
    
    
    /**
     * Displays a gallery of media items. 
     * @return void
     */
    public function gallery() {
        
        $this->output->setPageTitle(_("Collections"));

        $today = $this->output->layout("media/collections");
        $this->output->addToPosition("dashboard", $today);
        
        
        $this->load->view("media")->display();   
    }
    
    /**
     * Deletes an existing audio file.
     * @todo    Implement the audio media delete action method
     * @return  void
     */
    public function delete() {  
    }
    /**
     * Get's an instance of the audio controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Audio}
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
