$(window).scroll(function() {
	if ($(document).scrollTop() > 150) {
		$('#main-page').addClass('appear');
		$('#logo1').fadeOut(0);
		$('#logo2').show(0);
	}
	else  {
		$('#logo2').hide(0);
        $('#logo1').fadeIn(0);
		$('#main-page').removeClass('appear');
	}
	
	});