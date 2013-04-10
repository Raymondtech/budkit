<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">
        <form action="/system/content/create" method="POST" class="form-vertical"  enctype="multipart/form-data">
            <div class="clearfix">
               <p>Drag and drop files from your computer to upload. Can't upload? <a href="/system/content/create/import">Try importing.</a> You can also <a href="/system/content/create/snap">record videos or audio</a> with your webcam if supported </p>
            </div>
            <hr />
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
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
            </tpl:condition>
            <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                <div class="alert alert-warning">
                    <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
                </div>
            </tpl:condition>
        </form>
    </div>
</tpl:layout>