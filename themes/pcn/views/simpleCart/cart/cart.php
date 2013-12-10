<div class="subLine dotedB">
<div class="center">

    <div class="floatL">
        <img src="/themes/pcn/img/shop.png" alt="shop" class="pt20 pr10 pl30 floatL">
        <h1 class="floatL">Cart</h1>
    </div>

    <?php if (count($models)): ?>
    <div class="floatR mr40">
        <a href="/my-cart/checkout" class="btn_blue mr10 mt12 floatL">check out</a>
    </div>
    <?php endif; ?>

</div>
</div>

<div class="content">
<div class="center">

    <table id="cartTable" class="order">

        <thead>
        <tr>
            <th class="text">Type</th>
            <th class="text1">Item</th>
            <th class="text">Price</th>
            <th class="text">Qty</th>
            <th class="text">Total</th>
            <th class="commands">Controls</th>
        </tr>
        </thead>

        <tbody>

    <?php if (count($models)): ?>
        <?php foreach ($models as $model): ?>
        <tr>
            <td class="text"><?php echo CHtml::encode($model->category); ?></td>
            <td class="text1">
                <?php echo CHtml::encode($model->name); ?>
                <?php if (!empty($model->description)): ?>
                <span><?php echo CHtml::encode($model->description); ?></span>
                <?php endif; ?>
            </td>
            <td class="numbers">$<?php echo CHtml::encode(number_format($model->price)); ?></td>
            <!-- <td class="numbers"><b><?php echo CHtml::encode(number_format($model->quantity)); ?></b></td> -->
            <td class="numbers"><input id="quantity_<?php echo CHtml::encode($model->id); ?>" type="text" name="Quantity[<?php echo CHtml::encode($model->id); ?>]" value="<?php echo CHtml::encode(number_format($model->quantity)); ?>" /></td>
            <td class="numbers">$<?php echo CHtml::encode(number_format($model->total())); ?></td>
            <td class="commands">
                <a href="/my-cart/update/<?php echo CHtml::encode($model->id); ?>" class="refresh" title="refresh" onclick="window.location = $(this).attr('href')+'?quantity='+$('#quantity_<?php echo CHtml::encode($model->id); ?>').val(); return false;"></a>
                <a href="/my-cart/delete/<?php echo CHtml::encode($model->id); ?>" class="delete" title="delete" onclick="if (!confirm('Are you sure you want to delete item?')) {return false;}"></a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="5"><b>There are no items in cart!!!</b></td>
        </tr>
        <?php endif; ?>
        </tbody>

        <tfoot>
        <tr>
            <td class="text"> </td>
            <td class="text"> </td>
            <td class="text"> </td>
            <td class="text"> </td>
            <td>Total:</td>
            <td class="numbers">$<?php echo CHtml::encode(number_format($total)); ?></td>
        </tr>
        </tfoot>

    </table><br class="clear" />

    <?php if (count($models)): ?>
    <a href="/my-cart/checkout" class="btn_blue floatR mt20 mr15 mb40 pt20 pb20 pr25 pl25"><b class="larger">check out</b></a>
    <?php endif; ?>

</div>
</div>
