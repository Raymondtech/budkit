<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <tpl:condition data="gallery.hideheader" test="boolean" value="0">
            <tpl:import layout="media/gallery/title" />
        </tpl:condition>
        <tpl:condition data="gallery" test="isset" value="1">
            <div class="widget">
                <div class="widget-head">
                    <span class="widget-title"><tpl:element type="text" data="page.title">Media Gallery</tpl:element></span>
                    <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="photogridtoggler">
                        <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                        <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                    </ul>
                </div>
                <div class="widget-body">
                    <tpl:import layout="media/gallery/widget" />
                </div>
            </div>
            <tpl:import layout="pagination" />
        </tpl:condition>
        <tpl:condition data="gallery" test="isset" value="0">
            <p class="placeholder-text">There are no items to display in this gallery.</p>
        </tpl:condition>
    </div>

</tpl:layout>