<tpl:layout xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta charset="utf-8"/>
            <title><tpl:element type="text" data="page.title">SocialKit</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <meta name="keywords" content="" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Le styles -->
            <link href="/${config|appearance.template}/themes/${config|appearance.template}/style.css" rel="stylesheet" />
<!--            <link href="/${config|appearance.template}/assets/css/bootstrap-responsive.css" rel="stylesheet" />-->

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="/${config|appearance.template}/assets/js/html5shiv.js"></script>
            <![endif]-->

            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/${config|appearance.template}/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/${config|appearance.template}/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/${config|appearance.template}/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="/${config|appearance.template}/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="/${config|appearance.template}/assets/ico/favicon.png" />

            <!-- jQuery here because if placed at bottom, in-line scripts (i.e script tags in .tpl files) won't work -->
            <script type="text/javaScript" src="/${config|appearance.template}/assets/js/jquery.js"></script>
            <script type="text/javaScript" src="/${config|appearance.template}/assets/js/budkit.js"></script>
        </head>
        <body>
            <div id="wrap">
                <tpl:import layout="navbar" />
                <div class="container-left">
                    <tpl:condition data="profile.user_photo" test="isset" value="1">
                        <img class="profile-avatar" src="/system/object/${profile.user_photo}/resize/195" style="margin: auto" />
                    </tpl:condition>
                    <tpl:menu id="profilemenu" type="nav-list" />
                </div>
                <div class="container-box has-left">
                    <div class="container-content">
                        <div class="container-bucket">
                            <div class="left-contain container">
                                <div class="clearfix profile-cover" align="center">
                                    <h1><tpl:element type="text" data="profile.user_full_name" /></h1>
                                    <tpl:condition data="profile.user_headline" test="isset" value="1">
                                        <p class="lead"><tpl:element type="text" data="profile.user_headline" /></p>
                                    </tpl:condition>
                                </div>
                                <tpl:block data="page.block.alerts" /> 
                                <tpl:block data="page.block.body">Content</tpl:block>
                                <tpl:import layout="slider" />
                                <div class="footer padding">
                                    <p><tpl:element type="text" formatting="sprintf" cdata="&copy; %s" data="profile.user_full_name"  /></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="/${config|appearance.template}/assets/js/bootstrap-transition.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-alert.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-modal.js"></script>
            <script src="/${config|appearance.template}/assets/js/budkit-container.js"></script>
            <script src="/${config|appearance.template}/assets/js/budkit-mediagrid.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-dropdown.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-scrollspy.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-tab.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-affix.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-tooltip.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-popover.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-button.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-collapse.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-carousel.js"></script>
            <script src="/${config|appearance.template}/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>
