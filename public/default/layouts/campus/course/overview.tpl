<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid media-box">
        <div class="stream-view">
            <div class="stream-thread">              
                <div class="stream-body padding" id="timeline" style="min-height: 1000px">
                    <div class="stream-widgets">
                        <div class="page-header clearfix">

                            <div class="btn-toolbar pull-right no-margin">                              
                                <a class="btn-important btn" href="/system/media/create/editor">Take this Course</a>
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
                            <div class="widget">
                                    <div class="widget-head">About</div>
                                    <div class="widget-body"><tpl:element type="html" data="course.workspace_long_descr" /></div>
                                </div>
                            <div class="widget">
                                <div class="widget-head">Objectives</div>
                                <div class="widget-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="span1"></th>
                                                <th class="span8">Description</th>
   
                                                <th class="span1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><tpl:media uri="placeholder" width="100" height="100" /></td>
                                                <td>
                                                    <a><strong>Introduction</strong></a>
                                                    <span class="help-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                                </td>
                              
                                                <td><a href="" class="btn btn-success">Completed</a></td>
                                            </tr>
                                            <tr>
                                                <td><tpl:media uri="placeholder" width="100" height="100" /></td>
                                                <td>
                                                    <a><strong>Sharing an Idea</strong></a>
                                                    <span class="help-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                                </td>
                                               
                                                <td><a href="" class="btn btn-important">Re Start</a></td>
                                            </tr>
                                            <tr>
                                                <td><tpl:media uri="placeholder" width="100" height="100" /></td>
                                                <td>
                                                    <a><strong>Presenting your work</strong></a>
                                                    <span class="help-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                                </td>
                                                
                                                <td><a href="" class="btn disabled">Start</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
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