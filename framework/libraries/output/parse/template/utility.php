<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * utility.php
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
class Utility extends Parse\Template {
    /*
     * @var object
     */

    static $instance;

    /**
     * Defines the class constructor
     * Used to preload pre-requisites for the tag class
     *
     * @return object tag
     */
    public function __constructor() {}
    
    /**
     * Displays a formatted time string
     * 
     * @param type $tag
     * @return null
     */
    public static function head($tag, $writer, $parser) {

        $output = static::$document;
        $scripts = $output->getScripts();
        $styles = $output->getStyles();
        $meta = $output->getMeta();
        
        //Write Meta
        foreach ($meta as $_meta):
            //$link = array( "element" => "link");
            $writer->startElement("meta");
            foreach ($_meta as $attribute => $value):
                $writer->writeAttribute(strtolower($attribute), $value);
            endforeach;
            $writer->endElement();
        endforeach;

        //Write styles
        foreach ($styles as $style):
            //$link = array( "element" => "link");
            $writer->startElement("link");
            foreach ($style as $attribute => $value):
                $writer->writeAttribute(strtolower($attribute), $value);
            endforeach;
            $writer->endElement();
        endforeach;

        //Write Scripts
        foreach ($scripts as $script):
            //$link = array( "element" => "link");
            $writer->startElement("script");
            foreach ($script as $attribute => $value):
                $writer->writeAttribute(strtolower($attribute), $value);
            endforeach;
            $writer->fullEndElement();
        endforeach;
        
        //unset($tag);
        //unset($scripts);
        //unset($styles);
       // unset($meta);

        return $tag; //Removes the element from the tree but returns the text;
    }

    /**
     * Executes the tpl:tag method
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
            $submethods = array("head");
            //To spare some more memory
            if (method_exists(self::getInstance(), $tag['TYPE']) && in_array(strtolower($tag['TYPE']), $submethods)) :
               $tag = static::$tag['TYPE']($tag, $writer, $parser);
            endif;
        endif;
     
        return null;
    }

    /**
     * Returns and instantiated Instance of the tag class
     *
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     *
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance
     * @return object Output
     */
    public static function getInstance() {
        if (is_object(static::$instance) && is_a(static::$instance, 'utility'))
            return static::$instance;
        static::$instance = new self();
        return static::$instance;
    }

}

