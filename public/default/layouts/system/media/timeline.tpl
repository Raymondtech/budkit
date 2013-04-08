<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl"> 
    <div class="timeline">
        <div class="timeline-line">
            <ol class="timeline-item-index timeline-stream long-stream" data-timeline="true">
                <tpl:loop data="activities.items" id="timeline-items">
                    <li class="timeline-item-li timeline-item">
                        <div class="timeline-item-container">
                            <tpl:condition data="summary" test="isset" value="1">
                                <div class="timeline-item-title"><a href="/system/media/timeline/view/${uri}"><tpl:element type="text" data="summary" medialinks="true" /></a></div>
                            </tpl:condition>
                            <div class="timeline-item-header">
                                <div class="timeline-item-icon"><a href="#"><i class="icon-${verb}"></i></a></div>
                                <a class="publisher-profile" href="#">
                                    <img class="profile-avatar thumbnail" src="${actor.image.url}" alt="${actor.displayName}" width="${actor.image.width}" height="${actor.image.height}" />
                                    <strong class="profile-name"><tpl:element type="text" data="actor.displayName" /></strong>                              
                                </a>
                                <a href="/system/media/timeline/view/${uri}" title="${published}" class="published-time"><tpl:element type="time" data="published" /></a>
                                
                            </div>
                            <div class="timeline-item-content"><tpl:element type="html" data="content" medialinks="true" /></div>
                            <tpl:condition data="object" test="isset" value="1">
                                <tpl:condition data="object.objectType" test="isnot" value="collection">
                                    <div class="timeline-item-media clearfix">                                   
                                        <tpl:media uri="object.uri" name="object.name" url="object.url" link="true" type="object.type" data-target="budkit-slider"></tpl:media>             
                                    </div>
                                </tpl:condition>
                                <tpl:condition data="object.objectType" test="equals" value="collection">
                                    <div class="timeline-item-media">	  	
                                        <ul class="media-grid bottom-media clearfix">	  	
                                            <tpl:loop data="object.items" id="media-items">
                                                <li><tpl:media uri="uri"  type="type" link="true" mode="thumbnail" url="url" class="media-item" name="name"  data-target="budkit-slider" width="170" height="170" /></li>
                                            </tpl:loop> 	
                                        </ul>  	
                                    </div>
                                </tpl:condition>
                            </tpl:condition>
                            <div class="timeline-item-footer">
                                <ul class="actions">
                                    <li class="action-like hover">
                                        <span class="rating">
                                            <span class="heart"></span><span class="heart"></span><span class="heart"></span><span class="heart active"></span><span class="heart"></span>
                                        </span>
                                    </li>
                                    <li class="action-fans"><a href="/system/media/timeline/fans/${uri}"><span class="average" title="See Fans">8.9</span><span class="total">/10</span></a></li>
    <!--                                <li class="action-comments"><a href="/system/media/timeline/comments/${uri}"><span class="delete" title="See Comments">22 replies</span></a></li>-->

                                    <li class="action-reply hover"><a href="/system/media/timeline/reply/${uri}"><span class="reply" title="Reply" data-toggle="action-comment">Reply</span></a></li>   
                                    <li class="action-delete hover"><a href="/system/media/timeline/delete/${uri}"><span class="delete" title="Delete"><strong>Trash</strong></span></a></li>
                                </ul>
                                <div class="action-comment hide">
                                    <tpl:import layout="media/form/comment" /> 
                                </div> 
                            </div>

                        </div>
                    </li>
                </tpl:loop> 
            </ol>
        </div>
    </div>
</tpl:layout>