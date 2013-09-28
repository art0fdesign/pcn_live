<?php
$expertizeLinkBase = array('1'=>$linkBaseUrl, '2'=>$linkBaseUrl);

foreach($models as $model) {
	$expertizeLinkBase[$model->expertize] = $linkBaseUrl.'/'.$model->cat_seo;
}

$serviceBaseUrl = Yii::app()->request->getBaseUrl(true) . '/' . Frontend::getPageDataByWidget('servicesList');
?>
<div class="narrow floatL mb20">
<div class="narrow floatL pl20">
	<h2 class="mt30 title">Expertise</h2>

	<ul class="links links2">
		<li>Click on the functional and industry areas of interest below to find an expert Associate</li>
	</ul>
</div>

<div class="narrow floatL pl20">
	<h2 class="mt30 title"><a href="<?php echo $serviceBaseUrl . '/functional-expertise'; ?>">Functional Expertise</a></h2>

	<ul class="links links2">
	<?php $level1_categories = ListingPcnCategory::retrieveAll('order_by', array('expertize'=>'1', 'level'=>'2') ); ?>
	<?php foreach($level1_categories as $level1_category):?>
		<li>
			<a href="#" class="accordionParent"><?php echo $level1_category->cat_title;?></a>
			<ul class="accordionMenu" style="display: none" >
				<?php $level2_categories = ListingPcnCategory::retrieveAll('order_by', array('expertize'=>'1', 'parent_id'=>$level1_category->id));?>
				<?php foreach($level2_categories as $level2_category):?>
					<li>
						<a href="<?php echo $expertizeLinkBase['1'].'/'.$level2_category->cat_seo;?>"><?php echo $level2_category->cat_title; ?></a>
					</li>
				<?php endforeach;?>
			</ul>
		</li>
	<?php endforeach;?>
</ul>
</div>

<div class="narrow floatL pl20">
	<h2 class="mt30 title"><a href="<?php echo $serviceBaseUrl . '/industry-expertise'; ?>">Industry Expertise</a></h2>

	<ul class="links links2">
	<?php $level1_categories = ListingPcnCategory::retrieveAll('order_by', array('expertize'=>'2', 'level'=>'2') ); ?>
	<?php foreach($level1_categories as $level1_category):?>
		<li>
			<a href="<?php echo $expertizeLinkBase['2'].'/'.$level1_category->cat_seo;?>"><?php echo $level1_category->cat_title;?></a>
		</li>
	<?php endforeach;?>
</ul>
</div>
</div>