$(document).on('click', '.favourites-list-add-in-cart-button', function () {
    $("body").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img' />"+
	"</div>"); 
    $(".popup").fadeIn(1);
    let variationsid = [];
    $(this).attr('style', 'display:none;');
    $(".favourites-remove-item").each(function() {
        variationsid.push($(this).attr('data-id'));
    });
    $.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/account/addincartfavourites',
        data: {
			variationsid: variationsid
		}
    })
    .done(function(data) {
        $('#add-cart-product-in-favourites-done').attr('style', 'display: block; text-align:right;')
        var basketitems = $('.items').children('p').text();
        basketitems = parseInt(basketitems, 10);
        basketitems += parseInt(data, 10);
        $('.items').children('p').text(basketitems);
        $(".popup").fadeOut(1);
		setTimeout(function() {
		  $(".popup").remove();
		}, 1);
    })
});

$(document).on('click', '.favourites-list-remove', function () {
    $("body").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img'/>"+
	"</div>"); 
    $(".popup").fadeIn(1);
    $.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/account/removefavourites',
    })
    .done(function(data) {
        if(data == 'ok'){
            $('.favourites-container').empty();
            $('.favourites-container').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cart-title"><h1 style="margin-bottom: 46px;font-size:28px;">У вас пока нет товаров в избранном, но вы можете добавить их в каталоге, нажав на сердечко в плитке товара</h1><button onclick="document.location=\'http://kotopes45.ru/Catalog\'" class="knopkaproduct" type="submit">ПЕРЕЙТИ В КАТАЛОГ</button></div>');
        }else{
            alert('Возникла непредвиденная ошибка, пожалуйста, свяжитесь с администрацией');
        }
        $(".popup").fadeOut(1);
		setTimeout(function() {
		  $(".popup").remove();
		}, 1);
    })
});

$(document).on('click', '.favourites-remove-item', function () {
    $elem = $(this);
    $parent = $elem.parent().parent().parent().parent().parent().parent();
    $parent.append("<div class='popup'>"+ 
	"<div class='popup_bg_in_elem'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img_in_elem' style = 'top: -208px;' />"+ 
	"</div></div>"); 
    $(".popup").fadeIn(1);
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/site/addinfavourites',
        data: {
			variationid: $elem.attr('data-id')
		}
    })
    .done(function(data) {
        if(data == "delete"){
            $parent.remove();
        }else{
            alert('Непредвиденная ошибка, пожалуйста, свяжитесь с администрацией!');
        }
        $(".popup").fadeOut(1);
		setTimeout(function() {
			$(".popup").remove();
		}, 1);
	})
});

$(document).on('click', '.favourites-add-item', function () {
    $elem = $(this);
    $parent = $elem.parent().parent().parent().parent().parent().parent();
    $parent.append("<div class='popup'>"+ 
	"<div class='popup_bg_in_elem'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img_in_elem' style = 'top: -208px;' />"+ 
	"</div></div>"); 
    $(".popup").fadeIn(1);
    	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/account/addproductinbasket',
        data: {
			variationid: $elem.attr('data-id')
		}
    })
    .done(function(data) {
        if(data == "PRODUCTADD"){
            $('#productinbasket').modal('show');
        }else if (data == "PRODUCTALREADY"){
            $('#productalreadyinbasket').modal('show');
        }
        $(".popup").fadeOut(1);
		setTimeout(function() {
			$(".popup").remove();
		}, 1);
	})
});

$(document).on('click', '.favourites-inform-item', function () {
    $('#checkemail-variationid').val($(this).attr('data-id'))
    $('#callme').modal('show');
});