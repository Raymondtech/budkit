<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * user.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 * 
 */
namespace Platform;

use Library;

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
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class User extends Library\Object {

    protected $authenticated;
    
    protected $authority;
    
    static $instance;

    /**
     * Returns an instance of the User Object
     * 
     * @return type
     */
    public static function getInstance() {
        
        //If the class was already instantiated, just return it
        if (isset(static::$instance) && is_a(static::$instance, "User"))
            return static::$instance;

        static::$instance = new self();

        return static::$instance;
    }

    /**
     * Returns the user object with the current use loaded
     * 
     * @param type $id 
     */
    public static function _($userid = NULL) {}
    
    
    /**
     * Method to determine if the user is authenticated;
     * 
     * @return type 
     */
    public function isAuthenticated(){
        return (bool)$this->authenticated;
    }
    
    /**
     * Determins if a user is authenticated
     * @return type 
     */
    public static function getAuthenticated(){
        
        $authenticated = Library\Session::isAuthenticated();
        
        if($authenticated){
           return Library\Session::getInstance()->get("handler", "auth");
        }
        
        else return false;
    }

    /**
     * Constructs the user proxy object
     * 
     * @param type $userid
     */
    public function __construct($userid = null) {
        //@TODO Rework the userid, use case, if user id is not provided or is null
        //Get the authenticated user
        //Also load some user data from the user database table, some basic info
        $this->authenticated = false;

        //Authenticate
        $authenticate = Library\Session::getInstance()->get("handler", "auth");

        if (is_a($authenticate, "Library\Authenticate")) {
            if ($authenticate->authenticated) {
                $this->authenticated = true;
                if (empty($userid) || $userid === (int) $authenticate->get("userid")) {
                    $data = $authenticate->get(array("user_id", "user_email", "user_full_name", "user_first_name", "user_name_id", "language", "timezone"));
                    foreach ($data as $property => $value) {
                        $this->$property = $value;
                    }
                }
                $this->user_id   = $authenticate->get("user_id");
                $this->user_email    = $authenticate->get("user_email"); 
                $this->user_name_id    = $authenticate->get("user_name_id"); 
                $this->user_full_name   = $authenticate->get("user_full_name");
                $this->isauthenticated = $this->authenticated;
            }
            //get authority;
            $this->authority = Library\Session::getInstance()->getAuthority();    
        }
    }
}