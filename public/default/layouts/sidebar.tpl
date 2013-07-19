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

        <tpl:condition  data="action.button" test="boolean" value="0" >
            <div class="btn-toolbar padding padding-top margin-zero">
                <div class="btn-group row-fluid">
                    <a class="btn btn-important span9" href="/system/media/create">Create New</a>
                    <a class="btn btn-important span3" data-target="#quickstatus" data-toggle="modal"><i class="icon-plus"></i></a>
                </div>
            </div>
        </tpl:condition>
        <tpl:condition  data="action.button" test="boolean" value="1" >
            <div class="btn-toolbar padding padding-top margin-zero">
                <div class="btn-group row-fluid">
                    <a class="btn ${action.button.class}" href="${action.button.link}"><tpl:element type="text" data="action.button.text" /></a>
                </div>
            </div>
        </tpl:condition>
        <tpl:block data="page.block.side" />
    </tpl:condition>
</tpl:layout>


