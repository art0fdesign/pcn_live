<div class="bottomline">
    <div class="version"><?=CHtml::link('<span>Art of Design CMS</span>', 'http://art0fdesign.com/', array('target'=>'_blank')) ?></div>
    <div class="arrowleft"></div>
    <span class="mainCom">Upload File</span>
    <span class="plus"><?php echo CHtml::link('&#43;', array('file/create')) ?></span>
    <span class="mainCom">Upload Files</span>
    <span class="plus"><?php echo CHtml::link('&#43;', array('file/multi')) ?></span>
    <span class="mainCom">View Categories</span>
    <span class="plus"><?php echo CHtml::link('&#43;', array('fileCategory/index')) ?></span>

</div>
    <div class="wrapper">
        <div class="titleBlock mb20">
            <span>Create Thumbnail </span>
        </div>
            <div class="widget">
               <div align="center"> <?php
                $this->widget('ext.jcrop.EJcrop', array(
                //
                // Image URL
                'url' => $this->createAbsoluteUrl('/upload/' . $model->save_name),
                //
                // ALT text for the image
                'alt' => 'Crop This Image',
                //
                // options for the IMG element
                'htmlOptions' => array('id' => $model->id),
                //
                // Jcrop options (see Jcrop documentation)
                'options' => array(
                'minSize' => array(0, 0),
                'maxSize' => array(0, 0),
                'aspectRatio' => 0,
                'onRelease' => "js:function() {ejcrop_cancelCrop(this);}",
                ),
                // if this array is empty, buttons will not be added
                'buttons' => array(
                'start' => array(
                'label' => Yii::t('promoter', 'Start'),
                'htmlOptions' => array(
                'class' => 'myClass',
                'style' => '' // make sure style ends with « ; »
                )
                ),
                'crop' => array(
                'label' => Yii::t('promoter', 'Apply cropping'),
                ),
                'cancel' => array(
                'label' => Yii::t('promoter', 'Cancel cropping')
                )
                ),
                // URL to send request to (unused if no buttons)
                'ajaxUrl' => array('',),
                //
                // Additional parameters to send to the AJAX call (unused if no buttons)
                'ajaxParams' => array(),
                )); ?>
               </div>
            </div>
        <?php echo CHtml::link('View File',array('view', 'id'=>$model->id), array('class'=>'btn floatR')); ?>
</div>
