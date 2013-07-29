<div class="titleBlock"><span>DASHBOARD</span></div>
<div class="wideContent">
	
    <?php if( $_SERVER['HTTP_HOST'] == 'localhost' ): ?>
    <a href="<?php echo Yii::app()->createUrl('site/session'); ?>">SESSION DATA</a>
    <?php endif; ?>

</div>