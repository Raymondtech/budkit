<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <ul class="nav" id="configurationsmenu">
                <li class="active"><a data-target="#general" data-toggle="tab"><i class="icon-cog icon icon-16"></i>General</a></li>
                <li><a data-target="#server" data-toggle="tab"><i class="icon-building icon icon-16"></i>Server</a></li>
                <li><a data-target="#profile" data-toggle="tab"><i class="icon-user icon icon-16"></i>Profile</a></li>
                <li><a data-target="#content" data-toggle="tab"><i class="icon-briefcase icon icon-16"></i>Content</a></li>
                <li><a data-target="#localization" data-toggle="tab"><i class="icon-globe icon icon-16"></i>Localization</a></li>
                <li><a data-target="#intergration" data-toggle="tab"><i class="icon-leaf icon icon-16"></i>Intergration</a></li>
                <li><a data-target="#emails" data-toggle="tab"><i class="icon-envelope-alt icon icon-16"></i>Emails</a></li>
            </ul>
        </div>
    </div>
    <form method="POST" action="/system/admin/settings/save" class="form-horizontal margin-top">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <fieldset class="no-margin">
                    <div class="control-group">
                        <label class="control-label" for="options[general][site-name]"> <?php echo _('Website Name'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[general][site-name]"  class="input-xxlarge" placeholder="e.g MySocialNetwork" value="<?php echo $this->config->getParam('site-name',''); ?>" />
                            <span class="help-block">A unique catchy name to identify your website. This will show as the default page titles</span>
                        </div>
                    </div>                   
                    <div class="control-group">
                        <label class="control-label" for="options[general][site-meta-description]"> <?php echo _('Website description'); ?></label>
                        <div class="controls">
                            <textarea name="options[general][site-meta-description]" class="wysiwyg input-xxlarge" rows="8" ><?php echo $this->config->getParam('site-meta-description',''); ?></textarea>
                            <span class="help-block">Describe your community, its interest and purpose. </span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[general][site-meta-keywords]"> <?php echo _('Website Keywords'); ?></label>
                        <div class="controls">
                            <textarea name="options[general][site-meta-keywords]" class="wysiwyg input-xxlarge" ><?php echo $this->config->getParam('site-meta-keywords',''); ?></textarea>
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
                    <div class="control-group">
                        <label class="control-label" for="options[general][site-page-title]"> <?php echo _('Website page titles'); ?></label>
                        <div class="controls">
                            <select name="options[general][site-page-title]" class="input-xxlarge">
                                <option value="as-is"><?php echo _('Leave as is'); ?></option>
                                <option value="name-last"><?php echo _('Prepend website name'); ?></option>
                                <option value="name-first"><?php echo _('Append website name'); ?></option>
                            </select>
                            <span class="help-block">By default the page title is the website name.</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[general][site-robots]"> <?php echo _('Robot Instructions'); ?></label>
                        <div class="controls">
                            <select name="options[general][site-robots]" class="input-xxlarge">
                                <option value="index-follow"><?php echo _('Index, Follow'); ?></option>
                                <option value="no-index-follow"><?php echo _('No Index, Follow'); ?></option>
                                <option value="index-no-follow"><?php echo _('Index, No Follow'); ?></option>
                                <option value="no-index-no-follow"><?php echo _('No Index, No Follow'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[general][site-seo]">SEO</label>
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

            </div>
            <div class="tab-pane" id="server">
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

            </div>
            <div class="tab-pane" id="content">
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

            </div>
            <div class="tab-pane" id="profile">
                <fieldset class="no-margin">
                    <div class="control-group">
                        <label class="control-label" for="options[profile][default-authority]"> <?php echo _('Default Authority group'); ?></label>
                        <div class="controls">
                            <select name="options[profile][default-authority]"  class="input-xxlarge">
                                <?php foreach ($this->get("authorities") as $e): ?>
                                <option value="<?php echo $e['authority']['authority_id'] ?>">
                                    <?php echo str_repeat('|--', (int) $e['authority']['indent']) . ' ' . $e['authority']['authority_title'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"><?php echo _('The default authority group members will be automatically added to at sign-up'); ?></span>
                        </div>
                    </div>
                </fieldset>

            </div>
            <div class="tab-pane" id="intergration">
                <fieldset class="no-margin">
                    Extensions and Application settings
                </fieldset>
            </div>
            <div class="tab-pane" id="emails">
                <fieldset class="no-margin">
                    Emails settings
                </fieldset>
            </div>
            <div class="tab-pane" id="localization">
                <fieldset class="no-margin">
                    <div class="control-group">
                        <label class="control-label" for="options[localization][timezone]"> <?php echo _('Locale timezone'); ?></label>
                        <div class="controls">
                            <select name="options[localization][timezone]" class="input-xxlarge">
                                <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
                                <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
                                <option value="-10.0">(GMT -10:00) Hawaii</option>
                                <option value="-9.0">(GMT -9:00) Alaska</option>
                                <option value="-8.0">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                                <option value="-7.0">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                                <option value="-6.0">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                                <option value="-5.0">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                                <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                <option value="-3.5">(GMT -3:30) Newfoundland</option>
                                <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
                                <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
                                <option value="0.0" selected="selected">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
                                <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
                                <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
                                <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                <option value="3.5">(GMT +3:30) Tehran</option>
                                <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                <option value="4.5">(GMT +4:30) Kabul</option>
                                <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                <option value="5.75">(GMT +5:45) Kathmandu</option>
                                <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
                                <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[localization][locale]"> <?php echo _('Locale language'); ?></label>
                        <div class="controls">
                            <select name="options[localization][locale]" class="input-xlarge">
                                <option value="en_GB"><?php echo _('English - United Kingdom (en_GB)'); ?></option>
                                <option value="fr_FR"><?php echo _('French - France (fr_FR)'); ?></option>
                                <option value="de_DE"><?php echo _('German - Germany (de_DE)'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[localization][date-format]"> <?php echo _('Date format'); ?></label>
                        <div class="controls">
                            <select name="options[localization][date-format]" class="input-xlarge">
                                <option value="default"><?php echo _('Time difference'); ?></option>
                                <option value="locale"><?php echo _('Locale time format'); ?></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="options_group" value="system-config" />
            <div class="tab-pane" id="information">
                <p class="alert alert-info">This page displays the existing configurations. Updated settings will be displayed here when saved</p>
            </div>
            <div class="form-actions">                 
                <button type="submit" class="btn">Save Preferences</button>
            </div>
        </div>
    </form>
</tpl:layout>


