<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <header class="section-header clearfix">   
                <div class="message-header pull-left"><div class="page-header"><h1 class="margin-top-zero">Timeline</h1></div></div> 
                <ul class="nav nav-pills no-margin pull-right">
                    <li>
                        <div class="btn-group">
                            <a href="/system/message/refresh" class="btn" title="Mentions">@</a>
                            <a href="/system/message/refresh" class="btn" title="Following">#</a>  
                        </div>
                    </li>
                </ul>
            </header>
            <div class="section-body">
                <div class="widget naked no-margin">
                    <div class="widget-body padding-zero">
                        <ul class="stream">
                            <tpl:condition test="boolean" data="timeline.items" value="0">
                                <li class="stream-item padding">There is no activity to display :(</li>
                            </tpl:condition>
                            <tpl:loop data="timeline.items" id="message-list">
                                <li class="stream-item bottom-border">
                                    <!--<input type="checkbox" class="select" />-->
                                    <a href="/system/media/timeline/view/${uri}" class="link has-featured-img">                                   
                                        <tpl:media uri="actor.image.uri" mode="thumbnail"  class="featured-img" width="60" height="60" /> 
                                        <div class="title">
                                            <span class="auhor"><tpl:element type="text" data="actor.displayName" /></span>
                                            <span class="time"><tpl:element type="time" data="published" /></span>    
                                        </div>
                                        <tpl:condition test="isset" data="summary" value="1">
                                            <div class="subject">
                                                <tpl:element type="text" data="summary" />
                                            </div>
                                        </tpl:condition>                                  
                                        <div class="content clearfix">
                                            <tpl:element type="text" data ="content" wordlimit="10" />
                                        </div>
                                    </a>
                                </li>
                            </tpl:loop>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>
        <div class="message-view">
            <div class="stream-thread">              
                <div class="stream-body">
                    <div class="stream-view">
                        <div class="stream-thread"> 
                            <tpl:condition test="isset" data="activities.items" value="0">
                                <tpl:import layout="forms/form" app="system" /> 
                            </tpl:condition>
                            <tpl:condition test="isset" data="activities.items" value="1">
                                <div class="stream-body padding" id="timeline"> 
                                    <tpl:import layout="media/timeline" />                             
                                    <div class="stream-more margin-top">
                                        <tpl:import layout="media/comments" /> 
                                        <tpl:import layout="forms/comment" /> 
                                        <tpl:import layout="pagination" />
                                        <div class="row-fluid margin-top">
                                            <button class="btn">Load more</button>
                                        </div>
                                    </div> 
                                </div>
                            </tpl:condition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>
