<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$_SESSION['Temp_LID'] = '3295317';
	$sql ="select City,Employment_Status,EMI_Paid,source,DOB,Email,Name,Mobile_Number From Req_Loan_Personal Where (RequestID=".$_SESSION['Temp_LID'].")";
	list($CheckNumRows,$flg)=Mainselectfunc($sql,$array = array());
	$sourcepg= $flg["source"];
	
	$productid = $_SESSION['Temp_LID'];
	
	$jsondata = '';
	if($_POST['method'] == 'GetDetails'){
		$Pancard = $_POST['Pancard'];
		$Gender = $_POST['Gender'];
		$Pincode = $_POST['Pincode'];
		$Residence_Address = $_POST['Residence_Address'];
		$StateCode = $_POST['StateCode'];

		$Name= $flg["Name"];
		$Email= $flg["Email"];
		$Mobile_Number= $flg["Mobile_Number"];
		$DOB= $flg["DOB"];
		$City= $flg["City"];

		/*
		$Pancard = 'AEBPJ3977L';
		$Gender = '1';
		$Pincode = '110003';
		$Residence_Address = 'MINISTRY OF ENVIRONMENT A V 2 3 4 VAYU';
		$StateCode= '07';
		$Name= 'Ajay Joshi';
		$Email= 'abell@transunion.com';
		$Mobile_Number= '9952277966';
		$DOB= '1970-04-22';
		$City= 'Delhi';
		*/
		
		$CibilDataArr['productid'] = $productid;
		$CibilDataArr['Full_Name'] = $Name;
		$CibilDataArr['Email'] = $Email;
		$CibilDataArr['Mobile_Number'] = $Mobile_Number;
		$CibilDataArr['DOB'] = $DOB;
		$CibilDataArr['City'] = $City;
		$CibilDataArr['Pancard'] = $Pancard;
		$CibilDataArr['Gender'] = $Gender;
		$CibilDataArr['Pincode'] = $Pincode;
		$CibilDataArr['Residence_Address'] = $Residence_Address;
		$CibilDataArr['StateCode'] = $StateCode;
		$extraarray=array("apicall"=>"CibilFulfilOffer");
		$PostArray=array_merge($CibilDataArr,$extraarray);
		$jsondata=json_encode($PostArray);
		echo $jsondata;
		exit;
	}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<link href="source.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
<!--
.red {color:#F00;}
-->
</style>
<style type="text/css">
		/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
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
	
	form{
		display:inline;
	}
 
h3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	text-decoration:none;
	color:#660000;
	padding:0px;
	margin:0px 0px 0px 0px;
	text-align:left;
	cursor:pointer;
}

.faqContainer .toggler {
	padding:5px 0px 0px 15px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:17px;
	font-weight:bold;
	text-align:justify;
	cursor:pointer;
}

.elementInside{
	border-bottom:1px dashed #6a290d;
	margin:0px 0px 4px 0px;
	padding:0px 0px 6px 0px; 
} 
input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}
.cibil-wrapper{
	font-weight:normal;
	line-height: 16px;
	color: #4f4d4d;
}
.cibil-wrapper tr td{
	padding:5px;
}
.question-text{ font-weight:bold; color:#000;}

.submit-btn-cibil{ 
	background:#0e79b9; 
	text-align:center; 
	color:#FFF; 
	padding:10px 15px 10px 15px; 
	border-radius:10px; 
	width:80px; 
	border:none;
}

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}    
		 
/* extra div*/
.expandeddiv{
height:138px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}
.addexpandeddiv{
height:150px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}

</style>
<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#0b3154');
},

onBackground: function(toggler, element){
toggler.setStyle('color', '#0b3154');
}
}, $('accordion'));

//This is for default selected optio		
var newTog = new Element('h3', {'class': 'toggler1'}).setHTML('');

var newEl = new Element('div', {'class': 'element1'}).setHTML('');

accordion.addSection(newTog, newEl, 0);
}); 

</script>
<script Language="JavaScript" Type="text/javascript">

function addDiv()
{
	var ni = document.getElementById('mynewDiv');
	
	if(ni.innerHTML=="")
	{
	
		if(document.personalloan_form.LoanAny.value="on")
		{
			//alert(document.loan_form.CC_Holder.value);
			ni.innerHTML = '<div id="expanddiv" class="expandeddiv" ></div>';
		}
	}
	
	return true;
}

