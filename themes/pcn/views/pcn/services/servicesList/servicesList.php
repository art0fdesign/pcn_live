<?php
//MyFunctions::echoArray( $models );
/**
 * Created by Lemmy.
 * Date: 3/26/13
 * Time: 12:10 AM
 */
 $selectedItemID = 0;
 ?>
<div class="narrow narrow1 floatL mb20">
    <h2 class="mt25 black">Services</h2>
    <ul class="links">
        <?php foreach($categories as $cat): ?>
            <li class="dotedB"><a <?php if($this->pars[1] == $cat['seo']) echo 'class="active"' ?> href="<?php echo $linkBaseUrl.'/'.$cat['seo'] ?>"><?php echo $cat['title']; ?></Php></a></li>
        <?php endforeach; ?>
    </ul>
    <ul class="links download">
        <li><a href="/upload/files/pcn-services-overview.pdf" target="_blank">Download our Services Overview here</a></li>
    </ul>
</div>

<div class="wide floatL dotedL" style="width:780px;position:relative;">
    <div class="pl20 pr20 mb0">
        <h1 class="dotedB contactTitle mb15" style="width:100%; background-image:none; padding-left:15px;"><?php echo $title ?></h1>
    </div>
    <?php foreach($models as $model): ?>
    <div class="serviceBlocks dotedB">
        <?php foreach($model as $mod): ?>
        <?php 
            $divID = 'popUpDiv_' . $mod['id'];
            $content = str_replace( '{onclick}', "popup('$divID', 'blanket_s')", $mod['content'] );
            //
            $selectMe = '';
            if( $mod['seo'] == $selectedItem ) $selectMe = ' popupMe';
        ?>
        <div class="serviceBlock">
            <a class="service_popup<?php echo $selectMe?>" id="popup_<?php echo $divID?>"><?php echo Frontend::replaceAllTagsInContent($mod['list']); ?></a>
            <div class="popUpDiv" id="<?php echo $divID?>" style="display: none;">
            <a class="back floatR b-close">&nbsp;</a>
            <?php echo Frontend::replaceAllTagsInContent($content); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php 
/*
if( $selectedItemID ){
    $script = '$("#popup_' . $selectedItemID . '").trigger("click");';
    $script = 'alert("click!")';
    Yii::app()->clientScript->registerScript('showSelectedService', $script );
}*/
?>