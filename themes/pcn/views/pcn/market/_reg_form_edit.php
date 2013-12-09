    <?php

    $countries = array(
        'au' => 'Australia',
    );
    // if ($this->controller->isLive()) {
    //     $url = Yii::app()->request->getHostInfo('https') . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
    // } else {
    //     $url = Yii::app()->request->getHostInfo('http') . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
    // }
    // $request->scenario = 'reg_form';
    // $form = $this->beginWidget('CActiveForm', array(
    //     'id'            =>'registration-form',
    //     // 'action'        => $url,
    //     'clientOptions' => array('validateOnSubmit'=>true),
    //     'enableClientValidation' => true,
    //     // 'htmlOptions'=>array('class'=>'form'),
    //     // 'enableAjaxValidation'=>true,
    // ));
    ?>

        <fieldset class="pb30 dotedB">
        <dl class="floatL mb10">
            <dt class="floatL mr10">
                <?php echo $form->labelEx($request, 'first_name'); ?>
            </dt>
            <dd class="floatR">
                <?php echo $form->textField($request, 'first_name', array('class'=>'textbox', 'maxlength'=>70)); ?>
                <?php echo $form->error($request, 'first_name'); ?>
            </dd>
        </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'last_name'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'last_name', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'last_name'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Title/<br />Position*</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'title_position', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'title_position'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'company'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'company', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'company'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Division/<br />Department:</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'division_department', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'division_department'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Street<br />Address*</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'street_address', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'street_address'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'suburb'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'suburb', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'suburb'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'state'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'state', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'state'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'postcode'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'postcode', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'postcode'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'abbr'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->dropDownList($request, 'abbr', $countries, array('class'=>'styled', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'abbr'); ?>
                </dd>
            </dl><br class="clear" />

            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'telephone'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'telephone', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'telephone'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'mobile'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'mobile', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'mobile'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($request, 'email'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($request, 'email', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($request, 'email'); ?>
                </dd>
            </dl>
            <br class="clear" />

            <?php if ($market->f_reg_form_dietary): ?>
            <?php
                $dietaryRequirements = $request->dietaryRequirements();
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
                    <?php echo $form->textField($request, 'dietary_other', array('class'=>'textbox', 'style'=>'width:290px;', 'maxlength'=>70)); ?>
                </dd>
            </dl>
            <?php endif; ?>
        </fieldset>

        <fieldset>
            <dl class="floatL mb20 ml15">
                <dd>
                    <?php echo CHtml::submitButton('NEXT', array('id'=>'registrationSubmitButton', 'name'=>'submit_reg_form', 'class'=>'submit btn_blue', 'style'=>'width: 100px;')) ?>
                </dd>
            </dl><br class="clear" />
        </fieldset>


    <?php //$this->endWidget(); /* End of registration form */?>
