<?php
$message = ""; 

switch( $e->getCode() ){ 
	default: $message = "Connection error!";
}

?>
<style>
PRE {
	background:#EFEFEF none repeat scroll 0 0;
	border-left:4px solid #CCCCCC;
	display:block;
	padding:15px;
	overflow:auto;
	width:740px;
}
HR {
	width:100%;
	border: 0;
	border-bottom: 1px solid #ccc; 
	padding: 50px;
}
</style>
<table width="100%" border="0">
  <tr>
    <td align="center"><br /><img src="images/icons/alert.png" /></td>
  </tr>
  <tr>
    <td align="center"><br /><h3>Something bad happen!</h3><br /></td> 
  </tr>
  <tr>
    <td align="center">&nbsp;<?php echo $message ; ?><hr /></td> 
  </tr>
  <tr>
    <td>
		<b>Exception</b>: <?php echo $e->getMessage() ; ?>
		<pre><?php echo $e->getTraceAsString() ; ?></pre>
	</td> 
  </tr>
</table> 
