$(document).on('click', '.delete', function () {
		var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'deletebanner',
            data: {id: recordid.attr('id')}
        })
		false;
})

$(document).on('click', '.checkanimals', function () {
		var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/checkrecordanimals',
            data: {id: recordid.attr('id')}
        })
		false;
})
$(document).on('click', '.deleteanimals', function () {
		var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/deleteanimals',
            data: {id: recordid.attr('id')}
        })
		false;
})

$(document).on('click', '.banuser', function () {
		var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/banuser',
            data: {id: recordid.attr('id'),info: recordid.attr('data-info')}
        })
		false;
})

$(document).on('click', '.newlevelone', function () {
	var recordvalue = document.getElementById("newlevelonepost").value;
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/newfilterlevelone',
            data: {value: recordvalue}
        })
		false;
})

$(document).on('click', '.changelevelone', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/changefilterlevelone',
            data: {id: recordid.attr('data-id'), value: document.getElementById(recordid.attr('data-id')).value}
        })
		false;
})

$(document).on('click', '.deletelevelone', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/deletefilterlevelone',
            data: {id: recordid.attr('id')}
        })
		false;
})

$(document).on('click', '.newleveltwo', function () {
	var recordvalue = document.getElementById("newleveltwopost").value;
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/newfilterleveltwo',
            data: {value: recordvalue, value2: $("#newleveltwopost2").val()}
        })
		false;
})

$(document).on('click', '.changeleveltwo', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/changefilterleveltwo',
            data: {
				id: recordid.attr('data-id'), 
				value: $("input[data-leveltwo = '" + recordid.attr('data-id') + "']").val(),
				value2: $("select[data-leveltwo = '" + recordid.attr('data-id') + "']").val()
			}
        })
		false;
})

$(document).on('click', '.deleteleveltwo', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/deletefilterleveltwo',
            data: {id: recordid.attr('id')}
        })
		false;
})

$(document).on('click', '.newleveltree', function () {
	var recordvalue = document.getElementById("newleveltreepost").value;
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/newfilterleveltree',
            data: {value: recordvalue, value2: $("#newleveltreepost2").val()}
        })
		false;
})

$(document).on('click', '.changeleveltree', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/changefilterleveltree',
            data: {
				id: recordid.attr('data-id'), 
				value: $("input[data-leveltree = '" + recordid.attr('data-id') + "']").val(),
				value2: $("select[data-leveltree = '" + recordid.attr('data-id') + "']").val()
			}
        })
		false;
})

$(document).on('click', '.deleteleveltree', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/deletefilterleveltree',
            data: {id: recordid.attr('id')}
        })
		false;
})

$(document).on('click', '.newleveltree2', function () {
	var recordvalue = document.getElementById("newleveltree2post").value;
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/newfilterleveltree2',
            data: {value: recordvalue, value2: $("#newleveltree2post2").val()}
        })
		false;
})

$(document).on('click', '.changeleveltree2', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/changefilterleveltree2',
            data: {
				id: recordid.attr('data-id'), 
				value: $("input[data-leveltree2 = '" + recordid.attr('data-id') + "']").val(),
				value2: $("select[data-leveltree2 = '" + recordid.attr('data-id') + "']").val()
			}
        })
		false;
})

$(document).on('click', '.deleteleveltree2', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/deletefilterleveltree2',
            data: {id: recordid.attr('id')}
        })
		false;
})