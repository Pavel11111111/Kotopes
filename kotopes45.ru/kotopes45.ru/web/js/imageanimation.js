if (window.location.pathname == '/' || window.location.pathname == '/HomePage'){
/*var target = $('.back');
var winHeight = $(window).height();
var heihgtTopToElement = $(".back").offset().top - 200;	
var heihgtTopToElement2 = $(".back").offset().top + 200;					   
	$(window).scroll(function() {
		if ( $(window).scrollTop() > heihgtTopToElement ) {
			$(".container").addClass("backgroundhide");
			$(".footer").addClass("backgroundhide");
		} else  {
			$(".container").removeClass("backgroundhide");
			$(".footer").removeClass("backgroundhide");
		}
		if($(window).scrollTop() > heihgtTopToElement2) {
			$(".container").removeClass("backgroundhide");
			$(".footer").removeClass("backgroundhide");
		}
});*/
$('.back').mouseover(function() {
    if(!is_touch_device()){
	    $(".container").addClass("backgroundhide");
	    $(".footer").addClass("backgroundhide");
    }
});
$('.back').mouseout(function(){//доделать
    if(!is_touch_device()){
        $(".container").removeClass("backgroundhide");
        $(".footer").removeClass("backgroundhide");
    }
});
}
function is_touch_device() {
  return !!('ontouchstart' in window);
}
$(function() {
    $('.backtotop').click(function(){
       $('html, body').animate({scrollTop:0});
       return false;
   });
});