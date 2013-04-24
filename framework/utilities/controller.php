<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * controller.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/controller
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
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/controller
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
abstract class Controller extends Library\Action {

    //use Library\Singleton;
    
    static $instance;
    /**
     * Stores the application/module currently being executed
     * @var string
     */
    private $application;

    /**
     * The controller defined in the route mapp
     * @var string
     */
    protected $controller;

    /**
     * The method (task/action) to be executed by the dispatcher
     * @var string
     */
    protected $method;

    /**
     * Determines whether the output has been displayed or not
     * 
     * @var boolean 
     */
    static $displayed = false;

    /**
     * Sets for redirect
     * 
     * @var string 
     */
    public $redirect = NULL;
    
    /*
     * The Privacy trait.
     */
    use Authorize\Privacy;

    /**
     * Constructor for the application controller
     * Must be called from child controller, getInstance
     * 
     * @void
     */
    public function __construct() {
        
        $classes = array(
            'config' => 'Library\Config',
            'input' => 'Library\Input',
            'uri' => 'Library\Uri',
            'lang' => 'Library\i18n',
            'router' => 'Library\Router',
            'load' => '\Platform\Loader',
            'user'  => '\Platform\User',
            'validate' => 'Library\Validate',
            'output' => 'Library\Output'
    
        );
        
        foreach ($classes as $var => $class) {
            $this->$var = $class::getInstance();
        }
        //Not elegant, but just forcing the input class
        //to pull request vars from router;
        $this->input->getRequestVars();
        //$output = Library\Output::getInstance();
        //testing: throw new Exception("We could not deal with the heat" );

        $this->application = $this->router->getApplication();
        $this->controller = $this->router->getController();
        $this->method = $this->router->getMethod();
        $this->authority = $this->getAuthority();
        $this->authhandler = "dbauth";
        
        
        if($this->user->isAuthenticated()){
            //Load the user profile
            $this->profile     = $this->load->model("profile", "member");
            $this->profile     = $this->profile->loadObjectByURI( $this->user->get("user_name_id"), array_keys($this->profile->getPropertyModel()));       
            //@TODO remove the user password from $this->profile;
            $profile           = $this->profile->getPropertyData();
            
            $this->user->set("user_photo", $profile['user_photo']);
            
            unset($profile['user_password']);
            $this->set("profile", $profile );
        }
        
        //@TODO remove the user password from $this->user;
        $this->output->set("user", $this->user );
        
        $installed      =  $this->config->getParam("installed", false ,"database");
        $application    =  $this->application;
        $controller     =  $this->controller;
        
        //Set the upload progress name
        $up = \Library\Session::getUploadProgressName();
        $this->output->set("uploadprogress", $up);
        
        //We might have not yet installed
        if(!$installed && (strtolower($application)!== "setup" ) ){
            $this->redirect("/setup/install/step1");
        }elseif( $installed && (strtolower($application)== "setup" && strtolower($controller)== "install")){
            throw new \Platform\Exception(_t("The system is already installed, you cannot perform any more install actions. Did you want to upgrade instead? try /setup/update/"));
        }
    }

    /**
     * Returns the name of  method/task
     * 
     * @return string
     * 
     */
    final public function getMethod() {
        return $this->method;
    }
    
    /**
     * Returns the request back to referer;
     * 
     * @return boolean (changes state?)
     */
    final public function returnRequest(){
                
        return $this->redirect( \Library\Session::get("lastRequestURL") );
        //return true;
    }

    /**
     * Gets the name of the action controller
     * @return string
     * 
     */
    final public function getController() {
        return $this->controller;
    }
    
    /**
     * Checks authenticated status of $this->user;
     * 
     * @return type 
     */
    final public function requireAuthentication(){
        
        //1. Check the user is authenticated,
        //2. If the user is not authenticated, redirect them to authenticate,
        if(!$this->user->isAuthenticated()){
            $this->alert( _t("You need to be logged in to complete this task"), _t("Authentication required"), "info" );
            
            //@TODO user $this->login() for persistent data;
            //Is there a means to redirect back from the login form once authentiation is complete?
            //I.E just authenticate the user and return back to the task at hand
            return $this->redirect("/member/session/start");
        }
        //3. Once authenticated redirect back to the requested url with the data send
    }

    /**
     * 
     */
    final public function getApplication() {
        return $this->application;
    }

    /**
     * Displays messages on output
     * 
     * @param string $message
     * @param string $title
     * @param string $type | information, error, success, attention, note etc.
     */
    final public function alert($message, $title='', $type='info') {

        //Set the message variables;
        $this->set("alerts", array( array("alertType"=>$type, "alertBody"=>$message,"alertTitle"=>$title )  ));
        
        return $this;
    }

