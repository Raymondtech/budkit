<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-list">
            <div class="widget naked">
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter media-item-actions">
                        <li><a href="#">Share</a></li>
                        <li><a href="#">Download</a></li> 
                    </ul>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <ol class="timeline-item-index timeline-stream single-item" data-timeline="true">
                        <tpl:loop data="media.items" id="timeline-items">
                            <li class="timeline-item-li timeline-item">
                                <div class="timeline-item-container">
                                    <tpl:condition data="summary" test="isset" value="1">
                                        <div class="timeline-item-title"><tpl:element type="text" data="summary" medialinks="true" /></div>
                                    </tpl:condition>
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a><i class="icon-${verb}"></i></a></div>
                                        <a class="publisher-profile" href="/member:${actor.uri}/profile/timeline">
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
                                            <li class="action-like">
                                                <span class="rating">
                                                    <span class="star"><input type="radio" name="rating" value="5" /></span>
                                                    <span class="star"><input type="radio" name="rating" value="4" /></span>
                                                    <span class="star"><input type="radio" name="rating" value="3" /></span>
                                                    <span class="star active"><input type="radio" name="rating" value="2" checked="" /></span>
                                                    <span class="star"><input type="radio" name="rating" value="1" /></span>
                                                </span>
                                            </li>
                                            <li class="action-fans"><a href="/system/media/timeline/fans/${uri}"><span class="average" title="See Fans">8.9</span><span class="total">/10</span></a></li>
                                            <tpl:condition data="target_count" test="isset" value="1">
                                                <li class="action-comments"><a href="/system/media/timeline/view/${uri}#comments"><span class="delete" title="See Comments"><tpl:element type="text" formatting="sprintf" cdata="%d Replies" data="target_count"  /></span></a></li>
                                            </tpl:condition>
                                            <li class="action-edit"><a href="/system/media/timeline/edit/${uri}"><span class="edit" title="Delete">Edit</span></a></li>
                                            <li class="action-delete pull-right"><a href="/system/media/timeline/delete/${uri}"><span class="delete" title="Delete">Trash</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </tpl:loop> 
                    </ol>     
<!--                    <div class="stream-alerts"></div>-->
                    <div class="stream-widgets">
                        <div class="widget">
                            <div class="widget-head"><span class="widget-title">References and Relationship Network</span></div>
                            <div data-graph="livingstone.fultang" id="xsUabo-graph"></div>
                        </div>
                    </div>
                    <tpl:import layout="forms/comment" /> 
                    <div class="stream-comments margin-top" id="comments"><tpl:import layout="media/timeline" /></div>
                    <div class="stream-more"><tpl:import layout="pagination" /></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javaScript" src="/${config|design.template}/assets/js/d3.v3.min.js"></script>
    <script type="text/javaScript" src="/${config|design.template}/assets/js/budkit-graph.js"></script>
</tpl:layout>