<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <div class="clearfix">
            <tpl:condition data="gallery" test="isset" value="1">
                <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="memberstoggler">
                    <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                    <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                </ul>
            </tpl:condition>
            <tpl:menu id="peoplemenu" type="nav-pills" class="pull-right margin-bottom-zero margin-top-zero margin-right-half" />
            <div class="btn-group pull-left no-margin">
                <a class="btn-important btn" href="/settings/member/privacy/groups" >Edit Privacy Groups</a>
            </div>
        </div>

        <hr />
        <tpl:condition data="gallery" test="isset" value="1">
            <div class="widget">
                <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="gallery.title">Media Gallery</tpl:element></span></div>
                <div class="widget-body">
                    <ul class="media-grid media-gallery compensate-margins">
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
                        <tpl:loop data="gallery.members" id="gallery-items">
                            <li class="mgrow-fluid">
                                <div class="feature mgcol2">
                                    <tpl:condition data="user_photo" test="isset" value="1">
                                        <a href="/member:${user_name_id}/profile/information" class="profile-link">
                                            <img src="/system/object/${user_photo}/resize/170/170"  />
                                        </a>
                                    </tpl:condition>
                                </div>   
                                <div class="name grid-hide mgcol4">
                                    <strong><tpl:element type="text" data="user_first_name"/></strong> <tpl:element type="text" data="user_last_name"/>
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
        </tpl:condition>
        <tpl:condition data="gallery" test="isset" value="0">
            <p class="placeholder-text">There are no members to display in this list.</p>
        </tpl:condition>
    </div>
</tpl:layout>