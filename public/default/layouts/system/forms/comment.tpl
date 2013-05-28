<tpl:layout  xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/media/timeline/create" class="no-margin" method="POST" enctype="multipart/form-data">
        <div class="timeline-item-publisher-box">
<!--            <div class="timeline-item-icon toolset"><a href="#"><i class="icon-quote-left"></i></a></div>-->
            <fieldset class="timeline-item-publisher no-bottom-margin">
                <div class="controls">
                    <textarea class="input-100pct focused"
                              data-stylesheet="http://${config|general.host}${config|general.path}public/default/assets/css/editor.css"
                              data-target="budkit-editor" rows="4" name="media_content" placeholder="Add Comment"></textarea>
                </div> 
                <div class="bucket margin-top-half" data-src="${config|general.path}system/media/attachments/" data-progress="${uploadprogress}"></div>
                <div class="btn-toolbar margin-bottom-zero"> 
                    <div class="btn-group">
                        <button type="submit" class="btn" href="#">Add Comment</button>  
                        <!--                        <tpl:import layout="privacylist" />-->
                    </div>
                    <div class="btn-group">
                        <input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Upload..." autoload="" />
                        <!--                            <a class="btn">Chose from existing</a>-->
                    </div>

                </div>              
            </fieldset>
        </div>
        <input type="hidden" name="${uploadprogress}" value="timelineupload" />
        <input type="hidden" name="media_target" value="${comment_target}" />
        <input type="hidden" name="media_author_id" value="" />
        <input type="hidden" name="media_verb" value="post" />
        <input type="hidden" name="media_provider" value="budkit" />
    </form>
</tpl:layout>