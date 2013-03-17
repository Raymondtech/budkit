<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * event.php
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
 * Event CRUD action controller. 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of events.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Event extends System\Content {
    
    /**
     * Displays the form required to creates a new event. 
     * @todo    Implement the create event method
     * @return  \Application\System\Views\Content\Event::createForm()
     */
    public function create() {
        $view = $this->load->view('content\event');
        return $view->createForm();
    }
    /**
     * Updates an existing event.
     * @todo    Implement the event update action method
     * @return  Void
     */
    public function update() {}  
    /**
     * Edits an existing event.
     * @todo    Implement the event edit action method
     * @return  Void
     */
    public function edit(){}
    /**
     * Displays a calendar of events. 
     * @todo    Implement the listing of events within the displayed calendar
     * @return  See {@link \Application\System\Views\Content\Event::drawCalendar()}
     */
    public function calendar() {
        $view = $this->load->view('content\event');
        $user = \Platform\User::getInstance();

        $this->set("user", $user);
        $this->output->setPageTitle(_("Event calendar"));      
        $view->drawCalendar();
    }
    /**
     * Deletes an existing article.
     * @todo    Implement the article delete action method
     * @return  Void
     */
    public function delete() {    
    }
    /**
     * Returns and instance of the event class
     * @staticvar self $instance
     * @return an instance of {@link Event} 
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
