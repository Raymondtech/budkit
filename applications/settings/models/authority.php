<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * authority.php
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

namespace Application\Settings\Models;

/**
 * Authority group model
 *
 * An authority is a role in an area of responsibility (AoR). A curator is the 
 * head of an authority, who can create and grant permissions to users in that 
 * authority, or sub authority. A permission is an authorisation to, access, 
 * modify or execute an object or operation, granted to an authority or user 
 * by a curator. Some authorities are automatically generated. For instance 
 * geographical and age authorities, can be used to limit permission by place, 
 * and age . A unified control plan (UCP), is a predefined map of authority to 
 * permission to operation in an Area of Responsibility. For instance, The Authority 
 * ‘Moderators’ granted the permission to ‘modify’ all objects in the ‘Post submission’ 
 * Area of responsibility. The UCP is defined by the Master Administrator, 
 * who is the curator or curators
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Authority extends \Platform\Model {

    /**
     * Default model method
     * @return void;
     */
    public function display() {
        return false;
    }

    /**
     * Save authority group permissions
     * @param array $params
     * @return boolean True on success
     * @throws \Platform\Exception on failure
     */
    public function storePermissions($params = array()) {

        //1. Load Helpers
        $encrypt = \Library\Encrypt::getInstance();

        //2. Saniitize the data
        $authorityAreaTitle = $this->input->getString("area-title");
        $authorityAreaURI = $this->input->getString("area-uri");
        $authorityAreaAction = $this->input->getString("area-action");
        $authorityAreaPermission = $this->input->getString("area-permission");
        $authorityId = $this->input->getInt("area-authority");

        //3. Synchronize and bind to table object
        $table = $this->load->table("?authority_permissions");

        $aData = array(
            "authority_id" => $authorityId,
            "permission_area_uri" => strtolower($authorityAreaURI),
            "permission" => strtolower($authorityAreaPermission),
            "permission_type" => strtolower($authorityAreaAction),
            "permission_title" => $authorityAreaTitle
        );

        //All fields required;
        foreach ($aData as $k => $item) {
            if (empty($item)) {
                $this->setError(_t("Please complete all permission fields; Provide a title and uri defining the area, a permission type and value"));
                return false;
            }
        }

        if (!$table->bindData($aData)) {
            throw new \Platform\Exception($table->getError());
            return false;
        }

        //@TODO: Check that we are not denying permission to an authority whose parent is granted the permission!!!
        //Check the Permission Area URI, make sure its not a route id,
        //We need exact URI paths, Throw an error if it does not make sense
        if ($table->isNewRow()) {
            
        }

        //5. Save the table modifications
        if (!$table->save()) {
            return false;
        }

        return true;
    }

    /**
     * Stores Authority Data to the database
     * @param array $data
     * @return boolean true on success 
     */
    public function store($data = "", $params = array()) {

        //1. Load Helpers
        $encrypt = \Library\Encrypt::getInstance();


        //2. Saniitize the data
        $authorityTitle = $this->input->getString("authority-title");
        $authorityParent = $this->input->getInt("authority-parent");
        $authorityId = $this->input->getInt("authority-id");

        $authorityDescription = $this->input->getString("authority-description");

        $authorityName = strtoupper(str_replace(array(" ", "(", ")", "-", "&", "%", ",", "#"), "", $authorityTitle));

//        $authorityAreaTitle         = $this->input->getArray("area-title", array() );
//        $authorityAreaURI           = $this->input->getArray("area-uri", array() );
//        $authorityAreaAction        = $this->input->getArray("area-action", array() );
//        $authorityAreaPermission    = $this->input->getArray("area-permission", array() );
//        
//        $authorityAreaName          = strtoupper(str_replace(array(" ", "(", ")", "-", "&", "%", ",", "#"), "", $authorityAreaTitle));
//        

        $aData = array(
            "authority_id" => $authorityId,
            "authority_name" => $authorityName,
            "authority_title" => $authorityTitle,
            "authority_parent_id" => empty($authorityParent) ? 1 : (int) $authorityParent,
            "authority_description" => $authorityDescription
        );

        //3. Load and prepare the Authority Table
        $table = $this->load->table("?authority");

        if (!$table->bindData($aData)) {
            //print_R($table->getErrors());
            throw new \Platform\Exception($table->getError());
            return false;
        }

        //4. Are we adding a new row
        if ($table->isNewRow()) {

            if (empty($authorityName) || empty($authorityParent) || empty($authorityTitle)) {
                $this->setError(_t('Every new authority must have a defined Title, and must be a subset of the public authority'));
                return false;
            }

            //Get the parent left and right value, to make space
            $parent = $this->database->select("lft, rgt")->from("?authority")->where("authority_id", (int) $table->getRowFieldValue('authority_parent_id'))->prepare()->execute()->fetchObject();

            $update = array(
                "lft" => "lft+2",
                "rgt" => "rgt+2"
            );

            //echo $parent->rgt;

            $this->database->update("?authority", array("lft" => "lft+2"), array("lft >" => ($parent->rgt - 1)));
            $this->database->update("?authority", array("rgt" => "rgt+2"), array("rgt >" => ($parent->rgt - 1)));

            $table->setRowFieldValue("lft", $parent->rgt);
            $table->setRowFieldValue("rgt", $parent->rgt + 1);
        }

        //5. Save the table modifications
        if (!$table->save()) {
            return false;
        }

        return true;
    }

    /**
     * Loads a row of authority groups
     * @todo Implement authority model load
     * @return void
     */
    public function load() {
        
    }

    /**
     * Deletes an authority group from the datastore
     * @todo Implement the authority model delete
     * @return void
     */
    public function delete() {
        
    }

    /*
     * Validates new authority input
     * @todo Validate new authority input
     * @return void
     */

    public function validate() {
        
    }

    /**
     * Returns a processed array of authority groups
     * @return array
     */
    public function getAuthorities() {
        //Get All authorities from the database
        $statement = $this->database->select("a.*, count(p.permission) AS permissions")
                                    ->from("?authority a")
                                    ->join("?authority_permissions p", "a.authority_id=p.authority_id", "LEFT")
                                    ->groupBy("a.authority_name")
                                     ->orderBy("a.lft", "ASC")->prepare();
        $results = $statement->execute();

        //Authorities Obbject
        $rows = $results->fetchAll();
        $authorities = array();
        $right = array();
        foreach ($rows as $authority) {

            if (count($right) > 0) {
                while ($right[count($right) - 1] < $authority['rgt']) {
                    array_pop($right);
                }
            }
            //Authority Indent
            $authority["indent"] = sizeof($right);
            //Authority Permissions;
            if ((int) $authority['permissions'] > 0) {

                $authority['permissions'] = $this->database->select('p.*')->from("?authority_permissions p")->where("p.authority_id =", $authority['authority_id'])->run()->fetchAll();
            }
            $authorities[] = $authority;
            $right[] = $authority['rgt'];
        }

        return $authorities;
    }

    /**
     * Returns an instance of the authority class
     * @staticvar object $instance
     * @return object Authority
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

