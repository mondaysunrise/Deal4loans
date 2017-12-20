<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Articles Personal Home Loans Credit cards India | Deal4loans</title>
<meta name="keywords" content="Home Loans Articles, Credit cards Articles, Business Loans Articles, Latest Credit Card Offers, Deal4loans Articles">
<meta name="description" content="Read the articles on Home Loans. Personal Loan, Credit Card, Business Loan. Uderstand more about loans and credit cards on Deal4loans.com.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="common-bread-crumb" style="margin:auto; margin-top:70px;"><a href="index.php"  class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal; color:#0080d6;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;">Articles</span> </div>
<div class="intrl_txt" style="margin:auto;">
  <div class="leftnewwrapper">
    <div style="width:100%; height:33; margin-top:15px; float:left; clear:right;">
      <h1 class="d4l-h1">Articles</h1>
      <div style="clear:both; height:15px;"></div>
      <div style="margin-bottom:10px;">
        <div id="txt"> <span class="text" style="color:#000; size:18px; font-weight:bold;">Credit Card Articles</span><br />
          <ul>
            <?php
		$SQL_CC = "select * from Articles where  Art_Main_Title like '%Credit Cards%' and Art_approve=1 order by  Art_DOE desc";
		list($NumRows_CC,$ArrRow)=MainselectfuncNew($SQL_CC,$array = array());
		$cntr=0;
        $Title = $ArrRow[$cntr]['Art_Main_Title'];
		while($cntr<count($ArrRow))
            {
			$Art_Sub_Title = $ArrRow[$cntr]['Art_Sub_Title'];
			$Art_Url = $ArrRow[$cntr]['Art_Url'];
			$Art_Content = $ArrRow[$cntr]['Art_Content'];
			
			echo "<li><a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></li>";			
			$cntr=$cntr+1;				
			
		}
	?>
          </ul>
          <br />
          <span class="text" style="color:#000; size:18px; font-weight:bold;">Home Loan Articles</span><br />
          <ul>
            <?php
		$SQL_CC = "select * from Articles where  Art_Main_Title like '%Home Loan%' and Art_approve=1  order by  Art_DOE desc";
		list($Query_CC,$CCArrRow)=MainselectfuncNew($SQL_CC,$array = array());
		
		
		$Ccnt = 0;
		$Title = $CCArrRow[$Ccnt]['Art_Main_Title'];
		
		while($Ccnt<count($CCArrRow))
		{
			$Art_Sub_Title = $CCArrRow[$Ccnt]['Art_Sub_Title'];
			$Art_Url = $CCArrRow[$Ccnt]['Art_Url'];
			$Art_Content = $CCArrRow[$Ccnt]['Art_Content'];
			
			echo "<li>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></li>";			
		$Ccnt = $Ccnt+1;	
		}
	?>
          </ul>
          <br/>
          <span class="text" style="color:#000; size:18px; font-weight:bold;">Other Loan Articles</span><br />
          <ul>
            <?php
		$SQL_CC = "select * from Articles where  Art_Main_Title like '%Other Articles%' and Art_approve=1  order by  Art_DOE desc";
		list($NumRows_CC,$SqlArrRow)=MainselectfuncNew($SQL_CC,$array = array());
		
		//$Query_CC = ExecQuery($SQL_CC);
		//$NumRows_CC = mysql_num_rows($Query_CC);
		$sqCcnt = 0;
		$Title = $SqlArrRow[$sqCcnt]['Art_Main_Title'];
		
		while($sqCcnt<count($SqlArrRow))
		{
			$Art_Sub_Title = $SqlArrRow[$sqCcnt]['Art_Sub_Title'];
			$Art_Url = $SqlArrRow[$sqCcnt]['Art_Url'];
			$Art_Content = $SqlArrRow[$sqCcnt]['Art_Content'];
			
			echo "<li>&nbsp;<a href='".$Art_Url."'><font color='#0F74D4'>".$Art_Sub_Title."</font></li>";			
			$sqCcnt = $sqCcnt +1;
		}
	?>
          </ul>
          <br>
        </div>
      </div>
      <div style=" float:left; width:100%; height:auto; margin-top:3px; text-align:right;"><span class="text11" style="color:#4c4c4c; size:18px;"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></span> </div>
    </div>
  </div>
 <div class="newright-panel"><?php include "RightPL1.php"; ?></div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>