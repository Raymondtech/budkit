<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST" class="form-horizontal padding">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <div class="control-group">
                <label class="control-label"  for="middle-name">Event Banner</label>
                <div class="controls">
                    <div class="input-append"> 
                        <input type="file" data-label="Select Photo..." />
                        <a class="add-on btn">Chose from existing</a>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[storage][FTP-server-host]">Event Title</label>
                <div class="controls">
                    <input type="text" name="options[storage][FTP-server-host]" class="input-xxlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[general][site-name]"><tpl:i18n>Event Description</tpl:i18n></label>
                <div class="controls">
                    <textarea class="input-xxlarge focused" rows="5" name="post_content"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[storage][FTP-server-port]">Event Options</label>
                <div class="controls">
                    <select name="options[localization][timezone]" class="input-xlarge">
                        <option value="-12.0">Guest can invite Others</option>
                        <option value="-12.0">Guest can add Photos</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[storage][FTP-server-host]">Start Date</label>
                <div class="controls">
                    <input type="text" name="options[storage][FTP-server-host]" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[storage][FTP-server-host]">Start Time</label>
                <div class="controls">
                    <input type="text" name="options[storage][FTP-server-host]" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[storage][FTP-server-host]">End Time</label>
                <div class="controls">
                    <input type="text" name="options[storage][FTP-server-host]" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="options[general][site-name]"><tpl:i18n>Location</tpl:i18n></label>
                <div class="controls">
                    <input type="text" name="options[general][site-name]"  class="input-xlarge"  />
                </div>
            </div> 
            <div class="form-actions">
                <div class="btn-toolbar  no-margin">
                    <div class="btn-group">
                        <button type="submit" class="btn" href="#">Publish</button>    
                    </div>
                </div>
            </div>
        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>