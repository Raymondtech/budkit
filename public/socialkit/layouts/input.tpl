<tpl:layout name="inputsettings" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/timeline/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <div class="timeline-item-publisher-box">
                <div class="timeline-item-icon toolset"><a href="#"><i class="icon-plus"></i></a></div>
                <fieldset class="timeline-item-publisher no-bottom-margin">
                    <div class="controls">
                        <textarea class="input-100pct focused" data-target="budkit-editor" rows="4" name="activity_content" placeholder="Say something..."></textarea>
                    </div>
                    <div class="btn-toolbar no-margin"> 
                        <button class="btn pull-right" type="submit">Submit</button>   
                        <a href="/system/content/attachments/upload.raw" class="btn pull-left no-margin" data-toggle="modal" data-target="#upload-tool"><i class="icon icon-paper-clip"></i> Add files</a>
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