    /**
     * Returns the arguments defined in the URL
     * 
     * @return array 
     */
    final public function getRequestArgs() {
        return $this->router->getParameter("arguments", array());
    }

    /**
     * Sets a output property for later use.
     * 
     * @param string $name
     * @param mixed $value 
     */
    final public function set($name, $value=NULL, $overwrite=FALSE) {
        //Determine all other auto set vars; 
        $this->output->set($name, $value);
    }
    
    /**
     * Determines the current user authority
     * 
     * 
     */
    final public function getAuthority() {

        //Authorizes the application;
        if (!\Library\Session::getInstance()->isAuthenticated()) {
            $action = $this->router->getMethod();
            $task = $this->router->getController();

            if (strtolower($action) <> "start" || strtolower($task) <> "session") {
                //$this->alert("You must be logged in to proceed", "Login Required", "attention");
                //$this->setRedirect("/user/session/start");
            }
        }
    }

    /**
     * Redirects only after the action is completely executed
     * 
     * @param type $url 
     */
    final public function setredirect($url='') {

        //@TODO: resolve this URL
        $this->redirect = trim($url);
    }

    /**
     * Stops executing the action and redirects 
     * 
     * @param type $url 
     */
    final public function redirect($url = '', $code=302, $message='') {

        //$this->setredirect($url)
        static::$displayed = true; //Just so it does not send any furthre output before redirect
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->redirect($url, $code, $message);
    }

    /**
     * The login action
     * 
     */
    final public function login() {
        
        static::actionStateAs("view"); 
        $lastURL    =  \Library\Session::get("lastRequestURL");    
        $this->set("lasturl", $lastURL);
        //@TODO Kill any logged in session
        //@TODO If already logged in, redirect to homepage or somewhere else;
        //$this->redirect( '/index.php' );
        //login and authorize
        if ($this->input->methodIs("post")) {

            static::actionStateAs("execute");
            
            //1. Check that we have a valid username and password
            $credentials = array();

            $credentials['usernameid'] = $this->input->getString('user_name_id','','post');
            $credentials['usernamepass'] = $this->input->getString('user_password','','post');


            //authentication;
            $authhandler = $this->input->getString('auth_handler');
            $authenticate = "Library\Authenticate\\" . $authhandler;
           
            //failure
            $failure = _t("The password or username you provided did not match any user");

            $authhandler = (empty($authhandler)) ? "dbauth" : $authhandler;
            $authenticate = (!class_exists($authenticate) || !method_exists($authenticate, "attest")) ? 'Library\Authenticate\DbAuth' : $authenticate;

            //If we have the handler
            if (class_exists($authenticate)) {
                if (method_exists($authenticate, "attest")) {

                    //2. Verify the username and the password
                    $authenticate = $authenticate::getInstance();

                    if ($authenticate->attest($credentials)) {
                        //get the user data
                        $this->user = User::getInstance();
                       
                        $this->alert( _t('Welcome back ') , sprintf(_t('Howdy %s,'), $this->user->user_full_name), "success");
                        
                        
                        $this->redirect( $this->output->link( "/system/media/timeline") );
                        
                    } else {
                        //if not show the form...with messages maybe?;
                        $this->alert($failure, _t("We were unable to log you in"), "error");
                    }
                }
            }
        }

        $view = $this->load->view("authenticate", "system");

        $view->userLoginForm();

        //$this->abort();
    }

    final public function logout() {
        
        $session = \Library\Session::getInstance();
        $session->destroy();
        
        $return = $this->uri->getURL('signin');
        
        //echo $return;
        
        //Send back to homepage
        $this->alert(_t("You have been logged out"), "", "info");
        //$this->redirect("/");
        $this->redirect($this->uri->getURL('signin'));
    }

    final public function render($layout = null) {
        
        static::$displayed = false;
        
        if(static::$displayed) return false;
        
        $this->output->display();
        //return self::__destruct();

        static::$displayed = true;
    }

    /**
     * This is the default method for undispatchable action=>tasks
     * Iterim search for the possibility that the path is virtual 
     * 
     * @return redirect to start page
     * 
     */
    public function index() {

        //@TODO Check Vanity URLS like
        //http://domain.com/tangstone
        //Redirect=> http://domain.com/profile/tangstone...
        //@TODO check if the URL is a command!
        //@TODO Check that the user is logged in!


        $this->redirect($this->uri->getURL('index'));
    }

    /**
     * Displays the output for the request;
     * 
     * @return  
     */
    final public function __destruct() {
        
        //Determine Variables that have not been set
        //Set
        if (!static::$displayed) {
            return $this->render();
        }
    }

}

