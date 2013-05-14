<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="clearfix padding">
        <ul class="nav nav-pills no-margin">
            <li class="highlighted">
                <a href="/settings/member/privacy"><i class="icon-lock"/> <tpl:element type="text" data="config|privacy.privacy-level" /></a>
            </li>
        </ul>
    </div>
    <hr class="margin-zero"  />
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline" style="min-height: 1000px">
                    <div class="stream-alerts"></div> 
                    <tpl:import layout="input" />  
                    <div class="stream-widgets margin-top">
                        <tpl:block data="page.block.dashwidgets" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>