function addElementLoan()
{
	var ni = document.getElementById('myDivLoan');
	
	if(ni.innerHTML=="")
	{	
			ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td colspan="3" align="left"  style="color:#000000;" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"  style="color:#000000;"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left"><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="cdl" />Consumer Durable</td></tr></table></td></tr><tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td colspan="3"  align="left"><select name="EMI_Paid"  class="emi_input" > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr></table>';			
	}
	
	return true;
}

function blockSpecialChar(e){
	e = e || event;
	return /^[a-zA-Z0-9-#'(),. ]+$/.test(
		   String.fromCharCode(e.charCode || e.keyCode)
	   );
}

function blockAllSpecialChar(e) {
	e = e || event;
	return /[a-z0-9]/i.test(
		   String.fromCharCode(e.charCode || e.keyCode)
	   ) || !e.charCode && e.keyCode  < 48;
}

function removeElementLoan()
{
	var ni = document.getElementById('myDivLoan');
	
	if(ni.innerHTML!="")
	{		
			//alert(document.loan_form.CC_Holder.value);
			ni.innerHTML = '';			
	}
	
	return true;
}

function submitform(Form)
{

	var btn2;
	var btn3;
	var myOption;
	var i;
	var incpf;
	if(Form.Primary_Acc.value=="")
	{
		alert("Please fill your Salary Account.");
		Form.Primary_Acc.focus();
		return false;
	}
	if (Form.Residence_Address.value == "")
    {
        alert('Please enter residence Address');
        Form.Residence_Address.focus();
        return false;
    }
	if (Form.residence_pincode.value == "")
    {
        alert('Please enter Pincode');
        Form.residence_pincode.focus();
        return false;
    }
    var a=Form.Pancard.value;
    var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
    if(regex1.test(a)== false)
    {
        alert('Please enter correct PAN number');
        Form.Pancard.focus();
        return false;
    }
    if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
    {
       alert('Please enter correct PAN number');
        Form.Pancard.focus();
        return false;
    }

    if((Form.Pancard.value==""))
    {
        alert('Please enter PAN number');	
        Form.Pancard.focus();
        return false;
    }
	<?
	if($flg['Employment_Status']==0) 
	{
	?>
		if(Form.professional_details.selectedIndex==0)
		{
			alert("Please enter Professional Details to Continue");
			Form.professional_details.focus();
			return false;
		}
	<?
	}
	else
	{
	?>
		if(Form.Company_Type.selectedIndex==0)
		{
			alert("Please enter Company Type to Continue");
			Form.Company_Type.focus();
			return false;
		}
	<?
	}
	?>
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;
	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;
	<?
	if($flg["EMI_Paid"]>0)
	{ } 
	else 
	{
	?>
		myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}
				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
	<?
	}
	?>
	return true;
}

function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Loan_Any.length; i++) 
	{
        if(document.personalloan_form.Loan_Any[i].checked)
		{
			cnt=i;
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}

</script>
<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}

