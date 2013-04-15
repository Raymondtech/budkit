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
final class Graph extends Entity {
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
    public function getDistance($nodeA, $nodeB){}
    
    /**
     * The size of a graph is the number of its edges |E(G)| 
     * 
     * @return interger
     */
    public function getSize(){}
    
    /**
     * The order of a graph is the number of its nodes/vertices |V(G)|
     * 
     * @return interger
     */
    public function getOrder(){}
    
    public function addNode(){}
    
    /**
     * Constructs a new graph. 
     * 
     * @param type $nodes
     * @param type $edges
     * @param type $directed
     * @param type $graphID
     */
    public function __construct($nodes = array() , $edges = array() , $directed = FALSE, $graphID = NULL){
        parent::__construct();
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
    public static function getInstance( $graphUID = NULL , $nodes = array() , $edges = array() , $directed = FALSE ) {
        if (is_object(static::$instance[$graphUID]) && is_a(static::$instance[$graphUID], 'Graph'))
            return static::$instance[$graphUID];
            $graph =  new self( $nodes, $edges, $directed, $graphUID );
            if(!empty($graphUID)){
                static::$instance[$graphUID] = $graph;
            }
        return $graph;
    }
}

