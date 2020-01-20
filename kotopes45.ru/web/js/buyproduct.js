$("body").on("keyup", ".inputcountproduct", function () {
    $elem = $(this);
	$value = $(this).val();
	if($oldvalue != $value){
    	$value = $value.replace(/[^0-9]/g, '');
    	$variationid = $(this).parent().parent().parent().children('.cart-product-price-details').children('.item-price').children('.cart-remove-item').attr('data-id');
    	if($value === 0){
    		$value = 1;
    	}
    	if(window.location.pathname == "/Cart") {
    	    if(Number($value) <= Number($(this).attr('data-id'))){
        	    if($value != ""){
        	        $("body").append("<div class='popup'>"+ 
    	            "<div class='popup_bg'></div>"+ 
    		        "<img src='/images/kot.gif' class='popup_img' />"+
    	            "</div>"); 
                    $(".popup").fadeIn(1);
            		$.pjax.reload({
            			container: "#cart-pjax",
            			url: window.location.href,
            			timeout: 0,
            			type: "POST",
            			data: {
            				'changeproductvalue': $value,
            				'variationid': $variationid
            			},
            		})
            		.done(function(data) {
            		    var input = $('*[data-id='+ $variationid +']').parent().parent().parent().children('.productshortdescription').children('.divcountproduct').children('.inputcountproduct');
            		    input.focus();
            		    var tmpStr = input.val();
                        input.val('');
                        input.val(tmpStr);
                        $(".popup").fadeOut(1);
    			        setTimeout(function() {
    			        $(".popup").remove();
    			        }, 1);
        	         })
        	    }else{
        	        $(this).val($value);
        	    }
    	    }else{
    	        $.pjax.reload({
        			container: "#cart-pjax",
        			url: window.location.href,
        			timeout: 0,
        			type: "POST",
        			data: {
        				'changeproductvalue': $(this).attr('data-id'),
        				'variationid': $variationid
        			},
        		})
        		.done(function(data) {
        		    var input = $('*[data-id='+ $variationid +']').parent().parent().parent().children('.productshortdescription').children('.divcountproduct').children('.inputcountproduct');
        		    $errorblock = input.parent().parent().children('.inputcounterrorblock');
        		    input.focus();
        		    var tmpStr = input.val();
                    input.val('');
                    input.val(tmpStr);
			        $(".popup").remove();
			        $('.inputcounterrorblock').attr('style', 'display:none');
        	        $errorblock.attr('style', 'display: block;');
        	        setTimeout(function() {
        			    $errorblock.attr('style', 'display: none;');
        			}, 2000);
        	   })
    	    }
    	}else {
    		$(this).val($value);
    	}
	}
});
$oldvalue = "";
$("body").on("keydown", ".inputcountproduct", function () {
    $oldvalue = $(this).val();
});
$("body").on("focusout", ".inputcountproduct", function () {
    $value = $(this).val();
	if($value === ""){
		$(this).val(1);
		$variationid = $(this).parent().parent().parent().children('.cart-product-price-details').children('.item-price').children('.cart-remove-item').attr('data-id');
		if(window.location.pathname == "/Cart") {
    	        $("body").append("<div class='popup'>"+ 
	            "<div class='popup_bg'></div>"+ 
		        "<img src='/images/kot.gif' class='popup_img' />"+
	            "</div>"); 
                $(".popup").fadeIn(1);
        		$.pjax.reload({
        			container: "#cart-pjax",
        			url: window.location.href,
        			timeout: 0,
        			type: "POST",
        			data: {
        				'changeproductvalue': 1,
        				'variationid': $variationid
        			},
        		})
        		.done(function(data) {
                    $(".popup").fadeOut(1);
			        setTimeout(function() {
			        $(".popup").remove();
			        }, 1);
    	         })
        }
	}
});
/*$oldvalue = 0;
$("body").on("keydown", ".inputcountproduct", function () {
	if(window.location.pathname == "/Cart") {
		if($(this).val() != "") {
			$oldvalue = $(this).val();
		}
	}
});*/

