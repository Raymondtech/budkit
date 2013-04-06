<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
    <div class="stream-box row-fluid media-box">
        <div class="stream-list">
            <div class="widget naked">
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter">
                        <li><a href="#">200 fans</a></li>
                        <li><a href="#">12 Collections</a></li>
                        <li><a href="#">Share</a></li>
                        <li><a href="#">Like</a></li>
                        <li><a href="#">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <ol class="timeline-item-index timeline-stream single-item">
                        <li class="timeline-item-li timeline-item">
                            <div class="timeline-item-container">
                                <div class="timeline-item-header">
                                    <div class="timeline-item-icon"><a href="#"><i class="icon-${verb}"></i></a></div>
                                    <a class="publisher-profile" href="#">
                                        <img class="profile-avatar thumbnail" src="${actor.image.url}" alt="${actor.displayName}" width="${actor.image.width}" height="${actor.image.height}" />
                                        <strong class="profile-name"><tpl:element type="text" data="actor.displayName" /></strong>                              
                                    </a>
                                    <a href="/system/media/timeline/view/${uri}" title="${published}" class="published-time"><tpl:element type="time" data="published" /></a>
                                    <div class="timeline-item-title"><strong>Item Title</strong></div>
                                </div>
                                <tpl:condition data="item" test="isset" value="1">
                                    <tpl:condition data="item.objectType" test="isnot" value="collection">
                                        <div class="timeline-item-media clearfix">                                   
                                            <tpl:media uri="item.object_uri" name="item.attachment_name" type="item.attachment_type"></tpl:media>             
                                        </div>
                                    </tpl:condition>
                                    <tpl:condition data="object.objectType" test="equals" value="collection">
                                        <div class="timeline-item-media">	  	
                                            <ul class="media-grid bottom-media clearfix">	  	
                                                <tpl:loop data="object.items" id="media-items">
                                                    <li><tpl:media uri="uri" link="true" class="media-item" name="name"  data-target="budkit-slider" width="170" height="170" /></li>
                                                </tpl:loop> 	
                                            </ul>  	
                                        </div>
                                    </tpl:condition>

                                </tpl:condition>

                            </div>
                        </li>
                    </ol>
                    <tpl:import layout="input" />     
                    <div class="stream-alerts"></div>
                    <tpl:import layout="media/timeline" />
                </div>
            </div>
        </div>
    </div>
</tpl:layout>