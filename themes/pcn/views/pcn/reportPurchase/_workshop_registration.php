<?php
$isEarlyBird = false;
if (strtotime($model['early_bird_date'] . ' 23:59:59') > time()) $isEarlyBird = true;

// Prepare ticket type array
$ticketTypeArray = array();
$ticketTypeArray['rpt_41_21'] = array(
    'caption'  => '$' . number_format($isEarlyBird ? $model['items']['rpt_41_21']['price_eb'] : $model['items']['rpt_41_21']['price']) . ' - ' . $model['items']['rpt_41_21']['name'],
    'sessions' => $model['items']['rpt_41_21']['session_count'],
);
$ticketTypeArray['rpt_41_22'] = array(
    'caption'  => '$' . number_format($isEarlyBird ? $model['items']['rpt_41_22']['price_eb'] : $model['items']['rpt_41_22']['price']) . ' - ' . $model['items']['rpt_41_22']['name'],
    'sessions' => $model['items']['rpt_41_22']['session_count'],
);
$ticketTypeArray['rpt_41_23'] = array(
    'caption'  => '$' . number_format($isEarlyBird ? $model['items']['rpt_41_23']['price_eb'] : $model['items']['rpt_41_23']['price']) . ' - ' . $model['items']['rpt_41_23']['name'],
    'sessions' => $model['items']['rpt_41_23']['session_count'],
);
/*
$arr = array(
    'training' => array(
        '1. Introduction to the payments landscape',
        '2. Introduction to payment protocols',
        '3. The issuing and acquiring value chain',
    ),
    'workshop' => array(
        '10. AS 2805 workshop',
    )
);
$arr = array(
    'training' => array(
        '4. Introduction to Certification',
        '5. Introduction to EMV',
    ),
    'workshop' => array(
        '11. The mobile money ecosystem workshop',
    )
);
$arr = array(
    'training' => array(
        '6. Introduction to fraud management',
        '7. Introduction to PCI DSS',
    ),
    'workshop' => array(
        '12. Clearing System 3 workshop',
    )
);
$arr = array(
    'training' => array(
        '8. Cards and interchange',
        '9. Real-time payments',
    ),
    'workshop' => array(
        '13. Fraud management workshop',
    )
);
$json = CJSON::encode($arr);

// MyFunctions::echoArray(array(
//     'earlyBirdTime' => strtotime($model['early_bird_date'] . ' 23:59:59'),
//     'now' => time(),
//     'isEarlyBird' => $isEarlyBird,
//     'tickettypeArray' => $ticketTypeArray,
//     'json' => $json,
// ));
/**/
?>
    <em class="grey" style="font-size: 100%;">N.B. Please note that all prices quoted are in AUD and exclusive of GST. </em><br /><br class="clear" />
    <div id ="reportItemsWrapper">
        <div class="ajax-loader"></div>
        <div id="overallPriceWrapper">

            <dl id="location_select_wrapper" class="floatL mb10 mr10">
                <dt class="floatL mr10" style="width: 120px;"><label>Choose Location:</label></dt>
                <dd class="floatL mt0">
                    <select id="location_select" class="styled" name="ReportPurchase[location]">
                        <option value="" disabled="disabled" selected="selected">---select---</option>
                        <option value="rpt_41_11"><?php echo $model['items']['rpt_41_11']['name']; ?></option>
                        <option value="rpt_41_12"><?php echo $model['items']['rpt_41_12']['name']; ?></option>
                        <option value="rpt_41_13"><?php echo $model['items']['rpt_41_13']['name']; ?></option>
                    </select>
                </dd>
            </dl>

            <dl id="ticket_type_select_wrapper" class="floatL mb10 mr10 hidden">
                <dt class="floatL mr10" style="width: 120px;"><label>Choose Ticket Type:</label></dt>
                <dd class="floatL mt0">
                    <select id="ticket_type_select" class="styled" name="ReportPurchase[ticket_type]">
                        <option value="" disabled="disabled" selected="selected">---select---</option>
                        <?php foreach ($ticketTypeArray as $key => $ticketTypeItem): ?>
                        <option value="<?php echo CHtml::encode($key); ?>" data-sessions='<?php echo CHtml::encode($ticketTypeItem['sessions']); ?>'><?php echo CHtml::encode($ticketTypeItem['caption']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </dd>
            </dl>

            <div class="clear"></div>
            <div id="sessions_wrapper" class="hidden">
                <br /><em class="grey" style="font-size: 100%;">N.B. Select the number of sessions you have registered for above and then <strong>either a Training or Workshop modules for that session</strong>.</em>
                <?php
                foreach ($model['items'] as $key => $reportItem) {
                    if ( $key < 'rpt_41_30' ) continue;
                    $arr = CJSON::decode($reportItem['json']);
                ?>
                <div class="clear"></div>
                <dl class="floatL mt5 ml15">
                    <dt class="floatL ml5 mb0 checkBoxLabel">
                        <label><?php echo $reportItem['name']?></label>
                    </dt>
                    <dd class="floatL mt10">
                        <table class="workshopRegTable">
                            <tr>
                                <td class="nepar"><input id="<?php echo $key . '_training'; ?>" class="styled" type="checkbox" name="ReportPurchase[items][]" value="<?php echo $key . '_training'; ?>" /></td>
                                <td class="par">
                                    <ul>
                                    <?php foreach( $arr['training'] as $training ) { ?>
                                        <li><?php echo CHtml::encode($training); ?></li>
                                    <?php } ?>
                                    </ul>
                                </td>
                                <td class="nepar"><input id="<?php echo $key . '_workshop'; ?>" class="styled" type="checkbox" name="ReportPurchase[items][]" value="<?php echo $key . '_workshop'; ?>" /></td>
                                <td class="par">
                                    <ul>
                                    <?php foreach( $arr['workshop'] as $workshop ) { ?>
                                        <li><?php echo CHtml::encode($workshop); ?></li>
                                    <?php } ?>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </dd>
                </dl>
                <?php } ?>
            </div>
        </div>
    </div>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
        jQuery('#location_select').change(function(){
            jQuery('#ticket_type_select_wrapper').removeClass('hidden');
        });

        jQuery('#ticket_type_select').change(function(){
            jQuery('#sessions_wrapper').removeClass('hidden');
        });

        jQuery("#workshop-purchase-form").submit(function(){
            /*
                TODO:
                    - select list validation & error display
                    - complex selected sessions manipulation
             */
            var ticketTypeSessionsCount = jQuery('#ticket_type_select option:selected').data('sessions');
            console.log('ticket selected: ' + jQuery('#ticket_type_select option:selected').val());
            console.log('sessions count: ' + ticketTypeSessionsCount);
            console.log('sesions selected: ' + jQuery('#sessions_wrapper input[type=checkbox]:checked').size());
            return false;
        });
    });
    /*]]>*/
</script>