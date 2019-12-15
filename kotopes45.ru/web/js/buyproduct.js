$("body").on("blur", ".inputcountproduct", function () {
    if(!(/^[0-9]+$/.test($('.inputcountproduct').val()))){
        $(this).parent().parent().parent().children('.informationbyproduct').text('');
	    $('.inputcountproduct').val(1);
    }
});
$("body").on("click", ".buttonminus", function () {
    var elem = $(this).siblings(".divcountproduct").children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
    if(value - 1 != 0){
	    elem.val(value - 1);
    }
});
$("body").on("click", ".buttonplus", function () {
    var elem = $(this).siblings(".divcountproduct").children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
    elem.val(value + 1);
});
$("body").on("click", ".buyclick", function () {
    var thiselem = $(this);
    var elem = thiselem.siblings(".productshortdescription").children('.divcountproduct').children('.inputcountproduct');
    var value = Number.parseInt(elem.val());
    var variationid = thiselem.parent().parent().children('.variationsblock').children('.buttontypeproductactive').attr('data-variationid');
    $.ajax({
            // Метод отправки данных (тип запроса)
            type : 'post',
            // URL для отправки запроса
            url : '/site/checkcountproduct',
			data: {
				countproducts: value,
				variation: variationid
			},
    })
	.done(function(data) {
		if(data == 'NO'){
		    thiselem.siblings('.informationbyproduct').attr('style', 'font-size: 14px;height: 40px;color:red;')
		    thiselem.siblings('.informationbyproduct').text('На данный момент на складе нет такого количества товара');
		}else if(data == 'YES'){
		    $('.hiddenvariationid').val(variationid);
		    $('.hiddencountid').val(value);
		    $('#buyinoneclick').modal('show');
		}
	})
});
$('#buyinoneclick-form').on('beforeSubmit', function () {
	$("#buyinoneclick").append("<div class='popup'>"+ 
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
	})
    return false; // отменяем отправку данных формы
})