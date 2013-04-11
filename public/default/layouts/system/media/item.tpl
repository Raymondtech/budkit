<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-list">
            <div class="widget naked">
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter media-item-actions">
                        <li><a href="#">Share</a></li>
                        <li><a href="#">Download</a></li> 
                        <li>
                            <span class="rating">
                                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span>
                            </span>
                        </li>
                        <li class="action-like hover">
                            <a>
                                <span class="average" title="See Fans">8.9</span><span class="total">/10</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <ol class="timeline-item-index timeline-stream single-item" data-timeline="true">
                        <tpl:loop data="object.items" id="timeline-items">
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <tpl:condition data="summary" test="isset" value="1">
                                        <div class="timeline-item-title"><tpl:element type="text" data="summary" medialinks="true" /></div>
                                    </tpl:condition>
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><i class="icon-${verb}"></i></a></div>
                                        <a class="publisher-profile" href="#">
                                            <img class="profile-avatar thumbnail" src="${actor.image.url}" alt="${actor.displayName}" width="${actor.image.width}" height="${actor.image.height}" />
                                            <strong class="profile-name"><tpl:element type="text" data="actor.displayName" /></strong>                              
                                        </a>
                                        <span title="${published}" class="published-time"><tpl:element type="time" data="published" /></span>

                                    </div>
                                    <div class="timeline-item-content"><tpl:element type="text" data="content" medialinks="true" /></div>
                                    <tpl:condition data="object" test="isset" value="1">
                                        <div class="timeline-item-media clearfix">                                   
                                            <tpl:media uri="object" link="true" />             
                                        </div>                     
                                    </tpl:condition>
                                    <div class="timeline-item-footer">
                                        <ul class="actions">
                                            <li class="action-edit"><a href="/system/media/timeline/edit/${uri}"><span class="edit" title="Delete">Edit</span></a></li>
                                            <li class="action-delete"><a href="/system/media/timeline/delete/${uri}"><span class="delete" title="Delete"><strong>Trash</strong></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </tpl:loop> 
                    </ol>
                    <tpl:import layout="media/form/comment" />    
                    <tpl:import layout="media/timeline" />
                </div>
            </div>
        </div>
    </div>
</tpl:layout>