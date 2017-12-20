<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';

//print_R($_REQUEST);
$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];

$strcrd_nme="";
if((strlen(trim($cc_name))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name,Name,DOB,City,Company_Name from Req_Credit_Card Where (RequestID='".$RequestID."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$Name = $row['Name'];
	list($first,$middle,$last) = split('[ ]',$Name);
	$Company_Name=$row['Company_Name'];
	if(strlen($row['applied_card_name'])>0)
	{
	$strcrd_nme=$row['applied_card_name'].",".$cc_name;
	}
	else
	{
		$strcrd_nme=$cc_name;
	}

	$DataArray = array("applied_card_name" =>$strcrd_nme);
	$wherecondition ="(RequestID='".$RequestID."')";
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

	$slctcrd="select card_image from credit_card_banks_eligibility Where (cc_bankid='".$cc_bankid."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$ccrow)=Mainselectfunc($slctcrd,$array = array());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<link href="http://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-ui-new.css" type="text/css" rel="stylesheet">
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" /> 
<link href="http://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="http://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="http://www.deal4loans.com/ccmobile/js/validate.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-sbicclist.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000;
}

</style>
<script type="text/javascript">

function Checkvalidateccstep2frm(Form)
{
	var j;
	var l;
	var r;
	var k;
	var m;
	var cntr=-1;
	var cnt=-1;
	var ccholdercheck=-1;
	var cntl=-1;
	var cntlb=-1;
	var cntSa=-1;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var cit=document.creditcard_form.City.value;
	//var sal=document.creditcard_form.Net_Salary.value;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.first_name.value=="") || (Form.first_name.value=="First Name"))
	{
        document.getElementById('FirstnameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your First Name</span>";		
		Form.first_name.focus();
		return false;
	}
	if((Form.last_name.value=="") || (Form.last_name.value=="Last Name"))
	{
        document.getElementById('LastnameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Last Name</span>";		
		Form.last_name.focus();
		return false;
	}
	if((Form.DOB.value=="")||(Form.DOB.value=="DD/MM/YYYY"))
	{
        document.getElementById('DOBVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Date of Birth</span>";		
		Form.DOB.focus();
		return false;
	}
	
	var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	 	document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";	
		 Form.panno.focus();
		 return false;
	}
	if (Form.panno.value.charAt(3)!="P" && Form.panno.value.charAt(3)!="p")
	{
			document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";	
			Form.panno.focus();
			return false;
	}
	
	if((Form.panno.value==""))
	{
        document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please Enter Pan Card Number</span>";		
		Form.panno.focus();
		return false;
	}
	
	if(Form.sbicardholder.value == ''){
		alert("Please select option for already having credit card");
		//document.getElementById('cardHolderVal').innerHTML = "<span  class='hintanchor'>Please select option for already having credit card!</span>";
		//Form.sbicardholder.focus();
		return false;
	}
	
	if(Form.sbicardholder.value == 'No'){
		if(Form.sbiloanrunning.value == ''){
			alert("Please select option for already applying for credit card in last 6 months");
			//document.getElementById('months6Val').innerHTML = "<span  class='hintanchor'>Please select option for already applying for credit card in last 6 months!</span>";
			//Form.sbiloanrunning.focus();
			return false;
		}
	}
	
	if(Form.sbiloanrunning.value == 'No'){
		if(Form.sbirelation.value == ''){
			alert("Please select option for existing relationship with SBI");
			//document.getElementById('relVal').innerHTML = "<span  class='hintanchor'>Please select option for existing relationship with SBI!</span>";
			//Form.sbirelation.focus();
			return false;
		}
	}
		
	if(Form.sbirelation.value=='Yes')
	{
		if(Form.Gender.value == ''){
			alert("Select Gender!");
			//document.getElementById('genderVal').innerHTML = "<span  class='hintanchor'>Select Gender!</span>";
			//Form.Gender.focus();
			return false;
		}
		
		if(Form.AddressDoc.value == ''){
			alert("Please select option for current address document");
			//document.getElementById('addressdocVal').innerHTML = "<span  class='hintanchor'>Please select option for current address document!</span>";
			//Form.AddressDoc.focus();
			return false;
		}
		
		var txtRes1 = document.getElementById("resiaddress1").value;
		var txtRes2 = document.getElementById("resiaddress2").value;
		var txtRes3 = document.getElementById("resiaddress3").value;
		var reRes = /^[ A-Za-z0-9(',./#)+-]*$/
		
		if((Form.resiaddress1.value=="")){
			document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Resi Address1</span>";
			Form.resiaddress1.focus();
			return false;
		}
		if (!reRes.test(txtRes1)){
			document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Resi Address1</span>";		
			Form.resiaddress1.focus();
			return false;
		}

		if((Form.resiaddress2.value=="")){
			document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Resi Address2</span>";
			Form.resiaddress2.focus();
			return false;
		}
		if (!reRes.test(txtRes2)){
			document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Resi Address2</span>";		
			Form.resiaddress2.focus();
			return false;
		}

		if((Form.resiaddress3.value=="")){
			document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Resi Address3</span>";
			Form.resiaddress3.focus();
			return false;
		}
		if (!reRes.test(txtRes3)){
			document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Resi Address3</span>";		
			Form.resiaddress3.focus();
			return false;
		}

		if (Form.City.selectedIndex==0)
		{
			document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Please Select your Residence City!</span>";
			Form.City.focus();
			return false;
		}
		if (Form.pincode.selectedIndex==0)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Select Pincode!</span>";
			Form.pincode.focus();
			return false;
		}
		if((Form.Company_Name.value==""))
		{
			document.getElementById('companyVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Company Name</span>";		
			Form.Company_Name.focus();
			return false;
		}
		if (Form.Qualification.selectedIndex==0)
		{
			document.getElementById('QualificationVal').innerHTML = "<span  class='hintanchor'>Select Qualification!</span>";
			Form.Qualification.focus();
			return false;
		}
		if((Form.Designation.value==""))
		{
			document.getElementById('DesignationVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Designation</span>";		
			Form.Designation.focus();
			return false;
		}
		
		var txtOffice1 = document.getElementById("OfficeAddress1").value;
		var txtOffice2 = document.getElementById("OfficeAddress2").value;
		var txtOffice3 = document.getElementById("OfficeAddress3").value;
		var re = /^[ A-Za-z0-9(',./#)+-]*$/
		if((Form.OfficeAddress1.value=="")){
			document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Office Address1</span>";		
			Form.OfficeAddress1.focus();
			return false;
		}
		if (!re.test(txtOffice1)){
			document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Address2</span>";		
			Form.OfficeAddress1.focus();
			return false;
		}

		if((Form.OfficeAddress2.value=="")){
			document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Office Address2</span>";		
			Form.OfficeAddress2.focus();
			return false;
		}
		if (!re.test(txtOffice2)){
			document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Address2</span>";		
			Form.OfficeAddress2.focus();
			return false;
		}

		if((Form.OfficeAddress3.value=="")){
			document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Office Address3</span>";		
			Form.OfficeAddress3.focus();
			return false;
		}
		if (!re.test(txtOffice3)){
			document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Address3</span>";		
			Form.OfficeAddress3.focus();
			return false;
		}
		
		if((Form.OfficeCity.value==""))
		{
			document.getElementById('OfficeCityVal').innerHTML = "<span  class='hintanchor'>Please Select Your office City</span>";		
			Form.OfficeCity.focus();
			return false;
		}
		if (Form.OfficePin.selectedIndex==0)
		{
			document.getElementById('OfficePinVal').innerHTML = "<span  class='hintanchor'>Select Pincode!</span>";
			Form.OfficePin.focus();
			return false;
		}
		
		/*
		for(l=0; l<document.ccstep2frm.LanlinPostpaid.length; l++) 
		{
			if(document.ccstep2frm.LanlinPostpaid[l].checked)
			{
				cntl= l;
			}
		}
		if(cntl == -1) 
		{
			alert("Select Phone Number!");
			return false;
		}
		if(document.ccstep2frm.LanlinPostpaid.value==1)
		{
			if((Form.Land_linenumber.value==""))
			{
				document.getElementById('Land_linenumberVal').innerHTML = "<span  class='hintanchor'>Select Landline Number!</span>";		
				Form.Land_linenumber.focus();
				return false;
			}
			if((Form.STD.value==""))
			{
				document.getElementById('STDVal').innerHTML = "<span  class='hintanchor'>Please Enter STD Code</span>";		
				Form.STD.focus();
				return false;
			}
			
			if((Form.Phone_Number.value==""))
			{
				document.getElementById('Land_linenumberVal2').innerHTML = "<span  class='hintanchor'>Select Landline Number!</span>";		
				Form.Phone_Number.focus();
				return false;
			}
		}
		if(document.ccstep2frm.LanlinPostpaid.value==2)
		{
			if((Form.MobileNumber.value==""))
			{
				document.getElementById('MobilNumberVal2').innerHTML = "<span  class='hintanchor'>Please Enter Mobile Number!</span>";		
				Form.Phone_Number.focus();
				return false;
			}
		}*/
	}
	
	if(!document.ccstep2frm.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
		document.ccstep2frm.accept.focus();
		return false;
	}
}

function ShowGenderField(evt)
{
document.getElementById("ShowGender").style.display="block";
}

function HideGenderField(evt)
{
document.getElementById("ShowGender").style.display="none";
}


function ShowCityField(evt)
{
document.getElementById("ShowCityAddr").style.display="block";
}
function showProfDetails(evt)
{
document.getElementById("ShowProfDetails").style.display="block";
}


function ShowLandlineField(evt)
{
	document.getElementById("landLineNumber").style.display="block";
	document.getElementById("PostPaidNumber").style.display="none";
}

function ShowPostPaidField(evt)
{
	document.getElementById("PostPaidNumber").style.display="block";
	document.getElementById("landLineNumber").style.display="none";
}


$(document).ready(function(){

	$('input[name=sbicardholder]').on('change',function(){
		var sbicardholdervalue = $(this).val();
		if(sbicardholdervalue == 'No'){
			$('#runningloan').show();
			$('#infomessage').html('<span class="app-wow">Wow!</span> You are almost done');
			$('#submitbtn').prop('disabled', false);
			$('#submitbtn').css('background', '#0982b2');
		}else{
			$('#runningloan').hide();
			$('#sbirelationship').hide();
			$('#bankaccount').hide();
			$('#sbiloanrunning').removeAttr('checked');
			$('#sbirelation').removeAttr('checked');
			$('#bankaccountnumber').val('');
			
			HideGenderField();

			$('#infomessage').html('Thank you for showing interest in <b>SBI credit card</b>, as you are already an <b>SBI Credit Card Holder</b>, we may not be able to service your request for another SBI Credit Card through our platform.');
			$('#submitbtn').prop('disabled', true);
			$('#submitbtn').css('background', 'grey');
		}
	});
	
	$('input[name=sbiloanrunning]').on('change',function(){
		var sbiloanrunningvalue = $(this).val();
		if(sbiloanrunningvalue == 'Yes'){
			$('#sbirelationship').hide();
			$('#bankaccount').hide();
			$('#sbirelation').removeAttr('checked');
			$('#bankaccountnumber').val('');
			
			$('#infomessage').html('Thank you for showing interest in <b>SBI credit card</b>, as you have applied for an <b>SBI Credit Card</b> in the past 6 months we may not be able to service your request for another SBI Credit Card through our platform');
			$('#submitbtn').prop('disabled', true);
			$('#submitbtn').css('background', 'grey');
		}else{
			$('#sbirelationship').show();
			
			$('#infomessage').html('<span class="app-wow">Wow!</span> You are almost done');
			$('#submitbtn').prop('disabled', false);
			$('#submitbtn').css('background', '#0982b2');
		}
	});
	
	$('input[name=sbirelation]').on('change',function(){
		var sbirelationvalue = $(this).val();
		if(sbirelationvalue == 'Yes'){
			$('#bankaccount').show();
		}else{
			$('#bankaccount').hide();
			$('#bankaccountnumber').val('');
		}
	});
	
	$('input[name=AddressDoc]').on('change',function(){
		var AddressDocValue = $(this).val();
		if(AddressDocValue == 'Yes'){
			$('#resiaddress1').attr("placeholder", "Current Residential Address 1");
			$('#resiaddress2').attr("placeholder", "Current Residential Address 2");
			$('#resiaddress3').attr("placeholder", "Current Residential Address 3 (Landmark)");
		}else{
			$('#resiaddress1').attr("placeholder", "Permanent Residential Address 1");
			$('#resiaddress2').attr("placeholder", "Permanent Residential Address 2");
			$('#resiaddress3').attr("placeholder", "Permanent Residential Address 3 (Landmark)");
		}
	});
});

function getCityFromPin(fieldname,pin)
{
	var	pin_code =document.getElementById(pin).value;
	if(pin_code.length == 6){
		$.ajax({
			type: 'POST',
			url: 'getcityfrompin.php',
			data: {
				pin_code: pin_code,
			},
			success: function (response) {
				//alert(response);
				//console.log(response);
				document.getElementById(fieldname).value = response;
			}
		});
	}
}


</script>
<style>
#ajax_listOfOptions{position:absolute;width:500px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana,'Raleway';text-align:left;font-size:10px;z-index:100}
#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}
#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}
#ajax_listOfOptions_iframe{background-color:red;position:absolute;z-index:5}

.hintanchor { font-size:12px; font-weight:bold; color:#F00;}
#wordloanAmount{ padding-bottom:15px;}
#wordIncome{ padding-bottom:15px;}
.alert_msg{ margin-bottom:15px;}
#nameVal{ padding-bottom:15px;}
#mobileVal{ padding-bottom:15px;}
</style>
<style>
    .doctable thead th{
    vertical-align: top;
    padding: 10px 7px;
    font-size: 14px;
    font-weight: 700;
    }
    .doctable > thead > tr > th:first-child{
        width:60%;
    }
    .doctable > thead > tr > th
    {
        background-color: #0c4669;
        color:#fff;
    }
    .doctable > tbody > tr > td{
      padding: 8px 7px;
      font-size: 12px; 
    }
    .doctable > tbody > tr > td.single-colmn{
       background-color: #0e79b9;
       color:#fff;
       font-size: 14px;
       font-weight:700;
    }
    .contentmodal-body{
		max-height:400px;
		overflow-y:auto;
	}
	.modal-docs{
	  margin-top:90px;
	}
	.modal-docs > .modal-content > .modal-header{
		text-align:left;
		display:block;
	}
	.modal-docs > .modal-content > .modal-header .close{
		margin-top:-25px;
		margin-right:-5px;
	}
	.accept-box{
		cursor:pointer;
	}
    @media (min-width: 992px){
        .modal-docs{
            max-width: 1000px;
        }
    }
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<!--<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:90px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> SBI Credit Card</span></div>-->
<div style="clear:both; height:70px;"></div>

<div class="bank-logos"><img src="/ccmobile/images/sbi-logo.png" /></div>
<div class="bank-text">Get Instant Online Approval for <? echo $cc_name; ?> In 30 seconds.<br />Receive Approval online and on Sms.<br />
100% data security with SBI online Approval systems.
</div>
<div class="card-image"><img src="/<? echo $ccrow["card_image"]; ?>" border="0" /></div> 
<div class="clearfix"></div>
<div class="app-counting bg-success"><strong>12,541</strong> Applications approved and counting .</div>
<div class="clearfix"></div>
<?php

$Name = $row['Name'];
$City = $row['City'];
$DOB = date("d/m/Y", strtotime($row['DOB']));
list($first,$middle,$last) = split('[ ]',$Name);
$retrivesource = "SBI cards page";
$subjectLine="";
//include "credit-card-apply-widget-step2.php";
include "credit-card-apply-widget-step2.php";
?>
 <div style="clear:both;"></div>

</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top">
<?php include "footer_sub_menu.php"; ?>
</div>
<!-- Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-docs" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentModalLabel">List of Acceptable Documents (Ensure you SIGN on the copy before uploading)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body contentmodal-body">
        <table class="table table-responsive table-bordered doctable">
         <thead>
			<tr>
			  <th>Documents</th>
			  <!--<th>Accepted As ID Proof</th>-->
			  <th>Accepted as Address proof</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Copy of Passport</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Copy of Voter’s ID card</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Driving License *</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
			<!--<tr>
			  <td>Copy of PAN Card</td>
			  <td>Yes</td>
			  <td>No</td>
			</tr>-->
			<tr>
			  <td>UID /Adhar Card</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Letter issued by the Unique Identification Authority of India  containing details of name, address and Aadhaar number</td>
			  <!--<td>No</td>-->
			  <td>Yes</td>
			</tr>
			<!--<tr>
			  <td>Identity card with applicant's Photograph issued by Central / State Government Departments, Statutory/Regulatory Authorities, Public Sector Undertakings, Scheduled Commercial Banks, and Public Financial Institutions</td>
			  <td>Yes</td>
			  <td>No</td>
			</tr>-->
			<!--<tr>
			  <td>Letter issued by a gazetted officer, with a duly attested photograph of the person;</td>
			  <td>Yes</td>
			  <td>No</td>
			</tr>-->
			<tr>
			  <td>Overseas Citizen of India Card issued by Government along with the passport to NRIs and PIOs</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Electricity bill, Telephone bill, Postpaid mobile phone bill, Piped gas bill, Water bill</td>
			  <!--<td>No</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Property or Municipal Tax receipt</td>
			  <!--<td>No</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Bank account or Post Office savings bank account statement</td>
			  <!--<td>No</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Letter of allotment of accommodation from employer issued by State or Central Government departments, statutory or regulatory bodies, public sector undertakings, scheduled commercial banks, financial institutions and listed companies. Similarly, leave and license agreements with such employers allotting official accommodation</td>
			  <!--<td>No</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Pension or family pension payment orders (PPOs) issued to retired employees by Government Departments or Public Sector Undertakings, if they contain the address</td>
			  <!--<td>No</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td colspan="3" class="single-colmn">For Defense Personnel</td>
			</tr>
			<tr>
			  <td>Serving certificate with a photo. Issue date should be within 60 days from date of processing.</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Employer ID card having address details and photo.</td>
			  <!--<td>Yes</td>-->
			  <td>Yes</td>
			</tr>
		  </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
</body>
</html>
