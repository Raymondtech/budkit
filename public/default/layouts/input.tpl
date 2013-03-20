<tpl:layout name="inputsettings" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/media/timeline/create" class="no-margin" method="POST" enctype="multipart/form-data">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <div class="timeline-item-publisher-box">
                <div class="timeline-item-icon toolset"><a href="#"><i class="icon-plus"></i></a></div>
                <fieldset class="timeline-item-publisher no-bottom-margin">
                    <div class="controls">
                        <textarea class="input-100pct focused" data-target="budkit-editor" rows="4" name="media_content" placeholder="Say something..."></textarea>
                    </div> 
                    <div class="bucket" data-src="${config|general.path}system/media/attachments/" data-progress="${uploadprogress}"></div>
                    <div class="btn-toolbar no-margin"> 
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn" href="#">Publish</button>  
                            <tpl:import layout="privacylist" />
                        </div>   
                        <div class="btn-group no-margin">
                            <input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Upload Files" autoload="" />
                            <a class="btn">Chose from existing</a>
                        </div>
                    </div>              
                </fieldset>
            </div>
            <input type="hidden" name="${uploadprogress}" value="timelineupload" />
            <input type="hidden" name="media_author_id" value="" />
            <input type="hidden" name="media_verb" value="post" />
            <input type="hidden" name="media_provider" value="budkit" />

        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>