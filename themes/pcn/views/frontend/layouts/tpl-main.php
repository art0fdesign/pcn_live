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

    <script src="<?php echo $baseUrl; ?>/js/fbook/fb-script.js"></script>

    <script src="<?php echo $baseUrl; ?>/js/browser-selector/css_browser_selector.js"></script>
    <script src="<?php echo $baseUrl; ?>/js/selectform/form_element.js"></script>
    <script src="<?php echo Yii::app()->request->getBaseUrl()?>/js/popup/jquery.bpopup.min.js"></script>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    
</head>

<body>

<?php echo $content; ?>

<script type="text/javascript">
    var _gaq=_gaq||[];
    var pluginUrl='//www.google-analytics.com/plugins/ga/inpage_linkid.js';
    _gaq.push(['_require', 'inpage_linkid', pluginUrl]);
    _gaq.push(['_setAccount', 'UA-37651685-1']);
    _gaq.push(['_setDomainName', 'paymentsconsulting.com.au']);
    _gaq.push(['_setAllowLinker', true]);
    _gaq.push(['_trackPageview']);
    
    (function(){
        var ga = document.createElement('script'); 
        ga.type = 'text/javascript'; 
        ga.async = true;    
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(ga, s);  
    })();
</script>

</body>
</html>