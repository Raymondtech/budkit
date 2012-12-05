<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <div id="events-calendar"></div> 
    <script type="text/javaScript" src="<?php echo $this->getTemplatePath() ?>/js/plugins/fullcalendar/fullcalendar.js"></script>
    <script type="text/javaScript">
       <![CDATA[
           !function($){
                $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo $this->getTemplatePath() ?>/js/plugins/fullcalendar/fullcalendar.css') );
                $('#events-calendar').fullCalendar({ header:{ left: 'prev,next today',center: 'title',right: 'month,basicWeek,basicDay'},editable: true, events:[] });

            }( window.jQuery );
        ]]>
    </script>
</tpl:layout>