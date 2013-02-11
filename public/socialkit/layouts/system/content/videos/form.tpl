<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset class="timeline-item-publisher no-margin">
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Choose File</tpl:i18n></label>
                    <div class="controls fileupload fileupload-new input" data-provides="fileupload">
                        <div class="input-append">
                            <div class="uneditable-input input-xxxlarge"><i class="icon icon-film fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file add-on" rel="tooltip" data-original-title="Select File"><span class="fileupload-new"><i class="icon icon-film"></i></span><span class="fileupload-exists" rel="tooltip" data-original-title="Change File"><i class="icon icon-film"></i></span><input type="file" /></span><a href="#" class="fileupload-exists btn add-on" data-dismiss="fileupload" rel="tooltip" data-original-title="Remove"><i class="icon icon-trash"></i></a>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Upload from URL</tpl:i18n></label>
                    <div class="controls">
                        <input type="text" name="options[general][site-name]"  class="input-xxxlarge"  value="http://" />
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Caption</tpl:i18n></label>
                    <div class="controls">
                        <textarea class="input-xxxlarge focused" rows="5" name="post_content"></textarea>
                    </div>
                </div>
                <hr />
                <div class="timeline-item-publisher-actions">
                    <div class="btn-toolbar  no-margin">
                        <div class="btn-group">
                            <button class="btn"><i class="icon icon-upload"></i> Upload Multiple</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn" href="#">Publish</button>    
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