<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * graph.php
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
final class Node {

    /**
     * Identifies the current node
     * @var type 
     */
    protected $nodeId = NULL;

    /**
     * Holds any data associated to this node
     * @var type 
     */
    protected static $nodeData = array();
    private static $nodeGraph = NULL;

    /**
     * Returns the node's Id
     * 
     * @return type
     */
    public function getId() {
        return $this->nodeId;
    }

    /**
     * Sets the node Id
     * 
     * @param type $nodeId
     * @return \Platform\Graph\Node
     */
    public function setId($nodeId) {
        $this->nodeId = strval($nodeId);
        return $this;
    }

    /**
     * Returns the node Data if any exists
     * @return type
     */
    public function getData() {
        return static::$nodeData;
    }

    /**
     * Sets node data
     * 
     * @param type $nodeData
     * @return \Platform\Graph\Node
     */
    public function setData($nodeData = array()) {
        static::$nodeData = $nodeData;
        return $this;
    }

    /**
     * Returns the node neighbours. 
     * If no arc Ids are defined, returns nodes at either ends of any edge 
     * 
     * @return array
     */
    public function getRelated($arcId = NULL) {
        
    }

    /**
     * Degree or valency is the number of edges incident to the vertex
     * deg(v) where v = vertex or node
     */
    public function getDegree() {
        
    }

    /**
     * The number of head endpoints adjacent to the node is called the indegree.
     * i.e Number of directed edges (arcs) to this node. Use getDegree to get
     * the total number of edges (directed or undirected) to this node
     * 
     * @return interger
     */
    public function getInDegree() {
        
    }

    /**
     * The number of tail endpoints adjacent to the node is called the outdegree
     * i.e Number of directed edges (arcs) from this node. Use getDegree to get 
     * the total number of edges (directed or undirected) to this node
     * 
     * @return interger
     */
    public function getOutDegree() {
        
    }

    /**
     * Determines if this node is related to another node
     * 
     * @param type $node
     * @param type $arcId
     */
    public function isRelatedTo($node, $arcId = NULL) {
        //Check that we have a graph in nodegraph;
    }

    /**
     * An isolated node has a degree of 0
     * @rturn boolean
     */
    public function isIsolated() {
        
    }

    /**
     * Determines if the current node, can reach nodeB
     * @return boolean
     */
    public function isReacheable(&$nodeB) {
        
    }

    /**
     * A leaf node/vertex has a degree of 1
     * @return boolean
     */
    public function isLeaf() {
        
    }

    /**
     * Sets the Parent Graph
     * 
     * @param type $graph
     */
    public function setGraph(&$graph) {
        static::$nodeGraph = & $graph;
    }

    /**
     * Returns the parent graph
     * 
     * @return type
     */
    public function &getGraph() {
        return static::$nodeGraph;
    }

    /**
     * Returns and instantiated Instance of the graph class
     * 
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     * 
     * @param type $nodeId
     * @param type $nodeData
     * 
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance 
     * 
     * @return object graph
     */
    public function __construct($nodeId, $nodeData = array()) {
        $this->setId($nodeId);
        $this->setData($nodeData);
    }

}

