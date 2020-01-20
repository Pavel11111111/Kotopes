<?php

namespace app\controllers;

use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\Informationdateslist;
use app\models\Basket;
use app\models\LoginForm;
use app\models\PasswordRecover;
use app\models\SearchIdentity;
use app\models\Signup;
use app\models\EditUserProfile;
use app\models\Userssearchhistory;
use app\models\User;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\Favorites;
use app\models\Variation;
use app\models\catalog\Checkemail;

class AccountController extends Controller
{
    public $passwordRecover;
    public $login;
    public $signup;
    public $email;
    public $searchIdentity;
    public $searchHistory;
    public $basketvalue;
    public $news;

    function init() {
        if(!Yii::$app->user->isGuest){
            $counts = Basket::getInfoCountVariationByUserId(Yii::$app->user->id);
            $onecount = 0;
            foreach($counts as $count){
                $onecount += $count["count"];
            }
            $this->basketvalue = $onecount;
        }else{
            $session = Yii::$app->session;
            $session->open();
            $basketvalue = $session['basket'];
            if($session['basket'] != null) {
                $this->basketvalue = count($session['basket']);
            }else{
                $this->basketvalue = 0;
            }
        }
        $this->passwordRecover = new PasswordRecover();
        $this->email = Yii::$app->user->identity->email;
        $this->login  = new LoginForm();
        $this->signup = new Signup();
        $this->searchIdentity = new SearchIdentity();
        $this->searchHistory = new Userssearchhistory();
        $this->news = Informationdateslist::getInfo();
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->user->can('banned')) {
                $this->redirect(Url::to(['ban/index'], true));
            }
            else{
                return parent::beforeAction($action);
            }
        } else {
            return parent::beforeAction($action);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionProfile()
    {
        if(Yii::$app->request->post('EditUserProfile')){
            $makeorder = new EditUserProfile();
            $makeorder->attributes = Yii::$app->request->post('EditUserProfile');
            return $makeorder->changeUser();
        }
        return $this->render('profile',[
            'editsignup' => new EditUserProfile()
        ]);
    }
    
    public function actionAddaddress()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->defaultadress = Yii::$app->request->post('address');
        $user->save();
        return 'ok';
    }
    
    public function actionDeleteaddress()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->defaultadress = null;
        $user->save();
        return 'ok';
    }
    
    public function actionEditsignupvalidate()
    {
        $form = new EditUserProfile();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $form->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($form);
        }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////    
    public function actionFavourites(){
        return $this->render('favourites',[
            'favourites' => Favorites::getInfoByUser(),
            'callme' => new Checkemail(),
        ]);
    }
    
    public function actionAddincartfavourites(){
        $additems = 0;
        foreach(Yii::$app->request->post('variationsid') as $variationid){
            $basketitem = Basket::getInfoByUserIdAndVariationId(Yii::$app->user->id, $variationid);
            if($basketitem == null){
                $additems += 1;
                $basketitem = new Basket();
                $basketitem->user_id = Yii::$app->user->id;
                $basketitem->variation_id = $variationid;
                $basketitem->count = 1;
                $basketitem->save();
            }
        }
        return $additems;
    }
    
    public function actionRemovefavourites(){
        $allfavorites = Favorites::getInfoByUser();
        foreach($allfavorites as $favorit){
            $favorit->delete();
        }
        return 'ok';
    }
    
    public function actionAddproductinbasket()
    {
        $variation_product = Variation::getInfo2(Yii::$app->request->post('variationid'));
        $countproducts = 1;
        if($variation_product->count < 1){
            return $this->redirect(Url::to(['account/favourites']));
        }
        $recordbasket = Basket::getInfoByUserIdAndVariationId(Yii::$app->user->id, $variation_product->id);
        if($recordbasket != null){
            return 'PRODUCTALREADY';
        }else{
            $newrecordbasket = new Basket();
            $newrecordbasket->user_id = Yii::$app->user->id;
            $newrecordbasket->variation_id = $variation_product->id;
            $newrecordbasket->count = $countproducts;
            $newrecordbasket->save();
        }
        return 'PRODUCTADD';
    }
}