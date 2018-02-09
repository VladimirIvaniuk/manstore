<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 17.09.2017
 * Time: 22:25
 */
namespace app\components;


use function Composer\Autoload\includeFile;
use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget
{
    public $tpl;
    public $data;//хроняться все записи категорий из базы данных
    public $tree;//
    public $menuHtml;
    public $model;
    public function init()
    {
        parent::init();
        if($this->tpl===null){
            $this->tpl='menu';
        }
        $this->tpl .='.php';
    }

    public function run(){
        //get cache
        if($this->tpl=='menu.php'){
            $meny=Yii::$app->cache->get('menu');
            if($meny) return $meny;
        }

        $this->data=Category::find()->indexBy('id')->asArray()->all();
        $this->tree=$this->getTree();
        $this->menuHtml=$this->getMenuHtml($this->tree);
        //debug($this->tree);
        //set cache
        if($this->tpl=='menu.php') {
            Yii::$app->cache->set('menu', $this->menuHtml, 60);
        }
        return $this->menuHtml;

    }
    public function getTree()//функция построения дерева, для категорий
    {
        $tree=[];
        foreach ($this->data as $id=>&$node){
            if(!$node['parent_id']){
                $tree[$id]=&$node;
            }
            else
                $this->data[$node['parent_id']]['childs'][$node['id']]=&$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab=''){
        $str='';
        foreach ($tree as $category){
            $str .=$this->catToTemplate($category, $tab);
        }
        return $str;
    }
    protected function catToTemplate($category, $tab){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}