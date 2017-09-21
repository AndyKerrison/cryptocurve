$(document).ready(function(){
  $('ul.navi li a').click(function(){
    $('li a').removeClass("active");
    $(this).addClass("active");
});
});