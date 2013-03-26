<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <a class="topic"><tpl:element type="text" data="page.title">Notification Settings</tpl:element></a>
        </div>
    </div>
    <form method="POST" action="/system/admin/settings/save" class="form-horizontal margin-top">
        <fieldset>
            <div class="control-group">
                <label class="control-label">Notification mode</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][notify-email]" value="1" checked="checked" />
                        Email Notifications
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][notify-mobile]" value="1" disabled="disabled" />
                        Mobile Notifications
                    </label>
                </div>
            </div><!-- /control-group -->  
            <hr />
            <div class="control-group">
                <label class="control-label">Digests</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][enable-digests]" value="1" />
                        Recieve Digests (Summary of activities in your network)
                    </label>
                    <label class="radio">
                        <input type="radio" name="options[notifications][digest-frequency]" value="daily" checked="checked" />
                        Daily Digests
                    </label>
                    <label class="radio">
                        <input type="radio" name="options[notifications][digest-frequency]" value="weekly" />
                        Weekly Digests
                    </label>
                </div>
            </div><!-- /control-group -->
            <hr />
            <div class="control-group">
                <label class="control-label"  for="old_user_password">Frequency Mode</label>
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="options[notifications][frequency-mode]" value="live" checked="checked" />
                        Recieve notifications as they happen
                    </label>
                    <label class="radio">
                        <input type="radio" name="options[notifications][frequency-mode]" value="digest" />
                        As part of your digests
                    </label>
                </div>
            </div><!-- /control-group -->
            <hr />
            <div class="control-group">
                <label class="control-label"  for="new_user_password_repeat">Notify me when..</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][content-mention]" value="1" checked="checked" />
                        I am mentioned in a posts
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][content-shared]" value="1" checked="checked" />
                        Content I submitted is shared
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][content-reply]" value="1" checked="checked" />
                        A reply is posted to a discussion I am partaking in
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][profile-followed]" value="1" checked="checked" />
                        You have a new follower
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][photo-tags]" value="1" checked="checked" />
                        You have been tagged
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][conversation-started]" value="1" checked="checked" />
                        Starts a conversation with you in your absence (i.e New Private message)
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][event-invite]" value="1" checked="checked" />
                        You are invited to an event
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][event-update]" value="1" checked="checked" />
                        An event you are attending has been updated
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][event-reminder]" value="1" checked="checked" />
                        A reminder to events within the next 24 hours
                    </label>
                </div>
            </div><!-- /control-group -->
            <div class="control-group">
                <label class="control-label"  for="old_user_password">Vendors</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="options[notifications][vendor]" value="1" />
                        Enable Notificaitons from 3rd Parties
                    </label>
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <input type="submit" class="btn" value="Save changes" />
        </div>
    </form>
</tpl:layout>