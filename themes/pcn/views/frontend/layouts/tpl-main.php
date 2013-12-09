<?php
setlocale(LC_ALL,'english');
// define $baseUrl
if( (Yii::app()->getTheme())!==null ) $baseUrl = Yii::app()->theme->baseUrl;
else $baseUrl = Yii::app()->request->baseUrl . '/' . $this->publicPath;
// register some core scripts
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('bpopup');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="<?php echo $this->blocks['description']; ?>" />
    <meta name="keywords" content="<?php echo $this->blocks['keywords']; ?>" />
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link href="<?php echo $baseUrl; ?>/css/main.css" rel="stylesheet" />
    <!--<link href="favicon.ico" rel="shortcut icon">-->

    <title><?php echo $this->blocks['title']; ?></title>

<?php /*
    <script src="<?php echo $baseUrl; ?>/js/fbook/fb-script.js"></script>
*/ ?>
    <script src="<?php echo $baseUrl; ?>/js/browser-selector/css_browser_selector.js"></script>
    <script src="<?php echo $baseUrl; ?>/js/selectform/form_element.js"></script>
    <script src="<?php echo Yii::app()->request->getBaseUrl()?>/js/popup/jquery.bpopup.min.js"></script>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</head>

<body>

<?php echo $content; ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37651685-2', 'paymentsconsulting.com');
  ga('send', 'pageview');
</script>

</body>
</html>