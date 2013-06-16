<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">

    <tpl:condition test="compare" count="1" operator="equals" value="1" data="editor_forms">
        <header class="section-header clearfix">
            <div class="message-header pull-left"><div class="page-header"><h1 class="margin-top-zero">Create</h1></div></div> 
            <ul class="nav nav-pills no-margin pull-right">
                <tpl:condition test="compare" count="1" operator="equals" value="1" data="editor_forms">
                    <li>
                        <div class="btn-toolbar pull-right no-margin">                                 
                            <a class="btn" href="/system/media/create">Other Type?</a>
                        </div>
                    </li>
                </tpl:condition>
            </ul>
        </header>
        <div class="margin-bottom padding"> 
            <tpl:import layout="input" /> 
        </div>
    </tpl:condition>
    <tpl:condition test="compare" count="1" operator="greaterthan" value="1" data="editor_forms">
        <div class="padding">
            <div class="widget naked stream-cpanel">
                <div class="widget-body padding-zero">
                    <ul class="widgeticons compensate-margins">
                        <tpl:loop id="form-launchers" data="editor_forms">
                            <li class="widgeticon">
                                <a href="/system/media/create/${id}">
                                    <span class="icon"><i class="${icon-class}"></i></span>
                                    <span class="title"><tpl:element type="text" data="title" /></span>
                                    <span class="metric"><tpl:element type="text" data="metric" /></span>
                                    <span class="hint"><tpl:element type="text" data="hint" /></span>
                                </a>
                            </li>
                        </tpl:loop>
                    </ul>
                </div>
            </div>
        </div>
    </tpl:condition>
</tpl:layout>