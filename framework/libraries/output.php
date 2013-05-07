<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * output.php
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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/output
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 *
 */

namespace Library;

use Library\Output;
use Library\Output\Format;

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
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/output
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Output extends Object {

    /**
     * A list of positions in the main theme
     *
     * @var array
     */
    protected static $positions = array();

    /**
     *
     * @var type
     */
    protected $isError = FALSE;

    /**
     * Defines the layout to be used
     * @var string
     */
    protected $layout = 'index';

    /**
     * Defines the layout to be used
     * @var string
     */
    protected $layoutExt = EXT;

    /**
     * A message to be displayed on the page
     *
     * @var string
     */
    protected $message;

    /**
     * Additional page variables
     *
     * @var array
     */
    protected $variables = array(
        "pageid" => "_page",
        "page" => array(
            "activesidebar" => false
        )
    );
    static $instance;

    /**
     * Contains a list of references to scripts
     * to include on this page
     *
     * @var array
     */
    protected $scripts = array();
    
        
    /**
     * Contains a list of page meta
     *
     * @var array
     */
    protected $meta = array();

    /**
     * An array of Stylesheet references to be included on page
     *
     * @var array
     */
    protected $styles = array();

    /**
     * Reference to the configuration object
     *
     * @var object Library\Config
     */
    protected $config;

    /**
     * The response code.
     *
     * @var interger;
     */
    protected $code = 200;
    protected $format;
    protected static $prints;
    public $headers = array();
    public $menugroups = array();

    /**
     * Construcst the output object
     *
     * @return void
     */
    final public function __construct() {


        $this->variables = array();
        $this->config = Config::getInstance();
        $this->router = Router::getInstance();
        $this->template = $this->config->getParam('template', 'default', 'design');
        $this->theme = $this->config->getParam('theme', 'default', 'appearance');

        //$this->pageTitle = $this->config->getParam('');
        //$this->user     = \Platform\User::getInstance(); //Cannot use this here, because the output class is loaded way before auth and session
        //The Router defined format;
        $this->format = $this->router->getFormat();
    }

    /**
     * Returns all the protected output variables
     * @return array;
     */
    final public function getVariables() {
        return $this->variables;
    }

    /**
     * Returns all the protected output variables
     * @return array;
     */
    final public function getHeaders() {
        return $this->headers;
    }

    /**
     * Recalls all messages sent to client before redirect
     * These are stored in the session
     *
     * @return void
     */
    final public function recallAlerts() {
        //check for session Alerts;
        $this->session = Session::getInstance();

        //Are there any left over alerts?
        $oldAlerts = $this->session->get("alerts");

        //Restore alerts
        if (!empty($oldAlerts)) {
            //$newAlerts = is_array($this->get("alerts")) ? $this->get("alerts") : array();
            //$alerts = array_merge($oldAlerts, $newAlerts);
            //The set method will merge automatically
            $this->set("alerts", $oldAlerts);
            //echo $this->session->getId();
            //Remove all the old alerts
            $this->session->remove("alerts");
            //$this->session->update( $this->session->getId() );
        }
    }

    /**
     * Sets the output format, overwrites format set in router?
     *
     * @param type $format
     * @return void
     */
    final public function setFormat($format, $headers = array()) {

        $this->router->setFormat($format);
        $this->headers = $headers;
        $this->format = $this->router->getFormat();
    }

    /**
     * Starts the output buffer
     * @handler the ob handler callback; NOTE, use null rather than "" for no handler
     * @return void
     */
    final public static function startBuffer($handler = "ob_gzhandler") {
        //2.output buffer start
        if (!ob_start($handler))
            ob_start();
    }

    final public static function stopBuffer() {
        ob_end_flush();
    }

    /**
     * Outputs an internalized resource link
     *
     * @param type $href
     * @return type
     */
    final public function link($url, $ssl = null) {

        $Uri = Uri::getInstance();
        $Router = Router::getInstance();

        return $Uri::_($url);
    }

    /**
     * Displays the error page
     *
     * @param type $format
     * @param type $status
     * @return void
     */
    final public function displayError($format = 'xhtml', $status = 404) {

        //anything that had previously been printed
        $printed = ob_get_contents();
        $this->addToPosition("body", $printed, '', true);

        //Anything that was previously displayed in scripts, is discarded
        //from the buffer, and will be displayed on the body of the page
        ob_end_clean();

        //We now start a new buffer, to deal with the template!
        $this->startBuffer();
        //$this->toConsole();

        static::$prints = $this->restartBuffer();

        $this->layout = "splash";
        $this->display($format, $status, "splash");

        //Stop any further execution?
        $this->abort();
    }

    /**
     * Outputs a menu  item to the output buffer 
     * 
     * @param type $menuid
     * @param type $menutype 
     */
    final public function navigation($menuId = "", $menuType = "nav-block") {

        $menuItems = \Platform\Navigator::menu($menuId);

        if (empty($menuItems))
            return null;

        //print_R($menuItems);
        $tag = array();

        $tag['ELEMENT'] = 'ul';
        $tag['CLASS'] = "nav $menuType";
        $tag['CHILDREN'] = Output\Parse\Template\Menu::element((array) $menuItems, $menuType);

        //Get the parser;
        $parser = Folder\Files\Xml\Parser::getInstance();
        $parsed = $parser->toXml($tag);

        return $parsed;
    }

    /**
     * Restarts the output buffer
     * @handler the ob handler callback; NOTE, use null rather than "" for no handler
     * @return type
     */
    final public function restartBuffer($handler = "ob_gzhandler") {
        //anything that had previously been printed
        $printed = ob_get_contents();

        //Anything that was previously displayed in scripts, is discarded
        //from the buffer, and will be displayed on the body of the page
        ob_end_clean();

        //We now start a new buffer, to deal with the template!
        $this->startBuffer($handler);

        return $printed;
    }

    final protected function getHandler($format = 'xhtml') {
        //$this->addToPosition("do:debugger", $console, '', true);
        //1. Work on the headers, make sure everything is beautiful
        // seconds, minutes, hours, days
        //The requested Response format
        $this->format = $this->router->getFormat(); //Because the output class is loaded before the router, use this to check if the format has changed after routing

        $outputFormat = $this->format;
        $responseFormat = !empty($outputFormat) ? $outputFormat : $format;

        //Test the format
        if (!empty($responseFormat)) {

            //If the format is set in the URI, that will be the output format;
            //If no format is set in the URI, then we can use that passed to the display method
            $mimeType = !empty($responseFormat) ? $responseFormat : $format;
            $validTypes = array(
                "json", "xml", "raw", "pdf", "xhtml"
            );
            $mimeType = strtolower($mimeType);

            if (in_array($mimeType, $validTypes)) {

                //Check if the Rendere exists;
                $renderer = '\Library\Output\Format\\' . ucfirst($mimeType);

                if (!class_exists($renderer)) {
                    return false;
                }

                $Document = $renderer::getInstance();

                return $Document;
            }
        }
    }

    /**
     * Returns the processed output and displays to the browser
     * Final method cannot and should not be overidden
     *
     * @param string $format
     * @return void
     *
     */
    final public function display($format = 'xhtml', $httpcode = null, $template = '') {

        //anything that had previously been printed
        $printed = ob_get_contents();
        $httpcode = empty($httpcode) ? $this->getResponseCode() : $httpcode;

        if (!empty($printed)):
            $this->addToPosition("body", $printed, '', true);
        endif;

        //Anything that was previously displayed in scripts, is discarded
        //from the buffer, and will be displayed on the body of the page
        ob_end_clean();

        //We now start a new buffer, to deal with the template!
        $this->startBuffer();
        //$this->toConsole();


        static::$prints = $this->restartBuffer();

        //Format alerts
        //get the output;
        $alerts = $this->layout("alert", "system");

        //add the message
        $this->addToPosition("alerts", $alerts);

        //$this->addToPosition("do:debugger", $console, '', true);
        //1. Work on the headers, make sure everything is beautiful
        // seconds, minutes, hours, days
        //The requested Response format
        $Document = $this->getHandler();

        return $Document->render($template, $httpcode, $this->getHeaders());
    }

    /**
     * Serializes data input
     *
     * @param type $data
     * @return type
     */
    final public static function serialize($data) {
        return base64_encode(gzcompress(serialize($data)));
    }

    /**
     * Unserializes are previously serialized input
     *
     * @param type $string
     * @return type
     */
    final public static function unserialize($string) {

        return Input::unserialize($string);
    }

    /**
     * 
     * @param type $length
     * @return string
     */
    final public static function getRandomString($length = 10) {
        return \Platform\Framework::getRandomString($length);
    }

    /**
     * Sets a cookie param
     *
     * @param type $name
     * @param type $cookie
     * @param type $expire
     * @param type $path
     * @param type $domain
     * @return Output
     */
    final public function setCookie($name, $cookie, $expire = 86400, $path = '', $domain = '') {

        $encryptor = Encrypt::getInstance();

        if (empty($name))
            return false;

        //@TODO, encrypt this cookie b;
        setcookie($name, $cookie, $expire, $path, $domain, false);

        return $this;
    }

    /**
     * Parses a layout and sets the variable ass
     *
     * @param type $layout
     * @param type $variables
     * @param type $set
     * @param type $setas
     */
    public function layout($layout, $app = '', $ext = '.tpl', $variables = array(), $set = false, $setas = '') {

        $load = \Platform\Loader::getInstance();

        //Layout
        $file = $load->layout($layout, $app, $ext, FALSE);

        //get the layout to parse;
        ob_start();

        //include the layout;
        if (file_exists($file)) {
            include $file;
        }
        $_parsed = ob_get_contents();
        //Close Buffer!
        ob_end_clean();

        if ($set && !empty($setas)) {
            //Set the parsed layout as a variable
            $this->set($setas, $_parsed);
        }

        //Format Parsed!
        $handler = $this->getHandler();
        $parsed = $handler->parse($_parsed, $handler);

        //\Platform\Debugger::log( htmlentities($layout ) );

        return $parsed;
    }

    /**
     * Sets a reference to the layout object being used
     *
     * @param string $layout
     */
    final public function setLayout($layout) {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Alias method to return the string name of the current template
     *
     * @return string
     */
    final public function getTemplateName() {

        return $this->getTemplate();
    }

    /**
     * Returns the current template path;
     * 
     * @return string; 
     */
    final public function getTemplatePath() {

        $name = $this->getTemplateName();
        $path = $this->config->getParam("path", "/");

        return $path . $name;
    }

    /**
     * Adds a header type to the output
     *
     * @param type $name
     * @param type $value
     */
    final public function setHeader($name, $value) {
        @header("{$name}: {$value}");
        return $this;
    }

    /**
     * Removes a previously sent header type to the output
     *
     * @param type $name
     * @param type $value
     */
    final public function unsetHeader($name) {
        @header_remove($name);
        return $this;
    }

    /**
     * Set Header
     *
     * Sets the page header, depending on the requested format
     *
     * @return void
     */
    final public function headers($mimeType = 'text/html', $charset = 'utf-8') {
        
    }

    /**
     * Adds a reference to a script resource to include on the
     * page
     *
     * @param string $file
     */
    final public function addScript($src, $type = "text/javaScript", $defer=NULL, $charset=NULL, $async=NULL) {

        $script = array(
            "src" => Uri::internal($src),
            "type" => $type
        );
        if (!empty($defer))
            $script['defer'] = $defer;
        if (!empty($charset))
            $script['charset'] = $charset;
        if (!empty($async))
            $script['async'] = $async;
        
        $this->scripts[] = $script;

        return $this;
    }
    
    /**
     * Returns an array of dynamically added page scripts
     * @return type
     */
    final public function getScripts(){
        return $this->scripts;
    }
    
    /**
     * Returns an array of dynamically added page styles
     * @return type
     */
    final public function getStyles(){
        return $this->styles;
    }
    
    /**
     * Returns an arry of dymaically added page meta
     * @return type
     */
    final public function getMeta(){
        return $this->meta;
    }

    /**
     * Adds a reference to a stylesheet resource to include on the page
     * 
     * @param string $href
     * @param string $rel
     * @param string $type
     * @param string $media
     * @param string $sizes
     * @param string $hreflang
     * @return \Library\Output
     */
    final public function addStyle($href, $rel = "stylesheet", $type = "text/css", $media = NULL, $sizes = NULL, $hreflang = NULL) {

        $style = array(
            "href" => Uri::internal($href),
            "rel" => $rel,
            "type" => $type
        );
        if (!empty($media))
            $style['media'] = $media;
        if (!empty($sizes))
            $style['sizes'] = $sizes;
        if (!empty($hreflang))
            $style['hreflang'] = $hreflang;
        
        $this->styles[] = $style;

        return $this;
    }

    /**
     * Add Meta
     *
     * @param string $name
     * @param string $content
     * @param string $charset
     * @param string $httpequiv
     * @return \Library\Output
     */
    final public function addMeta($name, $content="", $charset=NULL, $httpequiv=NULL) {
  
        $meta = array(
            "name" => $name,
            "content" => $content
        );
        
        if (!empty($charset))
            $meta['charset'] = $charset;
        if (!empty($httpequiv))
            $meta['http-equiv'] = $httpequiv;
        
        $this->meta[] = $meta;

        return $this;
    }


    /**
     * Add Message
     *
     * Displays a message of specific type on the page
     *
     * @param string $message
     * @param string $type
     */
    final public function addMessage($message, $title = '', $type = 'info') {

        //Set the message variables;
        $this->set("alerts", array(array("alertType" => $type, "alertBody" => $message, "alertTitle" => $title)));

        return $this;
    }

    /**
     * Add Variable
     *
     * Adds a page variable
     *
     * @param string $name
     * @param string $value
     * @param boolean $returnprevious
     * @return Output
     */
    final public function addVariable($name, $value, $returnprevious = false) {

        $this->$name = $value;

        $previous = isset($this->variables[$name]) ? $this->variables[$name] : null;
        $this->variables[$name] = $value;

        if ($returnprevious)
            return $previous;

        return $this;
    }

    /**
     * Adds a custom link to a menugroup. 
     * 
     * @param type $menuNameId
     * @param type $link
     */
    final public function addLinkToMenuGroup($menuNameId, $link = array()) {
        
    }

    /**
     * Returns all the defined menugroups
     * @return type
     */
    final public function getMenuGroups() {
        return $this->menugroups;
    }

    /**
     * Returns the menu group
     * 
     * @param type $groupName
     * @param type $default
     * @return type
     */
    final public function getMenuGroup($groupName, $default = array()) {
        //IF the group nae exists return it, else return default
        return isset($this->menugroups[$groupName]) ? $this->menugroups[$groupName] : $default;
    }

    /**
     * Add a menu to a block position
     * 
     * @param string $name the block name position 
     * @param type $menuNameId
     * @param type $menuItems
     */
    final public function addMenuGroupToPosition($blockName, $menuNameId, $menuType = "nav-list", $menuItems = array(), $overwrite = false) {

        //The menu layout
        //menuItems
        if (!empty($menuItems)):
            //Check if the param already exists
            $existing = $this->getMenuGroup($menuNameId, null);

            if (!empty($existing) && is_array($existing) && !$overwrite) {
                //Just fascilitates using namespaces
                $items = is_array($menuItems) ? array_merge($existing, $menuItems) : null;
                $group = array($menuNameId => $items);
            }
            $this->menugroups = array_merge($this->menugroups, $group);
        endif;

        //Add the menu name to the page menus
        $this->variables["page"]['block'][$blockName]["menus"][] = array("ELEMENT" => "ul", "ID" => $menuNameId, "TYPE" => $menuType);

        return $this;
    }

    /**
     * Returns the template folder name
     *
     * @return type
     */
    final public function getTemplate() {

        if (isset($this->template)) {
            return $this->template;
        }

        //
        return $this->template = $this->config->getParam('template', 'default', 'design');
    }

    /**
     * Sets the page MimeType
     *
     * @return object Output
     */
    final public function setMimeType($mime) {
        $this->mime = $mime;
        return $this;
    }

    /**
     * Sets the application response code
     *
     * @param type $code
     * @return Output
     */
    final public function setResponseCode($code = 200) {
        $this->code = is_null($code) ? 200 : $code;
        return $this;
    }

    /**
     * Sets the application response code
     *
     * @param type $code
     * @return Output
     */
    final public function getResponseCode($default = 200) {
        $code = is_null($this->code) ? $default : $this->code;
        return $code;
    }

    /**
     * Adds a page title
     *
     * @return string
     */
    final public function setPageTitle($title) {

        $this->pageTitle = trim($title);
        $this->set("page", array("title" => $this->pageTitle));

        return $this;
    }

    /**
     * Sets a final page element, see @method addVariable
     *
     * @param string $param
     * @param mixed $value
     *
     * @return object Output
     */
    final public function set($param, $value = null, $overwrite = false) {

        //Check if the param already exists
        $existing = $this->get($param, null);
        $variable = array($param => $value);

        if (!empty($existing) && is_array($existing) && !$overwrite) {
            //Just fascilitates using namespaces
            $value = is_array($value) ? array_merge($existing, $value) : null;
            $variable = array($param => $value);
        }
        $this->variables = array_merge($this->variables, $variable);

        return $this;
    }

    /**
     * Removes an output variable
     * 
     * @param type $param
     * @return boolean
     */
    final public function removeOutputVar($param) {
        $existing = $this->get($param, null);
        if (!empty($existing)) {
            unset($this->variables[$param]);
        }
        return true;
    }

    /**
     * Gets a page element
     *
     * @param string $param
     * @param mixed $default
     * @param mixed $format
     */
    final public function get($param, $default = '', $format = '') {

        //print_R($this->variables);
        if (isset($this->$param)) {
            return $this->$param;
        }

        if (isset($this->variables[$param])) {
            return $this->variables[$param];
        }

        if (isset($this->positionVars[$param])) {
            return $this->positionVars[$param];
        }

        return $default;
    }

    /**
     * Output Magic variable Getter
     *
     * @param type $name
     * @return type
     */
    final public function __get($name) {

        //If is property?
        if (isset($this->$name)) {
            return $this->$name;
        }

        //Else check return in output variables;
        return $this->get($name);
    }

    /**
     * Returns the current page mimiType if any
     *
     * @return string
     */
    final public function getMimeType() {
        
    }

    /**
     * Get HTTP code string
     *
     * @param type $code
     * @return type
     */
    final private function getHttpCodeString($code = NULL) {
        if (empty($code)) {
            return null;
        }
    }

    /**
     * Returns the page title
     *
     * @return string
     */
    final public function getPageTitle() {

        if (isset($this->pageTitle)) {
            return (string) $this->pageTitle;
        }
        return;
    }

    /**
     * Gets the output language
     *
     * @return string
     */
    final public function getLangauge() {
        
    }

    /**
     * Returns a description for the current page
     *
     * @return string
     */
    final public function getPageDescription() {
        
    }

    /**
     * Returns an Author for the current page
     *
     * @return string
     */
    final public function getPageAuthor() {
        
    }

    /**
     * Returns all the messages to be displayed
     *
     * @return string
     */
    final public function getMessages() {
        return $this->get("alerts");
    }

    /**
     * Returns a description for the current page
     *
     * @return string
     */
    final public function setPageDescription() {
        return $this;
    }

    /**
     * Returns an Author for the current page
     *
     * @return string
     */
    final public function setPageAuthor() {
        return $this;
    }

    /**
     * Sets the output template, used in views
     * NOTE: These are different from layouts
     *
     * @return Output
     */
    final public function setTemplate() {
        return $this;
    }

    final public function setLanguage($language) {
        
    }

    /**
     * Returns an instance of the Library\Output class
     *
     * @staticvar self $instance
     * @return self
     */
    public static function getInstance() {

        //If the class was already instantiated, just return it
        if (isset(static::$instance))
            return static::$instance;

        static::$instance = new Output();

        return static::$instance;
    }

    /**
     * Defines positions in the template
     *
     * @param type $name
     * @param type $default
     * @param type $style
     */
    public function position($name, $default = '', $style = '') {

        //if is array loop through each;
        if ($this->hasPosition($name)) {

            foreach ($this->variables["page"]["block"][$name]["data"] as $block) {
                if (!is_array($block) || !isset($block['content'])) {
                    continue;
                }
                //process the callback
                //$callback = $block['callback'];
                $string = $block['content'];

                //@TODO rework this, for now just print() the string
                print($string);
            }
            return; // Successfull
        }
        //Output stuff pertaining to that position;
        print($default);
    }

    /**
     * Determines if there is stuff to be loaded into that position
     *
     * @param type $name
     * @return boolean true if or false if not
     */
    public function hasPosition($blockName) {
        //If we have data that goes into this position, return true else false;
        //return (isset($this->positionVars[$name]) && sizeof($this->positionVars[$name]) > 0 ) ? true : false;
        return (isset($this->variables["page"]["block"][$blockName]["data"]) && sizeof($this->variables["page"]["block"][$blockName]["data"]) > 0 ) ? true : false;
    }

    /**
     * Adds positional data for the output
     *
     * @param type $name
     * @param type $default
     * @param type $callback
     */
    public function addToPosition($blockName, $content = '', $title = "", $params = array(), $prepend = FALSE) {

        if (!isset($this->variables["page"]["block"][$blockName]["data"])) {
            $this->variables["page"]["block"][$blockName]["data"] = array();
        }

        if ($prepend) {
            array_unshift($this->variables["page"]["block"][$blockName]["data"], array(
                "content" => $content,
                "title" => $title,
                "params" => $params
            ));
        } else {
            array_push($this->variables["page"]["block"][$blockName]["data"], array(
                "content" => $content,
                "title" => $title,
                "params" => $params
            ));
        }

        if (strtolower($blockName) == "side") {
            $this->variables["page"]["activesidebar"] = true;
        }
        if (strtolower($blockName) == "aside") {
            $this->variables["page"]["activeaside"] = true;
        }

        return $this;
    }

}