<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 19.09.2017
 * Time: 18:35
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        //debug($hits);
        $this->setMeta('MAN STORE');
        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        //Получаем id категории
        //$id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if(empty($category)){
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }
//        debug($id);
        //$products=Product::find()->where(['category_id'=>$id])->all();
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('MAN STORE | ' . $category->name, $category->keywords, $category->description);
        return $this->render('view', compact('products', 'pages', 'category'));
    }

    public function actionSearch(){
        //Для безопастности ввода обрезаем пробелы
        $q=trim(Yii::$app->request->get('q'));
        $this->setMeta('MAN STORE | Поиск: ' . $q);
        if(!$q){
            return $this->render('search');
        }

        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('search', compact('products', 'pages','q'));
    }
}