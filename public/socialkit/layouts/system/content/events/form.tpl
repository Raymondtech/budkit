<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset class="timeline-item-publisher no-margin">
                <div class="control-group  row-fluid">
                    <div class="span8">
                        <label class="control-label" for="options[storage][FTP-server-host]">Event Title</label>
                        <div class="controls">
                            <input type="text" name="options[storage][FTP-server-host]" class="input-xxxlarge" />
                        </div>
                    </div>
                    <div class="span4">
                        <label class="control-label" for="options[storage][FTP-server-port]">Event Options</label>
                        <div class="controls">
                            <select name="options[localization][timezone]" class="input-xxxlarge">
                                <option value="-12.0">Guest can invite Others</option>
                                <option value="-12.0">Guest can add Photos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group  row-fluid">
                    <div class="span4">
                        <label class="control-label" for="options[storage][FTP-server-host]">Start Date</label>
                        <div class="controls">
                            <input type="text" name="options[storage][FTP-server-host]" class="input-xxxlarge" />
                        </div>
                    </div>
                    <div class="span4">
                        <label class="control-label" for="options[storage][FTP-server-host]">Start Time</label>
                        <div class="controls">
                            <input type="text" name="options[storage][FTP-server-host]" class="input-xxxlarge" />
                        </div>
                    </div>
                    <div class="span4">
                        <label class="control-label" for="options[storage][FTP-server-host]">End Time</label>
                        <div class="controls">
                            <input type="text" name="options[storage][FTP-server-host]" class="input-xxxlarge" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label class="control-label" for="options[general][site-name]"><tpl:i18n>Location</tpl:i18n></label>
                        <input type="text" name="options[general][site-name]"  class="input-xxxlarge"  />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Event Description</tpl:i18n></label>
                    <div class="controls">
                        <textarea class="input-xxxlarge focused" rows="5" name="post_content"></textarea>
                    </div>
                </div>
                <hr />
                <div class="timeline-item-publisher-actions">
                    <div class="btn-toolbar  no-margin">
                        <div class="btn-group">
                            <button class="btn"><i class="icon icon-user"></i> Invite Guests</button>
                        </div>
                        <div class="btn-group">
                            <button class="btn"><i class="icon icon-file"></i> Attach Document</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn" href="#">Publish</button>    
                        </div>
                    </div>
                </div>
            </fieldset>
        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>