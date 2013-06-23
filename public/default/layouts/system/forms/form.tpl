<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition test="compare" count="1" operator="equals" value="1" data="editor_forms">
        <header class="section-header clearfix">
            <div class="message-header pull-left"><div class="page-header">
                    <h1 class="margin-top-zero">
                        <tpl:loop id="form-launchers-single" data="editor_forms">
                            <tpl:element type="text" data="title">Create</tpl:element>
                        </tpl:loop>
                    </h1>
                </div>
            </div> 
            <ul class="nav nav-pills no-margin pull-right">
                <li>
                    <div class="btn-toolbar pull-right no-margin">                                 
                        <a class="btn" href="/system/media/create">Share something else?</a>
                    </div>
                </li>
            </ul>
        </header>
        <div class="margin-bottom padding"> 
            <tpl:import layout="input" /> 
        </div>
    </tpl:condition>
    <tpl:condition test="compare" count="1" operator="greaterthan" value="1" data="editor_forms">
        <div class="messages-box">
            <div class="message-list">
                <header class="section-header clearfix">
                    <div class="message-header pull-left"><div class="page-header"><h1 class="margin-top-zero">To Participate..</h1></div></div> 
                </header>
                <div class="section-body">
                    <ul class="stream">

                        <tpl:loop id="form-launchers" data="editor_forms">
                            <li class="stream-item bottom-border">
                                <a href="/system/media/create/${id}" class="grid-hide has-featured-img link">
                                    <span class="featured-img btn"><i class="icon-2x ${icon-class}"></i></span>
                                    <span class="title"><strong><tpl:element type="text" data="title" /></strong></span>
                                    <div class="content clearfix">            
                                        <span class="help-block margin-zero"><tpl:element type="text" data="hint" /></span>
                                        <span class="metric"><tpl:element type="text" data="metric" /></span>
                                    </div>
                                </a>
                            </li>
                        </tpl:loop>
                    </ul>
                </div>
            </div>
            <div class="message-view">
                <div class="stream-thread">  
                    <header class="section-header clearfix">   
                        <ul class="nav nav-pills no-margin">
                            <li>
                                <div class="btn-group">
                                    <a href="/system/media/create/drop" class="btn btn-important">Upload Files</a>
                                </div>
                                <div class="btn-group">
                                    <a href="/system/media/create/record" class="btn">Record</a>
                                </div>                                          
                            </li>
                        </ul>
                    </header>
                    <div class="stream-body stream-box row-fluid media-box">
                        <div class="stream-view">    
                            <div class="padding">
                                <!--Say Something here-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </tpl:condition>
</tpl:layout>