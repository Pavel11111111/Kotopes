$(document).ready(function() {
	if(window.location.hash == "#error"){
		window.location.href = document.location.pathname + "#";
		$('#ModalBox5').modal('show');
	}
	if(window.location.hash == "#error2"){
		window.location.href =  document.location.pathname + "#";
		$('#ModalBox6').modal('show');
	}
})