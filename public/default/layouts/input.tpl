<tpl:layout name="inputsettings" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
        <div class="timeline-item-publisher-box">  
            <tpl:condition data="profile.user_photo" test="isset" value="1">
                <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                    <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                </a>
            </tpl:condition>
            <div class="timeline-item-icon toolset"><a><i class="icon-plus"></i></a></div>
            <div class="timeline-item-publisher margin-bottom-half">
                <tpl:condition test="compare" count="1" operator="greaterthan" value="1" data="editor_forms">
                    <ul class="nav nav-tabs-launcher" id="status-tabs">
                        <li><strong>Share:</strong></li>
                        <tpl:loop id="form-launchers" data="editor_forms">
                            <li><a href="#${id}-form" data-toggle="tab"><i class="${icon-class}"></i><tpl:element type="text" data="title" /></a></li>
                        </tpl:loop>
                    </ul>
                </tpl:condition>
                <tpl:condition test="compare" count="1" operator="greaterthan" value="1" data="editor_forms">
                    <div class="tab-content tabs-launcher">
                        <tpl:loop id="form-launchers-tabs" data="editor_forms">
                            <div class="tab-pane" id="${id}-form">
                                <tpl:import layout="${layout}" app="${app}" />
                            </div>
                        </tpl:loop>
                    </div>
                </tpl:condition>
                <tpl:condition test="compare" count="1" operator="equals" value="1" data="editor_forms">             
                    <tpl:loop id="form-launchers-single" data="editor_forms">
                        <tpl:import layout="${layout}" app="${app}" />
                    </tpl:loop>
                </tpl:condition>
            </div>
        </div>
    </tpl:condition>
</tpl:layout>