<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * edge.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/graph
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform\Graph;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/graph
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Edge {

    /**
     * Identifies the current edge
     * @var type 
     */
    protected $edgeId = NULL;

    /**
     * Holds any data associated to this edge
     * @var type 
     */
    protected $edgeData = array();

    /**
     * Returns the edge's Id
     * 
     * @return type
     */
    public function getId() {
        return $this->edgeId;
    }

    /**
     * Sets the edge Id
     * 
     * @param type $edgeId
     * @return \Platform\Graph\Node
     */
    public function setId($edgeId) {
        $this->edgeId = strval($edgeId);
        return $this;
    }

    /**
     * Returns the edge Data if any exists
     * 
     * @return type
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Sets edge data
     * 
     * @param type $edgeData
     * @return \Platform\Graph\Node
     */
    public function setData($edgeData = array()) {
        $this->edgeData = $edgeData;
        return $this;
    }

    /**
     * Returns and instantiated Instance of the graph class
     * 
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     * 
     * @param type $nodeA
     * @param type $nodeB
     * @param type $edgeData
     * 
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance 
     * 
     * @return object graph
     */
    public function __construct(&$head, &$tail, $edgeData = array()) {
        if (!is_a($head, "\Platform\Graph\Node")||!is_a($tail, "\Platform\Graph\Node")){
            throw new \Platform\Exception("Nodes used to create a new Edge must be instances of \Platform\Graph\Node", PLATFORM_ERROR);
        }
        $edgeId = "someId";
        $this->setId($edgeId);
        $this->setData($edgeData);
    }

}

