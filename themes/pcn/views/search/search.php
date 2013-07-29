<div class="wide floatL dotedR search">
    <h1 class="dotedB newsTitle eventsTitle mb15">PCN Search</h1>
    <form action="<?php echo Yii::app()->request->getBaseUrl(true) ?>/search" method="get">
        <input type="text" name="term" value="<?php echo $term?>" class="textbox" />
        <input type="submit" name="submit" value="search" class="btn_blue floatR" />
    </form>

<?php if( count($models) == 0 ):?>
    <h3>No search results found.</h3>
<?php endif;?>

<?php foreach( $models as $model ):?>

    <div class="dotedB pr25 pt15 pb5">
        <a href="<?php echo $model->getTitleHRef( $links[$model->module] )?>"><?php echo $model->title ?></a>
        <p>
            <?php echo date( 'M j, Y', strtotime($model->changed_dt))?>&nbsp;...&nbsp;
            <?php echo $model->prepareItemContent($search, 200)?>
        </p>
    </div>

<?php endforeach; ?>



<?php 
$this->widget( 'AodLinkPager', array( 
    'pages'=>$pages, 
    'paginationBaseUrl'=>$paginationBaseUrl, 
    //'paginationParams'=>$paginationParams,
    'cssFile'=>false, 
    'header'=>'',
    'prevPageLabel' => '&#171;', 
    'nextPageLabel' => '&#187;',
    'maxButtonCount' => '10', 
) )
?>
</div>
