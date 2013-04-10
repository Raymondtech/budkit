<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <tpl:condition data="gallery.hideheader" test="boolean" value="0">
            <div class="clearfix">
                 <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="tasklisttoggler">
                    <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                    <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                </ul>
                <ul class="nav nav-pills no-margin">
                    <li class="highlighted"><a href="/system/media/create" >Add New Tasks</a></li>
                </ul>
            </div>
            <hr />
        </tpl:condition>
        <div class="widget">
            <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="page.title">Media Gallery</tpl:element></span></div>
            <div class="widget-body">
                <ul class="media-grid media-gallery tasks">
                    <li class="mgrow-fluid grid-hide list-header">
                        <div class="feature grid-hide mgcol1">
                            
                        </div>   
                        <div class="name grid-hide mgcol6">
                            <strong>Title</strong>
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
                        <li class="mgrow-fluid task-item">
                            <div class="feature mgcol1">               
                                <label class="checkbox margin-top-zero">
                                    <input type="checkbox" /><span class="label label-warning">Upcoming</span>
                                </label>
                                <tpl:media uri="object_uri"  type="attachment_type" link="true" mode="icon" url="attachment_url" class="media-item list-hide" name="attachment_name"  width="170" height="170" />
                            </div>   
                            <div class="name grid-hide mgcol6">
                                <strong><tpl:element type="text" data="attachment_title"/></strong>
                                <span class="help-block"><tpl:element type="text" data="attachment_size"/></span>
                            </div>
                            <div class="kind grid-hide mgcol2">
                                <tpl:element type="text" data="attachment_type"/>
                            </div>
                            <div class="modified grid-hide mgcol2">
                                <tpl:element type="time" data="object_created_on"/>
                            </div>
                            <div class="actions grid-hide mgcol1">
                                <a href="#" class="btn btn-small">Complete</a>
                            </div>
                        </li>
                    </tpl:loop>
                </ul>  
            </div>
        </div>
        <tpl:import layout="pagination" />
    </div>

</tpl:layout>