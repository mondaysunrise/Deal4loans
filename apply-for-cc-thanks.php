<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';
	error_reporting();
//print_r($_POST);
	$page_Name = "LandingPage_PL";
function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }


$ProductValue = $_SESSION['Temp_LID'];
if($ProductValue>0)
{
	$getccdtls="Select Name,Mobile_Number,Email,ABMMU_flag,Net_Salary,City,City_Other From Req_Credit_Card Where Req_Credit_Card.RequestID=".$ProductValue;
	list($GetnumVal,$ccrow)=Mainselectfunc($getccdtls,$array = array());
	
	$full_name= $ccrow['Name'];
	$Mobile_Number= $ccrow['Mobile_Number'];
	$Email= $ccrow['Email'];
	$Net_Salary= $ccrow['Net_Salary'];
	$City= $ccrow['City'];
	$City_Other= $ccrow['City_Other'];
	$ABMMU_flag_vl = $ccrow["ABMMU_flag"];

	list($strFirst,$strLast) = split('[ ]', $full_name);
if(strlen($strFirst)>25)
		{
			$shrtfname=strlen($strFirst)-25;
			$First = substr(trim($strFirst), 0, strlen(trim($strFirst))-$shrtfname);

		}
		else
		{
			$First =$strFirst;
		}
if(strlen($strLast)>25)
		{
			$shrtlname=strlen($strLast)-25;
			$Last = substr(trim($strLast), 0, strlen(trim($strLast))-$shrtlname);

		}
		else
		{
			$Last =$strLast;
		}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you Credit Card</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
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
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script language="javascript">
function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}

function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
}


var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
function insertData(id)
		{
			//alert(id);
			var crd_nme = document.getElementById('crd_nme_'+ id).value;
			var prdct_id = document.getElementById('prdct_id').value;
			var queryString = "?crd_nme=" + crd_nme +"&prdct_id=" + prdct_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert_card_name.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					/*if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}*/
				}

				ajaxRequestMain.send(null); 
			 
		}

	window.onload = ajaxFunctionMain;
