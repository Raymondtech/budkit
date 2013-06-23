<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:import layout="title" app="settings" />
    <div class="padding">    
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
                                            <label class="control-label" for="options[emails][verification-subject]">Email Verification Subject</label>
                                            <div class="controls">
                                                <input type="text" name="options[emails][verification-subject]" class="input-xxlarge" value="${config|emails.verification-subject}" />                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="options[emails][verification-body]">Email Verification</label>
                                            <div class="controls">
                                                <textarea name="options[emails][verification-body]" rows="8" class="wysiwyg input-xxlarge">
                                                       <tpl:element type="text" data="config|emails.verification-body" />
                                                </textarea>
                                                <span class="help-block"><strong>Available variables:</strong> @{link}</span>
                                            </div>
                                        </div>

                                    </fieldset>
                                    <div class="form-actions">                 
                                        <button type="submit" class="btn">Save Template</button>
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
                                            <label class="control-label" for="options[emails][notification-subject]">Notification Email Subject</label>
                                            <div class="controls">
                                                <input type="text" name="options[emails][notification-subject]" class="input-xxlarge" value="${config|emails.notification-subject}" />                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="options[emails][notification-body]">Notification Email Body</label>
                                            <div class="controls">
                                                <textarea name="options[emails][notification-body]" rows="8" class="wysiwyg input-xxlarge" >
                                                       <tpl:element type="text" data="config|emails.notification-body" />
                                                </textarea>
                                                <span class="help-block"><strong>Available variables:</strong>@{subject}, @{summary}, @{link} </span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-actions">                 
                                        <button type="submit" class="btn">Save Template</button>
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


