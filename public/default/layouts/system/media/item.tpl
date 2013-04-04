<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">Gallery</tpl:element></a>
        </div>
    </div>
    <div class="padding">
        <tpl:condition data="item.attachment_title" test="isset" value="1">
            <div class="widget">
                <div class="widget-body">
                    <tpl:media uri="item.object_uri" name="item.attachment_name"  type="item.attachment_type"  width="700" />             
                </div>
            </div>
        </tpl:condition>
    </div>
</tpl:layout>