<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <ul class="nav" id="mediacontentmenu">
                <li><a data-target="#new" data-toggle="tab" ><i class="icon-asterisk icon-16"></i>New Item</a></li>
                <li><a data-target="#articles" data-toggle="tab"><i class="icon-file-alt icon-16"></i>Articles</a></li>
                <li class="active"><a data-target="#photos" data-toggle="tab"><i class="icon-picture icon-16"></i>Photos</a></li>
                <li><a data-target="#audios" data-toggle="tab"><i class="icon-music icon-16"></i>Audios</a></li>
                <li><a data-target="#videos" data-toggle="tab"><i class="icon-film icon-16"></i>Videos</a></li>       
                <li><a data-target="#others" data-toggle="tab"><i class="icon-folder-close icon-16"></i>Others</a></li><li>
                    <a data-target="#collections" data-toggle="tab"><i class="icon-briefcase icon-16"></i>Collections</a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active padding" id="photos">
            <div class="clearfix">
                <ul class="nav nav-pills pull-right no-margin">
                    <li class="highlighted"><a href="#"><i class="icon-picture icon-16"></i>Upload Photos</a></li>
                </ul>
                <ul class="nav nav-pills nav-mediagrid no-margin" id="mediagallerygridtoggler">
                    <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid"><i class="icon-th icon-16"></i>Grid</a></li>
                    <li><a data-target=".media-gallery"  data-toggle="media-list"><i class="icon-th-list icon-16"></i>List</a></li>
                </ul>
            </div>
            <hr />
            <ul class="thumbnails media-grid media-gallery">
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
        <div class="tab-pane" id="audios">
            Audios
        </div>
        <div class="tab-pane" id="videos">
            Videos
        </div>
        <div class="tab-pane" id="others">
            Other files
        </div>
        <div class="tab-pane" id="articles">
            <tpl:import layout="content/articles/articles" />
        </div>
        <div class="tab-pane" id="collections">
            Collections
        </div>
        <div class="tab-pane padding" id="new">
            <form class="form-horizontal padding-top">
                <div class="control-group">
                    <label class="control-label" for="">Content Type</label>
                    <div class="controls">
                        <ul class="nav nav-pills no-margin" id="mediatypemenu">
                            <li class="active"><a data-target="#new-photo" data-toggle="tab">Photo</a></li>
                            <li><a data-target="#new-article" data-toggle="tab">Article</a></li>
                            <li><a data-target="#new-audio" data-toggle="tab">Audio</a></li>
                            <li><a data-target="#new-video" data-toggle="tab">Video</a></li>
                            <li><a data-target="#new-collection" data-toggle="tab">Collection</a></li>
                        </ul>
                    </div>
                </div>
            </form>
            <div class="tab-content">
                <div class="tab-pane" id="new-article">
                    <tpl:import layout="content/articles/form" />
                </div>
                <div class="tab-pane" id="new-collection">
                    New Collection
                </div>
                <div class="tab-pane active" id="new-photo">
                    <tpl:import layout="content/photos/form" />
                </div>
                <div class="tab-pane" id="new-video">
                    <tpl:import layout="content/videos/form" />
                </div>
                <div class="tab-pane" id="new-audio">
                    <tpl:import layout="content/audios/form" />
                </div>
            </div>
        </div>
    </div>
</tpl:layout>