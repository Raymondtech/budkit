<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * message.php
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
class Message extends Platform\Entity {

    public function __construct() {

        parent::__construct();
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel(
                array(
            "message_subject" => array("Message Subject", "mediumtext", 200),
            "message_body" => array("Message Text", "longtext", 2000),
            "message_participants" => array("Message Participants", "mediumtext", 600),
            "message_author" => array("Message Author", "mediumtext", 200),
            "message_updated" => array("Message Updated", "datetime", 200),
            "message_read" => array("Message Read", "mediumtext", 600),
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

    public function getMessages($active = NULL) {

        $_users = $this->load->model("user", "member");
        $_me    = $this->user->get("user_name_id");
        $_messages = $this->setListLookUpConditions("message_participants", "(^|,){$_me}(,|$)", "AND", FALSE, TRUE, "RLIKE" )
                ->getObjectsList("message");
        $rows = $_messages->fetchAll();
        $messages = array("totalItems" => 0);
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        foreach ($rows as $row) {

            $_member = $_users->loadObjectByURI($row['message_author']);
            //Has this user read this message?
            $readby = explode(",", $row['message_read']);
           
            if (!in_array($this->user->get("user_name_id"), $readby) && $row['message_author'] <> $this->user->get("user_name_id")):
                $row['message_status'] = 'unread';
            endif;

            if ($active == $row['object_uri']):
                $row['message_status'] = 'open';
            endif;

            $row['message_body'] = strip_tags(html_entity_decode(trim($row['message_body'])));
            $row['message_author'] = $_member->getPropertyData();
            $row['message_author']['user_full_name'] = $_users->getFullName($_member->getPropertyValue('user_first_name'), NULL, $_member->getPropertyValue("user_last_name"));

            $messages["items"][] = $row;
            $messages["totalItems"]++;
        }

        return $messages;
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

            $_results = $pms->setListLookUpConditions("message_participants", "(^|,){$pms->user->get('user_name_id')}(,|$)", "AND", FALSE, TRUE, "RLIKE" )->getObjectsList("message");
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
                    "title" => empty($pm['message_subject']) ? Library\Date\Time::difference( strtotime($pm['object_created_on']) ):$pm['message_subject'], //required
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

