<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * privacy.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform\Authorize;

use Library;
/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
trait Privacy {
    
    
    private static function getObjectPrivacyTree($userid=NULL){}
    
    /**
     * 
     * Determines if the Platform user can access an objectURI, or object property
     * @param type $objectURI
     * @param type $property
     * @param type $privacygroup
     * 
     */
    protected static function canAccess($objectURI, $property = array() ){
        
        //$object = static::getInstance();
        //print_R($object);
        $graph = \Platform\Graph::getInstance();
        
        $one = $graph->createNode("one");
        $two = $graph->createNode("two");
        $three=$graph->createNode("three");
        $four =$graph->createNode("four");
        $five =$graph->createNode("five");
        
        
        $graph->addEdge($one, $two);
        $graph->addEdge($two, $four);
        $graph->addEdge($three, $one);
        $graph->addEdge($three, $two);
        $graph->addEdge($four, $three);
        $graph->addEdge($four, $four);
        
        $fourInDegree = $four->getInDegree();
        
        print_R($fourInDegree);
        
        //$graph->removeEdge($three, $four, FALSE);
        
        print_R($graph);
        
    }
    
    
    protected static function setAccess($objectURI, $property =array(), $privacygroup = NULL , $access=FALSE ){}
   
}
