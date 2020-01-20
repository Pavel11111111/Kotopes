$('#passwordRecover-form').on('beforeSubmit', function () {
	$("#ModalBox3").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.webp' class='popup_img' />"+ 
	"</div>"); 
$(".popup").fadeIn(1);
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
		if(data == 1){
			$('.hiddenrecover').attr('style', 'display: none;');
			$('.hiddenrecover2').attr('style', 'display: block;');
		}else{
			type.children(".help-block-error").text("Произошла непредвиденная ошибка, попробуйте ещё раз");
		}
		$(".popup").fadeOut(1);
			setTimeout(function() {
			  $(".popup").remove();
			},1);
	})
    return false; // отменяем отправку данных формы
})