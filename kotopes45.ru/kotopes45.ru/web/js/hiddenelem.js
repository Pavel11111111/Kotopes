//подсказки в форме регистрации
$(function(){
	$(document).on('focus', '#openpod', function () {
		$('#hidpod').attr('style', 'display: block;');
	})
})
$(function(){
	$(document).on('blur', '#openpod', function () {
		$('#hidpod').attr('style', 'display: none;');
	})
})
$(function(){
	$(document).on('focus', '.openpod2', function () {
		$('#hidpod2').attr('style', 'display: block;');
	})
})
$(function(){
	$(document).on('blur', '.openpod2', function () {
		$('#hidpod2').attr('style', 'display: none;');
	})
})