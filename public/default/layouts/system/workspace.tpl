<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li class="active"><a href="#stream" data-toggle="tab"><i class="icon-inbox icon icon-24"></i>Inbox</a></li>
            <li><a href="#files" data-toggle="tab"><i class="icon-briefcase icon icon-24"></i>Files</a></li>
            <li><a href="#settings" data-toggle="tab"><i class="icon-plus icon icon-24"></i>Add App</a></li>
        </ul>
        <ul class="nav icon-tabs right no-margin no-bottom-border docked-bottom">
            <li><a href="#settings"><i class="icon-cogs icon icon-24"></i>Settings</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane  active" id="stream"><tpl:import layout="timeline" /></div>
        <div class="tab-pane  box-padding" id="files">All the uploaded files</div>
        <div class="tab-pane  box-padding" id="settings">Work group settings</div>
    </div>
</tpl:layout>