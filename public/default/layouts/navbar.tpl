<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar no-margin">
        <div class="navbar-inner">
            <div class="container large no-padding">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".responsive-body">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="nav-collapse">
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                       <ul class="nav pull-right"> 
                            <li class="usermenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><tpl:element type="text" data="user.user_full_name"/></a>
                                <ul class="dropdown-menu" id="user-nav">
                                    <li><a href="/system/start/index"><strong><tpl:i18n>Dashboard</tpl:i18n></strong></a></li>
                                    <li><a href="/member/profile/view/">Your Profile </a></li>
                                    <li><a href="/system/workspace/personal" tpl:i18n="">Your Workspace</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/member/messages/inbox">Private Messages</a></li>
                                    <li><a href="/member/settings/account">Account settings</a></li>
                                    <li><a href="/member/settings/privacy">Privacy</a></li>                            
                                    <li class="divider"></li>
                                    <li><a href="/sign-out">Sign out</a></li>
                                </ul>
                            </li>                          
                            <li class="notification dropdown" >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notifications <span class="badge badge-important">12</span></a>
                                <ul class="dropdown-menu" id="notification-nav">
                                    <li><a href="/system/start/dashboard/notifications">View all notifications</a> <a href="/system/start/dashboard/notifications" class="pull-right">Clear All</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="alert-info alert no-margin">
                                            <tpl:i18n>No new notifications</tpl:i18n>
                                        </div>
                                    </li>
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
        </div>
    </div>
</tpl:layout>