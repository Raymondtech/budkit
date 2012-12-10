<tpl:layout name="adminbar" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <tpl:element type="text" data="upload.title" />
    <form class="form-vectical upload-form" action="index.php" method="post" enctype="multipart/form-data" data-target="budkit-uploader">
        <div id="upload-dropbox" align="center">
            <div class="upload-drop clearfix">
                <div class="upload-prompt">Drop files here to upload</div>
            </div>
            <input type="file" name="upload-files[]" class="upload-selected-files hide" multiple="true" />
            <div class="form-actions">
                <div class="btn-group pull-left">
                    <button class="btn upload-select">Select files..</button>
                    <button class="btn upload-url">Upload from a URL</button>
                </div>
                <button class="btn btn-primary pull-right upload-start" type="submit">Upload</button>
            </div>
        </div>
    </form>
     <script type="text/javaScript">
       <![CDATA[
           !function($){
                $('[data-target="budkit-uploader"]').bkuploader();
            }( window.jQuery );
        ]]>
    </script>
</tpl:layout>