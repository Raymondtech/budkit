<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">Gallery</tpl:element></a>
        </div>
    </div>
    <div class="padding">  
        <div class="clearfix">
            <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="photogridtoggler">
                <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-th icon-16"></i></a></li>
                <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
            </ul>
            <ul class="nav nav-pills no-margin">
                <li class="highlighted"><a href="/system/content/create" >Add New</a></li>
            </ul>
        </div>
        <hr />
        <ul class="thumbnails media-grid media-gallery">
            <?php for ($i = 0; $i < 30; $i++): ?>
            <li>
                <a href="#" data-target="budkit-slider">
                    <div class="thumbnail">
                        <div class="feature column"><img src="http://lorempixel.com/250/200/sports/<?php echo rand(1,10);?>/" /></div>                      
                        <div class="description column">
                            This is the description of this image
                        </div>
                        <div class="caption column">  
                            <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                        </div>
                    </div>
                </a>
            </li>
            <?php endfor; ?>
        </ul>    
    </div>
</tpl:layout>