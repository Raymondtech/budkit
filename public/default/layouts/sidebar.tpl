<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">

    <tpl:condition data="config|appearance.show-dashboard-photo" test="boolean" value="1">
        <div class="platform-user clearfix">
            <a href="/member:${user.user_name_id}/profile/information" class="profile-link">
                <tpl:condition data="profile.user_photo" test="isset" value="1">
                    <img src="/system/object/${user.user_photo}/resize/70/70"  />
                </tpl:condition>                      
            </a>
            <!--        <a href="/system/start/dashboard"><span class="intro"><tpl:element type="text" formatting="sprintf" cdata="Hi %s" data="user.user_first_name"  /></span></a>-->
        </div>
    </tpl:condition>
    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >

        <tpl:menu id="dashboardmenu" type="nav-list" />
        <tpl:block data="page.block.side" />
        <div id="quickstatus" class="modal hide fade" tabindex="-1" role="dialog">
            <div class="modal-body">
                <tpl:import layout="forms/status" app="system" />
            </div>
        </div>
        <div class="section-tools">
            <tpl:condition data="config|server.error-console" test="boolean" value="1">
                <a class="btn btn-inverse" data-target="#systemconsole" data-toggle="modal">Console</a>
            </tpl:condition>
        </div>
    </tpl:condition>
</tpl:layout>


