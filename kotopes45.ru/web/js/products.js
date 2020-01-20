var timeout = 0;

$(document).on('click', '.heart', function(){
    $elem = $(this);
    $elem.parent().append("<div class='popup'>"+ 
	"<div class='popup_bg_in_elem'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img_in_elem' />"+ 
	"</div></div>"); 
    $(".popup").fadeIn(1);
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/site/addinfavourites',
        data: {
			variationid: $elem.siblings('.variationsblock').children('.buttontypeproductactive').attr('data-variationid')
		}
    })
    .done(function(data) {
        if(data == "error"){
            $('#ModalBox5').modal('show');
            $(".popup").fadeOut(1);
		    setTimeout(function() {
			    $(".popup").remove();
		    }, 1);
        }else if(data == "add"){
            $elem.attr('src', '/images/heart3.png');
            $elem.attr('title', 'Удалить из избранного');
            $(".popup").fadeOut(1);
		    setTimeout(function() {
			    $(".popup").remove();
		    }, 1);
            $elem.parent().find('.informationbyproduct').attr('style', 'font-size: 18px;height: 40px;color:#1428a0;')
		    $elem.parent().find('.informationbyproduct').text('Товар добавлен в избранное!');
		    clearTimeout(timeout);
		    timeout = setTimeout(function() {
			    $('.informationbyproduct').text('');
			}, 2000);
        }else if(data == "delete"){
            $elem.attr('src', '/images/heart2.png');
            $elem.attr('title', 'Добавить в избранное');
            $(".popup").fadeOut(1);
		    setTimeout(function() {
			    $(".popup").remove();
		    }, 1);
		    $elem.parent().find('.informationbyproduct').attr('style', 'font-size: 18px;height: 40px;color:#1428a0;')
		    $elem.parent().find('.informationbyproduct').text('Товар удалён из избранного!');
		    clearTimeout(timeout);
		    timeout = setTimeout(function() {
			    $('.informationbyproduct').text('');
			}, 2000);
        }else{
            alert('Непредвиденная ошибка, пожалуйста, свяжитесь с администрацией!');
        }
	})
});

$(document).on('click', '.vopros', function(){ 
	$('.productnamemod').html('Описание товара: "' + $(this).siblings('.productname').text() + '"');
	$('.productdescriptionmod').html($(this).attr('data-text'));
	$('#opentext').modal('show');
});

$(document).on('click', '.buttontypeproduct', function(){
	$a = $(this);
	$a.siblings('.buttontypeproductactive').toggleClass('buttontypeproductactive buttontypeproduct');
	$a.toggleClass('buttontypeproduct buttontypeproductactive');
	$.ajax({
        type: 'post',
        data: {
			variationid: $(this).attr('data-variationid')
		}
    })
	.done(function(data) {
		if(data[0]["img"] != null){
			$a.parent().parent().children(".productimage").attr('src', '/images/products/' + data[0]["img"]);
		}
		if(data[0]["discount"] != null){
			$a.parent().parent().children(".discount").attr('style', 'display:block;');
			$a.parent().parent().children(".discount").text("Скидка " + data[0]["discount"] + " ₽");
			data[0]["price"] = data[0]["price"] - data[0]["discount"];
		}else{
			$a.parent().parent().children(".discount").attr('style', 'display:none;');
		}
		if(data[0]["count"] != 0){
			$a.parent().parent().children(".contentYes").attr('style', 'display: block;');
			$a.parent().parent().children(".contentYes").children("#variation").val(data[0]["id"]);
			$a.parent().parent().children(".contentNo").attr('style', 'display: none;');
			if(data[0]["price"] != null){
				$a.parent().parent().children(".contentYes").children(".priceproduct").text(data[0]["price"] + " ₽");
			}
		}else{
			$a.parent().parent().children(".contentYes").attr('style', 'display: none;');
			$a.parent().parent().children(".contentNo").attr('style', 'display: block;');
			$a.parent().parent().children(".contentNo").children("#variation").val(data[0]["id"]);
			if(data[0]["price"] != null){
				$a.parent().parent().children(".contentNo").children(".priceproduct").text(data[0]["price"] + " ₽");
			}
		}
		if(data[1] == true){
		    $a.parent().parent().children(".heart").attr('src', '/images/heart3.png')
		}else{
		    $a.parent().parent().children(".heart").attr('src', '/images/heart2.png')
		}
		//$a.siblings(".productimage").attr('src', '2.jpg');
	})
});

$(document).on('click', '.callme', function(){
	$('.hiddenvariationid').val($(this).siblings('#variation').val());
	$('#callme').modal('show');
});

$('#callme-form').on('beforeSubmit', function () {
	$("#callme").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.webp' class='popup_img' />"+ 
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
		$('#callme').modal('hide');
		$('.information').attr('style', 'display: block;');
		$('body,html').animate({scrollTop: 0}, 0); 
	})
    return false; // отменяем отправку данных формы
})