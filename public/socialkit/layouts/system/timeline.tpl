<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <ul class="nav" id="activitymenu">
                <li class="active"><a data-target="#everybody" data-toggle="tab"><i class="icon icon-16">#</i>Everybody</a></li>
                <li><a data-target="#friends" data-toggle="tab"><i class="icon icon-16">&amp;</i>Friends</a></li>
                <li><a data-target="#mentions" data-toggle="tab"><i class="icon icon-16">@</i>Mentions</a></li>
            </ul>
        </div>
    </div>
    <div class="padding" id="timeline">
        <div class="row-fluid" >
            <div class="span8">            
                <tpl:import layout="input" />
                <ol class="timeline-item-index">
                    <tpl:loop data="activities.items">
                        <li class="timeline-item-li">
                            <div class="timeline-item-container">
                                <div class="timeline-item-header">
                                    <div class="timeline-item-icon"><a href="#"><i class="icon-${verb}"></i></a></div>
                                    <a class="publisher-profile" href="#">
                                        <img class="profile-avatar thumbnail" src="${actor.image.url}" alt="${actor.displayName}" width="${actor.image.width}" height="${actor.image.height}" />
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
                <div  class="timeline-more-items">
                    <button class="btn input-100pct">Load more</button>
                </div>
            </div>
            <div class="span4">
                <div class="widget-bucket affix-top" data-spy="affix" data-offset-top="50" id="widget-bucket-4">
                    <div class="widget">
                        <div class="widget-head"><span class="widget-title">Network Activity</span><a class="widget-close" data-dismiss="widget"><i class="icon-remove"></i></a></div>
                        <div class="widget-body"><tpl:import layout="timelinenotes" /></div>
                        <!--<div class="widget-footer">Widget Footer</div>-->
                    </div>
                </div>

            </div>                       
        </div>
    </div>
</tpl:layout>