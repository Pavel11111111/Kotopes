function $_GET(sParamName, thisparam = false) {
    var Params = location.search.substring(1).split("&");
	var searchResults = [];
	var variable = "";
	for (var i = 0; i < Params.length; i++){ 
	    if(thisparam == false){
		    if (Params[i].split("=")[0] == sParamName){
			    if (Params[i].split("=").length > 1) variable = Params[i].split("=")[1];
			    searchResults.push(variable);
		    }
	    }else{
	        var regexp = /filterparams\[.*\]/g;  
	        if (regexp.test(decodeURIComponent(Params[i].split("=")[0]))){
			    if (Params[i].split("=").length > 1) variable = Params[i].split("=")[1];
			    searchResults.push(decodeURIComponent(variable));
		    }
	    }
	}
	if(searchResults[0] == null){
		return false;
	}else{
		return searchResults;
	}
}
function removeURLParameter(url, parameter, thisparam = false) {
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {
        if(thisparam === false){
            var prefix = encodeURIComponent(parameter)+'=';
        }else{
            var prefix = parameter +'=';
        }
        var pars= urlparts[1].split(/[&;]/g);
        for (var i= pars.length; i-- > 0;) {   
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }
        
        if(pars.length > 0) {
            url= urlparts[0]+'?'+pars.join('&');
        } else {
            url= urlparts[0];
        }

        return url;
    } else {
        return url;
    }
}
function removeURLFiltersparams() {
    var url = document.location.href;
    return url.replace(new RegExp(/&filterparams\[.*\]=[^&]*/,'g'),"");
}


$(document).ready(function() {
    if($_GET('typeanimals')[0]){
		$('.level1').attr('style', 'display: none;');
		$("div[data-text='" + decodeURIComponent($_GET('typeanimals')) + "']").attr('style', 'display: block;');
		$('.allproductclean').prepend(' / <a href="" class = "linkc typeanimals">' + decodeURIComponent($_GET('typeanimals')) + '</a>');
		if($_GET('producttype')[0]){
			$('.level1').attr('style', 'display: none;');
			$('.level2').attr('style', 'display: none;');
			$("div[data-text='" + decodeURIComponent($_GET('producttype')) + decodeURIComponent($_GET('typeanimals')) + "']").attr('style', 'display: block;');
			$('.typeproductclean').prepend(' / <a href="" class = "linkc typeanimals">' + decodeURIComponent($_GET('producttype')) + '</a>');	
			if($_GET('', true)[0]){
				$_GET('', true).forEach(function(item, i, arr) {
				    item = item.split('|');
				    item.forEach(function(item2, i, arr) {
					    $("div[data-text='" + decodeURIComponent($_GET('producttype')) + decodeURIComponent($_GET('typeanimals'))+ "']").find('p:contains('+  decodeURIComponent(item2) +')').siblings("img").attr('src', "/images/galka.png");
					    $("div[data-text='" + decodeURIComponent($_GET('producttype')) + decodeURIComponent($_GET('typeanimals'))+ "']").find('p:contains('+  decodeURIComponent(item2) +')').parent().attr('data-id', '1');
					    $("div[data-text='" + decodeURIComponent($_GET('producttype')) + decodeURIComponent($_GET('typeanimals'))+ "']").find('p:contains('+  decodeURIComponent(item2) +')').parent().parent().attr('style', 'display:block;');
					    $("div[data-text='" + decodeURIComponent($_GET('producttype')) + decodeURIComponent($_GET('typeanimals'))+ "']").find('p:contains('+  decodeURIComponent(item2) +')').parent().parent().siblings('.turn').attr('data-id', '0');
					    $("div[data-text='" + decodeURIComponent($_GET('producttype')) + decodeURIComponent($_GET('typeanimals'))+ "']").find('p:contains('+  decodeURIComponent(item2) +')').parent().parent().siblings('.turn').children('.filterimgc').attr('src', '/images/iconminus.png');
				    });
				});
			}
		}
	}
	if($_GET('sort')[0]){
		$("#spjaxproducts").val($_GET('sort')[0]);
	}
});

