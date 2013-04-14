<?php

/**
 * Used to add the facebook Login Alternative to the display;
 */
#\Library\Event::register('beforeLoginFormDisplay', '\Application\Facebook\Models\Authenticate::addLoginLink');

