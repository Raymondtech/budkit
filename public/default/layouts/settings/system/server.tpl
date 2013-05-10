<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form method="POST" action="/settings/system/save" class="form-horizontal margin-top-double">
        <fieldset class="no-margin">
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-handler]">Mail Handler</label>
                <div class="controls">
                    <tpl:select name="options[server][mail-handler]" class="input-xlarge" value="config|server.mail-handler">
                        <option value="phpmail">PHP Mail</option>
                        <option value="sendmail">Send Mail</option>
                        <option value="smtp">SMTP</option>
                    </tpl:select>
                    <span class="help-block">Leave as is if not sure or ask your host provider.</span>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-address]">From e-Mail</label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-address]" class="input-xxlarge" placeholder="e.g info@mydomain.com" value="${config|server.outgoing-mail-address}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server]">Mail Server </label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server]" class="input-xxlarge" placeholder="e.g http://webmail.mydomain.com" value="${config|server.outgoing-mail-server}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-port]">Mail  Port</label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server-port]" value="${config|server.outgoing-mail-server-port}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-security]">Mail Security</label>
                <div class="controls">
                    <select name="options[server][outgoing-mail-server-security]"  value="config|server.outgoing-mail-server-security">
                        <option value="none">None</option>
                        <option value="ssl">SSL</option>
                        <option value="tsl">TSL</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-username]">Mail Username</label>
                <div class="controls">
                    <input type="text" name="options[server][outgoing-mail-server-username]"  value="${config|server.outgoing-mail-server-username}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][outgoing-mail-server-password]"> Mail Password</label>
                <div class="controls">
                    <input type="password" name="options[server][outgoing-mail-server-password]"  value="${config|server.outgoing-mail-server-password}" />
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server]">Proxy Server</label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server]" class="input-xxlarge" placeholder="e.g http://proxy.mydomain.com" value="${config|server.proxy-server}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server-port]">Proxy Port</label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server-port]" value="${config|server.proxy-server-port}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server-username]">Proxy Username</label>
                <div class="controls">
                    <input type="text" name="options[server][proxy-server-username]" value="${config|server.proxy-server-username}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][proxy-server-password]">Proxy Password</label>
                <div class="controls">
                    <input type="password" name="options[server][proxy-server-password]"  value="${config|server.proxy-server-password}" />
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][protocols]">Protocols</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="options[server][enable-xmlrpc]" value="0" />
                        <tpl:input type="checkbox" name="options[server][enable-xmlrpc]" value="1" data="config|server.enable-xmlrpc" />
                        <span>Enable XML-RPC Protocol?</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="options[server][enable-restful]" value="0" />
                        <tpl:input type="checkbox" name="options[server][enable-restful]" value="1" data="config|server.enable-restful" />
                        <span>Enable RESTful Protocol.</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="options[server][protocol-auth]" value="0" />
                        <tpl:input type="checkbox" name="options[server][protocol-auth]" value="1"  data="config|server.protocol-auth" />
                        <span>Require Authentication to use protocol</span>
                    </label>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[server][error-log]">System ErrorLog</label>
                <div class="controls">
                    <input type="text" name="options[server][error-log]" class="input-xxlarge" value="${config|server.error-log}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][help-server-address]">Help Server</label>
                <div class="controls">
                    <input type="text" name="options[server][help-server-address]" class="input-xxlarge" placeholder="e.g http://api.helpserver.com" value="${config|server.help-server-address}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[server][error-reporting]">Error Reporting</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="options[server][error-console]" value="0" />
                        <tpl:input type="checkbox" name="options[server][error-console]" value="1" data="config|server.error-console" />
                        <span>Display debug console</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="options[server][error-send]" value="0" />
                        <tpl:input type="checkbox" name="options[server][error-send]" value="1" data="config|server.error-send" />
                        <span>Send Errors to developers to help improve platform</span>
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


