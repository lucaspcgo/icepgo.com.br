(function($){
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');

	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });

	  return false;
	});
})(jQuery)


/* sticky navbar */

jQuery(function(){
  
	hesta_createSticky(jQuery("#myHeader"));

});

function hesta_createSticky(sticky) {
	
	if (typeof sticky !== "undefined") {

		var	pos = sticky.offset().top,
				win = jQuery(window);
			
		win.on("scroll", function() {
    		win.scrollTop() >= pos ? sticky.addClass("sticky") : sticky.removeClass("sticky");      
		});			
	}
}

/* scroll */
jQuery(document).ready(function () {
	
	jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.scrollup').fadeIn();
			} else {
				jQuery('.scrollup').fadeOut();
			}
	});
	
	jQuery('.scrollup').click(function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
	});
	
});	


jQuery(document).ready(function($) {
    $('.fadeOut').owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        loop: false,
        margin: 10,
		nav: true,
		dots: false,
    });
});

jQuery(document).ready(function($) {
    $('.home-blog').owlCarousel({
        animateOut: 'fadeOut',
        loop: false,
		items: 3,
        margin: 10,
		nav: true,
		dots: false,
		responsiveClass:true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
		responsive: {
		  0:{
			items:1, // from this breakpoint 678 to 959
		  },
		  
		  480:{
			items:1, // from this breakpoint 960 to 1199
		  },
		  
		  768:{
			items:2,
		  },
		  1199:{
			items:3,  
		  }
		}
    });
});