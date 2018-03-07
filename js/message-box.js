$(document).ready(function() {
	$('#message_box').animate({ top:"+=0px",opacity:1 }, "slow");
});


$('#close_message').click(function()
{
	$('#message_box').toggleClass('closed');
	
  
  $('#message_box').animate({ top:"+=15px",opacity:0 }, "slow");
});