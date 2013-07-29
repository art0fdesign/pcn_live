<?php
/**
 * Created by Lemmy.
 * Date: 10/4/12
 * Time: 2:19 AM
 */?>
<div class="titleBlock">
    <span>HEALTH ISSUE: Update Added Health Issue</span>
</div>

<!--<form id="select_form" method="post" action="<?php //echo $act ?>" class="form">-->
<?php echo CHtml::beginForm('','post', array('id'=>'select_form', 'class'=>'form')); ?>
    <div class="middleContent">
        <fieldset>
            <div class="widget">
                <div class="title1"></div>
                <div class="formRow mt30">
                    <!--<input type="text" id="issue_ac" name="issue" ajax_id="" style="width: 360px; margin-left: 10px"/>-->
                    <?php  echo CHtml::label('Health Issue','issue_ac', array());?>
                    <div class="formRight">
                        <?php echo CHtml::textField('issue', $model->issue_name, array('id'=>'issue_ac', 'ajax_id'=>'', 'readOnly'=>'readOnly')); ?>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="formRow mb20">
                    <?php echo CHtml::label('Order By', 'order', array()); ?>
                    <div class="formRight">
                        <?php echo CHtml::textField('order', $model->order_hp, array('id'=>'order')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow mb20"></div>
            </div>
        </fieldset>
        <div class="clear"></div>
        <div class="button-box mt20">
            <?php echo CHtml::submitButton( 'Save', array('add', 'class'=>'saveBtn')); ?><br />
            <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
        </div>
    </div>
<?php echo CHtml::endForm();?>