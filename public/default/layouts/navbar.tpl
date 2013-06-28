<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar" id="navbar">
        <div class="navbar-inner padding-left-zero padding-right-zero">
            <div class="nav-collapse collapse" >  
                <div class="navbar-brand pull-left">My Company</div>
                <div class="navbar-tools padding-left-zero pull-left">
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="1">
                        <div class="btn-toolbar padding-left-zero margin-zero navbar-text pull-right" align="center">
                            <div class="btn-group margin-top-zero margin-bottom-zero">
                                <a href="/system/notifications/list" class="btn btn-inverse"><i class="icon-bell-alt"></i></a>
                                <a href="/settings/member/account" class="btn btn-inverse"><i class="icon-cog"></i> </a>
                                <a href="/system/authenticate/logout" class="btn btn-inverse" title="Log-Out"><i class="icon-off"></i></a>
                            </div>    
                        </div>
                    </tpl:condition>
                    <time data-clock="timer" class="navbar-time pull-left">00:00:00</time>
                </div>
                <div class="navbar-search pull-left padding-left"><tpl:import layout="forms/search" app="system" /> </div>
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1">
                    <div class="btn-toolbar margin-zero navbar-text pull-right" align="center">
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