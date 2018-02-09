<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 24.09.2017
 * Time: 0:53
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    public function addToCart($product, $qty = 1)
    {
        $mainImg=$product->getImage();
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $mainImg->getUrl('x50'),
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
    }

    public function recalc($id)
    {
        //проверяем существует ли в сесии такой элемент
        if (!isset($_SESSION['cart'][$id])) return false;
        //если существует
        $qtyMinus=$_SESSION['cart'][$id]['qty'];
        $sumMinus=$_SESSION['cart'][$id]['qty']*
            $_SESSION['cart'][$id]['price'];
        //пересчитываем итоговое кол-во
        $_SESSION['cart.qty']-=$qtyMinus;
        //пересчитываем итоговую сумму
        $_SESSION['cart.sum']-=$sumMinus;
        //удаляем текущий элемент
        unset($_SESSION['cart'][$id]);
    }


}