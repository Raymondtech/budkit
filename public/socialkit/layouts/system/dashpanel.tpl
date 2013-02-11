<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="box-padding">
        <div class="page-header">
            <h2>AdminPanel <small> (logged in as @drstonyhills)</small></h2>
        </div>  
        <div class="row-fluid inline-block">
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">1500</span>
                    <span class="stat-title">Posts</span>
                    <span class="stat-description text-green">+ 10% since yesterday</span>
                </div>
            </div>
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">18</span>
                    <span class="stat-title">Members</span>
                    <span class="stat-description text-red">- 9% since yesterday</span>
                </div>
            </div>
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">00</span>
                    <span class="stat-title">Discussions</span>
                    <span class="stat-description"> Same since yesterday</span>
                </div>
            </div>
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">24</span>
                    <span class="stat-title">Spam</span>
                    <span class="stat-description text-red">+ 45% since yesterday</span>
                </div>
            </div>
        </div>
        <div class="row-fluid inline-block">
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">1500</span>
                    <span class="stat-title">Posts</span>
                    <span class="stat-description text-green">+ 10% since yesterday</span>
                </div>
            </div>
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">18</span>
                    <span class="stat-title">Members</span>
                    <span class="stat-description text-red">- 9% since yesterday</span>
                </div>
            </div>
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">00</span>
                    <span class="stat-title">Discussions</span>
                    <span class="stat-description"> Same since yesterday</span>
                </div>
            </div>
            <div class="span3 text-centered stat-box">
                <div class="well">
                    <span class="stat-figure">24</span>
                    <span class="stat-title">Spam</span>
                    <span class="stat-description text-red">+ 45% since yesterday</span>
                </div>
            </div>
        </div>
        <hr />

        <div class="row-fluid inline-block">
            <div class="span6">
                <div class="dashboard-widget">
                    <h3 class="widget-title">Popular Content</h3>
                    <div class="widget-body">
                        <ul class="media-list">
                            <li><img src="http://lorempixel.com/40/40/animals/1" class="thumbnail" /> <a href="#">Themes: User profile appearance settings</a></li>
                            <li><img src="http://lorempixel.com/40/40/nature/2" class="thumbnail" /> <a href="#">Testing Phase 1 (TP1) now complete</a></li>
                            <li><img src="http://lorempixel.com/40/40/sports/3" class="thumbnail" /> <a href="#">Categorization, Lists and Subnetworks</a></li>
                            <li><img src="http://lorempixel.com/40/40/transport/4" class="thumbnail" /> <a href="#">Activity analysis and statistics</a></li>
                            <li><img src="http://lorempixel.com/40/40/fashion/5" class="thumbnail" /> <a href="#">Bug reporting from dashboard</a></li>
                            <li><img src="http://lorempixel.com/40/40/city/6" class="thumbnail" /> <a href="#">Themes: User profile appearance settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="dashboard-widget">
                    <h3 class="widget-title">Latest News</h3>
                    <div class="widget-body">
                        <ul>
                            <li><span class="label label-warning"><i class="icon icon-star"></i> </span>  <a href="#">Themes: User profile appearance settings</a></li>
                            <li><span class="label label-success"><i class="icon icon-ok"></i> </span> <a href="#">Testing Phase 1 (TP1) now complete</a></li>
                            <li><span class="label label-success"><i class="icon icon-ok"></i> </span> <a href="#">Categorization, Lists and Subnetworks</a></li>
                            <li><span class="label label-info"><i class="icon icon-plus"></i> </span>  <a href="#">Activity analysis and statistics</a></li>
                            <li><span class="label label-important"><i class="icon icon-remove"></i> </span> <a href="#">Bug reporting from dashboard</a></li>
                            <li><span class="label label-warning"><i class="icon icon-star"></i> </span>  <a href="#">Themes: User profile appearance settings</a></li>
                            <li><span class="label label-success"><i class="icon icon-ok"></i> </span> <a href="#">Testing Phase 1 (TP1) now complete</a></li>
                            <li><span class="label label-success"><i class="icon icon-ok"></i> </span> <a href="#">Categorization, Lists and Subnetworks</a></li>
                            <li><span class="label label-info"><i class="icon icon-plus"></i> </span>  <a href="#">Activity analysis and statistics</a></li>
                            <li><span class="label label-important"><i class="icon icon-remove"></i> </span> <a href="#">Bug reporting from dashboard</a></li>
                            <li><span class="label label-important"><i class="icon icon-remove"></i> </span> <a href="#">Bug reporting from dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div id="dashboard-stats" class="row-fluid" style="height: 250px; margin-bottom: 10px;"></div>
        <hr />
    </div>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/excanvas.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/administrator.js"></script>

</tpl:layout>