<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
    <form method="POST" action="/settings/system/save" class="form-horizontal margin-top">
        <fieldset class="no-margin">
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-handler]"> <?php echo _('Mail Handler'); ?></label>
                <div class="controls">
                    <select name="options[server][mail-handler]" class="input-xlarge">
                        <option value="phpmail"><?php echo _('PHP Mail'); ?></option>
                        <option value="sendmail"><?php echo _('Send Mail'); ?></option>
                        <option value="smtp"><?php echo _('SMTP'); ?></option>
                    </select>
                    <span class="help-block">The Outgoing mail handler. Leave as is if not sure or ask your host provider.</span>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-address]"> <?php echo _('Outgoing E-Mail'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-address]" class="input-xxlarge" placeholder="e.g info@mydomain.com" value="<?php echo $this->config->getParam('outgoing-mail-address','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server]"> <?php echo _('Outgoing Mail Server'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server]" class="input-xxlarge" placeholder="e.g http://webmail.mydomain.com" value="<?php echo $this->config->getParam('outgoing-mail-server','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-port]"> <?php echo _('Outgoing Mail Server Port'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server-port]" class="input-xxlarge" value="<?php echo $this->config->getParam('outgoing-mail-server-port','25','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-security]"> <?php echo _('Server Security'); ?></label>
                <div class="controls">
                    <select name="options[server][outgoing-mail-server-security]" class="input-xlarge">
                        <option value="none"><?php echo _('None'); ?></option>
                        <option value="ssl"><?php echo _('SSL'); ?></option>
                        <option value="tsl"><?php echo _('TSL'); ?></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-username]"> <?php echo _('Outgoing Mail Server Username'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server-username]" class="input-xxlarge" value="<?php echo $this->config->getParam('outgoing-mail-server-username','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-password]"> <?php echo _('Outgoing Mail Server Password'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server-password]" class="input-xxlarge" value="<?php echo $this->config->getParam('outgoing-mail-server-password','','server'); ?>" />
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server]"> <?php echo _('Proxy Server'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server]" class="input-xxlarge" placeholder="e.g http://proxy.mydomain.com" value="<?php echo $this->config->getParam('proxy-server','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server-port]"> <?php echo _('Proxy Server Port'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server-port]" class="input-xxlarge" value="<?php echo $this->config->getParam('proxy-server-port','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server-username]"> <?php echo _('Proxy Server Username'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server-username]" class="input-xxlarge" value="<?php echo $this->config->getParam('proxy-server-username','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server-password]"> <?php echo _('Proxy Server Password'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server-password]" class="input-xxlarge" value="<?php echo $this->config->getParam('proxy-server-password','','server'); ?>" />
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][protocols]">Protocols</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[server][enable-xmlrpc]" value="1" />
                        Enable XML-RPC Protocol?
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[server][enable-restful]" value="1" />
                        Enable RESTful Protocol.
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[server][protocol-auth]" value="1" />
                        Require Authentication to use protocol
                    </label>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][error-log]"> <?php echo _('System ErrorLog'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][error-log]" class="input-xxlarge" value="<?php echo $this->config->getParam('error-log','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][help-server-address]"> <?php echo _('Help Server'); ?></label>
                <div class="controls">
                    <input type="text" name="options[server][help-server-address]" class="input-xxlarge" placeholder="e.g http://api.helpserver.com" value="<?php echo $this->config->getParam('help-server-address','','server'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][error-reporting]">Error Reporting</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[server][error-console]" value="1" />
                        Display debug console
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[server][error-send]" value="1" />
                        Send Errors to Developers to help improve platform
                    </label>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="options_group" value="system-config" />
        <div class="form-actions">                 
            <button type="submit" class="btn">Save Server Preferences</button>
        </div>
    </form>
</tpl:layout>


