<tpl:layout  name="start" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner">
           <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
    <tpl:import layout="system/frontpage" />
    <div class="padding">
        
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-bucket" id="widget-bucket-1">

                    <div class="widget">
                        <!--<div class="widget-head"><span class="widget-title">What's New</span><a class="widget-close" data-dismiss="widget"><i class="icon-remove"></i></a></div>-->
                        <div class="widget-body">
                            Dashboard
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="widget-bucket" id="widget-bucket-2">
                            <div class="widget">
                                <div class="widget-head"><span class="widget-title">Widget Head</span><a class="widget-close" data-dismiss="widget"><i class="icon-remove"></i></a></div>
                                <div class="widget-body">Widget Body</div>
                                <div class="widget-footer">Widget Footer</div>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="widget-bucket" id="widget-bucket-3">
                            <div class="widget">
                                <div class="widget-head">Widget Head</div>
                                <div class="widget-body">Widget Body</div>
                                <div class="widget-footer">Widget Footer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>