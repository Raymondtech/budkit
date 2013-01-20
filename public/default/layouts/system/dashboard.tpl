<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition data="dashboard.title" test="boolean" value="1"> 
        <div class="page-header box-padding no-margin">
            <h1><tpl:element type="text" data="dashboard.title" /></h1>
        </div>
    </tpl:condition> 
    <tpl:block data="page.block.dashboard" />
    
</tpl:layout>
