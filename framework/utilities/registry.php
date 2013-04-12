<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * registry.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/framework
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/framework
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Registry {

    public $variables = array();

    public function setVar($name, $value = null) {
        $this->variables[$name] = $value;
        return true;
    }

    public function getVar($name, $default = NULL) {
        if($this->issetVar($name)):
            return $this->variables[$name];
        else:
            return $default;
        endif;
    }

    public function issetVar($name) {
        return isset($this->variables[$name]);
    }

    public function unsetVar($name){
        unset($this->variables[$name]);
        return true;
    }

    /**
     * Gets an instance of the Framework Class
     * 
     * @staticvar self $instance
     * @return self 
     */
    public static function getInstance() {
        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;
        $instance = new Registry();

        return $instance;
    }

}