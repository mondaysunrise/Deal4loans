<?php
session_start();
	//require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	print_r($_REQUEST);
	//$leadid = $_REQUEST['leadid'];
	$leadid = 	$_REQUEST['pl_requestid'];
	$ProductValue =$leadid ;
		
$sqlResdenCheck = "select * from Req_Loan_Personal Where RequestID=".$leadid."";
list($NumRows,$queryResdenCheck)=MainselectfuncNew($sqlResdenCheck,$array = array());
$Employment_Status= $queryResdenCheck[0]['Employment_Status'];
//$DOB =  $queryResdenCheck[0]['DOB'];
//$strDOB = str_replace("-","",$DOB);
//$age = DetermineAgeGETDOB($strDOB);
$Residential_Status =  $queryResdenCheck[0]['Residential_Status'];
$monthsalary =  ($queryResdenCheck[0]['Net_Salary']) / 12 ;
$PL_EMI_Amt =  $queryResdenCheck[0]['get-instantquote'];
$getCompany_Name =  $queryResdenCheck[0]['Company_Name'];
$Name =  $queryResdenCheck[0]['Name'];
	

	$max_loan_amount = $_REQUEST['max_loan_amount'];
	$calc_emi = $_REQUEST['calc_emi'];
	$loan_tenure = $_REQUEST['loan_tenure'];
	
	$Reference_Code = generateNumber(4);
	
	$app_code = date('dmy')."".$Reference_Code;
	
	$leadid = $ProductValue;
	$RequestID = $ProductValue;
	$_SESSION['Temp_LID'] = $ProductValue;

	
	
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Personal Loans</title>

<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, compare personal loans, personal loans comparision, online personal loans, Personal Loans India, Personal loans Online, Business Loan, Business Loans, Business Loan India, compare business loans, business loans comparision, online business loans, Business Loans India, Business loans Online">

<meta name="description" content="Personal Loan – Get Personal loan quotes, compare personal loans online, Best interest rates and EMI from all major personal loan banks.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

	<script type="text/javascript" src="ajax.js"></script>

	<script type="text/javascript" src="list.js"></script>

