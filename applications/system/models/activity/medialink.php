<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * medialink.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Application\System\Models\Activity;

use Platform;
use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Model
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/controller
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class MediaLink {

    /**
     * A hint to the consumer about the length, in seconds of the media resource identified by the url property. 
     * A media link may contain a duration property when the target resource is a time-based media item such as an audio or video
     * @var interger
     */
    public $duration = 0;

    /**
     * A hint to the consumer about the height, in pixels of the media resource identified by the url property. 
     * A media link may contain a height property when the targe resource is a visual mediat item such as an image, video or embeddable HTML page.
     * @var interger
     */
    public $height = 0;

    /**
     * A media link MUST have a URL property.
     * @var string 
     */
    public $url = "/";

    /**
     * A hint to the consumer about the width, in pixels of the media resource identified by the url peroperty. 
     * A media link may contain a width property when the target resource is a visual media item such as an image, video or embeddable HTML page
     * @var interger 
     */
    public $width = 0;

    public function __construct() {}

    public function serialize() {}

    public function unserialize() {}

    public static function createInstance() {}

}