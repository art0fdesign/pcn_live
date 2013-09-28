<?php 
    $this->layout='tpl-error';
    $this->pageTitle=Yii::app()->name . ' - Error';
?>


    <span class="errorNum"><?php echo $code?></span>
    <span class="errorDesc">Oops! Sorry, an error has occured. <?php echo CHtml::encode($message)?>!</span>
    <a href="<?php echo Yii::app()->request->getBaseUrl(true)?>" title="" class="button dredB"><span>Return</span></a>
