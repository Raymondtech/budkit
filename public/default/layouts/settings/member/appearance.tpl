<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">
        <form class="form-vertical" method="post" enctype="multipart/form-data" action="/settings/member/appearance/update">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">Cover photo URL</label>
                    <div class="controls">
                        <div class="input-append">
                            <input class="input-xxlarge" id="cover-photo" name="appearance[cover-photo]" type="text"  value="${config|appearance.cover-photo}" />
                        </div>
                    </div>
                </div><!-- /control-group -->
                <hr />
                <div class="control-group">
                    <div class="controls">
                        <tpl:condition data="themes" test="isset" value="1">
                            <div class="widget naked">
                                <div class="widget-head"><span class="widget-title">Available Themes</span></div>
                                <div class="widget-body">
                                    <ul class="media-list media-gallery compensate-margins">
                                        <tpl:loop data="themes.items" id="themes-items">
                                            <li class="mgrow-fluid">
                                                <div class="feature mgcol5">                           
                                                    <label class="radio pull-left">
                                                        <tpl:input type="radio" name="appearance[theme]"  data="config|appearance.theme" data-value="name" />
                                                    </label>
                                                    <img class="add-on thumbnail margin-right margin-bottom-half" src="${thumbnail}" />
                                                </div>   
                                            </li>
                                        </tpl:loop>
                                    </ul>  
                                </div>
                            </div>
                        </tpl:condition>
                        <tpl:condition data="themes.items" test="isset" value="0">
                            <p class="placeholder-text">There are no other themes available to you at this time.</p>
                        </tpl:condition>
                    </div>
                </div><!-- /control-group --> 
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn">Save changes</button>
            </div>
        </form>
    </div>

</tpl:layout>
