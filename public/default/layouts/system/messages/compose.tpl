<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <div class="message-header"><div class="page-header"><h1 class="margin-top-zero"><tpl:element type="text" data="page.title" /></h1></div></div> 
                    <div class="timeline-item-publisher-box">  
                        <div class="timeline-item-publisher margin-bottom-half" id="article-form">
                            <form action="/system/message/create" class="no-margin form-vectical" method="POST" enctype="multipart/form-data">
                                <fieldset class="no-bottom-margin">
                                    <div class="control-group">
                                        <label class="control-label">To:</label>
                                        <div class="controls row-fluid">           
                                            <input type="text" name="message_participants"  class="span12 margin-bottom-zero" />
                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <label class="control-label">Subject (optional)</label>
                                        <div class="controls row-fluid">           
                                            <input type="text" name="message_subject" class="span12 margin-bottom-zero"  />
                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <label class="control-label">Express yourself</label>
                                        <div class="controls">
                                            <textarea class="input-100pct focused"
                                                      data-stylesheet="http://${config|general.host}${config|general.path}public/default/assets/css/editor.css"
                                                      data-target="budkit-editor"  rows="15" name="message_body">
                                            </textarea>
                                        </div> 
                                    </div>
                                    <div class="bucket margin-top-half" data-src="${config|general.path}system/media/attachments/"></div>
                                    <div class="btn-toolbar margin-bottom-zero"> 
                                        <div class="btn-group pull-right">
                                            <button type="submit" class="btn" href="#">Send</button>  
               
                                        </div>   
                                        <div class="btn-group no-margin">
                                            <input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Upload Files" autoload="" />
                                            <!--                            <a class="btn">Chose from existing</a>-->
                                        </div>
                                    </div>              
                                </fieldset>
                                <input type="hidden" name="${uploadprogress}" value="timelineupload" />
                                <input type="hidden" name="media_author_id" value="" />
                                <input type="hidden" name="media_verb" value="message" />
                                <input type="hidden" name="media_provider" value="budkit" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>