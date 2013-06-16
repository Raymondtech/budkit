<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl"> 
    <div class="timeline">
        <div class="timeline-line">
            <ol class="timeline-item-index timeline-stream" data-timeline="true">
                <tpl:loop data="activities.items" id="timeline-items">
                    <li class="timeline-item-li timeline-item">
                        <div class="timeline-item-container">

                            <div class="timeline-item-header">
                                <tpl:condition data="summary" test="isset" value="1">
                                    <div class="timeline-item-title"><a href="/system/media/timeline/view/${uri}"><tpl:element type="text" data="summary" medialinks="true" /></a></div>
                                </tpl:condition>
    <!--                                <div class="timeline-item-icon"><a><i class="icon-${verb}"></i></a></div>-->
                                <a class="publisher-profile" href="/member:${actor.uri}/profile/timeline">
                                    <img class="profile-avatar" src="${actor.image.url}" alt="${actor.displayName}" width="${actor.image.width}" height="${actor.image.height}" />
                                    <strong class="profile-name"><tpl:element type="text" data="actor.displayName" /></strong>                              
                                </a>
                                <a href="/system/media/timeline/view/${uri}" title="${published}" class="published-time"><tpl:element type="time" data="published" /></a>                           
                            </div>
                            <div class="timeline-item-content"><tpl:element type="html" data="content" medialinks="true" /></div>
                            <tpl:condition data="object" test="isset" value="1">
                                <div class="timeline-item-media clearfix">                                   
                                    <tpl:media uri="object" link="true" data-target="budkit-slider" />             
                                </div>                     
                            </tpl:condition>
                            <div class="timeline-item-footer">
                                <ul class="actions">
                                    <li class="action-fans"><a href="/system/media/timeline/fans/${uri}"><span class="average" title="See Fans">8.9</span><span class="total">/10</span></a></li>
                                    <tpl:condition data="target_count" test="isset" value="1">
                                        <li class="action-comments"><a href="/system/media/timeline/view/${uri}#comments"><span class="delete" title="See Comments"><tpl:element type="text" formatting="sprintf" cdata="%d Replies" data="target_count"  /></span></a></li>
                                    </tpl:condition>
                                    <li class="action-edit"><a href="/system/media/timeline/edit/${uri}"><span class="edit" title="Delete">Edit</span></a></li>
                                    <li class="action-delete"><a href="/system/media/timeline/delete/${uri}"><span class="delete" title="Delete">Trash</span></a></li>
                                </ul>
                            </div> 
                        </div>                                
                    </li>
                </tpl:loop> 
            </ol>
        </div>
    </div>
</tpl:layout>