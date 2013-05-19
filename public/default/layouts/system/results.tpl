<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl"> 
    <div class="padding"> 
        <form class="no-margin pull-left form-horizontal" action="/system/search/graph" method="post">   
            <input type="text" class="span5" name="query" placeholder="Search" value="${query}" />
            <button type="submit" class="btn">Search</button>
        </form>
        <div class="clearfix">
            <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="resultstoggler">
                <li class="active"><a data-target=".media-gallery "  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
            </ul>
        </div>
        <hr />  
        <tpl:condition data="result" test="isset" value="1">
            <tpl:loop data="result.objects" id="search-results-sections">
                <div class="widget">
                    <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="title" /></span></div>
                    <div class="widget-body">
                        <tpl:condition test="boolean" data="listonly" value="0">
                            <ul class="media-grid media-gallery compensate-margins">
                                <tpl:loop data="results" id="search-results">
                                    <li class="mgrow-fluid">
                                        <div class="featured mgcol2 ">
                                            <tpl:condition test="isset" data="icon" value="1">
                                                <a href="${link}" class="link"><img src="${icon}" /></a>
                                            </tpl:condition>
                                            <tpl:condition test="isset" data="media_uri" value="1">
                                                <tpl:media uri="media_uri" link="true" mode="icon"  class="media-item" width="170" height="170" /> 
                                            </tpl:condition>
                                        </div>
                                        <div class="grid-hide mgcol10">
                                            <div class="subject">
                                                <a href="${link}" class="link"><strong><tpl:element type="text" data="title" /></strong></a>
                                            </div>
                                            <div class="help-block">
                                                <tpl:element type="text" data="description" />
                                            </div>
                                        </div>
                                    </li>
                                </tpl:loop>
                            </ul> 
                        </tpl:condition>
                        <tpl:condition test="boolean" data="listonly" value="1">
                            <ul class="media-list compensate-margins">
                                <tpl:loop data="results" id="search-results">
                                    <li class="mgrow-fluid">
                                        <div class="grid-hide mgcol12">
                                            <div class="subject">
                                                <a href="${link}" class="link"><strong><tpl:element type="text" data="title" /></strong></a>
                                            </div>
                                            <div class="help-block">
                                                <tpl:element type="text" data="description" />
                                            </div>
                                        </div>
                                    </li>
                                </tpl:loop>
                            </ul> 
                        </tpl:condition>
                    </div>
                </div>
            </tpl:loop>
        </tpl:condition>

        <tpl:condition data="result" test="isset" value="0">
            <p class="placeholder-text">Nothing found</p>
        </tpl:condition>
    </div>
</tpl:layout>


