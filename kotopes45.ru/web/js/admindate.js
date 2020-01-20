$("body").on("click", ".makeorderdatetimebutton", function () {
    if(window.location.pathname == "/admin/times"){
        $elem = $(this);
        $url = 'http://kotopes45.ru/admin/timescontrol?timeid=' + $(this).attr('data-id') + '&timestatus=' + $(this).attr('data-status');
        $.get($url, function(data) {
            if(data == "OK"){
                if($elem.attr('data-status') == "1"){
                    $elem.addClass("makeorderdatetimebuttonclose");
                    $elem.attr('data-status', 0);
                }else{
                    $elem.removeClass("makeorderdatetimebuttonclose");
                    $elem.attr('data-status', 1);
                }
            }else{
                alert('ошибка');
            }
        });
    }
});