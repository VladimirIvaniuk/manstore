<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 23.09.2017
 * Time: 23:48
 */

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\Category;
use app\models\OrderItems;
use app\models\Order;
use Yii;

class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
//        debug($id);
        $product = Product::findOne($id);
        if (empty($product)) return false;
//        debug($product);
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
//        debug($session['cart']);
//        debug($session['cart.qty']);
//        debug($session['cart.sum']);
        if(!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        //получаем id товара
        $id = Yii::$app->request->get('id');
        //открываем сессию
        $session = Yii::$app->session;
        $session->open();

        //создаем обьект модели Cart

        $cart = new Cart();
        $cart->recalc($id);

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
//        $this->layout = false;
        $this->setMeta('MAN STORE | ' . 'Корзина');
        $order=new Order();
        if($order->load(Yii::$app->request->post())){
            $order->qty=$session['cart.qty'];
            $order->sum=$session['cart.sum'];
            $user=$order->name;
            if($order->save()){
                //флеш сообщение
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят');

                //отправка письма клиенту
                Yii::$app->mailer->compose('order', compact('session', 'user'))
                ->setFrom(['ivanyuk85vladimir@gmail.com' => 'manstore.pro'])
                ->setTo($order->email)
                ->setSubject('Заказ')
                ->send();

                //отправка письма админу
                $admin=Yii::$app->params['adminEmail'];
//                debug($admin);
                Yii::$app->mailer->compose('order-admin', compact('session'))
                    ->setFrom(['ivanyuk85vladimir@gmail.com' => 'manstore.pro'])
                    ->setTo($admin)
                    ->setSubject('Заказ')
                    ->send();
                //очищаем корзину
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
            else{
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->render('view', compact('session', 'order'));
    }
    protected function saveOrderItems($items, $order_id){
        foreach ($items as $id=>$item){
            $order_items=new OrderItems();
            $order_items->order_id=$order_id;
            $order_items->product_id=$id;
            $order_items->name=$item['name'];
            $order_items->price=$item['price'];
            $order_items->qty_item=$item['qty'];
            $order_items->sum_item=$item['qty']*$item['price'];
            $order_items->save();
        }
    }
}