.colprop{
color:#373737;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:15px;

}
</style>
<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script>
(function($){
    $(document).ready(function() {
		$("#cibilcheck").change(function() {
			if(this.checked) {
				$('#quotediv').hide();
				$('#quotediv').prop('disabled', true);
				
				$('#cibildiv').show();
				$('#cibilterms').show();
			}
			else{
				$('#cibildiv').hide();
				$('#cibilterms').hide();
				$('#cibildiv').prop('disabled', true);
				
				$('#quotediv').show();
			}
		});
	
		$( "#getCibil" ).on('click', function(){
			var Primary_Acc = $('#Primary_Acc').val();
			var Gender = $('input[name="Gender"]').val();
			var Residential_Status = $('input[name="Residential_Status"]').val();
			var Residence_Address = $('#Residence_Address').val();
			var residence_pincode = $('#residence_pincode').val();
			var State = $('#State').val();
			alert(State);
			var Pancard = $('#Pancard').val();
			var Company_Type = $('#Company_Type').val();
			var Years_In_Company = $('input[name="Years_In_Company"]').val();
			var Total_Experience = $('input[name="Total_Experience"]').val();
			var LoanAny = $('input[name="LoanAny"]:checked').val();
			
			if(Primary_Acc != '' && Gender != '' && Residential_Status != '' && Residence_Address != '' && residence_pincode!= '' && State != '' && Pancard != '' && Company_Type != '' && Years_In_Company != '' && Total_Experience != '' && LoanAny != '' && LoanAny !== undefined){

				var JSONdata = '';
				$.ajax({
					type: "POST",
					url: "apply-for-personal-loans-continue-cibil-uat.php",
					data: { 
						method: 'GetDetails',
						Pancard: Pancard,
						Gender: Gender,
						Pincode: residence_pincode,
						Residence_Address: Residence_Address,
						StateCode: State,
					},
					success: function (response) {
						console.log(response);
						JSONdata=response;
						displayVals(JSONdata);
					}
				});
			}
			else{
				alert("Please fill all above fields to check CIBIL Score");
				return false;
			}
		});
		
		$( "#submitEmail" ).on('click', function(){
			var cibilEmail = $('#cibilEmail').val();
			
			if(cibilEmail == ''){
				alert('Enter Email Address');
				$('#cibilEmail').focus();
				return false;
			}
			var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
			if (!testEmail.test(cibilEmail)){
				alert('Enter Valid Email Address!');
				$('#cibilEmail').focus();
				return false;
			}
			
			$.ajax({
				url: 'apply-for-personal-loans-continue-cibil-uat.php',
				type: 'POST',
				data: {
					method: 'SendCibilEmail',
					cibilEmail: cibilEmail,
					productid: <?php echo $productid; ?>,
				},
				success: function(response){
					console.log(response);
					if(response == 'Success'){
						//var image = "http://www.deal4loans.com/new-images/loader-cibil-new.gif";
						//$('#cibilEmaildiv').html('<img src='+image+' />');
						window.setTimeout(function(){
							$("#personalloan_form").submit();
						}, 500);
					}
				}
			});
		});
		
		function displayVals(JSONdata){
			var image = "http://www.deal4loans.com/new-images/loader-cibil-new.gif";
			$('#loading').html("<img src='"+image+"' />");
			
			$('#headertext').html("Share few more details to authenticate yourself and get your Free CIBIL Score and Report.");
			
			var JSONdata = JSON.parse(JSONdata);

			$.ajax({
				url: 'api/v1/cibil/cibil_fulfil_offer.php',
				type: 'POST',
				data : JSONdata,
				success: function (response, status, xhr) {
					console.log(response);
					$('#cibilterms').hide();
					//alert(response);
					if(response.indexOf("Your Cibil Score") >= 0){
						//alert('text1');
						//$('#CibilWrapper').hide();
						$('#plformdiv').hide();
						$('#loading').html("").hide();
						//$('#cibilEmaildiv').show();
						$('#CibilWrapper').html('<div id="loadingnew"><img src='+image+' /></div>');
						window.setTimeout(function(){
							$("#personalloan_form").submit();
						}, 500);
					}
					else if((response.indexOf("Unable to Find") >= 0) || (response.indexOf("where to go") >= 0) || (response.indexOf("Issue at Wishfin") >= 0) || (response.indexOf("Failed at Cibil API") >= 0) || (response.indexOf("Issue at Cibil") >= 0) || (response.indexOf("Error in getting viewed") >= 0)){
						//alert('text1');
						$('#CibilWrapper').html('<div id="loadingnew"><img src='+image+' /></div>');
						$('#plformdiv').hide();
						$('#loading').html("").hide();
						
						window.setTimeout(function(){
							$("#personalloan_form").submit();
						}, 500);
					}
					else{
						//alert('html1');
						$('#CibilWrapper').html(response);
						$('#plformdiv').hide();
						$('#loading').html("").hide();
					}
				}
			});
		}

		$('#CibilWrapper').on('click','.checkEligible', function(){
			//alert('checkEligible');
			var image = "http://www.deal4loans.com/new-images/loader-cibil-new.gif";
			$('#loading1').html("<img src='"+image+"' />");
			$('#loading1').css({"display":"block"});
			var data=$('#CibilAuthenticationQuest').serialize();
			var identify="From_Form";
			$.ajax({
				type: 'POST',
				url: 'api/v1/cibil/cibil_fulfil_offer.php',
				data: {
					data,
					identify: identify,
					productid: <?php echo $productid; ?>,
				},
				success: function (response, status, xhr) {
					//console.log(response);
					if(response.indexOf("Your Cibil Score") >= 0){
						//alert('text1');
						$('#CibilWrapper').hide();
						$('#loading1').html("").hide();
						$('#cibilEmaildiv').show();
					}
					else if((response.indexOf("Unable to Find") >= 0) || (response.indexOf("where to go") >= 0) || (response.indexOf("Issue at Wishfin") >= 0) || (response.indexOf("Failed at Cibil API") >= 0) || (response.indexOf("Issue at Cibil") >= 0) || (response.indexOf("Error in getting viewed") >= 0)){
						//alert('text2');
						$('#CibilWrapper').html('<div id="loading"><img src='+image+' /></div>');
						$('#loading1').html("").hide();
						
						window.setTimeout(function(){
							$("#personalloan_form").submit();
						}, 500);
					}
					else{
						//alert('html2');
						$('#CibilWrapper').html(response);
						$('#loading1').html("").hide();
					}
				}
			});	
		});
	});
})(jQuery);
</script>
</head>
<body>
<!--top-->
<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<div style="clear:both; height:70px;"></div>
<!--logo navigation-->
<div class="lac-main-wrapper">
	<div class="text12"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</a></div>
	<div style="clear:both; height:15px;"></div>
	<div class="text12">
	<div class="plqr-wrapper">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>               
						<td align="center" valign="middle" style="color: #643E02; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">60% of your application for quote from all Banks is complete.</td>            
					</tr>
					<tr>
						<td align="center" >&nbsp;</td>            
					</tr>	  
					<tr>               
						<td align="center" valign="middle" ><img src="/new-images/hl/ajax-loader.gif" width="220" height="19" /></td>
					</tr>
					<tr>
						<td align="center" >&nbsp;</td>            
					</tr>
					<tr>
						<td align="center" valign="middle" style="color: #136071; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; "><div id="headertext">Share few more details to get exact quote on Emi,Rates & Loan Amount.</div>
						</td>            
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top" style="padding-top:8px; ">
				<table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<div class="common-from-cont-wrapper">
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td height="21" style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
									</tr>
									<tr>
										<td>
											<div id="plformdiv">
												<!--<form id="personalloan_form" name="personalloan_form"  action="" method="POST">-->
													<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
													<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr align="center" bgcolor="#f4f4f4">
															<td height="35" colspan="2" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; "> Personal Loan Quote Request</td>
														</tr>
														<tr>
															<td height="10" colspan="2" ></td>
														</tr>
														<tr>
															<td width="35%" height="35" align="left" class="bldtxt">Primary Account in which bank?  </td>
															<td width="65%" height="20"  align="left"><input type="text" class="emi_input" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();"></td>
														</tr>
														<? 
														if($flg['Employment_Status']==0) 
														{ } 
														else 
														{
														?> 
														<tr>
															<td height="20" align="left" class="bldtxt">Gender</td>
															<td  align="left" >
															<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
																<tr>
																	<td width="6%" ><input type="radio" style="border:none;" value="1" name="Gender"  checked="checked" /></td>
																	<td width="19%" style="color:#000000;" >Male</td>
																	<td width="6%" ><input type="radio" style="border:none;" value="2" name="Gender" /></td>
																	<td width="19%" style="color:#000000;" > Female</td>
																	<td width="6%" ></td>
																	<td width="44%" style="color:#000000;" ></td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20" align="left" class="bldtxt">Residential Status </td>
															<td  align="left" >
															<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
																<tr>
																	<td width="6%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" /></td>
																	<td width="19%" style="color:#000000;" >                        Owned</td>
																	<td width="6%" ><input type="radio" style="border:none;" value="2" name="Residential_Status" /></td>
																	<td width="19%" style="color:#000000;" >                        Rented</td>
																	<td width="6%" ><input type="radio" style="border:none;" value="3" name="Residential_Status" /></td>
																	<td width="44%" style="color:#000000;" > Company Provided</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="35" class="bldtxt">Residence Address</td>
															<td class="frmtxt"> <textarea name="Residence_Address" id="Residence_Address" maxlength="250" onkeypress="return blockSpecialChar(event)"></textarea></td>
														</tr> 
														<tr>
															<td height="35" class="bldtxt">Residence Pincode</td>
															<td class="frmtxt"><input type="text" name="residence_pincode" id="residence_pincode" maxlength="6" class="emi_input" /></td>
														</tr> 
														<tr>
															<td height="35" class="bldtxt">State</td>
															<td class="frmtxt">
															<select name="State" id="State" class="emi_select">
																<option value="0">Jammu & Kashmir</option>
																<option value="2">Himachal Pradesh</option>
																<option value="3">Punjab</option>
																<option value="4">Chandigarh</option>
																<option value="5">Uttaranchal</option>
																<option value="6">Haryana</option>
																<option value="7">Delhi</option>
																<option value="8">Rajasthan</option>
																<option value="9">Uttar Pradesh</option>
																<option value="10">Bihar</option>
																<option value="11">Sikkim</option>
																<option value="12">Arunachal Pradesh</option>
																<option value="13">Nagaland</option>
																<option value="14">Manipur</option>
																<option value="15">Mizoram</option>
																<option value="16">Tripura</option>
																<option value="17">Meghalaya</option>
																<option value="18">Assam</option>
																<option value="19">West Bengal</option>
																<option value="20">Jharkhand</option>
																<option value="21">Orissa</option>
																<option value="22">Chhattisgarh</option>
																<option value="23">Madhya Pradesh</option>
																<option value="24">Gujarat</option>
																<option value="25">Daman & Diu</option>
																<option value="26">Dadra & Nagar Haveli</option>
																<option value="27">Maharashtra</option>
																<option value="28">Andhra Pradesh</option>
																<option value="29">Karnataka</option>
																<option value="30">Goa</option>
																<option value="31">Lakshadweep</option>
																<option value="32">Kerala</option>
																<option value="33">Tamil Nadu</option>
																<option value="34">Pondicherry</option>
																<option value="35">Andaman & Nicobar Islands</option>
																<option value="36">Telangana</option>
																<option value="99">APO Address</option>
															</select>
															</td>
														</tr>
														<tr>
															<td height="35" class="bldtxt">PAN No</td>
															<td class="frmtxt"><input type="text" name="Pancard" id="Pancard" maxlength="10" class="emi_input" style="text-transform: uppercase" onkeypress="return blockAllSpecialChar(event)"  /></td>
														</tr> 
														<tr>
															<td height="35" class="bldtxt">Company Type</td>
															<td class="frmtxt">
															<select name="Company_Type" id="Company_Type" class="emi_select">
																<option value="0">Please Select</option>
																<option value="1">Pvt Ltd</option>
																<option value="2">MNC Pvt Ltd</option>
																<option value="3">Limited</option>

																<option value="4">Govt.( Central/State )</option>
																<option value="5">PSU (Public sector Undertaking)</option>
															</select>
															</td>
														</tr>  
														<? 
														}
														?>
														<? 
														if($flg['Employment_Status']==0) 
														{ 
														?>
														<tr>
															<td height="35" class="bldtxt">Professional details</td>
															<td class="frmtxt">
															<select name="professional_details" id="professional_details" class="emi_input">
																<option value="0">Please Select</option>
																<option value="1">Businessmen</option>
																<option value="2">Doctor</option>
																<option value="3">Engineer</option>
																<option value="4">Architect</option>
																<option value="5">Chartered Accountant</option>
															</select>
															</td>
														</tr>  
														<? 
														}
														?>
														<tr>
															<td height="35" align="left" class="bldtxt" >
																<? 
																if($flg['Employment_Status']==0) { 
																	echo "Current Business Stability (in Years)";
																} else { 
																	echo "No. of years in this Company"; 
																} ?>
															</td>
															<td align="left" ><input type="text" name="Years_In_Company" class="emi_input" maxlength="15"></td>
														</tr>
														<tr>
															<td height="42" align="left" class="bldtxt" >Total Experience (Years)/
														Total Years in Business</td>
															<td align="left" ><input class="emi_input"  name="Total_Experience" onfocus="this.select();"></td>
														</tr>
														<tr>
															<td colspan="2"><input type="hidden" value="PersonalLoan" name="type"/></td>
														</tr>
													
														<tr>
															<td height="30" align="left" class="bldtxt" >Any Loan running?</td>
															<td align="left" style="color:#000000;" >
															  <input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;
															  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No
															</td>
														</tr>
														<tr>
															<td colspan="2" id="myDivLoan"></td>
														</tr>
														
														<tr>
															<td colspan="2"><div id="CibilVal" class="bldtxt" style="padding-top: 10px; padding-bottom: 10px;"><input type="checkbox" name="cibilcheck" id="cibilcheck">&nbsp; Your Loan Approval Depends on Your CIBIL Score*. Get your <span style="cursor:pointer;color: #3671d5;">Free CIBIL Score</span> & Report while we work on customizing your loan offers</div></td>
														</tr>
														<tr>
															<td colspan="2"><div id="loading"></div></td>
														</tr>
														<tr>
															<td height="35" colspan="2" align="center">
																<div id="quotediv">
																	<input type="image" name="Submit" id="getQuote" src="/new-images/pl/quote.gif" style="width:115px; height:29px; border:none;" onclick="return submitform(document.personalloan_form);"/>
																</div>
																<div id="cibildiv" style="display:none;">
																	<input type="button" name="getCibil" id="getCibil" style="width:115px; height:29px; border:none;background-image: url('/new-images/pl/quote.gif');"/>
																</div>
															</td>
														</tr>
													</table>
												</form>
											</div>
											<div id="cibilterms" class="bldtxt" style="margin-left: 30px; display:none;">* T&C Apply</div>
											<div class="cibil-wrapper" id="CibilWrapper">
												
											</div>
											<div id="cibilEmaildiv" style="display:none;">
													<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td colspan="2"><div class="bldtxt" style="padding-top: 10px; padding-bottom: 10px;">Pls enter your email id where you would want your CIBIL report to be shared</div></td>
														</tr>
														<tr>
															<td width="35%" height="35" align="left" class="bldtxt">Email ID</td>
															<td width="65%" height="20"  align="left"><input type="text" class="emi_input" name="cibilEmail" id="cibilEmail"></td>
														</tr>
														<tr>
															<td height="35" colspan="2" align="center">
																<input type="button" name="submitEmail" id="submitEmail" class="checkEligible submit-btn-cibil" value="Send"/>
															</td>
														</tr>
														<tr><td colspan="2" align="right"><img src="/new-images/cibil-logo.png" alt="Logo"></td></tr>
													</table>
												</form>
											</div>
											
										</td>
									</tr>
									<tr>
										<td height="21"  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
									</tr>
								</table>
							</div>
						</td>    
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</div>
	</div>
	<div style="clear:both; height:15px;"></div>
