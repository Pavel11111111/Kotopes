$('#searchIdentity-form').on('beforeSubmit', function () {
	$("#ModalBox3").append("<div class='popup'>"+ 
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
		var $elem = "";
		data.forEach(function(item, i, data) {
			$elem += item + '<br />' + '<br />';
		});
		$('.identitytextfind').html($elem);
		$('#hidModal1').attr('style', 'display: none;');
		$('#hidModal11').attr('style', 'display: block;');
		$(".popup").fadeOut(800);
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
	})
    return false; // отменяем отправку данных формы
})