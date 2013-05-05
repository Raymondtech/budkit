<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav" id="navbar">
        <div class="navbar-inner">
            <div class="nav-collapse collapse">
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                    <div class="platform-user pull-right">
                        <a href="/member:${user.user_name_id}/profile/information" class="profile-link">
                            <tpl:condition data="profile.user_photo" test="isset" value="1">
                                <img src="/system/object/${user.user_photo}/resize/30/30"  />
                            </tpl:condition>
                            <span class="intro"><tpl:element type="text" formatting="sprintf" cdata="Hi %s" data="user.user_first_name"  /></span>
                        </a>
                    </div>
                    <ul class="nav pull-right" id="menubartabs">
                        <li><a href="/system/start/dashboard">Dashboard</a></li>
                        <li><a href="/system/media/timeline">Timeline</a></li>   
                        <li><a href="/system/messages/all">Messages</a></li>                                                                              
                        <li><a href="/member/network/directory">Members</a></li>     <!--Use  class="highlighted" on new notifications-->
                        <li><a href="/settings/member/account">Settings</a></li> 
                        <li><a href="/system/authenticate/logout">Signout</a></li>
                    </ul>
                    <form class="navbar-search input-append" method="get">   
                        <i class="icon-search add-on"></i>
                        <input type="text" class="search-query span4" placeholder="Search for people, files or discussions" />
                    </form>                
                </tpl:condition>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</tpl:layout>