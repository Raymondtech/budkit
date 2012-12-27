<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom width-fluid">
            <li class="active"><a href="#stream" data-toggle="tab"><i class="icon-speech-reply icon icon-16"></i>Everything</a></li>
            <li><a href="#files" data-toggle="tab"><i class="icon-box icon icon-16"></i>Files</a></li>
            <li><a href="/member/settings/account.raw" data-target="#appdir" data-toggle="tab"><i class="icon-dot-dot icon icon-16"></i>Add App</a></li>
            <li class="pull-right-important"><a href="#settings" data-toggle="tab"><i class="icon-cog icon icon-16"></i>Settings</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane  active" id="stream">
            <import layout="timeline" />
        </div>
        <div class="tab-pane" id="appdir">Application directory</div>
        <div class="tab-pane  box-padding" id="files">All the uploaded files</div>
        <div class="tab-pane  box-padding" id="settings">
            <form method="post" parse="true" wrap="true" >
                <input type="text" label="Username" name="user_name_id" hint="Some interesting hint topic" class="input-xxxlarge" />
                <select value="option2" label="Select Field" name="Select field" hint="Some select field hint">
                    <option value="option1">This is the first Option</option>
                    <option value="option2">This is the second Option</option>
                    <option value="option3">This is the third Option</option>
                </select>
            </form>
        </div>
    </div>
</tpl:layout>