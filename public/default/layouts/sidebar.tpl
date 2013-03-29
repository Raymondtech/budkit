<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
        <div class="auth-user">
            <tpl:condition data="profile.user_photo" test="isset" value="1">
                <a href="/member/profile/view" class="profile-link">
                    <img src="/system/object/${profile.user_photo}/resize/30/30"  />
                </a>
            </tpl:condition>
            <span class="intro"><tpl:element type="text" formatting="sprintf" cdata="Hi %s" data="profile.user_first_name"  /></span>
        </div>
        <tpl:block data="page.block.side" />
    </tpl:condition>
    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
        <div class="padding-half">
            <p class="alert alert-info">Login to Personalize your experience</p>
        </div>
    </tpl:condition>
</tpl:layout>


