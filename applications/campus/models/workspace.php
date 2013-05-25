<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * workspace.php
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

namespace Application\Campus\Models;

use Platform;

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
class Workspace extends Platform\Entity {

    public function __construct() {

        parent::__construct();
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel(
                array(
                    "workspace_name" => array("Workspace Name", "mediumtext", 200),
                    "workspace_short_descr" => array("Workspace Short Description", "longtext", 2000),
                    "workspace_long_descr" => array("Workspace Long Description", "mediumtext", 600),
                    "workspace_creator" => array("Workspace Creator", "mediumtext", 200),
                    "workspace_privacy" => array("Workspace Privacy", "mediumtext", 20),
                    "workspace_cover_photo" => array("Workspace Cover Photo", "mediumtext", 20),
                ), "message"
        );
    }

    /**
     * Default display method for every model 
     * @return boolean false
     */
    public function display() {
        return false;
    }

    public function getWorkspaces($active = NULL) {
        
    }

    public static function search($query, &$results = array()) {

        $pms = static::getInstance();

        if (!empty($query)):
            $words = explode(' ', $query);
            foreach ($words as $word) {
                $_results =
                        $pms->setListLookUpConditions("message_subject", $word, 'OR')
                        ->setListLookUpConditions("message_body", $word, 'OR');
            }

            $_results = $pms->setListLookUpConditions("message_participants", "(^|,){$pms->user->get('user_name_id')}(,|$)", "AND", FALSE, TRUE, "RLIKE")->getObjectsList("message");
            $rows = $_results->fetchAll();

            $messages = array(
                "filterid" => "messages",
                "title" => "Private Messages",
                "results" => array(),
                "listonly" => true
            );
            //Loop through fetched attachments;
            //@TODO might be a better way of doing this, but just trying
            foreach ($rows as $pm) {
                $limit = 50;
                $string = strip_tags(html_entity_decode(trim($pm['message_body'])));
                $text = explode(" ", $string);
                $continum = (sizeof($text) > $limit) ? " [...]" : NULL;

                $body = (empty($continum)) ? $string : implode(" ", array_splice($text, 0, $limit)) . $continum;
                $message = array(
                    "title" => empty($pm['message_subject']) ? Library\Date\Time::difference(strtotime($pm['object_created_on'])) : $pm['message_subject'], //required
                    "description" => $body, //required
                    "type" => $pm['object_type'],
                    "object_uri" => $pm['object_uri'],
                    "link" => "/system/message/inbox/{$pm['object_uri']}",
                );
                $messages["results"][] = $message;
            }
            //Add the members section to the result array, only if they have items;
            if (!empty($messages["results"]))
                $results[] = $messages;
        endif;

        return true;
    }

    /**
     * Get's an instance of the media model
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

