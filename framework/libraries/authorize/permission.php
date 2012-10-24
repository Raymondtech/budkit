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
    
    
    protected static $grantedTo = array();
    protected static $rejectedTo = array(); 

    /** 
     * Checks a user has permission to execute
     *
     * @param type $authority
     * @param array $array
     * @return type 
     */
    public static function execute($action, $params = NULL) {
        
        $permissionTypes  = array("view"=>1,"execute"=>2,"modify"=>3,"special"=>4);
        
        //If action not in our types return false;
        if(!array_key_exists(strtolower($action), $permissionTypes)) return false;
        
        
        $actionController = $params["action"];
        $actionRoute      = $params["route"];
        $actionUser       = $params["user"];
        $action           = trim($action);
        $database         = Library\Database::getInstance();
        

        //Get Permission Definitions
        $premissionsSQLc  = "SELECT p.*, a.lft, a.rgt, a.authority_name,a.authority_parent_id FROM ?authority_permissions AS p LEFT JOIN ?authority AS a ON p.authority_id=a.authority_id WHERE {$database->quote($actionRoute)} REGEXP p.permission_area_uri ORDER BY a.lft ASC"; 
        $permissionsSQL   = $database->prepare( $premissionsSQLc );
        $permissions      = $permissionsSQL->execute()->fetchAll();
        
        //Build Permission Tree;
        //@TODO We will eventually need to crunch this permission tree maps based on area_uri to find the best fit.
        //ATM /* will capture every possible url, so allow on /* and denying on /x/y/z/* still allows the permisison.
        //Will need to come up with a sort of permission hierachy where if /x/y/z is defined, ignore /*
        $permissionTree   = array();
        $right            = array();
        $denied           = array();
        
        //List all permissions as defined!
        //Think of it as a guest list. We shall list only the authorities with allowed permissions
        //Next we shall check the users authorities against this list, if they match then they are allowed.
        //We will keep searching till we find a match otherwise failed.
        foreach($permissions as $authority ) {
             if (count($right) > 0) {
                while ($right[count($right) - 1] < $authority['rgt']) {
                    array_pop($right);
                }
            }
            //Authority Indent
            $authority["indent"] = sizeof($right);
            $authority["permission"] = in_array($authority['permission'],array("allow"))? true : false;
            
            //If we were previously granted permission to a parent of this area, i.e if we were granted permission on /xy/* but denied on /xy/z/k
            if( (isset($permissionTree[$authority['authority_id']]) )  && !$authority["permission"] && ($permissionTypes[$authority['permission_type']] <= $permissionTypes[$permissionTree[$authority['authority_id']]['permission_type']]) ){
                unset($permissionTree[$authority['authority_id']]);        
                $denied[$authority['authority_id']] = array(
                    't' => $authority['permission_type'],
                    'r' => $authority['rgt'],
                    'l' => $authority['lft']
                );
                continue; 
            }
            
            //If we've not been granted permission to this area do not add to permission tree
            if( (!isset($permissionTree[$authority['authority_id']]) )  && !$authority["permission"]  ){
                if(!in_array($authority['authority_id'], $denied)) 
                    $denied[$authority['authority_id']] = array(
                        't' => $authority['permission_type'],
                        'r' => $authority['rgt'],
                        'l' => $authority['lft']
                    );
                continue; 
            }
 
            //IF permission type is higher or permission not already set;
            if( $authority["permission"] && //We are granting permissions
                    (!isset($permissionTree[$authority['authority_id']]) || $permissionTypes[$authority['permission_type']] > $permissionTypes[$permissionTree[$authority['authority_id']]['permission_type']] ) && //And that permission has never been granted before
                    (!array_key_exists($authority['authority_id'], $denied) || (array_key_exists($authority['authority_id'], $denied)  && $permissionTypes[$denied[$authority['authority_id']]['t']] <= $permissionTypes[$authority['permission_type']] ) ) ){ //And has never been denied before
                        
                        $permissionTree[$authority['authority_id']] = $authority;
            }        
            
            $right[] = $authority['rgt'];
        } 
        
        //Test
        $allowed          = false;
        
        if($actionUser->isAuthenticated()):
            //Get User Authorities;
            $authoritiesSQLc  = "SELECT o.authority_id, a.lft, a.rgt, a.authority_name,a.authority_parent_id FROM ?objects_authority AS o LEFT JOIN ?authority AS a ON o.authority_id=a.authority_id WHERE o.object_id = {$database->quote((int)$actionUser->get("user_id"))} ORDER BY a.lft ASC";
            $authoritiesSQL   = $database->prepare( $authoritiesSQLc );
            $authorities      = $authoritiesSQL->execute()->fetchAll();

            //Remember its easier to look for granted permissions
            //If we found a granted permission, we skip to the next
            foreach($authorities as $group){
                //1.The easiest thing to do is check if we have the authority group defined
                if(array_key_exists($group['authority_id'], $permissionTree)){
                    //If the authority group is defined on the 'guest list' of allowed permissions
                    //Then we are sure that this user is granted permissions so...
                    //if group id is/or is parent to denied group then deny)'
                    $allowed = true;
                    foreach($denied as $i=>$deny):
                        //Looking for parent left right boundaries
                        if(($group['lft'] < $deny['l']) && ($group['rgt'] > $deny['r'])):
                            $allowed = false;
                        endif;
                    endforeach;
                    if(!$allowed) unset($permissionTree[$group['authority_id']]);
                    break;
                }       
                //2.The harder thing to do is check if this authority is a child of a defined authority on the guest list
                //This is looking for inheritance! NOTE: YOU Cannot grant a permission to a parent which you deny to a child!!
                foreach($permissionTree as $k=>$definition):
                    //Looking for left right boundaries
                    if(($group['lft'] > $definition['lft']) && ($group['rgt'] < $definition['rgt'])):
                        $allowed = true;
                        break;
                    endif;
                endforeach;
            }
        endif;
        
        //What about the public?
        $public_authority = \Library\Config::getParam( "public-authority", NULL, "profile" );
        //@TODO Replace the exception list with actual route map paths!
        if(array_key_exists($public_authority, $permissionTree) || in_array( $actionRoute , array("/", "/index.php", "/sign-out", "/sign-in" )) ) $allowed = true; //We need the home page to be public
        
        if(!$allowed):  
            //If User does not have permission to view this page, redirect to..
            $actionController->alert("You do not have the relevant authority to access this section of the platform. Permission denied for \"{$action}\" on \"{$actionRoute}\"", '<i class="icon icon-lock"></i>', 'error');
            $actionController->redirect( ($actionUser->isAuthenticated())? "/":"/sign-in" );
            
        endif;
       
        return true;
    }
}

