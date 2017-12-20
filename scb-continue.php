<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	print_r($_POST);
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB = $year."-".$month."-".$day;
	$gender = $_POST['gender'];
	
	$qualification = $_POST['qualification'];
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$city = $_POST['City'];
	$pincode = $_POST['pincode'];
	$company_name = $_POST['Company_Name'];
	$designation = $_POST['designation'];
	$pancard = $_POST['Pancard'];
	
	$qualification = $_POST['qualification'];
	$income_proof = $_POST['income_proof'];
	$Net_Salary = $_POST['IncomeAmount'];
	$existing_customer = $_POST['existing_customer'];
	$Dated = ExactServerdate();
	
	if($existing_customer==1)
	{
		$existing_customer="yes";
	}
	else
	{
		$existing_customer="no";
	}
	$RequestID = $_POST['RequestID'];
	$pancardLater = $_POST['panCardLater'];
	$Reference_Code = $_POST['validateMobile'];
	if($pancardLater=='on')
	{
		$pancardLater=1;
	}
	$Descr = $_POST['Descr'];
	$Activate = generateNumber(4);
	$app_code = date('dmy')."".$Activate;
	
	$chekValid = ("select Reference_Code,Mobile_Number from Req_Credit_Card Where (RequestID='".$RequestID."')");
 	list($recordcount,$getrow)=MainselectfuncNew($chekValid,$array = array());
	$cntr=0;

	$chekValidValue = $getrow[$cntr]['Reference_Code'];
	if($Reference_Code==$chekValidValue)
	{
		$Is_Valid = 1;
	}
	$DataArray = array("Is_Valid"=>$Is_Valid);
	$wherecondition ="(Req_Credit_Card.RequestID=".$RequestID.")";
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

$dataInsert = array("RequestID"=>$RequestID, "fname"=>$fname, "mname"=>$mname, "lname"=>$lname, "gender"=>$gender, "qualification"=>$qualification, "address1"=>$add1, "address2"=>$add2, "city"=>$city, "pincode"=>$pincode, "company_name"=>$company_name, "designation"=>$designation, "pancard"=>$pancard, "pancardLater"=>$pancardLater, "Net_Salary"=>$Net_Salary, "existing_customer"=>$existing_customer, "Dated"=>$Dated, "RedID"=>$app_code, "DOB"=>$DOB, "Descr"=>$Descr);
$table = 'pl_stanc_leads';
$insert = Maininsertfunc ($table, $dataInsert);
  


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Standard Charterd</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stanccompanies.js"></script>
<style>
/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	
.formfield
{
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
color:#FFFFFF;
margin-top:4px;
}
.w175{width: 175px;}
.w230{width: 230px;}
</style>
</head>
<body>
<?php

//$Phone= 9971396361;
	//$lastInserted = 498279;
	$sql = "SELECT * FROM Req_Credit_Card where RequestID='".$lastInserted."'";
	 list($rowcount,$Arrrow)=MainselectfuncNew($sql,$array = array());
		$i=0;
	
	$Name = $Arrrow[$i]['Name'];
	list($fname, $lname) = split(' ', $Name);
	$DOB = $Arrrow[$i]['DOB'];
	list($year, $month, $day) = split('[/.-]', $DOB);
	$City = $Arrrow[$i]['City'];
	$Mobile_Number = $Arrrow[$i]['Mobile_Number'];
	$Net_Salary = $Arrrow[$i]['Net_Salary'];
	$Company_Name = $Arrrow[$i]['Company_Name'];
?>
<form name="loan_form" method="post" action="scb.php" onSubmit="return submitform(document.loan_form);" enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td align="center">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td colspan="2"><img src="new-images/top_band.jpg" /></td></tr>
<tr><td><img src="new-images/stan_chart_logo.jpg" /></td><td align="right" valign="bottom"><!--<img src="new-images/credit-card-text.png" /> --><img src="new-images/poweredby.png" /></td></tr>
<tr><td colspan="2" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; background-color:#37aa4d; font-size:12px; font-weight:bold;">&nbsp;</td>
</tr>
<tr><td colspan="2" bgcolor="#0b5d94" >
<table width="940" border="0" cellpadding="3" cellspacing="0">
<tr><td width="937" colspan="2" align="center">
<div  style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; text-align:center; line-height:20px;"></div>
<div  style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-weight:bold; text-align:center; font-size:16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <p>Thank You for applying for Standard Chartered Credit Card</p>

  <p>Your Application Reference is <?php echo $app_code; ?></p>
  <p>Our representative will call you shortly</p>
</div>
</td></tr>
<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>



<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
</tr>
<tr><td colspan="2" align="left">&nbsp;</td>
</tr>

</table>
</td></tr>

</table>
</td></tr></table>
</form>
</body>
</html>
