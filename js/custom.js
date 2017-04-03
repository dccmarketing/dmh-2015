(function($) {
	$( document ).ready(function() {

	/*************************
	     Sidebar Height
	*************************/
	var height = $('.main').height();
	var sideHeight = $('.sideBar').height();
	console.log(height);

	if($(window).width() > 767){
		if ((height > 500) && (sideHeight < height)) {
		$('.sideBar').height( height );}
	}

	/*************************
	    Mobile Navigation
	*************************/
	$('#mobileNav').click(function() {
		$('#primaryNav').slideToggle();
		$('#mobileNav .navBtn .close').toggle();
		$('#mobileNav .navBtn .open').toggle();

	});

	$('.mobile-sidebar').click(function() {
		$('.sideBar').slideToggle();
		$('.mobile-sidebar .up').toggle();
		$('.mobile-sidebar .down').toggle();
	});

	/*************************
	          Slider
	*************************/
	$('.carousel-inner .item:first-child').addClass('active');


	/*************************
	     Homepage Events
	*************************/
	$('.home .main .communication .nav li').click(function() {
		$('.home .main .communication .nav li').removeClass('active');
		$(this).addClass('active');

	});

	$('#newsBtn').click(function() {
		$('#com-news').show();
		$('#com-events').hide();
	});

	$('#eventsBtn').click(function() {
		$('#com-events').show();
		$('#com-news').hide();
	});



	/*************************
	   Find a Doctor by Name
	*************************/
	$('.letters li').click(function() {

		var letterID = $(this).attr('id');

		$('.doc-name').hide();

		if(!$('.doc-name' + '.' + letterID).length){
			$('.doc-name.none').show();
		}
		else {
			$('.doc-name' + '.' + letterID).show();
		}
	});

	$('.viewAll').click(function() {
		$('.doc-name').show();
		$('.doc-name.none').hide();
	});


	/*************************
	  Single Doctor/Location
	*************************/
	$('.section .info').each(function() {
		if ($.trim($(this).text()) == '') {
			$(this).siblings('.label').hide();
		}

	});




	$('.home .main .mainContent .moreInfo h4').click(function() {
		$('.home .main .mainContent .moreInfo p').fadeToggle();
	});

	
	$('.btn-phones').click(function() {
		$('.nav-phones').slideToggle( 250 );
	});



	});//end .ready
})( jQuery );
