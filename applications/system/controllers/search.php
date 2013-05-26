<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * search.php
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

namespace Application\System\Controllers;

/**
 * Search Controller
 *
 * This class implements the action controller that governs complete content search
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
class Search extends \Platform\Controller {

    /**
     * The default fallback method. 
     * @return void
     */
    public function index() {
        return $this->graph();
    }

    /**
     * Executes the search command
     * @todo Implement the search action
     * @return void
     */
    final public function user() {

        //get search params;
        $params = func_get_args();
        $view = $this->load->view('index');
        $this->output->setPageTitle(_("Search"));

        $this->output->addToPosition("dashboard", "searching for stuff");
        $this->load->view("index")->display();
        //$this->output();
    }

    /**
     * Searches the entire Networks. 
     * 
     * Uses onSearchGraph event trigger, with an array of results to populate;
     * 
     * @return void
     */
    final public function graph() {

        $query = $this->input->getVar("query", "");
        $results = array();
        
        //RULES
        //1. All results sections should be included in an array &$results = array( array("title"=>"People","results"=>array(your, results, here,)), array(), ... );
        //2. Only add an array to &$results if you actually have results, so check if empty before &$results[] = array("title"=>"People","results"=>array(your, results, here,) )
        //3. Every result item arrays must have at least a title, thumbnail, link, and description key! so array("title"=>"Some Result","link"=>"/link/to/result","icon"=>/link/to/icon/)
        \Library\Event::trigger("onSearch", $query, $results);

        $title = sprintf( _("Results matching '%s'"), $query );
        //Return json results;
        if (!empty($query) && empty($results)):
            $this->alert(sprintf(_("Your search for '%s' did not return any results"), $query) );
        endif;
        
        $this->set('query', $query);
        if(!empty($results)) $this->set('result', array("title"=>$title, "objects"=>$results));
        
        $search = $this->output->layout("results");
        
        $this->output->setPageTitle( $title );
        $this->output->addToPosition("dashboard", $search);
        
        $this->load->view("index")->display();
        
    }

    /**
     * Gets an instance of the search class
     * @staticvar self $instance
     * @return self 
     */
    public static function getInstance() {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;

        $instance = new self;
        return $instance;
    }

}

