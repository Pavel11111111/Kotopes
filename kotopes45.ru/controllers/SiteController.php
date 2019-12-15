<?php

namespace app\controllers;

use app\models\catalog\CheckBuyOneClickForm;
use app\models\catalog\Checkemail;
use app\models\Feedback;
use app\models\Filterparam;
use app\models\Filtername;
use app\models\InformUser;
use app\models\NewAnimals;
use app\models\Animals;
use app\models\Email;
use app\models\OrderProduct;
use app\models\PasswordRecover;
use app\models\PasswordRecoverForm;
use app\models\Products;
use app\models\SearchIdentity;
use app\models\Typeanimals;
use app\models\Typeproduct;
use app\models\Variation;
use Imagine\Image\Box;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Hots;
use app\models\Signup;
use app\models\User;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\imagine\Image;
use app\models\Userssearchhistory;

class SiteController extends Controller
{
    public $passwordRecover;
    public $login;
    public $signup;
    public $email;
    public $searchIdentity;
    public $searchHistory;

    function init() {
        $this->passwordRecover = new PasswordRecover();
        $this->email = Yii::$app->user->identity->email;
        $this->login  = new LoginForm();
        $this->signup = new Signup();
        $this->searchIdentity = new SearchIdentity();
        $this->searchHistory = new Userssearchhistory();
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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


    function actionResetPassword($token)
    {
        try {
            $model = new PasswordRecoverForm($token);
        } catch (InvalidParamException $e) {
            Yii::$app->session->setFlash('danger', 'Произошла непредвиденная ошибка, попробуйте ещё раз, если не поможет, уведомите нас об этом через форму обратной связи.');
            return $this->goHome();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Ваш пароль успешно изменён, воспользуйтесь формой входа для авторизации с новым паролем');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
      }

    public function actionValidate(){
        $user = new User;
        $user = $user->findValidate(Yii::$app->request->get('token'));
        if($user != null){
            $user->validate = 1;
            $user->save();
            Yii::$app->session->setFlash('success', 'Вы успешно зарегистрированы на сайте!');
            return $this->goHome();
        }
        else{
            Yii::$app->session->setFlash('danger', 'Произошла непредвиденная ошибка, попробуйте ещё раз, если не поможет, уведомите нас об этом через форму обратной связи.');
            return $this->goHome();
        }
    }

    public function actionValid(){
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $this->signup->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($this->signup);
        }
    }

    public function actionValidrecover(){
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $this->passwordRecover->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($this->passwordRecover);
        }
    }

