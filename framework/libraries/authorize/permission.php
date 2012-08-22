<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * permission.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authorize/permission
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library\Authorize;

use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authorize/permission
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Permission extends Library\Observer {

    
    private static function create(){}
    private static function read(){}
    private static function update(){}
    private static function delete(){}

    /** 
     * Checks a user has permission to execute
     *
     * @param type $authority
     * @param array $array
     * @return type 
     */
    public static function execute($action, $params = NULL) {

        $actionController = $params["action"];
        $actionRoute      = $params["route"];
        $actionUser       = $params["user"];
        
        //Test Message
        $actionController->alert("You do not have the relevant authority to access this section of our site. Permission denied for \"{$action}\" on \"{$actionRoute}\"", '<i class="icon icon-lock"></i>', 'error');
        
        
        //If User does not have permission to view this page, redirect them back to homepage
        //$actionController->redirect('/');
        
        return true;
    }
}

