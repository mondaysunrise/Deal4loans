<?php
session_start();
	//require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	print_r($_REQUEST);
	//$leadid = $_POST['leadid'];
	$leadid = 	$_REQUEST['pl_requestid'];
	$ProductValue =$leadid ;
	
	$url = "apply_pl_consent.php?pl_requestid=".$leadid."&pl_bank_name=Fullerton";
	header("Location: ".$url);
	exit();
		
 $sqlResdenCheck = "select * from Req_Loan_Personal Where RequestID=".$leadid."";
list($alreadyExist,$queryResdenCheck)=MainselectfuncNew($sqlResdenCheck,$array = array());
$myrowcontr = count($queryResdenCheck)-1;
$Employment_Status= $queryResdenCheck[0]['Employment_Status'];
$Residential_Status =  $queryResdenCheck[0]['Residential_Status'];
$monthsalary =  ($queryResdenCheck[0]['Net_Salary'] / 12 );
$PL_EMI_Amt =  $queryResdenCheck[0]['get-instantquote'];
$getCompany_Name =  $queryResdenCheck[0]['Company_Name'];
$Name =  $queryResdenCheck[0]['Name'];
	

	$max_loan_amount = $_POST['max_loan_amount'];
	$calc_emi = $_POST['calc_emi'];
	$loan_tenure = $_POST['loan_tenure'];
	
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

<title>Personal Loans :: Business Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, compare personal loans, personal loans comparision, online personal loans, Personal Loans India, Personal loans Online, Business Loan, Business Loans, Business Loan India, compare business loans, business loans comparision, online business loans, Business Loans India, Business loans Online">


<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

	<script type="text/javascript" src="ajax.js"></script>

	<script type="text/javascript" src="list.js"></script>

<style type="text/css">body{	margin:0px;	padding:0px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/bgn.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:0px 0px 0px 10px;	padding:0px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:18px; }.imgpostn{	padding-left:31px;	padding-top:10px;	padding-bottom:4px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 
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

    <td width="450" height="75" align="left" valign="top"><a href="http://www.fullertonindia.com/" target="_blank"><img src="images/lft-fullrtonlogo.gif" width="450" height="75" border="0" /></a></td>
    <td colspan="2" height="75">
		<table height="75" width="100%" style="border:#7F6B53 solid 1px;">
		
		<tr>
				<td bgcolor="#E1DAD2" colspan="3" style="font-size:12px; color:#DE6020; border-bottom:#7F6B53 solid 1px;" align="center"><b>Fullerton India Personal Loan Quote</b></td>
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

            <td valign="middle" ><table width="100%"><tr><td height="30" class="hdng-bg" width="81%" align="left" > Thanks for Sharing your information</td>
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