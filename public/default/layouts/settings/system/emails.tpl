<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <div class="clearfix">        
            <ul class="nav nav-pills no-margin">
                <li class="highlighted"><a href="/settings/system/server" >Mail Server Settings</a></li>
            </ul>
        </div>
        <hr />
        <div class="widget">
            <div class="widget-head"><span class="widget-title">Email Settings and Templates</span></div>
            <div class="widget-body">
                <form method="POST" action="/settings/system/save" class="form-vertical">
                    <div class="accordion" id="email-template-collapse">
                        <div class="accordion-group" id="email-template-collapse">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#email-template-collapse" href="#email-verification">
                                    Email verification
                                </a>
                            </div>
                            <div id="email-verification" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <fieldset class="no-margin">
                                        <div class="control-group">
                                            <label class="control-label" for="options[general][site-users-folder]">Email Verification Title</label>
                                            <div class="controls">
                                                <input type="text" name="options[general][site-users-folder]" class="input-xxlarge" placeholder="/" value="${config|emails.site-users-folder}" />                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="options[emails][email-verification]">Email Verification</label>
                                            <div class="controls">
                                                <textarea name="options[emails][email-verification]" rows="8" class="wysiwyg input-xxlarge" >
                                                       <tpl:element type="text" data="config|mail.email-verification" />
                                                </textarea>
                                                <span class="help-block">Use link, name, username</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="options[content][display-copyright-notice]" value="1" />
                                                    User Password
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="options[content][display-author-meta]" value="1" />
                                                    Show Author meta-tag.
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-actions">                 
                                        <button type="submit" class="btn">Save Preferences</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-group" id="email-template-collapse">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#email-template-collapse" href="#notification-email">
                                    Notification email
                                </a>
                            </div>
                            <div id="notification-email" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <fieldset class="no-margin">
                                        <div class="control-group">
                                            <label class="control-label" for="options[general][site-users-folder]">Notification Email Subject</label>
                                            <div class="controls">
                                                <input type="text" name="options[general][site-users-folder]" class="input-xxlarge" placeholder="/" value="${config|emails.site-users-folder}" />                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="options[emails][email-verification]">Notification Email Body</label>
                                            <div class="controls">
                                                <textarea name="options[emails][email-verification]" rows="8" class="wysiwyg input-xxlarge" >
                                                       <tpl:element type="text" data="config|mail.email-verification" />
                                                </textarea>
                                                <span class="help-block">Use link, name, username</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="options[content][display-copyright-notice]" value="1" />
                                                    User Password
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="options[content][display-author-meta]" value="1" />
                                                    Show Author meta-tag.
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-actions">                 
                                        <button type="submit" class="btn">Save Preferences</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="options_group" value="system-config" />
                </form>
            </div>            
        </div>
    </div>
</tpl:layout>


