<tpl:layout name="navbar" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".responsive-body">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand logo" href="/">Budkit</a>
                <div class="nav-collapse">

                    <form class="navbar-search pull-right left-pad">
                        <input type="text" class="search-query" placeholder="Search" />
                    </form>
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                        <ul class="nav pull-right"> 
                            <li class="notification dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notifications<span class="badge badge-important">12</span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/system/start/dashboard/notifications">View all notifications</a> <a href="/system/start/dashboard/notifications" class="pull-right">Clear All</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="alert-info alert no-margin">
                                            <tpl:i18n>No new notifications</tpl:i18n>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="usermenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><tpl:element type="text" data="user.user_full_name"/></a>
                                <ul class="dropdown-menu" id="user-nav">
                                    <li><a href="/member/profile/view/">Your Profile </a></li>
                                    <li class="divider"></li>
                                    <li><a href="/system/start/index"><strong><tpl:i18n>Dashboard</tpl:i18n></strong></a></li>
                                    <li><a href="/system/start/dashboard/activity" tpl:i18n="">Activity</a></li>
                                    <li><a href="/member/messages/inbox">Messages</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/member/settings/account">Account settings</a></li>
                                    <li><a href="/member/settings/privacy">Privacy</a></li>                            
                                    <li class="divider"></li>
                                    <li><a href="/sign-out">Sign out</a></li>
                                </ul>
                            </li>

                        </ul>
                    </tpl:condition>
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                        <ul class="nav pull-right"> 
                            <li><a href="/member/session/start">Sign in</a></li>
                        </ul> 
                    </tpl:condition>   

                </div>
            </div>
        </div>
    </div>
</tpl:layout>