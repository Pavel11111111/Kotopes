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
		if(data["img"] != null){
			$a.parent().parent().children(".productimage").attr('src', '/images/products/' + data["img"]);
		}
		if(data["discount"] != null){
			$a.parent().parent().children(".discount").attr('style', 'display:block;');
			$a.parent().parent().children(".discount").text("Скидка " + data["discount"] + " ₽");
			data["price"] = data["price"] - data["discount"];
		}else{
			$a.parent().parent().children(".discount").attr('style', 'display:none;');
		}
		if(data["count"] != 0){
			$a.parent().parent().children(".contentYes").attr('style', 'display: block;');
			$a.parent().parent().children(".contentYes").children("#variation").val(data["id"]);
			$a.parent().parent().children(".contentNo").attr('style', 'display: none;');
			if(data["price"] != null){
				$a.parent().parent().children(".contentYes").children(".priceproduct").text(data["price"] + " ₽");
			}
		}else{
			$a.parent().parent().children(".contentYes").attr('style', 'display: none;');
			$a.parent().parent().children(".contentNo").attr('style', 'display: block;');
			$a.parent().parent().children(".contentNo").children("#variation").val(data["id"]);
			if(data["price"] != null){
				$a.parent().parent().children(".contentNo").children(".priceproduct").text(data["price"] + " ₽");
			}
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
		$('.information').attr('style', 'display: inline-block;');
		$('body,html').animate({scrollTop: 0}, 0); 
	})
    return false; // отменяем отправку данных формы
})