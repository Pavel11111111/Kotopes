$('.newproduct').on('click', function () {
	var recordid = $(this);
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/newvariaton',
            data: {
				productname: $('#productname').val(),
				productdescription: $('#productdescription').val()
			}
        })
		false;
})


$choisevalue = null;
$choisevalue2 = null;
var arr = [];
var arraylength = -1;
var arr3 = [];
var arraylength2 = -1;
$('.choicefilter').on('change', function(){
	var arr2 = $(this).val();
	if(arr2.length - 1 >= arraylength){
		$(this).val().forEach(function(entry) {
			if(arr.indexOf(entry) == -1){
				arr.push(entry);
			}
		});

	arraylength = arr.length - 1;
	$choisevalue = arr[arr.length - 1];
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/choicefilter',
        data: {
			filter: 1, 
			value: $choisevalue,
		}
    })
    .done(function(data) {
		if($(".choicefilter2").length == 0) {
			$(".filtersblock").append('<select class = "choicefilter2" multiple style = "width: 100%;margin-top: 20px;height: 32px;"><option value=""></option>');
		}
		$('.choicefilter2').append('<option disabled="disabled" class = "'+ $choisevalue +'">'+ $choisevalue +'</option>');
		for (var i in data) {
			$('.choicefilter2').append('<option value="'+ data[i].id +'" class = "'+ $choisevalue +'">'+ data[i].name +'</option>');
		}
			$(".choicefilter2").trigger("chosen:updated");
			$(".choicefilter2").chosen({
			  width: "100%",
			  disable_search: false,
			  disable_search_threshold: 5,
			  enable_split_word_search: false,
			  max_selected_options: 10,
			  no_results_text: "Ничего не найдено",
			  placeholder_text_multiple: "Выберите несколько параметров",
			  placeholder_text_single: "Выберите параметр",
			  search_contains: true,
			  display_disabled_options: true,
			  display_selected_options: true,
			  max_shown_results: Infinity
			  });	
})
	}else{
		arr.forEach(function(entry) {
			if(arr2.indexOf(entry) == -1){
				$("."+ entry).remove();
				arr.splice(arr.indexOf(entry), 1);
			}
		});
		arraylength = arr.length - 1;
			$(".choicefilter2").trigger("chosen:updated");
			$(".choicefilter3").trigger("chosen:updated");
	}
})  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).on('change', '.choicefilter2', function(){ 
	var arr4 = $(this).val();
	if(arr4.length - 1 >= arraylength2){
		$(this).val().forEach(function(entry) {
			if(arr3.indexOf(entry) == -1){
				arr3.push(entry);
			}
		});
		arraylength2 = arr3.length - 1;
	$choisevalue2 = arr3[arr3.length - 1];
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/choicefilter',
        data: {
			filter: 2, 
			value: $choisevalue2,
		}
    })
    .done(function(data) {
		$val = false;
		$val2 = 0;
		$animalsname = false;
		if($(".choicefilter3").length == 0) {
			$(".filtersblock").append('<select class = "choicefilter3" multiple style = "width: 100%;margin-top: 20px;height: 32px;"><option value=""></option>');
		}
		for (var i in data) {
			if($val2 == 0){
				$animalsname = data[0];
				$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" disabled="disabled">'+ data[1] +'</option>');
				data.splice($val2, 2);
				$val2 = 1;
			}
			for (var b in data[i]) {
				if($val == false){
					if(b == ""){
						$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" disabled="disabled">Без фильтров</option>');
					}else{
						$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" disabled="disabled">'+ b +'</option>');
					}
					$val = true;
				}
				for (var a in data[i][b]) {
					$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" value="'+ data[i][b][a][0] +'">'+ data[i][b][a][1] +'</option>');
				}
			}
			$val = false;
		}

$(".choicefilter3").trigger("chosen:updated");
$(".choicefilter3").chosen({
  width: "100%",
  disable_search: false,
  disable_search_threshold: 5,
  enable_split_word_search: false,
  max_selected_options: 10,
  no_results_text: "Ничего не найдено",
  placeholder_text_multiple: "Выберите несколько параметров",
  placeholder_text_single: "Выберите параметр",
  search_contains: true,
  display_disabled_options: true,
  display_selected_options: true,
  max_shown_results: Infinity
  });	
 
	})
	}else{
		arr3.forEach(function(entry) {
			if(arr4.indexOf(entry) == -1){
				$("."+ entry).remove();
				arr3.splice(arr3.indexOf(entry), 1);
			}
		});
		arraylength2 = arr3.length - 1;
			$(".choicefilter2").trigger("chosen:updated");
			$(".choicefilter3").trigger("chosen:updated");
	}
}) 

