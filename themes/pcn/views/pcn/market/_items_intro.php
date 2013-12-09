            <?php if (!empty($market->items_header)): ?>
            <h2 class="pt10"><?php echo $market->items_header; ?></h2>
            <?php endif; ?>

            <?php if (!empty($market->items_intro_html)): ?>
            <dl class="floatL mb10 mr10">
                <dt class="floatL mb0 pb0" style="width: 100px;">
                    <label>Please note:</label>
                </dt>
            </dl><br />
            <dl class="floatL mb10 mr10">
                <dd class="floatL">
                    <?php echo $market->items_intro_html; ?>
                </dd>
            </dl><br class="clear" />
            <?php endif; ?>
