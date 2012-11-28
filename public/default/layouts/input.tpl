<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <div class="timeline-item-publisher-box">
                <fieldset class="timeline-item-publisher no-bottom-margin">
                    <a class="publisher-profile" href="/member/profile/view/">
                        <img class="profile-avatar" src="http://placeskull.com/50/50/2554C7"  />                                      
                    </a>
                    
                    <div class="controls half-bottom-pad">
                        <div class="btn-toolbar inline no-margin">
                            <div class="btn-group">
                                <button class="btn" type="button"><i class="icon icon-bold"></i></button>
                                <button class="btn" type="button"><i class="icon icon-italic"></i></button>
                                <button class="btn" type="button"><i class="icon icon-underline"></i></button>
                                <button class="btn" type="button"><i class="icon icon-strikethrough"></i></button>
                            </div>
                            <div class="btn-group">
                                <a class="btn" href="/system/commands/upload.raw" data-toggle="modal" data-target="#upload-tool"><i class="icon icon-picture"></i></a>
                                <button class="btn" type="button"><i class="icon icon-film"></i></button>
                                <button class="btn" type="button"><i class="icon icon-music"></i></button>
                                <button class="btn" type="button"><i class="icon icon-file"></i></button>
                                <button class="btn" type="button"><i class="icon icon-check"></i></button>
                                <button class="btn" type="button"><i class="icon icon-map-marker"></i></button>
                            </div>
                            <div class="btn-group pull-right">
                                <button class="btn" type="submit"><i class="icon icon-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <textarea class="input-xxxlarge focused" rows="4" name="activity_content" placeholder="Say Something..."></textarea>
                    </div>
                </fieldset>
            </div>
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