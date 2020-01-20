$('#signup-form').on('beforeSubmit', function () {
	$("#ModalBox2").append("<div class='popup'>"+ 
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
		$('.emailtext').text(data);
		$('#ModalBox2').modal('hide');
		$('#ModalBox4').modal('show');
	})
    return false; // отменяем отправку данных формы
})