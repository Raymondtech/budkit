<tpl:layout name="inputsettings" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <div class="timeline-item-publisher-box">
                <fieldset class="timeline-item-publisher no-bottom-margin">
                    <div class="controls">
                        <textarea class="input-xxxlarge focused" data-target="budkit-editor" rows="1" name="activity_content" placeholder="Share something new with your followers..."></textarea>
                    </div>
                    <div class="no-bottom-margin half-top-pad">    
                        <ul class="nav nav-pills pull-left no-margin">
                            <li><a href="/system/content/attachments/upload.raw" class="no-left-padding" data-toggle="modal" data-target="#upload-tool"><i class="icon icon-paper-clip"></i> Add files</a></li>
                            <li><a href="/system/content/attachments/upload.raw" data-toggle="modal" data-target="#upload-tool"><i class="icon icon-photo-camera icon-16"></i> Add Photos</a></li>
                        </ul>
                        <ul class="nav nav-pills pull-right no-margin">
                            <li><button class="btn btn-primary" type="submit">Submit</button></li>
                        </ul>
                        
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="activity_author_id" value="" />
            <input type="hidden" name="activity_verb" value="post" />
            <input type="hidden" name="activity_provider" value="budkit" />

        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>