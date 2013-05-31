<tpl:layout  xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/content/create" method="POST" class="form-vertical"  enctype="multipart/form-data">
        <div class="clearfix">
            <p>Import content from other sources, dropbox, or from a budkit archive</p>
        </div>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <tpl:import layout="content/photos/form" />
        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>