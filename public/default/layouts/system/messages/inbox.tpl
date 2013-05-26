<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <div class="clearfix padding">
                <ul class="nav nav-pills no-margin">
                    <li>
                        <div class="btn-group">
                            <a href="/system/message/refresh" class="btn">
                                <i class="icon-rotate-left"/> 
                            </a>
                             <a href="/system/message/create" class="btn">
                                Compose
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <hr class="margin-zero"  />
            <div class="widget naked">
                <div class="widget-body padding-zero">
                    <ul class="stream">
                        <tpl:condition test="boolean" data="messages.totalItems" value="0">
                            <li class="stream-item padding">Your inbox is empty :)</li>
                        </tpl:condition>
                        <tpl:loop data="messages.items" id="message-list">
                            <li class="stream-item">
                                <input type="checkbox" class="select" />
                                <a href="/system/message/inbox/${object_uri}" class="link ${message_status}">
                                    <tpl:condition test="isset" data="message_subject" value="1">
                                        <div class="subject">
                                            <tpl:element type="text" data="message_subject" />
                                        </div>
                                    </tpl:condition>
                                    <div class="title clearfix">
                                        <span class="auhor"><tpl:element type="text" data="message_author.user_full_name" /></span>
                                        <span class="time"><tpl:element type="time" data="object_updated_on" /></span>    
                                    </div>
                                    <div class="content">
                                        <tpl:element type="text" data ="message_body" wordlimit="25" />
                                    </div>
                                </a>
                            </li>
                        </tpl:loop>
                    </ul>
                </div>
            </div>
        </div>
        <div class="message-view">
            <div class="stream-thread">              
                <div class="stream-body">
                    <tpl:condition test="isset" data="activities.items" value="1">
                    <div class="clearfix  padding"> 
                        <ul class="nav nav-pills no-margin">
                            <li>
                                <div class="btn-group">
                                    <a href="/settings/member/privacy" class="btn">
                                        <i class="icon-trash"/> 
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr class="margin-zero"  />
                    <div class="stream-view">
                        <div class="stream-thread">              
                            <div class="stream-body padding" id="timeline">
                                <tpl:import layout="input" /> 
                                <tpl:import layout="media/timeline" />  
                            </div>
                        </div>
                    </div>
                    </tpl:condition>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>