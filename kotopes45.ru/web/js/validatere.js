$('#signup-form').on('ajaxComplete', function (event, jqXHR, textStatus) {
	if(jqXHR.responseText == '{"signup-email":[""]}'){
		$('#ModalBox2').modal('hide');
		$('#ModalBox4').modal('show');
	}
})