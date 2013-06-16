<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * element.php
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
 * @since      Class available since Release 1.0.0 Jan 28, 2012 2:06:49 PM
 *
 */

namespace Library\Output\Parse\Template;

use Library;
use Library\Output;
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
 * @since      Class available since Release 1.0.0 Jan 28, 2012 2:06:49 PM
 */
class Element extends Parse\Template {
    /*
     * @var object
     */

    static $instance;

    /**
     * Defines the class constructor
     * Used to preload pre-requisites for the element class
     *
     * @return object element
     */
    public function __constructor() {
        
    }

    /**
     * Writes out the attribute element
     * 
     * @param type $attribute
     * @param type $content
     * @param type $writer
     * @return boolean 
     */
    public static function attribute(&$attribute, &$content, &$writer) {

        //Search for (?<=\$\{)([a-zA-Z]+)(?=\}) and replace with data
        $parsed = static::getDataAttributeContent($attribute, $content);

        if (!empty($parsed)):
            $content = str_ireplace($parsed['searches'], $parsed['replace'], $content);
        endif;

        //Automatically internalize HREFs! 
        //@TODO Use call backs of type i.x _XMLAttributeCallbackOn<type> e.g _XMLAttributeCallbackOnHref
        $references = array("HREF", "ACTION", "SRC");
        if (in_array(strtoupper($attribute), $references)) {
            $content = \Library\Uri::internal($content);
        }

        return;
    }

    /**
     * Writes out CDATA
     * 
     * @param type $text
     * @param type $writer 
     */
    public static function content($text, $writer) {
        $writer->writeRaw(trim($text));
    }

    protected static function wordLimit($string, $limit) {

        //@TODO maybe strip html tags before counting?

        $words = explode(" ", $string);
        $continum = (sizeof($words) > (int) $limit) ? " [...]" : NULL;

        return (empty($continum)) ? $string : implode(" ", array_splice($words, 0, $limit)) . $continum;
    }

    /**
     * Alias for html, but does not allows tags
     * 
     * @param type $tag
     * @return type 
     */
    public static function text($tag) {
        return static::html($tag, true);
    }

    /**
     * Displays a formatted time string
     * 
     * @param type $tag
     * @return null
     */
    public static function time($tag) {
        //Get the data;
        if (isset($tag['DATA'])):
            $tag['_DEFAULT'] = isset($tag['CDATA']) ? $tag['CDATA'] : null;
            $time = self::getData($tag['DATA'], $tag['_DEFAULT']); //echo $data;
            //if formatting
            if (isset($tag['FORMATTING']) && in_array($tag['FORMATTING'], array("sprintf", "vsprintf"))):
                $text = call_user_func($tag['FORMATTING'], $tag['_DEFAULT'], $time);
                $time = $text;
            endif;

            if (isset($tag['FORMATTING']) && in_array($tag['FORMATTING'], array("noformatting"))):
                $time = $time;
            else:
                $now = Library\Date\Time::stamp();
                $time = Library\Date\Time::difference(strtotime($time), strtotime($now));
            endif;

            $tag['CDATA'] = $time;
            //If we do not have a default empty it
            if (is_null($tag['_DEFAULT']))
                unset($tag['_DEFAULT']);
        //die;
        endif;

        //Get the layout name; and save it!
        if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
            static::$writer->writeRaw($tag['CDATA']);
        endif;

        return null; //Removes the element from the tree but returns the text;
    }

