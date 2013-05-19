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

namespace Application\System\Controllers;

/**
 * Messages CRUD action controller
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Message extends \Platform\Controller {

    /**
     * Messages index action
     * @return void
     */
    public function index() {
        return $this->inbox();
    }

    /**
     * Gets private messages and displays the members inbox
     * @return void
     */
    public function inbox($messageURI = null) {

        $this->output->setPageTitle(_("Private Messages"));
        $model = $this->load->model('message', 'system');
        $messages = $model->setListOrderBy(array("o.object_updated_on"), "DESC")->getMessages($messageURI);
        $me = $this->user->get('user_name_id');
        //Get inbox lists
        $this->set("messages", $messages);

        if (!empty($messageURI)):

            //Check that the message exists
            $object = $model->loadObjectByURI($messageURI);
            if ($messageURI == $object->getObjectUri()):

                //Check can view message, i.e either author or participant
                $_participants = $object->getPropertyValue("message_participants");
                $participants = explode(",", $_participants);
                $participants[] = $object->getPropertyValue("message_author");
                if (in_array($me, $participants)):
                    $activity = $this->load->model('media', 'system');
                    $activities = $activity->setListLookUpConditions("media_target", $messageURI)->getAll();
                    $activity->setPagination(); //Set the pagination vars
                    $this->set("mediatarget", $object->getObjectUri());
                    $this->set("mediaverb", "message");
                    if ((int) $activities["totalItems"] > 0):
                        $this->set("activities", $activities);
                    endif;
                    //Mark Message read;
                    $_read = $object->getPropertyValue("message_read");
                    $_who = explode(",", trim($_read));
                    $who = array_filter($_who);
                               
                    if (!in_array($me, $who)):                 
                        $who[] = $me;
                        $read = implode(",", $who);
                        
                        $model->setObjectId($object->getObjectId());
                        $model->setObjectURI($object->getObjectURI());
                        $objectData = $object->getPropertyData();
                        $updatedObject = array_merge($objectData, array("message_read" => $read));

                        foreach ($updatedObject as $property => $value):
                            $model->setPropertyValue($property, $value);
                        endforeach;
                        if (!$model->saveObject()):
                            $this->alert('The Message read status could not be changed', "", "error");
                        endif;
                    endif;
                else:
                    $this->alert('Permission to view the requested object has been denied', "", "warning");
                endif;
            else:
                $this->alert('The message thread you requested was not found', "", "error");
            endif;
        endif;

        $layout = $this->output->layout('messages/inbox');
        $this->output->addToPosition("dashboard", $layout);

        $this->load->view("message")->display();
    }

    /**
     * Fetches a list of messages the member has sent to other members
     * @return void
     */
    public function sent() {
        $this->output->setPageTitle(_("Sent Messages"));
        return $this->index();
    }

    /**
     * Fetches messages trashed by the member
     * @return void
     */
    public function trash() {
        $this->output->setPageTitle(_("Trashed Messages"));
        return $this->index();
    }

    /**
     * Fetches instant messages
     * @return void
     */
    public function live() {
        $this->output->setPageTitle(_("Live discussions"));
        return $this->index();
    }

    /**
     * Fetches all unsent messages saved as draft
     * @return void
     */
    public function drafts() {
        $this->output->setPageTitle(_("Saved Messages"));
        return $this->index();
    }

    /**
     * Creates a new private message
     * @return void
     */
    public function create() {

        $this->output->setPageTitle(_("New Message"));
        $me = $this->user->get("user_name_id");

        //If we are submitting a form
        if ($this->input->methodIs("post")) {

            //1. Check that the each participant exists;
            $participants = $this->input->getString('message_participants');
            $subject = $this->input->getString('message_subject');
            $text = $this->input->getFormattedString("message_body", "", "post", true);

            //Do we have participants
            if (empty($participants))
                return $this->returnRequest("No recipients defined", "error");

            //Throw an error if we don't have the message
            if (empty($text))
                return $this->returnRequest("Your message has no content", "error");

            $message = $this->load->model('message');

            //Check that each participant is an active member
            //$_to = array();
            $_noto = array();
            $_participants = explode(',', $participants);
            $_users = $this->load->model("user", "member");

            foreach ($_participants as $k => $member):
                $_member = $_users->loadObjectByURI($member);
                $_participants[$k] = trim($member);
                if ($_member->getObjectType() !== 'user') {
                    $_noto[] = $member;
                    continue;
                }
            //$_to[$_member->getObjectUri()] = $_member;
            endforeach;

            //Throw an error if we don't have the message
            if (empty($_participants))
                return $this->returnRequest("No valid recipients", "error");

            //Add the messsage author to the participant list;
            if(!in_array($me, $_participants))
                $_participants[] = $me;

            //Create the new message;
            $message->setPropertyValue("message_body", $text);
            $message->setPropertyValue("message_participants", implode(",", $_participants));
            $message->setPropertyValue("message_author", $this->user->get("user_name_id"));
            $message->setPropertyValue("message_updated", \Library\Date\Time::stamp());

            if (!empty($subject))
                $message->setPropertyValue("message_subject", $subject);
            //Save the message
            if (!$message->saveObject(null, "message")) {
                return $this->returnRequest("The message could not be sent", "error");
            }
            $messageURI = $message->getLastSavedObjectURI();

            //Prepare media content;
            $this->input->setVar("media_content", html_entity_decode($text), "post"); //get formatted string crunches html tags to entities
            $this->input->setVar("media_verb", "message", "post"); //maybe need something different here!
            $this->input->setVar("media_target", $messageURI, "post");

            //Save the media;
            $media = $this->load->model("media", "system");
            if (!$media->addMedia()):
                //@todo, delete, the messagetarget;
                return $this->returnRequest("The message could not be sent", "error");
            endif;

            //All done
            $this->alert("Your private message stream has now been created and sent to all reciepients");
            if (!empty($_noto)):
                $noto = implode(',', $_noto);
                $warning = sprintf("The message has not been sent to %s", $noto);
                $this->alert($warning, "Invalid Members", "warning");
            //unset($_participants[$k]);
            endif;

            $inbox = \Library\Uri::internal('/system/messages/inbox/' . $messageURI);
            return $this->redirect($inbox); //pass the new message id here;
            //die;
        }

        $layout = $this->output->layout('messages/compose');
        $this->output->addToPosition("dashboard", $layout);

        $this->load->view("message")->display();
    }

    /**
     * Returns an instsance of the message action controller
     * @staticvar object $instance
     * @return object Message
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
