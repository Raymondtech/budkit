<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * information.php
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
namespace Application\Member\Controllers\Profile;
use \Application\Member\Controllers as Member;
/**
 * The profile blog display actions controller subclass 
 *
 * This class implements actions required for accessing various profile subviews
 *
 * @category  Application
 * @package   Action Controller
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 */
final class Information extends Member\Profile{
    
    public function index() {
       
        //Get the Member profile
        $profile = $this->getMemberProfile();
        
        //Profile Information Title;
        $this->output->setPageTitle( sprintf( _("%s | Information"), $profile['user_full_name'] ));
        
        //Profile Model
        $relations = $this->load->model("relations", "member");
        
        $followers = $relations->getFollowers( $profile['user_name_id'] );
        $following = $relations->getFollowing( $profile['user_name_id'] );
        
        //print_r($following);    
        if($followers['totalItems']>0) $this->set("followers", $followers);
        if($following['totalItems']>0) $this->set("following", $following);

        $media = $this->output->layout("/profile/information");
        $this->output->addToPosition("body", $media);

        return parent::index();
    }
    
    /**
     * Returns an instance of the Profile display class
     * @staticvar object $instance
     * @return object Display
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
