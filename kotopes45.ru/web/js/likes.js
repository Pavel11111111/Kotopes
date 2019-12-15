$('.likes').on('click', function () {
	if(document.getElementById("user").value == true){
		$('#ModalBox5').modal('show');
		return false;
	}
	if(document.getElementById("user2").value != 1){
		$('#ModalBox6').modal('show');
		return false;
	}
	var img = $(this);
    $.ajax({
            type: 'post',
            url: 'site/index',
            data: {like: img.attr('data-id')}
        }
    )
    .done(function(data) {
		if(data == 'OKPLUS'){
			var a = Number(img.text()) + 1;
			img.html('<img class = "animalsimg" src="/images/heart.png"/>' + ' ' + a);
		}
		if(data == 'OKMINUS'){
			var a = Number(img.text()) - 1;
			img.html('<img class = "animalsimg" src="/images/heart.png"/>' + ' ' + a);
		}
	})
})
$(document).on('pjax:complete', function() {
  $('.likes').on('click', function () {
	if(document.getElementById("user").value == true){
		$('#ModalBox5').modal('show');
		return false;
	}
	if(document.getElementById("user2").value != 1){
		$('#ModalBox6').modal('show');
		return false;
	}
	var img = $(this);
    $.ajax({
            type: 'post',
            url: 'site/index',
            data: {like: img.attr('data-id')}
        }
    )
    .done(function(data) {
		if(data == 'OKPLUS'){
			var a = Number(img.text()) + 1;
			img.html('<img class = "animalsimg" src="/images/heart.png"/>' + ' ' + a);
		}
		if(data == 'OKMINUS'){
			var a = Number(img.text()) - 1;
			img.html('<img class = "animalsimg" src="/images/heart.png"/>' + ' ' + a);
		}
	})
})
});