$(document).ready(function(){
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
});