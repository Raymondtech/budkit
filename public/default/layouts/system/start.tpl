<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <header class="section-header clearfix">
                <div class="message-header pull-left"><div class="page-header"><h1 class="margin-top-zero"><tpl:element type="text" formatting="sprintf" cdata="Hi %s" data="user.user_first_name"  /></h1></div></div> 
                <ul class="nav nav-pills no-margin pull-right">
                    <li>
                        <div class="btn-group">
                            <a href="/system/notifications/list" class="btn">
                                <i class="icon-bell-alt"></i>
                            </a>
                            <a href="/settings/member/account" class="btn">
                                <i class="icon-cog"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="/system/authenticate/logout" class="btn">
                                Log out
                            </a>
                        </div>
                    </li>
                </ul>
            </header>
            <div class="widget naked">
                <div class="widget-body padding-zero">
                    <ul class="stream">             
                        <li class="stream-item padding">Something urgent</li>                  
                    </ul>
                </div>
            </div>
        </div>
        <div class="message-view">
            <div class="stream-thread">  
                <header class="section-header clearfix">   
                    <form class="margin-bottom-zero form-vertical inline-block row-fluid" action="/system/search/graph" method="post"> 
                        <div class="controls input-append margin-bottom-zero row-fluid span12">
                            <input type="text" class="span12" name="query" placeholder="Search for people, documents, groups or anything else" value="${query}" />
                        </div>
                    </form>
                </header>
                <div class="stream-body stream-box row-fluid media-box">
                    <div class="stream-view">    
                        <div class="padding" id="timeline">
                            <div class="widget">
                                <!--<div class="widget-head">Control Panel</div>-->
                                <div class="widget-body">
                                    <ul class="widgeticons compensate-margins">
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
                                                <span class="metric">24,428</span>
                                                <span class="hint">Points</span>
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
                                            <a href="/system/appointments/calendar/index">
                                                <span class="icon"><i class="icon-calendar"></i></span>
                                                <span class="title">Appointments</span>
                                                <span class="metric">42</span>
                                                <span class="hint">Events</span>
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
                                            <a href="/campus/courses/directory">
                                                <span class="icon"><i class="icon-bullseye"></i></span>
                                                <span class="title">Courses</span>
                                                <span class="metric">22</span>
                                                <span class="hint">Lectures</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <tpl:block data="page.block.dashwidgets" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>
