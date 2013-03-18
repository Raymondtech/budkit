<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner padding-left-half no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">Gallery</tpl:element></a>
        </div>
    </div>
    <div class="padding">  
        <ul class="thumbnails media-grid media-gallery">
            <?php for ($i = 0; $i < 30; $i++): ?>
            <li class="media-stack">
                <a href="/system/content/collection/browse/Ytq90e" data-target="budkit-slider">
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