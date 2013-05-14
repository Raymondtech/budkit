<?php

\Library\Event::register('beforeRenderMenu', '\Application\Campus\Models\Menu::hook');
\Library\Event::register('beforeDashboardDisplay','\Application\Campus\Views\Dashboard::startWidgets');
