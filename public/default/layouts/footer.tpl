<tpl:layout name="footer" xmlns:tpl="http://budkit.org/tpl">
    <section role="footer">
        <tpl:block data="page.block.footer">Footer</tpl:block>
        <div class="row-fluid">
            <div class="span8">
                <ul class="nav nav-pills">
                    <li><a href="/system/admin/index">Administrator</a></li>
                    <li><a href="http://budkit.org/documentation">Documentation</a></li>
                </ul>
            </div>
            <div class="span4">
                <ul class="nav nav-pills pull-right">
                    <li><a href="#">Stonyhills.</a></li>
                </ul>
            </div>
        </div>
    </section>
    <tpl:import layout="upload" />
</tpl:layout>