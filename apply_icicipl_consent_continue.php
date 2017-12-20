<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';

	$urltype=$_REQUEST["urltype"];
	if($urltype=="httpsurl")
	{	require 'scripts/functionshttps.php'; 
		$urltypeval="httpsurl";
	}
	else
	{	require 'scripts/functions.php'; $urltypeval="";}

	$pl_requestid = $_REQUEST['pl_requestid'];
	$pl_bank_name = $_REQUEST['pl_bank_name'];
	$iciciCompany_Name = $_REQUEST['CompanyName'];
	$LoanAmount = str_replace(",","",$_REQUEST['LoanAmount']);
	$NetyearlyIncome = str_replace(",","",$_REQUEST['NetyearlyIncome']);
	$Citystr = $_REQUEST['City'];
	$Name = $_REQUEST['Name'];
	
	$MiddleName = $_REQUEST['MiddleName'];
	$LastName = $_REQUEST['LastName'];
	if($LastName=="")
	{
		$LastName="Kumar";
	}
	$MobileNumber = $_REQUEST['MobileNumber'];
	$EmailID = $_REQUEST['EmailID'];
	$Occupation = $_REQUEST['Occupation'];

if (strlen($pl_bank_name)>1 && $pl_requestid>1)
{
	$selqry="select City_Other,Pancard,Gender,PL_Bank,Loan_Amount,Name,DOB,Company_Name,Net_Salary,City,Mobile_Number,Email,source,Pincode,Total_Experience,Years_In_Company,Residence_Address from Req_Loan_Personal Where RequestID=".$pl_requestid;
	list($Numrows,$plrow)=MainselectfuncNew($selqry,$array = array());
	$countr = count($plrow)-1;
	$pl_banks=$plrow[$countr]['PL_Bank'];

	$Gender = $plrow[$countr]["Gender"];
	$DOB = $plrow[$countr]["DOB"];
	$dobarr = explode('-', $DOB);
	$year=$dobarr[0];
	$month=$dobarr[1];
	$day=$dobarr[2];
	$DateOfBirth = $day."/".$month."/".$year;
	
	if(strlen($iciciCompany_Name)>3)
	{
		$finalcompany_name=$iciciCompany_Name;
	}
	else
	{
		$finalcompany_name=$company_name;
	}
	 $CompanyName = substr(trim($finalcompany_name),0,30);
	$FixedIncome = round($NetyearlyIncome/12);
	$source = $plrow[$countr]["source"];
	$Total_Experience = round($plrow[$countr]["Total_Experience"]);
	$Years_In_Company = round($plrow[$countr]["Years_In_Company"]);
	$Pincode = $plrow[$countr]["Pincode"];
	$Pancard = $plrow[$countr]["Pancard"];
	$Residence_Address = $plrow[$countr]["Residence_Address"];
	$strresiadd = round((strlen($Residence_Address)/3));
	$resiadd = str_split($Residence_Address, $strresiadd);
	$ResAddressLine1 =$resiadd[0];
	$ResAddressLine2 =$resiadd[1];
	$ResAddressLine3 =$resiadd[2];
	$Dated=ExactServerdate();
	if($Gender==2)
	{
		$genderstr="Female";
	}
	else
	{
		$genderstr="Male";
	}
	// to fetch resistate
	$resistateqry="select state from master_india_city Where (city like'%".$Citystr."%') group by city Limit 0,1";
	list($Numrows,$resirow)=MainselectfuncNew($resistateqry,$array = array());
	$countr = count($resirow)-1;
	$resistate = $resirow[$countr]["state"];

	$getdetails="select icicwcid From icicipl_webservice Where ( requestid='".$pl_requestid."')";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$icicwcid=$myrow['icicwcid'];
	if($alreadyExist>0)
	{
	$duplicatepush=1;
	}
	else
	{
		$duplicatepush=0;
	}

//ChannelType , FirstName , LastName , Gender , DateOfBirth , ResMobileNo , CustomerCategory , CompanyName , Profession , FixedIncome , LoanAmount , CurrentObligation , TotalWorkExperience , RelationWithICICI , CityName , CityCategory , SalaryAccountICICI , ResAddressLine1 , ResAddressLine2 , ResCity 
//echo $First."-".$Last."-".$genderstr."-".$Mobile_Number."-".$Total_Experience."-".$LoanAmount."-".$Pancard."-".$City."-".$ResAddressLine1."-".$ResAddressLine1;

//Delhi/NCR, Bangalore, Hyderabad, Chennai, Pune & Mumbai. block - 20may2017 said balbir

if($Citystr=="Gaziabad" || $Citystr=="Gurgaon" || $Citystr=="Noida" || $Citystr=="Delhi" || $Citystr=="Bangalore" || $Citystr=="Hyderabad" || $Citystr=="Chennai" || $Citystr=="Pune" || $Citystr=="Mumbai")
	{
	}
	else{

	if(strlen($Name)>0 && strlen($LastName)>0 && strlen($genderstr)>0 && ($MobileNumber>0) && ($Total_Experience>0) && ($LoanAmount>0) && (strlen($Pancard)>=10) && (strlen($Citystr)>1) && strlen($ResAddressLine1)>1 && strlen($ResAddressLine1)>2 && $duplicatepush==0)
	{
		//echo "i m here";
		$jsonurl='{"UserID":"CzqACXzroMJsd80Coai21nEnbhIyixSHaGKP1uPCBbuFlMqoBqBpFwxuaDHGvdso5IZDwCzyvrEODKkxLq4VzrRsE5tSKoiq1gfJ8suoBqNbvPtOYbj6HfQUaO+rw5AUl2mHRuCEm4fLsAp+AUUK0r3Sxa9atI2oP7T+LIjoees=","Password":"dewOHb3MXfzdK/L8raCt7D1qJ9k2OtTsMM/uWdCmdV8M252sJb4dYOsyv2cIJX6FtyJgr8HjM4DT+3ixKf1+1wYU+/l8iip1PuzBq0uFXwcY86jzCF3c+qHH/jBaI+GD+OBmUiO+Thhm/QUDAGANY7v499NTfsVoyOOYt1kNVto=","ChannelType":"Deal4loans","FirstName":"'.$Name.'","MiddleName":"","LastName":"'.$LastName.'","Gender":"'.$genderstr.'","DateOfBirth":"'.$DateOfBirth.'","UId":" ","ResMobileNo":"'.$MobileNumber.'","Designation":"Manager","CustomerCategory":"Salaried","CompanyName":"'.$CompanyName.'","Profession":"OTHERS","FixedIncome":"'.$FixedIncome.'","CurrentObligation":"0","TotalWorkExperience":"'.$Total_Experience.'","CurrentWorkExperience":"'.$Years_In_Company.'","RelationWithICICI":"No","ICICIRelationShipNumber":" ","CityName":"'.$Citystr.'","CityCategory":"OtherMetros","StateName":"'.$resistate.'","SalaryAccountICICI":"No","ResAddressLine1":"'.$ResAddressLine1.'","ResAddressLine2":"'.$ResAddressLine2.'","ResAddressLine3":"'.$ResAddressLine3.'","ResCity":"'.$Citystr.'","ResPinCode":"'.$Pincode.'","ResState":"'.$resistate.'","OffAddressLine1":"","OffAddressLine2":"","OffAddressLine3":" ","OffCity":"","OffPinCode":"","OffState":"","OfficePhone":" ","OfficeEmail":" ","VoterID":" ","DrivingLicense":" ","RationCardNumber":" ","PassportNo":"","PanNo":"'.$Pancard.'","LoanAmount":"'.$LoanAmount.'"}';

		//$url ="https://www.test.transuniondecisioncentre.co.in/DC/TUDCGenericAPI/API/ICICIPLLMS/NewApplication/";// UAT
		$url="https://www.dc.transuniondecisioncentre.co.in/DC/TU.DC.GenericAPI/API/ICICIPLLMS/NewApplication/";
		// cURL's initialization
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
		$result = curl_exec($ch);
		$obj = json_decode($result);
		
		$ApplicationId=$obj->ApplicationId;
		$Decision=$obj->Decision;
			
		if($ApplicationId>0)
		{	
			if($Decision=="Approved" || $Decision=="Referred")
			{
				$data=$obj->ActualEligibilityDetails;
				$xml = new SimpleXMLElement($data);
				for($i=1;$i<=4;$i++)
				{	$section="Section".$i;
					$Section[]=$xml->$section;
				}
			}
			$appid=$ApplicationId;
		}
		else
		{	$appid=0; }
		
		$DataArray = array("ApplicationId"=>$appid, "Decision"=> $Decision,"request_json1" =>$jsonurl, "response_json1" =>$result, "requestid"=>$pl_requestid , "dated1"=>$Dated);
		Maininsertfunc('icicipl_webservice', $DataArray);	
		
	}
	}

if(strlen($pl_banks)>1)
	{
		$newpl_banks= $pl_banks.",".$pl_bank_name;
		$wherecondition= "(Req_Loan_Personal.RequestID=".$pl_requestid.")";
		$dataarray=array("PL_Bank"=>$newpl_banks);	
	}
	else
	{
		$dataarray=array("PL_Bank"=>$pl_bank_name);
		$wherecondition= "(Req_Loan_Personal.RequestID=".$pl_requestid.")";
	}
	$rowcount=Mainupdatefunc("Req_Loan_Personal", $dataarray, $wherecondition);
	//echo $plupdate."<br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:15px; }
.sbi_text_c{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width: 340px;
	float: right;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width: 570px;
	float: left;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}

.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.bajaj-fin_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.bajaj-fin_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:20px; }
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div style="width:995px;  margin:auto;">
<div id="content"><!-- put content here-->
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>
<?php
if($ApplicationId>0 && $Decision=="Approved" || $Decision=="Referred")
		{ ?>
<table border=1 cellpadding="5" cellpadding="0" width="600">
	<tr>
		<td>Loan Amount</td>
		<td>Tenure (yrs)</td> 
		<td>Interest Rate</td> 
		<td>Processing Fee</td> 
		<td>EMI</td> 
		<td>Company PF</td> 
		<td>Spl ROI</td> 
		<td>Spl PF</td> 
		<td>Spl PFPer</td> 
		<td>Select offer</td> 
	</tr>
<?php
for($j=0;$j<count($Section);$j++)
		{
			if(count($Section[$j])>0)
			{	echo '<form name="frmsection'.$j.'" method="POST" action="apply_icicipl_consent_thanks.php"><input type="hidden" name="count" value="'.$j.'"><input type="hidden" name="ApplicationId" value="'.$ApplicationId.'"><tr>';
				echo '<td><input type="text" value="'.$Section[$j]->LoanAmount.'" name="LoanAmount_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->Tenure.'" name="Tenure_'.$j.'"  size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->InterestRate.'" name="InterestRate_'.$j.'"  size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->ProcessingFee.'" name="ProcessingFee_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->EMI.'" name="EMI_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->CompanyPF.'" name="CompanyPF_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->SplROI.'" name="SplROI_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->SplPF.'" name="SplPF_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="text" value="'.$Section[$j]->SplPFPer.'" name="SplPFPer_'.$j.'" size="4" style="border:none;"></td>';
				echo '<td><input type="submit" name="submit'.$j.'" value="Apply" style="background: #06b2a0; color: #FFF;"></td>';
				echo '</tr></form>';

			}
			else
			{
				//echo "pl";
			}
		}
		echo "</table>";
}
else
{
}
?>
   </div>    
    <div style="width: 340px;	float: right;">
    <!--<div class="widget">
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why <? //echo $pl_bank_name; ?>?</span></td>
          <td width="42%" align="right" class="heading_text1" style="font-size:18px;"></td>
        </tr>
        <tr>
          <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
        </tr>
      </table>
        </div>-->
    </div>
</div>

<div style="clear:both;"></div>
<!--partners-->
<?php 
$REMOVE_ADD=1;
include("footer_sub_menu.php"); ?>
</body>
</html>