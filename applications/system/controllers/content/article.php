<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * article.php
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
namespace Application\System\Controllers\Content;
use Application\System\Controllers as System;

/**
 * Article CRUD action controller for system content 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of articles.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Article extends System\Content {
    /**
     * The default fallback method. 
     * @return Article::read()
     */
    public function index() {
        return $this->read();
    }   
    /**
     * Displays the form required to creates a new article. 
     * @todo    Implement the create action method
     * @return  \Application\System\Views\Content\Article::createForm()
     */
    public function create() {     
         
        $view = $this->load->view('content\article');        
        //get passparams
        $params     = func_get_args();
        $fullscreen = false;
        
        //param1 = fullscreen 
        //param2 = autoplay
        if(isset($params) && is_array($params)){
            if(isset($params[0]) && strtolower($params[0])=="fullscreen"){
                $fullscreen = true;
            }
        }
        return $view->createForm( $fullscreen );  
    }  
    
        
        /**
     * Displays a gallery of content items. 
     * @return void
     */
    public function gallery() {
        
        $view       = $this->load->view('index');
        $gallery    = $this->output->layout("content/articles/gallery");

        $this->output->addToPosition("dashboard", $gallery);
        $this->output->setPageTitle( _t("Articles") );
        $view->display(); //sample call;   
        //$this->output->addToPosition("right", $right );
    }
    
    /**
     * Updates an existing article.
     * @todo    Implement the article update action method
     * @return  void
     */
    public function update() {}  
    /**
     * Edits an existing article.
     * @todo    Implement the article edit action method
     * @return  void
     */
    public function edit(){   
        echo "editing Applications";       
    }
    /**
     * Displays an article.
     * @todo    Implement the article read action method
     * @return  void
     */
    public function read() {
         $view = $this->load->view('content\article');
    }
    /**
     * Deletes an existing article.
     * @todo    Implement the article delete action method
     * @return  void
     */
    public function delete(){}   
    /**
     * Returns an instance of the article controller, only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Article}
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
