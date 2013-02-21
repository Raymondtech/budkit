<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * routes.inc - Subroutes must have the same id as the static first segment
 *
 * Requires PHP version 5.4
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
 * @since      Available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

$route["action"]["execute"] = array(
    "path" => '/execute/:method/',
    "application" => 'system',
    "controller" => 'commands',
    "dynamic" => array(
        ":method" => ':method'
    )
);

$route["dashboard"] = array(
    "path" => '/dashboard/',
    "application" => 'system',
    "controller" => 'start',
    "method" => 'dashboard'
);

$route["search"] = array(
    "path" => '/search/',
    "application" => 'system',
    "controller" => 'commands',
    "method" => 'search'
);
