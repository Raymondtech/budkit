<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * location.php
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
 * Location CRUD action controller for system content 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of check-ins.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Location extends \Platform\Controller {

    /**
     * The default fallback method. 
     * @return Location::read()
     */
    public function index() {
        return $this->read();
    }
    /**
     * Displays the form required to create a new location or add a check-in. 
     * @todo    Implement the checkin action method
     * @return  \Application\System\Views\Content\Location::createForm()
     */
    public function checkin() {
        $view = $this->load->view("content/location");
        $view->checkin();
    }
    /**
     * Updates an existing location.
     * @todo    Implement the location update action method
     * @return  void
     */
    public function update() {}  
    /**
     * Edits an existing location.
     * @todo    Implement the location edit action method
     * @return  void
     */
    public function edit(){
    }
    /**
     * Displays an location.
     * @todo    Implement the location read action method
     * @return  void
     */
    public function read() {
         
    }
    /**
     * Displays an locations map.
     * @todo    Implement the location map display action method
     * @return  void
     */
    public function map() {
        //To set the pate title use    
        $this->output->setLayout("explorer");
        $this->output->setPageTitle("Browse Locations");
        $form = $this->output->layout("location/explorer");
        $this->output->addToPosition("body", $form);
    }
    /**
     * Deletes an location article.
     * @todo    Implement the location delete action method
     * @return  void
     */
    public function delete() {      
    }
    /**
     * Returns an instance of the location controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Location}
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
