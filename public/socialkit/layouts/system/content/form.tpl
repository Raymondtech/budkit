<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST" class="form-horizontal">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Choose File</tpl:i18n></label>
                    <div class="controls fileupload fileupload-new input" data-provides="fileupload">
                        <div class="input-prepend input-append">
                            <span class="add-on"><i class="icon icon-camera-retro"></i></span>
                            <input type="file" data-label="Select Photo" data-target="budkit-uploader" />
                            <div class="btn-group">
                                <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                        <a class="help-block" href="#">Add more</a>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Upload from URL</tpl:i18n></label>
                    <div class="controls">
                        <input type="text" name="options[general][site-name]"  class="input-xxlarge"  value="http://" />                       
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="article-title">Photo Title</label>
                    <div class="controls">
                        <input type="text" name="article-title"  class="input-xxlarge"  placeholder="Optional" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Caption</tpl:i18n></label>
                    <div class="controls">
                        <textarea class="input-xxlarge focused" rows="5" name="post_content" placeholder="Optional"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="article-title">Add to Collection</label>
                    <div class="controls">
                        <select name="article-title">
                            <option>Collection 1</option>
                            <option>Collection 2</option>
                            <option>Collection 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="btn-toolbar  no-margin">
                        <div class="btn-group">
                            <button type="submit" class="btn" href="#">Upload Photo(s)</button>    
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