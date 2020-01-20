<?php

namespace app\commands;

use app\models\Animals;
use app\models\Delivery_date;
use yii\console\Controller;
use yii\console\ExitCode;


class DateController extends Controller
{
    public function actionIndex()
    {
        $records = Delivery_date::CronDelete();
        foreach ($records as $record) {
            $record->delete();
        }
        date_default_timezone_set('Asia/Yekaterinburg');
        //$lastdate = Delivery_date::CronLastDate();
        $d = strtotime("+5 day");
        $date = date("Y-m-d", $d);
        /*if ($date . ' 22:00:00' == $lastdate->datetime) {
            $d = strtotime("+7 day");
            if (DateController::checkNameDate($d)) {
                DateController::AddDateToDB(date("Y-m-d", $d));
            }
        } else {
            if (DateController::checkNameDate($d) == false) {
                $d = strtotime("+7 day");
            }
            DateController::AddDateToDB(date("Y-m-d", $d));
        }*/
        //if (DateController::checkNameDate($d)) {
            if(DateController::AddDateToDB($date)){
                echo "good!";
            }else{
                echo "Exception! date no add!";
            }
        /*}else{
            echo "Saturday i'ts next date!";
        }*/
    }
    
    public function checkNameDate($d)
    {
        if(date("l", $d) == "Saturday"){
            return false;
        }else{
            return true;
        }
    }
    
    public function AddDateToDB($date)
    {
        $datecount = new Delivery_date();
        $datecount->datetime = $date . ' 18:00:00';
        $datecount->save();
        $datecount = new Delivery_date();
        $datecount->datetime = $date . ' 20:00:00';
        $datecount->save();
        $datecount = new Delivery_date();
        $datecount->datetime = $date . ' 22:00:00';
        $datecount->save();
        return true;
    }
}