    /**
     * Renders a text element
     * 
     * @param type $tag
     * @return null 
     */
    private static function html($tag, $strip = false) {

        //Get the data;
        if (isset($tag['DATA'])):
            $tag['_DEFAULT'] = isset($tag['CDATA']) ? $tag['CDATA'] : null;
            $data = self::getData($tag['DATA'], $tag['_DEFAULT']); //echo $data;
                 //Replace the CDATA;
            $data = ($strip) ? strip_tags(html_entity_decode(trim($data))) : $data;
            //if formatting
            if (isset($tag['FORMATTING']) && in_array($tag['FORMATTING'], array("sprintf", "vsprintf"))):
                $text = call_user_func($tag['FORMATTING'], $tag['_DEFAULT'], $data);

                //Replace the CDATA;
                $data = $text;
            endif;
            
            //Parse medialinks
            if (isset($tag['MEDIALINKS'])):
                //need to convert data back to its entities cahracter
                $data = html_entity_decode($data);
                //Match mentions, urls, and hastags
                preg_match_all('/^|\s?[^a-zA-Z0-9+!*(),;?&=\$_.-]@([\\d\\w]+)/', $data, $mentions); //[^a-zA-Z0-9+!*(),;?&=\$_.-] added to prevent it picking up emails;
                preg_match_all('/^|\s?[^\&]#([\\d\\w]+)/', $data, $hashTags); //There must be a space between two hastags;
                preg_match_all('/(?<!"|a>)((http|https|ftp|ftps)\:\/\/)([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?([a-zA-Z0-9\-\.]+)\.([a-zA-Z]{2,3})(\:[0-9]{2,5})?(\/([a-zA-Z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?/', $data, $openLinks);
                $searches = array_merge($mentions[0], $hashTags[0], $openLinks[0]);
                $fMentions = array_map(function($uri, $title) {
                            $profile = Library\Uri::internal("/member:{$uri}/profile/timeline");
                            return "<a class=\"mention\" href=\"{$profile}\">{$title}</a>";
                        }, $mentions[1], $mentions[0]);
                $fHashTags = array_map(function($uri, $title) {
                            $search = Library\Uri::internal("/system/search/term/{$uri}");
                            return "<a class=\"hashtag\" href=\"{$search}\">{$title}</a>";
                        }, $hashTags[1], $hashTags[0]);
                $fOpenLinks = array_map(function($uri) {
                            return "<a class=\"openlink\" href=\"{$uri}\">{$uri}</a>";
                        }, $openLinks[0]);
                $replaces = array_merge($fMentions, $fHashTags, $fOpenLinks);
                $data = str_replace($searches, $replaces, (string) $data);

            endif;

            //HTML;
            if (strtolower($tag['TYPE']) == "html"):
            //print_R($data); 
            //$data = nl2br( $data );
            endif;

            //@TODO The behavior of the word limit function wtih html formated string is unknown;
            $tag['CDATA'] = isset($tag['WORDLIMIT']) ? static::wordLimit($data, $tag['WORDLIMIT']) : $data;
            //If we do not have a default empty it
            if (is_null($tag['_DEFAULT']))
                unset($tag['_DEFAULT']);

        //die;
        endif;

        //Get the layout name; and save it!
        if (isset($tag['CDATA']) && is_a(static::$writer, "XMLWriter")):
            static::$writer->writeRaw($tag['CDATA']);
        endif;

        return null; //Removes the element from the tree but returns the text;
    }

    /**
     * Renders and reparses a layout element 
     * 
     * @param type $tag 
     */
    private static function layout($tag) {

        $element = null;

        //Get the layout name; 
        if (isset($tag['NAME']) && isset(static::$layouts[$tag['NAME']])):
            //Check if we have the element previously parsed
            $element = static::$layouts[$tag['NAME']];

        endif;

        return $element; //Returns the previously parsed element;
    }

    /**
     * Executes the tpl:element method
     * 
     * @param type $parser
     * @param type $tag
     * @param type $writer
     * @return type 
     */
    public static function execute($parser, $tag, $writer) {

        static::$writer = $writer;

        //If no type is defined return null. !We need a type
        if (isset($tag['TYPE'])):
            //@TODO Sad that i have to instantiate this calss 
            //To check if it exists. I need a better way of doing this
            $submethods = array("text", "layout", "html", "time");
            //To spare some more memory
            if (method_exists(self::getInstance(), $tag['TYPE']) && in_array(strtolower($tag['TYPE']), $submethods)) :
                $tag = static::$tag['TYPE']($tag);
            endif;
        endif;

        return $tag;
    }

    /**
     * Returns and instantiated Instance of the element class
     *
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     *
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance
     * @return object element
     */
    public static function getInstance() {

        if (is_object(static::$instance) && is_a(static::$instance, 'element'))
            return static::$instance;

        static::$instance = new self();

        return static::$instance;
    }

}

