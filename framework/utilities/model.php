<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * model.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/model
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform;

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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/model
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
abstract class Model extends \Library\Object {

    /**
     * Data access objects
     * 
     * @var type 
     */
    protected $dao;

    /**
     * The current state or possition in the system
     * @var static $state 
     */
    protected $states = array();

    /**
     * The current total in a navigable record set
     * @var static total
     */
    protected $total = 0;

    /**
     * The current state of the pages menu
     * @var static pagination
     */
    protected $pagination;

    /**
     * Class constructor,
     * Instantiates helper classes
     * 
     * return void
     */
    public function __construct() {

        $classes = array(
            'config' => 'Library\Config',
            'input' => 'Library\Input',
            'load' => 'Platform\Loader',
            'user' => 'Platform\User',
            'validate' => 'Library\Validate',
            'output' => 'Library\Output',
            'database' => 'Library\Database',
            'registry' => 'Platform\Registry'
        );

        foreach ($classes as $var => $class) {
            $this->$var = $class::getInstance();
        }
        //Initialize request variables;
        $this->input->getRequestVars();
        //Check for states limit and limitoffset in URL;

        $currentpage = $this->input->getVar("page","",1);
        $this->setState("currentpage", (int) $currentpage);
    }

    /**
     * Sets the model table
     * 
     * @param type $table 
     */
    final public function setTable($table) {
        
    }

    /**
     * Gets table representation
     */
    final public function getTable() {
        
    }

    /**
     * Sets an output
     * 
     * @param type $name
     * @param type $value 
     */
    final public function set($name, $value) {

        //Determine all other auto set vars; 
        $this->output->set($name, $value);
    }

    final public function get($name, $default = '', $format = '') {
        //Determine all other auto set vars;
        return $this->output->get($name, $default = '', $format = '');
    }

    /**
     * The default method for each controller
     * 
     * @return void
     */
    abstract public function display();

    /**
     * Instantiate the child controller
     * 
     * @return object
     */
    abstract public static function getInstance();

    /**
     * Returns a data model state
     * 
     * @param type $state
     */
    public function getState($state, $default = NULL) {
        $state = isset($this->states[$state]) ? $this->states[$state] : $default;
        return $state;
    }

    /**
     * Sets a data model state
     * 
     * @param type $state
     * @param type $value
     */
    public function setState($state, $value = NULL) {

        //@todo why do we need previous state?
        $previous = isset($this->states[$state]) ? $this->states[$state] : null;
        $this->states[$state] = $value;

        return $this;
    }

    /**
     * Sets lists limit for page'd lists
     * 
     * @param type $limit
     * @return \Platform\Entity
     */
    public function setListLimit($limit = NULL) {
        $this->setState("limit", intval($limit));
        return $this;
    }

    /**
     * Get list start for page'd lists
     * 
     * @param type $start
     * @return \Platform\Entity
     */
    public function getListOffset($page = 1, $default = 0) {
        $limit  = $this->getListLimit();
        $offset = $this->getState("limitoffset", intval($default));
        $offset = empty($offset) ? (empty($page)||(int)$page <= 1) ? intval($default) : intval($page-1) * $limit: $offset;
       
        return $offset;
    }

    /**
     * Gets lists limit for page'd lists
     * 
     * @param type $limit
     * @return \Platform\Entity
     */
    public function getListLimit($default = 0) {
        $limit =  $this->getState("limit", intval($default));
        $limit = empty($limit) ? $this->config->getParam("list-length", NULL, "content") : $limit;
        return $limit;
    }

    /**
     * Set list start for page'd lists
     * 
     * @param type $start
     * @return \Platform\Model
     */
    public function setListOffset($start = 0) {
        $this->setState("limitoffset", intval($start));
        return $this;
    }

    /**
     * Sets the list total 
     * 
     * @param type $total
     * @return \Platform\Model
     */
    public function setListTotal($total) {
        $this->total = $total;
        return $this;
    }

    /**
     * Returns the list total;
     * 
     * @return type
     */
    public function getListTotal() {
        return $this->total;
    }

    /**
     * Returns a limit clause based on datamodel limit and limitoffset states
     * 
     * @return type
     */
    public function getLimitClause($limit = 0) {
        
        $query = NULL;
        $page  = $this->getState("currentpage", 0);
        $limit = empty($limit) ? (int) $this->getListLimit() : $limit;
        $offset = $this->getListOffset($page, 0);

        if (!empty($limit)):
            $this->setListLimit($limit);
            $this->setListLimit($offset);
            $query = "\nLIMIT {$offset}, {$limit}\t";
        endif;
        
        //Return limit query
        return $query;
    }

    /**
     * Sets the pagination for the current output if any
     * 
     * @return type 
     */
    public function setPagination() {

        $total = $this->getListTotal();

        if (empty($total))
            return null;

        //Get the current page state from the request;
        $limit = $this->getListLimit();
        $current = $this->getState("currentpage", 1);
        $pages = array();

        //@TODO: Calculates the pages from a recordset or an array of results
        $pages['total'] = ceil($total / $limit);
        $pages['limit'] = $limit;

        //Get the real path to the current page
        $path = Library\Router::getInstance()->getRealPath();
        $pages['current'] = Library\Uri::internal($path."/page:".strval($current) );
        //Previous page link
        if(intval($current-1) > 0 ):
            $pages['previous'] = Library\Uri::internal($path."/page:".strval($current-1) );
        endif;
        //Next page link
        if(intval($current+1) <= $pages['total'] ):
            $pages['next'] = Library\Uri::internal($path."/page:".strval($current+1) );
        endif;

        //Build the pages;
        for ($i = 0; $i < $pages['total']; $i++):
            $page = $i + 1;
            $pages['pages'][] = array(
                "title" => $page,
                "link" => \Library\Uri::internal($path . "/page:" . $page),
                "state"=> ($page == $current)? "active":null,
            );
        endfor;


        //Sets the pagination output;
        $this->output->set("pagination", $pages);
    }

    /**
     * Displays the output for the request;
     * 
     * @return  
     */
    final public function __destruct() {
        
    }

}

