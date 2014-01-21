<div class="floatL">

    <h1 class="dotedB contactTitle mb15">Contact</h1>

<?php echo empty($message)? @$sets['text-before-form']['set_value']: $message ?>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-form-form',
    //'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<fieldset class="mt30 mb30 dotedB">

    <dl class="floatL mb10">
        <dt class="floatL mr20"><label>First Name:</label></dt>
        <dd class="floatR">
            <?php echo $form->error( $model, 'first_name' ) ?>
            <?php echo $form->textField( $model, 'first_name', array('class'=>'textbox' )); ?>
        </dd>
    </dl><br class="clear" />

    <dl class="floatL mb10">
        <dt class="floatL mr20"><label>Last Name:</label></dt>
        <dd class="floatR">
            <?php echo $form->error( $model, 'last_name' ) ?>
            <?php echo $form->textField( $model, 'last_name', array('class'=>'textbox' )); ?>
        </dd>
    </dl><br class="clear" />

    <dl class="floatL mb10">
        <dt class="floatL mr20"><label>Mail:</label></dt>
        <dd class="floatR">
            <?php echo $form->error( $model, 'email' ) ?>
            <?php echo $form->textField( $model, 'email', array('class'=>'textbox' )); ?>
        </dd>
    </dl><br class="clear" />

    <dl class="floatL mb10">
        <dt class="floatL mr20"><label>Phone:</label></dt>
        <dd class="floatR">
            <?php echo $form->error( $model, 'phone' ) ?>
            <?php echo $form->textField( $model, 'phone', array('class'=>'textbox' )); ?>
        </dd>
    </dl><br class="clear" />


    <dl class="floatL mb10">
        <dt class="floatL mr20"><label>Subject:</label></dt>
        <dd class="floatR">
            <?php echo $form->error( $model, 'subject' ) ?>
            <?php echo $form->textField( $model, 'subject', array('class'=>'textbox' )); ?>
        </dd>
    </dl><br class="clear" />

    <dl class="floatL mb10">
        <dt class="floatL mr20"><label>Message:</label></dt>
        <dd class="floatR">
            <?php echo $form->error( $model, 'message' ) ?>
            <?php echo $form->textArea( $model, 'message', array('class'=>'textarea textbox' )); ?>
        </dd>
    </dl><br class="clear" />

    <?php /*if(CCaptcha::checkRequirements()):?>
    <dl class="floatL">
        <dt class="floatL mr20"><label>Enter code:</label></dt>
        <dd class="floatR mr40">
            <?php echo $form->error($model, 'verifyCode')?>
            <?php echo $form->textField($model, 'verifyCode', array('class'=>'textbox'))?>
        </dd>
    </dl>
    <dl class="floatL mb10">
        <dd class="floatR">
            <?php $this->widget( 'CCaptcha', array('clickableImage'=>true, 'showRefreshButton'=>false, 'imageOptions'=>array( 'class'=>'captchaImage')) )?>
        </dd>
    </dl>
    <?php endif;*/?>


    <dl class="floatL mb20" style="margin-left:90px;">
    <dd><input type="submit" value="SUBMIT"class="submit btn_blue mr20" style="width:100px;" /></dd>
    </dl>

</fieldset>
<?php $this->endWidget(); ?>

<?=@$sets['text-after-form']['set_value']; ?>

</div>
