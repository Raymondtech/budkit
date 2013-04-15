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
 * @category   Utilities
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/graph
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/graph
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Graph{
    /*
     * @var object 
     */

    static $instance;

    /**
     * A vertex (pl. vertices) or node is the fundamental unit of which a graph is formed.
     * An array object containing graph vertex set.
     * 
     * @var type 
     */
    protected static $nodeSet = array();

    /**
     * Undirected edge between two endpoints in vertice set of undirected graph
     * 
     * @var type 
     */
    protected static $edgeSet = array();

    /**
     * Directed edge between two endpoints in vertex set
     * 
     * @var type 
     */
    protected static $arcSet = array();

    /**
     * An array of sub graphs objects
     * 
     * @var type 
     */
    protected static $subgraphs = array();

    /**
     * Determines the shortest path between two nodes
     * d(u,v)
     * @param type $nodeA
     * @param type $nodeB
     */
    public function getDistance($nodeA, $nodeB) {
        
    }

    /**
     * The size of a graph is the number of its edges |E(G)| 
     * 
     * @return interger
     */
    public function getSize() {
        
    }

    /**
     * The order of a graph is the number of its nodes/vertices |V(G)|
     * 
     * @return interger
     */
    public function getOrder() {
        
    }
 
    /**
     * Adds a directed edge (arc) to two nodes in graph. 
     * If no arcUid is provided will add an undirected edge
     * 
     * @param type $nodeA
     * @param type $nodeB
     * @param type $arcUid
     */
    private function addArc(&$nodeA, &$nodeB, $arcUid = NULL) {
        
    }
   

    /**
     * Adds an edge between two node endpoints.
     * 
     * @param type $nodeA
     * @param type $nodeB
     */
    public function addEdge(&$nodeA, &$nodeB, $direction="", $data=array() ) {

        $edge = new Graph\Edge( $nodeA, $nodeB , $data ); //Will need to decide whether to use nodeAId-nodeBId as edgeId       
        $edge->setGraph( $this );
        $edgeId = $edge->getId();
 
        
        if (!isset($this->edgeSet[$edgeId]))
            $this->edgeSet[$edgeId] = &$edge;
        return true;
    }

    /**
     * Adds a node to the current graph
     * 
     * @param type $node
     */
    public function addNode(&$node) {
        //Nodes must be an instance graph Node;
        if (!$this->isNode($node)) {
            throw new \Platform\Exception("Node must be an instance of \Platform\Graph\Node", PLATFORM_ERROR);
        }
        $nodedId = $node->getId();
        if (!empty($nodedId) && !isset($this->nodeSet[$node->getId()])) {
            $this->nodeSet[$node->getId()] = &$node;
        }
        return $this;
    }

    /**
     * Checks if a node is a node object
     * 
     * @param type $node
     * @throws boolean
     */
    private function isNode(&$node) {
        //Nodes must be an instance graph Node;
        if (!is_a($node, "\Platform\Graph\Node")) {
            return false;
        }
        return true;
    }

    /**
     * Removes a node from the graph
     * 
     * @param type $nodeId
     */
    public function removeNode($nodeId) {
        if (isset($this->nodeSet[$nodeId]))
            unset($this->nodeSet[$nodeId]);
        return true;
    }

    /**
     * Removes an Edge from the graph. Use removeArc to remove directed edges
     * 
     * @param type $nodeA
     * @param type $nodeB
     */
    public function removeEdge(&$nodeA, &$nodeB) {

        if (!$this->isNode($nodeA)) {
            throw new \Platform\Exception("NodeA passed to removeEdge must be an instance of \Platform\Graph\Node", PLATFORM_ERROR);
        }
        if (!$this->isNode($nodeB)) {
            throw new \Platform\Exception("NodeB passed to removeEdge must be an instance of \Platform\Graph\Node", PLATFORM_ERROR);
        }

        $edgeId = NULL; //Will need to decide whether to use nodeAId-nodeBId as edgeId

        if (isset($this->edgeSet[$edgeId]))
            unset($this->edgeSet[$edgeId]);
        return true;
    }

    /**
     * Removes a directed Edge.
     * 
     * Note if uid is provided will delete any edge found.
     * 
     * @param type $nodeA
     * @param type $nodeB
     * @param type $arcUid
     */
    private function removeArc(&$nodeA, &$nodeB, $arcUid = NULL, $data = array()) {
        
    }

    /**
     * Checks if the current graph is a directed graph
     * 
     * @return boolean true if directed and false if not;
     */
    public function isDirected() {
        return true;
    }

    /**
     * Constructs a new graph. 
     * 
     * @param type $nodes
     * @param type $edges
     * @param type $directed
     * @param type $graphID
     */
    public function __construct($nodes = array(), $edges = array(), $directed = FALSE, $graphID = NULL) {
        //parent::__construct();
    }

    /**
     * Creates and adds a Node to the graph if none, already exists
     * 
     * @param type $nodeId
     * @param type $data
     */
    public function createNode($nodeId, $data = array()) {
        
        $node = new Graph\Node($nodeId, $data);
        $node->setGraph( $this );
        $this->addNode( $node );
        
    }

    /**
     * Returns and instantiated Instance of the graph class
     * 
     * NOTE: As of PHP5.3 it is vital that you include constructors in your class
     * especially if they are defined under a namespace. A method with the same
     * name as the class is no longer considered to be its constructor
     * 
     * @staticvar object $instance
     * @property-read object $instance To determine if class was previously instantiated
     * @property-write object $instance 
     * 
     * @return object graph
     */
    public static function getInstance($graphUID = NULL, $nodes = array(), $edges = array(), $directed = FALSE) {
        if (is_object(static::$instance[$graphUID]) && is_a(static::$instance[$graphUID], 'Graph'))
            return static::$instance[$graphUID];
        $graph = new self($nodes, $edges, $directed, $graphUID);
        if (!empty($graphUID)) {
            static::$instance[$graphUID] =& $graph;
        }
        return $graph;
    }

}

