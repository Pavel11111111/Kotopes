$(document).ready(function() { 
	
	$(".animalsimgopen").click(function(){	
	  	var img = $(this);	
		var src = img.attr('data-img');
		$("body").append("<div class='popup'>"+ 
						 "<div class='popup_bg'></div>"+ 
						 "<img src='"+src+"' class='popup_img' />"+ 
						 "</div>"); 
		$(".popup").fadeIn(1); 
		$(".popup_bg").click(function(){
			$(".popup").fadeOut(1);
			if(!is_touch_device()){
			    $(".container").addClass("backgroundhide");
			    $(".footer").addClass("backgroundhide");
			}
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
		});
		$(".popup_img").click(function(){
			$(".popup").fadeOut(1);
			if(!is_touch_device()){
			    $(".container").addClass("backgroundhide");
			    $(".footer").addClass("backgroundhide");
			}
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
		});
	});
	
});
$(document).on('pjax:complete', function() {
  $(".animalsimgopen").click(function(){	
	  	var img = $(this);	
		var src = img.attr('data-img');
		$("body").append("<div class='popup'>"+ 
						 "<div class='popup_bg'></div>"+ 
						 "<img src='"+src+"' class='popup_img' />"+ 
						 "</div>"); 
		$(".popup").fadeIn(1); 
		$(".popup_bg").click(function(){	   
			$(".popup").fadeOut(800);
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
		});
		$(".popup_img").click(function(){
			$(".popup").fadeOut(800);
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
		});
	});
});
function is_touch_device() {
  return !!('ontouchstart' in window);
}