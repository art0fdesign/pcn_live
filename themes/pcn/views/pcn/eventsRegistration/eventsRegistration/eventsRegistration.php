<?php
/**
 * Created by Lemmy.
 * Date: 6/15/13
 * Time: 8:32 PM
 */

$countries = array(
    'au' => 'Australia',
);

?>

<div class="wide wide1 floatL dotedR dotedL registration_wrapper">
    <div class="pl20 pr0">
    <?php if($message != null) echo $message; ?>
    <?php echo Frontend::replaceAllTagsInContent($eventMain->content_above); ?>

    <h2 class="pt15">Your Details</h2>
        <?php
        // $url = Frontend::getPageDataByWidget(null, 'eWayRapid3');
        // MyFunctions::echoArray($url, $_SERVER);
        // if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1') {
        if ($this->controller->isLive()) {
            $url = Yii::app()->request->getHostInfo('https') . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
        } else {
            $url = Yii::app()->request->getHostInfo('http') . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
        }
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'events-registration-form',
            'action' => $url,
            'enableClientValidation' => true,
            'clientOptions'=> array('validateOnSubmit'=>true),
            // 'htmlOptions'=>array('class'=>'form'),
            // 'enableAjaxValidation'=>true,
        ));
        ?>
        <fieldset class="pb30 dotedB">
            <?php echo $form->hiddenField($model, 'event_id'); ?>
        <dl class="floatL mb10">
            <dt class="floatL mr10">
                <?php echo $form->labelEx($model, 'first_name'); ?>
            </dt>
            <dd class="floatR">
                <?php echo $form->textField($model, 'first_name', array('class'=>'textbox', 'maxlength'=>70)); ?>
                <?php echo $form->error($model, 'first_name'); ?>
            </dd>
        </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'surname'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'surname', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'surname'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Title/<br />Position*</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'title_position', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'title_position'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'company'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'company', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'company'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Division/<br />Department:</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'division_department', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'division_department'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Street<br />Address*</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'street_address', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'street_address'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'suburb'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'suburb', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'suburb'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'state'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'state', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'state'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'postcode'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'postcode', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'postcode'); ?>
                </dd>
            </dl><br class="clear" />
<!--
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'country'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->dropDownList($model, 'country', $countries, array('class'=>'styled', 'maxlength'=>70)); ?>
                    <?php //echo $form->textField($model, 'country', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'country'); ?>
                </dd>
            </dl><br class="clear" />
 -->
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'telephone'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'telephone', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'telephone'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'mobile'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'mobile', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'mobile'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'email'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'email', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <?php /*
                $dietaryRequirements = $model->dietaryRequirements();

            ?>
            <label class="floatL ml10 mt10 mr40">Dietary requirements (if any)</label>
            <dl class="floatL mb10">
                <dd class="floatL mt10">
                    <input id="dietary_vegetarian" class="styled" type="checkbox" name="Dietary[Vegetarian]" value="vegetarian"<?php if(isset($dietaryRequirements->Vegetarian)): ?> checked="checked"<? endif; ?> />
                </dd>
                <dt class="floatL ml5"><label for="dietary_vegetarian">Vegetarian</label></dt>

                <dd class="floatL mt10">
                    <input id="dietary_gluten_free" class="styled" type="checkbox" name="Dietary[GlutenFree]" value="gluten_free"<?php if(isset($dietaryRequirements->GlutenFree)): ?> checked="checked"<? endif; ?> />
                </dd>
                <dt class="floatL ml5"><label for="dietary_gluten_free">Gluten free</label></dt>
                <dd class="floatL mt10">
                    <input id="dietary_other" class="styled" type="checkbox" name="Dietary[Other]" value="other"<?php if(isset($dietaryRequirements->Other)): ?> checked="checked"<? endif; ?> />
                </dd>
                <dt class="floatL ml5"><label for="dietary_other">Other, specify</label></dt>
            </dl><br class="clear /">
            <dl>
                <dd class="floatR mr10">
                    <?php echo $form->textField($model, 'dietary_other', array('class'=>'textbox', 'style'=>'width:290px;', 'maxlength'=>70)); ?>
                </dd>
            </dl>
*/ ?>
        </fieldset>

        <fieldset class="mt30">
        <?php if ($eventMain->templateName() == 'with_report'): ?>
<?php /*        <h2 class="pt10">Registration and Report Purchase Details</h2> */?>
        <h2 class="pt10">Report Purchase Details</h2>
        <?php else: ?>
        <h2 class="pt10">Registration Details</h2>
        <?php endif; ?>

            <?php require_once('_tpl_'.$eventMain->templateName().'.php'); ?>

            <dl class="floatL mb20 ml15">
                <dd>
                    <?php echo CHtml::submitButton('SUBMIT', array('id'=>'registrationSubmitButton', 'name'=>'submit', 'class'=>'submit btn_blue', 'style'=>'width: 100px;')) ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatR mt10 mr10">
                <a href="http://www.credit-card-logos.com">
                    <img alt="" title="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/eway_logo.jpg" width="116" height="35" border="0" />
                    <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_mastercard_2.gif" width="116" height="35" border="0" />
                </a>
            </dl>
        </fieldset>
        <?php $this->endWidget(); /**/?>
        <script type="text/javascript">
        </script>
    </div>
</div>

<?php echo Frontend::replaceAllTagsInContent(@$settings['terms-and-conditions']['set_value']) ?>

