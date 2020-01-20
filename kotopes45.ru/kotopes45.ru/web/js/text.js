$('#myLink').click(function(){ 	
	$('#myLink').addClass('activ');
	$('#myLink2').removeClass('activ');
	$('#myLink3').removeClass('activ');
	$('#hid1').attr('style', 'display: block;');
	$('#hid2').attr('style', 'display: none;');
	return false; 
});
$('#myLink2').click(function(){ 	
	$('#myLink2').addClass('activ');
	$('#myLink').removeClass('activ');
	$('#myLink3').removeClass('activ');
	$('#hid1').attr('style', 'display: none;');
	$('#hid2').attr('style', 'display: block;');
	return false; 
});
$('#myLink3').click(function(){ 	
	$('#myLink3').addClass('activ');
	$('#myLink').removeClass('activ');
	$('#myLink2').removeClass('activ');
	return false; 
});
$('#myLinkModal').click(function(){ 	
	$('#myLinkModal').addClass('activ2');
	$('#myLinkModal2').removeClass('activ2');
	$('#hidModal1').attr('style', 'display: block;');
	$('#hidModal11').attr('style', 'display: none;');
	$('#hidModal2').attr('style', 'display: none;');
	return false; 
});
$('#myLinkModal2').click(function(){ 	
	$('#myLinkModal2').addClass('activ2');
	$('#myLinkModal').removeClass('activ2');
	$('#hidModal1').attr('style', 'display: none;');
	$('#hidModal11').attr('style', 'display: none;');
	$('#hidModal2').attr('style', 'display: block;');
	return false; 
});