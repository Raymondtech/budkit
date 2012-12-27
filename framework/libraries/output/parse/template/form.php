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
class Form extends Parse\Template {
    /*
     * @var object
     */

    static
            $instance,
            $parseControls = false,
            $wrapControls = false,
            $allowed = array(
                "input","select","button","radios","checkboxes" //introduces a new radios and checkboxes elements which equal to lookup radio groups and checkboxes
            );

    /**
     * Defines the class constructor
     * Used to preload pre-requisites for the element class
     *
     * @return object element
     */
    public function __constructor() {
        
    }
    
    /**
     * Wraps control elements into appropriately styled xhtml
     * 
     * @param type $element
     * @return string
     */
    private static function wrapper( $element ){ 
        
        //if element has a nowrap attribute skip wrapping
        if(isset($element['NOWRAP'])) return $element;
        
        //Define wrapping futures
        $controlGroup   = array("ELEMENT"=>"div","CLASS"=>"control-group"); 
        $controlLabel   = array("ELEMENT"=>"label","CLASS"=>"control-label");
        $controlElement = array("ELEMENT"=>"div","CLASS"=>"control");
        $helpBlock      = array("ELEMENT"=>"span","CLASS"=>"help-block");
        
        //Define the label, etc;
        if(isset($element['LABEL'])):
            $controlLabel['FOR']    = isset($element['NAME']) ? $element['NAME'] : $element['LABEL'];
            $controlLabel['CDATA']  = $element['LABEL'];
            unset($element['LABEL']); //Remove the label if defined;
        endif;
        
        ////Define the help block or hint
        if(isset($element['HINT'])):
            $helpBlock['CDATA']  = $element['HINT'];
            unset($element['HINT']); //Remove the label if defined;
        endif;
        
        //Stack'em Up
        $controlElement["CHILDREN"][] = $element;
        $controlElement["CHILDREN"][] = $helpBlock;
        $controlGroup["CHILDREN"][]   = $controlLabel;
        $controlGroup["CHILDREN"][]   = $controlElement;
        
        //print_R($controlGroup);
        
        return $controlGroup;
    }
    
    private static function input( $element ){
        //print_R($element);
        return $element;
    }
    
    /**
     * Generates a select form element from a Parsed PHP form
     * 
     * @param type $element
     * @return type
     */
    private static function select( $element ){
        
        //Calculate and set the default value;
        if(isset($element['VALUE'])):
            
            $default = $element['VALUE'];
        
            foreach($element['CHILDREN'] AS $k=>$option):

                if($option['VALUE']!==$default):
                    unset($element['CHILDREN'][$k]['SELECTED']);
                elseif($option['VALUE'] == $default ):   
                    //@TODO @BUG Due to the fact that you have to set all attributes
                    //between the element and cdata keys in the element array
                    //We have to unset the cdata, set the selected and then reset the cdata
                    //Very nasty indeed
                    $cdata  = $option['CDATA']; unset($option['CDATA']);
                    $option['SELECTED'] = 'selected';
                    $option['CDATA']    = $cdata;
                    $element['CHILDREN'][$k] = $option;              
                endif;
            endforeach;
            
            unset($element['VALUE']);
        endif;
        return $element;
    }
    
    private static function radios( $element ){
        return $element;
    }
    private static function checkboxes( $element ){
        return $element;
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
        
        static::$parseControls = (isset($tag['PARSE']) && (bool) $tag['PARSE'] ) ? TRUE : FALSE;      
        if (static::$parseControls):
            static::$wrapControls = (isset($tag['WRAP']) && (bool) $tag['WRAP'] ) ? TRUE : FALSE;
            //echo "form block";
            $children = array();
            $elements = isset($tag['CHILDREN']) ? $tag['CHILDREN'] : array(); //Get all the form element definitions       
            foreach ($elements as $i=>$element):
                if(in_array($element['ELEMENT'], static::$allowed) && method_exists(self::getInstance(), $element['ELEMENT'])):
                    $element = static::$element['ELEMENT']($element);
                    if(!empty($element)):
                        $element = (static::$wrapControls)? static::wrapper($element) : $element;
                    endif;
                endif;
                $children[] = $element;
            endforeach;
            $tag["CHILDREN"] = $children;
        endif;
        
        //If we don't return the other elements that are not parsed, then they will not be displayed
        //Remember this form tpl parser is mainly for elements which have the parse=true attribute
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

