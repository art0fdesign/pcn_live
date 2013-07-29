<?php 
    $this->layout='tpl-main';
?>

<div class="wrapper">

<?php include('_header.php'); ?>


<!--=====================SUBLINE==================-->

<div class="subLine">
<div class="center">

        <?php echo @$block['header-subline']; ?>

    <?php echo @$block['newsletter-form']; ?>

</div>
</div>


<!--=====================BANNER==================-->

<div class="banner">
    <div class="center">

        <?php echo @$block['banner']; ?>

    </div>
</div> <!-- END BANNER -->


<!--================CONTENT===============-->

<div class="content">
<div class="center">


	<div class="homeBlocks mb40">

        <?php echo @$block['content-blocks']; ?>

	</div>
</div>
</div><!-- END CONTENT -->

<!--<div class="push"></div>-->

</div><!-- END WRAPPER -->


<!--================FOOTER===============-->

<div class="footer">
<div class="center">

        <?php echo @$block['footer']; ?>
	
</div>
</div>
