<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Articles Credit cards India | Deal4loans</title>
<meta name="keywords" content=" Credit cards Articles, Business Loans Articles, Latest Credit Card Offers,Home Loans Articles, Deal4loans Articles">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Understand more about  credit card features , chartges, offers, rewatd points, inteest rates, frauds on articles at Deal4loans.com.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="common-bread-crumb" style="margin:auto; margin-top:70px;"><a href="index.php">Home</a> > <a href="Contents_Articles.php">Articles Menu</a> > Credit Card Articles</div>
<div class="intrl_txt" style="margin:auto;">
  <div class="leftnewwrapper">
    <div style="width:100%; height:33; margin-top:15px; float:left; clear:right;">
      <h1 class="d4l-h1">Credit Card Articles</h1>
      <div style="clear:both; height:5px;"></div>
      <div style="margin-bottom:10px;">
        <div>
          <p align="right">Go To:- <a href="Home-Loan-Articles.php" >Home Loan Articles</a> | <a href="Loan-Articles.php">Other Articles</a></p>
          <ul>
            <?php
		$SQL_CC = "select * from Articles where  Art_Main_Title like '%Credit Cards%' and Art_approve=1  order by  Art_DOE desc";
		
		list($NumRows_CC,$ArrRow)=MainselectfuncNew($SQL_CC,$array = array());
		$cntr=0;

		//$Query_CC = ExecQuery($SQL_CC);
		//$NumRows_CC = mysql_num_rows($Query_CC);
		$Title = $ArrRow[$cntr]['Art_Main_Title'];
		
		while($cntr<count($ArrRow))
		{
			$Art_Sub_Title = $ArrRow[$cntr]['Art_Sub_Title'];
			$Art_Url = $ArrRow[$cntr]['Art_Url'];
			$Art_Content = $ArrRow[$cntr]['Art_Content'];
			
			echo "<li>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></li>";			
	$cntr = $cntr+1;		
		}
	?>
          </ul>
          <br/>
        </div>
      </div>
      <div style="text-align:right;"><a href="#">Back to Top</a></div>
    </div>
  </div>
  <div class="newright-panel">
    <?php include "RightPL1.php"; ?>
  </div>
</div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>
