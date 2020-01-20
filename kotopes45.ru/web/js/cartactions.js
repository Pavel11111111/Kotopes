$( document ).ready(function() {
    if('/Cart' == window.location.pathname || '/OrderProducts' == window.location.pathname){
        // alert(window.location.pathname);
        $('body').attr('style', 'height: 100%; min-height: 100vh;');
        $('html').attr('style', 'height: 100%; min-height: 100vh;');
        $('.wrap').attr('style', 'overflow: visible;');
        $('.korzinabutton').attr('style', 'display:none;');
        $('.items2').attr('style', 'display:none;');
        $('.chel').attr('style', 'margin-right: 64px;')
    }
});
$('.korzinabutton').on('click', function () {
	document.location='http://kotopes45.ru/Cart';
})
$("body").on("click", ".cart-remove-item", function () {
	$.post(
		'http://kotopes45.ru/site/removeproductinbasket',
		{variation_id:$(this).attr('data-id')},
	);
});

$("body").on("click", ".gotoorder", function () {
    window.location.href = "http://kotopes45.ru/OrderProducts";
});

$("body").on("click", ".cart-remove-item", function () {
	$.post(
		'http://kotopes45.ru/site/removeproductinbasket',
		{variation_id:$(this).attr('data-id')},
	);
});

$("body").on("click", "#add-cart-product-in-favourites", function () {
    $("body").append("<div class='popup'>"+ 
	"<div class='popup_bg'></div>"+ 
		"<img src='/images/kot.gif' class='popup_img' />"+
	"</div>"); 
    $(".popup").fadeIn(1);
    let variationsid = [];
    $(this).attr('style', 'display:none;');
    $(".cart-remove-item").each(function() {
        variationsid.push($(this).attr('data-id'));
    });
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/site/addinfavouritescart',
        data: {
			variationsid: variationsid
		}
    })
    .done(function(data) {
        if(data == 'error'){
            $('#ModalBox5').modal('show');
        }else if(data == 'add'){
            $('#add-cart-product-in-favourites-done').attr('style', 'display:block;font-size:16px;margin-bottom:0px;line-height:0px;');
        }else{
            alert('Ошибка, свяжитесь с администрацией сайта');
        }
        $(".popup").fadeOut(1);
		setTimeout(function() {
		  $(".popup").remove();
		}, 1);
    })
});

function get_cookie ( cookie_name )
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure )
{
  var cookie_string = name + "=" + escape ( value );
 
  if ( exp_y )
  {
    var expires = new Date ( exp_y, exp_m, exp_d );
    cookie_string += "; expires=" + expires.toGMTString();
  }
 
  if ( path )
        cookie_string += "; path=" + escape ( path );
 
  if ( domain )
        cookie_string += "; domain=" + escape ( domain );
  
  if ( secure )
        cookie_string += "; secure";
  
  document.cookie = cookie_string;
}