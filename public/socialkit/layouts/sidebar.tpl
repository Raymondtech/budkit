<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-inverse margin-bottom">
        <div class="navbar-inner padding-zero">
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                <ul class="nav pull-left"> 
                    <li class="usermenu dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">@<tpl:element type="text" data="user.user_name_id"/> <span class="badge badge-important">12</span></a>
                        <ul class="dropdown-menu" id="user-nav">
                            <li><a href="/system/start/index">Your Dashboard </a></li>
                            <li><a href="/member/profile/view/">Your Profile </a></li>
                            <li class="divider"></li>
                            <li><a href="/member/messages/inbox">Private Messages</a></li>
                            <li><a href="/member/settings/account">Account settings</a></li>
                            <li><a href="/member/settings/privacy">Privacy</a></li>                            
                            <li class="divider"></li>
                            <li><a href="/sign-out">Sign out</a></li>
                        </ul>
                    </li>    
                </ul>
            </tpl:condition>
            <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                <ul class="nav pull-left"> 
                    <li><a href="/member/session/start">Sign in</a></li>
                </ul> 
            </tpl:condition> 
        </div>
    </div>

<!--    <ul class="nav nav-list">
        <li class="nav-header">Profile</li>
        <li><a href="#">Dashboard</a></li>
        <li class="active"><a href="#">Information</a></li>
        <li><a href="#">Timeline <span class="badge pull-right">23</span></a></li>
        <li><a href="#">Achievements</a></li>
        <li><a href="#">Network</a></li>
        <li class="nav-header">Socialize</li>
        <li><a href="#">Messages <span class="badge badge-important pull-right">1</span></a></li>
        <li><a href="#">Events  <span class="badge badge-important pull-right">6</span></a></li>
        <li><a href="#">Photos</a></li>
        <li><a href="#">Favorites</a></li>
        <li class="nav-header">Settings</li>
        <li><a href="#">Account</a></li>
        <li><a href="#">System</a></li>
        <li><a href="#">Extensions</a></li>
        <li><a href="#">Moderation <span class="badge pull-right">3</span></a></li>
        <li><a href="#">Experience</a></li>
        <li><a href="#">Privacy</a></li>
    </ul>-->
    <tpl:menu id="dashboardmenu" type="nav-list" />
    <tpl:menu id="adminmenu" type="nav-list" />
    <tpl:block data="page.block.side">Sidebar</tpl:block>
</tpl:layout>