    public function actionValidlogin(){
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $this->login->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($this->login);
        }
    }

    public function actionValidorder(){
        $orderproduct = new OrderProduct();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $orderproduct->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($orderproduct);
        }
    }

    public function actionValidfeedback(){
        $feedbacktext = new Feedback();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $feedbacktext->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($feedbacktext);
        }
    }

    public function actionSearchproducts()
    {
        if(Yii::$app->request->post('Search')[text] == ""){
            $searchtext = 'Pro Plan Adult Feline с курицей';
        }else{
            $searchtext = Yii::$app->request->post('Search')[text];
        }
            if(Yii::$app->user->isGuest){
                $session = Yii::$app->session;
                $session->open();
                $searchhistory = $session['searchhistory'];
                if($searchhistory == null){
                    $searchhistory = [];
                }
                $searchtextarray = array("searchtext" => $searchtext);
                array_push($searchhistory, $searchtextarray);
                $session['searchhistory'] = $searchhistory;
            }else{
                $newSearchInfo = new Userssearchhistory;
                $newSearchInfo->user_id = Yii::$app->user->id;
                $newSearchInfo->searchtext = $searchtext;
                $newSearchInfo->save();
                $oldrecord = Userssearchhistory::getInfoByOldRecord(Yii::$app->user->id);
                if($oldrecord != null){
                    $oldrecord->delete();
                }
            }
        return $this->redirect(Url::toRoute(['site/catalog', 'search' => $searchtext]));
    }
    
    public function actionDeletesearchproducts()
    {
        if(Yii::$app->user->isGuest){
            Yii::$app->session['searchhistory'] = null;
        }else{
            $searchhistory = Userssearchhistory::getAllInfoByUserid(Yii::$app->user->id);
            foreach($searchhistory as $onesearchhistory){
                $onesearchhistory->delete();
            }
        }
    }
    
    public function actionCheckcountproduct()
    {
        if(Variation::getInfo2(Yii::$app->request->post('variation'))->count < Yii::$app->request->post('countproducts')){
            return 'NO';
        }
        return 'YES';
    }
    
    public function actionIndex()
    {
        $newAnimals = new NewAnimals();
        $animals = Animals::getInfo(Yii::$app->user->id);
        if(Yii::$app->request->post('NewAnimals')) {
            if(Yii::$app->user->isGuest){
                return $this->redirect('http://kotopes45.ru/HomePage#error');
            }

            if(Yii::$app->user->identity->validate != 1){
                return $this->redirect('http://kotopes45.ru/HomePage#error2');
            }
            $newAnimals->nameA = Yii::$app->request->post('NewAnimals')['nameA'];
            $newAnimals->imgA = UploadedFile::getInstance($newAnimals, 'imgA');
            $randomName = Yii::$app->security->generateRandomString();
            $randomName = $newAnimals->upload($randomName);
            if($randomName != null){
                $fileName = $randomName . '.' . $newAnimals->imgA->extension;
                $dir = 'images/animals/' . $fileName;
                $newAnimals->imgA = $fileName;
                $photo = Image::getImagine()->open($dir);
                $photo->thumbnail(new Box(800, 800))->save($dir, ['quality' => 100]);//БОКС НЕ СЕЙВИТСЯ
                $newAnimals->create($fileName);
                Yii::$app->session->setFlash('success', 'Ваш питомец успешно загружен, и после проверки модераторами будет добавлен на сайт.');
                return $this->goHome();
            }
        }
        if(Yii::$app->request->post('selectsort')) {
            $value = Yii::$app->request->post('selectsort');
            if($value == 2){
                $animals = Animals::getInfo2(Yii::$app->user->id);
            }
        }
        if(Yii::$app->request->isAjax && yii::$app->request->post('like')){
            if(Yii::$app->user->isGuest){
                return $this->redirect('http://kotopes45.ru/HomePage#error');
            }

            if(Yii::$app->user->identity->validate != 1){
                return $this->redirect('http://kotopes45.ru/HomePage#error2');
            }
            return Animals::insertLike(yii::$app->request->post('like'));
        }

        //сброс пароля
        if(Yii::$app->request->isAjax && yii::$app->request->post('PasswordRecover')){
            $this->passwordRecover->attributes = Yii::$app->request->post('PasswordRecover');
            return $this->passwordRecover->sendEmail();
        }

        //поиск юзерса
        if(Yii::$app->request->isAjax && yii::$app->request->post('SearchIdentity')){
            $this->searchIdentity->attributes = Yii::$app->request->post('SearchIdentity');
            $validation = ActiveForm::validate($this->searchIdentity);
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($validation != null) {
                return $validation;
            }
            $findUsers = $this->searchIdentity->searchUser();
            if($findUsers == null){
                $validation[Html::getInputId($this->searchIdentity, 'date3')] = ['Пользователь с такими данными не найден'];
                return $validation;
            }
            $identity = array();
            foreach ($findUsers as $findUser){
                $usermail = $findUser->email;
                $pos = strpos($usermail, '@');
                if($pos > 3) {
                    $symbol = '';
                    for ($i = 3; $i < $pos; $i++) {
                        $symbol .= '*';
                    }
                    $usermailred = substr_replace($usermail, $symbol, 3, $pos - 3);
                }
                else{
                    $usermailred = substr_replace($usermail, '*', $pos - 1, 1);
                }
                $usernumber = $findUser->number;
                $len = strlen($usernumber);
                $symbol = '';
                for ($i = 0; $i < $len-4; $i++) {
                    $symbol .= '*';
                }
                $usernumberred = substr_replace($usernumber, $symbol, 0, $len - 4);
                array_push($identity, $usermailred);
                array_push($identity, $usernumberred);
            }
            return $identity;
        }


        //ПОВТОРНАЯ ОТПРАВКА ПИСЬМА
        if(Yii::$app->request->post('name')){
            $text = "Добрый день, для подтверждения вашего аккаунта на сайте Котопёс перейдите по следующей ссылке: http://kotopes45.ru/site/validate?token=". Yii::$app->user->identity->validate;
            Yii::$app->mailer->compose()
                ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                ->setTo(Yii::$app->user->identity->email)
                ->setSubject('Подтвердите свой аккаунт')
                ->setTextBody($text)
                ->setHtmlBody(
                    '<p style="font-weight: bold;font-size:20px;line-height: 24px;color: #000000;font-family: Helvetica, Arial, Verdana;margin:0 0 32px 0;padding:0;">Подтвердите свой аккаунт на сайте Котопёс</p>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0 0 18px 0;word-wrap: break-word;word-break:normal;">Уважаемый клиент!</p>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы зарегистрировали ' . Yii::$app->user->identity->email . ' как идентификатор вашей учетной записи на сайте Котопёс. <br> После нажатия кнопки процесс аутентификации будет завершен.</p><br>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/site/validate?token='.Yii::$app->user->identity->validate.'" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">ПОДТВЕРДИТЬ УЧЁТНУЮ ЗАПИСЬ</b></a> </p><br><br>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Если кнопка в верхней части экрана не работает, скопируйте указанный ниже адрес и вставьте его в новом окне браузера.</p>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:12px;line-height: 15px;color: #1428a0;padding:13px 16px 11px 16px;margin:6px 0 21px 0;background: #eef0f9;word-break:break-all;"><a href="http://kotopes45.ru/site/validate?token='.Yii::$app->user->identity->validate.'" style="text-decoration: none;color: #1428a0;font-size:12px;line-height:15px;color: #1428a0;font-weight: normal;font-family: Helvetica, Arial, Verdana;word-wrap: break-word;word-break:break-all;">http://kotopes45.ru/site/validate?token='.Yii::$app->user->identity->validate.'</a></p><br><br>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;"><b>Вы не проходили процесс регистрации на сайте Котопёс?</b><br>Другой пользователь мог зарегистрировать неправильный адрес электронной почты по ошибке. В таком случае просто проигнорируйте это сообщение.</p>'
                )
                ->send();
        }

        //ОТПРАВКА ПИСЬМА НА ДРУГУЮ ПОЧТУ
        if(Yii::$app->request->post('noemptyemail')){
            $emailForm = new Email();
            $emailForm->email = Yii::$app->request->post('email');
            if($emailForm->validate()){
                $userModel = Yii::$app->user->identity;
                $userModel->email = Yii::$app->request->post('email');
                $userModel->save();
                Yii::$app->mailer->compose()
                    ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                    ->setTo(Yii::$app->user->identity->email)
                    ->setSubject('Подтвердите свой аккаунт')
                    ->setTextBody($text)
                    ->setHtmlBody(
                        '<p style="font-weight: bold;font-size:20px;line-height: 24px;color: #000000;font-family: Helvetica, Arial, Verdana;margin:0 0 32px 0;padding:0;">Подтвердите свой аккаунт на сайте Котопёс</p>'.
                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0 0 18px 0;word-wrap: break-word;word-break:normal;">Уважаемый клиент!</p>'.
                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы зарегистрировали ' . Yii::$app->user->identity->email . ' как идентификатор вашей учетной записи на сайте Котопёс. <br> После нажатия кнопки процесс аутентификации будет завершен.</p><br>'.
                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/site/validate?token='.Yii::$app->user->identity->validate.'" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">ПОДТВЕРДИТЬ УЧЁТНУЮ ЗАПИСЬ</b></a> </p><br><br>'.
                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Если кнопка в верхней части экрана не работает, скопируйте указанный ниже адрес и вставьте его в новом окне браузера.</p>'.
                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:12px;line-height: 15px;color: #1428a0;padding:13px 16px 11px 16px;margin:6px 0 21px 0;background: #eef0f9;word-break:break-all;"><a href="http://kotopes45.ru/site/validate?token='.Yii::$app->user->identity->validate.'" style="text-decoration: none;color: #1428a0;font-size:12px;line-height:15px;color: #1428a0;font-weight: normal;font-family: Helvetica, Arial, Verdana;word-wrap: break-word;word-break:break-all;">http://kotopes45.ru/site/validate?token='.Yii::$app->user->identity->validate.'</a></p><br><br>'.
                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;"><b>Вы не проходили процесс регистрации на сайте Котопёс?</b><br>Другой пользователь мог зарегистрировать неправильный адрес электронной почты по ошибке. В таком случае просто проигнорируйте это сообщение.</p>'
                    )
                    ->send();
                return 'OK';
            }
            else{
                $errors = $emailForm->getErrors();
                foreach($errors as $error){
                    return $error[0];
                }
            }
        }

        //РЕГИСТРАЦИЯ
        if (Yii::$app->request->isAjax && yii::$app->request->post('Signup')) {
            $this->signup->attributes = Yii::$app->request->post('Signup');
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $random = $this->signup->signup();
            $text = "Добрый день, для подтверждения вашего аккаунта на сайте Котопёс перейдите по следующей ссылке:http://kotopes45.ru/site/validate?token=" . $random;
            Yii::$app->user->login($this->signup->getUser());
            Yii::$app->mailer->compose()
                ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                ->setTo(Yii::$app->user->identity->email)
                ->setSubject('Подтвердите свой аккаунт')
                ->setTextBody($text)
                ->setHtmlBody(
                    '<p style="font-weight: bold;font-size:20px;line-height: 24px;color: #000000;font-family: Helvetica, Arial, Verdana;margin:0 0 32px 0;padding:0;">Подтвердите свой аккаунт на сайте Котопёс</p>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0 0 18px 0;word-wrap: break-word;word-break:normal;">Уважаемый клиент!</p>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы зарегистрировали ' . Yii::$app->user->identity->email . ' как идентификатор вашей учетной записи на сайте Котопёс. <br> После нажатия кнопки процесс аутентификации будет завершен.</p><br>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/site/validate?token=' . $random . '" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">ПОДТВЕРДИТЬ УЧЁТНУЮ ЗАПИСЬ</b></a> </p><br><br>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Если кнопка в верхней части экрана не работает, скопируйте указанный ниже адрес и вставьте его в новом окне браузера.</p>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:12px;line-height: 15px;color: #1428a0;padding:13px 16px 11px 16px;margin:6px 0 21px 0;background: #eef0f9;word-break:break-all;"><a href="http://kotopes45.ru/site/validate?token=' . $random . '" style="text-decoration: none;color: #1428a0;font-size:12px;line-height:15px;color: #1428a0;font-weight: normal;font-family: Helvetica, Arial, Verdana;word-wrap: break-word;word-break:break-all;">http://kotopes45.ru/site/validate?token=' . $random . '</a></p><br><br>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;"><b>Вы не проходили процесс регистрации на сайте Котопёс?</b><br>Другой пользователь мог зарегистрировать неправильный адрес электронной почты по ошибке. В таком случае просто проигнорируйте это сообщение.</p>'
                )
                ->send();
            return Yii::$app->user->identity->email;
        }

        //АВТОРИЗАЦИЯ(Если останется время сделай отдельный action для валидации)
        if(Yii::$app->request->isAjax && yii::$app->request->post('LoginForm')){
            $this->login->attributes = Yii::$app->request->post('LoginForm');
            $url = Yii::$app->request->post('LoginForm');
            Yii::$app->user->login($this->login->getUser());
            if(Yii::$app->user->can('admin')){
                return $this->redirect(Url::to(['admin/adminpage']));
            }
            if($url["url"] != null) {
                return $this->redirect($url["url"]);
            }
            else{
                return $this->goHome();
            }
        }
        return $this->render('index',['hots' => Hots::getInfo(), 'animals' => $animals, 'newAnimals' => $newAnimals]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        return $this->goHome();
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionDelivery()
    {
        return $this->render('delivery', []);
    }


    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionOrder()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('http://kotopes45.ru/HomePage#error');
        }

        if(Yii::$app->user->identity->validate != 1){
            return $this->redirect('http://kotopes45.ru/HomePage#error2');
        }

        if(yii::$app->request->post('OrderProduct')){
                Yii::$app->mailer->compose()
                    ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                    ->setTo('mkotopes.online@ya.ru')
                    ->setSubject('Вкладка:"Заказать товар"')
                    ->setTextBody('Здарова Серый, тебе тут пользователь с Именем: ' .  Yii::$app->user->identity->name ." " .  Yii::$app->user->identity->patronymic . ". Номером телефона: " . Yii::$app->user->identity->number . ". И адресом эл. почты: " . Yii::$app->user->identity->email .  " пишет вот что: " . yii::$app->request->post('OrderProduct')['text'] . ". Его адрес: " . yii::$app->request->post('OrderProduct')['address'])
                    ->send();
        }
        return $this->render('order', ['orderproduct' => new OrderProduct()]);
    }

    public function actionFeedback()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('http://kotopes45.ru/HomePage#error');
        }

        if(Yii::$app->user->identity->validate != 1){
            return $this->redirect('http://kotopes45.ru/HomePage#error2');
        }

        if(yii::$app->request->post('Feedback')){
                Yii::$app->mailer->compose()
                    ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                    ->setTo('mkotopes.online@ya.ru')
                    ->setSubject('Вкладка:"Обратная связь"')
                    ->setTextBody('Здарова Серый, тебе тут пользователь с Именем: ' .  Yii::$app->user->identity->name ." " .  Yii::$app->user->identity->patronymic . ". Номером телефона: " . Yii::$app->user->identity->number . ". И адресом эл. почты: " . Yii::$app->user->identity->email .  " пишет вот что: " . yii::$app->request->post('Feedback')['text'] . ".     ")
                    ->send();
        }
        return $this->render('feedback',[
            'feedbacktext' => new Feedback(),
        ]);
    }

    public function actionCatalog()
    {
         /*$session = Yii::$app->session;
                echo '<pre>';
echo var_dump($session['searchhistory']);
die('</pre>');*/
        $products = Products::getInfo2();
        //сортировка
        if(Yii::$app->request->get('sort')) {
            $value = Yii::$app->request->get('sort');
            if($value == 1){
                $products = Products::getInfoByPriceDesc($products);
            }
            if($value == 2){
                $products = Products::getInfoByPriceAsc($products);
            }
            if($value == 3){
                $products = Products::getInfoByPopular($products);
            }
            if($value == 4){
                $products = Products::getInfoByNameAsc($products);
            }
            if($value == 5){
                $products = Products::getInfoByNameDesc($products);
            }
        }
        else{
            $products = Products::getInfoByPriceDesc($products);
        }
        if(Yii::$app->request->get('search')) {
            $products = Products::getInfoBySearchText(Yii::$app->request->get('search'), $products);
        }
        if(Yii::$app->request->get('typeanimals')){
            $products = Products::findByTypeAnimals(Yii::$app->request->get('typeanimals'), $products);
        }
        if(Yii::$app->request->get('producttype')){
            $products = Products::findByTypeProducts(Yii::$app->request->get('producttype'), $products);
        }
        if(Yii::$app->request->get('filterparams')){
            $products = Products::findByFilterParam(Yii::$app->request->get('filterparams'), $products);
        }
        $typeanimals = Typeanimals::getInfo();
        $typeproducts = Typeproduct::getInfo();
        $filterparams = Filterparam::getInfo();
        $filternames = Filtername::getInfo();
        if(Yii::$app->request->post('number')){
            $products->limit((int)Yii::$app->request->post('number'))->offset((int)Yii::$app->request->post('offset'));
            $products->groupBy('p.id');
            $products = $products->all();
            $htmltext = "";
            $productscount = (int)Yii::$app->request->post('productscount');
            $bugfixcount = (int)Yii::$app->request->post('productscount');
            foreach ($products as $product){
                if($bugfixcount % $productscount == 0){
                    $htmltext .= '<div style = "height: 581px;" class=“row”>';
                }
                $htmltext .= '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 product">';
                $htmltext .= '<img class = "heart" title = "Добавить в избранное" src="/images/heart2.png"/>';
                $htmltext .= '<img data-text = "' . $product->description . '" src="/images/vopros.jpg" title = "Описание товара" class = "vopros"/>';
                if($product->variation[0]->discount != null){
                    $htmltext .= '<div class = "discount">Скидка ' . $product->variation[0]->discount . ' ₽</div>';
                }else{
                    $htmltext .= '<div class = "discount" style = "display: none"></div>';
                }
                if($product->variation[0]->img != null){
                    $htmltext .= '<img src="/images/products/' . $product->variation[0]->img . '" class = "productimage"/>';
                } else{
                    $htmltext .= '<img src="/images/products/noimage.jpg" class = "productimage"/>';
                }
                $htmltext .= '<p class = "productname">' . $product->name . '</p>';
                $htmltext .= '<div class = "variationsblock"style = "min-height: 30px;">';
                $count = true;
                foreach ($product->variation as $variation){
                    if($count == false){
                    $htmltext .= '<button data-variationid = "' . $variation->id . '" class = "buttontypeproduct" type = "button">' . $variation->name . '</button>';
                    }else{
                        $htmltext .= '<button data-variationid = "' . $variation->id . '" class = "buttontypeproductactive" type = "button">' . $variation->name . '</button>';
                    }
                    $count = false;
                }
                $htmltext .= '</div>';
                if($product->variation[0]->count != 0){
                 $htmltext .= '<div class = "contentYes" style = "display: block">';
                 $htmltext .= '<p style = "font-size: 14px;height: 40px;" class = "productshortdescription informationbyproduct"></p>';
                 $htmltext .= '<div style = "margin-top:12px; margin-bottom: 10px;padding-right: 7px;" class = "productshortdescription"><button class = "buttonminus buttoncountproduct" style = "margin-right: 10px;" type = "button"><img class="imgcountproduct" src="/images/iconminus.png"/></button><div class = "divcountproduct"><input type="text" value = "1" class="inputcountproduct"></div><button style = "margin-left: 10px;" class = "buttonplus buttoncountproduct" type = "button"><img class = "imgcountproduct imgcountproduct2" src="/images/iconplus.png"/></button></div>';
                 $htmltext .= '<p style = "font-size: 20px;" class = "productshortdescription priceproduct">' . ($product->variation[0]->price - $product->variation[0]->discount) . ' ₽</p>';
                 $htmltext .= '<input type="hidden" id="variation" value = "' . $product->variation[0]->id . '">';
                 $htmltext .= '<button class = "knopkaproduct" type="submit">ДОБАВИТЬ В КОРЗИНУ</button>';
                 $htmltext .= '<p class = "buyclick"> Купить в один клик</p>';
                 $htmltext .='</div>';
                 $htmltext .= '<div class = "contentNo" style = "display: none">';
                 $htmltext .= '<p style = "font-size: 14px;height: 40px;" class = "productshortdescription informationbyproduct"></p>';
                 $htmltext .= '<div style = "font-size: 12px;height: 40px; color: #cf2727;" class = "productshortdescription">НЕТ В НАЛИЧИИ</div>';
                 $htmltext .= '<p style = "font-size: 20px;" class = "productshortdescription priceproduct">' . ($product->variation[0]->price - $product->variation[0]->discount) . ' ₽</p>';
                 $htmltext .= '<input type="hidden" id="variation" value = "' . $product->variation[0]->id . '">';
                 $htmltext .= '<button class = "knopkaproduct callme" type="submit">СООБЩИТЬ О НАЛИЧИИ</button>';
                 $htmltext .= '<p class = "buyclick"> </p>';
                 $htmltext .= '</div>';
                }else{ 
                 $htmltext .= '<div class = "contentYes" style = "display: none">';
                 $htmltext .= '<p style = "font-size: 14px;height: 40px;" class = "productshortdescription informationbyproduct"></p>';
                 $htmltext .= '<div style = "margin-top:12px; margin-bottom: 10px;padding-right: 7px;" class = "productshortdescription"><button class = "buttoncountproduct buttonminus" type = "button"><img class="imgcountproduct" src="/images/iconminus.png"/></button><div class = "divcountproduct"><p style="display: inline">0</p></div><button class = "buttoncountproduct buttonplus" type = "button"><img class = "imgcountproduct imgcountproduct2" src="/images/iconplus.png"/></button></div>';
                 $htmltext .= '<p style = "font-size: 20px;" class = "productshortdescription priceproduct">' . ($product->variation[0]->price - $product->variation[0]->discount) . ' ₽</p>';
                 $htmltext .= '<input type="hidden" id="variation" value = "' . $product->variation[0]->id . '">';
                 $htmltext .= '<button class = "knopkaproduct" type="submit">ДОБАВИТЬ В КОРЗИНУ</button>';
                 $htmltext .= '<p class = "buyclick"> Купить в один клик</p>';
                 $htmltext .='</div>';
                 $htmltext .= '<div class = "contentNo" style = "display: block">';
                 $htmltext .= '<p style = "font-size: 14px;height: 40px;" class = "productshortdescription informationbyproduct"></p>';
                 $htmltext .= '<div style = "font-size: 12px;height: 40px; color: #cf2727;" class = "productshortdescription">НЕТ В НАЛИЧИИ</div>';
                 $htmltext .= '<p style = "font-size: 20px;" class = "productshortdescription priceproduct">' . ($product->variation[0]->price - $product->variation[0]->discount) . ' ₽</p>';
                 $htmltext .= '<input type="hidden" id="variation" value = "' . $product->variation[0]->id . '">';
                 $htmltext .= '<button class = "knopkaproduct callme" type="submit">ЗАКАЗАТЬ ТОВАР</button>';
                 $htmltext .= '<p class = "buyclick"> </p>';
                 $htmltext .= '</div>';
                }
            $htmltext .='</div>';
            $bugfixcount +=1;
            if($bugfixcount % $productscount == 0){
                $htmltext .= '</div>';
            }
            } 
        return $htmltext;
        }else{
            $products->limit(9)->offset(0);
        }
        if(yii::$app->request->post('variationid')){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return Variation::getInfo2(yii::$app->request->post('variationid'));
        }
        if(!Yii::$app->user->isGuest){
            $username = Yii::$app->user->identity->name . " " .  Yii::$app->user->identity->patronymic;
        }
        return $this->render('catalog',[
            'typeanimals' => $typeanimals,
            'typeproducts' => $typeproducts,
            'filternames' => $filternames,
            'filterparams' => $filterparams,
            'products' => $products->all(),
            'callme' => new Checkemail(),
            'buyoneclick' => new CheckBuyOneClickForm(),
            'username' => $username
        ]);
    }

    public function actionCallme()
    {
        if(yii::$app->request->post('Checkemail')){
            $check = new Checkemail();
            $check->attributes = Yii::$app->request->post('Checkemail');
            $variation = Variation::getInfo2(yii::$app->request->post('Checkemail')['variationid']);
            $check->sendEmail($variation);
            //$inform = new InformUser();
            //$inform->variation_id = yii::$app->request->post('Checkemail')['variationid'];
            //$inform->email = yii::$app->request->post('Checkemail')['email'];
            //$inform->save();
            return "ok";
        }
    }

    public function actionCallmevalidation()
    {
        $check = new Checkemail();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $check->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($check);
        }
    }
    public function actionBuyinoneclick()
    {
        if(yii::$app->request->post('CheckBuyOneClickForm')){
            $form = new CheckBuyOneClickForm();
            $form->attributes = Yii::$app->request->post('CheckBuyOneClickForm');
            $form->countproduct = Yii::$app->request->post('CheckBuyOneClickForm')["countproduct"];
            $variation = Variation::getInfo2(yii::$app->request->post('CheckBuyOneClickForm')['variationid']);
            $form->sendEmail($variation);
            return "ok";
        }
    }
    public function actionBuyinoneclickvalidation()
    {
        $form = new CheckBuyOneClickForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $form->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($form);
        }
    }
}
