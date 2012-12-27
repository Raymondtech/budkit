<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li class="active"><a href="#stream" data-toggle="tab"><i class="icon-speech-reply icon icon-16"></i>Members</a></li>
            <li><a href="#files" data-toggle="tab"><i class="icon-box icon icon-16"></i>Files</a></li>
            <li><a href="#settings" data-toggle="tab"><i class="icon-package icon icon-16"></i>Add App</a></li>
        </ul>
        <ul class="nav icon-tabs right no-margin no-bottom-border docked-bottom">
            <li><a href="#settings"><i class="icon-cog icon icon-16"></i>Settings</a></li>
        </ul>
    </div>

    <div class="box-padding">
        <div id="control-panel" class="inline-block">
            <div class="row-fluid text-centered"> 

                <a href="/system/admin/application/campus/task" class="thumbnail-icon text-centered  text-gray" data-original-title="Tasks" rel="tooltip">
                    <i class="icon icon-32 icon-tasks icon-block"></i>
                    <span class="badge badge-important">2</span>
                </a>
                <a href="/system/admin/network/members/lists" class="thumbnail-icon text-centered  text-gray" data-original-title="Members" rel="tooltip">
                    <i class="icon icon-32 icon-user icon-block"></i>
                </a>
                <a href="/system/admin/manage/emails" class="thumbnail-icon text-centered  text-gray" data-original-title="Announcement" rel="tooltip">
                    <i class="icon icon-32 icon-film icon-bullhorn"></i>
                </a>
                <a href="/system/admin/settings/configuration" class="thumbnail-icon text-centered  text-gray" data-original-title="Configuration" rel="tooltip">
                    <i class="icon icon-32 icon-cogs icon-block"></i>
                </a>

                <a href="/system/admin/content/featured" class="thumbnail-icon text-centered  text-gray" data-original-title="Featured" rel="tooltip">
                    <i class="icon icon-32 icon-fire icon-block"></i>
                </a>
                <a href="/system/admin/network/analytics" class="thumbnail-icon text-centered  text-gray" data-original-title="Analytics" rel="tooltip">
                    <i class="icon icon-32 icon-bar-chart icon-block"></i>
                </a>
                <a href="/system/admin/content/media" class="thumbnail-icon text-centered  text-gray" data-original-title="Media Manager" rel="tooltip">
                    <i class="icon icon-32 icon-film icon-block"></i>
                </a>

                <a href="/system/admin/network/authorities" class="thumbnail-icon text-centered  text-gray" data-original-title="Permissions" rel="tooltip">
                    <i class="icon icon-32 icon-lock icon-block"></i>
                </a>
                <a href="/system/admin/extensions/repositories" class="thumbnail-icon text-centered  text-gray" data-original-title="Repository" rel="tooltip">
                    <i class="icon icon-32 icon-block icon-truck"></i>
                    <span class="badge badge-info">15</span>
                </a>
                <a href="/system/admin/extensions/installed" class="thumbnail-icon text-centered  text-gray" data-original-title="Extensions" rel="tooltip">
                    <i class="icon icon-32 icon-upload-alt icon-block"></i>
                </a>
                <a href="/system/admin/settings/appearance" class="thumbnail-icon text-centered  text-gray" data-original-title="Themes" rel="tooltip">
                    <i class="icon icon-32 icon-magic icon-block"></i>
                </a>
                <a href="/system/admin/settings/maintenance" class="thumbnail-icon text-centered  text-gray" data-original-title="Put Offline" rel="tooltip">
                    <i class="icon icon-32 icon-off icon-block"></i>
                </a>
                <a href="/content/article/create" class="thumbnail-icon text-centered text-gray" data-original-title="Updates" rel="tooltip">
                    <i class="icon icon-32 icon-block icon-download-alt"></i>
                    <span class="badge badge-important">0.9.1</span>
                </a>

            </div>
        </div>
        <hr />

        <div id="dashboard-stats" class="row-fluid" style="height: 250px; margin-bottom: 10px;"></div>
        <hr />
        <div class="row-fluid inline-block">
            <div class="span3 text-centered stat-box">
                <span class="stat-figure">1500</span>
                <span class="stat-title">Posts</span>
                <span class="stat-description text-green">+ 10% since yesterday</span>
            </div>
            <div class="span3 text-centered stat-box">
                <span class="stat-figure">18</span>
                <span class="stat-title">Members</span>
                <span class="stat-description text-red">- 9% since yesterday</span>
            </div>
            <div class="span3 text-centered stat-box">
                <span class="stat-figure">00</span>
                <span class="stat-title">Discussions</span>
                <span class="stat-description"> Unchanged since yesterday</span>
            </div>
            <div class="span3 text-centered stat-box">
                <span class="stat-figure">24</span>
                <span class="stat-title">Spam</span>
                <span class="stat-description text-red">+ 45% since yesterday</span>
            </div>
        </div>

        <hr />

        <div class="row-fluid inline-block">
            <div class="span4">
                <div class="dashboard-widget">
                    <h3 class="widget-title">Logged-In Users</h3>
                    <div class="widget-body">
                        <ul class="media-list">
                            <li><img src="http://lorempixel.com/40/40/people/1" class="thumbnail" /> <a href="#">Livingstone Fultang</a></li>
                            <li><img src="http://lorempixel.com/40/40/people/2" class="thumbnail" /> <a href="#">Barry White</a></li>
                            <li><img src="http://lorempixel.com/40/40/people/3" class="thumbnail" /> <a href="#">Landon Larson</a></li>
                            <li><img src="http://lorempixel.com/40/40/people/4" class="thumbnail" /> <a href="#">Thelma Banatyne</a></li>
                            <li><img src="http://lorempixel.com/40/40/people/5" class="thumbnail" /> <a href="#">Rudolf Sanchez</a></li>
                            <li><img src="http://lorempixel.com/40/40/people/6" class="thumbnail" /> <a href="#">Patrick Stone</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span4">
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
            <div class="span4">
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
    </div>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/excanvas.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/charts/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getTemplatePath() ?>/js/administrator.js"></script>

</tpl:layout>