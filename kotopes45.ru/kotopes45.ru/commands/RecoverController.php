<?php

namespace app\commands;

use app\models\Animals;
use app\models\Delivery_date;
use yii\console\Controller;
use yii\console\ExitCode;


class RecoverController extends Controller
{
    public function actionIndex()
    {
        
            date_default_timezone_set('Asia/Yekaterinburg');
            //$lastdate = Delivery_date::CronLastDate();
            $d = strtotime("+3 day");
            $date = date("Y-m-d", $d);
            RecoverController::AddDateToDB($date);
            $d = strtotime("+4 day");
            $date = date("Y-m-d", $d);
            RecoverController::AddDateToDB($date);
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