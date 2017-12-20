<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebiddersiciciApp.php';
	$ProductValue = $_POST['ProductValue'];
	$finalLoanAmount = $_POST['finalLoanAmount'];
	$intr_rate = $_POST['intr_rate'];
	$proc_fee = $_POST['proc_fee'];
	$Tenure=$_REQUEST['Tenure'];
	$emiperlac = $_POST['emiperlac'];
	$app_code=$_REQUEST['app_code'];

	$residence_address = $_POST['residence_address'];
	$office_address = $_POST['office_address'];
	$pincode = $_POST['pincode'];
	$home_std = $_POST['home_std'];
	$home_phone = $_POST['home_phone'];
	$Designation = $_POST['Designation'];
	$Pancard = $_POST['Pancard'];
	$office_std = $_POST['office_std'];
	$office_phone = $_POST['office_phone'];
	$office_ext = $_POST['office_ext'];
	$Primary_Acc = $_POST['Primary_Acc'];
	$Credit_Limit = $_POST['Credit_Limit'];
	$Reference_Code = $_POST['validateMobile'];	
	$chekValid = ("select Reference_Code from pl_icici_leads Where (RequestID='".$ProductValue."')");
	list($recordcount,$row)=MainselectfuncNew($chekValid,$array = array());
	$chekValidValue = $row[0]['Reference_Code'];

	if($Reference_Code==$chekValidValue)
	{
		$Is_Valid = 1;
	}
 
	$dataUpdate = array('Residence_Address'=>$residence_address,  'Pincode'=>$pincode, 'Landline'=>$home_phone, 'Pancard'=>$Pancard, 'Designation'=>$Designation, 'Off_Landline'=>$office_phone, 'Primary_Acc'=>$Primary_Acc, 'CC_Limit'=>$Credit_Limit, 'office_std'=>$office_std, 'office_ext'=>$office_ext, 'home_std'=>$home_std, 'Is_Valid'=>$Is_Valid);
	$wherecondition ="(RequestID=".$ProductValue.")";
	Mainupdatefunc ('pl_icici_leads', $DataArray, $wherecondition);


	$getDetailsSql = "select * from pl_icici_leads where RequestID = '".$ProductValue."' ";
	list($recordcount,$getDetailsQuery)=MainselectfuncNew($getDetailsSql,$array = array());
		
	$Name = $getDetailsQuery[0]['Name'];
	$Email = $getDetailsQuery[0]['Email'];
	$Mobile_Number = $getDetailsQuery[0]['Mobile_Number'];
	$DOB = $getDetailsQuery[0]['DOB'];
	$Loan_Amount = $getDetailsQuery[0]['Loan_Amount'];
	$Employment_Status = $getDetailsQuery[0]['Employment_Status'];
	$Company_Name = $getDetailsQuery[0]['Company_Name'];
	$Years_In_Company = $getDetailsQuery[0]['Years_In_Company'];
	$Total_Experience = $getDetailsQuery[0]['Total_Experience'];
	$Net_Salary = $getDetailsQuery[0]['Net_Salary'];
	$business_running = $getDetailsQuery[0]['business_running'];//na
	$Residential_Status = $getDetailsQuery[0]['Residential_Status'];
	$CC_Holder = $getDetailsQuery[0]['CC_Holder'];
	$card_obligation = $getDetailsQuery[0]['card_obligation'];
	$LoanAny = $getDetailsQuery[0]['LoanAny'];
	$Loan_Any = $getDetailsQuery[0]['Loan_Any'];
	$EMI_Paid = $getDetailsQuery[0]['EMI_Paid'];
	$source = $getDetailsQuery[0]['source'];
	$IP = $getDetailsQuery[0]['IP'];
	$Reference_Code = $getDetailsQuery[0]['Reference_Code'];
	$Is_Valid = $getDetailsQuery[0]['Is_Valid'];
	$Primary_Acc = $getDetailsQuery[0]['Primary_Acc'];
	$CC_Limit = $getDetailsQuery[0]['CC_Limit'];
	$Dated = $getDetailsQuery[0]['Dated'];
	$City = $getDetailsQuery[0]['City'];
	$Company_Type = $getDetailsQuery[0]['Company_Type'];
	$source = "ICICI App";
	
	$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
	list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
	}
	else
	{
		
		$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Mobile_Number, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
	}	
	
	 $dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Mobile_Number'=>$Mobile_Number, 'DOB'=>$DOB, 'City'=>$City, 'Company_Name'=>$Company_Name, 'Net_Salary'=>$Net_Salary, 'Primary_Acc'=>$Primary_Acc, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_Any, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Loan_Amount'=>$Loan_Amount, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Residential_Status'=>$Residential_Status, 'Company_Type'=>$Company_Type, 'source'=>$source, 'Referrer'=>$ProductValue, 'City_Other'=>$city_other, 'IP_Address'=>$IP, 'CC_Holder'=>$CC_Holder, 'Card_Limit'=>$CC_Limit);
	  $ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);	
	
	list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$last_inserted,$City);
	$finalchk_bid=implode(',',$bidder_id);
	$finalBnkd=implode(',',$Bnkd);

