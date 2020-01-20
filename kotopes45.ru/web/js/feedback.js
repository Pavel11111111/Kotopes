$('#feedback-form').on('beforeSubmit', function () {
    $("body").append("<div class='popup'>"+ 
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
		$('.showtext').attr('style', 'display: block;');
		$('.hidtext').attr('style', 'display: none;');
	})
    return false; // отменяем отправку данных формы
})