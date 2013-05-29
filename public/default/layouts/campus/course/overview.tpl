<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline" style="min-height: 1000px">
                    <div class="stream-widgets">
                        <div class="page-header clearfix">
                            
                            <div class="btn-toolbar pull-right no-margin">                              
                                <a class="btn-important btn" href="/system/media/create/editor">Give Up?</a>
                            </div>
                            <h1 class="margin-top-zero"><tpl:element type="text" data="page.title" /></h1>
                        </div>
                    </div> 
                    <div class="timeline-item-publisher-box">  
                        <tpl:condition data="profile.user_photo" test="isset" value="1">
                            <a href="/member:${profile.user_name_id}/profile/timeline" class="publisher-profile">
                                <img class="profile-avatar thumbnail" src="/system/object/${profile.user_photo}/resize/50/50"  />
                            </a>
                        </tpl:condition>
                        <div class=" stream-cpanel">
                            <div class=" row-fluid">
                                <div class="widget span8">
                                    <div class="widget-head">About</div>
                                    <div class="widget-body"><tpl:element type="html" data="course.workspace_long_descr" /></div>
                                </div>
                                <div class="widget span4">
                                    <div class="widget-head">Rewards</div>
                                    <div class="widget-body">
                                        What you get from completing the course
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="widget-head">Modules</div>
                                <div class="widget-body">
                                    What you get from completing the course
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="stream-widgets margin-top">
                        <tpl:block data="page.block.dashwidgets" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>