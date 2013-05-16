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
                        <tpl:loop data="messages.items">
                            <li class="stream-item">
                                <input type="checkbox" class="select" />
                                <a href="#" class="link">
                                    <div class="subject">
                                        [Reply] More information required to complete your grant
                                    </div>
                                    <div class="title clearfix">
                                        <span class="auhor">Livingstone Fultang</span>
                                        <span class="time">10 hrs ago</span>    
                                    </div>
                                    <div class="content">
                                        And here are the contents of this message. Maximum of two lines allowed. But we sill have plenty of space to add more
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
                                <tpl:import layout="media/timeline" />  
                                <tpl:import layout="input" />  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>