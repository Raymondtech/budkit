<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li class="active"><a data-target="#stream" data-toggle="tab"><i class="icon-air-waves icon icon-16"></i>Stream</a></li>
            <li><a data-target="#calendar" href="/system/content/event/calendar.raw" data-toggle="tab"><i class="icon-calendar icon icon-16"></i>Events</a></li>
            <li><a data-target="#files" data-toggle="tab"><i class="icon-photo icon icon-16"></i>Media</a></li>
            <li><a data-target="#contacts" data-toggle="tab"><i class="icon-people icon icon-16"></i>Friends</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="stream">
            <import layout="timeline" />
        </div>
        <div class="tab-pane  box-padding" id="contacts">Friends</div>
        <div class="tab-pane  box-padding" id="calendar">Events</div>
        <div class="tab-pane  box-padding" id="files">Media files</div>
    </div>
</tpl:layout>