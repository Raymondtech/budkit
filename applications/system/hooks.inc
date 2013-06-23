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
\Library\Event::register('onSearch', '\Application\System\Models\Attachments::search');
\Library\Event::register('onSearch', '\Application\System\Models\Message::search');


/**
 * Custom menu Items
 */
\Library\Event::register('beforeRenderMenu', '\Application\System\Models\Menu::media');

/**
 * Custom Login Links
 * OAuth Providers
 */
\Library\Event::register('beforeLoginFormDisplay', function(&$alternatives = array()) {
            //@TODO get oauth providers from config
            //Twitter OAuth
            if (!is_array($alternatives))
                return;

            $alternatives = array_merge($alternatives, array(
                "twitter" => array(
                    "link" => Library\Uri::internal('/sign-in/handler:oauth/provider:twitter/'),
                    "title" => "twitter",
                    "uid" => "twitter"
                ),
                "facebook" => array(
                    "link" => Library\Uri::internal('/sign-in/handler:oauth/version:2.0/provider:facebook/'),
                    "title" => "facebook",
                    "uid" => "facebook"
                ),
                "google" => array(
                    "link" => Library\Uri::internal('/sign-in/handler:oauth/version:2.0/provider:google/'),
                    "title" => "google",
                    "uid" => "google"
                ))
            );
        });
