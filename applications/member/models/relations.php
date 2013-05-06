<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * relations.php
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

namespace Application\Member\Models;

use Platform;
use Library;

/**
 * Models relationships between network nodes (members)
 *
 * 
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Relations extends Platform\Entity {

    /**
     * Default display method for every model 
     * @return boolean false
     */
    public function display() {
        return false;
    }
    
    public function addFollow($follower, $followee){
         //3. Synchronize and bind to table object
        $table    = $this->load->table("?objects_edges");
        $follower = $this->loadObjectByURI( $follower );
        $followee = $this->loadObjectByURI( $followee );
        
        $head = $follower->getObjectId();
        $tail = $followee->getObjectId();
        
        if(empty($head)||empty($tail)){
            //@We don't know who/what these objects are
            $this->setError("Unable to determine edge vertices");
            return false;
        }
        $relation = array(
            "edge_head_object"=>$follower->getObjectURI(),
            "edge_tail_object"=>$followee->getObjectURI(),
            "edge_name" => "follows"
        );
        //Prepare to store the relationship data
        if (!$table->bindData($relation)) {
            throw new \Platform\Exception($table->getError());
            return false;
        }  
        //5. Save the table modifications
        if (!$table->save()) {
            return false;
        }
        return true;
    }
    
    public function removeFollow($follower, $followee){}
    
    public function getFollowers($followee){}
    
    public function getFollowersGraph(){}
    
    public function getFollowingGraph(){}
    
    public function getFollowing($follower){}
    
    public function getGraph(){}
   
    /**
     * Saves options to the database, inserting if none exists or updating on duplicate key
     * 
     * @param array $options An array of options
     * @param string $group A unique string representing the options group
     * @return boolean
     */
    public function save($options, $group = null) {
        return true;
    }

    /**
     * Get's an instance of the activity model
     * @staticvar object $instance
     * @return object \Application\System\Models\Options 
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

