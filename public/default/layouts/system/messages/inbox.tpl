<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <header class="section-header clearfix">
                <div class="pull-left"><div class="page-header"><h1 class="margin-top-zero">Inbox</h1></div></div> 
                <ul class="nav nav-pills no-margin pull-right">
                    <li>
                        <div class="btn-group">
                            <a href="/system/message/refresh" class="btn"><i class="icon-rotate-left"/></a>
                        </div>
                    </li>
                </ul>
            </header>
            <div class="section-footer">Some Items</div>
            <div class="section-body">
                <div class="widget naked no-margin">
                    <div class="widget-body padding-zero">
                        <ul class="stream">
                            <tpl:condition test="boolean" data="messages.totalItems" value="0">
                                <li class="stream-item padding">Your inbox is empty :)</li>
                            </tpl:condition>
                            <tpl:loop data="messages.items" id="message-list">
                                <li class="stream-item bottom-border">
                                    <!--<input type="checkbox" class="select" />-->
                                    <a href="/system/message/inbox/${object_uri}" class="link has-featured-img ${message_status}">                                   
                                        <tpl:media uri="message_author.user_photo" mode="thumbnail"  class="featured-img" width="60" height="60" /> 
                                        <div class="title">
                                            <span class="auhor"><tpl:element type="text" data="message_author.user_full_name" /></span>
                                            <span class="time"><tpl:element type="time" data="object_updated_on" /></span>    
                                        </div>
                                        <tpl:condition test="isset" data="message_subject" value="1">
                                            <div class="subject">
                                                <tpl:element type="text" data="message_subject" />
                                            </div>
                                        </tpl:condition>                                  
                                        <div class="content clearfix">
                                            <tpl:element type="text" data ="message_body" wordlimit="10" />
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
                                <header class="section-header clearfix">
                                    <ul class="nav nav-pills no-margin">
                                        <li>
                                            <div class="btn-group">
                                                <a href="/system/message/create" class="btn btn-important   ">Compose</a>
                                            </div>
                                        </li>
                                    </ul>
                                </header>
                            </tpl:condition>
                            <tpl:condition test="isset" data="activities.items" value="1">              
                                <div class="stream-body padding" id="timeline">            
                                    <tpl:import layout="media/timeline" />
                                    <tpl:import layout="input" />   
                                </div>
                            </tpl:condition>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</tpl:layout>