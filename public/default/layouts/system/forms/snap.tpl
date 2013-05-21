<tpl:layout  xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">
        <form action="/system/content/create" method="POST" class="form-vertical"  enctype="multipart/form-data">
            <div class="clearfix">
                <a class="btn">Snap Photo</a>
                <a class="btn">Record Video</a>
                <a class="btn">Record Audio</a>
            </div>
            <hr />
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
               Snap with WebCam
            </tpl:condition>
            <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                <div class="alert alert-warning">
                    <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
                </div>
            </tpl:condition>
        </form>
    </div>
</tpl:layout>