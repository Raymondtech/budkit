<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">
        <form class="form-vertical" method="post" enctype="multipart/form-data" action="/settings/member/profile/update">

            <div class="control-group clearfix">

                <div class="controls">
                    <tpl:condition data="profile.user_photo" test="isset" value="1">
                        <img class="add-on thumbnail pull-left margin-right" src="http://localhost/~livingstonefultang/public/default/themes/default/thumbnail.png" />
                    </tpl:condition>
                    <strong>Default Theme</strong>
                    <span class="help-block">By Livingstone Fultang</span>
                    <span class="help-block"><a href="/settings/member/appearance/options">Options</a></span>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <div class="controls">
                    <tpl:condition data="gallery" test="isset" value="1">
                        <div class="widget naked">
                            <div class="widget-head"><span class="widget-title">Available Themes</span></div>
                            <div class="widget-body">
                                <ul class="media-grid media-gallery compensate-margins">
                                    <tpl:loop data="gallery.items" id="themes-items">
                                        <li class="mgrow-fluid">
                                            <div class="feature mgcol1">
                                                <img class="add-on thumbnail pull-left margin-right margin-bottom-half" src="http://localhost/~livingstonefultang/public/default/themes/default/thumbnail.png" />
                                            </div>   
                                            <div class="actions mgcol1">
                                                <div class="btn-toolbar">
                                                    <a href="/system/media/attachments/view/${object_uri}" class="btn btn-small">Enable</a>
                                                </div>
                                            </div>
                                        </li>
                                    </tpl:loop>
                                </ul>  
                            </div>
                        </div>
                    </tpl:condition>
                    <tpl:condition data="gallery" test="isset" value="0">
                        <p class="placeholder-text">There are no other themes available to you at this time.</p>
                    </tpl:condition>
                </div>
            </div><!-- /control-group --> 
        </form>
    </div>

</tpl:layout>
