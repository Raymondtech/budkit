<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <form method="POST" action="/system/admin/settings/save" class="form-vertical">

        <ul class="nav nav-tabs admin-main-tabs" id="systemPreferences">
            <li class="active"><a data-target="#general" data-toggle="tab">General</a></li>
            <li><a data-target="#server" data-toggle="tab">Server</a></li>
            <li><a data-target="#storage" data-toggle="tab">Storage</a></li>
            <li><a data-target="#profile" data-toggle="tab">Profile</a></li>
            <li><a data-target="#content" data-toggle="tab">Content</a></li>
            <li><a data-target="#intergration" data-toggle="tab">Intergration</a></li>
            <li><a data-target="#localization" data-toggle="tab">Localization</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-plus"></i> Applications</a>
                <ul class="dropdown-menu">
                    <li><a data-target="#applications" data-toggle="tab">Application 1</a></li>
                </ul>
            </li>
            <li><a data-target="#information" data-toggle="tab">Information</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="options[site-name]"> <?php echo _('Website Name'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[site-name]"  class="input-xxxlarge" placeholder="e.g MySocialNetwork" />
                            <span class="help-block">A unique catchy name to identify your website. This will show as the default page titles</span>
                        </div>
                    </div>                   

                    <div class="control-group">
                        <label class="control-label" for="options[site-page-title]"> <?php echo _('Website page titles'); ?></label>
                        <div class="controls">
                            <select name="options[site-page-title]" class="input-xlarge">
                                <option value="0"><?php echo _('Leave as is'); ?></option>
                                <option value="1"><?php echo _('Prepend website name'); ?></option>
                                <option value="2"><?php echo _('Append website name'); ?></option>
                            </select>
                            <span class="help-block">By default the page title is the website name.</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[site-address]"> <?php echo _('Website URL'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[site-address]" class="input-xxxlarge" placeholder="http://www.mydomain.com/" />
                            <span class="help-block">Unless you are using a subdirectory you really don't need to change this.</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="options[site-meta-description]"> <?php echo _('Website description'); ?></label>
                        <div class="controls">
                            <textarea name="options[site-meta-description]" class="wysiwyg input-xxxlarge" rows="8" ></textarea>
                            <span class="help-block">Describe your community, its interest and purpose. </span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[site-meta-keywords]"> <?php echo _('Website Keywords'); ?></label>
                        <div class="controls">
                            <textarea name="options[site-meta-keywords]" class="wysiwyg input-xxxlarge" ></textarea>
                            <span class="help-block">Lists as many keywords that may promote your listing in some search engines</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="options[site-address]"> <?php echo _('Static file URL'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[site-address]" class="input-xxxlarge" placeholder="http://www.mydomain.com/" />
                            <span class="help-block">Used to implement CDN hosting of static files through services such as MaxCDN.</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[site-allow-registration]">Registration</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="options[site-allow-registration]" value="1" />
                                Allow new user registration?
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[site-inviteonly]" value="1" />
                                New user registration by invite only.
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[site-verify-email]" value="1" />
                                Verify newly registered user by email
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="tab-pane" id="server">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="options[mail-address]"> <?php echo _('System E-Mail'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[mail-address]" class="input-xlarge" placeholder="e.g info@mydomain.com" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[mail-server]"> <?php echo _('System Mail Server'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[mail-server]" class="input-xlarge" placeholder="e.g http://webmail.mydomain.com" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[mail-server-username]"> <?php echo _('Mail Server Username'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[mail-server-username]" class="input-xlarge" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[mail-server-password]"> <?php echo _('Mail Server Password'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[mail-server-password]" class="input-xlarge" />
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="tab-pane" id="localization">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="options[locale-timezone]"> <?php echo _('Locale timezone'); ?></label>
                        <div class="controls">
                            <select name="options[locale-timezone]" class="input-xxxlarge">
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
                        <label class="control-label" for="options[locale-language]"> <?php echo _('Locale language'); ?></label>
                        <div class="controls">
                            <select name="options[locale-language]" class="input-xlarge">
                                <option value="en_GB"><?php echo _('English - United Kingdom (en_GB)'); ?></option>
                                <option value="fr_FR"><?php echo _('French - France (fr_FR)'); ?></option>
                                <option value="de_DE"><?php echo _('German - Germany (de_DE)'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="options[locale-dateformat]"> <?php echo _('Date format'); ?></label>
                        <div class="controls">
                            <select name="options[locale-dateformat]" class="input-xlarge">
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
        </div>
        <hr />
        <div class="btn-toolbar">
            <button class="btn pull-right" type="reset">Reset Form</button>
            <button type="submit" class="btn">Save Preferences</button>
        </div>
    </form>
</tpl:layout>


