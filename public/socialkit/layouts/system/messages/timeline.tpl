<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner no-margin">
           <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
    <div class="stream-box row-fluid activity-box">
        <div class="stream-list">
            <div class="widget">
                <div class="widget-head"><span class="widget-title">News Feeds</span><a class="widget-close" data-dismiss="widget"><i class="icon-remove"></i></a></div>
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter">
                        <li class="active"><a href="#">Public</a></li>
                        <li><a href="#">Following</a></li>
                        <li><a href="#">Followers</a></li>
                        <li class="nav-header">Personalized Feeds</li>
                        <li><a href="#">Closest friends</a></li>
                        <li><a href="#">People in Newcastle</a></li>
                    </ul>
                </div>
                <div class="widget-footer">
                    <a href="#">Edit Lists</a>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <tpl:import layout="input" />                   
                    <tpl:import layout="activity/timeline" />
                    <!--Just A styling dummy timeline Item for trying out different styles -->
                    <ul class="timeline-item-index styling-dummy">
                        <li class="timeline-item-li timeline-item">
                            <div class="timeline-item-container">
                                <div class="timeline-item-header">
                                    <div class="timeline-item-icon">
                                        <a href="#">
                                            <i class="icon-post"></i>
                                        </a>
                                    </div>
                                    <a class="publisher-profile" href="#">
                                        <img class="profile-avatar thumbnail" src="/system/object/xZiSAU/resize/50/50" alt="Livingstone Fultang" width="50" height="50" />
                                        <strong class="profile-name">Livingstone Fultang</strong>
                                    </a>
                                    <a href="/system/activity/view/j6Nkri" title="2013-03-08 02:56:49" class="published-time">1 day ago</a>

                                    <div class="timeline-item-title">Justa picture! From dribbble for design inspiration</div>
                                    <div class="timeline-item-media">
                                        <video loop="loop" controls="controls" tabindex="0" src="http://budkit.org/creative.mp4" width="100%"></video>
                                    </div>

                                </div>
                                <div class="timeline-item-footer">
                                    <ul class="actions">
                                        <li class="action-like">
                                            <a href="/system/activity/favourite/j6Nkri">
                                                <span class="like" title="Like"><i class="icon-heart"></i> Like this</span>
                                            </a>
                                        </li>
                                        <li class="action-reply">
                                            <a href="/system/activity/reply/j6Nkri">
                                                <span class="reply" title="Reply">Reply</span>
                                            </a>
                                        </li>
                                        <li class="action-delete">
                                            <a href="/system/activity/delete/j6Nkri">
                                                <span class="delete" title="Delete">Delete</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Styling Dummy Ends -->
                </div>
            </div>
        </div>
    </div>
</tpl:layout>