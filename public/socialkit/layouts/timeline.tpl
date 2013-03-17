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
                    <hr />
                    <tpl:import layout="activity/timeline" />
                </div>
            </div>
        </div>
    </div>
</tpl:layout>