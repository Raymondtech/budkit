<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>                         
            <div class="nav-collapse collapse right-padding">
                <tpl:import layout="search" />
            </div><!--/.nav-collapse -->
            <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
</tpl:layout>