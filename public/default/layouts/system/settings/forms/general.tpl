<tpl:layout name="general" xmlns:tpl="http://budkit.org/tpl">
    <fieldset class="no-margin">
        <div class="control-group">
            <label class="control-label" for="options[general][site-name]"> <?php echo _('Website Name'); ?></label>
            <div class="controls">
                <input type="text" name="options[general][site-name]"  class="input-xxxlarge" placeholder="e.g MySocialNetwork" value="<?php echo $this->config->getParam('site-name',''); ?>" />
                <span class="help-block">A unique catchy name to identify your website. This will show as the default page titles</span>
            </div>
        </div>                   
        <div class="control-group">
            <label class="control-label" for="options[general][site-meta-description]"> <?php echo _('Website description'); ?></label>
            <div class="controls">
                <textarea name="options[general][site-meta-description]" class="wysiwyg input-xxxlarge" rows="8" ><?php echo $this->config->getParam('site-meta-description',''); ?></textarea>
                <span class="help-block">Describe your community, its interest and purpose. </span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="options[general][site-meta-keywords]"> <?php echo _('Website Keywords'); ?></label>
            <div class="controls">
                <textarea name="options[general][site-meta-keywords]" class="wysiwyg input-xxxlarge" ><?php echo $this->config->getParam('site-meta-keywords',''); ?></textarea>
                <span class="help-block">Lists as many keywords that may promote your listing in some search engines</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="options[general][site-allow-registration]">Registration</label>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="options[general][site-allow-registration]" value="1" />
                    Allow new user registration?
                </label>
                <label class="checkbox">
                    <input type="checkbox" name="options[general][site-inviteonly]" value="1" />
                    New user registration by invite only.
                </label>
                <label class="checkbox">
                    <input type="checkbox" name="options[general][site-verify-email]" value="1" />
                    Verify newly registered user by email
                </label>
            </div>
        </div>
        <hr />
        <div class="control-group row-fluid">
            <div class="span6">
                <label class="control-label" for="options[general][site-page-title]"> <?php echo _('Website page titles'); ?></label>
                <div class="controls">
                    <select name="options[general][site-page-title]" class="input-xxxlarge">
                        <option value="as-is"><?php echo _('Leave as is'); ?></option>
                        <option value="name-last"><?php echo _('Prepend website name'); ?></option>
                        <option value="name-first"><?php echo _('Append website name'); ?></option>
                    </select>
                    <span class="help-block">By default the page title is the website name.</span>
                </div>
            </div>
            <div class="span6">
                <label class="control-label" for="options[general][site-robots]"> <?php echo _('Robot Instructions'); ?></label>
                <div class="controls">
                    <select name="options[general][site-robots]" class="input-xxxlarge">
                        <option value="index-follow"><?php echo _('Index, Follow'); ?></option>
                        <option value="no-index-follow"><?php echo _('No Index, Follow'); ?></option>
                        <option value="index-no-follow"><?php echo _('Index, No Follow'); ?></option>
                        <option value="no-index-no-follow"><?php echo _('No Index, No Follow'); ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="options[general][site-seo]">Search Engine Optimization</label>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="options[general][site-url-suffix]" value="1" />
                    Add output format suffix to URLs?
                </label>
                <label class="checkbox">
                    <input type="checkbox" name="options[general][site-unicode-aliases]" value="1" />
                    Use Unicode Aliasis.
                </label>
            </div>
        </div>
    </fieldset>
    <hr />
</tpl:layout>