<?php

\Library\Event::register('beforeRenderMenu', '\Application\Member\Models\Menu::hook');
