<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * audio.php
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
namespace Application\System\Controllers\Media;

/**
 * Audio files management CRUD action controller for system media 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of audio files within various posts/media types.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Audio extends Attachments {
    
    
    /**
     * Displays a gallery of media items. 
     * @return void
     */
    public function gallery() {
        
        $this->output->setPageTitle(_("Audios"));

        $model = $this->load->model("attachments", "system");
        $audio = $this->config->getParam( "audio", array(), "attachments");
        
        $attachments = $model
                ->setListLookUpConditions("attachment_owner", array($this->user->get("user_name_id")))
                ->setListLookUpConditions("attachment_type", $audio) //Limits the lookup to attachments with image types
                ->setListOrderBy("o.object_created_on", "DESC")
                ->getObjectsList("attachment");
        $model->setPagination(); //Set the pagination vars
        
        $items = array("totalItems" => 0);
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $attachments->fetchAssoc()) {
            $row['attachment_url'] = "/system/object/{$row['object_uri']}";
            $items["items"][] = $row;
            $items["totalItems"]++;
        }
        if ((int)$items["totalItems"] > 0)
            $this->set("gallery", $items);

        $gallery = $this->output->layout("media/gallery");
        $this->output->addToPosition("dashboard", $gallery);
        
        
        $this->load->view("media")->display();
    }
    
    /**
     * Get's an instance of the audio controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Audio}
     * 
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
