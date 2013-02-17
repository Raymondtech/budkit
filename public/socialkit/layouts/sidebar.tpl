<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-inverse margin-bottom">
        <div class="navbar-inner padding-zero">
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                <ul class="nav pull-left" id="menutabs"> 
                    <li class="active"><a data-target="#mainmenu" data-toggle="tab"><i class="icon-align-justify"></i></a></li>
                    <li><a data-target="#usermenu" data-toggle="tab"><i class="icon-user"></i></a></li>                
                    <li><a data-target="#settingsmenu" data-toggle="tab"><i class="icon-cogs"></i></a></li>
                    <li><a data-target="#messagesmenu" data-toggle="tab"><i class="icon-envelope-alt"></i></a></li>   
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

    <div class="tab-content">
        <div class="tab-pane active" id="mainmenu">
            <tpl:menu id="dashboardmenu" type="nav-list" />
        </div>
        <div class="tab-pane" id="usermenu">           
            <ul class="nav nav-list">
                <li><a href="/system/start/index">Your Dashboard </a></li>
                <li><a href="/member/profile/view/">@<tpl:element type="text" data="user.user_name_id"/> <span class="badge badge-important pull-right">12</span></a></li>
                <li><a href="/member/messages/inbox">Private Messages</a></li>
                <li><a href="/member/settings/account">Account settings</a></li>
                <li><a href="/member/settings/privacy">Privacy</a></li>                            
                <li><a href="/sign-out">Sign out</a></li>
            </ul>
        </div>
        <div class="tab-pane" id="settingsmenu">
            <tpl:menu id="settingsmenu" type="nav-list" />
        </div>
        <div class="tab-pane" id="messagesmenu">
            <tpl:menu id="messagesmenu" type="nav-list" />
        </div>
    </div>    
    <tpl:block data="page.block.side">Sidebar</tpl:block>
</tpl:layout>


