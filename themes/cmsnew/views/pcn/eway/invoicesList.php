<div class="titleBlock">
    <span>INVOICES: List of Invoices</span>
</div>
<div class="wideContent">
	<!-- Table -->
    <div class="widget">
        <div class="title"></div>

        <table class="display dTable">
        <thead>
    		<tr>
                <!-- <th class="center">ID</th> -->
                <th class="center">No.</th>
                <th>Date</th>
                <th>Client</th>
                <th>Items</th>
                <th class="right">Amount</th>
                <!-- <th>Response</th> -->
            </tr>
        </thead>

        <tbody>
        <?php  foreach($models as $item) : ?>

        <tr class='gradeA'>
        <!-- <td class="center"><?php echo $item->primaryKey;?></td> -->
        <td class="center"><?php echo $item->invoice_no;?></td>
        <td><?php echo date('d-m-Y', strtotime($item->invoice_date));?></td>
        <td><?php echo $this->renderPartial('_client', array('item'=>$item)); ?></td>
        <td><?php echo $this->renderPartial('_items', array('items'=>$item->invoiceItemsArray())); ?></td>
        <td class="right"><?php echo $item->price;?></td>
        <!-- <td><?php echo $item->api_response_message;?></td> -->
        </tr>
        <?php endforeach; ?>
        </tbody>

        </table>
        <div class="tfooter">Total number of Invoices: <?php echo count($models);?></div>
    </div>

</div>
