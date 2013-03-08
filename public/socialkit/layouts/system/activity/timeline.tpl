<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl"> 
    <div class="timeline">
        <div class="timeline-line"></div>
        <ol class="timeline-item-index">
            <tpl:loop data="activities.items">
                <li class="timeline-item-li timeline-item">
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
                            <tpl:condition data="object" test="isset" value="1">
                                <tpl:condition data="object.objectType" test="isnot" value="collection">
                                    <div class="timeline-item-media">
                                        <img src="/system/object/${object.uri}/resize/500" />
                                    </div>
                                </tpl:condition>
                                <tpl:condition data="object.objectType" test="equals" value="collection">
                                    <div class="timeline-item-media">	  	
                                        <ul class="media-grid unstyled bottom-media">	  	
                                            <tpl:loop data="object.items" id="activity_object">
                                                <li><a href="#"><img src="/system/object/${uri}/resize/150/150" /></a></li>
                                            </tpl:loop> 	
                                        </ul>  	
                                    </div>
                                </tpl:condition>
                                            
                            </tpl:condition>
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