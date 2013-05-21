<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * loader.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/loader
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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/loader
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Loader{
    
    /*
     * 
     */
    static $objects = array();
    
    /**
     * 
     */
    const  GLOBAL_NAMESPACE = "";

    /**
     *
     * @var type 
     */
    protected $application;

    /**
     *
     * @var type 
     */
    protected $path;

    /**
     *
     * @var type 
     */
    protected $namespace;

    /**
     *
     * @param type $namespace
     * @param type $path 
     */
    public function __construct($namespace, $path ){

        $this->namespace = ltrim($namespace, "\\");
        $this->path = $path;
        
    }

    /**
     *
     * @param type $model
     * @return type 
     */
    public function model( $model , $app='' , $new = false ){
        
        //Get the Router to determine what application we are in;
        $Router     = Library\Router::getInstance();

        //Set the Application
        $this->application = $Router->getApplication();
        
        //2nd Search ini the application specific layout folder;
        $application = (!empty($app))? $app : $this->application ;

        //Specifics
        $class      = "Application\\".$application."\models\\".$model ;
        $file       = "";
        
        //If we want a new class then
        if($new){ 
            return new $class();
        }
 
        
        $model = $class::getInstance();

       return $model;
    }

    /**
     * Get table
     * 
     * @param type $table
     * @param type $primayId
     * @return type 
     */
    public function table( $table , $primayId = NULL ){
        
        $dbparams = Library\Config::getParamSection("database");
        
        $options = array(
            "driver" => preg_replace('/[^A-Z0-9_\.-]/i', '', $dbparams['driver']),
            "dbo"    => Library\Database::getInstance(),
            "table"  => $table
        ); 
        
        $table   = Library\Database\Table::getInstance( $options );
        
        return $table;
        
    }

    /**
     * Loads a controller. 
     * 
     * @param type $controller
     * @param type $app
     * @param type $vars
     * @param type $return
     * @param type $namespace
     * @return type
     * @todo Needs some reworking
     * 
     */
    public function controller( $controller , $app='', $vars = array(), $return = FALSE , $namespace = ""){
       
       //Get the Router to determine what application we are in;
        $Router     = Library\Router::getInstance();
        //Set the Application
        $this->application = $Router->getApplication();
        //2nd Search in the application specific folder;
        $application = (!empty($app))?$app : $this->application ;
        //Specifics
        $class          = "Application\\".$application."\Controllers\\".$controller ;
       
        $controller     = $class::getInstance( $vars );
       
       return $controller;
    }

    /**
     * Loads the view from within an application!
     * 
     * @param string $view
     * @param array $vars
     * @param boolean $return
     * @param string $namespace
     * @return object Page
     */
    public function view( $view, $app='', $vars = array(), $return = FALSE , $namespace = ""){

        //Get the Router to determine what application we are in;
        $Router     = Library\Router::getInstance();

        //Set the Application
        $this->application = $Router->getApplication();
        
        //2nd Search ini the application specific layout folder;
        $application = (!empty($app))?$app : $this->application ;

        //Specifics
        $class          = "Application\\".$application."\Views\\".$view ;
        $file           = "";
        
        //Gets an instance of the output classs
        $output         = Library\Output::getInstance();
        $view           = $class::getInstance( $vars );
        
        //Add a few properties, bad way to do it but works!
        $view->output   = $output ;
        $view->load     = $this; 


       return $view;

    }
    
    /**
     * Gets a layout
     * 
     * @param type $layout
     * @param type $app
     * @param type $return if false returns the url
     */
    public function layout($layout,  $app='', $ext='.tpl', $include= FALSE, $directory = null){
        
                
        //Set the Application
        $this->application = Library\Router::getInstance()->getApplication();
        
        //1st Search in the default layout folder?
            //This is the current templates layout folder;
        $output     = Library\Output::getInstance();
        
        //2nd Search ini the application specific layout folder;
        
        $layout = str_replace(array('/','\\'), DS , $layout); 
        $application = (!empty($app))?$app : $this->application ;       
        
        $_layouts    = array( 
            FSPATH . 'public' . DS . $output->template .DS.'layouts'.DS.$layout.$ext,
            FSPATH . 'public' . DS . $output->template .DS.'layouts'.DS.$application.DS.$layout.$ext,
            FSPATH."applications".DS.$application.DS."layouts".DS.$layout.$ext,
            VENDORPATH."applications".DS.$application.DS."layouts".DS.$layout.$ext  
        );
       
        if(!empty($directory)){
            array_unshift($_layouts, $directory.DS.$layout.$ext ); //If a directory is specified, first check in that directory
        }
        
        //die;
        //@TODO the ability to add more search paths;
        $path = null;
        
        foreach($_layouts as $i=>$_path){
            //Debugger::log( $_path );
           if(file_exists($_path)){         
               $path  = $_path;
               break;
           } 
        }
        
        //include once the file if include, else return the resource link;
        if($include){
            include_once $path;
        }
        
        return $path;
    }

    /**
     *
     * @param type $library
     * @return type 
     */
    public function library( $library , $app =''){

        //Get the Router to determine what application we are in;
        $Router     = Library\Router::getInstance();

        //Set the Application
        $this->application = $Router->getApplication();

        //2nd Search ini the application specific layout folder;
        $application = (!empty($app))? $app : $this->application ;
        
        //Specifics
        $class      = "Application\\".$application."\libraries\\".$library ;
        $file       = "";
        
        $view = $class::getInstance();

        return $view;
       
    }

    /**
     *
     * @param type $helper
     * @return type 
     */
    public function helper( $helper , $app=''){

        //Get the Router to determine what application we are in;
        $Router     = Library\Router::getInstance();

        //Set the Application
        $this->application = $Router->getApplication();
        
        //2nd Search ini the application specific layout folder;
        $application = (!empty($app))? $app : $this->application ;

        //Specifics
        $class      = "Application\\".$application."\helpers\\".$helper ;
        $file       = "";
        
        $view       = $class::getInstance();
     

        return $view;
        
    }

    /**
     * 
     */
    public function setApplication(){}

    /**
     * 
     */
    public function addSearchPath(){}

    /**
     *
     * @static var Loader $instance
     * @param type $namespace
     * @param type $dir
     * @return Loader 
     */
    public static function getInstance( $namespace='', $dir=''){

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance) ) return $instance ;

        $instance = new Loader($namespace, $dir);

        return $instance; 
    
    }

    /**
     * 
     * @param type $class 
     */
    public function __invoke( $class ){

        $class = strtr(ltrim($class, "\\"), "\\", DS);

        if ($this->namespace === "" || strpos($class, $this->namespace) === 0) {
            if ($this->namespace !== self::GLOBAL_NAMESPACE) {
                $class = substr($class, strlen($this->namespace) + strlen(DS));
            }
            if(is_array( $this->path ) ) :
                //To allow overides by vendors, we reverse the array
                $paths = array_reverse( $this->path );
                
                //First to find
                foreach($paths as $path ):
                    $file = strtolower( $path . DS . $class . EXT );
                    if (is_readable($file)) {
                        require_once( $file );
                        break;
                    }
                    
                endforeach;
            else:
                $file = strtolower( $this->path . DS . $class . EXT );
                if (is_readable($file)) {
                    require_once( $file );
                }
            endif;
        }
    }
}