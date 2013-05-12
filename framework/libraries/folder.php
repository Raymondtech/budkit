<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * folder.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/folder
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library;

use Library\Folder;
use Library\Folder\Files;

/**
 * Folder handling methods
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/folder
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Folder extends \Library\Object {

    static $instance;
    /**
     * Returns the UNIX timestamp representation
     * of the last time the folder was modified
     * 
     * @param string $path 
     */
    public static function getModifiedDate($path) {

        //Check for the last modified 
        $lmodified = 0;
        $files = glob($path . '/*');

        foreach ($files as $file) {
            if (is_dir($file)) {
                $modified = dirmtime($file);
            } else {
                $modified = filemtime($file);
            }
            if ($modified > $lmodified) {
                $lmodified = $modified;
            }
        }
        return $lmodified;
    }

    /**
     * Returns in int representation of the file size in bytes
     * 
     * @param string $path 
     */
    public static function getSize($path) {
        
    }

    /**
     * Gets the name of the folder
     * 
     * @param string $path 
     */
    public function name($path) {
        
    }

    /**
     * Create a folder if not exits
     * 
     * @param string $path 
     * @return boolean true if success, false on failure, or nothing if folder exists
     */
    public static function create($path, $permission = 0755) {
        if (!static::is($path)){
            if(!mkdir($path, $permission, true) ){
                return false;
            }
            return true;
        }
    }

    /**
     * Moves the folder to a new location
     * 
     * @param type $path
     * @param type $toPath
     * @param type $replace 
     * @todo Will always replace for now.
     */
    public static function move($path, $toPath, $deleteOriginal = TRUE) {
        if(copy($path, $toPath)){
            if($deleteOriginal){
                if(!$this->remove($path)){
                    //@todo say you could not delete the original
                }
            }
            return true;
        }
        return false;
    }
    
     /**
     * Copies the file or folder to a new destination
     * 
     * @param type $path
     * @param type $toPath
     * @param type $replace 
     * @todo Will always replace for now.
     */
    public static function copy($path, $toPath) {
        if(empty($path)||empty($toPath)) return false;
        return copy($path, $toPath);
    }

    /**
     * Deletes a folder
     * 
     * @param type $path
     * @param type $backup 
     */
    public static function remove($path) {    
        return $this->delete($path);
    }

    /**
     * Check if a folder has a backup
     * 
     * @param type $path 
     */
    public static function hasBackup($path) {
        
    }

    /**
     * Restore backup
     * 
     * @param type $path 
     */
    public static function restoreBackup($path) {
        
    }

    
        /**
     * Sets file permission i.e change the file mode
     * 
     * @param type $path
     * @param type $permission
     * @return \Library\Folder\Files
     */
    public static function chmod($path, $permission) {   
        chmod($path,$permission);		
    }
    
    /**
     * Gets file permissions
     * 
     * @param type $path
     */
    public static function getPermission($filepath) {
        
        return substr(sprintf('%o', fileperms($filepath)), -4);
        
    }

    /**
     * Recursively sets permissions for all files in a folder
     *
     * @param type $path
     * @param type $permission 
     */
    public static function chmodR($path, $permission) {
        
        if (!static::is($path))
            return static::chmod($path, $permission);

        $dirh = @opendir($path);
        while ($file = readdir($dh)) {
            if ($file != '.' && $file != '..') {
                $fullpath = $path . '/' . $file;
                if (!static::is($fullpath)) {
                    if (!static::chmod($fullpath, $filemode))
                        return FALSE;
                }
                else {
                    if (!static::chmodR($fullpath, $filemode))
                        return FALSE;
                }
            }
        }

        closedir($dirh);

        if (static::chmod($path, $filemode))
            return TRUE;
        else
            return FALSE;
    }

    /**
     *
     * @param type $path
     * @param type $type 
     */
    public static function pack($path, $type = 'zip') {
        
    }

    /**
     * Lists all the files in a directory
     * 
     * @param string $path the compound path being searched and listed
     * @param array $exclude a list of folders, files or fileTypes to exclude from the list
     * @param boolean $recursive Determines whether to search subdirectories if found
     * @param interger $recursivelimit The number of deep subfolder levels to search
     * @param boolean $showfiles Include Files contained in each folder to the array
     * @param boolean $sort Sort folder/files in alphabetical order
     * @param boolean $long returns size, permission, datemodified in list if true, Slow!!
     * 
     * @return array $list = array(
      "path/to/folder" => array(
      "name" => '',
      "parent" => '', //only in long
      "size" => '', //only in long
      "modified" => '', //only in long
      "permission" => '',
      "files" => array(
      "path/to/file" => array(
      "name" => '',
      "size" => '', //only in long
      "modified" => '', //only in long
      "permission" => '',
      "extension"  => '',
      "mimetype"   => ''//only in long
      )
      ),
      "children" => array(
      //Contains a list of all sub folders,
      //*recursion*
      )
      )
      );
     */
    final public static function itemize($path, $exclude = array(".DS_Store", ".git", ".svn", ".CVS"), $recursive = FALSE, $recursivelimit = 0, $showfiles = FALSE, $sort = TRUE, $long = FALSE) {

        //1. Search $name as a folder or as a file 
        if (!self::is($path)) { //if in path is a directory
            return array();
        }

        $dirh = @opendir($path); //directory handler
        //$recursion  = 0;
        $found = array();

        if ($dirh) {
            while (false !== ($file = readdir($dirh))) {
                // remove '.' and '..'
                if ($file == '.' || $file == '..' || in_array($file, $exclude))
                    continue;

                $recursion = 0;
                $newPath = $path . $file;

                if (self::is($newPath) && $recursive && ($recursion < $recursiveLimit )) {
                    //echo self::is($newPath)."<br />"; 
                    //echo $newPath."<br />";
                    $newRecursiveLimit = ((int) $recursiveLimit > 0) ? ((int) $recursiveLimit - 1) : 0;
                    $items = self::itemize($name, $newPath, $recursive, $newRecursiveLimit);
                    $found = array_merge($items, $found);
                }

                $found[] = $newPath;
            }
            closedir($dirh);
        }
        //@TODO if long, get additional info for each path;

        return $found;
    }

    /**
     * Finds and return the folder list matching $name in $inPath.
     * Use $limit to define how many occurences to return if found, default is 1
     * Method will therefore stop once the number of found response is = $limit, use $limit = 0 to find all
     * 
     * @param string $name
     * @param string $inPath
     * @param interger $limit
     * @param boolean $recursive
     * @param interger $recursiveLimit
     * @param boolean $showfiles
     * @param boolean $sort
     * @param boolean $long 
     */
    final public static function itemizeFind($name, $inPath, $limit = 1, $recursive = FALSE, $recursiveLimit = 0, $showfiles = FALSE, $sort = TRUE, $long = FALSE) {

        //1. Search $name as a folder or as a file 
        if (!self::is($inPath)) { //if in path is a directory
            return array();
        }

        $dirh = @opendir($inPath); //directory handler
        //$recursion  = 0;
        $found = array();

        if ($dirh) {
            while (false !== ($file = readdir($dirh))) {
                // remove '.' and '..'
                if ($file == '.' || $file == '..')
                    continue;

                $recursion = 0;
                $newPath = $inPath . $file . DS;

                if (self::is($newPath) && $recursive && ($recursion < $recursiveLimit )) {
                    //echo self::is($newPath)."<br />"; 
                    //echo $newPath."<br />";

                    $newRecursiveLimit = ((int) $recursiveLimit > 0) ? ((int) $recursiveLimit - 1) : 0;
                    $items = self::itemizeFind($name, $newPath, $recursive, $newRecursiveLimit);
                    $found = array_merge($items, $found);
                }

                if (\strtolower($name) == \strtolower($file)) {
                    $found[] = $newPath;
                }
            }
            closedir($dirh);
        }
        //@TODO if long, get additional info for each path;

        return $found;
    }

    /**
     * Determines if a path links to a folder or file
     * 
     * @param string $path
     * @param boolean $folder, value to return if is folder
     *  
     */
    final public static function is($path, $folder = TRUE) {

        $return = is_dir($path) ? $folder : !$folder;

        return (bool) $return;
    }
    
    /**
     * Method to delete the contents of a folder
     * 
     * @param type $folderpath
     * @param type $filterByType
     * @param type $filterByName
     * @param type $filterExcludeMode
     */
    final public static function deleteContents($folderpath, $filterByExtension = array() , $filterByName= array() , $filterExcludeMode = TURE , $recursive = TRUE ){
        
        //1. Search $name as a folder or as a file 
        if (!self::is($folderpath)) { //if in path is a directory
            return false;
        }

        $dirh = @opendir($folderpath); //directory handler

        if ($dirh) {
            while (false !== ($file = readdir($dirh))) {
                // remove '.' and '..'
                if($filterExcludeMode){
                    //Excluding by name as in "file.ext"
                    if ($file == '.' || $file == '..' || in_array($file, $filterByName))
                        continue;
                    //Excluding extension
                    if(!empty($filterByExtension)){
                        $fhandler  = static::getFile();
                        $extension = $fhandler::getExtension( $file );
                        if(in_array($extension, $filterByExtension))
                            continue;
                    }
                }
                
                //The new path
                $newPath = $folderpath.DS.$file;
                //echo $newPath; 
                
                //If newpath is a folder and we are deleting recursively
                if (self::is($newPath) && $recursive) {
                    self::deleteContents( $newPath , $filterByExtension, $filterByName , $filterExcludeMode , $recursive);
                }
                //Now unlink the file
                if(!static::delete( $newPath )){
                    static::setError("Could not delete {$newPath}");
                    return false;
                }
            }
            closedir($dirh);
        }
        //@TODO if long, get additional info for each path;

        return true;
    }
    
    
    /**
     * Deletes a file or folder if exists
     * 
     * @param type $path
     */
    final public static function delete($path){
        
        //If we have permission to remove this file
        if (static::isWritable($path)) {
            if (!@unlink($path)) //This is highly unreliable as unlink returns a warning not a bool
                return false;
        }else {
            if (!@unlink($path)) //This is highly unreliable as unlink returns a warning not a bool
                return false;
        }
        return true;
    }

    /**
     * Determines if a path is credible
     * 
     * @param type $path 
     */
    final public static function exists($path) {
        return file_exists( $path );
    }
    
    /**
     * Checks if a file or folder is writable 
     * 
     * @param type $path
     */
    final public static function isWritable($path, $writable = TRUE){
        
        $return = is_writable($path) ? $writable : !$writable;

        return (bool) $return;
    }

    /**
     * Returns an instance of the folder object
     * 
     * @staticvar self $instance
     * @return self 
     */
    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self;

        return $instance;
    }

    /**
     * Returns an instance of the file object
     * 
     * @return File Class Pdf | Image | Xml
     */
    final public static function getFile($type = NULL ) {

        return \Library\Folder\Files::getInstance($type);
    }

    /**
     * Returns an instance of the archiver object
     * 
     * @param type $type
     * @return type 
     */
    final public static function getPacker($type = '') {

        return \Library\Folder\Pack::getInstance($type);
    }

}