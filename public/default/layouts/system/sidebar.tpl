<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div class="btn-toolbar no-margin inline">
        <div class="btn-group pull-right">   
            <button class="btn dropdown-toggle" data-toggle="dropdown" data-target="workspaces"><i class="icon icon-reorder text-gray"></i></button>         
            <ul class="dropdown-menu" id="workspaces">
                <li><a href="#">Biology Course</a></li>
                <li><a href="#">Immunology Course</a></li>
                <li><a href="#">PhD ICamB 8450F</a></li>
                <li class="divider"></li>
                <li><a href="#">Browse All Workspaces</a></li>
            </ul>
        </div>
        <div class="btn-group ">
            <button class="btn">Create Workspace ...</button>


        </div>

    </div>

    <!-- Dasboard Menu -->
    <div style="margin-top:15px">
        <tpl:menu id="dashboardmenu" type="nav-block" position="left" />
    </div>




    <div class="widget top-pad">
        <h4>Following</h4> 
        <div class="widget-body top-pad">

            <ul class="thumbnails">
                <?php for ($i = 0; $i < 15; $i++): ?>
                <li style="margin-bottom: 1px">
                    <a href="#">
                        <img src="http://placehold.it/42x42" alt="" width="42" height="42" />
                    </a>
                </li>
                <?php endfor; ?>
            </ul>
        </div>
        <small><a href="#">View all</a></small>
    </div>
    <hr />
    <div class="widget">
        <h4>Trending</h4> 
        <div class="widget-body top-pad">

            <ol class="timeline-tips-list">
                <li>
                    <div class="tip-title">Attend the <a href="#">pancake eating comp.</a></div>
                    <div class="tip-popularity pull-right">20%</div>
                    <div class="progress mini-bar progress-danger progress-bar no-margin">
                        <div class="bar" style="width: 20%;"></div>
                    </div>
                    <div class="suggestion-info">Suggested by @drstonyhills</div>
                    <div class="tip-actions"><a href="#" class="tip-response"><i class="icon-ok"></i></a> <a href="#" class="tip-response"><i class="icon-remove"></i></a></div>
                </li>
                <li>
                    <div class="tip-title">Try a discounted <a href="#">pint of Tuborg</a>.</div>  
                    <div class="tip-popularity pull-right">53%</div>

                    <div class="progress mini-bar progress-success progress-bar">
                        <div class="bar" style="width: 53%;"></div>
                    </div>
                    <div class="suggestion-info">Suggested by @drstonyhills</div>
                    <div class="tip-actions"><a href="#" class="tip-response"><i class="icon-ok"></i></a> <a href="#" class="tip-response"><i class="icon-remove"></i></a></div>
                </li>
                <li>
                    <div class="tip-title">Meet <a href="#">Rudolf Edinau</a>.</div>
                    <div class="tip-popularity pull-right">20%</div>

                    <div class="progress mini-bar progress-danger progress-bar">
                        <div class="bar" style="width: 20%;"></div>
                    </div>
                    <div class="suggestion-info">Suggested by @drstonyhills</div>
                    <div class="tip-actions"><a href="#" class="tip-response"><i class="icon-ok"></i></a> <a href="#" class="tip-response"><i class="icon-remove"></i></a></div>
                </li>
                <li>
                    <div class="tip-title">Play a <a href="#">game of darts</a>.</div>
                    <div class="tip-popularity pull-right">50%</div>

                    <div class="progress mini-bar progress-bar">
                        <div class="bar" style="width: 50%;"></div>
                    </div>
                    <div class="suggestion-info">Suggested by @drstonyhills</div>
                    <div class="tip-actions"><a href="#" class="tip-response"><i class="icon-ok"></i></a> <a href="#" class="tip-response"><i class="icon-remove"></i></a></div>
                </li>
                <li>
                    <div class="tip-title">Play a <a href="#">game of backgamon</a>.</div>
                    <div class="tip-popularity pull-right">43%</div>

                    <div class="progress mini-bar progress-danger progress-bar">
                        <div class="bar" style="width: 43%;"></div>
                    </div>
                    <div class="suggestion-info">Suggested by @drstonyhills</div>
                    <div class="tip-actions"><a href="#" class="tip-response"><i class="icon-ok"></i></a> <a href="#" class="tip-response"><i class="icon-remove"></i></a></div>
                </li>
            </ol>
        </div>
    </div>

</tpl:layout>


