<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * attachments.php
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

/**
 * Attachment management model
 *
 * All attachments are saved as objects in EAV database
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
class Attachments extends Platform\Entity {

    /**
     * The ultimate max file size in bytes
     * Do not change this (set at 25MB)
     */
    private $_postMaxSize = 26214400;

    /**
     * Characters allowed in the file name
     * (in a Regular Expression format)
     */
    private $_validChars = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';

    /**
     * The upload file type
     */
    private $_fileType = null;

    /**
     * The Last uploaded File
     */
    private $_lastUploadedItem = null;

    /**
     * Max File Length
     */
    private $_maxNameLength = 100;

    /**
     * The current user uploading the attachment
     * Nothing fancy, just so we know where to
     * save the file
     * @var type 
     */
    public $_owner = null;

    /**
     * The default file types that can be added using the attachment models
     * use $this->allowedTypes(array()) before $this->save() to define which file types
     * to accept.
     * 
     * @static array
     */
    public $allowed = array("mp3", "jpg", "gif", "png", "jpeg", "zip");

    /**
     * Defines the attachment properties
     * 
     * @return void
     */
    public function __construct() {

        parent::__construct();
        //"label"=>"","datatype"=>"","charsize"=>"" , "default"=>"", "index"=>TRUE, "allowempty"=>FALSE
        $this->definePropertyModel(
                array(
                    "attachment_name" => array("Attachment Name", "mediumtext", 50),
                    "attachment_title" => array("Attachment Name", "mediumtext", 100),
                    "attachment_size" => array("Attachment Size (bytes)", "mediumint", 50),
                    "attachment_description" => array("Attachment Description", "mediumtext", 200),
                    "attachment_src" => array("Attachment Source", "mediumtext", 100),
                    "attachment_ext" => array("Attachment Extension", "mediumtext", 10),
                    "attachment_tags" => array("Attachment Tags", "mediumtext", 100),
                    "attachment_owner" => array("Attachment Owner user_name_id", "mediumtext", 100),
                    "attachment_type" => array("Attachment Content Type", "mediumtext", 100)
                ), "attachment"
        );
        //$this->definePropertyModel( $dataModel ); use this to set a new data models or use extendPropertyModel to extend existing models
        $this->defineValueGroup("attachment"); //Tell the system we are using a proxy table
    }

    /**
     * Default display method for every model 
     * @return boolean false
     */
    public function display() {
        return false;
    }

    /**
     * Defines allowed attachment types before save
     * Any not explicitly defined here will be skipped
     * @param array $types
     */
    public function setAllowedTypes(array $types) {
        if (is_array($types)) {
            $this->allowed = $types;
        }
    }

    /**
     * Sets the Owners name Id such that attachments are
     * saved into subfolders
     * 8
     * @param string $name
     */
    public function setOwnerNameId($name) {
        $this->_owner = $name;
    }

    /**
     * Saves options to the database, inserting if none exists or updating on duplicate key
     * 
     * @param array $options An array of options
     * @param string $group A unique string representing the options group
     * @return boolean true. Will throw an exception upon any failure. 
     */
    public function store($file) {

        $fileHandler = \Library\Folder\Files::getInstance();
        $uploadsFolder = $this->config->getParam('users-folder', '', 'content');
        //Check User Upload Limit;
        //Check File upload limit;
        //Validate the file

        $fileName = preg_replace('/[^' . $this->_validChars . ']|\.+$/i', "", basename($file['name']));
        if (strlen($fileName) == 0 || strlen($fileName) > $this->_maxNameLength) {
            $this->setError(_("Invalid file Name"));
            throw new \Platform\Exception($this->getError());
        }
        //Check that the file has a valid extension
        $fileExtension = $fileHandler->getExtension($fileName);
        if (!in_array(strtolower($fileExtension), $this->allowed)) {
            $this->setError(_("Attempting to upload an invalid file type"));
            throw new \Platform\Exception($this->getError());
        }
        //The target folder
        //Check that folder exists, otherwise create it and set the appropriate permission;
        $uploadsFolder = FSPATH . $uploadsFolder;
        if (isset($this->_owner)) {
            $uploadsFolder .= DS . $this->_owner;
        }
        $uploadsFolder .= DS . "attachments"; //All uploads are saved in the attachments folder
        $uploadsFolder = str_replace(array('/', '\\'), DS, $uploadsFolder);

        if (!$fileHandler->is($uploadsFolder, true)) { //if its not a folder
            $folderHandler = \Library\Folder::getInstance();
            if (!$folderHandler->create($uploadsFolder)) {
                $this->setError(_("Could not create the target uploads folder. Please check that you have write permissions"));
                throw new \Platform\Exception($this->getError());
            }
        }
        $uploadFileName = $uploadsFolder . DS . $fileName;
        if (!move_uploaded_file($file['tmp_name'], $uploadFileName)) {
            $this->setError(_("Could not move the uploaded folder to the target directory"));
            throw new \Platform\Exception($this->getError());
        }
        
        //Get the attachment content Type;
        $contentType = "application/octet-stream";

        foreach (array(
            "attachment_name" => $fileName,
            "attachment_title" => null, //@todo Wil need to check $file[title],
            "attachment_size" => $file['size'],
            "attachment_description" => "", //@todo Wil need to check $file[description],
            "attachment_src" => str_replace(FSPATH, '', $uploadFileName), 
            "attachment_ext" => $fileExtension,
            "attachment_owner" => $this->_owner,
            "attachment_type"   => $fileHandler::getMimeType( $uploadFileName )
        ) as $property => $value):
            $this->setPropertyValue($property, $value);
        endforeach;

        if (!$this->saveObject(NULL, "attachment")) { //Null because the system can autogenerate an ID for this attachment
            $fileHandler->delete($uploadFileName);
            $this->setError(_("Could not store the attachment properties to the database"));
            throw new \Platform\Exception($this->getError());
        }

        return true;
    }

    /**
     * Displays an attachment
     * 
     * @param type $object
     * @param type $params
     */
    final public static function load(&$object, &$params) {

        //if is object $object
        if (!is_a($object, "\Platform\Entity") || $object->getObjecType() !== "attachment") {
            //Attempt to determine what type of object this is or throw an error
            return false; //we only deal with attachments
        }

        //Relaod the object
        $attachments = static::getInstance();
        $attachment = $attachments->loadObjectByURI( $object->getObjectURI());
        
        $fullPath = FSPATH . DS . $attachment->getPropertyValue("attachment_src");
        $contentType = $attachment->getPropertyValue("attachment_type");

        //Commands
        if (is_array($params)):
            $modifiers = $params;
            $modifier = array_shift($modifiers);
            if (method_exists($attachments, $modifier)) {
                $fullPath = $attachments::$modifier($fullPath, $modifiers);
                $fd = fopen($fullPath, "rb");
            }
        endif;
        //Attempt to determine the files mimetype
        $ftype = !empty($contentType) ?  $contentType : \Library\Folder\Files::getMimeType( $fullPath ) ;

        //Get the file stream
        if (!$fd) {
            $fd = fopen($fullPath, "rb");
        }

        if ($fd) {
            $fsize = filesize($fullPath);
            $fname = basename($fullPath);
            $headers = array(
                "Pragma" => null,
                "Cache-Control" => "",
                "Content-type" => $ftype,
            );
            foreach ($headers as $name => $value) {
                $attachment->output->unsetHeader($name);
                $attachment->output->setHeader($name, $value);
            }
            fpassthru($fd);
            fclose($fd);

            $attachment->output->setFormat('raw', array()); //Headers must be set before output 
            //
            $attachment->output->display();
            //$attachment->output->setHeader("Content-Disposition", "attachment; filename=\"" . $fname . "\"");
            //$attachment->output->setHeader("Content-length", $fsize);
        }

        //Here is the attachment source, relative to the FSPATH;
        //print_r($attachment->getPropertyValue("attachment_src"));
    }

    /**
     * Resizes an image
     * 
     * @param type $file
     * @param type $params
     */
    final public static function resize($file, $params) {
        //die;
        $fileHandler = \Library\Folder\Files::getInstance('image');
        $resizable = array("jpg", "gif", "png", "jpeg");

        //If there is no file
        if (empty($file))
            return false;
        $fileExtension = $fileHandler->getExtension($file);

        //If we can't resize this type of file
        if (!in_array(strtolower($fileExtension), $resizable))
            return false;
        //We need at least the width or height to resize;
        if (empty($params))
            return false;
        $width = isset($params[0]) ? $params[0] : null;
        $height = isset($params[1]) ? $params[1] : null;

        $isSquare = ($width == $height) ? true : false;
        //NewName = OriginalName-widthxheight.OriginalExtension
        $fileName = $fileHandler->getName($file);
        $filePath = $fileHandler->getPath($file);

        $target = $filePath . DS . $fileName . (isset($width) ? "-" . $width : null) . (isset($height) ? "x" . $height : null) . "." . $fileExtension;

        if (!$fileHandler->resizeImage($file, $target, $width, $height, $isSquare)) {
            return false; //There was a problem and we could not resize the file
        }
        return $file = $target;
    }

    /**
     * Models a collection activity object for activity feeds
     * 
     * @param type $activityObject
     * @param type $activityObjectType
     * @param type $activityObjectId
     * 
     * return void;
     */
    public static function activityObject(&$activityObject, $activityObjectType, $activityObjectURI) {

        
        //If the activity object is not a collection! skip it
        $objectTypeshaystack = array("attachment");
        $thisModel = new self;
        if (!in_array($activityObjectType, $objectTypeshaystack))
            return; //Nothing to do here if we can't deal with it!
            
        //1.Load the collection!
        $attachment = $thisModel->loadObjectByURI($activityObjectURI);
        $attachmentObject = new Activity\Medialink;
        //2.Get all the elements in the collection, limit 5 if more than 5
        //3.Trigger their timeline display
        $attachmentObject->set("objectType", "attachment");
        $attachmentObject->set("uri", $attachment->getObjectURI());

        //Now lets populate our collection with Items
        //@TODO Will probably need to query for objectType of items in collection?
        //@TODO Also this will help in removing objects from collections that have previously been deleted
        $attachmentObjectURL = !empty($activityObjectURI) ? "/system/object/{$activityObjectURI}" : "http://placeskull.com/100/100/999999";
        $attachmentObject->set("url",  $attachmentObjectURL);
        $attachmentObject->set("uri", $activityObjectURI);
        $attachmentObject->set("height", null);
        $attachmentObject->set("width", null);
        
        //echo $activityObjectURI;

        //Now set the collection Object as the activity Object
        $activityObject =  $attachmentObject;
        
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

