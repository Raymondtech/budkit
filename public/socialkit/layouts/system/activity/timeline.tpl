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

                            <div class="timeline-item-title"><tpl:element type="text" data="content" /></div>
                            <tpl:condition data="object" test="isset" value="1">
                                <tpl:condition data="object.objectType" test="isnot" value="collection">
                                    <div class="timeline-item-media">
                                        <a href="/system/object/${object.uri}/" data-target="budkit-slider">
                                            <img src="/system/object/${object.uri}/resize/500" />
                                        </a>
                                    </div>
                                </tpl:condition>
                                <tpl:condition data="object.objectType" test="equals" value="collection">
                                    <div class="timeline-item-media">	  	
                                        <ul class="media-grid unstyled bottom-media">	  	
                                            <tpl:loop data="object.items" id="activity_object">
                                                <li><a href="/system/object/${uri}/" data-target="budkit-slider"><img src="/system/object/${uri}/resize/150/150" /></a></li>
                                            </tpl:loop> 	
                                        </ul>  	
                                    </div>
                                </tpl:condition>

                            </tpl:condition>
                        </div>
                        <div class="timeline-item-footer">
                            <ul class="actions">
                                <li class="action-fans"><a href="/system/activity/fans/${uri}"><span class="delete" title="See Fans"><i class="icon-heart"></i><strong>24</strong> fans</span></a></li>
                                <li class="action-like hover"><a href="/system/activity/favourite/${uri}"><span class="like" title="Like">Like this</span></a></li>
                                <li class="action-comments"><a href="/system/activity/comments/${uri}"><span class="delete" title="See Comments"><i class="icon-comments"></i><strong>22</strong> comments</span></a></li>
                                <li class="action-reply hover"><a href="/system/activity/reply/${uri}"><span class="reply" title="Reply">Add comment</span></a></li>   
                                <li class="action-delete hover"><a href="/system/activity/delete/${uri}"><span class="delete" title="Delete"><strong>Trash this</strong></span></a></li>
                            </ul>
                            
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