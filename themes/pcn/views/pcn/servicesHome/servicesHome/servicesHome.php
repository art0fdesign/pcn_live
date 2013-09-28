<?php
$imgUrl = Yii::app()->theme->getBaseUrl() . '/img';
?>
<div class="homeBlock">
    <h1 class="title" style="border-bottom:3px solid #099bca;">Services</h1>
    <div class="carousel_line">
        <div id='carousel_inner'>
            <ul id='carousel_ul'>
<?php foreach( $models as $model ): ?> 
                <li class="services <?php echo $model->html_content?>">                
                    <a href="<?php echo $servicesUrl?>" class="">
                        <h2><?php echo $model->item_title?></h2>
                        <?php echo $model->html_list?>                    
                    </a>
                </li>
<?php endforeach;?>
            </ul>
        </div>
        <div id='left_scroll'><a href='javascript:slide("left");'><img src='<?php echo $imgUrl?>/banner-left.png' alt="left"/></a></div>
        <div id='right_scroll'><a href='javascript:slide("right");'><img src='<?php echo $imgUrl?>/banner-right.png' alt="right"/></a></div>
    </div>
</div>
