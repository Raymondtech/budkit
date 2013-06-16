<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <header class="section-header clearfix">
                <div class="pull-left"><div class="page-header"><h1 class="margin-top-zero">Search</h1></div></div> 
                <ul class="nav nav-pills no-margin pull-right">
                    <li>
                        <div class="btn-group">
                            <a href="/system/message/create" class="btn">Save</a>
                        </div>
                    </li>
                </ul>
            </header>
            <div class="section-body">
                <div class="padding">Something search related, maybe filters?</div>
            </div> 
        </div>
        <div class="message-view">
            <div class="stream-thread">  
                <header class="section-header clearfix">   
                    <form class="margin-bottom-zero form-vertical inline-block row-fluid" action="/system/search/graph" method="post"> 
                        <div class="controls input-append margin-bottom-zero row-fluid span12">
                            <input type="text" class="span12" name="query" placeholder="Search for people, documents, groups or anything else" value="${query}" />
                        </div>
                    </form>
                </header>
                <div class="stream-body">
                    <div class="padding">
                        <tpl:condition data="result" test="isset" value="1">
                            <tpl:loop data="result.objects" id="search-results-sections">
                                <div class="widget">
                                    <div class="widget-head">
                                        <span class="widget-title"><tpl:element type="text" data="title" /></span>
                                        <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="resultstoggler">
                                            <li class="active"><a data-target=".media-gallery "  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                                            <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="widget-body">
                                        <tpl:condition test="boolean" data="listonly" value="0">
                                            <ul class="media-grid media-gallery compensate-margins">
                                                <tpl:loop data="results" id="search-results">
                                                    <li class="mgrow-fluid">
                                                        <div class="feature mgcol1">
                                                            <tpl:condition test="isset" data="icon" value="1">
                                                                <a href="${link}" class="link"><img src="${icon}" /></a>
                                                            </tpl:condition>
                                                            <tpl:condition test="isset" data="media_uri" value="1">
                                                                <tpl:media uri="media_uri" mode="icon"  class="media-item" width="170" height="170" /> 
                                                            </tpl:condition>
                                                        </div>
                                                        <div class="grid-hide mgcol11">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</tpl:layout>


