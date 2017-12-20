<?php
	require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Deal4loans</title>
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
</head>
<body>
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#4c4c4c;">Search Result</a></u></div>
<div class="intrl_txt">
<div style="width:970px; height:33px; margin-top:25px; float:left; clear:right;">
<h1 class="text3"  style="width:700px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943; margin-left:15px;">Search Result</h1>
</div>
<div style=" margin-left:15px; float:left; width:670px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="670" height="1" /></div>

<div style="clear:both; height:5px;"></div>
<div id="txt" style="margin-left:15px;">
<div id="cse-search-results"></div>
<script type="text/javascript">
  var googleSearchIframeName = "cse-search-results";
  var googleSearchFormName = "cse-search-box";
  var googleSearchFrameWidth = 960;
  var googleSearchDomain = "www.google.co.in";
  var googleSearchPath = "/cse";
</script>
<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>

</div>


<div style="clear:both; height:15px;"></div>
</div>
<!--partners-->
<!--partners-->
<?php include "footer1.php"; ?>

</body>
</html>
