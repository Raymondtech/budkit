<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><tpl:element type="text" data="page.title">BudKit</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="${page.description}" />
            <meta name="author" content="${page.author}" />
            <meta name="keywords" content="${page.author}" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!-- Le styles -->
            <link href="/${config|design.template}/assets/css/bootstrap.css" rel="stylesheet" />
            <link href="/${config|design.template}/assets/css/bootstrap-responsive.css" rel="stylesheet" />

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="/${config|design.template}/assets/js/html5shiv.js"></script>
            <![endif]-->
            <!--[if IE 7]>
                <link rel="stylesheet" href="/${config|design.template}/assets/css/font-awesome-ie7.css">
            <![endif]-->

            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/${config|design.template}/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/${config|design.template}/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/${config|design.template}/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="/${config|design.template}/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="/${config|design.template}/assets/ico/favicon.png" />

            <!-- jQuery here because if placed at bottom, in-line scripts (i.e script tags in .tpl files) won't work -->
            <script src="/${config|design.template}/assets/js/jquery.js"></script>
            <script src="/${config|design.template}/assets/js/budkit.js"></script>
            <tpl:utility type="head" />
        </head>
        <body>
<!--            <tpl:import layout="navbar" />-->
            <div id="wrap">            
                <div class="container-left">                 
                    <tpl:import layout="sidebar" />
                </div>
                <tpl:condition data="page.block.aside" test="isset" value="1">
                    <div class="container-aside">
                        <tpl:block data="page.block.aside" />
                    </div>
                </tpl:condition>
                <div class="container-box">       
                    <div class="container-right">

                        <div class="container-content">
                            <div class="container-bucket">
                                <tpl:block data="page.block.alerts" /> 
                                <tpl:block data="page.block.body" />
                                <tpl:import layout="footer" />
                            </div>
<!--                            <a href="#" class="container-left-toggle toggler" data-toggle="container-left"><i class="icon-chevron-left"></i></a>
                            <a href="#" class="container-right-toggle toggler" data-toggle="container-aside"><i class="icon-chevron-left"></i></a>-->
                        </div>
                    </div>
                </div><!--/.fluid-container-->

            </div>
            <!--/.content-slider-->
            <tpl:import layout="slider" />
            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="/${config|design.template}/assets/js/bootstrap-transition.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-alert.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-modal.js"></script>
            <script src="/${config|design.template}/assets/js/budkit-container.js"></script>
            <script src="/${config|design.template}/assets/js/budkit-mediagrid.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-dropdown.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-scrollspy.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tab.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-affix.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tooltip.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-popover.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-button.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-collapse.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-carousel.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>
