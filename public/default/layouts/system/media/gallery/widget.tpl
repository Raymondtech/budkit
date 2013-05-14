<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">            
    <ul class="media-grid media-gallery compensate-margins">
        <li class="mgrow-fluid grid-hide list-header">
            <div class="feature grid-hide mgcol1">

            </div>   
            <div class="name grid-hide mgcol4">
                <strong>Title</strong>
            </div>
            <div class="grid-hide mgcol2">
                <strong>Rating</strong>
            </div>
            <div class="kind grid-hide mgcol2">
                <strong>Kind</strong>
            </div>
            <div class="modified grid-hide mgcol2">
                <strong>Created</strong>
            </div>
            <div class="actions grid-hide mgcol1">

            </div>
        </li>
        <tpl:loop data="gallery.items" id="gallery-items">
            <li class="mgrow-fluid">
                <div class="feature mgcol1">
                    <tpl:media uri="object_uri" link="true" mode="icon"  class="media-item" width="170" height="170" /> 
                </div>   
                <div class="name grid-hide mgcol4">
                    <strong><tpl:element type="text" data="attachment_title"/></strong>
                    <span class="help-block"><tpl:element type="text" data="attachment_size"/></span>
                </div>
                <div class="grid-hide mgcol2">
                    <span class="rating">
                        <span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span>
                    </span>
                    <a href="#"><span class="help-block">0 comments</span></a>
                </div>
                <div class="kind grid-hide mgcol2">
                    <tpl:element type="text" data="attachment_type"/>
                </div>
                <div class="modified grid-hide mgcol2">
                    <tpl:element type="time" data="object_created_on"/>
                </div>
                <div class="actions grid-hide mgcol1">
                    <a href="/system/media/attachments/view/${object_uri}" class="btn btn-small">View</a>
                </div>
            </li>
        </tpl:loop>
    </ul>  
</tpl:layout>