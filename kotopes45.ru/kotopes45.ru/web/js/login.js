$('#login-form').on('beforeSubmit', function () {
	$("#ModalBox1").append("<div class='popup'>"+ 
						 "<div class='popup_bg'></div>"+ 
						 "<img src='/images/kot.gif' class='popup_img' />"+ 
						 "</div>"); 
	$(".popup").fadeIn(1); 
    var $yiiform = $(this);
	var data = $yiiform.serializeArray();
	data.push({
		"name": "LoginForm[url]",
		"value": window.location.href
	});
    // отправляем данные на сервер
    $.ajax({
            type: $yiiform.attr('method'),
            url:  $yiiform.attr('action'),
            data: data,
        }
    )
	.done(function(data) {
		$(".popup").fadeOut(1);
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
	})
    return false; // отменяем отправку данных формы
})