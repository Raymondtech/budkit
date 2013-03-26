<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <a class="topic"><tpl:element type="text" data="page.title">Privacy Settings</tpl:element></a>
        </div>
    </div>
    <form method="POST" action="/system/admin/settings/save" class="form-horizontal margin-top">
        <div class="control-group">
            <label class="control-label">Public</label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" name="options[notifications][notify-mobile]" value="0" />
                    <strong>Less Private</strong>
                </label>
                <ul>
                    <li>Your profile is viewable by everybody</li>
                    <li>Everything your post is public by default</li>
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
                    <li>Your profile is viewable by your followers or subsets of your followers list only</li>
                    <li>Everything you share is private by default</li>
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
                    <li>Your profile is viewable only by your <a href="/settings/member/privacy/group/allowed">allowed</a> followers list</li>
                    <li>You can still post new content </li>
                    <li>Everything you share is private by default</li>
                </ul>
            </div>
        </div><!-- /control-group --> 
        <hr />
        <div class="control-group">
            <label class="control-label">Privacy lists</label>
            <div class="controls">
                <a href="/settings/member/privacy/group/blocked" class="bucket-link">
                    <i class="icon-lock"></i>
                    <span>2 Blocked</span>
                </a>
                <a href="/settings/member/privacy/group/allowed" class="bucket-link">
                    <i class="icon-unlock"></i>
                    Allowed
                </a>
                <a href="/settings/member/privacy/group" class="bucket-link add">
                    <i class="icon-plus"></i>
                    Add List
                </a>
                <span class="help-block">Privacy lists allow you to succinctly manage your media flow. Click on a list to add followers and or modify settings</span>
            </div>

        </div>
        <fieldset>

        </fieldset>
        <div class="form-actions">
            <input type="submit" class="btn" value="Save changes" />
        </div>
    </form>
</tpl:layout>