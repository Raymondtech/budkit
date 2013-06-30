<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar" id="navbar">
        <div class="navbar-inner padding-left-zero">
            <div class="nav-collapse collapse" >  
                <div class="navbar-brand pull-left">
                    xy
                </div>
                <div class="navbar-tools padding-left-zero pull-left">
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="1">
                        <ul class="nav pull-right" id="menubartabs">
                            <li><a href="/system/notifications/list" class="margin-zero"><i class="icon-bell-alt"></i></a></li>
                            <li><a href="/settings/member/account" class="margin-zero"><i class="icon-cog"></i></a></li>   
                            <li><a href="/system/authenticate/logout"  class="margin-zero" title="Log-Out"><i class="icon-off"></i></a></li>                                                                              
                        </ul>
                    </tpl:condition>
                    <time data-clock="timer" class="navbar-time pull-left">00:00:00</time>
                </div>
                <div class="navbar-searchbox pull-left padding-left"><tpl:import layout="forms/search" app="system" /> </div>
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1">
                    <div class="btn-toolbar margin-zero pull-right" align="center">
                        <div class="btn-group margin-zero">
                            <a class="btn btn-highlight" data-target="#quickstatus" data-toggle="modal"><i class="icon-plus"></i></a>
                            <a class="btn btn-highlighted" href="/system/media/create">Participate</a>
                        </div>
                    </div>
                </tpl:condition>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</tpl:layout>