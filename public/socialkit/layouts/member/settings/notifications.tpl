<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <ul class="nav" id="configurationsmenu">
                <li class="active"><a data-target="#systemnotifications" data-toggle="tab"><i class="icon-bell icon icon-16"></i>System Notifications</a></li>
                <li><a data-target="#3pdnotifications" data-toggle="tab"><i class="icon-bell-alt icon icon-16"></i>3rd Party Notifications</a></li>
            </ul>
        </div>
    </div>
    <form method="POST" action="/system/admin/settings/save" class="form-horizontal margin-top">
        <div class="tab-content">
            <div class="tab-pane active" id="systemnotifications">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"  for="old_user_password">Notification mode</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" />
                                Email Notifications
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" />
                                Mobile Notifications
                            </label>
                        </div>
                    </div><!-- /control-group -->  
                    <hr />
                    <div class="control-group">
                        <label class="control-label"  for="new_user_password">Digests</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" />
                                Recieve Digests (Summary of activities in your network)
                            </label>
                            <label class="radio">
                                <input type="radio" name="options[general][site-url-suffix]" value="1" />
                                Daily Digests
                            </label>
                            <label class="radio">
                                <input type="radio" name="options[general][site-unicode-aliases]" value="1" />
                                Weekly Digests
                            </label>
                        </div>
                    </div><!-- /control-group -->
                    <hr />
                    <div class="control-group">
                        <label class="control-label"  for="old_user_password">Frequency</label>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" name="options[general][site-url-suffix]" value="1" />
                                Recieve notifications as they happen
                            </label>
                            <label class="radio">
                                <input type="radio" name="options[general][site-url-suffix]" value="1" />
                                As part of your digests
                            </label>
                        </div>
                    </div><!-- /control-group -->
                    <hr />
                    <div class="control-group">
                        <label class="control-label"  for="new_user_password_repeat">Notify me when..</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                I am mentioned in a posts
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                Content I submitted is shared
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                A reply is posted to a discussion I am partaking in
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                You have a new follower
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                You have been tagged
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                Starts a conversation with you in your absence (i.e New Private message)
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                You are invited to an event
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                An event you are attending has been updated
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" checked="checked" />
                                A reminder to events within the next 24 hours
                            </label>
                        </div>
                    </div><!-- /control-group -->
                </fieldset>
            </div>
            <div class="tab-pane" id="3pdnotifications">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"  for="old_user_password">Allow Notifications</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="options[general][site-url-suffix]" value="1" />
                                Enable Notificaitons from 3rd Parties
                            </label>
                        </div>
                    </div><!-- /control-group -->  
                </fieldset>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" class="btn primary" value="Save changes" />&#160;<button type="reset" class="btn">Cancel</button>
        </div>
    </form>
</tpl:layout>