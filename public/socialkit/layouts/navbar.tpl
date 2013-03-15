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
                    <form class="navbar-search pull-left input-append">   
                        <i class="icon-search add-on"></i>
                        <input type="text" class="search-query span4" placeholder="Search for people, photos and videos or enter a command">
                    </form>
                    
                </tpl:condition>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</tpl:layout>