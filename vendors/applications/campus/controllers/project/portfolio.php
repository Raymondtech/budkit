<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * portfolio.php
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
namespace Application\Campus\Controllers\Project;

use Application\Campus\Controllers as Campus;


/**
 * Portfolio CRUD action controller. 
 *
 * This class implements the action controller that manages the creation, 
 * view and edit of portfolios.
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Portfolio extends Campus\Project {

    /**
     * The default fallback method. 
     * @return  void
     */
    public function index() {
        
        $this->output->setPageTitle( _("Portfolio") );

        $model   = $this->load->model("attachments", "system"); //This will change of portfolio but for now
        $attachments = $model->setListOrderBy("o.object_created_on", "DESC")->getObjectsList("attachment");
        $model->setPagination(); //Set the pagination vars
        $items     = array();
        //Loop through fetched attachments;
        //@TODO might be a better way of doing this, but just trying
        while ($row = $attachments->fetchAssoc()){
            $row['attachment_url'] = "/system/object/{$row['object_uri']}";
            $items["items"][] = $row;
        }
        $this->set("gallery", $items );
        
        $gallery = $this->output->layout("media/gallery", "system");
        $this->output->addToPosition("dashboard", $gallery);
        
        $this->load->view('project')->display();
        
    }

    /**
     * Get's an instance of the Portfolio controller only creating one if does not
     * exists
     * @staticvar self $instance
     * @return an instance of {@link Portfolio}
     * 
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
