<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//$requestid=80169;
//$bidderid=3706;
$lapdetails = "select Employment_Status,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment from Req_Loan_Against_Property Where (RequestID=".$requestid.")";
$lapdetailsresult = ExecQuery($lapdetails);
$laprow=mysql_fetch_array($lapdetailsresult);

$lap_alldetails = ExecQuery("select * from Req_Feedback_Bidder_LAP Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");

$laprowal=mysql_fetch_array($lap_alldetails);

if($laprow["Property_Identified"]==0){ $property_identified="No";}
elseif($laprow["Property_Identified"]==1) { $property_identified="Yes";}
else { $property_identified="";}

if($laprow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loan Against Property</title>
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
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Loan Against Property Customer Details</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $laprow["Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $laprow["DOB"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><? echo $laprow["Email"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo $laprow["Mobile_Number"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $laprow["Company_Name"]; ?></span></td>
  </tr>
    
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $laprow["City"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><? echo $laprow["City_Other"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Pincode: </span></td>
       <td><span class="style21"><? echo $laprow["Pincode"]; ?></span></td>
  </tr>
    
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $laprow["Net_Salary"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2">Required Loan Amount </span></td>
        <td><span class="style21"><? echo $laprow["Loan_Amount"]; ?></span></td>
     </tr>
    
     <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $laprow["Add_Comment"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $laprowal["Allocation_Date"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $laprow["IP_Address"]; ?></span></td>
  </tr>
</table>

</body>
</html>
