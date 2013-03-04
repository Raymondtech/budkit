<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * json.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/output/format/json
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Library\Output\Format;

use Library;
use Library\Output;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Library
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/output/format/json
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class JSON extends Library\Output\Document {

    /**
     * Return the output as properly formatted json
     * 
     * @return string json
     */
    public function render($template=null, $httpcode=null, $headers = array()) {

        $httpcode = empty($httpcode) ? $this->getResponseCode() : $httpcode;
        
        @header("HTTP/1.1 {$httpcode}");
        $headers = empty($headers)? $this->getHeaders() : $headers;     
        if(is_array($headers)){
            foreach($headers as $name=>$value){
                $this->unsetHeader($name);
                $this->setHeader($name, $value);
            }
        };
        $this->setHeader('Content-type','text/json');
        //Will remove some system vars by default. 
        //@TODO will need to come up with a way for the consumer to request these vars
        $this->removeOutputVar("debug");
        $this->removeOutputVar("page");
        $this->removeOutputVar("user");
        
        //Get respone messages, then remove the alerts output var
        $messages = $this->getMessages();
        $this->removeOutputVar("alerts");
        
        //The response structure
        $this->response = array(
            "status" => $httpcode,
            "messages" => $messages,
            "data" => $this->getVariables(), //Gets the output variables
            "template" => $template
        );

        //2. Import JSON Library;
        $json       = \Library\Folder::getFile("json");
        $response   = $json->encode($this->response);

        //Print out the json output
        print_R($response);
    }

    /**
     * Gets an instance of the registry element
     * 
     * @staticvar self $instance
     * @param type $name
     * @return self 
     */
    final public static function getInstance() {

        static $instance;

        //If the class was already instantiated, just return it
        if (isset($instance)) {
            return $instance;
        }

        $instance = new self;

        return $instance;
    }

}