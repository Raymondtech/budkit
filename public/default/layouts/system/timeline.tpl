<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="row-fluid timeline-stream" >
        <div class="span8">

            <tpl:import layout="input" />

            <ol class="timeline-item-index">
                <tpl:loop data="activities.items">
                    <li class="timeline-item-li">
                        <div class="timeline-item-container">
                            <div class="timeline-item-header">
                                <a class="publisher-profile" href="#">
                                    <img class="profile-avatar" src="${actor.image.url}" alt="${actor.displayName}" width="48" height="48" />
                                    <strong class="profile-name"><tpl:element type="text" data="actor.displayName" /></strong>                              
                                </a>
                                <a href="/system/activity/view/${uri}" title="${published}" class="published-time"><tpl:element type="time" data="published" /></a>
                                <ul class="actions">
                                    <li class="action-like"><a href="/system/activity/favourite/${uri}"><span class="like" title="Like">Like</span></a></li>
                                    <li class="action-reply"><a href="/system/activity/reply/${uri}"><span class="reply" title="Reply">Reply</span></a></li>
                                    <li class="action-delete"><a href="/system/activity/delete/${uri}"><span class="delete" title="Delete">Delete</span></a></li>
                                </ul>
                                <div class="timeline-item-title"><tpl:element type="text" data="content" /></div>
                            </div>
                        </div>
                    </li>
                </tpl:loop>  
            </ol>
            <div  align="center">
                <button class="btn  btn-mini">Load more</button>
            </div>
        </div>
        <div class="span4">
            <div class="top-pad right-pad bottom-pad clearfix">
                <div class="widget-body">
                    <h2>2,190<small class="pull-right">60%</small></h2>
                    <div class="progress mini-bar progress-success">
                        <div class="bar" style="width: 60%;"></div>
                    </div>
                    <span class="help-block">New members in the last 30 days</span>
                    <h2 class="top-pad">64<small class="pull-right">10%</small></h2>
                    <div class="progress mini-bar progress-danger">
                        <div class="bar" style="width: 10%;"></div>
                    </div>
                    <span class="help-block">New content. Post, Check-ins etc. </span>
                    <h2 class="top-pad">583<small class="pull-right">53%</small></h2>
                    <div class="progress mini-bar progress-bar">
                        <div class="bar" style="width: 53%;"></div>
                    </div>
                    <span class="help-block">Relationships forged</span>
                    <h2 class="top-pad">8,943,985<small class="pull-right">90%</small></h2>
                    <div class="progress mini-bar">
                        <div class="bar" style="width: 90%;"></div>
                    </div>
                    <span class="help-block">Unique visitors this month</span>
                    <h2 class="top-pad">2,190<small class="pull-right">60%</small></h2>
                    <div class="progress mini-bar progress-success">
                        <div class="bar" style="width: 60%;"></div>
                    </div>
                    <span class="help-block">New members in the last 30 days</span>
                    <h2 class="top-pad">64<small class="pull-right">10%</small></h2>
                    <div class="progress mini-bar progress-danger">
                        <div class="bar" style="width: 10%;"></div>
                    </div>
                    <span class="help-block">New content. Post, Check-ins etc. </span>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>