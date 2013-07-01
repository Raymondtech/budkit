<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <header class="section-header clearfix">
                <div class="pull-left"><div class="page-header"><h1 class="margin-top-zero">People</h1></div></div> 
                <tpl:condition data="gallery" test="isset" value="1">
                    <ul class="nav nav-pills pull-right nav-mediagrid no-margin" id="memberstoggler">
                        <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                        <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                    </ul>
                </tpl:condition>
            </header>
            <div class="section-menu">
                <tpl:menu id="peoplemenu" type="nav-pills" />
            </div>
            <div class="section-body">
                <tpl:condition data="gallery" test="isset" value="1">
                    <ul class="stream media-grid media-gallery compensate-margins">
                        <tpl:loop data="gallery.members" id="gallery-items">
                            <li class="mgrow-fluid padding-zero">
                                <div class="feature mgcol1 list-hide">
                                    <tpl:media uri="user_photo" link="true" mode="detailed"  class="media-item" width="170" height="170" /> 
                                </div>   
                                <!--<input type="checkbox" class="select" />-->
                                <a href="#" class="grid-hide has-featured-img link ${message_status}">
                                    <tpl:media uri="user_photo" mode="icon"  class="featured-img" width="65" height="65" /> 
                                    <div class="title">
                                        <span class="auhor"><strong><tpl:element type="text" data="user_first_name"/></strong> <tpl:element type="text" data="user_last_name"/></span>
                                        <span class="time"><tpl:element type="text" data="object_status"/></span>    
                                    </div>
                                    <div class="content clearfix">
                                        <tpl:element type="text" data="object_uri" formatting="sprintf" cdata="@%s"/>
                                        <span class="help-block margin-zero"><tpl:element type="text" data="user_email"/></span>
                                    </div>
                                </a>
                            </li>
                        </tpl:loop>
                    </ul> 
                </tpl:condition>
                <tpl:condition data="gallery" test="isset" value="0">
                    <p class="placeholder-text padding">There are no items to display in this gallery.</p>
                </tpl:condition>
            </div>
        </div>
        <div class="message-view">
            <div class="stream-thread">              

            </div>
        </div>
    </div>
</tpl:layout>