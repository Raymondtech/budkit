<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <div class="clearfix">
            <tpl:condition data="workspaces.items" test="isset" value="1">
                <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="project-gridtoggler">
                    <li class="active"><a data-target=".project-media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                    <li><a data-target=".project-media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                </ul>
            </tpl:condition>
            <div class="btn-group pull-left no-margin">
                <a class="btn-important btn" href="/campus/workspace/create" >Create Workspace</a>
            </div>

        </div>
        <hr />
        <tpl:condition data="workspaces.items" test="isset" value="0">
            <p class="placeholder-text">You currently are not participating in any workspace. Create A workspace.</p>
        </tpl:condition>
        <tpl:condition data="workspaces.items" test="isset" value="1">
            <div class="widget">
                <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="page.title">Workspace Gallery</tpl:element></span></div>
                <div class="widget-body">
                    <ul class="media-grid project-media-gallery  compensate-margins">
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
                        <tpl:loop data="workspaces.items" id="project-lists">
                            <li class="mgrow-fluid">   
                                <div class="mgitem project-description mgcol5">
                                    <a href="/campus/workspaces/workspace:${object_uri}/overview"><img class="list-hide margin-bottom-zero" src="${workspace_cover_photo}" /></a>
                                    <div class="progress progress-danger  mini-bar list-hide">
                                        <div class="bar" style="width: 10%;"></div>
                                    </div>
                                    <div class="description margin-top-half">
                                        <a href="/campus/workspaces/workspace:${object_uri}/overview"><strong><tpl:element type="text" data="workspace_name" /></strong></a>
                                        <span class="help-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                    </div>
                                </div>
                                <div class="grid-hide mgcol2">
                                    <span class="rating">
                                        <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span>
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
                                    <a href="#" class="btn btn-small">View</a>
                                </div>
                            </li>
                        </tpl:loop>
                    </ul>  
                </div>
            </div>
            <tpl:import layout="pagination" />
        </tpl:condition>
    </div>

</tpl:layout>