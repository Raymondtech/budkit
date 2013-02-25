<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl"> 
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
                                                <!--                    <div  class="timeline-more-items">
                                            <button class="btn input-100pct">Load more</button>
                                        </div>-->
    </div>
</tpl:layout>