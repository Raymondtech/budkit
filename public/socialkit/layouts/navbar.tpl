<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar" id="navbar">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
            <a class="brand" href="/">bk</a>
            <div class="nav-collapse collapse">
                <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                    <form class="navbar-search pull-right input-append">   
                        <i class="icon-search add-on"></i>
                        <input type="text" class="search-query" placeholder="Search" />
                    </form>
                    <ul class="nav pull-right" id="menubartabs">
                        <li><a href="#">Settings</a></li> 
                        <li><a href="#">Media</a></li>   
                        <li><a href="#">Messages</a></li>                                                                              
                        <li><a href="#">People</a></li>     <!--Use  class="highlighted" on new notifications-->
                        <li><a href="/member/profile/view">Profile</a></li>  
                        <li><a href="/member/session/stop">Signout</a></li>
                    </ul>                    
                </tpl:condition>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</tpl:layout>