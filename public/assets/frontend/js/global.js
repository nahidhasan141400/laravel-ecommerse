$(document).ready(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$('#input-sort').on('change', function() {
		$('#submit_search').trigger('click');
	});
	$('#main-banner,.gellery').owlCarousel({		
		autoPlay: 5000,
		singleItem: true,
		navigation: false,
		navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
		pagination: true,
		transitionStyle : "fade"
	});
	
	$('#content #special-slider').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	$('#content #feature-slider').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});

	$('#latest-slidertab').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	$('#special-slidertab').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	$('#related-slidertab').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	$('#bestseller-slidertab').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	
	 $('#brand_carouse').owlCarousel({
        items: 5,
        navigation: true,
        pagination: false
    });
	
	$('#testimonial').owlCarousel({
		items: 1,
		autoPlay: true,
		navigation: false,
		pagination: true,
		transitionStyle: 'fadeUp',
		itemsDesktop : [1199, 1],
		itemsDesktopSmall : [979, 1],
		itemsTablet : [768, 1]
	});
	$('#content #latest-blog').owlCarousel({
		items: 2,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 2],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	$('#related-slider').owlCarousel({
		items: 4,
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 3],
		itemsDesktopSmall : [979, 2],
		itemsTablet : [768, 2],
		itemsTabletSmall : false,
		itemsMobile : [479, 1]
	});
	$('#product-thumbnail').owlCarousel({
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 4],
		itemsDesktopSmall : [979, 3],
		itemsTablet : [768, 4],
		itemsTabletSmall : false,
		itemsMobile : [479, 3]
	});

	$('#product-thumbnail-image').owlCarousel({
		navigation: true,
		pagination: false,
		itemsDesktop : [1199, 4],
		itemsDesktopSmall : [979, 3],
		itemsTablet : [768, 4],
		itemsTabletSmall : false,
		itemsMobile : [479, 3]
	});


	
	
});
$(window).load(function() {
$(".preloader").removeClass("loader");
$(".preloader").css("display","none");
});
	
$.fn.tabs = function() {
	var selector = this;
	this.each(function() {
		var obj = $(this);
		$(obj.attr('href')).hide();
		obj.click(function() {
			$(selector).removeClass('selected');
			$(this).addClass('selected');
			$($(this).attr('href')).fadeIn();
			$(selector).not(this).each(function(i, element) {
					$($(element).attr('href')).hide();
			});
			return false;
		});
	});
	$(this).show();
	$(this).first().click();

	
	$("#short_message_submit").submit(function(e){
		e.preventDefault(); 
		var message=$("#short_message").val();
		var product_id=$("#product_id").val();
		var product_name=$("#product_name").val();
		var supplier_id=$("#supplier_id").val();
		var formData=new FormData();
		formData.append('message',message);
		formData.append('product_id',product_id);
		formData.append('product_name',product_name);
		formData.append('supplier_id',supplier_id);
		var get_protocol=location.protocol;
		var get_host=location.host;
		var get_location=get_protocol+"//"+get_host+"/message/"+product_id;                                                      
		$.ajax({
			url:get_location,
			dataType : 'json',
			method:'POST',
			data:formData,
			processData:false,
			contentType:false,
			success:function(response){
				
				if(response.success=="ok")
				{
					$("#short_message").val("");
					toastr.success(response.message,"Message",
                    {
                        timeOut:5e3,
                        closeButton:!0,
                        debug:!1,
                        newestOnTop:!0,
                        progressBar:!0,
                        positionClass:"toast-top-right",
                        preventDuplicates:!0,
                        onclick:null,
                        showDuration:"300",
                        hideDuration:"1000",
                        extendedTimeOut:"1000",
                        showEasing:"swing",
                        hideEasing:"linear",
                        showMethod:"fadeIn",
                        hideMethod:"fadeOut",
						tapToDismiss:!1
					})
				}
			},
			error:function(error){
				console.log(error);
			}
		});
	  
	});
};





