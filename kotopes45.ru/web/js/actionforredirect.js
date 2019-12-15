$(function(){
	if(window.location.hash == "#error"){
		$('#ModalBox5').modal('show');
		window.location.hash = "";
		return false;
	}
	if(window.location.hash == "#error2"){
		$('#ModalBox6').modal('show');
		window.location.hash = "";
		return false;
	}
})