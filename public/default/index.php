<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <title><tpl:element type="text" data="page.title">Default Title</tpl:element></title>
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

            <!-- Scripts -->
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-1.7.1.min.js' type="text/javascript"></script>
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-ui.min.js' type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/modernizr-2.0.6.min.js" type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/bootstrap.js" type="text/javascript"></script>  
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/budkit-1.0.0.min.js" type="text/javascript"></script>

        </head>
        <body class="responsive-body  dark-bg">
            <div class="wrap">
                <div class="container-fluid large">
                    <tpl:import layout="toolbar" />
                </div>
                <div class="container large">
                    <tpl:import layout="navbar" />
                    <tpl:block data="page.block.alerts" />             
                    <tpl:block data="page.block.banner">Banner</tpl:block>
                    <tpl:condition data="page.activesidebar" test="boolean" value="1"> 
                        <section class="layout-block boxed has-bg has-aside-block has-main-block-aside">  
                            <div class="aside-block right-pad">  
                                <div class="row-fluid">
                                    <tpl:block data="page.block.side">Sidebar</tpl:block>
                                </div>
                            </div>
                            <tpl:condition data="page.activeaside" test="boolean" value="1"> 
                                <div class="main-block has-main-block-aside">
                                    <div class="main-block-aside top-pad bottom-pad right-pad">
                                        <tpl:block data="page.block.aside">Asidebar</tpl:block>
                                    </div>
                                    <div class="main-block-content">
                                        <div class="row-fluid">
                                            <div class="span12"> 
                                                <tpl:block data="page.block.body">Content</tpl:block>
                                            </div>
                                        </div>
                                    </div>         
                                </div>
                            </tpl:condition>
                            <tpl:condition data="page.activeaside" test="boolean" value="0"> 
                                <div class="main-block">
                                    <div class="main-block-content">
                                        <div class="row-fluid">
                                            <div class="span12"> 
                                                <tpl:block data="page.block.body">Content</tpl:block>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tpl:condition>
                        </section>
                    </tpl:condition>
                    <tpl:condition data="page.activesidebar" test="boolean" value="0"> 
                        <section class="layout-block boxed">  
                            <tpl:condition data="page.activeaside" test="boolean" value="1"> 
                                <div class="main-block has-main-block-aside">
                                    <div class="main-block-aside  top-pad bottom-pad right-pad">
                                        <tpl:block data="page.block.aside">Asidebar</tpl:block>
                                    </div>
                                    <div class="main-block-content">
                                        <div class="row-fluid">
                                            <div class="span12"> 
                                                <tpl:block data="page.block.body">Content</tpl:block>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tpl:condition>
                            <tpl:condition data="page.activeaside" test="boolean" value="0"> 
                                <div class="main-block">
                                    <div class="main-block-content">
                                        <div class="row-fluid">
                                            <div class="span12"> 
                                                <tpl:block data="page.block.body">Content</tpl:block>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tpl:condition>
                        </section>
                    </tpl:condition>
                    <tpl:import layout="footer" />    
                </div>
            </div>
            <tpl:import layout="console" />
        </body>
    </html>
</tpl:layout>
