<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * collection.php
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

namespace Application\System\Models;

use Platform;
use Library;

/**
 * Options management model
 *
 * Manages system options
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Collection extends Platform\Entity {

    public function __construct() {

        parent::__construct();
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel(
            array(
                "collection_title" => array("Collection Title", "mediumtext", 100),
                "collection_items" => array("Collection Items", "longtext", 2000),
                "collection_thumbnail" => array("Collection Thumbnail", "mediumtext", 200),
                "collection_size" => array("Collection Size", "smallint", 10),
                "collection_description" => array("Collection Description", "mediumtext", 200),
                "collection_tags" => array("Collection Tags", "mediumtext", 100),
                "collection_owner" => array("Collection Owner", "mediumtext", 100)
            ), "collection"
        );
        //$this->definePropertyModel( $dataModel ); use this to set a new data models or use extendPropertyModel to extend existing models
        //$this->defineValueGroup("attachment"); //Tell the system we are using a proxy table
    }
    
    /**
     * Default display method for every model 
     * @return boolean false
     */
    public function display() {
        return false;
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

