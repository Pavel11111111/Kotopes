$(document).on('click', '.openfiltresbutton', function(){
    if($(this).attr('data-id') == 0){
	    $('.filterblockc').attr('style', 'display: block;');
	    $(this).text('СКРЫТЬ ФИЛЬТРЫ');
	    $(this).attr('style', 'background: #1a5c14;');
	    $(this).attr('data-id', '1');
    }else{
        $('.filterblockc').attr('style', 'display: none;');
	    $(this).text('ОТКРЫТЬ ФИЛЬТРЫ');
	    $(this).attr('style', '');
	    $(this).attr('data-id', '0');
    }
});