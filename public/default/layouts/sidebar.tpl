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
        <div class="section-timer margin-top" align="center">
            <time data-clock="timer">00:00:00</time>
        </div>
        <div class="btn-toolbar padding margin-zero">                              
            <a class="btn btn-highlight input-100pct" href="/system/media/create">Participate</a>
        </div>
        <tpl:menu id="dashboardmenu" type="nav-list" />
        <tpl:block data="page.block.side" />
    </tpl:condition>
</tpl:layout>


