<tpl:layout name="adminbar" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="navbar navbar-fixed-top no-margin">
        <div class="navbar-inner adminbar">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="row-fluid">
                    <a class="brand logo span2" href="/">Pilgrimage</a>

                    <div class="no-margin">

                        <ul class="nav pull-left">                     
                            <li class="divider-vertical" style="margin: 0 6px"></li>
                        </ul> 


                        <form class="navbar-search" action="/search" method="get">
                            <input type="text" class="search-query span4" name="query" placeholder="Search" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>