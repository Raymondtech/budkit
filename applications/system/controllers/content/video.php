<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * video.php
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
namespace Application\System\Controllers\Content;
use Application\System\Controllers as System;

/**
 * Video CRUD action controller for system content 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of a video.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Video extends \Platform\Controller {
    /**
     * The default fallback method. 
     * @return Video::read()
     */
    public function index() {
        return $this->read();
    }   
    /**
     * Displays the form required to creates a new video. 
     * @todo    Implement the create action method
     * @return  \Application\System\Views\Content\Video::createForm()
     */
    public function create() {            
        $view = $this->load->view('content\video');        
        //get passparams
        $params     = func_get_args();
        $fullscreen = false;
        return $view->createForm( $fullscreen );  
    }  
    /**
     * Updates an existing video.
     * @todo    Implement the video update action method
     * @return  void
     */
    public function update() {}  
    /**
     * Edits an existing video.
     * @todo    Implement the video edit action method
     * @return  void
     */
    public function edit(){   
        echo "editing Applications";       
    }
    /**
     * Displays an video.
     * @todo    Implement the video read action method
     * @return  void
     */
    public function read() {
         $view = $this->load->view('content\video');
    }
    /**
     * Deletes an existing video.
     * @todo    Implement the video delete action method
     * @return  void
     */
    public function delete(){}   
    /**
     * Returns an instance of the video controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Video}
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
