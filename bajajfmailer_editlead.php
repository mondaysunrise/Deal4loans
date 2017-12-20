<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}

if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168"  || $IP=="182.71.109.218")
			{
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$bajajf_name = $_POST["bajajf_name"];
		$bajajf_dob = $_POST["bajajf_dob"];
		$bajajf_email = $_POST["bajajf_email"];
		$bajajf_mobile = $_POST["bajajf_mobile"];
		$bajajf_company_name = $_POST["bajajf_company_name"];
		$bajajf_city = $_POST["bajajf_city"];
		$bajajf_city_other = $_POST["bajajf_city_other"];
		$bajajf_panno = $_POST["bajajf_panno"];
		$bajajf_net_salary = $_POST["bajajf_net_salary"];
		$bajajf_loan_amount = $_POST["bajajf_loan_amount"];
		$residence_address = $_POST["residence_address"];
		$office_address = $_POST["office_address"];
		$office_landline = $_POST["office_landline"];
		$office_email = $_POST["office_email"];
		$marital_status = $_POST["marital_status"];
		$residence_type = $_POST["residence_type"];
		$current_experience = $_POST["current_experience"];
		$total_experience = $_POST["total_experience"];


		$bajajfsquery="Update bajaj_finserv_mailer_leads set bajajf_name='".$bajajf_name."', bajajf_dob='".$bajajf_dob."', bajajf_email='".$bajajf_email."', bajajf_mobile='".$bajajf_mobile."', bajajf_company_name='".$bajajf_company_name."', bajajf_city='".$bajajf_city."', bajajf_city_other='".$bajajf_city_other."', bajajf_panno='".$bajajf_panno."', bajajf_net_salary='".$bajajf_net_salary."',  bajajf_loan_amount='".$bajajf_loan_amount."', residence_address='".$residence_address."', office_address='".$office_address."', office_landline='".$office_landline."', office_email='".$office_email."', marital_status='".$marital_status."', residence_type='".$residence_type."', current_experience='".$current_experience."', total_experience='".$total_experience."' where (bajaj_finservid=".$requestid.")";
		$bajajfsresult=ExecQuery($bajajfsquery);

}

$pldetails = "select * from  bajaj_finserv_mailer_leads Where (bajaj_finservid=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);

$url =$_SERVER['PHP_SELF']."?postid=".$requestid."&biddt=".$bidderid;
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
<form name="bajajmailer" method="POST" action="<? echo $url; ?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><input type="type" name="bajajf_name" id= "bajajf_name" value="<? echo $plrow["bajajf_name"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><input type="type" name="bajajf_dob" id= "bajajf_dob" value="<? echo $plrow["bajajf_dob"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><input type="type" name="bajajf_email" id= "bajajf_email" value="<? echo $plrow["bajajf_email"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><input type="type" name="bajajf_mobile" id= "bajajf_mobile" value="<? echo $plrow["bajajf_mobile"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><input type="type" name="bajajf_company_name" id= "bajajf_company_name" value="<? echo $plrow["bajajf_company_name"]; ?>"></span></td>
  </tr>
  <tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><input type="type" name="bajajf_city" id= "bajajf_city" value="<? echo $plrow["bajajf_city"]; ?>"></span></td>
  </tr> 
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><input type="type" name="bajajf_city_other" id= "bajajf_city_other" value="<? echo $plrow["bajajf_city_other"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Pan No: </span></td>
       <td><span class="style21"><input type="type" name="bajajf_panno" id= "bajajf_panno" value="<? echo $plrow["bajajf_panno"]; ?>"></span></td>
  </tr>
          <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input type="type" name="bajajf_net_salary" id= "bajajf_net_salary" value="<? echo $plrow["bajajf_net_salary"]; ?>"></span></td>
  </tr>
      <tr>
        <td><span class="style2"> Loan Amount: </span></td>
        <td><span class="style21"><input type="type" name="bajajf_loan_amount" id= "bajajf_loan_amount" value="<? echo $plrow["bajajf_loan_amount"]; ?>"></span></td>
  </tr>
    <tr>
        <td><span class="style2"> Residence Address: </span></td>
        <td><span class="style21"><input type="type" name="residence_address" id= "residence_address" value="<? echo $plrow["residence_address"]; ?>"></span></td>
  </tr>
   <tr>
		<td><span class="style2"> Office Address: </span></td>
        <td><span class="style21"><input type="type" name="office_address" id= "office_address" value="<? echo $plrow["office_address"]; ?>"></span></td>
  </tr>
  <tr>
		<td><span class="style2"> Office Landline </span></td>
        <td><span class="style21"><input type="type" name="office_landline" id= "office_landline" value="<? echo $plrow["office_landline"]; ?>"></span></td>
  </tr>
   <tr>
		<td><span class="style2"> Office Email </span></td>
        <td><span class="style21"><input type="type" name="office_email" id= "office_email" value="<? echo $plrow["office_email"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Marital Status: </span></td>
        <td><span class="style21"><input type="radio" value="1" name="marital_status" id="marital_status" <? if($plrow["marital_status"]==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="2" name="marital_status"  id="marital_status" class="NoBrdr" <?if($plrow["marital_status"]==2){ echo "checked";}?>>No</span></td>
     </tr>
     <tr>
        <td><span class="style2">Residence Type</span></td>
        <td><span class="style21"><input type="type" name="residence_type" id= "residence_type" value="<? echo $plrow["residence_type"]; ?>"></span></td>
     </tr>
	  <tr>
        <td><span class="style2">Current Expeience</span></td>
        <td><span class="style21"><input type="type" name="current_experience" id= "current_experience" value="<? echo $plrow["current_experience"]; ?>"></span></td>
     </tr>
	  <tr>
        <td><span class="style2">Total Experience</span></td>
        <td><span class="style21"><input type="type" name="total_experience" id= "total_experience" value="<? echo $plrow["total_experience"]; ?>"></span></td>
     </tr>	  	 	
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $plrow["bajajf_dated"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $plrow["IP_Address"]; ?></span></td>
  </tr>
  <tr>
   <td colspan="2" align="center"><input type="submit" class="bluebutton" value="Submit"> </td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>