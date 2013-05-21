<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/media/timeline/create" class="no-margin" method="POST" enctype="multipart/form-data">
        <fieldset class="no-bottom-margin">
            <div class="controls">
                <textarea class="input-100pct focused" 
                          data-target="budkit-editor" 
                          data-stylesheet="http://${config|general.host}/${config|general.path}public/default/assets/css/editor.css"
                          rows="4" name="media_content" placeholder="">
                    <tpl:element type="html" data="content" medialinks="true" />
                </textarea>
            </div> 
            <div class="status-bucket margin-top-half" data-src="${config|general.path}system/media/attachments/"></div>
            <div class="btn-toolbar margin-bottom-zero"> 
                <div class="btn-group pull-right">
                    <button type="submit" class="btn" href="#">Publish</button>  
                    <tpl:import layout="privacylist" />
                </div>   
                <div class="btn-group no-margin">
                    <input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".status-bucket" data-label="Upload Files" autoload="" />
                    <!--                            <a class="btn">Chose from existing</a>-->
                </div>
            </div>              
        </fieldset>
        <input type="hidden" name="${uploadprogress}" value="timelineupload" />
        <input type="hidden" name="media_target" value="${mediatarget}" />
        <input type="hidden" name="media_author_id" value="${mediaauthorid}" />
        <input type="hidden" name="media_verb" value="${mediaverb}" />
        <input type="hidden" name="media_provider" value="${mediaprovider}" />
    </form>
</tpl:layout>