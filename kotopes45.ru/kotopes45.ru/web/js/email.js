//отправить email пользователю повторно
$('#email').click(function(){ 	
	$("#ModalBox4").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.webp' class='popup_img' />"+ 
	"</div>"); 
$(".popup").fadeIn(1);
	//var csrfToken = $('meta[name="csrf-token"]').attr("content");
	$.ajax({
            // Метод отправки данных (тип запроса)
            type : 'post',
            // URL для отправки запроса
            url : '/site/index',
			data: {
				name: "email",
				//_csrf: csrfToken
			},
        })
	.done(function(data) {
		$('.hiddenemail').attr('style', 'display: none;');
		$('.hiddenemail2').attr('style', 'display: block;');
		$(".popup").fadeOut(1);
			setTimeout(function() {
			  $(".popup").remove();
			}, 1);
	})
	return false; 
});

//отправить email на другой адрес эл.почты
//скрыть поля
$('#email2').click(function(){ 	
	$('.hiddenemail3').attr('style', 'display: none;');
	$('.hiddenemail4').attr('style', 'display: block;');
});

$('.emailbutton').click(function(){
	$("#ModalBox4").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.webp' class='popup_img' />"+ 
	"</div>"); 
$(".popup").fadeIn(1);
	var param = $('meta[name="csrf-param"]').attr("content");
    var token = $('meta[name="csrf-token"]').attr("content");
	$.ajax({
            // Метод отправки данных (тип запроса)
            type : 'post',
            // URL для отправки запроса
            url : '/site/index',
			data: { 
				email: $(".emailinput").val(),
				noemptyemail: 'h',
				param: token
			},
			success: function (response) {
				if(response == 'OK'){
					$('.emailtext').text($(".emailinput").val());
					$('.hiddenemail4').attr('style', 'display: none;');
					$('.hiddenemail5').attr('style', 'display: block;');
				}else{
					$('.texterror').text(response);
					$('.texterror').attr('style', 'display: block;font-size: 11px; color: red;');
				}
				$(".popup").fadeOut(1);
				setTimeout(function() {
					$(".popup").remove();
				}, 1);
			}
        })
});