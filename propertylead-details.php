<?php
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
$PropertyID = $_REQUEST["proptyid"];
$hldetails = "select Email,Name,Mobile_Number,City,Add_Comment,City_Other,Dated from Req_Loan_Home Where (RequestID=".$requestid.")";
$hldetailsresult = ExecQuery($hldetails);
$hlrow=mysql_fetch_array($hldetailsresult);

$hl_alldetails = ExecQuery("select * from Req_Feedback_Property Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
$hlrowal=mysql_fetch_array($hl_alldetails);

$proptyhl_alldetails = ExecQuery("select * from property_details_hl Where (PID =".$PropertyID." and AgentID=".$bidderid.")");
$hlrowprop=mysql_fetch_array($proptyhl_alldetails);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
</head>
<body>
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Home Loan Customer Details</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $hlrow["Name"]; ?></span></td>
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
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $hlrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><? echo $hlrow["City_Other"]; ?></span></td>
  </tr>
      <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $hlrow["Add_Comment"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $hlrow["Dated"]; ?></span></td>
  </tr>
  <tr>
  <td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Property Details</td>
  </tr>
  <tr>
	<td class="style2">Property City</td>
	<td class="style21"><? echo $hlrowprop["City"]; ?></td>
  </tr>
  <tr>
	<td class="style2">Title</td>
	<td class="style21"><? echo $hlrowprop["Title"]; ?></td>
  </tr>
  <tr>
	<td class="style2">Builder Name</td>
	<td class="style21"><? echo $hlrowprop["BuilderName"]; ?></td>
  </tr>
  <tr>
	<td class="style2">Price</td>
	<td class="style21"><? echo $hlrowprop["Price"]; ?></td>
  </tr>
  <tr>
	<td class="style2">Rate</td>
	<td class="style21"><? echo $hlrowprop["Rate"]; ?></td>
  </tr>
  <tr>
	<td class="style2">Covered Area</td>
	<td class="style21"><? echo $hlrowprop["CoveredArea"]; ?></td>
  </tr>
 </table>

</body>
</html>
