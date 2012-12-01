<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="row-fluid timeline-stream" >
        <div class="span5">
            <div>
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
            </div>
        </div>
        <div class="span7">
            <div class="top-pad right-pad bottom-pad clearfix">
                <tpl:import layout="activity/item" />
            </div>
        </div>
    </div>
</tpl:layout>