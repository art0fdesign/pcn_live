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
