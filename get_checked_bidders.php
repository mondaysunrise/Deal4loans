<?php
ob_start();
require 'scripts/functions.php';
require 'scripts/session_check.php';
	require 'scripts/db_init.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;


		$requestid = $_REQUEST['requestid'];
		$product_reply = $_REQUEST['reply_product'];
		 $Final_Bidder = $_REQUEST['Final_Bidder'];
		$selectbidderID=$_REQUEST['selectbidderID'];
$selectbidderID=explode(',',$selectbidderID);
		//print_r($selectbidderID);
		//echo "<br>";
		$realbankID=$_REQUEST['realbankID'];
		$realbankID=explode(',',$realbankID);
		//print_r($realbankID);
		
///////Get common bidder NAme////////////////
//echo "<br>";//////////
//echo "<br>";
//print_r($Final_Bidder);
	$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$Final_Bid = substr(trim($Final_Bid), 0, strlen(trim($Final_Bid))-1); //remove the final comma sign
 $Final_Bid = explode(',',$Final_Bid);

for($j=0;$j<count($Final_Bid);$j++)
	{
		$getbankid="select * from Bank_Master where Bank_Name='".$Final_Bid[$j]."'";
		//echo $getbankid;
		
		list($recordcount,$row)=MainselectfuncNew($getbankid,$array = array());
		$cntr=0;
		

		
	while($cntr<count($row))
        {
			$getbankiddetails =$row[$cntr]['BankID'];
			$getbankIDarr[]=$getbankiddetails;
		
		$cntr = $cntr+1;}
	}
//echo count($getbankIDarr)."<br>";
$k=0;
for($k=0;$k<=count($getbankIDarr);$k++)
{
	//echo "hello".$k;
	$bidderarr="";
for($i=0;$i<count($realbankID);$i++)
{// echo "get array".$realbankID[$i].$getbankIDarr[$k]."<br>";
	if($realbankID[$i]==$getbankIDarr[$k])
	{//echo "hello<br>";
		$new[]=$i;
	}
}
//print_r($new);
for($r=0;$r<count($new);$r++)
{
	$bidderarr[]=$selectbidderID[$new[$r]];
}
}
//echo "eligible bidders";
//print_r($bidderarr);
if(count($bidderarr)>0)
	{
$finalybidderarr=@implode(',',$bidderarr);
	}
	else
	{
	$finalybidderarr=$bidderarr;
	}
//echo $finalybidderarr;

		$DataArray = array("checked_bidders"=>$finalybidderarr);
		$wherecondition ="(RequestID='".$requestid."')";
		Mainupdatefunc ($product_reply, $DataArray, $wherecondition);

//getderails
$getfwdetails=("select Net_Salary,City from ".$product_reply." where RequestID='".$requestid."' ");
 list($recordcount,$get)=MainselectfuncNew($getfwdetails,$array = array());

//$get=mysql_fetch_array($getfwdetails);
	}
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
//echo "hello".$_SESSION['temp_net_salary']."<br>".$_SESSION['temp_city']."<br>";
//echo "citibank";
$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($get["Net_Salary"]>=350000) && (in_array($get["City"], $getciticitydetails))>0)
		
		 
		 {
		?>
			
<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px; font-size:13px;">Thanks for your application. We would contact you soon.<br>
		There are some other financial products that are on offer for you on the basis of details you have submitted.
		<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
		 <?
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		 list($recordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$i=0;
		

		while($i<count($myrow))
        {?>
				<td valign="top" >
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$i]["cc_bank_url"])>0) {echo $myrow[$i]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$i]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$i]["cc_bank_url"])>0) {echo $myrow[$i]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$i]["card_image"];?>"  width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td height="325" valign="top" class="crdtext"><? echo $myrow[$i]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td align="center" valign="bottom"><a href="<? if (strlen($myrow[$i]["cc_bank_url"])>0) {echo $myrow[$i]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? $i = $i+1;}?>
			</tr>
		</table>


			 </div>
 <?
  //include '~Right.php';
  
  ?>

      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
 
</body>
</html>
	<? }
	else
	{
		if($product_reply =="Req_Loan_Personal")
		{
		$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
		header("Location: $filename");
		exit();
		}
		if($product_reply =="Req_Loan_Home")
		{
				$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
				header("Location: $filename");
				exit();
		}
	}
	
	
	?>




