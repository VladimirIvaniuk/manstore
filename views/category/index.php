<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<div id="carousel-example-generic" class="carousel slide container man" data-ride="carousel">
    <div class="row">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="images/home/slider_1.jpg" alt="...">
        </div>

        <div class="item">
            <img src="images/home/slider_2.jpg"  alt="...">

        </div>
        <div class="item">
            <img src="images/home/slider_3.jpg" alt="...">
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Категории</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget(['tpl' => 'menu'])?>
                    </ul>
                    <!--банер-->
                    <div class="shipping text-center">
                        <img src="images/home/banner.jpg" alt="" />
                    </div>
                    <!--/банер-->

                </div>
            </div>
            <?php

            ?>
<!--            --><?php //debug(Yii::$app->user->identity)?>
            <div class="col-sm-9 padding-right">
                <?php if( !empty($hits) ): ?>
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Популярные товары</h2>
                        <?php $i=0;foreach($hits as $hit): ?>
                            <?php $mainImg = $hit->getImage();?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img($mainImg->getUrl(), ['alt' => $product->name]) ?>
                                            <h2><?= $hit->price?> грн</h2>
                                            <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id]) ?>"><?= $hit->name?></a></p>
                                            <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $hit->id])?>" data-id="<?= $hit->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                        </div>
                                        <?php if($hit->new): ?>
                                            <?= Html::img("@web/images/home/new2.png", ['alt' => 'Новинка', 'class' => 'new'])?>
                                        <?php endif?>
                                        <?php if($hit->sale): ?>
                                            <?= Html::img("@web/images/home/sale3.png", ['alt' => 'Распродажа', 'class' => 'new'])?>
                                        <?php endif?>
                                    </div>
                                </div>
                            </div>
                            <?php $i++?>
                            <?php if($i % 3 == 0): ?>
                                <div class="clearfix"></div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div><!--features_items-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>