$(document).ready( function(e){
    $(".choicefilter").chosen({
		  width: "100%",
		  disable_search: false,
		  disable_search_threshold: 5,
		  enable_split_word_search: false,
		  max_selected_options: 10,
		  no_results_text: "Ничего не найдено",
		  placeholder_text_multiple: "Выберите несколько параметров",
		  placeholder_text_single: "Выберите параметр",
		  search_contains: true,
		  display_disabled_options: true,
		  display_selected_options: true,
		  max_shown_results: Infinity
	});
	$(".choicefilter2").chosen({
		  width: "100%",
		  disable_search: false,
		  disable_search_threshold: 5,
		  enable_split_word_search: false,
		  max_selected_options: 10,
		  no_results_text: "Ничего не найдено",
		  placeholder_text_multiple: "Выберите несколько параметров",
		  placeholder_text_single: "Выберите параметр",
		  search_contains: true,
		  display_disabled_options: true,
		  display_selected_options: true,
		  max_shown_results: Infinity
	});
});

 $('.newfilter').on('click', function () {
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/newfilters',
            data: {
				level1: $('.choicefilter').val(),
				level2: $('.choicefilter2').val(),
				level3: $('.choicefilter3').val(),
				productid: $("#pruductid").val()
			}
        })
		false;
 })
 
 $('.changefilter').on('click', function () {
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/changefilter',
            data: {
				level1: $('.choicefilter').val(),
				level2: $('.choicefilter2').val(),
				level3: $('.choicefilter3').val(),
				productid: $("#pruductid").val()
			}
        })
		false;
 })
 
 $('.addvariation').on('click', function () {
	var i = $('.block').length;
	
	$(".blocks").append('<div class="block ' + i + '" style = "margin-top: 20px; border: 1px solid darkred">                 <p class = "text-center banuser">Фотография</p>                 <input type="file" name="Product[' + i + '][image]" class="uploadButton filevariation">                 <p class = "text-center banuser">Разновидность</p>                 <input type="text" name="Product[' + i + '][name]" class="form-control text-left namevariation">                 <p class = "text-center banuser">Цена</p>                 <input type="text" name="Product[' + i + '][price]" class="form-control text-left pricevariation">                 <p class = "text-center banuser">Скидка</p>                 <input type="text" name="Product[' + i + '][sale]" class="form-control text-left salevariation">                 <p class = "text-center banuser">Количество на складе</p>                 <input type="text" name="Product[' + i + '][count]" class="form-control text-left countvariation"><p class = "text-center banuser">Место в списке</p> <input type="text" name="Product[' + i + '][place]" class="form-control text-left placevariation"><button type="button" class="knopkafeedback deletevariation" id = "-1" style="margin-top:45px;">Удалить</button><br><br>             </div>');
});

 $('.addnewstextlist').on('click', function () {
	var i = $('.block').length;
	
	$(".blocks").append('<div class="block ' + i + '" style = "margin-top: 20px; border: 1px solid darkred"><p class = "text-center banuser">Текст перед названием</p><input type="text" name="Informationtextlist[' + i + '][text]" class="form-control text-left namevariation" style = "margin-bottom:44px;"><p class = "text-center banuser">Название товара для новости</p><input type="text" name="Informationtextlist[' + i + '][link]" class="form-control text-left namevariation" style = "margin-bottom:44px;"><input type ="hidden" name = "Informationtextlist[' + i + '][id]" value = "0"></div>');
});

