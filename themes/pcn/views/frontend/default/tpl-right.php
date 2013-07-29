<?php 
    $this->layout='tpl-main';
?>

<div class="wrapper">

<?php include('_header.php'); ?>


<!--=====================SUBLINE==================-->

<div class="subLine dotedB">
<div class="center">

        <?php echo @$block['header-subline']; ?>
    
    <?php echo @$block['newsletter-form']; ?>

</div>
</div>


<!--================CONTENT===============-->

<div class="content">
<div class="center">



        <?php echo @$block['content']; ?>


<!--================ RIGHT SIDEBAR ===============-->

	<div class="narrow floatL mb20">

        <?php echo @$block['sidebar']; ?>

	</div><!-- END RIGHT SIDEBAR -->


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
