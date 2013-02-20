<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST" class="form-horizontal">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset class="no-margin">
                <div class="control-group">
                    <label class="control-label" for="article-title">Article Title</label>
                    <div class="controls">
                        <input type="text" name="article-title"  class="input-xxxlarge"  value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Article</tpl:i18n></label>
                    <div class="controls">
                        <textarea class="input-xxxlarge focused" rows="20" name="post_content"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="middle-name">Thumbnail</label>
                    <div class="controls">
                        <div class="input-append"> 
                            <input type="file" data-label="Select Photo..." />
                            <a class="add-on btn">Chose from existing</a>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="btn-toolbar  no-margin">
                        <div class="btn-group">
                            <button type="submit" class="btn" href="#">Publish Article</button>  
                            <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i>Make Public <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div> 
                    </div>
                </div>
            </fieldset>
        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>