<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form method="POST" action="/settings/system/save" class="form-horizontal margin-top">
        <fieldset class="no-margin">
            <div class="control-group">
                <label class="control-label" for="options[content][content-editor]"> <?php echo _('Content Editor'); ?></label>
                <div class="controls">
                    <select name="options[content][content-editor]" class="input-xlarge">
                        <option value="none"><?php echo _('None'); ?></option>
                        <option value="tinymce"><?php echo _('TinyMCE'); ?></option>
                        <option value="codemirror"><?php echo _('CodeMiror'); ?></option>
                    </select>
                    <span class="help-block">By default the page title is the website name.</span>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[content][incoming-mail-address]"> <?php echo _('Incoming E-Mail'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][incoming-mail-address]" class="input-xxlarge" placeholder="e.g info@mydomain.com" value="<?php echo $this->config->getParam('incoming-mail-address','','content'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][incoming-mail-server]"> <?php echo _('Incoming Mail Server'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][incoming-mail-server]" class="input-xxlarge" placeholder="e.g http://webmail.mydomain.com" value="<?php echo $this->config->getParam('incoming-mail-server','','content'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][incoming-mail-server-username]"> <?php echo _('Incoming Mail Server Username'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][incoming-mail-server-username]" class="input-xxlarge" value="<?php echo $this->config->getParam('incoming-mail-server-username','','content'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][incoming-mail-server-password]"> <?php echo _('Incoming Mail Server Password'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][incoming-mail-server-password]" class="input-xxlarge" value="<?php echo $this->config->getParam('incoming-mail-server-password','','content'); ?>" />
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[content][copyright-notice]"> <?php echo _('Content Rights'); ?></label>
                <div class="controls">
                    <textarea name="options[content][copyright-notice]" class="wysiwyg input-xxlarge" ><?php echo $this->config->getParam('copyright-notice','','content'); ?></textarea>
                    <span class="help-block">A brief copyright notice displayed at the bottom of your content</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][display]">Content Display</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[content][display-copyright-notice]" value="1" />
                        Display Content Rights?
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[content][display-author-meta]" value="1" />
                        Show Author meta-tag.
                    </label>
                </div>
            </div>
        </fieldset>
        <hr />
        <fieldset class="no-margin">
            <div class="control-group">
                <label class="control-label" for="options[content][users-folder]"> <?php echo _('Users folder'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][users-folder]" class="input-xxlarge" placeholder="/" value="<?php echo $this->config->getParam('users-folder','','content'); ?>" />
                    <span class="help-block">Used to store all user content, within username subdirectories.</span>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[content][FTP-server-host]"> <?php echo _('FTP Server Host'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][FTP-server-host]" class="input-xxlarge" placeholder="e.g http://proxy.mydomain.com" value="<?php echo $this->config->getParam('FTP-server-host','','content'); ?>"  />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][FTP-server-port]"> <?php echo _('FTP Server Port'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][FTP-server-port]" class="input-xxlarge"  value="<?php echo $this->config->getParam('FTP-server-port','','content'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][FTP-server-username]"> <?php echo _('FTP Username'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][FTP-server-username]" class="input-xxlarge" value="<?php echo $this->config->getParam('FTP-server-username','','content'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][FTP-server-password]"> <?php echo _('FTP Password'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][FTP-server-password]" class="input-xxlarge" value="<?php echo $this->config->getParam('FTP-server-password','','content'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[content][FTP-root-path]"> <?php echo _('FTP Root Path'); ?></label>
                <div class="controls">
                    <input type="text" name="options[content][FTP-root-path]" class="input-xxlarge" value="<?php echo $this->config->getParam('FTP-root-path','/','content'); ?>" />
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="options_group" value="system-config" />
        <div class="form-actions">                 
            <button type="submit" class="btn">Save Preferences</button>
        </div>
    </form>
</tpl:layout>


