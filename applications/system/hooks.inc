<?php

/**
 * Disiplays system attachments
 * 
 * Outputs the file media to the browser
 */
\Library\Event::register('beforeObjectLoad', '\Application\System\Models\Attachments::load');


/**
 * Models a collection for media feeds
 * 
 * 
 */
\Library\Event::register('onMediaSubjectModel', '\Application\System\Models\Attachments::mediaObject');
\Library\Event::register('onMediaSubjectModel', '\Application\System\Models\Collection::mediaObject');


/**
 * Custom menu Items
 * 
 * 
 */
\Library\Event::register('beforeRenderMenu', '\Application\System\Models\Menu::media');
