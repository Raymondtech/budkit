<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">              
    <div class="clearfix">
        <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="photogridtoggler">
            <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
            <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
        </ul>
        <tpl:menu id="mediamenu" type="nav-pills" class="pull-right margin-bottom-zero margin-top-zero margin-right-half" />
        <div class="btn-toolbar pull-left no-margin">
            <a class="btn-important btn" href="/system/media/create/editor" >Add New</a>
        </div>
    </div>
    <hr />
</tpl:layout>