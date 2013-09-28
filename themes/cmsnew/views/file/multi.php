<div class="titleBlock"> <span>FILE MANAGER: Upload Files</span></div>
<div class="wideContent">
    <div class="wrapper">
        <div class="widget">
                <?php
                $this->widget('ext.xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("file/multiuploadHandler"),
                    'model' => $model,
                    'attribute' => 'file',
                    'multiple' => true,
                ));
                ?>
        </div>
        <?php echo CHtml::link('Back to list',array('index'), array('class'=>'btn floatR')); ?>
    </div>
</div>