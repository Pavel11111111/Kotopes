$(document).mouseup(function (e){ 
		var div = $(".searchbarmargin"); 
		if (!div.is(e.target) && div.has(e.target).length === 0) { 
			$('.searchbarhistory').attr('style', 'display:none;');
		}
	});

$('.searchinput').on('click',function(){
    if($("li").hasClass("searchline")){
	    $('.searchbarhistory').attr('style', 'display:block;');
    }
});
$( ".searchbarbuttonclear" ).click(function() {
    $(".searchline").remove();
    $.ajax({
        // Метод отправки данных (тип запроса)
        type : 'post',
        // URL для отправки запроса
        url : '/site/deletesearchproducts',
        data: {
				name: "email",
				//_csrf: csrfToken
		},
    })
    return false;
});
//проверку get параметра поиска в каталоге искать в filter.js и удаление строки тоже