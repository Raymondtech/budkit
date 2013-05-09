<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar" id="navbar">
        <div class="navbar-inner">
            <div class="nav-collapse collapse">
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                    <ul class="nav pull-right" id="menubartabs">
                        <li><a href="/system/start/dashboard">Dashboard</a></li>
                        <li><a href="/system/media/timeline">Timeline</a></li>   
                        <li><a href="/system/messages/all">Messages</a></li>                                                                              
                        <li><a href="/member/network/directory">People</a></li>     <!--Use  class="highlighted" on new notifications-->
                        <li><a href="/settings/member/account">Settings</a></li> 
                        <li><a href="/system/authenticate/logout">Signout</a></li>
                    </ul>
                    <form class="navbar-search input-append pull-left" method="get">   
                        <i class="icon-search add-on"></i>
                        <input type="text" class="search-query" placeholder="Search" />
                    </form>                
                </tpl:condition>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</tpl:layout>