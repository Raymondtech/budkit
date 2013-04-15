<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form method="POST" action="/system/admin/settings/save" class="form-horizontal margin-top">
        <div class="control-group">
            <label class="control-label">Privacy groups</label>
            <div class="controls">
                <ul class="nav nav-pills margin-bottom-half">
                    <li class="highlighted"><a href="/settings/member/privacy/groups" >Manage Groups</a></li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="control-group">
            <label class="control-label">Public</label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" name="options[notifications][notify-mobile]" value="0" />
                    <strong>Less Private</strong>
                </label>
                <ul>
                    <li>Your name and profile photo are visible in public searches</li>
                    <li>Your profile and content is viewable by everybody</li>
                    <li>Everything your share is public by default</li>
                </ul>
            </div>
        </div><!-- /control-group -->  
        <div class="control-group">
            <label class="control-label">Private</label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" name="options[notifications][notify-mobile]" value="1" checked="checked" />
                    <strong>Only Just</strong>
                </label>
                <ul>
                    <li>Your name and profile photo are visible in public searches</li>
                    <li>Your profile and content is viewable by your <a href="#">followers</a> only</li>
                    <li>Everything you share is Private by default</li>
                </ul>
            </div>
        </div><!-- /control-group --> 
        <div class="control-group">
            <label class="control-label">Hidden</label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" name="options[notifications][notify-mobile]" value="3" />
                    <strong>Seriously Private</strong>
                </label>
                <ul>
                    <li>Your name and profile photo are NOT visible in any search results</li>
                    <li>Your profile and content is viewable only by you</li>
                    <li>Everything you share is Hidden by default</li>
                </ul>
            </div>
        </div><!-- /control-group --> 
        <div class="form-actions">
            <input type="submit" class="btn" value="Save changes" />
        </div>
    </form>
</tpl:layout>