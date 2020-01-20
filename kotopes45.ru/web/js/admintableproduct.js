$('.deleteproduct').on('click', function () {
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/product',
        data: {
			deleteproduct: $(this).attr('id')
		}
    })
});

$('.deletenews').on('click', function () {
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/deletenews',
        data: {
			newsid: $(this).attr('id')
		}
    })
});

$('.productform').submit(function(e){
    var data =  $(this).serializeArray();
    data.push({
		"name": "id",
		"value":  $(this).attr('id')
	});
    $.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/product',
        data: {
			Product: data
		}
    })
	return false;
});

$(document).on("click touchend", ".changeproduct, .deleteproduct, .backtotable", ".newproduct", function () {
     $value = $("html").scrollTop();
     set_cookie("scroll", $value);
});

$( document ).ready(function() {
    if(window.location.pathname == "/admin/product") {
        var cookievalue = get_cookie("scroll");
        if(cookievalue != null){
            $("html").scrollTop(cookievalue);
        }
    }
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