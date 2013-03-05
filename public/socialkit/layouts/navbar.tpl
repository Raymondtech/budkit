<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar">
        <div class="navbar-inner padding-right-zero">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
            <a class="brand" href="/">Budkit</a>
            <div class="nav-collapse collapse">
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                    <ul class="nav pull-right"> 
                        <li class="usermenu dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="http://placeskull.com/32/32" class="thumbnail inline-block" />
                                <tpl:element type="text" data="user.user_full_name"/>
                            </a>
                            <ul class="dropdown-menu" id="user-nav">
                                <li><a href="/member/profile/view/">Your Profile </a></li>
                                <li class="divider"></li>
                                <li><a href="/member/messages/inbox">Private Messages</a></li>
                                <li><a href="/member/settings/account">Account settings</a></li>
                                <li><a href="/member/settings/privacy">Privacy</a></li>                            
                                <li class="divider"></li>
                                <li><a href="/sign-out">Sign out</a></li>
                            </ul>
                        </li>    
                    </ul>
                </tpl:condition>
                
            </div><!--/.nav-collapse -->
            <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
            </tpl:condition>
        </div>
    </div>
</tpl:layout>