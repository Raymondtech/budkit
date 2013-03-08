<?php

/**
 * Disiplays system attachments
 * 
 * Outputs the file content to the browser
 */
\Library\Event::register('beforeObjectLoad', '\Application\System\Models\Attachments::load');


/**
 * Models a collection for activity feeds
 * 
 * 
 */
\Library\Event::register('onActivitySubjectModel', '\Application\System\Models\Attachments::activityObject');
\Library\Event::register('onActivitySubjectModel', '\Application\System\Models\Collection::activityObject');