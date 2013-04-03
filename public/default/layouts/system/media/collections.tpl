<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition data="gallery.hidetitle" test="boolean" value="0">
        <div class="navbar navbar-subnav no-margin">
            <div class="navbar-inner padding-left-half no-margin">
                <a class="topic"><tpl:element type="text" data="page.title">Gallery</tpl:element></a>
            </div>
        </div>
    </tpl:condition>
    <div class="padding">  
        <tpl:condition data="gallery.hideheader" test="boolean" value="0">
            <div class="clearfix">
                <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="photogridtoggler">
                    <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                    <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
                </ul>
                <ul class="nav nav-pills no-margin">
                    <li class="highlighted"><a href="/system/media/create" >Add New</a></li>
                </ul>
            </div>
            <hr />
        </tpl:condition>
        <div class="widget">
<!--            <div class="widget-head"><span class="widget-title">Media</span><a class="widget-close" data-dismiss="widget"><i class="icon-refresh"></i></a></div>-->
            <div class="widget-body">
                <ul class="media-grid media-gallery">
                    <li class="mgrow-fluid grid-hide list-header">
                        <div class="feature grid-hide mgcol1">
                            <strong>Icon</strong>
                        </div>   
                        <div class="name grid-hide mgcol2">
                            <strong>Title</strong>
                        </div>
                        <div class="grid-hide mgcol2">
                            <strong>Rating</strong>
                        </div>
                        <div class="description grid-hide mgcol4">
                            <strong>Description</strong>
                        </div>
                        <div class="kind grid-hide mgcol1">
                            <strong>Kind</strong>
                        </div>
                        <div class="modified grid-hide mgcol1">
                            <strong>Created</strong>
                        </div>
                        <div class="actions grid-hide mgcol1">
                            <strong>Actions</strong>
                        </div>
                    </li>
                    <?php for ($i = 0; $i < 30; $i++): ?>
                    <li class="mgrow-fluid">
                        <div class="feature mgcol1">
                            <div class="thumbnail">
                                <a href="/system/media/photo/view/aU2e9d" data-target="budkit-slider" >
                                    <img src="/system/object/SiJzNl/resize/170/170" />
                                </a>
                            </div>
                        </div>   
                        <div class="name grid-hide mgcol2">
                            <strong>Image title</strong>
                            <span class="help-block">By Livingstone Fultang</span>
                        </div>
                        <div class="grid-hide mgcol2">
                            <span class="rating">
                                <span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span>
                            </span>
                            <a href="#"><span class="help-block">250 comments</span></a>
                        </div>
                        <div class="description grid-hide mgcol4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean massa nibh, congue non tempus ut, congue in dui. Pellentesque accumsan dolor eu libero blandit quis sagittis nisl mattis.
                        </div>
                        <div class="kind grid-hide mgcol1">
                            image/jpg
                        </div>
                        <div class="modified grid-hide mgcol1">
                            <?php echo date('Y-m-d H:i:s'); ?>
                        </div>
                        <div class="actions grid-hide mgcol1">
                            <a href="#" class="btn btn-small">View</a>
                        </div>
                    </li>
                    <?php endfor; ?>
                </ul>  
            </div>
        </div>
        <tpl:import layout="pagination" />
    </div>
</tpl:layout>