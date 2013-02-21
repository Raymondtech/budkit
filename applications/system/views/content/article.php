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
 */

namespace Application\System\Views\Content;
use \Application\System\Views;

/**
 * Article Sub View class
 *
 * @category  Application
 * @package   View
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Article extends Views\Content{
    
    /**
     * Article View constructor
     * @return void
     */
    public function __construct(){    
        //Construct the parent
        parent::__construct();  
        $this->output->setPageTitle("Articles");        
    }
    
    /**
     * The default article view display method
     * @return void
     */
    public function display(){  
        //parse Layout Demo;
        //$sidebar      = $this->output->layout( "index_sidebar" );
        $dashboard      = $this->output->layout( "dashboard" , "system" );
        $sidebar        = $this->output->layout( "sidebar" , "system"  );
 
        $this->output->addToPosition("side",   $sidebar);
        $this->output->addToPosition("body",    $dashboard);    
    }
    
    /**
     * Displays a form for creating new articles
     * @param boolean $fullscreen
     * @return void
     */
    public function createform( $fullscreen = false){
        
        //Page Title
        $this->output->setPageTitle("Articles | Create new Article");
                 
        //form
        $form  = $this->output->layout( "articles/form" );      
        //The default installation box;
        //$this->output->addToPosition("left",    $sidebar);
        if(!$fullscreen):
            $this->output->addToPosition("dashboard",   $form);
            return $this->display();
        else:
             $this->output->addToPosition("body",   $form);
        endif;
    }
    
    /**
     * Returns an instance of the article view class
     * @staticvar object $instance
     * @return object Article
     */
    public static function getInstance(){
        
        static $instance;       
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;
        $instance =  new self();

        return $instance;
    }
}


