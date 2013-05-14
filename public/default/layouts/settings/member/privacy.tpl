<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form method="post" enctype="multipart/form-data" action="/settings/member/privacy/update" class="form-horizontal margin-top-double">
        <div class="control-group">
            <label class="control-label">Public</label>
            <div class="controls">
                <label class="radio">
                    <tpl:input type="radio" name="privacy[privacy-level]"  data="config|privacy.privacy-level" value="public" />
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
                    <tpl:input type="radio" name="privacy[privacy-level]" value="private" data="config|privacy.privacy-level" checked="checked" />
                    <strong>Seriously Private</strong>
                </label>
                <ul>
                    <li>Your name and profile photo are visible in public searches, so people can still follow you</li>
                    <li>Your profile and content is viewable by your follower or <a href="/settings/member/privacy/groups">privacy groups</a> only</li>
                    <li>Everything you share is Private by default</li>
                </ul>
            </div>
        </div><!-- /control-group --> 
        <div class="control-group">
            <label class="control-label">Hidden</label>
            <div class="controls">
                <label class="radio">
                    <tpl:input type="radio" name="privacy[privacy-level]" data="config|privacy.privacy-level" value="hidden" />
                    <strong>Only Me</strong>
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