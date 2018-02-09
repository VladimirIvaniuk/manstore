<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 19.09.2017
 * Time: 18:37
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{
    //задаем название страници и метатеги
    protected function setMeta($title=null, $keywords=null, $description=null){
        $this->view->title=$title;
        $this->view->registerMetaTag(['name'=>'keywords', 'content'=>"$keywords"]);
        $this->view->registerMetaTag(['name'=>'description', 'content'=>"$description"]);
    }
}