<style type="text/css">body{	margin:0px;	padding:0px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/bgn.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:0px 0px 0px 10px;	padding:0px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:18px; }.imgpostn{	padding-left:31px;	padding-top:10px;	padding-bottom:4px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-top:22px solid #d1001f;	background-color:#003871;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 
    .btnclr {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: bold;
    height: 40px;
    width: 210px;
}

.btnclr1 {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: bold;
    height: 40px;
    width: 180px;
}

</style>

	
</head>
<body>
<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="75" ><table width="1004" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="450" height="75" align="left" valign="top"><a href="http://www.fullertonindia.com/" target="_blank"><img src="images/citibanklogo.jpg" width="450" height="75" border="0" /></a></td>
    <td colspan="2" height="75">
		<table height="75" width="100%" style="border:#7F6B53 solid 1px;">
		
		<tr>
				<td bgcolor="#ffffff" colspan="3" style="font-size:12px; color:#DE6020; border-bottom:#7F6B53 solid 1px;" align="center"><b>Citibank Personal Loan Quote</b></td>
			</tr>
			<tr>
				<td style="color:#7F6B53; font-size:11px; border-right:#7F6B53 solid 1px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Max Loan Amount</b></td><td style="color:#7F6B53; font-size:11px; border-right:#7F6B53 solid 1px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Per Month EMI </b></td><td style="color:#7F6B53; font-size:11px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Tenure</b></td>
			</tr>
			<tr>
				<td style=" border-right:#7F6B53 solid 1px; font-weight:normal; font-size:11px;" align="center"><? echo $max_loan_amount; ?></td><td style=" border-right:#7F6B53 solid 1px; font-weight:normal; font-size:11px;" align="center"><? echo $calc_emi; ?></td><td align="center" style="font-size:11px;"><? echo $loan_tenure; ?> yrs</td>
			</tr>
		</table>
	</td>

  </tr>

</table>

</td>

  </tr>

  <tr>

    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td valign="middle" ><table width="100%"><tr><td height="30" class="hdng-bg" width="81%" align="left" > Share your information</td>
                <td width="19%" height="30" align="center" class="hdng-bg">&nbsp;</td>
                </tr></table></td>

          </tr>

          <tr>

            <td  ><table width="980" border="0" align="center" cellpadding="0" cellspacing="0">

		          <tr>

                <td >
                
                <table width="966" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="955" valign="top" class="frmbg">

<form name="loan_form" method="post" action="get-citibankquote-thanks.php" onSubmit="return submitform(document.loan_form);" enctype="multipart/form-data">

<input type="hidden" name="max_loanamt" value="<?php echo $max_loan_amount ; ?>" />

<input type="hidden" name="permonemi" value="<?php echo $calc_emi ; ?>" />

<input type="hidden" name="tene" value="<?php echo $loan_tenure ; ?>" />

<input type="hidden" name="RequestID" value="<?php echo $RequestID ; ?>" />
<div align="center" style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></div>

		<table width="90%"  border="0" align="center" cellpadding="4" cellspacing="6">

  <tr >

    <td height="45" colspan="2" class="frmtxt">Dear <?php echo $Name; ?>,</td>
      
  </tr>
<tr>
	<td height="26" align="left" valign="top" class="frmtxt" colspan="2">Select one document in each section below that you will provide as proof</td>
      
  </tr>
  
  <tr>
	<td width="387" height="26" align="right" valign="top" class="frmtxt" >Proof of Income</td>
	<td width="438" ><select name="Income_Proof" id="Income_Proof"style="width:210px;" >
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>

    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option></select></td>

  </tr>
  <tr>
	<td height="26" align="right" valign="top" class="frmtxt">Proof of Address</td>
    <td>
    <select name="Address_Proof" id="Address_Proof" style="width:210px;">
    <option value="">Select</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)">Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>

    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Letter from Employer certifying current mailing address">Letter from Employer certifying current mailing address</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Registered Rental / Lease Agreement">Registered Rental / Lease Agreement</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>

    <option value="Passbook">Passbook</option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Driving License">Driving License</option>
    <option value="Loan repayment track record">Loan repayment track record</option>
    <option value=" Registration certificate (RC) of 4-wheeler in applicant's name"> Registration certificate (RC) of 4-wheeler in applicant's name</option>
</select></td>

  </tr>
   <tr>
	<td height="26" align="right" valign="top" class="frmtxt">Proof of Identity</td>

	<td ><select name="Identity_Proof" id="Identity_Proof"  style="width:210px;">
    <option value=""
    >Select</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Driving License">Driving License</option>
    <option value="Photo Credit/Debit/ATM Card">Photo Credit/Debit/ATM Card</option>
    <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>

    <option value="PAN Card">PAN Card</option>
    <option value="Company ID card">Company ID card</option>
    <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Home property papers (registered deed">Home property papers (registered deed</option>
    <option value="Registration certificate (RC) of vehicle in applicant's name">Registration certificate (RC) of vehicle in applicant's name</option></select></td>

  </tr>
   <tr>
	<td height="26" align="right" valign="top" class="frmtxt">Bank Statement</td>

	<td ><select name="Bank_Statement" id="Bank_Statement"  style="width:210px;" >
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
</select></td>

  </tr> 

  <tr valign="bottom">

    <td height="40" colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;">
    <input name="appointment" type="submit" class="btnclr1" value="Fix an Appointment" />
&nbsp;&nbsp;or&nbsp;&nbsp;
    <input name="upload" type="submit" class="btnclr" value="Upload Documents Online" /></td>
 
    </tr>

 
</table>

			</form>

			</td>

            <td width="11" class="frmrgtbrdr">&nbsp;</td>

          </tr>

        </table>
                
                </td>
             </tr>

            </table></td>

          </tr>

        </table></td>

       

      </tr>

    </table></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

</table>

<?php include "analtyics.php"; ?>

</body>

</html>