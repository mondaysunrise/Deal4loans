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

	$slctcrd="select card_image,cc_bank_features from credit_card_banks_eligibility Where (cc_bankid='".$cc_bankid."')";
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
<link href="http://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-ui-new.css" type="text/css" rel="stylesheet">
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="http://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="http://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
	
	var txtRes = document.getElementById("resiaddress1").value;
	var reRes = /^[ A-Za-z0-9(',./#)+-]*$/
	
	if((Form.resiaddress1.value==""))
	{
        document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Resi Address</span>";		
		Form.resiaddress1.focus();
		return false;
	}
	
	if (!reRes.test(txtRes)) {
 		document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Resi Address</span>";		
		Form.resiaddress1.focus();
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
}

function ShowPostPaidField(evt)
{
	document.getElementById("landLineNumber").style.display="none";
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
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<!--<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:90px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> SBI Credit Card</span></div>-->
<div style="clear:both; height:70px;"></div>

<div class="bank-logos"><img src="/new-images/standardchartered_logo.jpg" /></div>
<div class="bank-text">Get Instant Online Approval for <? echo $cc_name; ?> In 30 seconds.<br /><?php echo $ccrow["cc_bank_features"]; ?>
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
include "scb-credit-card-widget.php";
?>
 <div style="clear:both;"></div>

</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div></body>
</html>