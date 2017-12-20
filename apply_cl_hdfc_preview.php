<?php 
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';
require 'carLoanCalc.php';

$city = $_SESSION['City'];
$leadid = $_SESSION['Temp_LID'];
$other_city = $_SESSION['City_Other'];


//$leadid = $_REQUEST['leadid'];
//$strCity =  $_REQUEST['city'];
//$leadid = 165893;
//$strCity =  "Delhi";

$cl_requestid = $_REQUEST['cl_requestid'];
$cl_bank_name = $_REQUEST['cl_bank_name'];
$leadid = $_REQUEST['cl_requestid'];

if (strlen($cl_bank_name)>1 && $cl_requestid>1)
{
	$selqry="select CL_Bank from Req_Loan_Car Where RequestID=".$cl_requestid;
	list($Getnum,$plrow)=Mainselectfunc($selqry,$array = array());
//$restselqry= ExecQuery($selqry);
//$plrow=mysql_fetch_array($restselqry);
$cl_banks=$plrow['CL_Bank'];

if(strlen($cl_banks)>1)
	{
		$newpl_banks= $cl_banks.",".$cl_bank_name;
		//$plupdate= "Update Req_Loan_Car  set CL_Bank='".$newpl_banks."' Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
		
		$DataArray = array("CL_Bank" =>$newpl_banks);
		$wherecondition ="(Req_Loan_Car.RequestID=".$cl_requestid.")";
	}
	else
	{
		//$plupdate= "Update Req_Loan_Car  set CL_Bank='".$cl_bank_name."' Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
		$DataArray = array("CL_Bank" =>$cl_bank_name);
		$wherecondition ="(Req_Loan_Car.RequestID=".$cl_requestid.")";

	
	}
	Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

//	ExecQuery($plupdate);
	//echo $plupdate."<br>";
}

$getUsrDetailsSql = "select * from Req_Loan_Car where RequestID	= '".$leadid."'";
list($Getnum,$ArrRow)=Mainselectfunc($getUsrDetailsSql,$array = array());

$income = $ArrRow['Net_Salary'];
$DOB = $ArrRow['DOB'];
$City = $ArrRow['City'];
$Car_Varient = $ArrRow['Car_Varient'];
$Employment_Status = $ArrRow['Employment_Status'];
$company_name = $ArrRow['Company_Name'];
$Car_Type = $ArrRow['Car_Type'];
$DOB_arr = explode("-",$DOB);
list($yyyy,$mm,$dd) = $DOB_arr;
$DOB_Str = $yyyy."".$mm."".$dd;
$Experience = $ArrRow['Total_Experience'];

$Residence_Status=  $ArrRow['Residence_Status'];
$Resi_Stability=  $ArrRow['Residence_Stability'];

if($Residence_Status==1 || $Residence_Status==2)
{
	$resi_stable = 2;
}
else
{
	$resi_stable = $Resi_Stability;
}


$age = DetermineAgeFromDOB($DOB_Str);

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";

list($Getnum,$rowcmp)=Mainselectfunc($getcompdetails,$array = array());

//$resultcomp=ExecQuery($getcompdetails);
//$rowcmp=mysql_fetch_array($resultcomp);
$hdfccl_comp_type = $rowcmp["hdfccl_comp_type"];
$krc_flag = $rowcmp["krc_flag"];

	$getcardetails="Select * from hdfc_car_list_category Where hdfc_clid='".$Car_Varient."'";
	list($Getnum,$row)=Mainselectfunc($getcardetails,$array = array());
	//$result=ExecQuery($getcardetails);
	//$row=mysql_fetch_array($result);
	$car_category = $row["hdfc_car_category"];
	$car_segment = $row["hdfc_car_segment"];
	$hdfc_clid= $row["hdfc_clid"];
	$hdfc_car_price = $row["hdfc_car_price"];
	$hdfc_car_price_delhi = $row["hdfc_car_price_delhi"];
	$hdfc_car_rate_segment = $row["hdfc_car_rate_segment"];
	$hdfc_car_name = $row["hdfc_car_name"];
	$magma_car_rate_segment = $row["magma_car_rate_segment"];
	$magma_list = $row["magma_list"];

?>
<?php 
$QArequestid = $_SESSION['Temp_Last_Inserted'];
 $lastInserted = $QArequestid;


