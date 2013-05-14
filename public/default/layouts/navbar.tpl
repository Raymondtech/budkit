<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar" id="navbar">
        <div class="navbar-inner">
            <div class="nav-collapse collapse">
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                    <ul class="nav" id="menubartabs">
                        <li><a href="/system/start/dashboard">Dashboard</a></li>
                        <li><a href="/system/media/attachments/gallery">Documents</a></li>   
                        <li><a href="/system/messages/inbox">Messages</a></li>                                                                              
                        <li><a href="/member/network/directory">People</a></li>     <!--Use  class="highlighted" on new notifications-->
                        <li><a href="/settings/member/account">Settings</a></li> 
                        <li><a href="/system/authenticate/logout">Signout</a></li>
                    </ul>               
                </tpl:condition>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</tpl:layout>