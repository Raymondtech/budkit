<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar margin-bottom-half">
        <div class="navbar-inner padding-left-half padding-right-zero no-margin">
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                <ul class="nav no-margin" id="menutabs"> 
                    <li class="active"><a data-target="#mainmenu" data-toggle="tab"><i class="icon-align-justify"></i></a></li>                             
                    <li><a data-target="#settingsmenu" data-toggle="tab"><i class="icon-cogs"></i></a></li>
                    <li><a data-target="#messagesmenu" data-toggle="tab"><i class="icon-envelope-alt"></i></a></li>
                    <li><a data-target="#notificationslist" data-toggle="tab"><i class="icon-bell-alt"></i></a></li>     <!--Use  class="highlighted" on new notifications-->
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
            <ul class="nav nav-list">
                <li class="nav-header">Favourites</li>
            </ul>
            <tpl:menu id="dashboardmenu" type="nav-list" />
            <ul class="nav nav-list">
                <li class="nav-header">Friends</li>
                <li><a href="#">Account</a></li>
                <li><a href="#">System</a></li>
                <li><a href="#">Extensions</a></li>
                <li><a href="#">Moderation <span class="badge pull-right">3</span></a></li>
                <li><a href="#">Experience</a></li>
                <li><a href="#">Privacy</a></li>
            </ul>
            <ul class="nav nav-list">
                <li class="nav-header">Groups</li>
                <li><a href="#">Account</a></li>
                <li><a href="#">System</a></li>
                <li><a href="#">Extensions</a></li>
                <li><a href="#">Moderation <span class="badge pull-right">3</span></a></li>
                <li><a href="#">Experience</a></li>
                <li><a href="#">Privacy</a></li>
            </ul>
        </div>
        <div class="tab-pane" id="notificationslist">           
            <div class="padding-half">A list of Notifications</div>
        </div>
        <div class="tab-pane" id="settingsmenu">
            <tpl:menu id="settingsmenu" type="nav-list" />
        </div>
        <div class="tab-pane" id="messagesmenu">
            <ul class="nav nav-list">
                <li class="nav-header">Private Messages</li>
            </ul>
            <tpl:menu id="messagesmenu" type="nav-list" />
            <ul class="nav nav-list">
                <li class="nav-header">Group Discussions</li>
                <li><a href="#">Joomla Developer group</a></li>
                <li><a href="#">Budkit Devs <span class="badge pull-right">3</span></a></li>
                <li><a href="#">Roman Catholics</a></li>
                <li><a href="#">Usual Suspects</a></li>
            </ul>
        </div>
    </div>    
    <tpl:block data="page.block.side">Sidebar</tpl:block>
</tpl:layout>


