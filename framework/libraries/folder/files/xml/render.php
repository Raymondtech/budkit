<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * render.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/path
 * @since      Class available since Release 1.0.0 Jan 28, 2012 4:45:51 PM
 * 
 */

namespace Library\Folder\Files\Xml;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/path
 * @since      Class available since Release 1.0.0 Jan 28, 2012 4:45:51 PM
 */
final class Render {

    /**
     * XMLtoString Renderer
     * 
     * @param type $root
     * @param type $xmlWriter
     * @return type
     */
    public function __construct($root, $xmlWriter) {
        return $this->__($root, $xmlWriter);
    }

    /**
     * Renders the XML output
     * 
     * @param type $tree
     * @param type $xml
     * @return null
     */
    public function __($tree, $xml) {

        //Returns the XML
        if (empty($tree) && !is_array($tree))
            return null;
        $tag = null;
        $cdata = null;
        $children = null;
        //EXECUTE TPL CALLBACKS BEFORE ELEMENT RENDERING;
        $tree = (array)Parser::callback($tree, $xml);

        //WE DON'T NEED NAMESPACES?
        unset($tree['NAMESPACE']); //We don't need namespaces;
        //FIRST GET THE ELEMENT;
        if (isset($tree['ELEMENT'])) {
            $tag = $tree['ELEMENT'];
            $xml->startElement($tag);
            unset($tree['ELEMENT']); //Remove it from the tree;
        }
        //CHECK FOR CDATA;
//        //CHECK FOR CHILDREN;
//        if (!empty($tag) && isset($tree['CHILDREN'])) {
//            $children = $tree['CHILDREN'];
//            unset($tree['CHILDREN']); //Remove it from the tree;
//        }
        //CHECK FOR ALL OTHER ATTRIBUTES;
        foreach ($tree as $index => $element) :
            //CHILDREN WILL BE CHILDREN AGAIN
            if (is_array($element)):
                $this->__($element, $xml);
                unset($tree[$index]);
            elseif (!empty($tag)&& !in_array($index, array("CDATA","CHILDREN"))):
                $attribute = $index;
                $value = $element;
                //$xml->startAttribute(strtolower($attribute));
                \Library\Event::trigger("_XMLAttributeCallback", $attribute, $value, $xml);
                //$xml->text($value);
                $xml->writeAttribute( strtolower($attribute), $value);
                unset($tree[$index]); //Remove it from the tree
            elseif (!empty($tag) && $index == "CDATA") :
                $cdata = $element;
                $xml->writeRaw(trim($cdata));
                unset($tree[$index]); //Remove it from the tree;
            endif;
        endforeach;
        //If an only if there is an open tag;
        if (!empty($tag)):
            //CLOSE THE TAG
            $selfclosing = array("area", "base", "basefont", "br", "col", "frame", "hr", "img", "input", "link", "meta", "param");
            //empty tags e.g script etc
            if (!in_array($tag, $selfclosing)) {
                $xml->fullEndElement();
            } else {
                $xml->endElement();
            }
        endif;
    }
}