</div>
	<? 
	 if($flg["source"]=="requestpersonal-mobile" || $flg["source"]=="PLForm_sept")
		 { //echo "entered";?>
			<!-- Google Code for lead Conversion Page -->
			<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 1066264455;
			var google_conversion_language = "en";
			var google_conversion_format = "3";
			var google_conversion_color = "ffffff";
			var google_conversion_label = "UcZECLrjrlYQh8-3_AM";
			var google_remarketing_only = false;
			/* ]]> */
			</script>
			<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
			</script>
			</div>
			<noscript>
			<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?label=UcZECLrjrlYQh8-3_AM&amp;guid=ON&amp;script=0"/>
			</div>
			</noscript>
		 <?  } ?>
	
	<?php include "footer_sub_menu.php"; ?>
	<?	
	if($sourcepg=="lowestrateLP_22jan16")
	{ ?>
		<!-- Google Code for display Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1066264455;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "9xm0CNvGsGMQh8-3_AM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?label=9xm0CNvGsGMQh8-3_AM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
	<? }
	 
	if((strlen(strpos($_SERVER['HTTP_REFERER'], "laptop-apply-for-personal-loans.php")) > 0))
		 { ?>	 

	<!-- Google Code for Laptop Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en_US";
	var google_conversion_format = "1";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "ZdyQCIPJiQEQh8-3_AM";
	var google_conversion_value = 0;
	if (1.0) {
	  google_conversion_value = 1.0;
	}
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=ZdyQCIPJiQEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
		 <?  }
	elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "desktop-apply-for-personal-loans.php")) > 0))
		 { ?>
	<!-- Google Code for Desktop Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "17L4CJXKqAEQh8-3_AM";
	var google_conversion_value = 0;
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=17L4CJXKqAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
		 <? 
		 }	
	else if((strlen(strpos($_SERVER['HTTP_REFERER'], "lcd-apply-for-personal-loans.php")) > 0))
		  { ?>
	<!-- Google Code for LCD Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "1PcVCNPTnQEQh8-3_AM";
	var google_conversion_value = 0;
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=1PcVCNPTnQEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }	
	else if((strlen(strpos($_SERVER['HTTP_REFERER'], "tft-apply-for-personal-loans")) > 0))
		  { ?>
	<!-- Google Code for TFT Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "3Qh4CJ-bogEQh8-3_AM";
	var google_conversion_value = 0;
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=3Qh4CJ-bogEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }	
	else if((strlen(strpos($_SERVER['HTTP_REFERER'], "personal-loans-emi.php")) > 0))
		  { ?>
	<!-- Google Code for EMI PL Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en_US";
	var google_conversion_format = "1";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "106RCMmqkAEQh8-3_AM";
	var google_conversion_value = 0;
	if (1.0) {
	  google_conversion_value = 1.0;
	}
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=106RCMmqkAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }	
	else if((strlen(strpos($_SERVER['HTTP_REFERER'], "news-apply-personal-loans.php")) > 0))
		  { ?>
	<!-- Google Code for retire-content Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en_US";
	var google_conversion_format = "1";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "pAZBCO3KkgEQh8-3_AM";
	var google_conversion_value = 0;
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=pAZBCO3KkgEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }
	else if((strlen(strpos($_SERVER['HTTP_REFERER'], "apply-personal-loans-banks.php")) > 0))
		  { ?>
	<!-- Google Code for Loans-Only Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en_US";
	var google_conversion_format = "1";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "raymCOnKkwEQh8-3_AM";
	var google_conversion_value = 0;
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=raymCOnKkwEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }
	elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "fullertonpl-apply-personal-loans.php")) > 0))
		  { ?>
	<!-- Google Code for Fullerton Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "5LbpCJvHaRCHz7f8Aw";
	var google_conversion_value = 0;
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=5LbpCJvHaRCHz7f8Aw&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }	
	elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "barcfinpl-apply-personal-loans.php")) > 0))
		  { ?>
	<!-- Google Code for Barclays Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en_US";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "Vn98CP_niAEQh8-3_AM";
	var google_conversion_value = 0;
	if (1.0) {
	  google_conversion_value = 1.0;
	}
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=Vn98CP_niAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }
	elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "hdfcpl-apply-personal-loans.php")) > 0))
		  { ?>
	<!-- Google Code for HDFC PL Conversion Page -->
	<script type="text/javascript">
	<!--
	var google_conversion_id = 1066264455;
	var google_conversion_language = "en_US";
	var google_conversion_format = "1";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "5-E-CM_jjQEQh8-3_AM";
	var google_conversion_value = 0;
	if (1.0) {
	  google_conversion_value = 1.0;
	}
	//-->
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=5-E-CM_jjQEQh8-3_AM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	 <? 
		 }	
	elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "fb-personal-loans.php")) > 0))
		  {?>
	<script src="//ah8.facebook.com/js/conversions/tracking.js"></script><script type="text/javascript">
	try {
	  FB.Insights.impression({
		 'id' : 6002449792250,
		 'h' : '9fa90dac14'
	  });
	} catch (e) {}
	</script>
	 <? } 
if($sourcepg=="CAD_Tmsintdesktop31august15" || $sourcepg=="CAD_Tmsintmobile31august15" || $sourcepg=="CAD_Bsnsdesktop31august15" || $sourcepg=="CAD_Bsnsmobile31august15" || $sourcepg=="CAD_YahNatdesktop31august15" || $sourcepg=="CAD_YahNatmobile31august15" || $sourcepg=="CAD_Bhkrdesktop31august15" || $sourcepg=="CAD_Bhkrmobile31august15")
{ ?>
<script src="//tt.mbww.com/tt-a5ae3f2dbbf72da099be343eabff98aae7ac71c6f71cf1f1583825c92fd085ba.js" async>
</script>
<? }
?>
</body>
</html>
