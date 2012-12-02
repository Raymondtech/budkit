<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <html class="no-js" lang="en">
        <head>
            <title><tpl:element type="text" data="page.title">Sign In</tpl:element></title>
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
        </head>
        <body  class="responsive-body">
            

            <div class="container">
                <tpl:import layout="navbar" />
                <tpl:block data="page.block.alerts" />             
                <tpl:block data="page.block.banner">Banner</tpl:block>
                <section class="layout-block boxed has-bg has-aside-block">  
                    <div class="aside-block right-pad">  
                        <div class="row-fluid">

                            <form id="form" name="login_form" method="post" action="/member/session/start">                       
                                <fieldset class="no-margin">
                                    <legend tpl:i18n="">Sign in to your account</legend>
                                    <div class="control-group">
                                        <label class="control-label" for="user_name_id"><?php echo _('Registered Username or Email'); ?><em class="mandatory">*</em></label>
                                        <div class="controls row-fluid">
                                            <input class="input-xxxlarge focused span12" id="user_name_id" name="user_name_id" type="text" placeholder="JohnDoe1976" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="user_password"><tpl:i18n>Password or API Key</tpl:i18n><em class="mandatory">*</em></label>
                                        <div class="controls row-fluid">
                                            <input class="input-xxxlarge focused span12" id="user_password" name="user_password" type="password" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <label class="checkbox">
                                                <input type="checkbox" name="user_session_save" value="1" />
                                                <tpl:i18n>Save my login details for 14 days</tpl:i18n>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="btn-toolbar">
                                    <div class="btn-group row-fluid">
                                        <button type="submit" class="btn span12" tpl:i18n="">Sign in</button> 
                                    </div>
                                </div>

                                <hr />

                                <div class="btn-toolbar">
                                    <div class="row-fluid">
                                        <button type="submit" class="btn span6 btn-facebook" tpl:i18n="">Facebook</button> 
                                        <button type="submit" class="btn span6 btn-twitter" tpl:i18n="">Twitter</button>
                                    </div>
                                </div>

                                <input type="hidden" name="auth_handler" value="dbauth" />
                                <input type="hidden" name="redirect" value="" />
                                <ul class="top-pad">
                                    <li><a href="/index.php" tpl:i18n="">Alternative ways to sign in</a></li>
                                    <li><a href="/index.php" tpl:i18n="">Forgot your password?</a></li>
                                    <li><a href="/member/account/create" tpl:i18n="">Don't have an account?</a></li>
                                </ul>

                            </form>

                        </div>
                        <tpl:block data="page.block.side">Sidebar</tpl:block>
                    </div>
                    <div class="main-block">

                        <div class="row-fluid">
                            <div class="span12"> 
                                <form id="form" name="form" method="post" action="/member/account/update">
                                    <fieldset class="no-margin">
                                        <legend tpl:i18n="">Register a new account</legend>
                                        <div class="control-group">
                                            <label class="control-label" for="user_name"><tpl:i18n>First Name</tpl:i18n><em class="mandatory">*</em></label>
                                            <div class="controls row-fluid">
                                                <input class="input-large focused span12" id="first_name" name="user_first_name" type="text" placeholder="Johnatan" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="user_name"><tpl:i18n>Last Name</tpl:i18n><em class="mandatory">*</em></label>
                                            <div class="controls row-fluid">
                                                <input class="input-large focused span12" id="last_name" name="user_last_name" type="text" placeholder="Johnatan" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="user_name_id"><tpl:i18n>Unique Username</tpl:i18n><em class="mandatory">*</em></label>
                                            <div class="controls row-fluid">
                                                <input class="input-large focused span12" id="user_name_id" name="user_name_id" type="text" placeholder="JohnDoe1976" />
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="user_email"><tpl:i18n>Email address</tpl:i18n><em class="mandatory">*</em></label>
                                            <div class="controls row-fluid">
                                                <input class="input-large focused span12" id="user_email" name="user_email" type="text" placeholder="<?php echo _('e.g john.doe@example.com'); ?>" />
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="user_password"><tpl:i18n>Password</tpl:i18n><em class="mandatory">*</em></label>
                                            <div class="controls row-fluid">
                                                <input class="input-large focused span12" id="user_password" name="user_password" type="password" />
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="user_password_2"><tpl:i18n>Verify Password</tpl:i18n><em class="mandatory">*</em></label>
                                            <div class="controls row-fluid">
                                                <input class="input-large focused span12" id="user_password_2" name="user_password_2" type="password" />
                                            </div>
                                        </div>

                                    </fieldset>
                                    <fieldset>

                                        <div class="control-group">

                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="user_accepted_terms" value="1" />
                                                    You agree to our <a href="#">terms and conditions</a>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="user_accepted_terms_2" value="2" />
                                                    You agree to our <a href="#">privacy policy</a>
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <button type="submit" class="btn" tpl:i18n="">Create an Account</button> 
                                        </div>
                                        <div class="btn-group">
                                            <button type="reset" class="btn" tpl:i18n="">Cancel</button> 
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </section>
                <tpl:import layout="footer" />    
            </div>
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-1.7.1.min.js' type="text/javascript"></script>
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-ui.min.js' type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/modernizr-2.0.6.min.js" type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/bootstrap.js" type="text/javascript"></script>
        </body>

    </html>
</tpl:layout>
