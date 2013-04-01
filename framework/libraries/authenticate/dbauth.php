<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * dbauth.php
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
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library\Authenticate;

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
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class DbAuth extends \Library\Authenticate {

    /**
     * Attest that the username and password are valid
     * 
     * @param array $credentials
     * @return boolean true or false; 
     */
    public function attest($credentials) {

        //Pre-requisites;
        $database = Library\Database::getInstance();
        $encrypt = Library\Encrypt::getInstance();
        $validate = Library\Validate::getInstance();

        //If not credentials
        if (empty($credentials) || !array_key_exists("usernameid", $credentials) || !array_key_exists("usernamepass", $credentials)) {
            $this->setError(_t('Must specify a valid usernameid and password'));
            return false;
        }

        //We don't want empty passwords or usernames;
        if (empty($credentials['usernamepass']) || empty($credentials['usernamepass'])) {
            $this->setError(_t('Must specify a valid usernameid and password'));
            return false;
        }

        //If usernameid an email 
        $usernameid = $credentials['usernameid'];
        $objects   = \Platform\Entity::getInstance();
        
        $objects->defineValueGroup("user"); //Means we are getting the data from the users value proxy table;
        
        $object     = $objects->getObjectsByPropertyValueMatch( array("user_email"), array( $usernameid ) , array("user_password", "user_name_id", "user_email","user_first_name","user_last_name","user_middle_name"));
        

        if ($validate->email($credentials['usernameid'])) {
            //treat as user_email, 
            $statement = $objects->getObjectsByPropertyValueMatch( array("user_email"), array( $usernameid ) , array("user_password","user_name_id", "user_email","user_first_name","user_last_name","user_middle_name")); //Use EAV to get data;
        } else {
            //use as user_name_id
            $statement = $objects->getObjectsByPropertyValueMatch( array("user_name_id"), array( $usernameid ) , array("user_password","user_name_id", "user_email","user_first_name","user_last_name","user_middle_name")); //Use EAV to get the data
        }

        $result = $statement->execute();
        

        //If we did not find any user with this id or password;
        if ((int) $result->getAffectedRows() < 1) {
            return false;
        }

        //Get the user object;
        $userobject = $result->fetchObject();
        $passparts = explode(":", $userobject->user_password);
  
        $passhash = $encrypt->hash( $credentials['usernamepass'], $passparts[1]);

        //Are the passhashes similar?
        if ($passhash !== $userobject->user_password) {
            $this->setError(_t('Could not authenticate the user with the credentials supplied'));
            return false;
        }

        //Gets an instance of the session object
        $session = Library\Session::getInstance();
        $authenticate = Library\Authenticate::getInstance();

        //Destroy this session
        //$session->gc($session->getId());

        $authenticate->authenticated = true;
        $authenticate->type = 'dbauth';
        $authenticate->user_id = $userobject->object_id;
        $authenticate->user_name_id = $userobject->user_name_id;
        $authenticate->user_email = $userobject->user_email;
        $authenticate->user_first_name = $userobject->user_first_name;
        $authenticate->user_last_name = $userobject->user_last_name;
        $authenticate->user_full_name    = implode(' ', array($userobject->user_first_name, $userobject->user_middle_name, $userobject->user_last_name) );

        //Update
        $session->set("handler", $authenticate, "auth");
        $session->lock("auth");
        $session->update($session->getId());

        return true;
    }

    /**
     * Returns an instance of the authenticate DBAuth class
     * 
     * @staticvar self $instance
     * @param type $id
     * @return self 
     */
    public static function getInstance($id=null) {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self();

        return $instance;
    }

}