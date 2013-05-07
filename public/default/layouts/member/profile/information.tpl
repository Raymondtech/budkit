<tpl:layout  name="start" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="widget-bucket padding" id="widget-bucket-1">
        <tpl:condition data="profile.user_biography" test="isset" value="1">
            <div class="widget">
                <div class="widget-head"><span class="widget-title">Biography</span><a class="widget-close" data-dismiss="widget">HIDE</a></div>
                <div class="widget-body">
                    <tpl:element type="html" data="profile.user_biography" medialinks="true" />
                </div>
            </div>
        </tpl:condition>
        <tpl:condition data="followers" test="isset" value="1">
            <div class="widget">
                <div class="widget-head">
                    <span class="widget-title">Followers</span>
                    <ul class="nav nav-pills pull-right nav-mediagrid no-margin" id="followerstoggler">
                        <li class="active"><a data-target="#followers-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                        <li><a data-target="#followers-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                    </ul>
                </div>
                <div class="widget-body">
                    <ul class="media-grid compensate-margins" id="followers-gallery">
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
                        <tpl:loop data="followers.members" id="gallery-items">
                            <li class="mgrow-fluid">
                                <div class="feature mgcol2">
                                    <tpl:condition data="user_photo" test="isset" value="1">
                                        <a href="/member:${user_name_id}/profile/information" class="profile-link">
                                            <img src="/system/object/${user_photo}/resize/100/100"  />
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
                                </div>
                            </li>
                        </tpl:loop>
                    </ul>
                </div>
                <div class="widget-footer"><a href="/member:${profile.user_name_id}/profile/followers" >View All Followers</a></div>                    
            </div>
        </tpl:condition>
        <tpl:condition data="following" test="isset" value="1">
            <div class="widget">
                <div class="widget-head">
                    <span class="widget-title">Following</span>
                    <ul class="nav nav-pills pull-right nav-mediagrid no-margin" id="followingtoggler">
                        <li class="active"><a data-target="#following-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                        <li><a data-target="#following-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                    </ul>
                </div>
                <div class="widget-body">
                    <ul class="media-grid compensate-margins" id="following-gallery">
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
                        <tpl:loop data="following.members" id="gallery-items">
                            <li class="mgrow-fluid">
                                <div class="feature mgcol2">
                                    <tpl:condition data="user_photo" test="isset" value="1">
                                        <a href="/member:${user_name_id}/profile/information" class="profile-link">
                                            <img src="/system/object/${user_photo}/resize/100/100"  />
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
                                    <a href="/member/network/relation/unfollow/${user_name_id}" class="btn btn-small">Unfollow</a>
                                </div>
                            </li>
                        </tpl:loop>
                    </ul>
                </div>
                <div class="widget-footer"><a href="/member:${profile.user_name_id}/profile/following" >View All Following</a></div>
            </div>
        </tpl:condition>
    </div>        
</tpl:layout>