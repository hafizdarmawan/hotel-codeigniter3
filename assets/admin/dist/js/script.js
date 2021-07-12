(function ($) {
   "use strict";
   var roberto_window = $(window);
   roberto_window.on('load', function () {
      $('#preloader').fadeOut('1010', function () {
         $(this).remove();
      });
   });
});