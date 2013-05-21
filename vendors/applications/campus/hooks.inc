<?php

\Library\Event::register('beforeRenderMenu', '\Application\Campus\Models\Menu::hook');
\Library\Event::register('beforeDashboardDisplay','\Application\Campus\Views\Dashboard::startWidgets');

//Add forms to the input editor
\Library\Event::register('beforeEditorDisplay', function(&$forms){
    //$forms[] =  array("id" => "workspace", "title" => "Workspace", "layout" => "forms/workspace", "app"=>"campus", "icon-class" => "icon-lightbulb");
});
