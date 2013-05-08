<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><tpl:element type="text" data="page.title">BudKit</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Le styles -->
            <link href="/${config|design.template}/assets/css/prettify.css" rel="stylesheet" />
            <link href="/${config|design.template}/assets/css/bootstrap.css" rel="stylesheet" />
            <link href="/${config|design.template}/assets/css/bootstrap-responsive.css" rel="stylesheet" />

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="/${config|design.template}/assets/js/html5shiv.js"></script>
            <![endif]-->

            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/${config|design.template}/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/${config|design.template}/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/${config|design.template}/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="/${config|design.template}/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="/${config|design.template}/assets/ico/favicon.png" />
            
            <tpl:utility type="head" />
        </head>
        <body onload="prettyPrint()">
            <div id="wrap">            
                <div class="container-box has-navbar">
                    <div class="container-right">
                        <tpl:import layout="navbar" />
                        <div class="container-content scroll-y">
                            <div class="container-startup canvas">
                                <div class="startup-header">
                                    <h3><tpl:element type="text" data="page.title">There was an error</tpl:element></h3>
                                </div>
                                <tpl:block data="page.block.alerts" />
                                <div class="startup-body">
                                    <article>
                                        <div>
                                            <tpl:block data="page.block.content" return="true">   
                                                <p tpl:i18n="">Sorry, but the page you were trying to view does not exist. It looks like this was the result of either: a mistyped address, an out-of-date link, or our engineers have messed things up!</p>
                                            </tpl:block>                    
                                        </div>
                                        <hr />
                                        <div>
                                            <tpl:block data="page.block.actions" return="true"><a  href="/" tpl:i18n="">Return to Home Page</a></tpl:block>
                                        </div>
                                    </article>
                                    <hr />
                                    <tpl:import layout="console" />
                                    <div class="form-actions padding-left-zero">
                                        <div class="btn-group">
                                            <button type="submit" class="btn" tpl:i18n="">Report Bug?</button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.fluid-container-->
            </div>
            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="/${config|design.template}/assets/js/jquery.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-transition.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-alert.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-modal.js"></script>
            <script src="/${config|design.template}/assets/js/budkit-container.js"></script>
            <script src="/${config|design.template}/assets/js/prettify.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-dropdown.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-scrollspy.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tab.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tooltip.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-popover.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-button.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-collapse.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-carousel.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>
