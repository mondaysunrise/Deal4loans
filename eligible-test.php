<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	//error_reporting();
	$RequestID = 310453;
	
	$getUserSql = "select * from Req_Credit_Card where RequestID='".$RequestID."'";

 list($recordcount,$getrow)=MainselectfuncNew($getUserSql,$array = array());
		$cntr=0;
	//$getUserQuery = ExecQuery($getUserSql);
	$City = $getrow[$cntr]['City'];
	if($City == "Others")
	{
		$City = $getrow[$cntr]['City_Other'];	
	}
//echo "<br>";	echo "<br>";	
 	$Net_Salary = $getrow[$cntr]['Net_Salary'];
 $Full_Name =  $getrow[$cntr]['Name'];
//echo "<br>";	
$ProductValue = $RequestID;
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  
   <?php
   if($Net_Salary>=144000)
	 {  
   $selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	
	list($rowscount,$row)=MainselectfuncNew($selectccbanks,$array = array());
	
	//$ccbankresult = ExecQuery($selectccbanks);
	//$rowscount = mysql_num_rows($ccbankresult);

if($rowscount >0)
{
		
	?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Dear <? echo $Full_Name;?>,<br>
The below mentioned Credit card companies are interested in your profile as per there eligibility.<br>
Choose from the offers below and Apply  at Banks Link for  the best Credit Card as per you !!!!!<br>
The fastest and simplest way to acquire your Credit card.</div>

 <table width="240" border="0" cellspacing="0" cellpadding="0" >
  <tr>
  <?php
 
	
$r=0;
	 while($r<count($row))
        {
        
	   	$cc_bank_query  = $row[$r]["other_query"];
		$cc_bankid  = $row[$r]["cc_bankid"];
		$cc_bank_url  = $row[$r]["cc_bank_url"];
		if($_SESSION['siten']=="ndtv")
		{
			$cc_bank_url  = $row[$r]["cc_bank_url_ndtv"];
		}
		
	  $qry2 = $cc_bank_query." and Req_Credit_Card.RequestID ='".$ProductValue."'";
//$qry2 = $cc_bank_query." and Req_Credit_Card.RequestID =227258";
		 //echo "query2 ".$qry2."<br><br>";
		  list($recordcount,$getrow)=MainselectfuncNew($qry2,$array = array());
		
		 
		  //$result1=ExecQuery($qry2);
        //$recordcount = mysql_num_rows($result1);
		if($recordcount>0)
		 {
		 	$i=0;
			while($i<count($getrow))
       		 {
			$get_Bank="Select * From credit_card_banks_eligibility Where cc_bankid=".$cc_bankid." order by cc_bank_fee ASC";
			
			 list($getrecordcount,$Myrow)=MainselectfuncNew($get_Bank,$array = array());
		
		
			//$get_Bankresult=ExecQuery($get_Bank);
			 //$getrecordcount = mysql_num_rows($get_Bankresult);
		//echo "<br>";
			if($getrecordcount>0)
			{
  while($j<count($Myrow))
        { 
			?>
    <td valign="top" width="240" class="crdbg" align="center">
	<table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" class="crdbhdng"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><? 
		echo $cc_bank_name = $Myrow[$j]['cc_bank_name'];
		//echo $myrow["cc_bank_name"];?></a></td>
      </tr>
	  
	  <? if($cc_bankid==3 || $cc_bankid==4)
	  { ?>
      <tr>
	     <td height="255" align="center" valign="bottom">
		<? $card_image =$Myrow[$j]['card_image'];
		?><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><img src="<? echo $card_image;?>"  /></a></td>
      </tr>
	  <? } 
	  else
	  {
	  ?>
	  <tr>
	     <td  height="135" align="center" valign="bottom">
		<? $card_image =$Myrow[$j]['card_image'];
		?><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><img src="<? echo $card_image;?>"  /></a></td>
      </tr>
	  <? } ?>
     <!-- <tr>
        <td height="22" valign="bottom" class="crdbold">Features <a href="<? //echo  $cc_bank_url;?>" style="float:right; "> Apply</a></td>
      </tr> -->
	 
						  <? if($cc_bankid==3 || $cc_bankid==4)
	  { ?>
	   	<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
	  <tr>
							<td height="325" valign="top" class="crdtext"><? echo $cc_bank_features = $Myrow[$j]['cc_bank_features'];?></td>
			</tr>
			<? }
			else if($cc_bankid==12)
			{
			?>
			 	<tr>
							<td height="113" valign="bottom" class="crdbold">Features</td>
						</tr>
							 <tr>
					<td height="325" valign="top" class="crdtext"><? echo $cc_bank_features = $Myrow[$j]['cc_bank_features'];?></td>
			</tr>
			<?php			
			}
			else if($cc_bankid==5)
			{
			?>
			 	<tr>
							<td height="139" valign="bottom" class="crdbold">Features</td>
						</tr>
							 <tr>
					<td height="326" valign="top" class="crdtext"><? echo $cc_bank_features = $Myrow[$j]['cc_bank_features'];?></td>
			</tr>
			<?php			
			}
			else
			{ ?>
			 	<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
			 <tr>
							<td height="444" valign="top" class="crdtext"><? echo $cc_bank_features = $Myrow[$j]['cc_bank_features'];?></td>
			</tr>
			<? } ?>
			
      <!--<tr>
        <td height="270" valign="top" class="crdtext"><? //echo $myrow["cc_bank_features"];
		//echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_bank_features');
		?></td>
      </tr> -->
      <tr>
        <td align="center" valign="bottom">
          <input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" onclick="javascript:window.open('<? echo  $cc_bank_url;?>')" /></td>
      </tr>
    </table></td>
        
		<?
			//echo "heloooooo".$i."<br>";
		

		$j=$j+1;}
		}

$i=$i+1;

}
		 }
		 $r=$r+1;
		
	//	 echo "<br>jkh".$r;
if($r==5)
		{
			
		?>
		</tr><tr>
    <td height="20"></td>
    <td height="20"></td>
    <td height="20"></td>
    <td height="20"></td>
  </tr><tr>
		<?
		}
 $r=$r+1;	}
		?>
    
  </tr>
<?
	 }
	 else
	 {
	 	$filename = "Contents_Credit_Card_Mustread.php";
		header("Location: $filename");
		exit();
	 }
   }
	 else
	 {
		$filename = "Contents_Credit_Card_Mustread.php";
						header("Location: $filename");
						exit();
	 }
		 ?>
</table>

  </div>
  <div align="center"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* deal4loan */
google_ad_slot = "8793338166";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->


</body>
</html>