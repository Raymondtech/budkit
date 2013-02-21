<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * page.php
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
namespace Application\Member\Controllers;

/**
 * Page CRUD action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Page extends \Platform\Controller {

    /**
     * The default page view
     * @return voids
     */
    public function index() {
        return $this->read();
    }

    /**
     * Creates a member page. This is not the same as profiles. Members have the 
     * possibility of creating an endless number of pages
     * @todo member pages
     */
    public function create() {   
        $view = $this->load->view("page");
        $view->form();
    }

    /**
     * Reads and displays a member page
     * @return void
     */
    public function read() {
        $view = $this->load->view('page');
    }

    /***
     * Deletes a member page
     * @return false
     */
    public function delete() {
        
    }

    /**
     * Returns an instance of the page controller
     * @staticvar object $instance
     * @return object Page
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
