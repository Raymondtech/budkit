<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * hooks.inc
 *
 * Requires PHP version 5.3
 * 
 * While the observer pattern provides a means for library and utiltity class to 
 * monitor 'events' stati in action controllers, the event callback interface
 * provides the only means by which action controllers can extend library and 
 * utility classes. Unlike observers callback hooks need to be defined for the former
 * for each callback. This class is simply a record of all the available callback 
 * methods. To define a callback in your application, add a hook.inc file to the
 * root of the application and register your event as show below. The callback methods
 * relies on the PHP callback functions call_user_func and call_user_func_array.
 * It is important that you deal with exceptions properly in your callback method
 * definition. Callbacks registered with call_user_func() and call_user_func_array() 
 * will not be called if there is an uncaught exception thrown in a previous callback.
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 * 
 * To modify data passed as argument, hook callback methods must be defined to 
 * accept variables passed by reference. i.e &$variable. There is a limit number of
 * variables a trigger can pass to callbacks
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * 
 * 
 * 
 * 
 */
//onStart();
//onShutdown()
//beforeDispatch();
//beforeRedirect();
//beforeMenuRender($menuId, $menuItems);
//beforeRoute($path);
//afterRoute(\Library\Router);
//beforeObjectLoad(\Platform\Entity, array $params) an entity with object details
//onActivitySubjectModel(Activity\Object $activitySubject, string $activityObjectType , Int $activityObjectId ); 

