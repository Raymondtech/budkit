<tpl:layout name="inputsettings" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
        <div class="timeline-item-publisher-box">    
            <div class="timeline-item-icon toolset"><a><i class="icon-plus"></i></a></div>
            <div class="timeline-item-publisher margin-bottom-half">
                <ul class="nav nav-tabs-launcher" id="status-tabs">
                    <li><strong>Share:</strong></li>
                    <li><a href="#status-form" data-toggle="tab"><i class="icon-quote-left"></i> Status</a></li>
                    <li><a href="#article-form" data-toggle="tab"><i class="icon-file-alt"></i> Article</a></li>
                    <li><a href="#uploads-form" data-toggle="tab"><i class="icon-file"></i> Uploads</a></li>
                    <li><a href="#events-form" data-toggle="tab"><i class="icon-calendar"></i> Event</a></li>
                    <li><a href="#task-form" data-toggle="tab"><i class="icon-check"></i> Task(s)</a></li>
                </ul>
                <div class="tab-content tabs-launcher">
                    <div class="tab-pane" id="status-form">
                        <form action="/system/media/timeline/create" class="no-margin" method="POST" enctype="multipart/form-data">
                            <fieldset class="no-bottom-margin">
                                <div class="controls">
                                    <textarea class="input-100pct focused" 
                                              data-target="budkit-editor" 
                                              data-stylesheet="http://${config|general.host}${config|general.path}public/default/assets/css/editor.css"
                                              rows="4" name="media_content" placeholder="Say something...">
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
                            <input type="hidden" name="media_author_id" value="" />
                            <input type="hidden" name="media_verb" value="post" />
                            <input type="hidden" name="media_provider" value="budkit" />
                        </form>
                    </div>
                    <div class="tab-pane" id="article-form">
                        <tpl:import layout="media/form/editor" />
                    </div>
                    <div class="tab-pane" id="uploads-form">
                        <tpl:import layout="media/form/drop" />
                    </div>
                </div>
            </div>
        </div>
    </tpl:condition>
    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
        <div class="alert alert-warning">
            <a href="/system/authenticate/login">Login now</a> to Comment or Share a story from your current location, or upload photos 
        </div>
    </tpl:condition>
</tpl:layout>