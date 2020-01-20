<?php
foreach($dates as $key => $date){
    $datetime = explode(" ", $date->datetime);
    if($datetime[1] == '22:00:00'){
        $datetime2[1] = '23:00:00';
    }else{
        $datetime2 = explode(" ", $dates[$key+1]->datetime);
    }
    if($datetime[0] != $olddatetime){
        if($olddatetime != null){
            echo '</div>';
        }
        echo '<p class ="feedtext">' . $datetime[0] . '</p>';
        echo '<div class = "makeordertimesblock">';
    }
    if($date->status == 0) {
        echo '<button class = "makeorderdatetimebutton " type = "button" data-status = "1" data-id = "' . $date->id . '">' . $datetime[1] . ' - ' . $datetime2[1] . '</button>';
    }else{
        echo '<button class = "makeorderdatetimebutton  makeorderdatetimebuttonclose" type = "button" data-status = "0" data-id = "' . $date->id . '">' . $datetime[1] . ' - ' . $datetime2[1] . '</button>';
    }
    $olddatetime = $datetime[0];
}
?>
</div>