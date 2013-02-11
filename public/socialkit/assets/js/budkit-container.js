!function ($) {

  "use strict"; // jshint ;_;
  
  $(document).on('click.container.data-api', '[data-toggle="container-left"]', function (e) {
      e.preventDefault();
      $('.container-box').toggleClass('has-left');
      $('.container-box-toggle').find('i').toggleClass(function(){
         return ($(this).hasClass('icon-chevron-left'))?'icon-chevron-right':'icon-chevron-left'; 
      });
  }).on('click.container.data-api', '[data-toggle="container-aside"]', function (e) {
      e.preventDefault();
      $('.container-right').toggleClass('has-aside');
      $('.container-right-toggle').find('i').toggleClass(function(i, $oldClassName){
          //alert($(this).attr('class'));
         var $newClassName = ($(this).hasClass('icon-chevron-right'))?'icon-chevron-left':'icon-chevron-right'
         $(this).removeClass( $oldClassName );
         return $newClassName; 
      });
  })

}(window.jQuery);