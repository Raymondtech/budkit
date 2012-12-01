<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <tpl:condition data="dashboard.title" test="boolean" value="1"> 
        <div class="page-header">
            <h1><tpl:element type="text" data="dashboard.title" /></h1>
        </div>
    </tpl:condition> 
    <tpl:block data="page.block.dashboard">Dashboard Content</tpl:block>
</tpl:layout>
