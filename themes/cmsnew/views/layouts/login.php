<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />


    <?php
    $baseurl = Yii::app()->request->baseUrl;
    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->getClientScript()->registerCoreScript('yii');
    Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
    ?>

    <link href="<?php echo $baseurl;?>/themes/cmsnew/css/main.css" rel="stylesheet" type="text/css" />


    <title><?php echo Yii::app()->name; ?></title>

    <script type="text/javascript" src="<?php echo $baseurl;?>/js/menu-colapsed/javascript.js"></script>
    <script type="text/javascript" src="<?php echo $baseurl;?>/js/form/form_element.js"></script>
    <script type="text/javascript" src="<?php echo $baseurl;?>/js/plugins/forms/jquery.cleditor.js"></script>
    <script type="text/javascript" src="<?php echo $baseurl;?>/js/datatable/datatable.js"></script>

    <script type="text/javascript" src="<?php echo $baseurl;?>/js/script.js"></script>

</head>

<body>

<div class="wraper">

    <div class="headerWrapper">
        <header>



            <div class="supervisor"><span></span></div>
            <img class="floatR" src="<?php echo $baseurl;?>/img/bgr_left_version.png" alt="supervisor" />


        </header>
    </div>


    <div class="bottomlineWrapper">
        <div class="bottomline">
            <div class="arrowleft"></div>

            <? if($this->controls) : ?>
            <?foreach($this->menu as $m) : ?>
                <span class="mainCom"><?=$m['text']?></span>
                <span class="plus"><?= CHtml::link('&#43;', array("{$m['link']}")) ?></span>
                <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>


    <div class="contentWrapper">
        <div class="content">


            <!-- CONTENT -->
            <?php echo $content; ?>
            <!-- CONTENT END -->

            <div class="clear"></div>


        </div>



    </div>
</div>
<!-- Footer -->

<div class="footerWrapper">
<footer>
<span class="footertext">Copyright  
	<a href="http://art0fdesign.com/" target="_blank" title="...the most powerful design..."> Art of Design</a> 
	2003-2012. All Rights Reserved
</span>
</footer>
</div>

</body>

</html>