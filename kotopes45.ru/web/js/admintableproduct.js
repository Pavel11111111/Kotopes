$('.deleteproduct').on('click', function () {
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/product',
        data: {
			deleteproduct: $(this).attr('id')
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
})