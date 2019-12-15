$('#addlover-form').on('beforeSubmit', function () {
	$("#ModalBox7").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.webp' class='popup_img' />"+ 
	"</div>"); 
$(".popup").fadeIn(1);
})