if(isset($_POST['submit']))
{
	
	$ResiAdd = $_REQUEST['ResiAdd1']." ".$_REQUEST['ResiAdd2']." ".$_REQUEST['ResiAdd3'];
	$ResiCity = $_REQUEST['ResiCity'];
	$ResiState = $_REQUEST['ResiState'];
	$ResiPin = $_REQUEST['ResiPin'];
	
	$OffAdd = $_REQUEST['OffAdd1']." ".$_REQUEST['OffAdd2']." ".$_REQUEST['OffAdd3'];
	$OffCity = $_REQUEST['OffCity'];
	$OffState = $_REQUEST['OffState'];
	$OffPin = $_REQUEST['OffPin']; 
	
	$Gender = $_REQUEST['Gender'];
	$EduQuali = $_REQUEST['EduQuali'];
	$AccountHolder = $_REQUEST['AccountHolder'];
	$PanCard = $_REQUEST['PanCard'];
	

$dataInsert = array("car_loan_ReqId"=>$_REQUEST['cl_requestid'], "Name"=>$_REQUEST['Name'], "Mobile_Number"=>$_REQUEST['Phone'], "Residence_Address"=>$ResiAdd, "City"=>$ResiCity, "resi_state"=>$ResiState, "Residence_Pincode"=>$ResiPin, "Off_Address"=>$OffAdd, "off_city"=>$OffCity, "off_state"=>$OffState, "off_pincode"=>$OffPin, "gender"=>$Gender, "edu_quali"=>$EduQuali, "salary_account"=>$AccountHolder, "Pancard"=>$PanCard, "Dated"=>date("Y-m-d H:i:s"), "IP"=>$_SERVER['REMOTE_ADDR'], "pdfDownload"=>1);
$table = 'hdfc_car_loan_leads';
//print_r($dataInsert);
$last_inserted_value = Maininsertfunc($table, $dataInsert);
if($last_inserted_value)
	{
		header("Location:apply_cl_hdfc_thanks.php?TenureVal=".$_REQUEST['ChangeTenureVal']);
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Thank you Car Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="http://www.deal4loans.com/css/car-loan-styles.css" type="text/css" rel="stylesheet" />
<style type="text/css">
.fontbld10 {font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;}
</style>

<script Language="JavaScript">
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

function selectReward(i)
{
	var last_inserted_id=<?php echo $leadid; ?>;
	var queryString = "?last_inserted_id=" + last_inserted_id +"&reward_selected=" + i;

	ajaxRequestMain.open("GET", "updatehdfcReqCL.php" + queryString, true);
// Create a function that will receive data sent from the server
	ajaxRequestMain.onreadystatechange = function(){
		if(ajaxRequestMain.readyState == 4)
		{
			alert(ajaxRequestMain.responseText);
			//document.getElementById('Activate').value=ajaxRequestMain.responseText;
		}
	}

ajaxRequestMain.send(null); 
}

window.onload = ajaxFunctionMain;


</script>
<script type="application/javascript" language="javascript">
//form Validation 
function frmValidate()
	{
		
		var Frm  = document.hdfc_carloan;
		if(Frm.ResiAdd1.value=="")
			{
				alert('Please fill Residential address');
				Frm.ResiAdd1.focus();
				return false;
			}
		if(Frm.ResiCity.value=="")
			{
				alert('Please Select Residential City');
				Frm.ResiCity.focus();
				return false;
			}
		if(Frm.ResiState.value=="")
			{
				alert('Please fill Residential State');
				Frm.ResiState.focus();
				return false;
			}
		if(Frm.ResiPin.value=="")
			{
				alert('Please fill Residential Pincode');
				Frm.ResiPin.focus();
				return false;
			}
		if(Frm.OffAdd1.value=="")
			{
				alert('Please fill Official address');
				Frm.OffAdd1.focus();
				return false;
			}
		if(Frm.OffCity.value=="")
			{
				alert('Please Select Official City');
				Frm.OffCity.focus();
				return false;
			}
		if(Frm.OffState.value=="")
			{
				alert('Please fill Official State');
				Frm.OffState.focus();
				return false;
			}
		if(Frm.OffPin.value=="")
			{
				alert('Please fill Official Pincode');
				Frm.OffPin.focus();
				return false;
			}
		if(Frm.Gender.value=="")
		{
			alert ( "Please choose your Gender: Male or Female" );
			Frm.EduQuali.focus();
			return false;
		}
		if(Frm.EduQuali.value=="")
			{
				alert('Please fill Educational Qualification');
				Frm.EduQuali.focus();
				return false;
			}
		
		if(Frm.PanCard.value=="")
			{
				alert('Please fill PAN Number');
				Frm.PanCard.focus();
				return false;
			}	
		
		else{
			return true;
			
			}
		
	}


</script>

</head>
<body>
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div class="cl_inner_wrapper-new" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto;">
  <div align="center"></div>
  <div style="height:10px;"></div>
  <div class="cl-form-wrapper">   
   <form name="hdfc_carloan" action="" method="post" onsubmit="return frmValidate();">
   <input type="hidden" name="ChangeTenureVal" id="ChangeTenureVal"  value="<? echo $_REQUEST['ChangeTenureVal']; ?>" >
    <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
   <input type="hidden" name="Name" id="Name" value="<?php echo $_REQUEST['Name']?>">
   <input type="hidden" name="Phone" id="Phone" value="<?php echo $_REQUEST['Phone'];?>">
   <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
   <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">
   <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
	<input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
    <div style="clear:both; height:10px;"></div>
    <div class="p-details"><strong>Residential adress</strong>*</div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Residential address</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="ResiAdd1" id="ResiAdd1" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Residential address</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="ResiAdd2" id="ResiAdd2" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Residential address</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="ResiAdd3" id="ResiAdd3" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    
     <div style="clear:both;"></div>
     <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">City</td>
  </tr>
  <tr>
    <td class="cl-form-text"><select name="ResiCity" id="ResiCity" class="d4l-select">
    <option value="">Select City</option>
            <?=getCityList($City)?>
            </select>
    </td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">State</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="ResiState" id="ResiState" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">PIN Code</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="ResiPin" id="ResiPin" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div><div style="clear:both; height:20px;"></div>
     <div class="p-details"><strong>Official address</strong></div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Official address</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="OffAdd1" id="OffAdd1" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Official address</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="OffAdd2" id="OffAdd2" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Official address</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="OffAdd3" id="OffAdd3" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
      <div style="clear:both"></div>
      <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">City</td>
  </tr>
  <tr>
    <td class="cl-form-text"><select name="OffCity" id="OffCity" class="d4l-select">
    <option value="">Select City</option>
            <?=getCityList($City)?>
            </select></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">State</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="OffState" id="OffState" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">PIN Code</td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="OffPin" id="OffPin" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div style="clear:both; height:20px;">  </div>
    
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Gender</td>
  </tr>
  <tr>
    <td class="cl-form-text">
      <input type="radio" name="Gender" id="Gender" value="Male" />
     
      Male 
      <input type="radio" name="Gender" id="Gender2" value="Female" />
      Female</td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Educational Qualification</td>
  </tr>
  <tr>
    <td class="cl-form-text">
      <input name="EduQuali" id="EduQuali" tabindex="1" type="text" class="d4l-input"></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">Account holder </td>
  </tr>
  <tr>
    <td class="cl-form-text">
      <select name="AccountHolder" id="AccountHolder" class="d4l-select" tabindex="2">
<option value="Allahabad Bank">Allahabad Bank</option>
<option value="Andhra Bank">Andhra Bank</option>
<option value="Axis Bank">Axis Bank</option>
<option value="Bank of Baroda">Bank of Baroda</option>
<option value="Bank of India">Bank of India</option>
<option value="Bank of Maharashtra">Bank of Maharashtra</option>
<option value="Canara Bank">Canara Bank</option>
<option value="Central Bank of India">Central Bank of India</option>
<option value="City Bank">City Bank</option>
<option value="Corporation Bank">Corporation Bank</option>
<option value="Dena Bank">Dena Bank</option>
<option value="HDFC Bank">HDFC Bank</option>
<option value="HSBC">HSBC</option>
<option value="ICICI Bank">ICICI Bank</option>
<option value="IDBI Bank">IDBI Bank</option>
<option value="Indian Overseas Bank">Indian Overseas Bank</option>
<option value="IndusInd Bank">IndusInd Bank</option>
<option value="ING VYSYA Bank">ING VYSYA Bank</option>
<option value="Kotak Mahindra Bank">Kotak Mahindra Bank</option>
<option value="Punjab National Bank">Punjab National Bank</option>   
<option value="Reserve Bank of India">Reserve Bank of India</option>
<option value="Union Bank of India">Union Bank of India</option>
<option value="United Overseas Bank">United Overseas Bank</option>
<option value="Vijaya Bank">Vijaya Bank</option>
<option value="Yes Bank">Yes Bank</option>

            </select></td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" class="cl-form-text">PAN Number </td>
  </tr>
  <tr>
    <td class="cl-form-text"><input name="PanCard" id="PanCard" tabindex="1" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    
    <div style="clear:both;"></div>
    
    <div class="cl_terms_box cl-form-text">
        <input type="checkbox" name="accept" style="border:none;" checked="checked">
        I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#fff; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#fff; text-decoration:underline;">Terms and Conditions</a>.</div>
        <div class="cl_new_bnt_b">
        <input type="submit" name="submit" class="cl-get-quotebtn" value="Get Quote"/>
      </div>
         <div style="clear:both;">  </div>
        </form>
    </div>


 </div>
</div>
<div style="padding-top:25px; text-align:left; vertical-align:top"></div>
</div><?php include "footer_sub_menu.php"; ?>
</body>
</html>