<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar margin-bottom-zero">
        <div class="navbar-inner padding-left-half padding-right-zero no-margin">
            
        </div>
    </div>
    
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
                <li class="nav-header">Application</li>
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
            <ul class="nav nav-list">
                <li class="nav-header">Personal Settings</li>
            </ul>
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


