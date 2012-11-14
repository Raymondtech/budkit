<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">

    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset class="timeline-item-publisher no-margin">
                <div class="row-fluid">
                    <textarea class="input-xxxlarge focused" rows="3" name="activity_content" placeholder="Where are you now and what are you doing?"></textarea>
                </div>
                <div class="timeline-item-publisher-actions">
                    <div class="btn-toolbar no-margin pull-right">
                        <div class="btn-group">
                            <button class="btn"><i class="icon icon-map-marker"></i> Check-in</button>
                            <button class="btn"><i class="icon icon-upload"></i>Upload</button>
                        </div>   
                        <div class="btn-group">
                            <button type="submit" class="btn" href="#">Publish</button>    
                        </div>
                    </div>
                    <div class="pull-left">
                        <div class="controls">
                            <select name="activity_permissions" class="input-xxxlarge">
                                <option value="1">Share with Everybody</option>
                                <option value="2">Share with Friends only</option>
                                <option value="3">Share with Colleagues</option>
                                <option value="4">Share with Self</option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="activity_author_id" value="" />
            <input type="hidden" name="activity_verb" value="post" />
            <input type="hidden" name="activity_provider" value="budkit" />
        </tpl:condition>
        <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
            <div class="alert alert-warning">
                <a href="/member/session/start">Login now</a> to share a story from your current location, or upload photos 
            </div>
        </tpl:condition>
    </form>
</tpl:layout>