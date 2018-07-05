//$(document).ready(function(e) {
        //$('#popup').animate({opacity:'1'},5500);
   // });
   
   window.onload=function(){
(function() {
    var visited = localStorage.getItem('visited');
    if (!visited) {
        document.getElementById("popup").style.visibility = "visible";
        localStorage.setItem('visited', true);
    }
})();
}
	
	$(window).on('pageshow',function(){ 
	
	$('#popup').animate({opacity:'1'},2000); 
	
	});