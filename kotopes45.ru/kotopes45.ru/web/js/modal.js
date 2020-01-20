//открытие/закрытие модальных окон
$(function(){
	$(document).on('click', '#modal1', function () {
		$('#ModalBox1').modal('show');
		return false;
	})
})
$(function(){
	$(document).on('click', '#modal2', function () {
		$('#ModalBox2').modal('show');
		return false;
	})
})
$(document).on('click', '.searchIcon', function () {
	$('#SearchModal').modal('show');
	return false;
})
$(function(){
	$(document).on('click', '#modalcloseopen', function () {
		$('#ModalBox1').modal('hide');
		$('#ModalBox3').modal('show');
		if(document.body.clientHeight < 904){
			$('#ModalBox3').addClass('procrutka');
		}else{
			$('body').css('overflow-y', 'hidden');
		}
		return false;
	})
})
$('#ModalBox1').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox1').addClass('procrutka');
})
$('#ModalBox1').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox2').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox2').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox2').addClass('procrutka');
})
$('#ModalBox3').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox3').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox3').addClass('procrutka');
})
$('#ModalBox4').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox4').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox4').addClass('procrutka');
})
$('#ModalBox5').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox5').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox5').addClass('procrutka');
})
$('#ModalBox6').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox6').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox6').addClass('procrutka');
})
$('#ModalBox7').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
$('#ModalBox7').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('#ModalBox7').addClass('procrutka');
})
$(function(){
	$(document).on('click', '#modalcloseopen2', function () {
		$('#ModalBox1').modal('hide');
		$('#ModalBox2').modal('show');
		$('#ModalBox2').addClass('procrutka');
		return false;
	})
})
$(function(){
	$(document).on('click', '.modalcloseopen3', function () {
		$('#ModalBox3').modal('hide');
		$('#ModalBox1').modal('show');
		$('#ModalBox1').addClass('procrutka');
		return false;
	})
})

$(function(){
	$(document).on('click', '#modalcloseopen4', function () {
		$('#ModalBox3').modal('hide');
		$('#ModalBox2').modal('show');
		$('#ModalBox2').addClass('procrutka');
		return false;
	})
})

$(function(){
	$(document).on('click', '#modalcloseopen5', function () {
		$('#ModalBox5').modal('hide');
		$('#ModalBox2').modal('show');
		$('#ModalBox2').addClass('procrutka');
		return false;
	})
})

$(function(){
	$(document).on('click', '#modalcloseopen6', function () {
		$('#ModalBox5').modal('hide');
		$('#ModalBox1').modal('show');
		$('#ModalBox1').addClass('procrutka');
		return false;
	})
})

$(function(){
	$(document).on('click', '#ModalBox6Open', function () {
	if(document.getElementById("user").value == true){
		$('#ModalBox5').modal('show');
	}else if(document.getElementById("user2").value != 1){
		$('#ModalBox6').modal('show');
	}else{
		$('#ModalBox7').modal('show');
	}
	return false;
	})
})

$(function(){
	$(document).on('click', '.dropdown-menulink3', function () {
		$('#ModalBox4').modal('show');
		return false;
	})
})

$( document ).ready(function() {
    var cookievalue = get_cookie("openmodalinfo");
    if(cookievalue == null){
        $('#InformationBox').modal();
        $('#InformationBox').attr('style', 'display:block;');
        $('#InformationBox').addClass('in');
        set_cookie('openmodalinfo', new Date().getTime());
    } else if (new Date().getTime() -  Number(cookievalue) > 18500000000){
        $('#InformationBox').modal();
        $('#InformationBox').attr('style', 'display:block;');
        $('#InformationBox').addClass('in');
        set_cookie('openmodalinfo', new Date().getTime());
    }
});

$(document).on('click', '.opennewsmodalasadmin', function () {
      $('#InformationBox').modal();
      $('#InformationBox').attr('style', 'display:block;');
      $('#InformationBox').addClass('in');
})

$(document).on('click', '#sendinfomationbyproduct', function () {
    $('#addproductmodal').attr('style', 'display:none;');
    $("#InformationBox").append("<div class='popup'>"+ 
						 "<div class='popup_bg'></div>"+ 
						 "<img src='/images/kot.gif' class='popup_img' />"+ 
						 "</div>"); 
	$(".popup").fadeIn(1); 
    $.post("site/informationbyproduct", { text: $('#sendinformationbyproducttext').val()})
	.done(function(data) {
	    $('#addproductmodalready').attr('style', 'display:block;');
	    $(".popup").fadeOut(1);
		setTimeout(function() {
			$(".popup").remove();
		}, 1);
    });
})

$('#InformationBox').on('hidden.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
  $('html').css('overflow-y', 'auto');
})

$('#InformationBox').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
  $('html').css('overflow-y', 'hidden');
  $('#InformationBox').addClass('procrutka');
})

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