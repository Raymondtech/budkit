<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * object.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Application\System\Models\Activity;

use Platform;
use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Model
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/controller
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Object {

    
    /**
     * An Arrray of one or more additional associated objects
     * @var array 
     */
    public $attachments = array();
    
    /**
     * A single object describing the entity that created or authored the object
     * @var object 
     */
    public $author = NULL;
   
    /**
     * Natural language description of the object. Can contain HTML Markup and other visual elements
     * such as thumbmail images
     * @var string 
     */
    public $content = "";
    
    /**
     * String specifying the display name of the contained object. This is REQUIREd for all objects of type "user"
     * and where the objectType property is not specified;
     * @var string 
     */
    public $displayName = "";
    
    /**
     * Provides a permermanent unique identifier for this object
     * @var interger 
     */
    public $id = "";
    
    /**
     * A media link or a resource providing visual reperesentatino of this object
     * @var object 
     */
    public $image = NULL;
    
    /**
     * Identifies the object type 
     * @var string 
     */
    public $objectType = "";
    
    /**
     * The date and time the object was published. 
     * @var string  
     */
    public $published = "";
    
    /**
     * Natural language summarization of the object
     * @var string
     */
    public $summary = "";
    
    /**
     * An IRI identifying a resource providing an HTML representation of the object. 
     * @var string 
     */
    public $url;
    
    
    public function __construct(){}
    
    public function serialize(){}
    
    public function unserialize(){}
    
    public static function createInstance(){}

}