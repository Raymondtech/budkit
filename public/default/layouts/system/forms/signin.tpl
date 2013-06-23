<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form id="form" name="login_form" method="post" class="margin-bottom-zero" action="/system/authenticate/login"> 
        <div class="container-startup signin">
            <div class="startup-body"> 
                <tpl:condition data="tempauth" test="isset" value="1">
                    <div class="control-group heading background-${tempauth.provider}">
                        <label class="control-label margin-bottom-half"><strong><tpl:element type="text" formatting="sprintf" cdata="Hello %s" data="tempauth.name" /></strong><a href="/system/authenticate/login/cleartemp:1/" class="pull-right" >Not You?</a> </label>
                        <div class="controls row-fluid">
                           
                            <div class="span12">
                                <img src="${tempauth.image}" class="pull-left margin-right-half"  />
                                <span class="help-block"><tpl:element type="text" formatting="sprintf" cdata="Pair an existing account with this %s account" data="tempauth.provider" /></span>                            
                            </div>
                        </div>
                           
                        <input name="user_${tempauth.provider}" value="${tempauth.token}" type="hidden" />
                    </div>
                </tpl:condition>
                <div class="control-group">
                    <label class="control-label" for="user_name_id"><?php echo _('Registered Username or Email'); ?><em class="mandatory">*</em></label>
                    <div class="controls row-fluid">
                        <input class="input-xxxlarge focused span12" id="user_name_id" name="user_name_id" type="text" placeholder="JohnDoe1976" value="${tempauth.email}" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="user_password"><tpl:i18n>Password or API Key</tpl:i18n><em class="mandatory">*</em></label>
                    <div class="controls row-fluid">
                        <input class="input-xxxlarge focused span12" id="user_password" name="user_password" type="password" />
                    </div>
                </div>
                <ul class="unstyled margin-top margin-bottom-zero nav nav-pills">
                    <li class="pull-right"><a href="/index.php">Forgot your password?</a></li>
                    <li>
                        <button type="submit" class="btn margin-bottom-zero" >Sign In</button>
                    </li>
                </ul>
                <input type="hidden" name="handler" value="dbauth" />
                <input type="hidden" name="redirect" value="${lasturl}" />
                <hr />
                <tpl:condition data="alternatives" test="isset" value="1">
                    <div class="control-group margin-top margin-bottom-zero">
                        <span class="help-block margin-bottom-half">Sign In with..</span>
                        <div class="controls row-fluid margin-bottom-zero">
                            <tpl:loop data="alternatives" id="login-alt">
                                <tpl:condition data="link" test="isset" value="1">
                                    <a href="${link}" class="btn btn-${uid} btn-medium margin-bottom-half span6"><tpl:element type="text" data="title" /></a>
                                </tpl:condition>
                            </tpl:loop>
                        </div>
                    </div>
                </tpl:condition>
            </div>
            <tpl:condition test="boolean" data="config|general.site-allow-registration" value="1">
                <div class="startup-alternatives bottom">
                    <ul class="unstyled no-margin">
                        <li><a href="/system/authenticate/create">Don't have an account?</a></li>
                    </ul>
                </div>
            </tpl:condition>
        </div>
    </form>
</tpl:layout>