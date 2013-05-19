<?php

\Library\Event::register('beforeRenderMenu', '\Application\Member\Models\Menu::hook');
\Library\Event::register('onSearch', '\Application\Member\Models\User::search');
