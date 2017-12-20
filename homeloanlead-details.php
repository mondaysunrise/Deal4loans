<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//$requestid=746454;
//$bidderid=1329;
$hldetails = "select Pancard,Existing_Bank,Existing_ROI,Property_Loc,Property_Identified,Property_Value,Employment_Status,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment from Req_Loan_Home Where (RequestID=".$requestid.")";
$hldetailsresult = ExecQuery($hldetails);
$hlrow=mysql_fetch_array($hldetailsresult);


$hl_alldetails = ExecQuery("select * from Req_Feedback_Bidder_HL Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");

$hlrowal=mysql_fetch_array($hl_alldetails);

if($hlrow["Property_Identified"]==0){ $property_identified="No";}
elseif($hlrow["Property_Identified"]==1) { $property_identified="Yes";}
else { $property_identified="";}

if($hlrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan</title>
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
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Home Loan Customer Details</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $hlrow["Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $hlrow["DOB"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><? echo $hlrow["Email"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo $hlrow["Mobile_Number"]; ?></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Pan No: </span></td>
       <td><span class="style21"><? echo $hlrow["Pancard"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $hlrow["Company_Name"]; ?></span></td>
  </tr>
    
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $hlrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><? echo $hlrow["City_Other"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Pincode: </span></td>
       <td><span class="style21"><? echo $hlrow["Pincode"]; ?></span></td>
  </tr>
    
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $hlrow["Net_Salary"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2">Required Loan Amount </span></td>
        <td><span class="style21"><? echo $hlrow["Loan_Amount"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">Property Identified: </span></td>
        <td><span class="style21"><? echo $property_identified; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Property Location: </span></td>
        <td><span class="style21"><? echo $hlrow["Property_Loc"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Property Value: </span></td>
        <td><span class="style21"><? echo $hlrow["Property_Value"]; ?></span></td>
     </tr>
	 
     <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $hlrow["Add_Comment"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? if($hlrowal["Allocation_Date"]){echo $hlrowal["Allocation_Date"];}else {echo date("d-M-Y",strtotime($hlrow["Dated"]));} ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $hlrow["IP_Address"]; ?></span></td>
  </tr>
  <tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">HL BT Details</td></tr>
	 <tr>
        <td><span class="style2">Bank Name: </span></td>
        <td><span class="style21"><? echo $hlrow["Existing_Bank"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Bank ROI: </span></td>
        <td><span class="style21"><? echo $hlrow["Existing_ROI"]; ?></span></td>
     </tr>
</table>

</body>
</html>
