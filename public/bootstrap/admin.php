<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <html lang="en">
        <head>
            <title><tpl:element type="text" data="page.title">Administrator</tpl:element></title>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="<?php echo $this->getPageDescription(); ?>" />
            <meta name="author" content="<?php echo $this->getPageAuthor(); ?>" />
            <meta name="keywords" content="<?php echo $this->getPageAuthor(); ?>" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Le fav and touch icons -->
            <link rel="shortcut icon" href="images/favicon.ico" />
            <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
            <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png" />
            <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png" />

            <link rel="stylesheet" href="<?php echo $this->getTemplatePath() ?>/css/bootstrap.css" type="text/css" media="screen" />

            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-1.7.1.min.js' type="text/javascript"></script>
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-ui.min.js' type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/modernizr-2.0.6.min.js" type="text/javascript"></script>
        </head>

        <body class="white-background admin-body">
            <div class="container-fixed">  
                
                <tpl:import layout="system/adminbar" />
                <tpl:block data="page.block.alerts" /> 
                
                <div class="sidebar-icons">
                    <tpl:menu id="adminlaunchbar" type="nav-icons" />
                </div>
                <section class="layout-block has-sidebar-btns grey-background no-padding no-bottom-margin">
                    <div class="row-fluid">

                        <div class="span2">

                            <tpl:menu id="adminmenu" type="nav-block" position="left" />



                            <tpl:block data="page.block.side">Sidebar</tpl:block>

                            <div class="left-pad top-pad">
                                <div class="widget">
                                    <div class="widget-body">
                                        <h2>2,190<small class="pull-right">60%</small></h2>
                                        <div class="progress mini-bar progress-success">
                                            <div class="bar" style="width: 60%;"></div>
                                        </div>
                                        <span class="help-block">New members in the last 30 days</span>

                                        <h2 class="top-pad">64<small class="pull-right">10%</small></h2>
                                        <div class="progress mini-bar progress-danger">
                                            <div class="bar" style="width: 10%;"></div>
                                        </div>
                                        <span class="help-block">New content. Post, Check-ins etc. </span>


                                        <h2 class="top-pad">583<small class="pull-right">53%</small></h2>
                                        <div class="progress mini-bar progress-bar">
                                            <div class="bar" style="width: 53%;"></div>
                                        </div>
                                        <span class="help-block">Relationships forged</span>


                                        <h2 class="top-pad">8,943,985<small class="pull-right">90%</small></h2>
                                        <div class="progress mini-bar">
                                            <div class="bar" style="width: 90%;"></div>
                                        </div>
                                        <span class="help-block">Unique visitors this month</span>

                                        <h2 class="top-pad">2,190<small class="pull-right">60%</small></h2>
                                        <div class="progress mini-bar progress-success">
                                            <div class="bar" style="width: 60%;"></div>
                                        </div>
                                        <span class="help-block">New members in the last 30 days</span>

                                        <h2 class="top-pad">64<small class="pull-right">10%</small></h2>
                                        <div class="progress mini-bar progress-danger">
                                            <div class="bar" style="width: 10%;"></div>
                                        </div>
                                        <span class="help-block">New content. Post, Check-ins etc. </span>
                                    </div>
                                </div>                                     
                                <hr />
                                <div class="widget">
                                    <div class="well">
                                        <a href="#" class="clearfix">
                                            <span class="count-head">Website Visits</span>
                                            <h1 class="count-body">189</h1>
                                            <span class="count-footer">% of Total: 5% (3702 in total)</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="span10 fix-left-gutter">  
                            <div class="left-pad top-pad bottom-pad white-background right-pad clearfix admin-panel"> 
                                <div class="page-header no-margin">
                                    <h1><tpl:element type="text" data="page.title">Administrator</tpl:element><small class="panel-date"><?php echo \Library\Date::today(); ?></small></h1>
                                </div>
                                <tpl:condition  data="page.block.banner" test="isset" value="1" >
                                    <div class="row-fluid layout-banner bottom-pad bordered">
                                        <tpl:block data="page.block.banner">Banner</tpl:block>
                                    </div>
                                </tpl:condition>
                                <div class="top-pad">
                                    <tpl:block data="page.block.body" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <script src="<?php echo $this->getTemplatePath() ?>/js/bootstrap.js" type="text/javascript"></script>
        </body>
    </html>
</tpl:layout>