<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * view.php
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
namespace Platform;

/**
 * The parent view class
 *
 * @category   Framework
 * @package    Utitlity
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
abstract class View extends \Library\Object {

    var $output;

    /**
     * Just the constructor
     * @return void
     */
    public function __construct() {
        
        $this->output = \Library\Output::getInstance();              
        $authenticated  = \Platform\User::getAuthenticated();
        
        $this->output->set("authenticated", $authenticated );
        
        //Navigator::menu();
    }
    
    /**
     * Generates html output for the email
     * @param type $subject
     * @param type $body
     * @param type $vars
     */
    final public function email($subject, $body, $vars = array()){
        
        $email = array_merge( array(
            "subject" => $subject,
            "body"  =>$body
        ), $vars );
        
        $template = $this->output->layout('email');
              
    }
    
    final public function editor( $form = array() ){
        
        //Displays the editor;
        $formlist =  array(
            array("id"=>"status","title"=>"Idea","layout"=>"forms/status","app"=>"system","icon-class"=>"icon-lightbulb"),
            array("id"=>"drop","title"=>"Upload","layout"=>"forms/drop","app"=>"system","icon-class"=>"icon-cloud-upload"), 
            array("id"=>"snap","title"=>"Snap","layout"=>"forms/snap","app"=>"system","icon-class"=>"icon-camera"), 
            array("id"=>"editor","title"=>"Article","layout"=>"forms/editor","app"=>"system","icon-class"=>"icon-align-justify"), 
            array("id"=>"import","title"=>"Import","layout"=>"forms/import","app"=>"system","icon-class"=>"icon-upload-alt")
        );
        \Library\Event::trigger("beforeEditorDisplay", $formlist);
        
        if(!is_array($form)):
            $active = \strtolower($form);
            $form = array();
            foreach($formlist as $_form):
                if(array_key_exists('id', $_form) && \strtolower($_form['id'])==$active):
                    $form = $_form; break;
                endif;
            endforeach;
        endif;
        
        $forms = !empty($form)? array( $form ) : $formlist;
        
        //Set the editor forms
        if(!empty($forms)):
            $this->output->set("editor_forms", $forms);
        endif;       
    }

    /**
     * Sets an output
     * 
     * @param string $name
     * @param mixed $value 
     * @final
     * @access public
     * @return void This method does not return any value
     */
    final public function set($name, $value=NULL, $overwrite=FALSE) {
        //Determine all other auto set vars; 
        $this->output->set($name, $value);
    }

    /**
     * Gets a stored output variable
     *
     * @param string $name 
     * @param string $default 
     * @param string $format 
     * @final
     * @access public
     * @return mixed
     */
    final public function get($name, $default='', $format='') {
        //Determine all other auto set vars;
        return $this->output->get($name, $default = '', $format = '');
    }



    /**
     * The default method for each controller
     * @return  void
     * @abstract
     * @access public
     */
    abstract public function display();
}

