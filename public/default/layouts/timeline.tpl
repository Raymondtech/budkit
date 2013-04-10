<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-list">
            <div class="widget naked">
                <div class="widget-body">
                    <ul class="nav nav-list margin-zero padding-quarter">
                        <li><a href="#">Recent</a></li>
                        <li><a href="#">Posted by me</a></li>
                        <li><a href="#">Shared with me</a></li>
                        <li><a href="#">Liked</a></li>
                        <li><a href="#">Following</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <tpl:import layout="input" />     
                    <div class="stream-alerts"><tpl:import layout="pagination" /></div>
                    <tpl:import layout="media/timeline" />
                    
                </div>
            </div>
        </div>
    </div>
</tpl:layout>