$("body").on("click", ".buttonminus", function () {
    var elem = $(this).siblings(".divcountproduct").children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
    var changed = true;
    if(value - 1 != 0){
		value -= 1;
    }else{
        changed = false;
    }

	if(window.location.pathname == "/Cart") {
	    if(changed == true){
    	    $("body").append("<div class='popup'>"+ 
    	    "<div class='popup_bg'></div>"+ 
    		"<img src='/images/kot.gif' class='popup_img' />"+
    	    "</div>"); 
            $(".popup").fadeIn(1);
    		$.pjax.reload({
    			container: "#cart-pjax",
    			url: window.location.href,
    			timeout: 0,
    			type: "POST",
    			data: {
    				'changeproductvalue': value,
    				'variationid': $(this).parent().parent().children('.cart-product-price-details').children('.item-price').children('.cart-remove-item').attr('data-id')
    			},
    		})
    		.done(function(data) {
    		    $(".popup").fadeOut(1);
    			setTimeout(function() {
    			  $(".popup").remove();
    			}, 1);
    		})
	    }
		//$('.items').children('p').text(Number.parseInt($('.items').children('p').text()) - 1);
	}else {
		elem.val(value);
	}
});
$("body").on("click", ".buttonplus", function () {
    var elem = $(this).siblings(".divcountproduct").children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
	if(window.location.pathname == "/Cart") {
	    if(value + 1 <= elem.attr('data-id')){
        	$("body").append("<div class='popup'>"+ 
        	"<div class='popup_bg'></div>"+ 
        		"<img src='/images/kot.gif' class='popup_img' />"+
        	"</div>"); 
            $(".popup").fadeIn(1);
    		$.pjax.reload({
    			container: "#cart-pjax",
    			url: window.location.href,
    			timeout: 0,
    			type: "POST",
    			data: {
    				'changeproductvalue': value + 1,
    				'variationid': $(this).parent().parent().children('.cart-product-price-details').children('.item-price').children('.cart-remove-item').attr('data-id')
    			},
    		})
    		.done(function(data) {
    		    $(".popup").fadeOut(1);
    			setTimeout(function() {
    			  $(".popup").remove();
    			}, 1);
    		})
	    }else{
	        elem.val(elem.attr('data-id'));
	        $errorblock = $(this).siblings('.inputcounterrorblock');
	        $('.inputcounterrorblock').attr('style', 'display:none');
	        $errorblock.attr('style', 'display: block;');
	        setTimeout(function() {
			    $errorblock.attr('style', 'display: none;');
			}, 2000);
    	}
	}else {
		elem.val(value + 1);
	}
});
$("body").on("click", ".buyclick", function () {
    $('.informationbyproduct').text('');
    var thiselem = $(this);
    var elem = thiselem.siblings(".productshortdescription").children('.divcountproduct').children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
    var variationid = thiselem.parent().parent().children('.variationsblock').children('.buttontypeproductactive').attr('data-variationid');
    $.ajax({
            // Метод отправки данных (тип запроса)
            type : 'post',
            // URL для отправки запроса
            url : '/site/checkcountproduct',
			data: {
				countproducts: value,
				variation: variationid
			},
    })
	.done(function(data) {
		if(data == 'NO'){
		    thiselem.siblings('.informationbyproduct').attr('style', 'font-size: 14px;height: 40px;color:red;')
		    thiselem.siblings('.informationbyproduct').text('На данный момент на складе нет такого количества товара');
		}else if(data == 'YES'){
		    $('.hiddenvariationid').val(variationid);
		    $('.hiddencountid').val(value);
		    $('#buyinoneclick').modal('show');
		}
	})
});
$('#buyinoneclick-form').on('beforeSubmit', function () {
	$("#buyinoneclick").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img' />"+ 
	"</div>"); 
    $(".popup").fadeIn(1);
    var $yiiform = $(this);
    // отправляем данные на сервер
    $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray()
        }
    )
    .done(function(data) {
	    $(".popup").fadeOut(1);
		setTimeout(function() {
			 $(".popup").remove();
		}, 1);
		$('#buyinoneclick').modal('hide');
		$('.information').attr('style', 'display: inline-block;');
		$('body,html').animate({scrollTop: 0}, 0); 
	})
    return false; // отменяем отправку данных формы
})
$("body").on("click", ".addproductinbasket", function () {
    $(this).parent().parent().append("<div class='popup'>"+ 
	"<div class='popup_bg_in_elem'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img_in_elem' />"+ 
	"</div></div>"); 
    $(".popup").fadeIn(1);
	var thiselem = $(this);
    var elem = thiselem.siblings(".productshortdescription").children('.divcountproduct').children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
    var variationid = thiselem.parent().parent().children('.variationsblock').children('.buttontypeproductactive').attr('data-variationid');
    $.ajax({
            // Метод отправки данных (тип запроса)
            type : 'post',
            // URL для отправки запроса
            url : '/site/addproductinbasket',
			data: {
				countproducts: value,
				variation: variationid
			},
    })
	.done(function(data) {
		if(data == 'NO'){
		    $('.informationbyproduct').text('');
		    thiselem.siblings('.informationbyproduct').attr('style', 'font-size: 14px;height: 40px;color:red;')
		    thiselem.siblings('.informationbyproduct').text('На данный момент на складе нет такого количества товара');
		    setTimeout(function() {
			    $('.informationbyproduct').text('');
			}, 2000);
		    $(".popup").fadeOut(1);
		    setTimeout(function() {
			    $(".popup").remove();
		    }, 1);
		}else if(data == 'YES' || data == 'EMPTY'){
		    $countproducts = Number.parseInt($('.items').children('p').text());
		    $countproducts += value;
		    $('.items').children('p').text($countproducts);
		    $('.items2').children('p').text($countproducts);
		    if(data == 'EMPTY'){
		        thiselem.parent().attr('style', 'display:none;');
		        thiselem.parent().siblings(".contentNo").attr('style', 'display:block;');
		    }
		    $('#productinbasket').modal('show');
		    $(".popup").fadeOut(1);
		    setTimeout(function() {
			    $(".popup").remove();
		    }, 1);
		}
	})
})