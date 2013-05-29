<tpl:layout  xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/content/create" method="POST" class="form-vertical margin-bottom-zero"  enctype="multipart/form-data">
        <fieldset>
            <div id="upload-dropbox">
                <div class="upload-drop clearfix">
                    <div class="upload-prompt" align="center">Drop files here to upload</div>
                    <small style="font-size: 10px; margin-top: 20px; display: block">- OR -</small>
                    <div class="upload-select" align="center"><input type="file" name="mediaobjects[]" multiple="" data-target="budkit-uploader" data-display=".bucket" data-label="Choose files to upload" autoload="" /></div>
                </div>            
            </div>
        </fieldset>
    </form>
</tpl:layout>