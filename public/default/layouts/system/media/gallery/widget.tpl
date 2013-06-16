<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">            
    <ul class="stream media-grid media-gallery compensate-margins">
        <tpl:loop data="gallery.items" id="gallery-items">
            <li class="mgrow-fluid">
                <div class="feature mgcol1 list-hide">
                    <tpl:media uri="object_uri" link="true" mode="detailed"  class="media-item" width="170" height="170" /> 
                </div>   
                <!--<input type="checkbox" class="select" />-->
                <a href="/system/media/attachments/view/${object_uri}" class="grid-hide has-featured-img padding-bottom-zero padding-top-zero link ${message_status}">
                    <tpl:media uri="object_uri" mode="icon"  class="featured-img" width="65" height="65" /> 
                    <div class="title">
                        <span class="auhor"><tpl:element type="text" data="message_author.user_full_name" /></span>
                        <span class="time"><tpl:element type="time" data="object_created_on"/></span>    
                    </div>

                    <div class="subject">
                        <tpl:element type="text" data="attachment_title"/>
                    </div>
                    <div class="content clearfix">
                        <tpl:element type="text" data="attachment_type"/>
                        <span class="help-block margin-zero"><tpl:element type="text" data="attachment_size"/></span>
                    </div>
                </a>
            </li>
        </tpl:loop>
    </ul>  
</tpl:layout>