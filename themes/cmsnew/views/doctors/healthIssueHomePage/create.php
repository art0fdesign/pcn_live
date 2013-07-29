<?php
/**
 * Created by Lemmy.
 * Date: 10/3/12
 * Time: 7:50 PM
 */?>
<div class="titleBlock">
    <span>HEALTH ISSUES: Add Health Issue For Home Page</span>
</div>

<form id="select_form" method="post" action="<?php echo $act ?>" class="form">
    <div class="middleContent">
        <fieldset>
            <div class="widget">
                <div class="title1"></div>

                <div class="formRow mt30">
                    <!--<input type="text" id="issue_ac" name="issue" ajax_id="" style="width: 360px; margin-left: 10px"/>-->
                    <?php  echo CHtml::label('Category','categ', array());?>
                    <div class="formRight">
                        <div class="select-list"><?php echo CHtml::dropDownList('cat', $selectedCategory, $categories, $htmlOptions = array('id'=>'categ', 'empty'=>'---select category---', 'autocomplete'=>'off', 'ajax'=>array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('healthIssueHomePage/setCatId'),
                    ) ));?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <!--<input type="text" id="issue_ac" name="issue" ajax_id="" style="width: 360px; margin-left: 10px"/>-->
                    <?php  echo CHtml::label('Health Issue','issue_ac', array());?>
                    <div class="formRight">
                        <?php echo CHtml::textField('issue', '', array('id'=>'issue_ac', 'ajax_id'=>'')); ?>
                    </div>
                    <div class="clear"></div>
                </div>


                <div class="formRow mb20">
                    <?php echo CHtml::label('Order By', 'order', array()); ?>
                    <div class="formRight">
                        <?php echo CHtml::textField('order', '', array('id'=>'order')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow mb20"></div>
            </div>
        </fieldset>
        <div class="clear"></div>
        <div class="button-box mt20">
            <?php echo CHtml::submitButton( 'Add', array('add', 'class'=>'saveBtn')); ?><br />
            <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
        </div>
    </div>
</form>
    <!--HEALTH ISSUES: Select Health Issue For Home Page-->