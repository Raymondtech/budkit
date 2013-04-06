<tpl:layout name="inputsettings" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/media/timeline/create" class="comment-form" method="POST" enctype="multipart/form-data">
        <div class="timeline-item-publisher-box">
            <fieldset class="no-margin">
                <div class="controls">
                    <textarea class="input-100pct focused" data-target="budkit-editor" rows="2" name="media_content" placeholder="Enter your reply..."></textarea>
                </div> 
                <div class="bucket" data-src="${config|general.path}system/media/attachments/" data-progress="${uploadprogress}"></div>
                <div class="btn-toolbar margin-bottom-zero hide"> 
                    <div class="btn-group">
                        <button type="submit" class="btn" href="#">Reply</button>  
                    </div>   
                    <!--<div class="btn-group no-margin">
                        <input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Upload Files" autoload="" />
                            <a class="btn">Chose from existing</a>
                    </div>-->
                </div>              
            </fieldset>
        </div>
        <input type="hidden" name="${uploadprogress}" value="timelineupload" />
        <input type="hidden" name="media_author_id" value="" />
        <input type="hidden" name="media_verb" value="post" />
        <input type="hidden" name="media_provider" value="budkit" />
    </form>
</tpl:layout>