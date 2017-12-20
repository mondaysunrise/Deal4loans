<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//$requestid =637852;
//$bidderid = 2009;
$ccdetails = "select No_of_Banks,Account_No,Pancard_No,Pancard,Employment_Status,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address from Req_Credit_Card Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);


$cc_alldetails = ExecQuery("select * from Req_Feedback_Bidder_CC Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
//echo $ccdetails."<br>";
$ccrowal=mysql_fetch_array($cc_alldetails);

if($ccrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if($ccrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($ccrow["CC_Holder"]==0) { $cc_holder="No"; }
		
			
			if($ccrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($ccrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($ccrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($ccrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
</head>

<body>
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Credit Card customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $ccrow["Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $ccrow["DOB"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><? echo $ccrow["Email"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo $ccrow["Mobile_Number"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $ccrow["Company_Name"]; ?></span></td>
  </tr>
     
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $ccrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><? echo $ccrow["City_Other"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Pincode: </span></td>
       <td><span class="style21"><? echo $ccrow["Pincode"]; ?></span></td>
  </tr>
     <tr><td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
     <tr>
        <td width="32%" class="style2"> Card Holder: </td>
        <td width="25%" class="style21"><? echo $cc_holder; ?></td>
        <td width="23%" class="style2">Card Vintage: </td>
        <td width="20%" class="style21"><? echo $card_vintage; ?></td>
     </tr>
     </table></td>
  </tr>
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $ccrow["Net_Salary"]; ?></span></td>
  </tr>
     <tr>
        <td width="180"><span class="style2">Pancard </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["Pancard"]; ?></span></td>
  </tr>
  
    <tr>
        <td width="180"><span class="style2">Residence Address </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["Residence_Address"]; ?></span></td>
  </tr>
  
     <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $ccrow["Add_Comment"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $ccrowal["Allocation_Date"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["IP_Address"]; ?></span></td>
  </tr>
  
</table>

</body>
</html>
