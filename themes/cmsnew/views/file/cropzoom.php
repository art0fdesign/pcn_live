<div class="bottomline">
    <div class="version"><?=CHtml::link('<span>Art of Design CMS</span>', 'http://art0fdesign.com/', array('target'=>'_blank')) ?></div>
    <div class="arrowleft"></div>
</div>

<div class="wrapper">
    <div class="titleBlock mb20"></div>

    <div class="widget">
        <div class="title"><h6>Crop, zoom, rotate and create thumbnail</h6></div>

            <div align="center">

                <?php $this->widget('ext.cropzoom.JCropZoom', array(
                    'id' => 'cropZoom1',
                    'onServerHandled' => 'js:function(response){alert("Success");}',
                    'width'=>$model->getWidthForCrop(),
                    'height'=>$model->getHeightForCrop(),
                    'image'=>array(
                        'source'=>$this->createAbsoluteUrl('/upload/' . $model->save_name),
                        'width'=>$model->getWidthForCrop(),
                        'height'=>$model->getHeightForCrop(),
                    ),
                )); ?>
                <div>
                    <!--<a href="javascript:;" onclick="cropZoom1.restore();">restore image</a>-->
                    <?php echo CHtml::button('Restore image', array('href'=>"javascript:;", 'onclick'=>"cropZoom1.restore();" ));?>
                </div>
                <div id="examples">
                    <div id="crop_container1"></div>
                </div>

            </div>
    </div>

    <?php echo CHtml::link('View Thumbnails',array('view', 'id'=>$model->id), array('class'=>'btn floatR')); ?>

</div>



