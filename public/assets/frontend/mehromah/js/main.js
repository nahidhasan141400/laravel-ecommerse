  $(document).ready(function () {
    $(".owl-carousel_2").owlCarousel({
		loop:true,
		slideTransition: 'linear',
		margin:10,
		autoplay:true,
		autoplayTimeout:5000,
		autoplaySpeed: 5000,
		autoplayHoverPause:true,
		nav:true,
		dots:false
    });

      $(".owl-carousel_3").owlCarousel({
        items:3,
        loop:true,
        nav:true,
        dots:false,
        margin:0,
    });


     $(".owl-carousel").owlCarousel({
        items:1,
        loop:true,
        nav:true,
        dots:true,
        autoplay:true,
        autoplaySpeed:1000,
        smartSpeed:1500,
        autoplayHoverPause:true
    });



    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
   
     $(".menu").click(function(){
           $(".left_responsive").addClass("show");
           $(".left_responsive").slideToggle(2000);
      });

     $(".search").click(function(){
           $(".search_parent").slideToggle(2000);
           $(".search_parent").addClass("search_parent_show");
      });
     $(".search_parent").mouseout(function(){
              setTimeout(function() { 
                $(".search_parent").slideUp(1000);
                $(".search_parent").removeClass("search_parent_show");
            }, 5000);
      });


});