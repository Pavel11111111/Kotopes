$('#order-form').on('beforeSubmit', function () {
    var $yiiform = $(this);
    // отправляем данные на сервер
    $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray()
        }
    )
    .done(function(data) {
		$('.showtext').attr('style', 'display: block;');
		$('.hidtext').attr('style', 'display: none;');
	})
    return false; // отменяем отправку данных формы
})