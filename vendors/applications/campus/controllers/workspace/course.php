<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * course.php
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
namespace Application\Campus\Controllers;

use Platform;
use Library;
use Application\Campus\Views as View;

/**
 * Course CRUD action controller for Campus 
 *
 * The course class implements the action controller that manages the creation, 
 * view and edit of courses within the campus application.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Course extends Platform\Controller {

    /**
     * The default fallback method. 
     * @return  void
     */
    public function index() {
        return null;
    }

    /**
     * Get's an instance of the Course controller only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Course}
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
