<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 23.09.2017
 * Time: 13:14
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id)
    {
        //Получаем id товара
        //$id = Yii::$app->request->get('id');
        //ленивая загрузка
        $product = Product::findOne($id);
        if(empty($product)){
            throw new \yii\web\HttpException(404, 'Такого товара нет');
        }
        //жадная загрузка
        //$product=Product::find()->with('category')->where(['id'=>$id])->limit(1)->one();
        $hits = Product::find()->where(['hit' => '1'])->limit(5)->all();
        $this->setMeta('MAN STORE | ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product', 'hits'));
    }
}