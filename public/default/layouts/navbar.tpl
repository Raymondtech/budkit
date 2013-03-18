<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar" id="navbar">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
            <a class="brand" href="/system/start/dashboard">bk</a>
            <div class="nav-collapse collapse">
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                    <form class="navbar-search pull-right input-append">   
                        <i class="icon-search add-on"></i>
                        <input type="text" class="search-query" placeholder="Search" />
                    </form>
                    <ul class="nav pull-right" id="menubartabs">
                        <li><a href="/member/profile/view">Profile</a></li> 
                        <li><a href="/system/content/media">Media</a></li>   
                        <li><a href="/system/messages/all">Messages</a></li>                                                                              
                        <li><a href="/member/network/graph">Network</a></li>     <!--Use  class="highlighted" on new notifications-->
                         <li><a href="/settings/member/account">Settings</a></li> 
                        <li><a href="/system/authenticate/logout">Signout</a></li>
                    </ul>                    
                </tpl:condition>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</tpl:layout>