<?php
namespace app\models;

use yii\db\Query;
use yii\helpers\ArrayHelper;

class Products extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'products';
    }
    public static function getInfo()
    {
        return self::find()->orderBy(['id' => SORT_DESC])->all();
    }
    
    public static function getInfoBySearchText($searchtext, $products)
    {
        $productnames = explode(" ", $searchtext);
        $search = "";
        foreach ($productnames as $productname){
            $search .= '%' . $productname . '%';
        }
        return $products
            ->andWhere(['like', 'p.name', $search, false]);
    }
    public static function getInfo2()
    {
        return Products::find()
            ->select(['p.*'])
            ->from(['p' => 'products']);
    }
    public static function getInfoByPriceDesc($products)
    {
        return $products
            ->innerJoin(['v1' => 'variation'], ' p.id = v1.productid')
            ->leftJoin(['v2' => 'variation'], 'p.id = v2.productid AND v1.place > v2.place')
            ->andWhere(['v2.id' => null])
            ->orderBy(['v1.price' => SORT_DESC]);
    }

    public static function getInfoByPriceAsc($products)
    {
        return $products
            ->innerJoin(['v1' => 'variation'], ' p.id = v1.productid')
            ->leftJoin(['v2' => 'variation'], 'p.id = v2.productid AND v1.place > v2.place')
            ->andWhere(['v2.id' => null])
            ->orderBy(['v1.price' => SORT_ASC]);
    }

    public static function getInfoByPopular($products)
    {
        return $products->orderBy(['countbuy' => SORT_DESC]);
    }

    public static function getInfoByNameAsc($products)
    {
        return $products->orderBy(['name' => SORT_ASC]);
    }

    public static function getInfoByNameDesc($products)
    {
        return $products->orderBy(['name' => SORT_DESC]);
    }

    public static function findById($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    public static function findByTypeAnimals($typeanimalsname, $products){
        return $products->leftJoin(['filterproduct1'], 'p.id = filterproduct1.productid')->leftJoin(['typeanimals'], 'filterproduct1.typeanimalsid = typeanimals.id')->andWhere(['typeanimals.name' =>$typeanimalsname]);
    }

    public static function findByTypeProducts($typeproductname, $products){
        return $products->leftJoin(['filterproduct2'], 'p.id = filterproduct2.productid')->leftJoin(['typeproduct'], 'filterproduct2.typeproductid = typeproduct.id')->andWhere(['typeproduct.name' =>$typeproductname]);
    }

    public static function findByFilterParam($filterparamname, $products){
        $count = 1;
        foreach ($filterparamname as $filtername) {
            $products =  $products->leftJoin(['filterproduct3 fp'. $count], 'fp'. $count .'.productid = p.id');
            $filters = "";
            $filternamemass = explode("|", $filtername);
            $filters .= "f".$count.".name ="."'" . $filternamemass[0] . "'";
            unset($filternamemass[0]);
            foreach($filternamemass as $filternamemas){
                $filters .= " OR f".$count.".name ="."'". $filternamemas."'";
            }
            $products =  $products
                ->leftJoin(['filterparam f' . $count], "f".$count.".id = fp". $count .".filterparamid AND (" . $filters . ")")
                ->andWhere(['not', ['f'.$count.'.name' => null]]);
            $count++;
        }
        return $products;
            //->leftJoin(['filterparam f1'], "filterproduct3.filterparamid = f1.id AND (f1.name = 'Purina' OR 'Pro Plan')")
            //->leftJoin(['filterparam f2'], "filterproduct3.filterparamid = f2.id AND (f2.name = 'Стерилизованные / кастрированные')")
            //->andWhere(['not', ['f2.name' => null]]);
       /* $i = 0;
        $query = self::find();
        $query->joinWith('filterparam');
        foreach ($filterparamname as $filtername) {
            /*$query->innerJoinWith(["filterparam fl$i" => function ($q) use ($i, $filtername) {
                $q->onCondition(["fl$i.name" => $filtername]);
            }]);
            $i++;*
            $query->andWhere(['filterparam.name' =>$filtername]);
        }*/
    }

    public function getTypeanimals()
    {
        return self::hasMany(Typeanimals::className(), ['id' => 'typeanimalsid'])
            ->viaTable('filterproduct1', ['productid' => 'id']);
    }

    public function getTypeproduct()
    {
        return self::hasMany(Typeproduct::className(), ['id' => 'typeproductid'])
            ->viaTable('filterproduct2', ['productid' => 'id']);
    }

    public function getFilterparam()
    {
        return self::hasMany(Filterparam::className(), ['id' => 'filterparamid'])
            ->viaTable('filterproduct3', ['productid' => 'id']);
    }

    public function getVariation()
    {
        return self::hasMany(Variation::className(), ['productid' => 'id'])->orderBy(['place' => SORT_ASC]);
    }
}