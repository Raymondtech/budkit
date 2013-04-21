<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <div class="clearfix">
            <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="photogridtoggler">
                <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
            </ul>
            <ul class="nav nav-pills no-margin">
                <li class="highlighted"><a href="/member/network/relation/requests" >Invite Members</a></li>
            </ul>
        </div>
        <hr />
        <div class="widget">
            <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="page.title">Media Gallery</tpl:element></span></div>
            <div class="widget-body">
                <ul class="media-grid media-gallery">
                    <li class="mgrow-fluid grid-hide list-header">
                        <div class="feature grid-hide mgcol2">
                            
                        </div>   
                        <div class="name grid-hide mgcol4">
                            <strong>Name</strong>
                        </div>
                        <div class="description grid-hide mgcol2">
                            <strong>Status</strong>
                        </div>
                        <div class="modified grid-hide mgcol2">
                            <strong>Joined</strong>
                        </div>
                        <div class="actions grid-hide mgcol2">
                            
                        </div>
                    </li>
                    <tpl:loop data="gallery.items" id="gallery-items">
                        <li class="mgrow-fluid">
                            <div class="feature mgcol2">
                                <tpl:condition data="user_photo" test="isset" value="1">
                                    <a href="/member:${user_name_id}/profile/information" class="profile-link">
                                        <img src="/system/object/${user_photo}/resize/170/170"  />
                                    </a>
                                </tpl:condition>
                            </div>   
                            <div class="name grid-hide mgcol4">
                                <strong><tpl:element type="text" data="user_first_name"/></strong> <tpl:element type="text" data="user_middle_name"/> <tpl:element type="text" data="user_last_name"/>
                                <span class="help-block"><tpl:element type="text" data="user_email"/></span>
                                <a href="/member:${user_name_id}/profile/information"><tpl:element type="text" data="object_uri" formatting="sprintf" cdata="@%s"/></a>
                            </div>
                            <div class="description grid-hide mgcol2">
                                <tpl:element type="text" data="object_status"/>
                            </div>
                            <div class="modified grid-hide mgcol2">
                                <tpl:element type="time" data="object_created_on"/>
                            </div>
                            <div class="actions grid-hide mgcol2">
                                <a href="/member/network/relation/follow/${user_name_id}" class="btn btn-small">Follow</a>
                                <a href="#" class="btn btn-small">Message</a>
                            </div>
                        </li>
                    </tpl:loop>
                </ul>  
            </div>
        </div>
        <tpl:import layout="pagination" />
    </div>
</tpl:layout>