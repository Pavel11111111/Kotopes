$(document).on('click', '.profile-address-header-action', function () {
    $('.address-add-hidden').attr('style', 'display:block;');
});

$(document).on('click', '#edit-address', function () {
    $('.address-add-hidden').attr('style', 'display:block;');
    return false;
});

$('#address').on('input', function() { 
    if($(this).val() != ''){
        $('.add-address-button').removeClass('button-disabled');
    }else{
        $('.add-address-button').addClass('button-disabled');
    }
});

$(document).on('click', '.add-address-button', function () {
    $thisaddress = $("#address").val();
    $.post(
		'http://kotopes45.ru/account/addaddress',
		{address:$thisaddress},
	)
	.done(function(data) {
        if(data == 'ok'){
            $('.profile-address-header-action').attr('style', 'display: none;');
            $('.address-add-hidden').attr('style', 'display: none;');
            $('.profile-address-detail').html('<p class = "profile-address-information">' + $thisaddress + '</p><ul class = "profile-address-actions"><li><a id = "edit-address" href = "">Редактировать</a></li><li><a id = "delete-address" href = "">Удалить адрес</a></li></ul>');
            $('.profile-address-detail').addClass('profile-address-detail-completed');
        }else{
            alert('Непредвиденная ошибка');
        }
    })
});

$(document).on('click', '#delete-address', function () {
    $.post(
		'http://kotopes45.ru/account/deleteaddress'
	)
	.done(function(data) {
        if(data == 'ok'){
            $('.profile-address-header-action').attr('style', 'display: block;');
            $('.profile-address-detail').html('<p class = "profile-address-information">Адрес доставки не был добавлен</p>');
            $('.profile-address-detail').removeClass('profile-address-detail-completed');
        }else{
            alert('Непредвиденная ошибка');
        }
    })
    return false;
});

$(document).on('click', '.address-cancel', function () {
    $('.address-add-hidden').attr('style', 'display:none;');
});

$('#editsignup-form').on('beforeSubmit', function () {
	$("body").append("<div class='popup'>"+ 
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
        if(data == 'emailnochange'){
            $('.information').attr('style', 'display:block;');
            $('body,html').animate({scrollTop: 0}, 0);
        }else if(data == 'emailchanged'){
            $('.information').attr('style', 'display:block;');
            $('body,html').animate({scrollTop: 0}, 0);
            $('.emailtext').text($('input[name="EditUserProfile[email]"]').val());
		    $('#ModalBox4').modal('show');
        }
        $('.profile-header').html('<h1>' + $('input[name="EditUserProfile[name]"]').val() + '<br>' + $('input[name="EditUserProfile[patronymic]"]').val() + '</h1>');
        $('.passwordblockhidden').attr('style', 'display:none;');
        $('input[name="EditUserProfile[oldpassword]"]').val('');
        $('input[name="EditUserProfile[newpassword]"]').val('');
        $('input[name="EditUserProfile[newpassword2]"]').val('');
        $('.passwordchangelink').attr('data-id', '0');
        $('.passwordchangelink').text('Изменить пароль');
		$(".popup").fadeOut(1);
		setTimeout(function() {
		  $(".popup").remove();
		}, 1);
	})
    return false; // отменяем отправку данных формы
})

$(document).on('click', '.passwordchangelink', function () {
    if($(this).attr('data-id') == 0){
        $('.passwordblockhidden').attr('style', 'display:block;');
        $(this).attr('data-id', '1');
        $(this).text('Не изменять пароль');
    }else{
        $('.passwordblockhidden').attr('style', 'display:none;');
        $('input[name="EditUserProfile[oldpassword]"]').val('');
        $('input[name="EditUserProfile[newpassword]"]').val('');
        $('input[name="EditUserProfile[newpassword2]"]').val('');
        $(this).attr('data-id', '0');
        $(this).text('Изменить пароль');
    }
});
