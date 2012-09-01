<tpl:layout name="input" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <form action="/system/activity/create" method="POST">
        <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
            <fieldset class="timeline-item-publisher no-margin">
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Title</tpl:i18n></label>
                    <div class="controls">
                        <input type="text" name="options[general][site-name]"  class="input-xxxlarge"  value="<?php echo $this->config->getParam('site-name','','general'); ?>" />
                        
                    </div>
                </div> 
                <hr />
                <div class="control-group">
                    <label class="control-label" for="options[general][site-name]"><tpl:i18n>Article</tpl:i18n></label>
                    <div class="controls">
                        <textarea class="input-xxxlarge focused" rows="15" name="post_content"></textarea>
                    </div>
                </div>
                <hr />
                <div class="timeline-item-publisher-actions">
                    <div class="btn-toolbar  no-margin">
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