$('.deletenewstext').on('click', function () {
    $deleteid = $(this).attr('id');
	$(this).parent().remove();
	$.ajax({
        type: 'post',
        url: 'http://kotopes45.ru/admin/deletenewsproducts',
        data: {
			productid: $deleteid
		}
    })
});
$(document).on('click', '.deletevariation', function(){ 
	var id = $(this).attr('id');
	$this = $(this);
	if(id == -1){
		$this.parent().remove();
	}else{
		$.ajax({
            type: 'post',
            url: 'http://kotopes45.ru/admin/deletevariation',
            data: {
				variationid: id
			}
        })
		.done(function(data) {
			$this.parent().remove();
		})
	}
});
var $filters = [];
 $(document).ready(function(){
	if($(".choicefilter").val() != null) {
		$.ajax({
			type: 'post',
			url: 'http://kotopes45.ru/admin/choicefilterreadypage',
			data: {
				filter: 1, 
				value: $(".choicefilter").val(),
				productid: $("#pruductid").val()
			}
		})
		.done(function(data) {
			for (var a in data) {
				for (var b in data[a]){
					$('.choicefilter2').append('<option disabled="disabled" class = "'+ b +'">'+ b +'</option>');
					for(var c in data[a][b]){
						if(data[a][b][c][1] == true){
							$('.choicefilter2').append('<option selected value="'+ data[a][b][c][0].id +'" class = "'+ b +'">'+ data[a][b][c][0].name +'</option>');
							$filters.push(data[a][b][c][0].id);
						}
						else{
							$('.choicefilter2').append('<option value="'+ data[a][b][c][0].id +'" class = "'+ b +'">'+ data[a][b][c][0].name +'</option>');
						}
					}
				}
			}
				$(".choicefilter2").trigger("chosen:updated");
				$(".choicefilter2").chosen({
				  width: "100%",
				  disable_search: false,
				  disable_search_threshold: 5,
				  enable_split_word_search: false,
				  max_selected_options: 10,
				  no_results_text: "Ничего не найдено",
				  placeholder_text_multiple: "Выберите несколько параметров",
				  placeholder_text_single: "Выберите параметр",
				  search_contains: true,
				  display_disabled_options: true,
				  display_selected_options: true,
				  max_shown_results: Infinity
				  });	
	if($filters != null){
		$.ajax({
			type: 'post',
			url: 'http://kotopes45.ru/admin/choicefilterreadypage',
			data: {
				filter: 2, 
				value: $(".choicefilter2").val(),
				productid: $("#pruductid").val()
			}
		})
		.done(function(data) {
		$val = false;
		$val2 = 0;
		$animalsname = false;
		if($(".choicefilter3").length == 0) {
			$(".filtersblock").append('<select class = "choicefilter3" multiple style = "width: 100%;margin-top: 20px;height: 32px;"><option value=""></option>');
		}
		for (var i in data) {
			if($val2 == 0){
				$animalsname = data[0];
				$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" disabled="disabled">'+ data[1] +'</option>');
				data.splice($val2, 2);
				$val2 = 1;
			}
			for (var b in data[i]) {
				if($val == false){
					if(b == ""){
						$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" disabled="disabled">Без фильтров</option>');
					}else{
						$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" disabled="disabled">'+ b +'</option>');
					}
					$val = true;
				}
				for (var a in data[i][b]) {
					if(data[i][b][a][2] == true){
						$('.choicefilter3').append('<option selected class = "'+ $animalsname +' '+ $choisevalue2 +'" value="'+ data[i][b][a][0] +'">'+ data[i][b][a][1] +'</option>');
					}
					else{
						$('.choicefilter3').append('<option class = "'+ $animalsname +' '+ $choisevalue2 +'" value="'+ data[i][b][a][0] +'">'+ data[i][b][a][1] +'</option>');
					}
				}
			}
			$val = false;
		}
$(".choicefilter3").trigger("chosen:updated");
$(".choicefilter3").chosen({
  width: "100%",
  disable_search: false,
  disable_search_threshold: 5,
  enable_split_word_search: false,
  max_selected_options: 10,
  no_results_text: "Ничего не найдено",
  placeholder_text_multiple: "Выберите несколько параметров",
  placeholder_text_single: "Выберите параметр",
  search_contains: true,
  display_disabled_options: true,
  display_selected_options: true,
  max_shown_results: Infinity
  });
	})
	}
		});
	}
})