<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * media.php
 *
 * Requires PHP version 5.3
 *
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/layout
 * @since      Class available since Release 1.0.0 Feb 5, 2012 10:15:29 PM
 *
 */

namespace Library\Output\Parse\Template;

use Library\Output\Parse;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Libraries
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/layout
 * @since      Class available since Release 1.0.0 Feb 5, 2012 10:15:29 PM
 */
class Media extends Parse\Template {
    /*
     * @var object
     */

    static $instance;

    /**
     * Execute the layout
     * 
     * @param type $parser
     * @param type $tag
     * @return type
     */
    public static function execute($parser, $tag, $writer) {

        $attachmentTypes = \Library\Config::getParam("allowed-types", array(), "attachments");
        
        $modes = array("icon","thumbnail");
        $images = array("image/bmp", "image/gif", "image/jpeg", "image/jpeg", "image/jpg");
        $videos = array("video/mp4");
        $audio = array();
        $rich = array(); //Rich Html embed for swf etc
        
        //@TODO media thumbnail mode
        $mode = $tag['MODE']; //thumbnail, icon etc...
        
        
        $name = static::getData($tag['NAME'], $tag['NAME']);
        $type = static::getData($tag['TYPE'], $tag['TYPE']);
        $uri = static::getData($tag['URI'], $tag['URI']);
        $url = static::getData($tag['URL'], $tag['URL']);
        $link = static::getData($tag['LINK'], $tag['LINK']);
        $class = static::getData($tag['CLASS'], $tag['CLASS']);
        $height = static::getData($tag['HEIGHT'], $tag['HEIGHT']);
        $width = static::getData($tag['WIDTH'], $tag['WIDTH']);
        $mime = strtolower($type);

        //unset($tag['NAMESPACE']);
        
        //If the medialink is linkable...
        if (isset($link) && !empty($url)):
            $tag['ELEMENT'] = 'a';
            $tag['HREF'] = \Library\Uri::internal($url);
            unset($tag['WIDTH']);
            unset($tag['HEIGHT']);
        else:
            $tag['ELEMENT'] = 'div';
            $tag['CLASS'] = "medialink\n". !empty($class) ? $class : null;
        endif;

        //@TODO determine browser compatibility and addmime to the above arrays i.e images, videos, audio, rich;
        //
        //Can we render this media link?
        $renderable = array_merge($images, $videos, $audio, $rich);
        if ((in_array($mime, array_merge($videos, $audio, $rich))&&$mode=="icon")||!in_array($mime, $renderable)) {
            
            if (!empty($name)):
                $fileExtension = \Library\Folder\Files::getExtension($name, "file");
                $fileExtension = strtolower( $fileExtension );  
                $linkable = array("ELEMENT"=>"a", "HREF"=> \Library\Uri::internal($url), "CLASS"=>"media-{$fileExtension} media-file",  ); 
                $linkable["CHILDREN"][] = array("ELEMENT"=>"span","CLASS"=>"media-type media-{$fileExtension}", "CDATA"=>"<i class='icon-file'></i>".$fileExtension);
                $linkable["CHILDREN"][] = array("ELEMENT"=>"span","CLASS"=>"media-filename list-hide", "CDATA"=> $name );
                $linkable["CHILDREN"][] = array("ELEMENT"=>"span","CLASS"=>"media-help list-hide help-block", "CDATA"=> $mime );
                //We cannot have two a > a
                return $linkable;
                
            endif;
            
        }else{

            //Type specific
            if (!empty($type)):
                
                //@TODO will need to determine browser support for the various
                //mime types shown here, for instance only safari browsers support image/tiff;
                if (in_array($mime, $images) && !empty($url)):
                    //Create an image element
                    $imageLink = \Library\Uri::internal("/system/object/".$uri);
                    $image = array(
                        "ELEMENT" => "img",
                        "SRC" => $imageLink. (!empty($width) ? "/resize/{$width}" . (!empty($height) ? "/{$height}" : null) : null),
                        "ALT" => !empty($name) ? $name : null,
                        "WIDTH" => !empty($width) ? $width : null,
                        "HEIGHT" => !empty($height) ? $height : null
                    );
                    if(empty($image['WIDTH'])) unset($image['WIDTH']);
                    if(empty($image['HEIGHT'])) unset($image['HEIGHT']);
                    $tag['HREF']    = \Library\Uri::internal("/system/media/photo/view/".$uri);
                    $tag['CHILDREN'][] = $image;
                    //$tag = array("ELEMENT"=>"span","CDATA"=>"Single Image");
                endif;
                
                if(in_array($mime, $videos) && !empty($uri)):
                    
                    $videoLink = \Library\Uri::internal("/system/object/".$uri);
                    $video = array(
                        "ELEMENT" => "video",
                        "CONTROLS"=>"true",
                        "WIDTH" => !empty($width) ? $width : null,
                        "HEIGHT" => !empty($height) ? $height : null,
                        "CHILDREN"=>array(
                            array(
                                "ELEMENT"=>"SOURCE",
                                "SRC"=> $videoLink,
                                "TYPE"=> $mime,
                            )
                        )
                    );
                    if(empty($video['WIDTH'])) unset($video['WIDTH']);
                    if(empty($video['HEIGHT'])) unset($video['HEIGHT']);
                    $tag = $video;
                endif;
            endif;
        
        }
        //This is a strange bug, if the children element is the last
        //element in the array, the element is not closed properly.
        unset($tag['NAME']);
        unset($tag['TYPE']);
        unset($tag['URL']);
        unset($tag['URI']);
        unset($tag['MODE']);
        unset($tag['LINK']);
        unset($tag['CDATA']);
        
        return $tag;
    }

    /**
     * Returns and instantiated Instance of the layout class
     *
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     *
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance
     * @return object layout
     */
    public static function getInstance() {
        if (is_object(static::$instance) && is_a(static::$instance, 'media'))
            return static::$instance;
        static::$instance = new self();
        return static::$instance;
    }

}

