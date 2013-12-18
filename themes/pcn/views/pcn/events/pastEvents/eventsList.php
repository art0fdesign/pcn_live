<?php
$baseLink = Yii::app()->request->baseUrl;
?>
<div class="wide floatL dotedR events">
    <h1 class="dotedB contactTitle eventsTitle mb15">Past Events</h1>

<?php foreach( $models as $model ):?>
    <div class="dotedB" id="<?php echo $model->item_seo?>">
        <?php echo Frontend::replaceAllTagsInContent( $displaySingle? $model->html_content: $model->html_list )?>
        <?php if( !$displaySingle ): ?>
        <?php  if(isset($model->link_id)) $link = $baseLink . '/' . $model->getLinkPageUrl(); else $link = $linkBaseUrl . '/' .$model->item_seo?>
        <a class="btn_blue btn_light_blue" href="<?php echo $link ?>">Read more</a>
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
