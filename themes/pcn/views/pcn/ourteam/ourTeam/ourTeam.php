<?php
/**
 * Created by Lemmy.
 * Date: 3/24/13
 * Time: 5:41 PM
 */
?>
<div class="wide wide1 floatL dotedR dotedL">
    <div class="pl20 pr20">
        <h1 class="dotedB contactTitle aboutTitle mb15">Our Team&nbsp;<?php echo $filter != ''? '('.$filter.')': $filter;?></h1>
            <?php foreach($models as $i=>$model): ?>
                <div class="dotedB teamItem" id="<?php echo $model->item_seo ?>">
                    <a class="news"><img src="<?php echo Frontend::getFileSrc( 0, $model->image_url )?>" alt="<?php echo $model->item_title?>" /></a>
                    <?php echo Frontend::replaceAllTagsInContent($model->html_list)?>
                </div>
            <?php endforeach; ?>
    </div>
</div>