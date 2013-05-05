<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form method="post" enctype="multipart/form-data" action="/settings/member/notifications/update" class="form-horizontal margin-top">
        
        <fieldset>
            <div class="control-group">
                <label class="control-label">Notification mode</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="notifications[notify-email]" value="0" />
                        <tpl:input type="checkbox" name="notifications[notify-email]" data="config|notifications.notify-email" value="1" checked="checked" />
                        <span>Email Notifications</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[notify-mobile]" value="0" />
                        <tpl:input type="checkbox" name="notifications[notify-mobile]" data="config|notifications.notify-mobile" value="1"  />
                        <span>Mobile Notifications</span>
                    </label>
                </div>
            </div><!-- /control-group -->  
            <hr />
            <div class="control-group">
                <label class="control-label">Digests</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="notifications[enable-digests]" value="0" />
                        <tpl:input type="checkbox" name="notifications[enable-digests]" data="config|notifications.enable-digests" value="1" />
                        <span>Recieve Digests (Summary of activities in your network)</span>
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="notifications[digest-frequency]" value="daily" data="config|notifications.digest-frequency" checked="checked" />
                        <span>Daily Digests</span>
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="notifications[digest-frequency]" value="weekly" data="config|notifications.digest-frequency" />
                        <span>Weekly Digests</span>
                    </label>
                </div>
            </div><!-- /control-group -->
            <hr />
            <div class="control-group">
                <label class="control-label">Frequency Mode</label>
                <div class="controls">
                    <label class="radio">
                        <tpl:input type="radio" name="notifications[frequency-mode]" data="config|notifications.frequency-mode" value="live" checked="checked" />
                        <span>Recieve notifications as they happen</span>
                    </label>
                    <label class="radio">
                        <tpl:input type="radio" name="notifications[frequency-mode]" data="config|notifications.frequency-mode" value="digest" />
                        <span>As part of your digests</span>
                    </label>
                </div>
            </div><!-- /control-group -->
            <hr />
            <div class="control-group">
                <label class="control-label">Notify me when..</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="notifications[content-mention]" value="0" />
                        <tpl:input type="checkbox" name="notifications[content-mention]" data="config|notifications.content-mention" value="1" checked="checked" />
                        <span>I am mentioned in a posts</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[content-shared]" value="0" />
                        <tpl:input type="checkbox" name="notifications[content-shared]" data="config|notifications.content-shared" value="1" checked="checked" />
                        <span>Content I submitted is shared</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[content-reply]" value="0" />
                        <tpl:input type="checkbox" name="notifications[content-reply]" value="1" data="config|notifications.content-reply" checked="checked" />
                        <span>A reply is posted to a discussion I am partaking in</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[profile-followed]" value="0" />
                        <tpl:input type="checkbox" name="notifications[profile-followed]" value="1" data="config|notifications.profile-followed" checked="checked" />
                        <span>You have a new follower</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[photo-tags]" value="0" />
                        <tpl:input type="checkbox" name="notifications[photo-tags]" value="1" data="config|notifications.photo-tags" checked="checked" />
                        <span>You have been tagged</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[conversation-started]" value="0" />
                        <tpl:input type="checkbox" name="notifications[conversation-started]" value="1" data="config|notifications.conversation-started" checked="checked" />
                        <span>Starts a conversation with you in your absence (i.e New Private message)</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[event-invite]" value="0" />
                        <tpl:input type="checkbox" name="notifications[event-invite]" data="config|notifications.event-invite" value="1" checked="checked" />
                        <span>You are invited to an event</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[event-update]" value="0" />
                        <tpl:input type="checkbox" name="notifications[event-update]" data="config|notifications.event-update" value="1" checked="checked" />
                        <span>An event you are attending has been updated</span>
                    </label>
                    <label class="checkbox">
                        <input type="hidden" name="notifications[event-reminder]" value="0" />
                        <tpl:input type="checkbox" name="notifications[event-reminder]" data="config|notifications.event-reminder" value="1" checked="checked" />
                        <span>A reminder to events within the next 24 hours</span>
                    </label>
                </div>
            </div><!-- /control-group -->
            <div class="control-group">
                <label class="control-label">Vendors</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="hidden" name="notifications[enable-vendor]" value="0" />
                        <tpl:input type="checkbox" name="notifications[enable-vendor]" data="config|notifications.enable-vendor" value="1" />
                        <span>Enable Notificaitons from 3rd Parties</span>
                    </label>
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <tpl:input type="submit" class="btn" value="Save changes" />
        </div>
    </form>
</tpl:layout>