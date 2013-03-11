<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">Add New Content</tpl:element></a>
        </div>
    </div>
    <div class="padding">
        <form action="/system/content/create" method="POST" class="form-vertical"  enctype="multipart/form-data">
            <div class="clearfix">
                <ul class="nav nav-pills no-margin">
                    <ul class="nav nav-pills no-margin" id="mediatypemenu">
                        <li class="active"><a data-target="#dragdrop" data-toggle="tab">Drag and Drop</a></li>  
                        <li><a data-target="#typeit" data-toggle="tab">Type in Text</a></li>
                        <li><a data-target="#snapit" data-toggle="tab">Snap with WebCam</a></li>
                        <li><a data-target="#import" data-toggle="tab">Import from URL</a></li>
                    </ul>
                </ul>
            </div>
            <hr />
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                <div class="tab-content">
                    <div class="tab-pane" id="typeit">
                        <fieldset class="no-margin">
                            <div class="control-group">
                                <div class="controls">
                                    <textarea class="input-100pct focused" rows="20" name="post_content" data-target="budkit-editor" placeholder="Say something..."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="btn-toolbar  no-margin">
                                    <div class="btn-group">
                                        <button type="submit" class="btn" href="#">Publish Article</button>  
                                        <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i>Make Public <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div> 
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="tab-pane" id="snapit">
                        <tpl:import layout="content/photos/form" />
                    </div>
                    <div class="tab-pane" id="import">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="options[general][site-name]"><tpl:i18n>URL</tpl:i18n></label>
                                <div class="controls">
                                    <input type="text" name="options[general][site-name]"  class="input-xxlarge"  value="http://" />                       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="article-title">Title</label>
                                <div class="controls">
                                    <input type="text" name="article-title"  class="input-xxlarge"  placeholder="Optional" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="options[general][site-name]"><tpl:i18n>Caption</tpl:i18n></label>
                                <div class="controls">
                                    <textarea class="input-xxlarge focused" rows="5" name="post_content" placeholder="Optional"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="btn-toolbar  no-margin">
                                    <div class="btn-group">
                                        <button type="submit" class="btn" href="#">Import</button>    
                                    </div>                   
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="tab-pane active" id="dragdrop">
                        <fieldset>
                            <div id="upload-dropbox">
                                <div class="upload-drop clearfix">
                                    <div class="upload-prompt" align="center">Drop files here to upload</div>
                                    <div class="upload-select" align="center"><input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Select files" autoload="" /></div>
                                </div>            
                            </div>
                            
                        </fieldset>
                    </div>
                </div>
            </tpl:condition>
            <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                <div class="alert alert-warning">
                    <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
                </div>
            </tpl:condition>
        </form>
    </div>
</tpl:layout>