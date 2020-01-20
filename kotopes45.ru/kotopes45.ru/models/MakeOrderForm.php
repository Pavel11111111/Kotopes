<?php

namespace app\models;

use yii\base\Model;
use app\models\Basket;
use app\models\Delivery_date;
use Yii;
class MakeOrderForm extends Model
{
    public $number;
    public $name;
    public $address;
    public $paymenttype;
    public $datetime;
    public $delivery;
    public $summary;
    public $comment;
    public function rules(){
        return[
            ['number', 'required', 'message' => 'Введите номер телефона'],
            ['number', 'validateNumber'],
            ['name', 'required', 'message' => 'Введите имя пользователя'],
            ['name', 'validateName'],
            ['address', 'required', 'message' => 'Введите адрес'],
            ['paymenttype', 'required', 'message' => 'Выберите способ оплаты'],
            ['datetime', 'required', 'message' => 'Выберите дату и время доставки'],
        ];
    }

    public function validateNumber($attribute, $params){
        ///^\+?[0-9]{min,max}$/
        if(!preg_match('/^\+?[0-9]{11,11}$/',$this->number)){
            $this->addError($attribute, 'Введите корректный номер телефона(только цифры и знак +, если он нужен)');
        }
    }
    public function validateName($attribute, $params){
        if(preg_match('/^[а-яА-Яa-zA-Z ]*$/ui',$this->name) == 0){
            $this->addError("name", 'Имена не могут содержать специальных символов и цифр');
        }
    }
    
    public function MakeOrder(){
        if(!Yii::$app->user->isGuest){
            $products = Basket::getInfoByUserId(Yii::$app->user->id);
        }else{
            $session = Yii::$app->session;
            $session->open();
            $userbasket = $session['basket'];
            if($userbasket != null) {
                $newuserbasket = [];
                sort($userbasket);
                $count = 0;
                $oldelem = null;
                foreach ($userbasket as $oneuserbasket) {
                    if ($oneuserbasket == $oldelem || $oldelem == null) {
                        $count += 1;
                    } else {
                        array_push($newuserbasket, ["variation_id" => $oldelem, "count" => $count]);
                        $count = 1;
                    }
                    $oldelem = $oneuserbasket;
                    //$variation = Variation::findOne($oneuserbasket);
                    //array_push($massivbaskets, ["variation" => $variation, "count" => 1]);
                }
                array_push($newuserbasket, ["variation_id" => $oneuserbasket, "count" => $count]);
                $userbasket = [];
                foreach ($newuserbasket as $onenewuserbasket) {
                    array_push($userbasket, ["variation" => Variation::findOne($onenewuserbasket["variation_id"]), "count" => $onenewuserbasket["count"]]);
                }
            }
            $products = $userbasket;
        }
        $text = 'Заказал следующие товары:<br>';
        $linktextcount = 0;
        $linktext = 'http://kotopes45.ru/admin/restoreproduct';
        foreach($products as $product){
            if($product['variation']->count - $product['count'] >= 0){
                if($linktextcount == 0){
                    $linktext .= '?product[' . $linktextcount . ']=' . $product['variation']->id;
                    $linktext .= '&count[' . $linktextcount . ']=' . $product['count']; 
                }else{
                    $linktext .= '&product[' . $linktextcount . ']=' . $product['variation']->id;
                    $linktext .= '&count[' . $linktextcount . ']=' . $product['count']; 
                }
                $linktextcount += 1;
                //
                $text .= $product['variation']->product->name . " ";
                $text .= $product['variation']->name . ". ";
                $text .= "В количестве: ";
                $text .= $product['count'] . ". ";
                $text .= "Цена этого товара: " . $product['variation']->price . ". ";
                if($product['variation']->discount != null){
                    $text .= "Скидка: " . $product['variation']->discount . ". <br>";
                }else{
                    $text .= "<br>";
                }
            }else{
                $oldcount = $product['count'];
                if(!Yii::$app->user->isGuest){
                    if($product['variation']->count != 0){
                        $product['count'] = $product['variation']->count;
                        $product->save();
                    }else{
                        $product->delete();
                    }
                }else{
                    if($product['variation']->count == 0){
                        $basket = $session['basket'];
                        $basketdeleteelem = array_search($variation_id, $basket);
                        while($basketdeleteelem !== false) {
                            unset($basket[$basketdeleteelem]);
                            sort($basket);
                            $basketdeleteelem = array_search($variation_id, $basket);
                        }
                    }else{
                        $basket = $session['basket'];
                        $basketdeleteelem = array_search($variation_id, $basket);
                        $count = $product['count'];
                        while($count != $product['variation']->count) {
                            unset($basket[$basketdeleteelem]);
                            sort($basket);
                            $basketdeleteelem = array_search($variation_id, $basket);
                            $count -= 1;
                        }
                    }
                     $session['basket'] = $basket;
                }
                $resultprice = $oldcount * $product['variation']['price'] - $product['variation']->count * $product['variation']['price'];
                return $product['variation']->product->name . "|" . $product['variation']->name . "|" . $product['variation']->count . "|" . $resultprice;
            }
        }
        foreach($products as $product){
                //увеличиваем кол-во покупок для популярности
                $product['variation']->product->countbuy += $product['variation']->product->countbuy + $product['count'];
                $product['variation']->product->save();
                $product['variation']->count -= $product['count'];
                $product['variation']->save();
        }
        $deliverydate = Delivery_date::findOne($this->datetime);
        Yii::$app->mailer->compose()
                    ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                    ->setTo('mkotopes.online@ya.ru')
                    ->setSubject('Поступил новый заказ!')
                    ->setHtmlBody(
                    '<p>Пользователь с именем: ' . $this->name . '. Номером телефона: ' . $this->number . '.<br>' . $text  . '<br>Стоимость доставки: ' . $this->delivery . '<br>Общая сумма: ' . $this->summary . '<br>Он будет оплачивать ' . $this->paymenttype . '. Доставить товар требуется: ' . $deliverydate->datetime . '. <br>Адрес доставки: ' . $this->address . '<br> Комментарий к заказу: ' . $this->comment . '</p>'.
                    '<br><p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="' . $linktext . '" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">отменить заказ</b></a> </p><br><br>'.
                    '<br><p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/admin/timescontrol?timeid=' . $deliverydate->id . '&timestatus=0" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">открыть время</b></a> </p><br><br>'
                    )
                    ->send();
        $deliverydate->status = 1;
        $deliverydate->save();
        if(!Yii::$app->user->isGuest){
            foreach($products as $product){
                $product->delete();
            }
        }else{
            $session['basket'] = [];
        }
        return "ok";
    }
}
