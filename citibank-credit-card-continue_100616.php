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
	$slct="select applied_card_name,Name,DOB,City from Req_Credit_Card Where (RequestID='".$RequestID."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$Name = $row['Name'];
	list($first,$middle,$last) = split('[ ]',$Name);

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
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="http://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-uiciti.css" type="text/css" rel="stylesheet">
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="http://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="http://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000;
}

</style>
<script type="text/javascript">
function valiccstep2frm(Form)
{
	var j;
	var l;
	var r;
	var k;
	var cntr=-1;
	var cnt=-1;
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
	for(j=0; j<document.ccstep2frm.Gender.length; j++) 
	{
        if(document.ccstep2frm.Gender[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Gender!");
		return false;
	}
	
	//var txtRes = document.getElementById("resiaddress1").value;
	//var reRes = /^[ A-Za-z0-9(',./#)+-]*$/
	
	if((Form.housename.value==""))
	{
        document.getElementById('housenameVal').innerHTML = "<span  class='hintanchor'>Please Enter Door/house no.</span>";		
		Form.housename.focus();
		return false;
	}
	
	if((Form.streeRoad.value==""))
	{
        document.getElementById('streeRoadVal').innerHTML = "<span  class='hintanchor'>Please Enter Street and road name</span>";		
		Form.streeRoad.focus();
		return false;
	}
	
	if((Form.areaLocality.value==""))
	{
        document.getElementById('areaLocalityVal').innerHTML = "<span  class='hintanchor'>Please Enter Area/Locality</span>";		
		Form.areaLocality.focus();
		return false;
	}
	if((Form.landmark.value==""))
	{
        document.getElementById('landmarkVal').innerHTML = "<span  class='hintanchor'>Please Enter Landmark</span>";		
		Form.landmark.focus();
		return false;
	}
		
	/*if (!reRes.test(txtRes)) {
 		document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Resi Address</span>";		
		Form.resiaddress1.focus();
		return false;
	}*/
	
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Please Select your Residence City!</span>";
		Form.City.focus();
		return false;
	}
	
	if((Form.pincode.value==""))
	{
        document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Enter Pincode</span>";		
		Form.pincode.focus();
		return false;
	}
	else if(Form.pincode.value.length < 6)
		{
		 document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Pincode cannot be less than 6 digits</span>";
		Form.pincode.focus();
		return false;
		}
		
if((Form.Designation.value==""))
	{
        document.getElementById('DesignationVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Designation</span>";		
		Form.Designation.focus();
		return false;
	}
	
	//var txt = document.getElementById("OfficeAddress1").value;
	//var re = /^[ A-Za-z0-9(',./#)+-]*$/
	if((Form.buildingName.value==""))
	{
        document.getElementById('buildingNameVal').innerHTML = "<span  class='hintanchor'>Please Enter Office Building name/no.</span>";		
		Form.buildingName.focus();
		return false;
	}
	
	if((Form.OffiStreet.value==""))
	{
        document.getElementById('OffiStreetVal').innerHTML = "<span  class='hintanchor'>Please Enter Office Street/road name.</span>";		
		Form.OffiStreet.focus();
		return false;
	}
	if((Form.OffiArea.value==""))
	{
        document.getElementById('OffiAreaVal').innerHTML = "<span  class='hintanchor'>Please Enter Office Area/Locality</span>";		
		Form.OffiArea.focus();
		return false;
	}	
	
	/*if (!re.test(txt)) {
	
 		document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Address</span>";		
		Form.OfficeAddress1.focus();
		return false;
	}*/
	
	if((Form.OfficeCity.value=="Please Select"))
	{
        document.getElementById('OfficeCityVal').innerHTML = "<span  class='hintanchor'>Please Select Your office City</span>";		
		Form.OfficeCity.focus();
		return false;
	}
	
	if((Form.OfficePin.value==""))
	{
		document.getElementById('OfficePinVal').innerHTML = "<span  class='hintanchor'>Please Enter office pincode</span>";		
		Form.OfficePin.focus();
		return false;
	}
	else if(Form.OfficePin.value.length < 6)
		{
		document.getElementById('OfficePinVal').innerHTML = "<span  class='hintanchor'>Pincode cannot be less than 6 digits</span>";
		Form.OfficePin.focus();
		return false;
		}

for(k=0; k<document.ccstep2frm.mailAddr.length; k++) 
	{
        if(document.ccstep2frm.mailAddr[k].checked)
		{
   	 		cntl= k;
		}
	}
	if(cntl == -1) 
	{
		alert("Select mailing address!");
		return false;
	}
	
	if (Form.Land_linenumber.selectedIndex==0)
	{
		document.getElementById('Land_linenumberVal').innerHTML = "<span  class='hintanchor'>Please Select Landline!</span>";
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}


function ShowCityField(evt)
{
document.getElementById("ShowCityAddr").style.display="block";
}
function showProfDetails(evt)
{
document.getElementById("ShowProfDetails").style.display="block";
}

function showProfDetail(evt)
{
	document.getElementById("ShowProfDetails").style.display="block";
	}

</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<!--<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:90px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> SBI Credit Card</span></div>-->
<div style="clear:both; height:70px;"></div>

<div class="bank-logos"><img src="/ccmobile/images/citibank-logo.jpg" /></div>
<div class="bank-text">Get Instant Online Approval for <? echo $cc_name; ?> In 30 seconds.<br />Receive Approval online and on Sms.<br />
100% data security with CitiBank online Approval systems.
</div>
<div class="card-image"><img src="/<? echo $ccrow["card_image"]; ?>" border="0"></div> 
<div class="clearfix"></div>
<div class="app-counting bg-success"><strong>12,541</strong> Applications approved and counting .</div>
<div class="clearfix"></div>
<?php
$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];
$Name = $row['Name'];
$City = $row['City'];
$DOB = date("d/m/Y", strtotime($row['DOB']));
list($first,$middle,$last) = split('[ ]',$Name);
$retrivesource = "SBI cards page";
$subjectLine="";
//include "credit-card-apply-widget-step2.php";
//include "credit-card-apply-widget-citicard.php";
include "credit-card-apply-widget-citicard_100616.php";
?>
 <div style="clear:both;"></div>

</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div></body>
</html>