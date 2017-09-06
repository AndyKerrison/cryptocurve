$(window).scroll(function() {
	if ($(document).scrollTop() > 150) {
	$('#main').addClass('appear');
	$('.appear').fadeIn(1000);
	}
	else{
	$('.appear').fadeOut(0, function(){ $('#main').removeClass('appear'); });
	}
	
	});