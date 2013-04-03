<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">Add New Content</tpl:element></a>
        </div>
    </div>
    <div class="padding">
        <form action="/system/content/create" method="POST" class="form-vertical"  enctype="multipart/form-data">
            <div class="row-fluid">
                <div class="span9">
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                        <fieldset class="no-margin bk-publisher bkeditor-fullscreen">
                            <div class="control-group">
                                <div class="controls">
                                    <textarea class="input-100pct bkeditor-typeit" toolbar="1" id="budkit-editor" rows="6" name="post_content" placeholder=""></textarea>
                                </div>
                            </div>
                             <div class="bucket" data-src="${config|general.path}system/media/attachments/" data-progress="${uploadprogress}"></div>
                            <div class="bk-publisher-actions">
                                <div class="btn-toolbar no-margin"> 
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn" href="#">Publish</button>  
                                        <tpl:import layout="privacylist" />
                                    </div>   
                                    <div class="btn-group no-margin">
                                        <input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Upload Files" autoload="" />
                                        <!--  <a class="btn">Chose from existing</a>-->
                                    </div>
                                </div>  
                            </div>
                        </fieldset>
                    </tpl:condition>
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                        <div class="alert alert-warning">
                            <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
                        </div>
                    </tpl:condition>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javaScript">
            <![CDATA[
                    !function($){        
                $('#budkit-editor').bkeditor({stylesheet: "../../../default/assets/css/editor.css"});
            }( window.jQuery );
        ]]> 
    </script>
</tpl:layout>