<?php
// define $baseUrl
if( (Yii::app()->getTheme())!==null ) $baseUrl = Yii::app()->theme->baseUrl;
else $baseUrl = Yii::app()->request->baseUrl . '/' . $this->publicPath;
$pageTitle=Yii::app()->name . ' - Error';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />

	<title>Oops!</title>
    
    <link href="<?php echo $baseUrl; ?>/css/error.css" rel="stylesheet" />
    <!--<link href="favicon.ico" rel="shortcut icon">-->
    
</head>

<body class="nobg errorPage">


<!-- Main content wrapper -->
<div class="errorWrapper">
    <span class="sadEmo"></span>
    <span class="errorTitle">Ahh, something went wrong here :(</span>

<?php echo $content?>

</div>    

</body>
</html>