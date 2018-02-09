<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Категории</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                    </ul>
                    <div class="shipping text-center"><!--shipping-->
                        <img src="/images/home/banner.jpg" alt=""/>
                    </div><!--/shipping-->

                </div>
            </div>

            <?php
            $mainImg = $product->getImage();
            $gallery = $product->getImages();
            ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <a href="#" data-toggle="modal" data-target="#myModal"><?= Html::img($mainImg->getUrl('328x420'), ['alt' => $product->name]) ?></a>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><?=$product->name?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <?= Html::img($mainImg->getUrl('358x450'), ['alt' => $product->name]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($product->new): ?>
                            <?= Html::img("@web/images/home/new2.png", ['alt' => 'Новинка', 'class' => 'newarrival']) ?>
                        <?php endif ?>
                        <?php if ($product->sale): ?>
                            <?= Html::img("@web/images/home/sale3.png", ['alt' => 'Распродажа', 'class' => 'newarrival']) ?>
                        <?php endif ?>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
<?php $count = count($gallery); $i=0; foreach($gallery as $img): ?>
    <?php if($i%3==0):?>
            <div class="item <?php if($i==0) echo 'active'?>">

    <?php endif; ?>
                <a href="#"><?= Html::img($img->getUrl('84x85'), ['alt' => $product->name]) ?></a>
    <?php $i++; if($i % 3 == 0|| $i == $count):?>
            </div>
    <?php endif; ?>
<?php endforeach;?>
                            </div>
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->

                            <h2><?= $product->name ?></h2>
                            <p>Web ID: 1089772</p>
                            <img src="/images/product-details/rating.png" alt=""/>
                            <span>
									<span><?= $product->price ?> грн</span>
									<label>Quantity:</label>
									<input type="text" value="1" id="qty"/>
									<a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>"
                                       data-id="<?= $product->id ?>"
                                       class="btn btn-fefault add-to-cart cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Добавить в корзину
                                    </a>
								</span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Категория:</b> <a
                                        href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->id]) ?>"><?= $product->category->name ?></a>
                            </p>
                            <a href=""><img src="/images/product-details/share.png" class="share img-responsive"
                                            alt=""/></a>

                        </div>
                        <!--/product-information-->
                    </div>

                </div><!--/product-details-->
                <div class="jumbotron">
                    <?= $product->content ?>
                </div>

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">Популярные товары</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($hits);
                            $i = 0;
                            foreach ($hits as $hit): ?>
                                <?php $mainImg = $hit->getImage();?>
                                <?php if ($i % 3 == 0): ?>
                                    <div class="item <?php if ($i == 0) echo 'active' ?>">
                                <?php endif; ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">

                                                <?= Html::img($mainImg->getUrl('340x320'), ['alt' => $product->name]) ?>
<!--                                                --><?//= Html::img("@web/images/products/{$hit->img}", ['alt' => $hit->name]) ?>
                                                <h2><?= $hit->price ?> грн</h2>
                                                <p>
                                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id]) ?>"><?= $hit->name ?></a>
                                                </p>
                                                <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                   class="btn btn-default add-to-cart" data-id="<?= $hit->id ?>"><i
                                                            class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++;
                                if ($i % 3 == 0 || $i == $count): ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>