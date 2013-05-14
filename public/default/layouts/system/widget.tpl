<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">  
    <div class="widget">
        <tpl:condition test="isset" data="widget.title" value="1">
            <div class="widget-head"><span class="widget-title"><tpl:element type="html" data="widget.title" /></span></div>
        </tpl:condition>
        <div class="widget-body">
            <tpl:element type="html" data="widget.body" />
        </div>
        <tpl:condition test="isset" data="widget.footer" value="1">
            <div class="widget-footer"><tpl:element type="html" data="widget.footer" /></div>
        </tpl:condition>
    </div>
</tpl:layout>