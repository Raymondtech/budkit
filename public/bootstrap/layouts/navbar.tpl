<tpl:layout name="navbar" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand logo" href="/">Budkit</a>
                <div class="nav-collapse">

                    <ul class="nav pull-left">                     
                        <li><a href="/system/start/featured" tpl:i18n="">Featured</a></li>
                        <li><a href="/content/locations/map" tpl:i18n="">Explore</a></li>
                        <li><a href="/system/activity/stream" tpl:i18n="">Activity</a></li>
                        <li class="divider-vertical"></li>
                        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                            <li class="notification dropdown">
                                <a href="/member/notification/list" class="dropdown-toggle on" data-toggle="dropdown"><i class="icon icon-pushpin"></i></a>
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
                            <li class="shareform dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-white icon-plus"></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                    <tpl:import layout="input" />
                            </li>
                    </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">@<tpl:element type="text" data="user.username"/> <b class="caret">&nbsp;</b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/member/profile/display/information" class="profile-link clearfix">
                                    <img class="profile-avatar pull-left" src="http://placehold.it/32x32" alt="Livingstone Fultang" />
                                    <tpl:element type="text" data="user.fullname" />
                                    <span class="profile-username">@<tpl:element type="text" data="user.username" /></span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/system/start/index"><strong><tpl:i18n>Dashboard</tpl:i18n></strong></a></li>

                            <li><a href="/member/messages/inbox">Messages</a></li>
                            <li class="divider"></li>
                            <li><a href="/member/settings/account">Account settings</a></li>
                            <li><a href="/member/settings/privacy">Privacy</a></li>                            
                            <li class="divider"></li>
                            <li><a href="/sign-out">Sign out</a></li>
                        </ul>
                    </li>

                    </tpl:condition>
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                        <li><a href="/member/session/start">Sign in</a></li>
                    </tpl:condition>

                    </ul> 


                    <form class="navbar-search pull-right" action="/search" method="get">
                        <input type="text" class="search-query span4" name="query" placeholder="i18n:Search"  />
                    </form>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>