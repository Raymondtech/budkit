<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline">
                    <div class="timeline-item-publisher-box">  
                        <tpl:condition data="profile.user_photo" test="isset" value="1">
                            <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                            </a>
                        </tpl:condition>
                        <div class="timeline-item-icon toolset"><a><i class="icon-plus"></i></a></div>
                        <div class="timeline-item-publisher margin-bottom-half" id="article-form">
                            <form action="/system/message/create" class="no-margin" method="POST" enctype="multipart/form-data">
                                <fieldset class="no-bottom-margin">
                                    <div class="control-group">
                                        <div class="controls row-fluid">           
                                            <input type="text" name="message_participants" placeholder="Participants"  class="span12 margin-bottom-zero" value="${media_summary}" />
                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <div class="controls row-fluid">           
                                            <input type="text" name="message_subject" placeholder="Subject (optional)"  class="span12 margin-bottom-zero" value="${media_summary}" />
                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <div class="controls">
                                            <textarea class="input-100pct focused"
                                                      data-stylesheet="http://${config|general.host}${config|general.path}public/default/assets/css/editor.css"
                                                      data-target="budkit-editor" toolbar="1"  rows="20" name="message_body" placeholder="Say something...">
                                                <tpl:element type="html" data="content" medialinks="true" />
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