</script>
<style>
.crd_colm { font-family:verdana; font-size:11px; color:#000000; font-weight:bold; border-right:1px solid #fe7e00; background-color:#FDD57E;
}
.crd_colm_txt { style="font-family:verdana; font-size:11px; color:#000000; font-weight:bold; border-right:1px solid #fe7e00;}
</style>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div style="margin:auto; width:970px; height:5px; background-color:#88a943; margin-top:1px;"></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px; color:#ae4212">
  <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Credit Card through Deal4loans.com. </h1>
   <?php
//print_r($_SESSION);
//echo  $Net_Salary;
	//echo "sssssssssssssssssss<br><br>".$getccdtls;
   if($Net_Salary>=144000)
   {
	  
   $selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) ORDER BY cc_priority ASC";
//	echo  $selectccbanks."<br>";
list($rowscount,$row)=Mainselectfunc($selectccbanks,$array = array());

if($rowscount >0)
{
		
	?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px; color:#00000;">
You are Eligible for following cards.Choose from the offers below and Apply  at Banks Link for  the best Credit Card as per you !!!</div>
<div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	 <table width="950" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
      
      <td width="93" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Card Name </td>
      <td width="150" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Image </td>
      <td width="79" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Annual Fee</td>
      <td width="99" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Interest (p.m) </td>
    <td width="205" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Features</td>
	<td width="166" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Aprox time to Complete application form</td>
	  
      <td width="154" height="25" align="center" valign="middle" style="font-family:verdana; font-size:12px; color:#000000; font-weight:bold; " class="crd_colm">Apply </td>
     
    </tr>
  <?php
 
	
$r=0;
$i=1;
$strcc_bankid="";
	  while($row)
    {
	
	//echo $cc_bank_name  = $row["cc_bank_name"];
       $cc_bank_query  = $row["cc_bank_query"];
	
	   if($source=="QuickApply")
	   {	   
	   	$cc_bank_query  = $row["other_query"];
	   }
	   
	   
		$cc_bankid  = $row["cc_bankid"];
		$cc_bank_url  = $row["cc_bank_url"];
		if($_SESSION['siten']=="ndtv")
		{
			$cc_bank_url  = $row["cc_bank_url_ndtv"];
		}
		
	  $qry2 = $cc_bank_query." and Req_Credit_Card.RequestID ='".$ProductValue."'";

		list($recordcount,$getrow)=Mainselectfunc($qry2,$array = array());
		if($recordcount>0)
		 {
			$strcc_bankid[] = $cc_bankid;
			
		while($getrow = mysql_fetch_array($result1))
		for($ii=0;$ii<$recordcount;$ii++)
		{
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid.") ";
			
			list($getrecordcount,$get_Bankresult)=Mainselectfunc($get_Bank,$array = array());
		
//echo $i;
  for($j=0;$j<$getrecordcount;$j++)
 { 
	  //echo $cc_bankid."<br>";

if($cc_bankid==12)

	{
	?>
	
<? }
	  else
	  {
	  ?>
	   <input type="hidden" name="prdct_id" id="prdct_id" value="<? echo $ProductValue;?>">
	  
    <tr>
      <? if($cc_bankid==20)
		  { ?>
<td width="93" height="85" align="center" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><b><? $cc_bank_name = $get_Bankresult[$j]['cc_bank_name']; ?><? 
		echo $cc_bank_name; ?></b></td>
		  <? } else 
		  { ?>
      <td width="93" height="85" align="center" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><? $cc_bank_name = $get_Bankresult[$j]['cc_bank_name']; ?><input type="hidden" name="crd_nme_<? echo $i; ?>" id="crd_nme_<? echo $i; ?>" value="<? echo $cc_bank_name; ?>"> <b><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><? 
		echo $cc_bank_name; ?></a></b></td>
		<? } ?>
      <td width="150" height="85" align="center" valign="middle" style="border-right:1px solid #fe7e00; color:#000000; padding-top:3px;"><? $card_image =$get_Bankresult[$j]['card_image'];
			  
		?>
		<? if(strlen($card_image)>0)
		  {  if(($cc_bankid==5 || $cc_bankid==7 || $cc_bankid==8 || $cc_bankid==9))
			  {
			?>
		<img src="/<? echo $card_image;?>"  width="53" height="84"/>
		<? }
			else if ($cc_bankid==18)
			  { ?>
			  <img src="/<? echo $card_image;?>"  />
			  <? }
			  else
			  {?>
		<img src="/<? echo $card_image;?>"  width="140" height="84"/>
		<? }
		  }
		else {
echo $cc_bank_name;
		}?>		</td>
      <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><b><? $cc_bank_fee =$get_Bankresult[$j]['cc_bank_fee'];	echo "Rs.".$cc_bank_fee;	?></b></td>
      <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><b><? $cc_bank_rates =$get_Bankresult[$j]['cc_bank_rates'];	echo $cc_bank_rates;	?></b></td>
     <td height="85" align="center" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;">   <? echo $cc_bank_features = $get_Bankresult[$j]['cc_bank_new_features'];?></td>
	 <td height="85" align="center" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><? echo $cc_bank_features = $get_Bankresult[$j]['cc_application_time'];?></td>
      <td height="85" align="center" >	
	  <? 
			if($cc_bankid==13)

		  {	
		  
		  ?>
          <a href="<? echo $cc_bank_url;?>" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
					<? 
			}
			else if($cc_bankid==19)
			{
			?>
			<a href="<? echo $cc_bank_url;?>" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
			<?php
			}
			else if (($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15))
		  { ?>
			<form action="apply-hdfc-credit-card1.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
		  <? }
		else if ($cc_bankid==20)
		  { ?>
			<form action="dcb_payless_credit_card.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
		  <? }
			else
		  {
		  if($cc_bankid==14)
		  	{	?>
		<form action="barclays-platinum-card.php" method="POST" target="_blank" >
		  <input type="hidden" name="Reference_Code" value="<? echo $Reference_Code;?>">
		  <input type="hidden" name="RequestID" value="<? echo $ProductValue;?>">
		  <div style="padding-bottom:5px; color:#AE4212; font-weight:bold;">&nbsp;</div> 
		  <input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); background-repeat:no-repeat; margin-bottom: 0px; " value="" onClick="insertData(<? echo $i;?>);"/></form>
					<? 
			}
			else
			{
		    ?>		  
				<a href="<? echo $cc_bank_url;?>" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
				<? 
				}
				} ?></td>
	 
    </tr>
	
    <tr>
      <td height="3" colspan="8" align="center" valign="middle" style="background:url(/new-images/cc/crd-line.jpg);"></td>
	  <td width="3" height="3" align="left" valign="middle" style="background:url(/new-images/cc/crd-line.jpg);"></td>
    </tr>
 
	   
<?
}
}


}
?>

	<?
	//print_r($strcc_bankid);
	if(count($strcc_bankid)>1)
				 {
		$arrcc_bankid=implode(',',$strcc_bankid);

$DataArray = array("Eligible_Card_Option" =>$arrcc_bankid);
$wherecondition ="(RequestID='".$ProductValue."')";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

				 }
	 }//if
	 $i=$i+1;
	}
if($Net_Salary>=800000 && ($City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad" || $City=="Greater Noida" || $City=="Thane" || $City=="Navi Mumbai" || $City=="Bangalore" ||  $City=="Chennai" || $City=="Mumbai"))
	{ ?>

	<? } ?>
   </table> 
</td>
  </tr>
  <tr><td style="padding-top:30px;"> <?php if($ABMMU_flag_vl==1)
  { 
	 
	  $inptstr="Id=".$ProductValue."&Lead=Deal&fname=".$First."&lname=".$Last."&emailid=".$Email."&dob=&ext=extra&no=".$Mobile_Number;
$outputstr = base64_encode($inptstr);

	  ?>
  <table align="center">
  <tr>
    <td valign='top'  class='tbl_txt' style='font-weight:bold;font-size:14px;' align="center" >Please Continue to complete the Registeration Process (90 days free trial of MyUniverse)</td>
  </tr>
  <tr><td align="center">  <img src="../new-images/ajax-loader.gif" width="220" height="19" /></td></tr></table>

  	<iframe width="960" height="700" src="https://www.myuniverse.co.in/sitepages/newregistration.aspx?otptstr=<? echo $outputstr; ?>" frameborder="1"> </iframe>
  <? } ?>
  
  
  </td></tr>
</table>
  <span class="crd_colm_txt" style="border-right:1px solid #fe7e00;"><? echo $cc_bank_features = $get_Bankresult[$j]['cc_application_time'];?></span></div>
 	<? 
    }
  else
	   {
 ?>   
 <p>
 <div align="left" style="padding-bottom:20px;">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px;" class="tbl_txt">
<strong>Dear Customer</strong>,<br />
Thank you for choosing Deal4Loans.com as your preferred Personal Financial Solution partner.<br />
We are sorry to inform you that currently there are no offers matching as per your profile.<br />
Our teams are continuously working towards getting better deals for our customers.<br />
</span></div>
</p>  
       
<?php	   
if($ABMMU_flag_vl==1)
  { 
	  $inptstr="Id=".$ProductValue."&Lead=Deal&fname=".$First."&lname=".$Last."&emailid=".$Email."&dob=&ext=extra&no=".$Moblie_Number;
$outputstr = base64_encode($inptstr);

	  ?>
  <table align="center">
  <tr>
    <td valign='top'  class='tbl_txt' style='font-weight:bold;font-size:14px;' align="center" >Please Continue to complete the Registeration Process (90 days free trial of MyUniverse)</td>
  </tr>
  <tr><td align="center">  <img src="../new-images/ajax-loader.gif" width="220" height="19" /></td></tr></table>

  	<iframe width="960" height="700" src="https://www.myuniverse.co.in/sitepages/newregistration.aspx?otptstr=<? echo $outputstr; ?>" frameborder="1"> </iframe>
<?   } else
			 {
  
		$filename = "Contents_Credit_Card_Mustread.php";
						header("Location: $filename");
						exit();}
	   }
   }
	 else
		 {
	  ?>
<p>
<div align="left" style="padding-bottom:20px;">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px;" class="tbl_txt">
<strong>Dear Customer</strong>,<br />
Thank you for choosing Deal4Loans.com as your preferred Personal Financial Solution partner.<br />
We are sorry to inform you that currently there are no offers matching as per your profile.<br />
Our teams are continuously working towards getting better deals for our customers.<br />
</span></div>
</p>  
<?php
if($ABMMU_flag_vl==1)
  { 
	  $inptstr="Id=".$ProductValue."&Lead=Deal&fname=".$First."&lname=".$Last."&emailid=".$Email."&dob=&ext=extra&no=".$Moblie_Number;
$outputstr = base64_encode($inptstr);

	  ?>
  <table align="center">
  <tr>
    <td valign='top'  class='tbl_txt' style='font-weight:bold;font-size:14px;' align="center" >Please Continue to complete the Registeration Process (90 days free trial of MyUniverse)</td>
  </tr>
  <tr><td align="center">  <img src="../new-images/ajax-loader.gif" width="220" height="19" /></td></tr></table>

  	<iframe width="960" height="700" src="https://www.myuniverse.co.in/sitepages/newregistration.aspx?otptstr=<? echo $outputstr; ?>" frameborder="1"> </iframe>
<?   } //else
		//	 {
  
	//	$filename = "Contents_Credit_Card_Mustread.php";
		//				header("Location: $filename");
			//			exit();}
	 }
		 ?>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>