$('.turn').on('click', function () {
	var type = $(this);
	var type2 = type.children(".filtertextc").text();
	if(type.attr('data-id') == "0"){
		$("div[data-text='" + type2 + "']").attr('style', 'display: none;');
		type.children(".filterimgc").attr('src', "/images/iconplus.png");
		type.attr('data-id', "1");
	}else{
		$("div[data-text='" + type2 + "']").attr('style', 'display: block;');
		type.children(".filterimgc").attr('src', "/images/iconminus.png");
		type.attr('data-id', "0");
	}
})
$('.levelup1').on('click', function () {
	var type = $(this);
	var type2 = type.children(".filtertextc").text();
	var url = document.location.href;
	if(window.location.search == ""){
	    url += "?typeanimals=" + type2;
	}else{
	    url += "&typeanimals=" + type2;
	}
	history.replaceState(null, null, url);
	settings.offset = 0;
	$(".products").empty();
    lazyloadproduct();
	$('.level1').attr('style', 'display: none;');
	$("div[data-text='" + type2 + "']").attr('style', 'display: block;');
	$('.allproductclean').prepend(' / <a href="" class = "linkc typeanimals">' + type2 + '</a>');
})
//var levelup2 = "";
$('.levelup2').on('click', function () {
	var type = $(this);
	var type2 = type.children(".filtertextc").text();
	levelup2 = type2;
	var url = document.location.href + "&producttype=" + type2;
	history.replaceState(null, null, url);
	settings.offset = 0;
	$(".products").empty();
	lazyloadproduct();
	$('.level2').attr('style', 'display: none;');
	$("div[data-id='" + type.attr('data-id') + "']").attr('style', 'display: block;');
	$('.typeproductclean').prepend(' / <a href="" class = "linkc typeanimals">' + type2 + '</a>');
	$('.level3').each(function () {
	    if($(this).attr('style') == 'display: block;'){
		    $('.resetfilters').attr('style', 'display: block;');
	    }
    });
})

$('.opengal').on('click', function () {
	var type = $(this);
	var type2 = type.children(".filtertextc").text();//ПЕРЕМЕННАЯ, КОТОРУЮ Я ХОЧУ ПОЛОЖИТЬ В URL
	if(type.attr('data-id') == "0"){
	    var thisurl = $_GET(encodeURIComponent("filterparams") + "[" + encodeURIComponent(type.parent("div").attr("data-text"))+ "]");//переменная текущая
	    if(thisurl == false){
	        var url = document.location.href + "&filterparams[" + type.parent("div").attr("data-text")+ "]=" + type2;
	        history.replaceState(null, null, url);
	    }else{
	       var url = removeURLParameter(document.location.href, encodeURIComponent("filterparams") + "[" + encodeURIComponent(type.parent("div").attr("data-text"))+ "]", true);
	       url = url + "&filterparams[" + type.parent("div").attr("data-text")+ "]=" + thisurl + "|" + type2;
	       history.replaceState(null, null, url);
	    }
	    settings.offset = 0;
	    $(".products").empty();
		lazyloadproduct();
		type.children(".filterimgc2").attr('src', "/images/galka.png");
		type.attr('data-id', "1");
	}
	else{
		var url = decodeURI(document.location.href);
		changedurl = url.replace("|" + type2, '');
		if(changedurl == url){
		    changedurl = url.replace(type2 + "|", '');
		}
		if(changedurl == url){
		    changedurl = url.replace('&filterparams\['+ type.parent("div").attr("data-text") + ']=' + type2, '');
		}
		if(changedurl == url){
		    //changedurl = url.replace(type2, '');
		}
		history.replaceState(null, null, changedurl);
		settings.offset = 0;
	    $(".products").empty();
		lazyloadproduct();
		type.children(".filterimgc2").attr('src', "/images/kvadrafon.jpg");
		type.attr('data-id', "0");
	}
})

$('.resetfilters').on('click', function () {
	history.replaceState(null, null, removeURLFiltersparams());
	settings.offset = 0;
	$(".products").empty();
	lazyloadproduct();
	$('.filterimgc2').attr('src', "/images/kvadrafon.jpg");
	$('.opengal').attr('data-id', "0");
})

