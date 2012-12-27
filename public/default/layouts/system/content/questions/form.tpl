<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset class="timeline-item-publisher no-margin">
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Question</tpl:i18n></label>
                    <div class="controls">
                        <textarea class="input-xxxlarge focused" rows="5" name="post_content"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="middle-name">Options</label>
                    <div class="controls input">
                        <div class="input-prepend input-append">
                            <span class="add-on prepended"><input type="checkbox" /> </span>
                            <input class="input-xxxlarge" id="middle-name" name="middle-name" size="30" type="text" />
                            <a class="btn pull-right add-on"><i class="icon icon-trash"></i></a>
                        </div>
                    </div>
                    <div class="controls input">
                        <div class="input-prepend input-append">
                            <span class="add-on prepended"><input type="checkbox" /> </span>
                            <input class="input-xxxlarge" id="middle-name" name="middle-name" size="30" type="text" />
                            <a class="btn pull-right add-on"><i class="icon icon-trash"></i></a>
                        </div>
                    </div>
                </div><!-- /control-group -->
                <hr />

                <div class="timeline-item-publisher-actions">
                    <div class="btn-toolbar  no-margin">
                        <div class="btn-group">
                            <button class="btn"><i class="icon icon-check"></i> Add Options</button>
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