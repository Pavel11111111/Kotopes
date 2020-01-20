$('.makeorderdatebutton').on('click', function () {
    $check = $(this).hasClass("makeorderdatetimebuttonselected");
    $('.makeordertimebutton').attr('style', 'display:none;');
    $('.makeorderdatetimebutton ').removeClass("makeorderdatetimebuttonselected");
    $('.makeordertimebutton').removeClass("makeorderdatetimebuttonselected");
	if(!$check){
        $(this).addClass("makeorderdatetimebuttonselected");
        $('*[data-id="' + $(this).attr('data-id') + '"]').attr('style', 'display:block;');
	}else{
	    $(this).removeClass("makeorderdatetimebuttonselected");
	}
	$('#makeorderform-datetime').val('');
	$('.body-summary-price').attr('style', 'display:none;');
	//$('*[data-customerID="22"]')
})

$('.makeordertimebutton').on('click', function () {
    $check = $(this).hasClass("makeorderdatetimebuttonselected");
    $('.makeordertimebutton').removeClass("makeorderdatetimebuttonselected");
    if(!$check){
        $(this).addClass("makeorderdatetimebuttonselected");
        $(this).addClass("timebuttonselected");
        $('#makeorderform-datetime').val($(this).attr('data-value'));
        $('.body-summary-price').attr('style', 'display:block;');
        var summary =  $('.price').text();
        summary = summary.replace(/[^0-9]/g, '');
        summary = Number(summary);
        if(summary < 700){
            if($(this).html() == '18:00:00 - 20:00:00'){
                $('.deliverysummary').text('80 ₽');
                $pricevalue = $('.price').text();
                $value = $pricevalue.replace(/[^0-9]/g, '');
                $('.pricesummary').text(Number.parseInt($value) + 80 + ' ₽');
            }else{
                $('.deliverysummary').text('60 ₽');
                $pricevalue = $('.price').text();
                $value = $pricevalue.replace(/[^0-9]/g, '');
                $('.pricesummary').text(Number.parseInt($value) + 60 + ' ₽');
            }
        }else{
            $('.deliverysummary').text('Бесплатно');
            $pricevalue = $('.price').text();
            $value = $pricevalue.replace(/[^0-9]/g, '');
            $('.pricesummary').text(Number.parseInt($value) + ' ₽');
        }
        $('#makeorderform-delivery').val($('.deliverysummary').text());
        $('#makeorderform-summary').val($('.pricesummary').text());
    }else{
        $(this).removeClass("makeorderdatetimebuttonselected");
        $(this).removeClass("timebuttonselected");
        $('#makeorderform-datetime').val('');
        
    }
	//$('*[data-customerID="22"]')
})

$('#makeorder-form').on('beforeSubmit', function () {
    $("body").append("<div class='popup'>"+
        "<div class='popup_bg'></div>"+
        "<img src='/images/kot.gif' class='popup_img' />"+
        "</div>");
    $(".popup").fadeIn(1);
    $(".popup").fadeIn(800);
    var $yiiform = $(this);
    // отправляем данные на сервер
    $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray()
        }
    )
    .done(function(data) {
        if(data == 'ok'){
            $('.rightboostrap').attr('style', 'display:none;');
            $('.cart-custom-width').attr('style', 'display:none;');
            $('.cart-title').attr('style', 'display:block;');
            $('.items').children('p').text('0');
            $(".popup").fadeOut(1);
            setTimeout(function() {
                $(".popup").remove();
            }, 1);
        }else{
            var errortext = data.split("|");
            $.pjax.reload({
            	container: "#makeOrder-pjax",
            	url: window.location.href,
            	timeout: 0,
            	type: "POST",
            	data: {
                    'makeredirect': 'no'
                },
            })
            .done(function(data) {
                $('.makeorderformtext').text('Приносим свои извинения, товар ' + errortext[0] + '(' + errortext[1] + ') остался на складе в количестве ' + errortext[2] + '. Сумма заказа автоматически пересчитана, а количество данного товара в вашей корзине изменено до ' + errortext[2] + ', продолжить оформление заказа?');
                var summary =  $('.price').text();
                summary = summary.replace(/[^0-9]/g, '');
                summary = Number(summary);
                if($(".discountjs").length > 0) {
                    var discounts = $('.discountjs').text();
                    discounts = discounts.replace(/[^0-9]/g, '');
                    discounts = Number(discounts);
                }else{
                    var discounts = 0;
                }
                summary = summary - discounts;
                if(summary < 700){
                    if($('.timebuttonselected').html() == '18:00:00 - 20:00:00'){
                        $('.deliverysummary').text('80 ₽');
                    }else{
                        $('.deliverysummary').text('60 ₽');
                    }
                    var delivery = $('.deliverysummary').text();
                    delivery = delivery.split(' ');
                    delivery = Number(delivery[0]);
                    summary = summary + delivery;
                }
                $('.pricesummary').text(summary + " ₽");
                $('.countproducterrorblock').attr('style', 'display:block;');
                $('#makeorderform-delivery').val($('.deliverysummary').text());
                $('#makeorderform-summary').val($('.pricesummary').text());
                $(".popup").fadeOut(1);
                setTimeout(function() {
                    $(".popup").remove();
                }, 1);
            })
        }
    })

    return false; // отменяем отправку данных формы
})

$('#counterroryes').on('click', function () {
    $(".makeorderfinalbutton").click();
})

$('#counterrorno').on('click', function () {
    window.location.href = "http://kotopes45.ru/Cart";
})
