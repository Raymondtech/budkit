<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="page-header">
        <h1>Dashboard<small> Welcome back @drstonyhills</small></h1>
    </div>
    <div id="control-panel">
        <div class="row-fluid text-centered clearfix"> 
            <a href="/content/article/create" class="thumbnail-icon text-centered text-grey" data-original-title="New Article" rel="tooltip">
                <i class="icon icon-32 icon-edit icon-block"></i>
            </a>
            <a href="/content/photo/create" class="thumbnail-icon text-centered text-orange" data-original-title="Upload Photos" rel="tooltip">
                <i class="icon icon-32 icon-camera-retro icon-block"></i>
            </a>
            <a href="/content/event/create" class="thumbnail-icon text-centered text-green" data-original-title="Create Event" rel="tooltip">
                <i class="icon icon-32 icon-calendar icon-block"></i>
            </a>
            <a href="/content/question/create" class="thumbnail-icon text-centered text-purple" data-original-title="Ask Question" rel="tooltip">
                <i class="icon icon-32 icon-question-sign icon-block"></i>
            </a>
            <a href="/content/audio/create" class="thumbnail-icon text-centered" data-original-title="Add Audio" rel="tooltip">
                <i class="icon icon-32 icon-music icon-block"></i>
            </a>
            <a href="/content/video/create" class="thumbnail-icon text-centered" data-original-title="Add Video" rel="tooltip">
                <i class="icon icon-32 icon-film icon-block"></i>
            </a>
            <a href="/content/location/checkin" class="thumbnail-icon text-centered text-red" data-original-title="New Check-In" rel="tooltip">
                <i class="icon icon-32 icon-map-marker icon-block"></i>
            </a>
        </div>
    </div>
    <hr />
    <tpl:block data="page.block.dashboard">Dashboard Content</tpl:block></div>
</tpl:layout>
