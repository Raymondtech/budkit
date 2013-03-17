<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav">
        <div class="navbar-inner padding-left-half">
            <ul class="nav" id="eventsmenu">
                <li><a data-target="#new-event" data-toggle="tab"><i class="icon-asterisk icon-16"></i>Create Event</a></li>
                <li class="active"><a data-target="#events-calendar" data-toggle="tab"><i class="icon-calendar icon-16"></i>Calendar</a></li>
                <li><a data-target="#events-lists" data-toggle="tab"><i class="icon-list-ul icon-16"></i>Lists</a></li>          
            </ul>
        </div>
    </div>
    <div class="tab-content ">
        <div id="events-calendar" class="tab-pane padding padding-top-zero active">
             <div id="month-calendar"></div>
        </div> 
        <div id="events-lists" class="tab-pane padding ">
             Events Lists
        </div> 
        <div id="new-event" class="tab-pane">
             <tpl:import layout="content/events/form" />
        </div>
    </div>
    <script type="text/javaScript" src="<?php echo $this->getTemplatePath() ?>/assets/js/plugins/fullcalendar/fullcalendar.js"></script>
    <script type="text/javaScript">
      <![CDATA[
           !function($){
                $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo $this->getTemplatePath() ?>/assets/js/plugins/fullcalendar/fullcalendar.css') );
                $('#month-calendar').fullCalendar({ header:{ left: 'prev,next today',center: 'title',right: 'month,basicWeek,basicDay'},editable: true, events:[] });
            }( window.jQuery );
        ]]> 
    </script>
</tpl:layout>