<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <ul class="nav" id="mediacontentmenu">
                <li class="highlighted"><a data-target="#new" data-toggle="tab" ><i class="icon-asterisk icon-16"></i>New Item</a></li>
                <li><a data-target="#collections" data-toggle="tab"><i class="icon-briefcase icon-16"></i>Collections</a></li>
                <li class="active"><a data-target="#photos" data-toggle="tab"><i class="icon-picture icon-16"></i>Photos</a></li>
                <li><a data-target="#audios" data-toggle="tab"><i class="icon-music icon-16"></i>Audios</a></li>
                <li><a data-target="#videos" data-toggle="tab"><i class="icon-film icon-16"></i>Videos</a></li>
                <li><a data-target="#articles" data-toggle="tab"><i class="icon-file-alt icon-16"></i>Articles</a></li>
                <li><a data-target="#others" data-toggle="tab"><i class="icon-folder-close icon-16"></i>Others</a></li>
            </ul>
            <ul class="nav nav-mediagrid pull-right" id="mediagallerygridtoggler">
                <li class="active"><a data-target="#media-gallery"  data-toggle="media-grid"><i class="icon-th icon-16"></i>Grid</a></li>
                <li><a data-target="#media-gallery"  data-toggle="media-list"><i class="icon-th-list icon-16"></i>List</a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active padding" id="photos">
            <ul class="thumbnails media-grid" id="media-gallery">
                 <?php for ($i = 0; $i < 30; $i++): ?>
                <li>
                    <a href="#">
                        <div class="thumbnail">
                            <div class="feature column"><img src="http://lorempixel.com/200/150/sports/<?php echo rand(1,10);?>/" /></div>                      
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
        <div class="tab-pane padding" id="audios">
            Audios
        </div>
        <div class="tab-pane padding" id="videos">
            Videos
        </div>
        <div class="tab-pane padding" id="others">
            Other files
        </div>
        <div class="tab-pane padding" id="articles">
            Articles
        </div>
        <div class="tab-pane padding" id="new">
            Upload form
        </div>
        <div class="tab-pane padding" id="collections">
            Collections
        </div>
    </div>
</tpl:layout>