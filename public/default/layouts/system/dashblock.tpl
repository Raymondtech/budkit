<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li class="active"><a href="#home" data-toggle="tab"><i class="icon-home icon icon-16"></i>Dashboard</a></li>
            <li><a data-target="#calendar" href="/system/content/event/calendar.raw" data-toggle="tab"><i class="icon-calendar icon icon-16"></i>Calendar</a></li>
            <li><a href="#workspaces" data-toggle="tab"><i class="icon-keyboard icon icon-16"></i>Workspaces</a></li>
            <li><a href="#files" data-toggle="tab"><i class="icon-paperclip icon icon-16"></i>Files</a></li>
            <li><a href="#reports" data-toggle="tab"><i class="icon-file-powerpoint icon icon-16"></i>Reports</a></li>
            <li><a href="#contacts" data-toggle="tab"><i class="icon-users icon icon-16"></i>Contacts</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active box-padding" id="home">Dashboard</div>
        <div class="tab-pane  box-padding" id="workspaces">Workspaces</div>
        <div class="tab-pane  box-padding" id="calendar">Events</div>
        <div class="tab-pane  box-padding" id="files">All the uploaded files</div>
        <div class="tab-pane  box-padding" id="reports">Work group settings</div>
    </div>
</tpl:layout>