<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/campus/workspace/create" class="no-margin form-vectical" method="POST" enctype="multipart/form-data">
        <fieldset class="no-bottom-margin">
            <div class="control-group">
                <label class="control-label">Title <em class="mandatory">*</em></label>
                <div class="controls row-fluid">           
                    <input type="text" name="message_participants" class="span12 margin-bottom-zero" />
                </div>
            </div>  
            <div class="control-group">
                <div class="controls">
                    <label class="control-label">Privacy</label>
                    <label class="radio">
                        <tpl:input type="radio" name="workspace_privacy" checked="checked"  value="public" />
                        <strong>Public</strong> - Anyone can view and join this workspace
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="workspace_privacy"  value="public,invite" />
                        <strong>Public, Invite Only</strong> - Anyone can view, but only invited members may participate 
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="workspace_privacy"  value="private" />
                        <strong>Private</strong> - All your followers can view and join this workspace 
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="workspace_privacy"  value="private,invite" />
                        <strong>Private, Invite Only</strong> - All your followers can view, but only invited followers may participate 
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="workspace_privacy"  value="hidden" />
                        <strong>Hidden</strong> - Only you can use this workspace 
                    </label>
                </div>
            </div><!-- /control-group -->  
            <hr />
            <div class="control-group">
                <label class="control-label">Short description <em class="mandatory">*</em></label>
                <div class="controls row-fluid">           
                    <textarea class="span12" rows="5"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Detailed description</label>
                <div class="controls">
                    <textarea class="input-100pct focused"
                              data-stylesheet="http://${config|general.host}${config|general.path}public/default/assets/css/editor.css"
                              data-target="budkit-editor"  rows="10" name="message_body">
                    </textarea>
                </div> 
            </div>
            <div class="btn-toolbar margin-bottom-zero"> 
                <div class="btn-group">
                    <button type="submit" class="btn" href="#">Create Workspace</button>  
                </div>   
                <div class="btn-group">
                    <input type="file" name="coverphoto" data-label="Select Cover Photo..." data-target="budkit-uploader" /> 
                </div>
            </div>              
        </fieldset>
        <input type="hidden" name="${uploadprogress}" value="timelineupload" />
    </form>
</tpl:layout>