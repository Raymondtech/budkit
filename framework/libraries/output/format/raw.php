<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * raw.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/output/format/raw
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/output/format/raw
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Raw extends Library\Output\Document {

    /**
     * Dumps the output layout to screen
     * 
     * @return string json
     */
    public function render($httpCode=200) {

        //The response code, default is 200;
        if(isset($httpCode)&&!empty($httpCode)){
            $this->setResponseCode( (int) $httpCode );
        }

        $this->headers("text/html");
        //$template = empty($template) ? $this->output->layout : $template ;
        
        //@TODO we need to work out a way to decide what block you intend to get
        $this->position("body", "No output to render"); //Raw displays only the body position
       
        
        //parse the set layout as the final output;
        //5. Close and Flush buffer
        $document     = $this->restartBuffer();
        
        //print_R(\Platform\Debugger::$log);
        //Print to client
        print(trim($document) );

        ob_flush();
        ob_end_flush();

        exit;
        //return $this;
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
        if (isset($instance))
            return $instance;

        $instance = new self;

        return $instance;
    }

}