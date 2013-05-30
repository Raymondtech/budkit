<?php

\Library\Event::register('beforeRenderMenu', '\Application\Campus\Models\Menu::hook');
\Library\Event::register('beforeDashboardDisplay', '\Application\Campus\Views\Dashboard::startWidgets');

//Add forms to the input editor
\Library\Event::register('beforeEditorDisplay', function(&$forms) {
            //$forms[] =  array("id" => "workspace", "title" => "Workspace", "layout" => "forms/workspace", "app"=>"campus", "icon-class" => "icon-lightbulb");
//    $forms = array_merge($forms, array(
//        array("id" => "drop", "title" => "Upload", "layout" => "forms/drop", "app" => "system", "icon-class" => "icon-cloud-upload"),
//        array("id" => "snap", "title" => "Snap", "layout" => "forms/snap", "app" => "system", "icon-class" => "icon-camera"),
//        array("id" => "editor", "title" => "Article", "layout" => "forms/editor", "app" => "system", "icon-class" => "icon-text"),
//        array("id" => "import", "title" => "Import", "layout" => "forms/import", "app" => "system", "icon-class" => "icon-upload-alt"),
//        array("id" => "status", "title" => "Idea", "layout" => "forms/status", "app" => "system", "icon-class" => "icon-lightbulb")
//     ));
});
