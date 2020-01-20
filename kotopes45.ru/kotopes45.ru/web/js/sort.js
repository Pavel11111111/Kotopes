$(function(){
  $('#spjax').on('change', function(){
	$("body").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.webp' class='popup_img' />"+ 
	"</div>"); 
$(".popup").fadeIn(1);
    $.pjax.reload({
        container: "#view-mode-pjax",
        url: window.location.href,
        timeout: 0,
		type: "POST",
        data: {
           'selectsort': $(this).val()
        },
    })
	.done(function() {
	$('.owl-carousel').owlCarousel({
		lazyLoad:true,
		dots: false,
		nav: true,
		navText: ['<img class = "carouselnavigationst" src="/images/strelka2.png"/>','<img class = "carouselnavigationst" src="/images/strelka1.png"/>'],
		animateOut: "fadeOut",
		margin: 30,
		responsiveClass:true,
		responsive:{
		0:{
            items: 1
        },
		670:{
            items: 2
        },
        1000:{
            items: 3
        },
        1600:{
            items: 4
        }
    }
	});
	$(".popup").fadeOut(1);
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
	})
  })  
})