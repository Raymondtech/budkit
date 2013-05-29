<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:import layout="title" app="settings" />
    <form method="POST" action="/settings/system/save" class="form-vertical margin-top-zero padding">
        <fieldset class="no-margin">
            <div class="control-group">
                <label class="control-label" for="options[general][site-name]">Website Name</label>
                <div class="controls">
                    <input type="text" name="options[general][site-name]"  class="input-xxlarge" placeholder="e.g MySocialNetwork" value="${config|general.site-name}" />
                    <span class="help-block">A unique catchy name to identify your website. This will show as the default page titles</span>
                </div>
            </div>                   
            <div class="control-group">
                <label class="control-label" for="options[general][site-meta-description]">Website description</label>
                <div class="controls">
                    <textarea name="options[general][site-meta-description]" class="wysiwyg input-xxlarge" rows="8" >
                        <tpl:element type="text" data="config|general.site-meta-description" />
                    </textarea>
                    <span class="help-block">Describe your community, its interest and purpose. </span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[general][site-meta-keywords]">Website Keywords</label>
                <div class="controls">
                    <textarea name="options[general][site-meta-keywords]" class="wysiwyg input-xxlarge" >
                        <tpl:element type="text" data="config|general.site-meta-keywords" />
                    </textarea>
                    <span class="help-block">Lists as many keywords that may promote your listing in some search engines</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[general][site-allow-registration]">Registration</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="options[general][site-allow-registration]" value="0" />
                        <tpl:input type="checkbox" name="options[general][site-allow-registration]" value="1" data="config|general.site-allow-registration" />
                        <span>Allow new user registration?</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="options[general][site-inviteonly]" value="0" />
                        <tpl:input type="checkbox" name="options[general][site-inviteonly]" value="1" data="config|general.site-inviteonly" />
                        <span>New user registration by invite only.</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="options[general][site-verify-email]" value="0" />
                        <tpl:input type="checkbox" name="options[general][site-verify-email]" value="1" data="config|general.site-verify-email" />
                        <span>Verify newly registered user by email</span>
                    </label>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label class="control-label" for="options[general][site-default-authority]">Default Authority</label>
                <div class="controls">
                    <tpl:select name="options[general][site-default-authority]"  class="input-xxlarge" value="config|general.site-default-authority">
                        <tpl:loop data="authorities" id="authority-items">
                            <option value="${authority_id}">
                                <tpl:loop limit="indent" id="authority-indent">
                                    <tpl:element type="text">|--</tpl:element>
                                </tpl:loop>
                                <tpl:element type="text" data="authority_title"  />
                            </option>
                        </tpl:loop>
                    </tpl:select>
                    <span class="help-block">The default authority group members will be automatically added to at sign-up</span>
                </div>
            </div>

            <hr />
            <div class="control-group">
                <label class="control-label" for="options[general][site-page-title]">Page titles</label>
                <div class="controls">
                    <tpl:select name="options[general][site-page-title]" class="input-xxlarge" value="config|general.site-page-title">
                        <option value="as-is">Leave as is</option>
                        <option value="name-last">Prepend website name</option>
                        <option value="name-first">Append website name</option>
                    </tpl:select>
                    <span class="help-block">By default the page title is the website name.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[general][site-robots]">Robot Instructions</label>
                <div class="controls">
                    <tpl:select name="options[general][site-robots]"  class="input-xxlarge" value="config|general.site-robots">
                        <option value="index-follow">Index, Follow</option>
                        <option value="no-index-follow">No Index, Follow</option>
                        <option value="index-no-follow">Index, No Follow</option>
                        <option value="no-index-no-follow">No Index, No Follow</option>
                    </tpl:select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[general][site-seo]">SEO</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="options[general][site-url-suffix]" value="0" />
                        <tpl:input type="checkbox" name="options[general][site-url-suffix]" data="config|general.site-url-suffix" value="1" />
                        <span>Add output format suffix to URLs?</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="options[general][site-unicode-aliases]" value="0" />
                        <tpl:input type="checkbox" name="options[general][site-unicode-aliases]" data="config|general.site-unicode-aliases" value="1" />
                        <span>Use Unicode Aliasis.</span>
                    </label>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="options_group" value="system-config" />
        <div class="form-actions">                 
            <button type="submit" class="btn">Save Preferences</button>
        </div>
    </form>
</tpl:layout>


