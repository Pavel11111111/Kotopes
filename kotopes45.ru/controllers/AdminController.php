<?php

namespace app\controllers;

use app\models\Informationdateslist;
use app\models\Informationtextlist;
use app\models\Delivery_date;
use app\models\InformUser;
use Imagine\Image\Box;
use app\models\Animals;
use app\models\Filtername;
use app\models\Filterparam;
use app\models\Filterproduct1;
use app\models\FilterProduct2;
use app\models\FilterProduct3;
use app\models\Products;
use app\models\ProductSearch;
use app\models\Typeanimals;
use app\models\Typeproduct;
use app\models\Variation;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Hots;
use app\models\NewHots;
use app\models\User;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\imagine\Image;

class AdminController extends Controller
{

    public $layout = '@app//views/admin/adminlayout.php';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['viewAdminPage']
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

    public function actionRestoreproduct()
    {
        $counts = Yii::$app->request->get('count');
        foreach(Yii::$app->request->get('product') as $key => $product){
            $variation = Variation::findOne($product);
            $variation->count += $counts[$key];
            $variation->save();
        }
        echo '<pre>';
        echo var_dump('Всё зер гуд!');
        die('</pre>');
    }
    public function actionNewvariaton()
    {
        $products = new Products();
        $products->name = Yii::$app->request->post('productname');
        $products->description = Yii::$app->request->post('productdescription');
        $products->save();
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'productid',
            'value' => $products->id,
        ]));
        $url = Url::to(['admin/variation', 'productname' => Yii::$app->request->post('productname')]);
        return $this->redirect($url);
    }

    public function actionVariation()
    {
        $productname =  Yii::$app->request->get('productname');
        if ($products_variations = Yii::$app->request->post('Product')) {
            $files = $_FILES;
            foreach ($products_variations as $key => $variation) {
                if($variation['name'] != null) {
                    $model = new Variation();
                    $model->productid = Yii::$app->request->cookies->getValue('productid');
                    $model->name = $variation['name'];
                    if($_FILES['Product']['tmp_name'][$key]["image"] != null) {
                        $randomName = md5(microtime() . rand(0, 9999));
                        if($_FILES['Product']['type'][$key]['image'] == "image/png"){
                            $fileextension = ".png";
                        }else{
                            $fileextension = ".jpg";
                        }
                        @copy($_FILES['Product']['tmp_name'][$key]["image"], 'images/products/' . $randomName . $fileextension);
                        $photo = Image::getImagine()->open('images/products/'. $randomName . $fileextension);
                        $photo->thumbnail(new Box(600, 600))->save('images/products/' .$randomName . $fileextension, ['quality' => 100]);
                        $model->img = $randomName . $fileextension;
                    }
                    $model->price = (int)$variation['price'];
                    if($variation['sale'] != null) {
                        $model->discount = (int)$variation['sale'];
                    }
                    if($variation['count'] != null) {
                        $model->count = (int)$variation['count'];
                    }
                    $model->save();
                    if($variation['place'] != null){
                        $model->place = $variation['place'];
                        $model->save();
                    }else{
                        $model->place = $model->id;
                        $model->save();
                    }
                }
            }
            $url = Url::to(['admin/filtersproduct', 'productname' => Yii::$app->request->get('productname')]);
            return $this->redirect($url);
        }

        return $this->render('newvariation',[
            'productname' => $productname,
        ]);
    }

    public function actionNewfilters(){
        $productid = Yii::$app->request->cookies->getValue('productid');
        if(Yii::$app->request->post('level1') != null){
            $levels1 = Yii::$app->request->post('level1');
            foreach ($levels1 as $level1) {
                $filter1 = new Filterproduct1();
                $filter1->productid = $productid;
                $filter1->typeanimalsid = Typeanimals::findByName($level1)->id;
                $filter1->save();
            }
        }
        if(Yii::$app->request->post('level2') != null){
            $levels2 = Yii::$app->request->post('level2');
            foreach ($levels2 as $level2) {
                $filter2 = new FilterProduct2();
                $filter2->productid = $productid;
                $filter2->typeproductid = (int) $level2;
                $filter2->save();
            }
        }
        if(Yii::$app->request->post('level3') != null){
            $levels3 = Yii::$app->request->post('level3');
            foreach ($levels3 as $level3) {
                $filter3 = new FilterProduct3();
                $filter3->productid = $productid;
                $filter3->filterparamid = (int) $level3;
                $filter3->save();
            }
        }
        Yii::$app->session->setFlash('success', 'Товар добавлен!');
        return $this->redirect(Url::to(['admin/product']));
    }

    public function actionChoicefilter(){
        if(Yii::$app->request->post('filter') == 1) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return Typeproduct::findByTypeAnimalsName(Yii::$app->request->post('value'));
        }
        if(Yii::$app->request->post('filter') == 2){
            $arraynames2 = array();
            array_push($arraynames2, Typeproduct::findById(Yii::$app->request->post('value'))->typeanimalsname);
            array_push($arraynames2, Typeproduct::findById(Yii::$app->request->post('value'))->typeanimalsname . ' -> ' . Typeproduct::findById(Yii::$app->request->post('value'))->name);
            $arrayparams2 = array();
            $arraynames = Filtername::findById2(Yii::$app->request->post('value'));
            foreach ($arraynames as $arrayname) {
                $arrayparams = Filterparam::findById2($arrayname->id);
                foreach ($arrayparams as $arrayparam) {
                    $arrayparams3 = array();
                    array_push($arrayparams3, $arrayparam->id);
                    array_push($arrayparams3, $arrayparam->name);
                    array_push($arrayparams2, $arrayparams3);
                }
                array_push($arraynames2, array($arrayname->name => $arrayparams2));
                $arrayparams2 = array();
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $arraynames2;
        }
    }

    public function actionChoicefilterreadypage(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $product = Products::findById(Yii::$app->request->post('productid'));
        if(Yii::$app->request->post('filter') == 1) {
            $arraytypeanimals = array();
            foreach (Yii::$app->request->post('value') as $typeanimal){
                $arrayproducts = array();
                $typeproducts = Typeproduct::findByTypeAnimalsName($typeanimal);
                foreach ($typeproducts as $typeproduct){ $count = false;
                    $include = array();
                    array_push($include, $typeproduct);
                    foreach ($product->typeproduct as $typeproduct2){
                        if($typeproduct["name"] == $typeproduct2->name){
                            $count = true;
                            array_push($include, $count);
                            break;
                        }
                    }
                    if($count == false){
                        array_push($include, $count);
                    }
                    array_push($arrayproducts,  $include);
                }
                array_push($arraytypeanimals, array($typeanimal => $arrayproducts));
            }
            return $arraytypeanimals;
        }
        if(Yii::$app->request->post('filter') == 2){
            $arraynames2 = array();
            foreach (Yii::$app->request->post('value') as $val) {
                array_push($arraynames2, Typeproduct::findById($val)->typeanimalsname);
                array_push($arraynames2, Typeproduct::findById($val)->typeanimalsname . ' -> ' . Typeproduct::findById($val)->name);
                $arrayparams2 = array();
                $arraynames = Filtername::findById2($val);
                foreach ($arraynames as $arrayname) {
                    $arrayparams = Filterparam::findById2($arrayname->id);
                    foreach ($arrayparams as $arrayparam) {
                        $arrayparams3 = array();
                        array_push($arrayparams3, $arrayparam->id);
                        array_push($arrayparams3, $arrayparam->name);
                        foreach ($product->filterparam as $filterparam){
                            if($arrayparam->name == $filterparam->name){
                                array_push($arrayparams3, true);
                                break;
                            }
                        }
                        array_push($arrayparams2, $arrayparams3);
                    }
                    array_push($arraynames2, array($arrayname->name => $arrayparams2));
                    $arrayparams2 = array();
                }
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $arraynames2;
        }
        if(Yii::$app->request->post('filter') == 2){
            $arraynames2 = array();
            array_push($arraynames2, Typeproduct::findById(Yii::$app->request->post('value'))->typeanimalsname);
            array_push($arraynames2, Typeproduct::findById(Yii::$app->request->post('value'))->typeanimalsname . ' -> ' . Typeproduct::findById(Yii::$app->request->post('value'))->name);
            $arrayparams2 = array();
            $arraynames = Filtername::findById2(Yii::$app->request->post('value'));
            foreach ($arraynames as $arrayname) {
                $arrayparams = Filterparam::findById2($arrayname->id);
                foreach ($arrayparams as $arrayparam) {
                    $arrayparams3 = array();
                    array_push($arrayparams3, $arrayparam->id);
                    array_push($arrayparams3, $arrayparam->name);
                    array_push($arrayparams2, $arrayparams3);
                }
                array_push($arraynames2, array($arrayname->name => $arrayparams2));
                $arrayparams2 = array();
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $arraynames2;
        }
    }

    public function actionFiltersproduct(){
        $productname = Yii::$app->request->get('productname');
        return $this->render('newfilters',[
            'typeanimals' => Typeanimals::getInfo(),
            'productname' => $productname,
        ]);
    }

    public function actionChangefilters($productid)
    {
        return $this->render('changefilters', [
            'typeanimals' => Typeanimals::getInfo(),
            'product' => Products::findById($productid),
            'typeproudcts' => Typeproduct::getInfo()
        ]);
    }

    public function actionChangefilter()
    {
        $productid = Yii::$app->request->post('productid');
        $product = Products::findById(Yii::$app->request->post('productid'));
        foreach ($product->typeanimals as $typeanimal){
            $changes = false;
            foreach ( Yii::$app->request->post('level1') as $level1){
                if($typeanimal->name == $level1){
                    $changes = true;
                    break;
                }
            }
            if($changes == false){
                Filterproduct1::findByTypeAnimalsId($typeanimal->id, $productid)->delete();
            }
        }
        //нам пришел список из выбранных уровней, перебираем
        foreach (Yii::$app->request->post('level1') as $level1){
            $changes = false;
            //перебираем уровни для этого продукта
            foreach ($product->typeanimals as $typeanimal){
                //если совпали
                if($typeanimal->name == $level1){
                    $changes = true;
                }
            }
            //если совпадений нет
            if($changes == false){
                $filter1 = new Filterproduct1();
                $filter1->productid = $productid;
                $filter1->typeanimalsid = Typeanimals::findByName($level1)->id;
                $filter1->save();
            }
        }

        foreach ($product->typeproduct as $typeproduct){
            $changes = false;
            foreach ( Yii::$app->request->post('level2') as $level2){
                if($typeproduct->id == $level2){
                    $changes = true;
                    break;
                }
            }
            if($changes == false){
                Filterproduct2::findByTypeAnimalsId($typeproduct->id, $productid)->delete();
            }
        }
        foreach (Yii::$app->request->post('level2') as $level2){
            $changes = false;
            //перебираем уровни для этого продукта
            foreach ($product->typeproduct as $typeproduct){
                //если совпали
                if($typeproduct->id == $level2){
                    $changes = true;
                }
            }
            //если совпадений нет
            if($changes == false){
                $filter2 = new Filterproduct2();
                $filter2->productid = $productid;
                $filter2->typeproductid = $level2;
                $filter2->save();
            }
        }

        foreach ($product->filterparam as $filterparam){
            $changes = false;
            foreach ( Yii::$app->request->post('level3') as $level3){
                if($filterparam->id == $level3){
                    $changes = true;
                    break;
                }
            }
            if($changes == false){
                Filterproduct3::findByFilterParamId($filterparam->id, $productid)->delete();
            }
        }
        foreach (Yii::$app->request->post('level3') as $level3){
            $changes = false;
            //перебираем уровни для этого продукта
            foreach ($product->filterparam as $filterparam){
                //если совпали
                if($filterparam->id == $level3){
                    $changes = true;
                }
            }
            //если совпадений нет
            if($changes == false){
                $filter2 = new Filterproduct3();
                $filter2->productid = $productid;
                $filter2->filterparamid = $level3;
                $filter2->save();
            }
        }
       /* if(Yii::$app->request->post('level2') != null){
            $levels2 = Yii::$app->request->post('level2');
            foreach ($levels2 as $level2) {
                $filter2 = new Filterproduct2();
                $filter2->productid = $productid;
                $filter2->typeproductid = (int) $level2;
                $filter2->save();
            }
        }
        if(Yii::$app->request->post('level3') != null){
            $levels3 = Yii::$app->request->post('level3');
            foreach ($levels3 as $level3) {
                $filter3 = new Filterproduct3();
                $filter3->productid = $productid;
                $filter3->filterparamid = (int) $level3;
                $filter3->save();
            }
        }*/
        Yii::$app->session->setFlash('success', 'Товар добавлен!');
        return $this->redirect(Url::to(['admin/product']));
    }

    public function actionCheckrecordanimals()
    {
        $animal = Animals::findById(Yii::$app->request->post('id'));
        $animal->checkrecord = 1;
        $animal->save();
        return $this->redirect('http://kotopes45.ru/admin/animals');
    }

    public function actionNewbanner()
    {
        $banner = new NewHots();
        $banner->load(Yii::$app->request->post());
        $banner->gltextcolor = Yii::$app->request->post()["NewHots"]['gltextcolor'];
        $banner->textcolor = Yii::$app->request->post()["NewHots"]['textcolor'];
        $banner->img = UploadedFile::getInstance($banner, 'img');
        $randomName = Yii::$app->security->generateRandomString();
        $randomName = $banner->upload($randomName);
        $fileName = $randomName . '.' . $banner->img->extension;
        $dir = 'images/' . $fileName;
        $banner->img = $fileName;
        $photo = Image::getImagine()->open($dir);
        $photo->resize(new Box(1600, 555))->save($dir, ['quality' => 100]);
        $banner->setRecord($fileName);
        return $this->redirect('http://kotopes45.ru/admin/banners');
    }

    public function actionChangebanner()
    {
        $newbanner = new NewHots();
        $banner = Hots::findById(Yii::$app->request->post()["NewHots"]["oldid"]);
        $banner->id = Yii::$app->request->post()["NewHots"]["id"];
        $banner->gltext = Yii::$app->request->post()["NewHots"]["gltext"];
        $banner->gltextcolor = Yii::$app->request->post()["NewHots"]["gltextcolor"];
        $banner->text = Yii::$app->request->post()["NewHots"]["text"];
        $banner->textcolor = Yii::$app->request->post()["NewHots"]["textcolor"];
        $banner->url = Yii::$app->request->post()["NewHots"]["url"];
        if(UploadedFile::getInstance($newbanner, 'img') != null){
            if(file_exists ('images/' . $banner->img)){
                unlink('images/' . $banner->img);
            }
            $newbanner->img = UploadedFile::getInstance($newbanner, 'img');
            $randomName = Yii::$app->security->generateRandomString();
            $randomName = $newbanner->upload($randomName);
            $fileName = $randomName . '.' . $newbanner->img->extension;
            $dir = 'images/' . $fileName;
            $banner->img = $fileName;
            $photo = Image::getImagine()->open($dir);
            $photo->resize(new Box(1600, 555))->save($dir, ['quality' => 100]);
        }
        $banner->save();
        return $this->redirect('http://kotopes45.ru/admin/banners');
    }

    public function actionDeletebanner()
    {
        $banner = Hots::findById(Yii::$app->request->post('id'));
         if(file_exists ('images/' . $banner->img)){
            unlink('images/' . $banner->img);
        }
        $banner->delete();
        return $this->redirect('http://kotopes45.ru/admin/banners');
    }

    public function actionDeleteanimals()
    {
        $animal = Animals::findById(Yii::$app->request->post('id'));
         if(file_exists ('images/animals/' . $animal->img)){
                unlink('images/animals/' . $animal->img);
        }
        $animal->delete();
        return $this->redirect('http://kotopes45.ru/admin/animals');
    }

    public function actionBanuser()
    {
        $auth = Yii::$app->authManager;
        $banned = $auth->getRole('banned');
        if(Yii::$app->request->post('info') == 0) {
           $auth->assign($banned, Yii::$app->request->post('id'));
        }else{
           $auth->revoke($banned, Yii::$app->request->post('id'));
       }
        return $this->redirect('http://kotopes45.ru/admin/users');
    }

    public function actionNewfilterlevelone()
    {
        $obj = new Typeanimals();
        $obj->name = Yii::$app->request->post('value');
        $obj->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionNewfilterleveltwo()
    {
        $obj = new Typeproduct();
        $obj->name = Yii::$app->request->post('value');
        $obj->typeanimalsname = Typeanimals::findById(Yii::$app->request->post('value2'))->name;
        $obj->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionNewfilterleveltree()
    {
        $obj = new Filtername();
        $obj->name = Yii::$app->request->post('value');
        if(Yii::$app->request->post('value') == null){
            $obj->name = "";
        }
        $obj->typeproductid = Typeproduct::findById(Yii::$app->request->post('value2'))->id;
        $obj->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionNewfilterleveltree2()
    {
        $obj = new Filterparam();
        $obj->name = Yii::$app->request->post('value');
        $obj->filternameid = Yii::$app->request->post('value2');
        $obj->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionChangefilterlevelone()
    {
        $filter = Typeanimals::findById(Yii::$app->request->post('id'));
        $filter->name = Yii::$app->request->post('value');
        $filter->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionChangefilterleveltwo()
    {
        $filter = Typeproduct::findById(Yii::$app->request->post('id'));
        $filter->name = Yii::$app->request->post('value');
        if(Yii::$app->request->post('value2') != "0") {
            $filter->typeanimalsname = Typeanimals::findById(Yii::$app->request->post('value2'))->name;
        }
        $filter->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionChangefilterleveltree()
    {
        $filter = Filtername::findById(Yii::$app->request->post('id'));
        $filter->name = Yii::$app->request->post('value');
        if(Yii::$app->request->post('value2') != "0") {
            $filter->typeproductid = Typeproduct::findById(Yii::$app->request->post('value2'))->id;
        }
        $filter->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionChangefilterleveltree2()
    {
        $filter = Filterparam::findById(Yii::$app->request->post('id'));
        $filter->name = Yii::$app->request->post('value');
        if(Yii::$app->request->post('value2') != "0") {
            $filter->filternameid = Yii::$app->request->post('value2');
        }
        $filter->save();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionDeletefilterlevelone()
    {
        Typeanimals::findById(Yii::$app->request->post('id'))->delete();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionDeletefilterleveltwo()
    {
        Typeproduct::findById(Yii::$app->request->post('id'))->delete();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionDeletefilterleveltree()
    {
        Filtername::findById(Yii::$app->request->post('id'))->delete();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionDeletefilterleveltree2()
    {
        Filterparam::findById(Yii::$app->request->post('id'))->delete();
        return $this->redirect('http://kotopes45.ru/admin/filters');
    }

    public function actionAdminpage()
    {
        return $this->render('adminpage');
    }

    public function actionBanners()
    {
        return $this->render('banners',[
            'banners' => Hots::getInfo(),
            'newbanner' => new NewHots(),
        ]);
    }


    public function actionUsers()
    {
        return $this->render('users',[
            'users' => User::getUsers(),
        ]);
    }

    public function actionAnimals()
    {
        return $this->render('animals',[
            'animalsinfo' => Animals::getInfo3(),
            'animalsinfo2' => Animals::getInfo4(),
        ]);
    }

    public function actionFilters()
    {
        return $this->render('filters', [
                'levelones' => Typeanimals::getInfo(),
                'leveltwos' => Typeproduct::getInfo(),
                'leveltrees' => Filtername::getInfo(),
                'leveltrees2' => Filterparam::getInfo()
            ]);
    }

    public function actionProduct()
    {
        /*$th = Filterproduct1::find();
        echo '<pre>';
        echo var_dump(Typeanimals::getTypeAnimalsWithoutProduct());
        die('</pre>');*/
        /*$ht = Products::findById(25);
        echo '<pre>';
        echo var_dump($ht->typeanimals);
        die('</pre>');*/
        if ($products_variations = Yii::$app->request->post('Product')) {
                $product = Products::findById($products_variations[2]["value"]);
                $product->name = $products_variations[0]["value"];
                $product->description = $products_variations[1]["value"];
                $product->save();
            return "good";
        }

        if(Yii::$app->request->post('deleteproduct')){
            $variations = Variation::getInfo(Yii::$app->request->post('deleteproduct'));
            foreach($variations as $variation){
                if($variation->img != null){
                    if(file_exists ('images/products/' . $variation->img)){
                        unlink('images/products/' . $variation->img);
                    }
                }
            }
            Products::findById(Yii::$app->request->post('deleteproduct'))->delete();
            /*$filterproducts1 = Filterproduct1::findByProductId(Yii::$app->request->post('deleteproduct'));
            foreach($filterproducts1 as $filterproduct1){
                $filterproduct1->delete();
            }
            $filterproducts2 = Filterproduct2::findByProductId(Yii::$app->request->post('deleteproduct'));
            foreach($filterproducts2 as $filterproduct2){
                $filterproduct2->delete();
            }
            $filterproducts3 = Filterproduct3::findByProductId(Yii::$app->request->post('deleteproduct'));
            foreach($filterproducts3 as $filterproduct3){
                $filterproduct3->delete();
            }*/
            Yii::$app->session->setFlash('success', 'Товар удалён!');
            return $this->refresh();
        }
        return $this->render('products', [
            'products' => Products::getInfo()
        ]);
    }

    public function actionChangevariation($productid)
    {
        if ($products_variations = Yii::$app->request->post('Product')) {
            $files = $_FILES;
            foreach ($products_variations as $key => $variation) {
                if($variation['name'] != null) {
                    if($variation['hidden'] != null) {
                        $model = Variation::getInfo2($variation['hidden']);
                        if($_FILES['Product']['tmp_name'][$key]["image"] != null || $variation['deleteimage'] == 'delete') {
                            if($model->img != null){
                                if(file_exists ('images/products/' . $model->img)){
                                    unlink('images/products/' . $model->img);
                                }
                                $model->img = null;
                            }
                        }
                    }
                    else{
                        $model = new Variation();
                    }
                    if($_FILES['Product']['tmp_name'][$key]["image"] != null) {
                        $randomName = md5(microtime() . rand(0, 9999));
                        if($_FILES['Product']['type'][$key]['image'] == "image/png"){
                            $fileextension = ".png";
                        }else{
                            $fileextension = ".jpg";
                        }
                        @copy($_FILES['Product']['tmp_name'][$key]["image"], 'images/products/' . $randomName . $fileextension);
                        $photo = Image::getImagine()->open('images/products/' . $randomName . $fileextension);
                        $photo->thumbnail(new Box(600, 600))->save('images/products/' .$randomName . $fileextension, ['quality' => 100]);
                        $model->img = $randomName . $fileextension;
                    }
                    $model->productid = Yii::$app->request->get('productid');
                    $model->name = $variation['name'];
                    $model->price = (int)$variation['price'];
                    if($variation['sale'] != null) {
                        $model->discount = (int)$variation['sale'];
                    }
                    if($variation['count'] != null) {
                        /*if($model->count == 0 && $variation['count'] != 0){
                            $emails = InformUser::getByVariationId($model->id);
                            $text = "Доброго времени суток, уважаемый клиент! Вы просили уведомить вас, когда товар' " . $model->product["name"] . " 'появится у нас на складе. Теперь товар в наличии, и вы можете купить его через наш интернет-магазин! http://kotopes45.ru/Catalog";
                            foreach($emails as $email) {
                                Yii::$app->mailer->compose()
                                    ->setFrom('noreplicate146@gmail.com')
                                    ->setTo($email["email"])
                                    ->setSubject('Уведомление о товаре')
                                    ->setTextBody($text)
                                    ->setHtmlBody(
                                        '<p style="font-weight: bold;font-size:20px;line-height: 24px;color: #000000;font-family: Helvetica, Arial, Verdana;margin:0 0 32px 0;padding:0;">Уведомление от сайта Котопёс</p>' .
                                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0 0 18px 0;word-wrap: break-word;word-break:normal;">Уважаемый клиент!</p>' .
                                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы просили уведомить вас, когда товар "' . $model->product["name"] . '" появится у нас на складе. Теперь товар в наличии, и вы можете купить его через наш интернет-магазин!</p><br>' .
                                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/Catalog" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">ПЕРЕЙТИ В КАТАЛОГ</b></a> </p><br><br>' .
                                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Если кнопка в верхней части экрана не работает, скопируйте указанный ниже адрес и вставьте его в новом окне браузера.</p>' .
                                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:12px;line-height: 15px;color: #1428a0;padding:13px 16px 11px 16px;margin:6px 0 21px 0;background: #eef0f9;word-break:break-all;"><a href="' . Url::to(['site/catalog']) . '" style="text-decoration: none;color: #1428a0;font-size:12px;line-height:15px;color: #1428a0;font-weight: normal;font-family: Helvetica, Arial, Verdana;word-wrap: break-word;word-break:break-all;">http://kotopes45.ru/Catalog</a></p><br><br>' .
                                        '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;"><b>Вы не пользовались этой функцией на сайте Котопёс?</b><br>Другой пользователь мог ввести неправильный адрес электронной почты по ошибке. В таком случае просто проигнорируйте это сообщение.</p>'
                                    )
                                    ->send();
                            }
                        }*/
                        $model->count = (int)$variation['count'];
                    }
                    if($variation['place'] != null){
                        $model->place = (int)$variation['place'];
                    }else{
                        $model->save();
                        $model->place = $model->id;
                    }
                    $model->save();
                }
            }
            return $this->redirect(Url::to(['admin/product']));
        }
        return $this->render('changevariation', [
            'product' => Products::findById($productid)->name,
            'variations' => Variation::getInfo($productid)
        ]);
    }

    public function actionDeletevariation()
    {
        $variation = Variation::getInfo2(Yii::$app->request->post('variationid'));
        if($variation->img != null){
            if(file_exists ('images/products/' . $variation->img)){
                unlink('images/products/' . $variation->img);
            }
        }
        $variation->delete();
    }

    public function actionTimes()
    {
        return $this->render('times', [
            'dates' => Delivery_date::GetInfo()
        ]);
    }
    
    public function actionTimescontrol()
    {
        $time = Delivery_date::findOne(Yii::$app->request->get('timeid'));
        if($time != null){
            $time->status = Yii::$app->request->get('timestatus');
            $time->save();
            return "OK";
        }else{
            return "ОШИБКА!!!!!!!!";
        }
    }
    
    public function actionNews()
    {
        if(yii::$app->request->post('Informationdateslist')){
            $informationdate = new Informationdateslist();
            $informationdate->attributes = yii::$app->request->post('Informationdateslist');
            $informationdate->save();
            return $this->redirect(Url::to(['admin/newstext', 'dateid' => $informationdate->id]));
        }
        return $this->render('news', [
            'informationdate' => new Informationdateslist(),
            'informationdatelist' => Informationdateslist::getInfo(),
            'news' => Informationdateslist::getInfo()
        ]);
    }
    
    public function actionNewstext($dateid)
    {
        if ($text_list = Yii::$app->request->post('Informationtextlist')) {
            foreach ($text_list as $key => $text) {
                if($text['id'] == 0){
                    $model = new Informationtextlist;
                    if($text['text'] != ""){
                        $model->text = $text['text'];
                    }
                    $model->link = $text['link'];
                    $model->informationdateslist_id = $dateid;
                    $model->save();
                }else{
                    $model = Informationtextlist::findOne($text['id']);
                    $model->text = $text['text'];
                    $model->link = $text['link'];
                    $model->save();
                }
            }
            return $this->redirect(Url::to(['admin/news']));
        }
        $date = Informationdateslist::findOne($dateid);
        return $this->render('newstext', [
            'date' => $date
        ]);
    }
    
    public function actionChangenews()
    {
        $model = Informationdateslist::findOne(yii::$app->request->post('Informationdateslist')["id"]);
        $model->date = yii::$app->request->post('Informationdateslist')["date"];
        $model->save();
        Yii::$app->session->setFlash('success', 'Новость отредактирована!');
        return $this->redirect(Url::to(['admin/news']));
    }
    
    public function actionDeletenews()
    {
        Informationdateslist::findOne(yii::$app->request->post('newsid'))->delete();
        Yii::$app->session->setFlash('success', 'Новость удалена!');
        return $this->redirect(Url::to(['admin/news']));
    }
    
    public function actionDeletenewsproducts()
    {
        Informationtextlist::findOne(yii::$app->request->post('productid'))->delete();
    }
}