if(strlen($finalchk_bid)>0 && $Employment_Status==1)
{ 
	$Dated = ExactServerdate();
	$DataArray = array("Allocated"=>"2", "Bidderid_Details"=>$finalchk_bid);
	$wherecondition ="(RequestID=".$last_inserted.")";
	Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
}
	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
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
.btnclr {    background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 250px;}	
</style>


<style type="text/css">input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */	 </style>
<style>		
.black_overlay{			display: none;			position: absolute;			top: 0%;			left: 0%;			width: 100%;			height: 100%;			background-color: black;			z-index:1001;			-moz-opacity: 0.8;			opacity:.50;			filter: alpha(opacity=50);		}
		.white_content {			display: none;			position: absolute;			top: 25%;			left: 25%;			width: 260;			height: 250;			padding: 6px;			border: 2px solid black;			background-color: white;			z-index:1002;			overflow: auto;		}
.bldtxt {font-weight:bold;
line-height:16px;
color:#4f4d4d;
}
</style>

<script language="javascript">
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}
function Trim(strValue) {

var j=strValue.length-1;i=0;

while(strValue.charAt(i++)==' ');

while(strValue.charAt(j--)==' ');

return strValue.substr(--i,++j-i+1);

}


</script>
</head>
<body bgcolor="#999999"  style="font-family:Arial, Helvetica, sans-serif;">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="960" bgcolor="#FFFFFF">
<tr><td align="center">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td width="429" align="left"><img src="new-images/icici-pl-logi.jpg" /></td>
<td width="534" align="right" valign="bottom"><table cellpadding="2" cellspacing="1" width="534" border="0" bgcolor="#666666" >
    
    <tr><td align="center" valign="middle" bgcolor="#f0ede4" height="35">
<strong>Loan Amount</strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>	Rate of Interest</strong>		</td>
        <td align="center" valign="middle" bgcolor="#f0ede4"><strong>EMI per Lac</strong> </td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>Processing Fee </strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
<strong>Tenure</strong>        </td>
    </tr>

    <tr><td align="center" valign="middle" bgcolor="#f0ede4"  height="35">
    
		Rs. <?php echo round($finalLoanAmount) ; ?>/-
		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $intr_rate ." %"; ?>		</td>
            <td align="center" valign="middle" bgcolor="#f0ede4">
        		Rs. <?php echo $emiperlac; ?>/- </td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $proc_fee ." %" ; ?>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $Tenure ." Years" ;  ?>        </td>
    </tr>
    </table></td></tr>
<tr><td colspan="2"><img src="new-images/hd1.jpg" width="960" /></td></tr>
<tr><td colspan="2" align="center" >
<table width="960" height="112" cellpadding="0" cellspacing="0" bgcolor="#f0ede4" style="border:#dcdacd 2px solid;">
    <tr><td bgcolor="#f0ede4"  width="960" align="center" ><div id="product_head">
  <h2>Personal Loan Quote</h2>
</div>
  </td></tr>
  <tr>
	<td  align="center"> <br />
	  <p><strong>Thank You for applying for ICICI Bank Personal Loan</strong></p>
	  <p><strong>Your Application Reference is <?php echo $app_code; ?></strong></p>
  <p><strong>Our representative will call you shortly</strong></p>
  <p>&nbsp;</p>
  <p align="left">
  <?php
 // include "icicigeneratePDF.php";
  ?>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p></td>
   </tr>
  </table></td></tr>
</table>
</td></tr></table>
</body>
</html>
