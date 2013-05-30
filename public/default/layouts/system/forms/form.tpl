<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">

                    <div class="stream-widgets">
                        <div class="page-header clearfix">
                            <tpl:condition test="compare" count="1" operator="equals" value="1" data="editor_forms">
                                <div class="btn-toolbar pull-right no-margin">                                 
                                    <a class="btn" href="/system/media/create">Other Type?</a>
                                </div>
                            </tpl:condition>
                            <h1 class="margin-top-zero"><tpl:element type="text" data="page.title" /></h1>
                        </div>
                    </div> 
                    <tpl:condition test="compare" count="1" operator="equals" value="1" data="editor_forms">
                        <div class="margin-bottom"> 
                            <tpl:import layout="input" /> 
                        </div>
                    </tpl:condition>
                    <tpl:condition test="compare" count="1" operator="greaterthan" value="1" data="editor_forms">
                        <div class="timeline-item-publisher-box">  
                            <tpl:condition data="profile.user_photo" test="isset" value="1">
                                <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">          
                                    <tpl:media uri="profile.user_photo"  mode="icon" width="50" height="50"  class="profile-avatar thumbnail inline-block" />
                                </a>
                            </tpl:condition>
                            <div class="widget stream-cpanel">
                                <div class="widget-body padding-right-zero padding-bottom-zero">
                                    <ul class="widgeticons">
                                        <tpl:loop id="form-launchers" data="editor_forms">
                                            <li class="widgeticon">
                                                <a href="/system/media/create/${id}">
                                                    <span class="icon"><i class="${icon-class}"></i></span>
                                                    <span class="title"><tpl:element type="text" data="title" /></span>
                                                    <span class="metric"><tpl:element type="text" data="metric" /></span>
                                                    <span class="hint"><tpl:element type="text" data="hint" /></span>
                                                </a>
                                            </li>
                                        </tpl:loop>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </tpl:condition>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>