<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * account.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */
namespace Application\Member\Models;

use Platform;
use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Model
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/application
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class User extends Platform\Entity {
  
          
    public function __construct() {
        
        parent::__construct(); 
        
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->extendPropertyModel( 
                array(
                    "user_first_name"    =>array("First Name", "mediumtext", 50),
                    "user_middle_name"   =>array("Middle Name", "mediumtext", 50),
                    "user_last_name"     =>array("Last Name", "mediumtext", 50),
                    "user_name_id"       =>array("User (Nick) Name", "mediumtext", 50),
                    "user_password"      =>array("Password", "varchar", 2000),
                    "user_api_key"       =>array("API Key", "varchar", 100),
                    "user_email"         =>array("email", "varchar", 100),
                ),
                "user"
        );
        //$this->newDataModel( $dataModel ); use this to set a new data models
    }
    /**
     * Store the user data in the database
     * 
     * @param array $data
     * @return boolean
     * @throws \Platform\Exception 
     */
    public function store( $data ){
        
        $encrypt    = \Library\Encrypt::getInstance();
        $authority  = $this->config->getParam( "default-authority", NULL, "profile" );
        
        $data['user_password']   = $encrypt->hash( $data['user_password'] ); 
        
        foreach($data as $property=>$value):
            $this->setPropertyValue($property, $value);
        endforeach;
        
        if(!$this->saveObject($this->getPropertyValue("user_name_id"), "user")){
            //There is a problem!
            return false;
        }
      
        //Default Permission Group?
        if(!empty($authority)){
            $query = "INSERT INTO ?objects_authority( authority_id, object_id ) SELECT {$this->database->quote((int)$authority)}, object_id FROM ?objects WHERE object_uri={$this->database->quote($this->getPropertyValue("user_name_id"))}";
            $this->database->exec($query);
        }
        
        
        return true;
    }
    
    public function load(){}
    
    public function delete(){}
    
    public function validate(){}
    
    public function getToken(){}
    
    public static function getInstance(){
        
        static $instance;
        
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;

        $instance =  new self();

        return $instance;
    }
    
}


