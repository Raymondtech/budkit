<tpl:layout name="search" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form class="navbar-search input-append pull-left" action="/system/search/graph" method="post">   
        <i class="icon-search add-on"></i>
        <input type="text" class="search-query span5" name="query" placeholder="Search for Documents, People, Messages etc" />
        <div class="search-results">
            <div class="results-stream">
                <ul class="stream">
                    <tpl:loop limit="5">
                        <li class="stream-item">
                            <a href="#" class="link">
                                <div class="subject">
                                    [Reply] More information required to complete your grant
                                </div>
                                <div class="content">
                                    And here are the contents of this message. Maximum of two lines allowed. But we sill have plenty of space to add more
                                </div>
                            </a>
                        </li>
                    </tpl:loop>
                </ul>
            </div>
        </div>
    </form> 
</tpl:layout>


