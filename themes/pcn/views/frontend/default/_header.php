
<!--================ HEADER ===============-->

<div class="header">
<div class="center">

<?php echo @$block['header-logo']; ?>

    <div class="floatR" style="position:relative; margin-top:8px;">

        <?php echo $this->widget('ext.simpleCart.checker.CheckerWidget')->html; ?>

        <?php echo @$block['site-search']; ?>

    </div>

    <div class="mainMenu">

        <?php echo @$block['header-nav']; ?>

    </div>
</div>
</div>
