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
    protected static $modes = array("icon", "thumbnail");
    protected static $images = array("image/bmp", "image/gif", "image/jpeg", "image/jpeg", "image/jpg");
    protected static $videos = array("video/mp4");
    protected static $audio = array();
    protected static $rich = array(); //Rich Html embed for swf etc

    private static function tag($media, $tag = NULL) {

        $config = \Library\Config::getInstance();

        static::$images = $config->getParam("image", static::$images, "attachments");
        static::$videos = $config->getParam("video", static::$videos, "attachments");
        static::$audio = $config->getParam("audio", static::$audio, "attachments");
        //static::$rich  = $config->getParam( "application", static::$rich, "attachments");


        $tag = empty($tag) ? array() : $tag;
        //Media must be a platform entity object
        //if(!is_a($media, '\Platform\Entity')) return null;
        //$attachmentTypes = \Library\Config::getParam("allowed-types", array(), "attachments");
        $name = $media->getPropertyValue("attachment_name");
        $type = $media->getPropertyValue("attachment_type");
        $uri = $media->getObjectURI();
        $url = "/system/object/" . $uri;

        $mode = isset($tag['MODE']) ? $tag['MODE'] : "thumbnail"; //thumbnail, icon etc...
        $link = isset($tag['LINK']) ? TRUE : FALSE;

        //if the file does not exists
        if (empty($name) || empty($type) || empty($uri)):
            $uri = 'placeholder';
            $name = 'Placeholder';
            $type = 'image/jpeg';
            $link = false;
        endif;

        $class = isset($tag['CLASS']) ? static::getData($tag['CLASS'], $tag['CLASS']) : null;
        $height = isset($tag['HEIGHT']) ? static::getData($tag['HEIGHT'], $tag['HEIGHT']) : null;
        $width = isset($tag['WIDTH']) ? static::getData($tag['WIDTH'], $tag['WIDTH']) : null;
        $mime = strtolower($type);
        //unset($tag['NAMESPACE']);

        $basename = \Library\Folder\Files::getExtension($name, "file");
        $fileExtension = strtolower($basename);

        //If the medialink is linkable...
        if ($link):
            $tag['ELEMENT'] = 'a';
            $tag['HREF'] = \Library\Uri::internal($url);
        else:
            $tag['ELEMENT'] = 'figure';
            $tag['CLASS'] = "medialink\n" . !empty($class) ? $class : null;
        endif;

        //@TODO determine browser compatibility and addmime to the above arrays i.e images, videos, audio, rich;
        //Can we render this media link?
        $renderable = array_merge(static::$images, static::$videos, static::$audio, static::$rich);

        //Videos, audio rich
        if ((in_array($mime, array_merge(static::$videos, static::$rich)) && $mode == "icon") || !in_array($mime, $renderable)) {

            $linkable = array("ELEMENT" => "a", "HREF" => \Library\Uri::internal($url), "CLASS" => "media-{$fileExtension} media-file",);
            $linkable["CHILDREN"][] = array("ELEMENT" => "span", "CLASS" => "media-type media-{$fileExtension}", "CDATA" => "<i class='icon-file'></i>" . $fileExtension);
            $linkable["CHILDREN"][] = array("ELEMENT" => "span", "CLASS" => "media-filename list-hide", "CDATA" => $name);
            $linkable["CHILDREN"][] = array("ELEMENT" => "span", "CLASS" => "media-help list-hide help-block", "CDATA" => $mime);
            //We cannot have two a > a
            return $linkable;
        } else {

            //Type specific
            if (!empty($type)):

                //@TODO will need to determine browser support for the various
                //mime types shown here, for instance only safari browsers support image/tiff;
                if (in_array($mime, static::$images)):
                    //Create an image element
                    $imageLink = \Library\Uri::internal("/system/object/" . $uri);
                    $image = array(
                        "ELEMENT" => "img",
                        "SRC" => $imageLink . (!empty($width) ? "/resize/{$width}" . (!empty($height) ? "/{$height}" : null) : null),
                        "ALT" => !empty($name) ? $name : null,
                        "WIDTH" => !empty($width) ? $width : null,
                        "HEIGHT" => !empty($height) ? $height : null
                    );
                    if (empty($image['WIDTH']))
                        unset($image['WIDTH']);
                    if (empty($image['HEIGHT']))
                        unset($image['HEIGHT']);
                    if (isset($link) && !empty($url)):
                        $tag['HREF'] = \Library\Uri::internal("/system/media/photo/view/" . $uri);
                    endif;
                    $tag['CHILDREN'][] = $image;
                //$tag = array("ELEMENT"=>"span","CDATA"=>"Single Image");
                endif;

                if (in_array($mime, static::$videos) && !empty($uri)):

                    $videoLink = \Library\Uri::internal("/system/object/" . $uri);
                    $tag = static::videoTag($videoLink, $mime, $height, $width, $tag);

                endif;

                if (in_array($mime, static::$audio) && !empty($uri)):

                    $audioLink = \Library\Uri::internal("/system/object/" . $uri);
                    $tag = static::audioTag($audioLink, $mime, $height, $width, $tag);

                endif;
            endif;
            unset($tag['WIDTH']);
            unset($tag['HEIGHT']);
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
     * Generates a video tag
     * 
     * @param type $src
     * @param type $type
     * @param type $height
     * @param type $width
     * @param type $dataTag
     * @return type
     */
    final private static function videoTag($src, $type, $height, $width, $dataTag = array()) {

        $controls = static::mediaControls();
        $video = array(
            "ELEMENT" => "video",
            "CHILDREN" => array(
                array(
                    "ELEMENT" => "SOURCE",
                    "SRC" => $src,
                    "TYPE" => $type
                )
            )
        );
        $figure = array(
            "ELEMENT" => "figure",
            "CLASS" => "video",
            "DATA-TARGET" => "budkit-player",
            "WIDTH" => !empty($width) ? $width : 100,
            "HEIGHT" => !empty($height) ? $height : 100,
            "CHILDREN" => array($controls, $video)
        );
        return $figure;
    }

    /**
     * Displays and audio media tag
     * @param type $src
     * @param type $type
     * @param type $height
     * @param type $width
     * @param type $dataTag
     * @return string
     */
    final private static function audioTag($src, $type, $height, $width, $dataTag = array()) {

        $width = !empty($width) ? $width : \Library\Config::getParam('gallery-thumbnail-width', 170, 'content');
        $height = !empty($height) ? $height : \Library\Config::getParam('gallery-thumbnail-height', 170, 'content');
        $controls = static::mediaControls();
        $audio = array(
            "ELEMENT" => "audio",
            "WIDTH" => $width,
            "HEIGHT" => $height,
            "CHILDREN" => array(
                array(
                    "ELEMENT" => "SOURCE",
                    "SRC" => $src,
                    "TYPE" => $type
                )
            )
        );
        $poster = array(
          "ELEMENT"=>"img",
          "SRC"=> \Library\Uri::internal("/system/object/placeholder/resize/170/170"),
        );
        $figure = array(
            "ELEMENT" => "figure",
            "CLASS" => "audio",
            "DATA-TARGET" => "budkit-player",
            "CHILDREN" => array($poster, $audio, $controls)
        );
        return $figure;
    }

    /**
     * Media Controls for both audio and video
     * @return type
     */
    final private static function mediaControls() {
        return array(
            "ELEMENT" => "div",
            "ClASS" => "controls",
            "CHILDREN" => array(
                array(array("ELEMENT" => "div", "CLASS" => "seek", "CHILDREN" => array(
                            array("ELEMENT" => "span", "CLASS" => "buffer"),
                            array("ELEMENT" => "span", "CLASS" => "progress"),
                            array("ELEMENT" => "span", "CLASS" => "timer-knob"),
                            array("ELEMENT" => "span", "CLASS" => "timer", "CDATA" => "0:00"),
                        )
                    )
                ),
                array("ELEMENT" => "div", "CLASS" => "tools", "CHILDREN" => array(
                        array("ELEMENT" => "a", "CLASS" => "icon-play play pull-left", "TITLE" => "Play/Pause"),
                        array("ELEMENT" => "a", "CLASS" => "icon-volume volume pull-left", "TITLE" => "Volume"),
                        array("ELEMENT" => "span", "CLASS" => "volume-seek"),
                        array("ELEMENT" => "span", "CLASS" => "timelog", "CDATA" => "0:00/0:00"),
                        array("ELEMENT" => "a", "CLASS" => "icon-fullscreen fullscreen pull-right", "TITLE" => "Full Screen")
                    )
                )
            )
        );
    }

    /**
     * Execute the layout
     * 
     * @param type $parser
     * @param type $tag
     * @return type
     */
    public static function execute($parser, $tag, $writer) {

        $attachmentModel = \Application\System\Models\Attachments::getInstance();
        $collectionModel = \Application\System\Models\Collection::getInstance();

        //@TODO media thumbnail mode
        if (!isset($tag['URI']) && empty($tag['URI']))
            return null;
        $uri = static::getData($tag['URI'], $tag['URI']);

        $mediaObject = $attachmentModel->loadObjectByURI($uri);
        $type = $mediaObject->getObjectType();

        if ($type !== "attachment"):
            //1.Load the collection!
            $collection = $collectionModel->loadObjectByURI($uri);
            //Now lets populate our collection with Items
            $collectionItems = $collection->getPropertyValue("collection_items");
            $collectionItemize = explode(",", $collectionItems);
            if (!empty($collectionItems) && is_array($collectionItemize) && !empty($collectionItemize)):

                $ul = array("ELEMENT" => "ul", "CLASS" => "media-grid compensate-margins bottom-media clearfix");
                $tag['WIDTH'] = \Library\Config::getParam('gallery-thumbnail-width', 170, 'content');
                $tag['HEIGHT'] = \Library\Config::getParam('gallery-thumbnail-height', 170, 'content');
                $tag['MODE'] = 'icon';
                foreach ($collectionItemize as $item) {
                    $li = array("ELEMENT" => "li", "CHILDREN" => static::tag($attachmentModel->loadObjectByURI($item), $tag));
                    $ul["CHILDREN"][] = $li;
                }
                //Lots of child elements;
                $tag = $ul;
            else:
                $tag = static::tag($mediaObject, $tag);
            endif;
        else:
            $tag = static::tag($mediaObject, $tag);
        endif;


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

