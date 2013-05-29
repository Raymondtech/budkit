<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="clearfix padding">
        <tpl:condition data="tasks.showfilters" value="1" test="isset">
            <form class="pull-right no-margin form-horizontal" action="/" method="POST">   
                <select name="authority-parent" id="authority-parent">
                    <option value="">Select Project</option>
                    <tpl:loop data="authorities" id="authorities">
                        <option value="${authority_id}">
                            <tpl:loop limit="indent"><span class="indenter">|--</span></tpl:loop>
                            <span><tpl:element type="text" data="authority_title" /></span>
                        </option>
                    </tpl:loop>
                </select>
                <input type="hidden" name="authority-description" />
                <button type="submit" class="btn">View Project To-dos</button>
            </form>
        </tpl:condition>
        <ul class="nav nav-pills no-margin">
            <li class="highlighted"><a href="/system/media/create" >Add New Task</a></li>
        </ul>    
    </div>
    <hr class="margin-zero" />
    <div class="stream-box row-fluid media-box">
        <div class="stream-list">
            <div class="widget naked">
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter">
                        <li><a href="#">Overdue</a></li>
                        <li><a href="#">No deadlines</a></li>
                        <li><a href="#">Completed</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body" id="timeline">

                    <div class="padding-left padding-right padding-bottom">
                        <ol class="timeline-item-index timeline-stream single-item" data-timeline="true">
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><icon class="icon-ok" style="color: green" /></a></div>
                                        <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                            <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                                            <strong class="profile-name" style="text-decoration: line-through">EMSA: NRF2/GlyT1aProbe overnight incubation</strong> 
                                        </a>
                                        <span title="${published}" class="published-time" style="text-decoration: line-through">Due in 12 hours time</span>
                                    </div>
                                    <div class="timeline-item-content" style="text-decoration: line-through">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</div>
                                    <div class="timeline-item-footer"><span class="label label-success"><i class="icon-trophy"></i> EMSA (10pts)</span></div>
                                </div>
                            </li>
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><icon class="icon-calendar" /></a></div>
                                        <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                            <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                                            <strong class="profile-name">Feed Max's flask of Caco-2 cells</strong> 
                                        </a>
                                        <span title="${published}" class="published-time">Due in 24 hours time</span>
                                    </div>
                                    <div class="timeline-item-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</div>
                                </div>
                            </li>
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><icon class="icon-calendar" /></a></div>
                                        <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                            <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                                            <strong class="profile-name">Transfection LF18: Caco2 transfection with pGlyT1aProm5UTR/lacZ</strong> 
                                        </a>
                                        <span title="${published}" class="published-time">Due in 72 hours time</span>
                                    </div>
                                    <div class="timeline-item-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</div>
                                </div>
                            </li>
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><icon class="icon-calendar" /></a></div>
                                        <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                            <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                                            <strong class="profile-name">Transfection LF19 setup.</strong> 
                                        </a>
                                        <span title="${published}" class="published-time">Saturday 11th May 2013</span>
                                    </div>
                                    <div class="timeline-item-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</div>
                                </div>
                            </li>
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><icon class="icon-calendar" /></a></div>
                                        <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                            <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                                            <strong class="profile-name">Lab Meeting with Alison Howard</strong> 
                                        </a>
                                        <span title="${published}" class="published-time">Wednesday, 15th May 2013</span>
                                    </div>
                                    <div class="timeline-item-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</div>
                                </div>
                            </li>
                        </ol> 
                        <tpl:import layout="media/timeline" />  
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>