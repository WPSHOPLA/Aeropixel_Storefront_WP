(function($){
	$(document).ready(function () {
		$(window).scroll(function() {
			  if ($(this).scrollTop() > 100){  
				jQuery('.storefront-primary-navigation').addClass('sticky');
			  }
			  else{
				jQuery('.storefront-primary-navigation').removeClass("sticky");
			  }
        		});
	});	
})(jQuery); 