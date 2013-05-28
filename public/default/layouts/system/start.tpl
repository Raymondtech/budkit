<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline" style="min-height: 1000px">
                    <div class="stream-alerts"></div> 
                    <div class="timeline-item-publisher-box">  
                        <tpl:condition data="profile.user_photo" test="isset" value="1">
                            <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                            </a>
                        </tpl:condition>
                        <div class="widget stream-cpanel">
                            <div class="widget-body padding-right-zero padding-bottom-zero">
                                <ul class="widgeticons">
                                    <li class="widgeticon">
                                        <a href="/system/media/timeline">
                                            <span class="icon"><i class="icon-time"></i></span>
                                            <span class="title">Timeline</span>
                                            <span class="metric">00</span>
                                            <span class="hint">Activity</span>
                                        </a>
                                    </li>

                                    <li class="widgeticon">
                                        <a href="/member:${profile.user_name_id}/profile/timeline">
                                            <span class="icon"><i class="icon-view-profile"></i></span>
                                            <span class="title">Profile</span>
                                            <span class="metric">0.1</span>
                                            <span class="hint">Impact</span>
                                        </a>
                                    </li>
                                    <li class="widgeticon">
                                        <a href="/system/media/attachments/gallery">
                                            <span class="icon"><i class="icon-file-alt"></i></span>
                                            <span class="title">Documents</span>
                                            <span class="metric">38</span>
                                            <span class="hint">Uploads</span>
                                        </a>
                                    </li>
                                    <li class="widgeticon">
                                        <a href="/campus/workspaces/directory">
                                            <span class="icon"><i class="icon-briefcase"></i></span>
                                            <span class="title">Workspaces</span>
                                            <span class="metric">6</span>
                                            <span class="hint">Workspaces</span>
                                        </a>
                                    </li>
                                    <li class="widgeticon">
                                        <a href="#">
                                            <span class="icon"><i class="icon-bullseye"></i></span>
                                            <span class="title">Courses</span>
                                            <span class="metric">22</span>
                                            <span class="hint">Lectures</span>
                                        </a>
                                    </li>
                                    
                                    <li class="widgeticon">
                                        <a href="#">
                                            <span class="icon"><i class="icon-calendar"></i></span>
                                            <span class="title">Appointments</span>
                                            <span class="metric">42</span>
                                            <span class="hint">Events</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                    <div class="stream-widgets margin-top">
                        <tpl:block data="page.block.dashwidgets" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>