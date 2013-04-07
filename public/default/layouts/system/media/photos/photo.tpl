<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div align="center">
        <tpl:loop data="object.items" id="timeline-items">
            <tpl:condition data="object" test="isset" value="1">
                <tpl:condition data="object.objectType" test="isnot" value="collection">
                    <div class="timeline-item-media clearfix">                                   
                        <tpl:media uri="object.uri" name="object.name"  type="object.type" />             
                    </div>
                </tpl:condition>
            </tpl:condition>
        </tpl:loop>
    </div>
    <a href="#" class="slider-previous toggler" data-toggle="budkit-slider"><i class="icon-chevron-left"></i></a>
    <a href="#" class="slider-next toggler" data-toggle="budkit-slider"><i class="icon-chevron-right"></i></a>
</tpl:layout>