$('#spjaxproducts').on('change', function(){
	var selected = $(this).val();
	var url = removeURLParameter(document.location.href, 'sort');
	history.replaceState(null, null, url);
	if(window.location.search == ""){
	    url += "?sort=" + selected;
	}else{
	    url += "&sort=" + selected;
	}
	history.replaceState(null, null, url);
	settings.offset = 0;
	$(".products").empty();
    lazyloadproduct();
	//.done(function() {
		//alert(JSON.stringify(history.state));
		//history.pushState({sort: selected}, null, document.location.href);
		//alert(JSON.stringify(history.state));
	//})
})  
$('.allproduct').on('click', function () {
	var url = removeURLFiltersparams();
	url = removeURLParameter(url, 'producttype');
	url = removeURLParameter(url, 'typeanimals');
	history.replaceState(null, null, url);
	settings.offset = 0;
	$(".products").empty();
	lazyloadproduct();
	$('.filterimgc2').attr('src', "/images/kvadrafon.jpg");
	$('.opengal').attr('data-id', "0");
	$('.level1').attr('style', 'display: block;');
	$('.level2').attr('style', 'display: none;');
	$('.level3').attr('style', 'display: none;');
	$("div.allproductclean").empty();
	$("div.typeproductclean").empty();
	$('.resetfilters').attr('style', 'display: none;');
	$('.otherfilterslist').attr('style', 'display:none');
	$('.otherlistturn').attr('data-id', '1');
	$('.otherfilterimgc').attr('src', '/images/iconplus.png');
	return false;
})
$('.allproductclean').on('click', function () {
	var type = $(this);
	var type2 = type.children(".linkc").text();
	var url =  removeURLFiltersparams();
	url = removeURLParameter(url, 'producttype');
	history.replaceState(null, null, url);
	settings.offset = 0;
	$(".products").empty();
	lazyloadproduct();
	$('.filterimgc2').attr('src', "/images/kvadrafon.jpg");
	$('.opengal').attr('data-id', "0");
	$('.level1').attr('style', 'display: none;');
	$("div[data-text='" + type2 + "']").attr('style', 'display: block;');
	$('.level3').attr('style', 'display: none;');
	$("div.typeproductclean").empty();
	$('.resetfilters').attr('style', 'display: none;');
	$('.otherfilterslist').attr('style', 'display:none');
	$('.otherlistturn').attr('data-id', '1');
	$('.otherfilterimgc').attr('src', '/images/iconplus.png');
	return false;
})
$('.typeproductclean').on('click', function () {
	return false;
})
/*window.onpopstate = function(event) {
  if(document.location.pathname == "/Catalog"){//если каталог
	window.history.back();
	if(JSON.stringify(event.state).indexOf('sort') != -1){ //если сортировка существует
		$("#spjaxproducts").val($_GET('sort')); //меняем значение селекта
	}else{//если timeout нет
		if(itssort == true){//если последнее что делал пользователь сортировка
			$("#spjaxproducts").val(1); //меняем на дороговизну
			$.pjax.reload({ //перезагружаем по дороговизне
				container: "#product-pjax",
				url: window.location.href,
				timeout: 0,
				type: "GET",
				data: {
					'sort': 1
				},
			})
			itssort = false;//понятно
		}
	}
  }
};*/
function lazyloadproduct(){
        busy = true;
        // Сообщить пользователю что идет загрузка данных 
        $('.loading-bar').text('Идёт загрузка данных...'); 
        $.ajax({ 
            type: "POST", 
            url: document.location.href, 
            timeout: 0, 
            data: { 
                'number' : settings.nop, 
                'offset' : settings.offset, 
                'productscount' : settings.productscount, 
            }, 
        }) 
        .done(function(data) { 
            //$this.find('.loading-bar').html($initmessage); 
            // Если возвращенные данные пусты то сообщаем об этом 
            if(data == "") {
                $('.loading-bar').html('Товары закончились! Если Вы не нашли нужного, можете его <a href = "http://kotopes45.ru/OrderProduct">заказать</a>.'); 
                busy = true;
            } 
            else { 
                settings.offset = settings.offset + settings.nop; 
                $('.products').append(data);
                $('.loading-bar').text(''); 
                busy = false;
// Процесс завершен 
            } 
        }) 
}
if(document.body.clientWidth >= 1200){
    var settings = { 
        nop : 9, // Количество запрашиваемых из БД записей 
        offset : 0, // Начальное смещение в количестве запрашиваемых данных 
        productscount: 3
    } 
}else if (document.body.clientWidth >= 624){
    var settings = { 
        nop : 8, // Количество запрашиваемых из БД записей 
        offset : 0, // Начальное смещение в количестве запрашиваемых данных 
        productscount: 2
    } 
}else{
     var settings = { 
        nop : 9, // Количество запрашиваемых из БД записей 
        offset : 0, // Начальное смещение в количестве запрашиваемых данных 
        productscount: 1
    } 
}
busy = false;
$(document).ready(function(){ 
    $(document).scroll(function() {
        if('/Catalog' == window.location.pathname){
            if($(window).scrollTop() + $(window).height() > $('.wrap').height() && !busy) {
                lazyloadproduct();
            } 
        }
    });
});
$( document ).ready(function() {
    if('/Catalog' == window.location.pathname){
        if($_GET('search')[0]){
            var searchvalue = decodeURIComponent($_GET('search'));
            $('.searchinput').val(searchvalue.replace(/\+/g," "));
            $('.searchbarmargin').attr('style', 'display:block;margin-bottom:30px;');
        }
        lazyloadproduct();
    }
});

$(".search-delete-icon").click(function() {
	$(".searchinput").val('');
	var url = removeURLParameter(document.location.href, 'search');
	history.replaceState(null, null, url);
	settings.offset = 0;
	$(".products").empty();
	lazyloadproduct();
});