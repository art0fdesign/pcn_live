<?php

?>
<div class="wide floatL dotedR events news">
    <h1 class="dotedB newsTitle eventsTitle mb15">PCN News</h1>

<?php foreach( $models as $model ):?>

    <div class="dotedB pr25 pt15 pb5">
        <?php echo Frontend::replaceAllTagsInContent( $displaySingle? $model->html_content: $model->html_list )?>
        <?php if( !$displaySingle ): ?>
        <a class="btn_blue btn_light_blue" href="<?php echo $linkBaseUrl . '/' . $model->item_seo?>">Read more</a>
        <?php endif;?>
    </div>

<?php endforeach; ?>

<?php 
$this->widget( 'AodLinkPager', array( 
    'pages'=>$pages, 
    'paginationBaseUrl'=>$linkBaseUrl, 
    'cssFile'=>false, 
    'header'=>'',
    'prevPageLabel' => '&#171;', 
    'nextPageLabel' => '&#187;',
    'maxButtonCount' => '10', 
) )
?>

</div>