<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner no-margin">
           <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
    <div class="stream-box row-fluid media-box">
        <div class="stream-list">
            <div class="widget">
                <div class="widget-head"><span class="widget-title">Filters</span><a class="widget-close" data-dismiss="widget"><i class="icon-remove"></i></a></div>
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter">
                        <li><a href="#">My Timeline</a></li>
                        <li class="active"><a href="#">Recent</a></li>
                        <li><a href="#">Shared with me</a></li>
                        <li><a href="#">Liked</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Followers</a></li>
                    </ul>
                </div>
                <div class="widget-footer">
                    <a href="/settings/member/privacy/lists">Edit Lists</a>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <tpl:import layout="input" />     
                    <div class="stream-alerts"><hr /></div>
                    <tpl:import layout="media/timeline" />
                </div>
            </div>
        </div>
    </div>
</tpl:layout>