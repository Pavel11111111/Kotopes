<?php

use app\models\Animals;

class SetCalendar{
    function init() {
        Animals::findById(27)->delete();
    }
}