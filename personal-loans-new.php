<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0){	$retrivesource="PL Site Page"; }else{	$retrivesource="PL Site Page";}

//$showBankListQryEmi = ExecQuery("Select rateid,bank_name From personal_loan_interest_rate_chart where (flag=1) order by bankwise_priority ASC");

$showBankListSql = "Select rateid,bank_name From personal_loan_interest_rate_chart where (flag=1) order by bankwise_priority ASC";
list($total_records,$showBankListQry)=MainselectfuncNew($showBankListSql,$array = array());

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="assets/stylesheets/bootstrap.min.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="release/featherlight.min.css" title="Featherlight Styles" />
<link type="text/css" href="css/d4lmenu.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Personal Loan | Online Personal loans India 2015</title>
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, online personal loans, Personal Loans India"/>
<meta name="description" content="Find Personal loan online: Get Latest Trends, Basic information, Benefits, Documents, Eligibility Criteria by Various Banks and Cibil Score Importance at deal4loans."/>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link type="text/css" rel="stylesheet" href="css/easy-responsive-tabs.css" />
<link href="source.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<!--<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>-->
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<!-- Add this for Company list -->
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hhtpspllist.js"></script>
<style type="text/css">
/* Big box with list of options */
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:250px;	/* Width of box */
	height:160px;	/* Height of box */
	overflow:auto;	/* Scrolling features */
	border:1px solid #317082;	/* Dark green border */
	background-color:#FFF;	/* White background color */
	color:#000000;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-align:left;
	font-size:10px;
	z-index:55555;
}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
	margin:1px;		
	padding:1px;
	cursor:pointer;
	font-size:10px;
}

#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
	background-color:#2375CB;
	color:#0033CC;
}
#ajax_listOfOptions_iframe{
	background-color:#00FFCC;
	position:relative;
	z-index:5;
}
</style>
<!--//-->

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
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

<script type="text/javascript">
var wrap = $("#wrap");

wrap.on("scroll", function(e) {
    
  if (this.scrollTop > 147) {
    wrap.addClass("pl_newuiwrapper");
  } else {
    wrap.removeClass("pl_newuiwrapper");
  }
  
});	
</script>

<script language="JavaScript">

function get_round(X) { return Math.round(X*100)/100 }
function showpay() {
	document.getElementById("pl_emi_area").style.display='block';
	closelightbox(4);
	//alert("this is closed!");
	
	if ((document.calc.Loan_Amount_Emi.value == null || document.calc.Loan_Amount_Emi.value.length == 0) || (document.calc.months.value == null || document.calc.months.value.length == 0) || (document.calc.rate.value == null || document.calc.rate.value.length == 0)){ 
		document.calc.pay.value = "Incomplete data";
		document.calc.tot_amount.value = "Incomplete data";
		document.calc.tot_interest.value = "Incomplete data";
		document.calc.yearly_interest.value = "Incomplete data";
		document.calc.interest_pa.value = "Incomplete data";
		document.calc.interest_pm.value = "Incomplete data";
	}
	else
	{
		var princ = document.calc.Loan_Amount_Emi.value;
		var term  = document.calc.months.value;
		var intr  = document.calc.rate.value / 1200;
		var yrs   = document.calc.months.value / 12;
		var exactintr = document.calc.rate.value;
		//alert("Interest: "+ intr +" - term: "+ term +" - principal: "+ princ +" - years: "+ yrs);
		document.calc.pay.value = get_round(princ * intr / (1 - (Math.pow(1/(1 + intr), term))));
		document.calc.tot_amount.value = get_round(document.calc.pay.value * term);
		document.calc.tot_interest.value = get_round(document.calc.tot_amount.value - princ);
		document.calc.yearly_interest.value = get_round(document.calc.tot_interest.value / yrs);
		document.calc.interest_pa.value = get_round(document.calc.yearly_interest.value / princ * 100);
		document.calc.interest_pm.value = get_round((document.calc.yearly_interest.value / princ * 100)/12);
		commitData(princ,exactintr,term);
		displayBarChart (princ,exactintr,term);
		var smpl_rsltdv = document.getElementById('smpl_rslt');
		smpl_rsltdv.innerHTML = 'Yearly Calculated Values';
	}
}
</script>
<link href="personal-loan-banks-styles.css" rel="stylesheet" type="text/css">
<link href="source1.css" rel="stylesheet" type="text/css" />
<link href="css/personal-loans-new-styles.css" type="text/css" rel="stylesheet" />
<script src="js/light-box-jquery-newui.js"></script>
<script type="text/javascript" src="modernizr.custom-90229.js"></script>

<script language="javascript">
$(function() {
	$("#IncomeAmount").focusout(function(){
		if($("#IncomeAmount").val()<=50000){

			var ai=$("#IncomeAmount").val();
			var mai= Math.round(ai/12);
				$( "#dialog-modal" ).dialog({
				title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
				height: 0,
				modal: true
			});
			//$("#IncomeAmount").val().focus();
		}
	});
});

function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){	element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){	element.value = defaultVal;	} }

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if (document.personalloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<div class='hintmessage'>Enter Loan Amount!</div>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.personalloan_form.Tenure.value=="")
	{
		document.getElementById('tenureVal').innerHTML = "<div class='hintmessage'>Enter Tenure to Continue!</div>";	
		document.personalloan_form.Tenure.focus();
		return false;
	}
	if(document.getElementById("IngVysya").checked==false && document.getElementById("Kotak").checked==false && document.getElementById("HDBFS").checked==false && document.getElementById("HDFC").checked==false && document.getElementById("Axis").checked==false && document.getElementById("CITI").checked==false && document.getElementById("BOB").checked==false && document.getElementById("Stanc").checked==false && document.getElementById("ICICI").checked==false && document.getElementById("SBI").checked==false ){
		document.getElementById('bankVal').innerHTML = "<div class='hintmessage'>Please select at least one bank to Continue!</div>";	
		document.personalloan_form.Tenure.focus();
		return false;
	}	
	
	addPersonalDetails();
	if(document.personalloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>Fill Mobile Number!</div>";
		document.personalloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>Enter numeric value!</div>";
		document.personalloan_form.Phone.focus();
		return false;  
	}
	if (document.personalloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>Enter 10 Digits!</div>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>should start with 9 or 8 or 7!</div>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	
	if(document.personalloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintmessage'>Enter  Email Address!</div>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintmessage'>Enter Valid Email Address!</div>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintmessage'>Enter Valid Email Address!</div>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	
	if((document.personalloan_form.Name.value==""))
	{
        document.getElementById('nameVal').innerHTML = "<div class='hintmessage'>Please Enter Your name</div>";		
		document.personalloan_form.Name.focus();
		return false;
	}

	if(document.personalloan_form.Name.value!="")
	{
		if(containsdigit(document.personalloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<div class='hintmessage'>First Name contains numbers!</div>";
			document.personalloan_form.Name.focus();
			return false;
		}
	}
	for (var i = 0; i <document.personalloan_form.Name.value.length; i++) 
	{
		if (iChars.indexOf(document.personalloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<div class='hintmessage'>Contains special characters!</div>";
			document.personalloan_form.Name.focus();
			return false;
		}
	}
	
	if (document.personalloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<div class='hintmessage'>Enter City to Continue!</div>";	
		document.personalloan_form.City.focus();
		return false;
	}
	if((document.personalloan_form.City.value=="Others") && ((document.personalloan_form.City_Other.value=="" || document.personalloan_form.City_Other.value=="Other City") || !isNaN(document.personalloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<div class='hintmessage'>Enter Other City to Continue!</div>";
		document.personalloan_form.City_Other.focus();
		return false;
	}
	
	if(!document.personalloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<div class='hintmessage'>Read and Accept Terms & Conditions!</div>";
		document.personalloan_form.accept.focus();
		return false;
	}	
}

function check_pl_form(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if (document.frmPersonalLoan.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<div class='hintmessage'>Enter Loan Amount!</div>";	
		document.frmPersonalLoan.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.frmPersonalLoan.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if(document.frmPersonalLoan.Tenure.value=="")
	{
		document.getElementById('tenureVal').innerHTML = "<div class='hintmessage'>Enter Tenure to Continue!</div>";	
		document.frmPersonalLoan.Tenure.focus();
		return false;
	}
	
	if((document.frmPersonalLoan.Name.value==""))
	{
        document.getElementById('nameVal').innerHTML = "<div class='hintmessage'>Please Enter Your name</div>";		
		document.frmPersonalLoan.Name.focus();
		return false;
	}

	if(document.frmPersonalLoan.Name.value!="")
	{
		if(containsdigit(document.frmPersonalLoan.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<div class='hintmessage'>First Name contains numbers!</div>";
			document.frmPersonalLoan.Name.focus();
			return false;
		}
	}
	for (var i = 0; i <document.frmPersonalLoan.Name.value.length; i++) 
	{
		if (iChars.indexOf(document.frmPersonalLoan.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<div class='hintmessage'>Contains special characters!</div>";
			document.frmPersonalLoan.Name.focus();
			return false;
		}
	}
	if(document.frmPersonalLoan.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>Fill Mobile Number!</div>";
		document.frmPersonalLoan.Phone.focus();
		return false;
	}
	if(isNaN(document.frmPersonalLoan.Phone.value)|| document.frmPersonalLoan.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>Enter numeric value!</div>";
		document.frmPersonalLoan.Phone.focus();
		return false;  
	}
	if (document.frmPersonalLoan.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>Enter 10 Digits!</div>";	
		document.frmPersonalLoan.Phone.focus();
		return false;
	}
	if ((document.frmPersonalLoan.Phone.value.charAt(0)!="9") && (document.frmPersonalLoan.Phone.value.charAt(0)!="8") && (document.frmPersonalLoan.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<div class='hintmessage'>should start with 9 or 8 or 7!</div>";	
		document.frmPersonalLoan.Phone.focus();
		return false;
	}
	if(document.frmPersonalLoan.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintmessage'>Enter  Email Address!</div>";	
		document.frmPersonalLoan.Email.focus();
		return false;
	}
	
	var str=document.frmPersonalLoan.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintmessage'>Enter Valid Email Address!</div>";	
		document.frmPersonalLoan.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintmessage'>Enter Valid Email Address!</div>";	
		document.frmPersonalLoan.Email.focus();
		return false;
	}	
	if (document.frmPersonalLoan.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<div class='hintmessage'>Enter City to Continue!</div>";	
		document.frmPersonalLoan.City.focus();
		return false;
	}
	if((document.frmPersonalLoan.City.value=="Others") && ((document.frmPersonalLoan.City_Other.value=="" || document.frmPersonalLoan.City_Other.value=="Other City") || !isNaN(document.frmPersonalLoan.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<div class='hintmessage'>Enter Other City to Continue!</div>";
		document.frmPersonalLoan.City_Other.focus();
		return false;
	}
	
	if(!document.frmPersonalLoan.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<div class='hintmessage'>Read and Accept Terms & Conditions!</div>";
		document.frmPersonalLoan.accept.focus();
		return false;
	}	
}

function show_bank_othercity(val){
	//alert("value: "+val);
	if(val=='Others'){
		document.getElementById("other_city_bank").style.display='block';
	}
}

function check_calc_emi(){
	
	//alert("Hi, this is validation");
	if(document.getElementById("Loan_Amount_Emi").value==''){
		
		document.getElementById('loanAmountEmiVal').innerHTML = "<div class='hintmessage'>Enter Loan Amount to proceed!</div>";
		document.getElementById('Loan_Amount_Emi').focus();
		return false;
	}
	if(document.getElementById("Months_Emi").value==''){
		
		document.getElementById('monthsVal').innerHTML = "<div class='hintmessage'>Enter number of months to proceed!</div>";
		document.getElementById('Months_Emi').focus();
		return false;
	}
	if(document.getElementById("Months_Emi").value!='' && document.getElementById("Months_Emi").value>72){
		
		document.getElementById('monthsVal').innerHTML = "<div class='hintmessage'>Loan Tenure should not be more than 72 months!</div>";
		document.getElementById('Months_Emi').focus();
		return false;
	}
	if(document.getElementById("know_interest_rate").checked==false && document.getElementById("find_out_interest_rate").checked==false){
		
		document.getElementById('knowIntrestRateVal').innerHTML = "<div class='hintmessage'>Please select at least one option!</div>";
		document.getElementById('know_interest_rate').focus();
		return false;
	}
	if(document.getElementById("know_interest_rate").checked==true && document.getElementById("Interest_Rate_Emi").value==''){
		
		document.getElementById('intrestRateVal').innerHTML = "<div class='hintmessage'>Enter Interest Rate to proceed!</div>";
		document.getElementById('Interest_Rate_Emi').focus();
		return false;
	}
	showpay();
	//take_details();
	return true;
}

function checkPersonalDetailForm(){
	
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.getElementById("full_name_emi").value==""){
		
		document.getElementById('fullnameEmiVal').innerHTML = "<div class='hintmessage'>Fill Your Name!</div>";
		document.getElementById("full_name_emi").focus();
		return false;
	}
	if(document.getElementById("mobile_emi").value=="")
	{
		document.getElementById('mobileEmiVal').innerHTML = "<div class='hintmessage'>Fill Mobile Number!</div>";
		document.getElementById("mobile_emi").focus();
		return false;
	}
	if(isNaN(document.getElementById("mobile_emi").value)|| document.getElementById("mobile_emi").value.indexOf(" ")!=-1)
	{
		document.getElementById('mobileEmiVal').innerHTML = "<div class='hintmessage'>Enter numeric value!</div>";
		document.getElementById("mobile_emi").focus();
		return false;  
	}
	if (document.getElementById("mobile_emi").value.length < 10 )
	{
	  	document.getElementById('mobileEmiVal').innerHTML = "<div class='hintmessage'>Enter 10 Digits!</div>";	
		document.getElementById("mobile_emi").focus();
		return false;
	}
	if ((document.getElementById("mobile_emi").value.charAt(0)!="9") && (document.getElementById("mobile_emi").value.charAt(0)!="8") && (document.getElementById("mobile_emi").value.charAt(0)!="7"))
	{
	  	document.getElementById('mobileEmiVal').innerHTML = "<div class='hintmessage'>Should start with 9 or 8 or 7!</div>";	
		document.getElementById("mobile_emi").focus();
		return false;
	}
	if(document.getElementById("email_emi").value=="")
	{
		document.getElementById('emailEmiVal').innerHTML = "<div class='hintmessage'>Enter  Email Address!</div>";	
		document.getElementById("email_emi").focus();
		return false;
	}
	
	var str=document.getElementById("email_emi").value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailEmiVal').innerHTML = "<div class='hintmessage'>Enter Valid Email Address!</div>";	
		document.getElementById("email_emi").focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailEmiVal').innerHTML = "<div class='hintmessage'>Enter Valid Email Address!</div>";	
		document.getElementById("email_emi").focus();
		return false;
	}
	if (document.getElementById("city_emi").selectedIndex==0)
	{
		document.getElementById('cityEmiVal').innerHTML = "<div class='hintmessage'>Enter City to Continue!</div>";	
		document.getElementById("city_emi").focus();
		return false;
	}
	if(!document.getElementById("accept").checked)
	{
		document.getElementById('acceptEmiVal').innerHTML = "<div class='hintmessage'>Read and Accept Terms & Conditions!</div>";
		document.getElementById("accept").focus();
		return false;
	}
	//showpay();	
	return true;
}

function check_bank_intr(){
	
	//alert("Hi");
	if(document.getElementById("bank_id").value==""){
		
		document.getElementById('banklistVal').innerHTML = "<div class='hintmessage'>Please select a Bank!</div>";
		document.getElementById('bank_id').focus();
		return false;
	}
	document.getElementById("BankNameStr").value=document.getElementById("bank_id").value;
	return false;
}
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function change_empstst(){

	var occupation = document.personalloan_form.Employment_Status.value;
	if(occupation==0){
	
		document.getElementById("company_name_area").style.display='none';
		document.getElementById("annual_turnover_area").style.display='block';
	}else{
		
		document.getElementById("company_name_area").style.display='block';
		document.getElementById("annual_turnover_area").style.display='none';
	}	
}

function othercity1(){

	if(document.personalloan_form.City.value=='Others'){
		
		document.getElementById("other_city_area").style.display='block';
	}else{
		document.getElementById("other_city_area").style.display='none';
	}	
}

function addPersonalDetails(){
	//alert("Hi");
	document.getElementById("btn_apply").style.display='none';
	document.getElementById("personal_details_area").style.display='block';
	document.getElementById("btn_confirm").style.display='block';
}

</script>

<!-- CSS, JS lightbox code starts here -->
<style type="text/css">

.label
{
	font-family: Verdana;
	font-size: medium;
	font-weight: bold;
	color: #000000;
}
.click
{
	font-family: Verdana;
	font-size: medium;
	font-weight: bold;
	color: #000000;
	padding:300px;
}

.Title
{
	font-family: Verdana;
	font-size: large;
	font-weight: bold;
	color: #FF9900;
}

#Button1
{
	width: 64px;
	 font-family: Verdana;
	font-size: medium;
	font-weight: bold;
	background-color:Teal;
	color:#FFF;
}
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 200%;
	background-color: #FFFAFA;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.90;
	filter: alpha(opacity=80);
}
.white_content {
	display: none;
	position: absolute;
	top: 25%;
	left: 5%;
	width: 65%;
	height: auto;
	padding: 15px; 
	margin-bottom:10px;
	box-shadow:#dcdcdc 1px 2px 2px 5px;
	/*box-shadow:inset 0 0 4px 4px #999;*/
	background-color: white;
	z-index:1002;
	overflow:none;
	border-radius:10px;
	margin-left:8%;
}
.table-banks_overflow{ 
	width:98%; 
	height:auto; 
	overflow:none; 
	padding-top:5px;
	float:right;
}

.hintmessage{
	color:#FF0000;
	font-size:10px; 
	text-align:left;
}
.banks_associated_box{ 
	float:left; 
	width:91px; 
	margin-left:5px;
}

</style>
<script type="text/javascript" language="javascript">
function createlightbox(val)
{
    //alert(val);
	if(val==1){
		document.getElementById('light-1').style.display='block';
		document.getElementById('fade').style.display='block'
	}
	if(val==2){
		document.getElementById('light-2').style.display='block';
		document.getElementById('fade').style.display='block'
	}
	if(val==3){
		document.getElementById('light-3').style.display='block';
		document.getElementById('fade').style.display='block'
	}
	if(val==4){
		document.getElementById('light-4').style.display='block';
		document.getElementById('fade').style.display='block'
	}
}
function closelightbox(val)
{
	//alert(val);
    if(val==1){
		document.getElementById('light-1').style.display='none';
		document.getElementById('fade').style.display='none'
	}
    if(val==2){
		document.getElementById('light-2').style.display='none';
		document.getElementById('fade').style.display='none'
	}
    if(val==3){
		document.getElementById('light-3').style.display='none';
		document.getElementById('fade').style.display='none'
	}
	if(val==4){
		document.getElementById('light-4').style.display='none';
		document.getElementById('fade').style.display='none'
	}
}

function calculateInterestRate(val){

	if(val==1){
		document.getElementById("know_interest_rate_area").style.display='block';
		document.getElementById("find_out_interest_rate_area").style.display='none';
	}
	if(val==2){
		document.getElementById("know_interest_rate_area").style.display='none';
		document.getElementById("find_out_interest_rate_area").style.display='block';
	}
}

function employmentStatus(empSts){
	
	//alert(empSts);
	if(empSts=='Salaried'){
		document.getElementById("emp_status").value='Salaried';	
		document.getElementById("salaried_info_area").style.display='block';
		document.getElementById("self_employed_info_area").style.display='none';
	}
	if(empSts=='Self-Employed'){		
		document.getElementById("emp_status").value='Self-Employed';
		document.getElementById("salaried_info_area").style.display='none';
		document.getElementById("self_employed_info_area").style.display='block';
	}
}

function take_details(){

	createlightbox(4);
}

function checkBtn(){

	if(document.getElementById("find_out_interest_rate").checked==true){
		document.getElementById("btn_submit").style.display='none';
		document.getElementById("btn_submit_ajax").style.display='block';
	}	
}
</script>
<style type="text/css">
.tab_a_new{ float:left; width:100px; margin-top:10px; padding:15px; background:#4cbd39; color:#FFF; font-family:Arial, Helvetica, sans-serif; border-radius:5px 5px 0px 0px; cursor:pointer;}
.tab_a_new_b{ float:left; width:100px; margin-top:10px; padding:15px; background:#9cdc90; color:#000000; font-family:Arial, Helvetica, sans-serif; border-radius:5px 5px 0px 0px; cursor:pointer; }
</style>
<!-- CSS, JS lightbox code ends here -->

<!-- AJAX Code to get PL Interest rate according to bank starts here -->
<script type="text/javascript">
function show_interest(bank_id){

	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { 
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("show_interest_rate").style.display='none';
			document.getElementById("content_update").style.display='block';
			document.getElementById("show_interest_rate_handler").style.display='block';
			document.getElementById("hide_interest_rate_handler").style.display='none';
			document.getElementById("content_update").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax_pl_interest_rate.php?bank_id="+bank_id,true);
	xmlhttp.send();
}

function show_bank_intr_personal_details(){
	
	//alert("Hi, check this!");
	document.getElementById("show_bank_intr_personal_details_area").style.display='block';
}

function getIntrRate(loan_amount,tenure,emp_status,dob_month_sal,dob_year_sal,Company_Name,monthly_income_sal,obligation_sal,cc_holder_sal,dob_month_SE,dob_year_SE,itr_paid_SE,obligation_SE,cc_holder_SE,Interest_Rate_Emi,full_name_emi,mobile_emi,email_emi,city_emi,source,Card_Vintage_Sal,Card_Vintage_SE){
	//alert(loan_amount+"-"+tenure+"-"+dob_month_sal+"-"+dob_year_sal+"-"+Company_Name+"-"+monthly_income_sal+"-"+obligation_sal+"-"+cc_holder_sal+"-"+dob_month_SE+"-"+dob_year_SE+"-"+itr_paid_SE+"-"+obligation_SE+"-"+cc_holder_SE+"-"+Interest_Rate_Emi+"-"+full_name_emi+"-"+mobile_emi+"-"+email_emi+"-"+city_emi);
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { 
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			//document.getElementById("pl_emi_area").style.display='none';
			closelightbox(4);
			document.getElementById("pl_emi_area_all").innerHTML=xmlhttp.responseText;
			//alert(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET","ajax_emi_calc.php?loan_amount="+loan_amount+"&tenure="+tenure+"&emp_status="+emp_status+"&dob_month_sal="+dob_month_sal+"&dob_year_sal="+dob_year_sal+"&Company_Name="+Company_Name+"&monthly_income_sal="+monthly_income_sal+"&obligation_sal="+obligation_sal+"&cc_holder_sal="+cc_holder_sal+"&dob_month_SE="+dob_month_SE+"&dob_year_SE="+dob_year_SE+"&itr_paid_SE="+itr_paid_SE+"&obligation_SE="+obligation_SE+"&cc_holder_SE="+cc_holder_SE+"&Interest_Rate_Emi="+Interest_Rate_Emi+"&full_name_emi="+full_name_emi+"&mobile_emi="+mobile_emi+"&email_emi="+email_emi+"&city_emi="+city_emi+"&source="+source+"&Card_Vintage_Sal="+Card_Vintage_Sal+"&Card_Vintage_SE="+Card_Vintage_SE,true);
	//alert("ajax_emi_calc.php?loan_amount="+loan_amount+"&tenure="+tenure+"&emp_status="+emp_status+"&dob_month_sal="+dob_month_sal+"&dob_year_sal="+dob_year_sal+"&Company_Name="+Company_Name+"&monthly_income_sal="+monthly_income_sal+"&obligation_sal="+obligation_sal+"&cc_holder_sal="+cc_holder_sal+"&dob_month_SE="+dob_month_SE+"&dob_year_SE="+dob_year_SE+"&itr_paid_SE="+itr_paid_SE+"&obligation_SE="+obligation_SE+"&cc_holder_SE="+cc_holder_SE+"&Interest_Rate_Emi="+Interest_Rate_Emi+"&full_name_emi="+full_name_emi+"&mobile_emi="+mobile_emi+"&email_emi="+email_emi+"&city_emi="+city_emi+"&source="+source);
	xmlhttp.send();
}
function getLeadAjax(loan_amount,tenure,Interest_Rate_Emi,full_name_emi,mobile_emi,email_emi,city_emi,source){

	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { 
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("pl_emi_area").style.display='none';
			closelightbox(4);
			document.getElementById("pl_calc_thank").innerHTML=xmlhttp.responseText;
			
		}
	}
	xmlhttp.open("GET","ajax_get_lead.php?loan_amount="+loan_amount+"&tenure="+tenure+"&Interest_Rate_Emi="+Interest_Rate_Emi+"&full_name_emi="+full_name_emi+"&mobile_emi="+mobile_emi+"&email_emi="+email_emi+"&city_emi="+city_emi+"&source="+source,true);
	xmlhttp.send();
}
</script>
<!-- AJAX Code to get PL Interest rate according to bank ends here -->

<!-- toggle tab -->
<script>
function toggleClass(el){
	var kids = document.getElementById('switch_tab').children;
	for(var i = 0; i < kids.length; i++){
        kids[i].className = "tab_a_new_b";
    }
	el.className = "tab_a_new";
}
</script>
<!--//-->
</head>
<body>
<!--top-->

<header>
<div class="hide_top_menu"><?php include "top-menu.php"; ?></div></header>
<!--top-->
<!--logo navigation-->
<nav><?php include "main-menu-new.php"; ?></nav>
<!--logo navigation--><!--partners-->
<div style="clear:both;"></div>
<div style="background:#FFF; height:35px; margin-bottom:0px; padding-bottom:5px; width:100%; padding-top:10px;">
<div class="breadcrumbs_wrapper "><span class="breadcrumbs_bluetext">Home »</span> <span class="breadcrumbs_graytext">Personal Loan</span></div>
</div>
<div style="clear:both;"></div>
<div class="pl_newuiwrapper">
<div class="pl_newuiwrapper-inner"><h1 class="h1-newpl">Personal Loan</h1><br/>
<span class="new_ui-text"><em>What is a Personal loan?</em></span><br/>
<span class="new_ui_text2">Personal Loan is an unsecured loan for personal use which doesn’t require any security or collateral and can be availed for any purpose, be it a wedding expenditure, a holiday or purchasing consumer durables, the loans is very handy & caters to all your needs. The amount of loans can be ranged from Rs. 50,000 – Rs. 20 lakh & the tenure for repaying the loan varies from 1 to 5 years.
<br/>
<br/>
<strong><em>Personal Loan applications received for 273,923 crores (last updated on <?php echo date('d F Y'); ?>)</em></strong></span>
</div>
</div>
<div class="downarrow_newuipl"><img src="images/down-arrow-newui-pl.png" width="53" height="19"></div>
<div class="clear"></div>
<div class="newul_pl_wrapper">
</div>
<div class="boxesmain-wrapper-newui">
<div class="new_ui_product_box1">
<a class='inline' href="javascript: void(0);" onClick="createlightbox(2); ga('send', 'event', 'PL Eligibility Calc', 'PL Eligibility Calc Button');"><img src="images/emi-calculator-btn-circle.png" width="170" height="190" alt="EMI Calculator" /></a>
<div class="new_ui_product_box1_inn">Calculate EMI as per the Interest Rates and Loan Tenure.</div>
<div id="light-2" class="white_content">
<a href="javascript:void(0)" onClick="closelightbox(2)" style="float:right"><img src="images/icon_cancel.gif" alt="" /></a>

<div id='inline_content1' style='padding:10px; background:#fff;'>
<div class="form_emiwrapper">
<div class="heading_text_lihgtbox">EMI Calculator</div>
<form method="POST" name="calc" id="calc">
<input type="hidden" id="source" name="source" value="PL-EMI-Calc-Jan2015" />
<div class="bankname-box-newui-left">Loan Amount</div>
<div class="bankname-box-newui-right">
<input id='Loan_Amount_Emi' name='Loan_Amount_Emi' type='text' class="input_lightbox" onBlur="getDigitToWords('Loan_Amount_Emi','formatedlAEmi','wordloanAmountEmi');" onKeyPress="getDigitToWords('Loan_Amount_Emi','formatedlAEmi','wordloanAmountEmi');" onKeyDown="getDigitToWords('Loan_Amount_Emi','formatedlAEmi','wordloanAmountEmi'); validateDiv('loanAmountEmiVal');" onKeyUp="intOnly(this);getDigitToWords('Loan_Amount_Emi','formatedlAEmi','wordloanAmountEmi');" value='' maxlength='9' />
</div>
<div class="error-new-wrapper"><div id="loanAmountEmiVal"></div>
<div id='wordloanAmountEmi' style='font-size:9px; font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize; text-align:left;'></div>
<div id='formatedlAEmi' style='font-size:9px; font-weight:normal; color:#000000;font-Family:Verdana; text-align:left;'></div>
</div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Loan Tenure</div>
<div class="bankname-box-newui-right">
<input type="text" id="Months_Emi" name="months" maxlength="2" class="input_lightbox" onKeyDown="validateDiv('monthsVal');" />
</div>
<div class="error-new-wrapper"><div id="monthMsg" style="text-align:left;">(in months)</div><div id="monthsVal"></div></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left" style="text-align:right;"><input id="know_interest_rate" name="know_interest_rate" type="radio" value="1" onClick="calculateInterestRate(this.value); validateDiv('knowIntrestRateVal')" /> I know Interest rate</div>
<div class="bankname-box-newui-right" style="margin-top:15px;"><input id="find_out_interest_rate" name="know_interest_rate" type="radio" value="2" onClick="calculateInterestRate(this.value); validateDiv('knowIntrestRateVal')" /> I want you to find out Interest rate</div>
<div class="error-new-wrapper"><div id="knowIntrestRateVal"></div></div>
<div style="clear: both;"></div>

<div id="find_out_interest_rate_area" style="display:none;">
    <div class="demo">
        <!--Horizontal Tab-->
        <div id="horizontalTab">
            <div style="background:#9bda90 !important;"> 
				<div id="switch_tab">
                  <div class="tab_a_new" onClick="toggleClass(this); employmentStatus('Salaried')"> Salaried </div>
                  <div class="tab_a_new_b" onClick="toggleClass(this); employmentStatus('Self-Employed')"> Self Employed </div>
                </div>
            </div>
            <input type="hidden" id="emp_status" name="emp_status" value="Salaried" />
            <div class="resp-tabs-container" style="border:1px solid #ccc; padding:10px;">
                <div id="salaried_info_area">
                  <p>
                    <div class="form_light_box_new">Date Of Birth </div>
                    <div class="form_light_box_inputs_new">
                    <input id="dob_month_sal" name="dob_month_sal" type="text" maxlength="2" class="dob_newmm" value="mm" onFocus="if(this.value=='mm'){ this.value=''; }" onBlur="if(this.value==''){ this.value='mm'; }" />
                    <input id="dob_year_sal" name="dob_year_sal" type="text" maxlength="4" class="dob_newmm" value="yyyy" onFocus="if(this.value=='yyyy'){ this.value=''; }" onBlur="if(this.value==''){ this.value='yyyy'; }" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="form_light_box_new">Company Name </div>
                    <div class="form_light_box_inputs_new">
                    <input name="Company_Name" id="Company_Name" style="color:#000000!important;" type="text" class="input_newmm" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="Type Slowly for Autofill" onBlur="onBlurDefault(this,'Type Slowly for Autofill');" onFocus="if(this.value=='Type Slowly for Autofill'){this.value='';}" />
                    </div>
                    <div style="clear:both;"></div>
           
                    <div class="form_light_box_new">Monthly Salary <br><div style="font-size:11px;"> </div></div>
                    <div class="form_light_box_inputs_new">
                    <input id="monthly_income_sal" name="monthly_income_sal" type="text" class="input_newmm" onBlur="getDigitToWords('monthly_income_sal','formatedMI','wordMonthlyIncome');" onKeyPress="getDigitToWords('monthly_income_sal','formatedMI','wordMonthlyIncome');" onKeyDown="getDigitToWords('monthly_income_sal','formatedMI','wordMonthlyIncome');" onKeyUp="intOnly(this);getDigitToWords('monthly_income_sal','formatedMI','wordMonthlyIncome');" />
                    </div>
                    <div class="error-new-wrapper">
                        <div id='wordMonthlyIncome' style='font-size:9px; font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize; text-align:left;'></div>
                        <div id='formatedMI' style='font-size:9px; font-weight:normal; color:#000000;font-Family:Verdana; text-align:left;'></div>
                    </div>                    
                    <div style="clear:both;"></div>

                    <div class="form_light_box_new">Any Current Loan <br><div style="font-size:11px;"> (Monthly EMI)</div></div>
                    <div class="form_light_box_inputs_new"><input id="obligation_sal" name="obligation_sal" type="text" class="input_newmm" /></div>
                    <div style="clear:both;"></div>
                    
                    <div class="form_light_box_new">Do you have any credit card? <br><div style="font-size:11px;"></div></div>
                    <div class="form_light_box_inputs_new">
                    <input type="radio" name="CC_Holder_sal" id="CC_Holder_sal" value="1" onClick="document.getElementById('card_vintage_area_sal').style.display='block';" /> Yes 
                    <input type="radio" name="CC_Holder_sal" value="0" checked  onClick="document.getElementById('card_vintage_area_sal').style.display='none';" /> No
                    </div>
                    <div style="clear:both;"></div>
                    <div id="card_vintage_area_sal" style="display:none;">
                    <div class="form_light_box_new">Card held since <br><div style="font-size:11px;"></div></div>
                    <div class="form_light_box_inputs_new">
                    <select size="1" id="Card_Vintage_Sal" name="Card_Vintage_Sal" class="select-input_lightbox">
                        <option value="0">Please select</option> 
                        <option value="1">Less than 6 months</option> 
                        <option value="2">6 to 9 months</option> 
                        <option value="3">9 to 12 months</option>
                        <option value="4">more than 12 months</option> 
                    </select>
                    </div>
                    </div>
                    <div style="clear:both;"></div>
                  </p>
                </div>
                <div id="self_employed_info_area" style="display:none;">
                  <p>
                    <div class="form_light_box_new">Date Of Birth</div>
                    <div class="form_light_box_inputs_new">
                    <input id="dob_month_SE" name="dob_month_SE" type="text" class="dob_newmm" value="mm" onFocus="if(this.value=='mm'){ this.value=''; }" onBlur="if(this.value==''){ this.value='mm'; }" />
                    <input id="dob_year_SE" name="dob_year_SE" type="text" class="dob_newmm" maxlength="4" value="yyyy" onFocus="if(this.value=='yyyy'){ this.value=''; }" onBlur="if(this.value==''){ this.value='yyyy'; }" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="form_light_box_new">Current ITR <br />(Total annual income)</div>
                    <div class="form_light_box_inputs_new">
                    <input id="itr_paid_SE" name="itr_paid_SE" type="text" class="input_newmm" onBlur="getDigitToWords('itr_paid_SE','formatedITR','wordITR');" onKeyPress="getDigitToWords('itr_paid_SE','formatedITR','wordITR');" onKeyDown="getDigitToWords('itr_paid_SE','formatedITR','wordITR');" onKeyUp="intOnly(this);getDigitToWords('itr_paid_SE','formatedITR','wordITR');" />
                    </div>
                    <div class="error-new-wrapper">
                        <div id='wordITR' style='font-size:9px; font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize; text-align:left;'></div>
                        <div id='formatedITR' style='font-size:9px; font-weight:normal; color:#000000;font-Family:Verdana; text-align:left;'></div>
                    </div>  
                    <div style="clear:both;"></div>
                    
                    <div class="form_light_box_new">Any Current Loan <br><div style="font-size:11px;"> (Monthly EMI)</div></div>
                    <div class="form_light_box_inputs_new"><input id="obligation_SE" name="obligation_SE" type="text" class="input_newmm" /></div>
                    <div style="clear:both;"></div>
                    
                    <div class="form_light_box_new">Do you have any credit card? <br><div style="font-size:11px;"></div></div>
                    <div class="form_light_box_inputs_new">
                    <input type="radio" name="CC_Holder_SE" id="CC_Holder_SE" value="1" onClick="document.getElementById('card_vintage_area_SE').style.display='block';" /> Yes 
                    <input type="radio" name="CC_Holder_SE" value="0" checked  onClick="document.getElementById('card_vintage_area_SE').style.display='none';" /> No
                    </div>
                    <div style="clear:both;"></div>
                    
                    <div id="card_vintage_area_SE" style="display:none;">
                    <div class="form_light_box_new">Card held since <br><div style="font-size:11px;"></div></div>
                    <div class="form_light_box_inputs_new">
                    <select size="1" id="Card_Vintage_SE" name="Card_Vintage_SE" class="select-input_lightbox">
                        <option value="0">Please select</option> 
                        <option value="1">Less than 6 months</option> 
                        <option value="2">6 to 9 months</option> 
                        <option value="3">9 to 12 months</option>
                        <option value="4">more than 12 months</option> 
                    </select>
                    </div>
                    </div>
                    <div style="clear:both;"></div>
                  </p>
                </div>
            </div>
        </div>
    	<br />
        <!--vertical Tabs-->
        <br />
    </div>
</div>

<div id="know_interest_rate_area" style="display:none;">
    <div class="bankname-box-newui-left">Interest Rate</div>
    <div class="bankname-box-newui-right">
    <input name='rate' id="Interest_Rate_Emi" type='text' class="input_lightbox" value='' maxlength='5' onKeyDown="validateDiv('intrestRateVal');" />
    </div>
    <div class="error-new-wrapper"><div id="intrestRateVal"></div></div>
    <div style="clear: both;"></div>
</div>

<div class="buttons_boxforlightbox">
<div id="calculate"><img src="images/calculatenow_newui.png" width="138" height="41" onClick="check_calc_emi(); ga('send', 'event', 'EMI Calc', 'PL EMI Calc Button');" /></div>
</div>
<div style="clear: both;"></div>

<div id="pl_calc_thank"></div>
<div style="clear: both;"></div>

<div id="pl_emi_area_all"></div>
<div style="clear: both;"></div>

<div id="pl_emi_area" style="display:none;">
<div class="bankname-box-newui-left">Calculated Monthly Emi</div>
<div class="bankname-box-newui-right"><input name="pay" type="text" class="input_lightbox"  value="" readonly /></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Total Amount with Interest</div>
<div class="bankname-box-newui-right"><input name="tot_amount" type="text" class="input_lightbox"  value="" readonly /></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Total Interest Amount</div>
<div class="bankname-box-newui-right"><input name="tot_interest" type="text" class="input_lightbox"  value="" readonly /></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Yearly Interest Amount</div>
<div class="bankname-box-newui-right"><input name='yearly_interest' type='text' class="input_lightbox" style="font-weight:bold;color:#373737;" readonly /></div>
<div style="clear: both;"></div>

<div style="padding:10px;">
Do you want us to get better interest rate quote?<br />
<input type="button" name="better-intr-rate" value="Better Interest Rate Yes I need it" onClick="take_details(); ga('send', 'event', 'EMI Calc', 'PL Get Better Interest Rate');" />
</div>
<div style="clear: both;"></div>
</div>

<div id="light-4" class="white_content">
<a href="javascript:void(0)" onClick="closelightbox(4)" style="float:right"><img src="images/icon_cancel.gif" alt="" /></a>

<div class="bankname-box-newui-left">Full Name</div>
<div class="bankname-box-newui-right"><input id="full_name_emi" name="full_name_emi" type="text" class="input_lightbox" value="" onKeyDown="validateDiv('fullnameEmiVal');" onKeyUp="validateDiv('fullnameEmiVal');" onBlur="validateDiv('fullnameEmiVal');" /></div>
<div class="error-new-wrapper_b"><div id="fullnameEmiVal"></div></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Mobile</div>
<div class="bankname-box-newui-right"><input id="mobile_emi" name="mobile_emi" type="text" class="input_lightbox" value="" maxlength="10" onKeyDown="validateDiv('mobileEmiVal');" onKeyUp="validateDiv('mobileEmiVal');" onBlur="validateDiv('mobileEmiVal');" /></div>
<div class="error-new-wrapper_b"><div id="mobileEmiVal"></div></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Email</div>
<div class="bankname-box-newui-right"><input id="email_emi" name="email_emi" type="text" class="input_lightbox" value="" onKeyDown="validateDiv('emailEmiVal');" onKeyUp="validateDiv('emailEmiVal');" onBlur="validateDiv('emailEmiVal');" /></div>
<div class="error-new-wrapper_b"><div id="emailEmiVal"></div></div>
<div style="clear:both;"></div>

<div class="bankname-box-newui-left">City</div>
<div class="bankname-box-newui-right">
<select name="city_emi" id="city_emi" class="select-input_lightbox" onChange="checkBtn(); validateDiv('cityEmiVal');" />
<?=plgetCityList($City)?>
</select>
</div>
<div class="error-new-wrapper_b"><div id="cityEmiVal"></div></div>
<div style="clear:both;"></div>

<div style="clear:both; height:15px;"></div>
<div class="info_text_lihgtbox">
<input id="accept" name="accept" type="checkbox" checked="checked" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#06C; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style="color:#06C; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style="color:#06C; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
<div id="acceptEmiVal"></div>
<div style="clear:both; height:10px;"></div>

<div class="bankname-box-newui-left"></div>
<div id="btn_submit" class="bankname-box-newui-right"><img name="submit" src="images/submit-btn-poll.png" height="47" width="109" onClick='checkPersonalDetailForm(); getLeadAjax(document.getElementById("Loan_Amount_Emi").value,document.getElementById("Months_Emi").value,document.getElementById("Interest_Rate_Emi").value,document.getElementById("full_name_emi").value,document.getElementById("mobile_emi").value,document.getElementById("email_emi").value,document.getElementById("city_emi").value,document.getElementById("source").value)' /></div>
<div id="btn_submit_ajax" class="bankname-box-newui-right" style="display:none;"><img name="submit" src="images/submit-btn-poll.png" height="47" width="109" onClick='getIntrRate(document.getElementById("Loan_Amount_Emi").value,document.getElementById("Months_Emi").value,document.getElementById("emp_status").value,document.getElementById("dob_month_sal").value,document.getElementById("dob_year_sal").value,document.getElementById("Company_Name").value,document.getElementById("monthly_income_sal").value,document.getElementById("obligation_sal").value,document.calc.CC_Holder_sal.value,document.getElementById("dob_month_SE").value,document.getElementById("dob_year_SE").value,document.getElementById("itr_paid_SE").value,document.getElementById("obligation_SE").value,document.calc.CC_Holder_SE.value,document.getElementById("Interest_Rate_Emi").value,document.getElementById("full_name_emi").value,document.getElementById("mobile_emi").value,document.getElementById("email_emi").value,document.getElementById("city_emi").value,document.getElementById("source").value,document.getElementById("Card_Vintage_Sal").value,document.getElementById("Card_Vintage_SE").value);' /></div>
<div style="clear: both;"></div>

</div> 

</div>

<div style="clear:both;"></div>
</form>
</div>

</div>
</div>
</div>
</div>
<div class="new_ui_product_box1"><a class='inline' href="javascript: void(0);" onClick="createlightbox(3); ga('send', 'event', 'PL Interest Rate', 'PL Interest Rate Button');"><img src="images/pl-interest-rate-circle.png" width="170" height="190" alt="Personal Loan Interest Rate"></a>
<div class="new_ui_product_box1_inn">Compare Interest Rates and avail Loan at lowest Interest Rate.</div>
<div id="light-3" class="white_content">
<a href="javascript:void(0)" onClick="closelightbox(3)" style="float:right"><img src="images/icon_cancel.gif" alt="" /></a>

<div id='inline_content3' style='padding:10px; background:#fff;'>
<div class="form_emiwrapper">
<form name="frm_pl_intr_rate" method="post">
<div class="heading_text_lihgtbox">Personal Loan Interest Rate </div>
<div class="bankname-box-newui-left">Bank Name</div>
<div class="bankname-box-newui-right">
<select id="bank_id" name="bank_name" class="select-input_lightbox">
    <option value="">Select Bank</option>
	<?php
	for($i=0;$i<$total_records;$i++)
{
			echo "<option value=".$showBankListRes[$i]['rateid'].">".$showBankListRes[$i]['bank_name']."</option>";
	}
    ?> 
</select>
</div>
<div class="error-new-wrapper"><div id="banklistVal"></div></div>
<div style="clear: both;"></div>
<div class="buttons_boxforlightbox"><img src="images/show-interest-rate-btn.png" width="149" height="41" onClick="check_bank_intr(); show_interest(document.getElementById('bank_id').value); ga('send', 'event', 'PL Interest Rate', 'PL Interest Rate Button');" /></div>
</form>
</div>

<div id="show_bank_intr_personal_details_area" class="form_emiwrapper" style="display:none;">
<form name="frmPersonalLoan" action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return check_pl_form(document.frmPersonalLoan);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal" />
<input type="hidden" name="source" value="PL Bank Intr Rate" />
<input type="hidden" name="PostURL" value="personal-loans2.php" />
<input type="hidden" id="BankNameStr" name="BankNameStr" value="" />
<div style="clear:both;"></div>
<div class="bankname-box-newui-left">Loan Amount</div>
<div class="bankname-box-newui-right">
<input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" type="text" class="input_lightbox" onKeyDown="validateDiv('loanAmtVal');" tabindex="1" />
</div>
<div class="error-new-wrapper"><div id="loanAmtVal"></div>
<span id='formatedlA' style='font-size:11px; font-weight:normal; color:#000000;font-Family:Verdana;'></span>
<span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;'></span>
</div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Tenure</div>
<div class="bankname-box-newui-right">
<input id="Tenure" name='Tenure' type='text' class="input_lightbox" value='' maxlength='10' onKeyDown="validateDiv('tenureVal');" tabindex="2" />
<div style="text-align:left; font-size:11px;"></div>
</div>
<div class="error-new-wrapper"><div id="tenureMsg" style="text-align:left;">(in months)</div><div id="tenureVal"></div>
</div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Full Name</div>
<div class="bankname-box-newui-right">
<input id="Name" name='Name' type='text' class="input_lightbox" value='' onKeyDown="validateDiv('nameVal');" tabindex="3" />
<div style="text-align:left; font-size:11px;"></div>
</div>
<div class="error-new-wrapper"><div id="nameVal"></div></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Mobile</div>
<div class="bankname-box-newui-right">
<input id="Phone" name='Phone' type='text' class="input_lightbox" value='' maxlength='10' onKeyDown="validateDiv('phoneVal');" tabindex="4" />
<div style="text-align:left; font-size:11px;"></div>
</div>
<div class="error-new-wrapper"><div id="phoneVal"></div>
</div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Email</div>
<div class="bankname-box-newui-right">
<input id="Email" name='Email' type='text' class="input_lightbox" value='' onKeyDown="validateDiv('emailVal');" tabindex="5" />
<div style="text-align:left; font-size:11px;"></div>
</div>
<div class="error-new-wrapper"><div id="emailVal"></div></div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">City</div>
<div class="bankname-box-newui-right">
<select name="City" id="City" class="select-input_lightbox" onChange="show_bank_othercity(this.value); validateDiv('cityVal');" tabindex="7">
<?=plgetCityList($City)?>
</select>
<div style="text-align:left; font-size:11px;"></div>
</div>
<div class="error-new-wrapper"><div id="cityVal"></div></div>
<div style="clear:both;"></div>

<div id="other_city_bank" style="display:none;">
<div class="bankname-box-newui-left">Other City</div>
<div class="bankname-box-newui-right">
<input name="City_Other" id="City_Other" type="text" class="input_lightbox" onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');" tabindex="8" />
</div>
<div class="error-new-wrapper"><div id="othercityVal"></div></div>
<div style="clear:both;"></div>
</div>

<div class="bankname-box-newui-left"></div>
<div class="bankname-box-newui-right">
<input name="confirm" type="image" src="images/confirm.png" width="109" height="41" onClick="ga('send', 'event', 'PL Confirm', 'PL Confirm Button');" />
<div style="text-align:left; font-size:11px;"></div>
</div>
<div class="error-new-wrapper"></div>
<div style="clear: both;"></div>
</form>
</div>

<div style="clear:both; height:10px;"></div>
<div id="show_interest_rate_handler"><a href="javascript: void(0)" onClick="document.getElementById('show_interest_rate').style.display='block'; document.getElementById('show_interest_rate_handler').style.display='none'; document.getElementById('hide_interest_rate_handler').style.display='block'; document.getElementById('content_update').style.display='none';" style="font-size:14px; color:#06599f; text-decoration:underline;">Show All Banks Interest rate (Per Lac amount)</a></div>
<div style="clear:both; height:10px;"></div>
<div id="content_update"></div>

<!-- Interest Rate Area starts here -->
<div id="hide_interest_rate_handler" style="display:none;"><a href="javascript: void(0)" onClick="document.getElementById('show_interest_rate').style.display='none'; document.getElementById('show_interest_rate_handler').style.display='block'; document.getElementById('hide_interest_rate_handler').style.display='none'; document.getElementById('content_update').style.display='block';" style="font-size:14px; color:#06599f; text-decoration:underline;">Hide All Banks Interest rate (Per Lac amount)</a></div>
<div style="clear:both; height:10px;"></div>
<div id="show_interest_rate" style="display:none;">
<div class="table-banks_overflow">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
<tr bgcolor="#FFFFFF">
<td height="22" align="center" valign="middle" class="tbl_txt" width="200" style="font-size:15px;"><b>Bank</b> </td>
<td width="300" align="center" valign="middle" class="tbl_txt" style="width:95px; font-size:15px;"><b>Interest Rates</b></td>
<td align="center" valign="middle" class="tbl_txt" width="100" style="font-size:15px;"><b>Apply</b></td>
</tr>
<?php 
$getplrates="Select rateid,cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1) order by bankwise_priority ASC";
list($alreadyExist2,$plrow)=MainselectfuncNew($getplrates,$array = array());

for($i=0;$i<$alreadyExist2;$i++)
{$maxrate="";
if(strlen($plrow[$i]["others"])>1)
{
$maxrate="-".$plrow[$i]["others"];
}
?>        
<tr bgcolor="#FFFFFF">
<?php if($plrow[$i]["rateid"]==5) 
{
?>
<td height="35" align="center" valign="middle" style="color:#335599;line-height:13px; text-decoration:none;font-size:14px;" class="tbl_txt"><a href="<?  echo $plrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $plrow[$i]["bank_name"]; ?></a></td>
<?php 	  }
else
{ ?>
<td height="35" align="center" valign="middle" style="font-size:14px;"><a href="<?php echo $plrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $plrow[$i]["bank_name"]; ?></a></td>
<? } ?>

<td align="center" valign="middle" class="tbl_txt" style="font-size:14px;"><?php echo $plrow[$i]["cat_a"]."".$maxrate; ?></td>
<td align="center" valign="middle" class="tbl_txt" style="font-size:14px;">
<? if($plrow[$i]["rateid"]==2) 
{
?>
<a href="http://www.deal4loans.com/hdfc-personal-loan-new.php" target="_blank"><img src="images/apply1.gif" width="45" height="20" border="0" /></a>  
<? }
elseif($plrow[$i]["rateid"]==5) 
{
?>

<? }
else if($plrow[$i]["rateid"]==9) 
{ ?>
<a href="http://www.deal4loans.com/get-quote-ingvysya.php" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
<? }
else if($plrow[$i]["rateid"]==10) 
{ ?>
<a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
<? }
else if($plrow[$i]["rateid"]==11) 
{ ?>
<a href="http://www.deal4loans.com/personal-loan-hdb-financial-services.php" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
<? }

else
{?>
<a href="<?  echo $plrow[$i]['bank_url'];?>" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
<? } ?>
</td>
<? }?>
</tr>
</table>
</div>
</div>

</div>
<!-- Interest Rate Area ends here -->
</div>
</div>
</div>

<div class="new_ui_product_box1">
<a class='inline' href="javascript: void(0);" onClick="createlightbox(1); ga('send', 'event', 'EMI Calc', 'PL EMI Calc Button');"><img src="images/instant-apply-circle.png" width="170" height="192" alt="Instant Apply" /></a>
<div class="new_ui_product_box1_inn">Check your eligibility and know the maximum amount you are eligible for.<!-- This contains the hidden content for inline calls -->

<div id="light-1" class="white_content">
<a href="javascript:void(0)" onClick="closelightbox(1)" style="float:right">
<img src="images/icon_cancel.gif" alt="" /></a>

<div id="inline_content" style="padding:10px; background:#fff; width:90%;">
<form name="personalloan_form"  action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal" />
<input type="hidden" name="source" value="PL Instant Apply" />
<input type="hidden" name="PostURL" value="personal-loans2.php" />
<div class="form_emiwrapper">
<div class="heading_text_lihgtbox">Instant Apply</div>
<!--<div class="bankname-box-newui-left sub_heading_text_lihgtbox">Personal Details</div>-->
<div style="clear:both;"></div>
<div class="bankname-box-newui-left">Loan Amount</div>
<div class="bankname-box-newui-right">
<input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" type="text" class="input_lightbox" onKeyDown="validateDiv('loanAmtVal');" tabindex="1" />
</div>
<div class="error-new-wrapper"><div id="loanAmtVal"></div>
<span id='formatedlA' style='font-size:11px; font-weight:normal; color:#000000;font-Family:Verdana;'></span>
<span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;'></span>
</div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Tenure</div>
<div class="bankname-box-newui-right">
<input id="Tenure" name='Tenure' type='text' class="input_lightbox" value='' maxlength='10' onKeyDown="validateDiv('tenureVal');" tabindex="2" /><div style="text-align:left; font-size:11px;">
</div>
</div>
<div class="error-new-wrapper"><div id="tenureMsg" style="text-align:left;">(in months)</div><div id="tenureVal"></div>
</div>
<div style="clear: both;"></div>

<div style="clear:both;"></div>
<div class="bankname-box-newui-left">Select Bank</div>
<div class="bankname-box-newui-right">
<div class="light_box_bankname"><div style="float:left; width:5px;"><input id="IngVysya" name="banks[]" type="checkbox" value="IngVysya" onClick="validateDiv('bankVal');" tabindex="3" /></div>
<div style="float:left; margin-left:10px;"><img src="images/ing-lightbox.png" width="67" height="24" alt="ING"></div></div>
<div class="light_box_bankname"><div style="float:left; width:5px; margin-left:5px;"><input id="Kotak" name="banks[]" type="checkbox" value="Kotak" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/kodak-light-box.png" width="67" height="24" alt="Kotal"></div></div>
<div class="light_box_banknamehdbfs"><div style="float:left; width:5px; margin-left:5px;"><input id="HDBFS" name="banks[]" type="checkbox" value="HDBFS" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/hdbfs.png" width="55" height="24" alt="HDBFS"></div></div>
<div style="clear:both;"></div>
<div class="light_box_bankname" ><div style="float:left; width:5px;"><input id="HDFC" name="banks[]" type="checkbox" value="HDFC" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/hdfc-bank-lightbox.png" width="67" height="24" alt="HDFC"></div></div>
<div class="light_box_bankname" ><div style="float:left; width:5px; margin-left:5px;"><input id="Axis" name="banks[]" type="checkbox" value="Axis" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/axis-bank-lightbox.png" width="67" height="24" alt="Axis"></div></div>
<div class="light_box_banknamehdbfs"><div style="float:left; width:5px; margin-left:5px;"><input id="CITI" name="banks[]" type="checkbox" value="Citi" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/ciitibank-light-box.png" width="55" height="24" alt="Citi"></div></div>
<div style="clear:both;"></div>
<div class="light_box_banknamebob"><div style="float:left; width:5px; margin-left:0px;"><input id="BOB" name="banks[]" type="checkbox" value="Bank-Of-Baroda" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/bank-of-baroda-light-box.png" width="91" height="24" alt="Bank of Baroda"></div></div>
<div class="light_box_banknamestandardch"><div style="float:left; width:5px; margin-left:5px;"><input id="Stanc" name="banks[]" type="checkbox" value="Stan-Chartered" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/standard-charterd-pl-lightbox.png" width="112" height="24" alt="Standard Charterd"></div></div>
<div style="clear:both;"></div>
<div class="light_box_banknamebob"><div style="float:left; width:5px; margin-left:0px;"><input id="ICICI" name="banks[]" type="checkbox" value="ICICI" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/icici-bank-light-box.png" width="91" height="24" alt="ICICI Bank"></div></div>
<div class="light_box_banknamestandardch"><div style="float:left; width:5px; margin-left:5px;"><input id="SBI" name="banks[]" type="checkbox" value="Bajaj-Finserv" onClick="validateDiv('bankVal');" /></div>
<div style="float:left; margin-left:10px;"><img src="images/bajaj-finserv-text.png" width="80" height="24" alt="BajajFin"></div></div>

</div>
<div class="error-new-wrapper"><div id="bankVal"></div>
</div>
<div style="clear:both; height:15px;"></div>

<div id="btn_apply" style="text-align: center; width:100%;"><input name="apply" type="image" src="images/applypl-new-blluebtn.png" width="109" height="41" onClick="ga('send', 'event', 'PL Apply', 'PL PL Apply Button');" />&nbsp;</div>
</div>

<div style="clear:both; height:10px;"></div>
<div class="form_emiwrapper">
<div id="personal_details_area" style="display:none;">
<div class="bankname-box-newui-left sub_heading_text_lihgtbox">Personal Details</div>
<div style="clear:both;"></div>
<div class="info_text_lihgtbox"><img src="images/lock-image.png" width="9" height="13" /> Your Information is secure with us and will not be shared without your consent</div>
<div style="clear: both;"></div>

<div class="bankname-box-newui-left">Mobile</div>
<div class="bankname-box-newui-right">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th width="12%" scope="row">+91</th>
<td width="88%">
<input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="input_lightbox" onKeyDown="validateDiv('phoneVal');" tabindex="4" />

</td>
</tr>
</table>
</div>
<div class="error-new-wrapper"><div id="phoneVal"></div></div>
<div style="clear:both;"></div>

<div class="bankname-box-newui-left">Email ID</div>
<div class="bankname-box-newui-right">
<input name="Email" id="Email" type="text" class="input_lightbox" onKeyDown="validateDiv('emailVal');" tabindex="5" />
</div>
<div class="error-new-wrapper"><div id="emailVal"></div>
</div>
<div style="clear:both;"></div>

<div class="bankname-box-newui-left">Full Name</div>
<div class="bankname-box-newui-right">
<input name="Name" id="Name" type="text" class="input_lightbox" onKeyDown="validateDiv('nameVal');" tabindex="6" />
</div>
<div class="error-new-wrapper"><div id="nameVal"></div>
</div>
<div style="clear:both;"></div>

<div class="bankname-box-newui-left">City</div>
<div class="bankname-box-newui-right">
<select name="City" id="City" class="select-input_lightbox" onChange="othercity1(); validateDiv('cityVal');" tabindex="7">
<?=plgetCityList($City)?>
</select>
</div>
<div class="error-new-wrapper"><div id="cityVal"></div>
</div>

<div id="other_city_area" style="display:none;">
<div style="clear: both;"></div>
<div class="bankname-box-newui-left">Other City</div>
<div class="bankname-box-newui-right">
<input name="City_Other" id="City_Other" type="text" class="input_lightbox" onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');" tabindex="8" />
</div>
<div class="error-new-wrapper"><div id="othercityVal"></div>
</div>
</div>
<div style="clear:both;"></div>

<div style="clear:both; height:15px;"></div>
<div class="info_text_lihgtbox">
<input name="accept" type="checkbox" checked="checked" tabindex="9" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#06C; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#06C; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#06C; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
<div id="acceptVal"></div>
<div style="clear:both; height:10px;"></div>
<div id="btn_confirm" class="buttons_boxforlightbox" style="display:none;"><input name="confirm" type="image" src="images/confirm.png" width="109" height="41" onClick="ga('send', 'event', 'PL Confirm', 'PL Confirm Button');" />&nbsp;</div>
</div>
</div>
</div>
<!--</div>-->
</form>
</div>

</div>
</div>
</div>

<div style="clear:both; height:10px;"></div>
<div class="newul_pl_wrapper1"><h2 class="h1-newpl">Required Documents <br>
</h2>
<br />
<span class="new_ui_text2"><strong>To get your personal loan approved, you need to submit these following documents.<em><br>
<br>
</em></strong><em>A photocopy of PAN card<br />
</em><br />
</span>
<div class="clearfix"></div>
<table width="95%" border="1" cellspacing="2" cellpadding="5" style="border:#CCC solid thin;" align="center">
<tr>
<th width="51%" height="35" align="left" bgcolor="#FFEFDF" class="new_ui_text2" scope="row">In case of Salaried</th>
<td width="49%" height="35" bgcolor="#FFEFDF" class="new_ui_text2"><strong>In case of Self Employed</strong></td>
</tr>
<tr>
<td height="25" align="left" bgcolor="#FFFFFF" class="new_ui_text2" scope="row">•  Identity proof </td>
<td height="25" bgcolor="#FFFFFF" class="new_ui_text2">•  Balance Sheets </td>
</tr>
<tr>
<td height="25" align="left" bgcolor="#FFFFFF" class="new_ui_text2" scope="row" >•  3 to 6 months Bank statements</td>
<td height="25" bgcolor="#FFFFFF" class="new_ui_text2">•  Profit &amp; Loss Account </td>
</tr>
<tr>
<td height="25" align="left" bgcolor="#FFFFFF" class="new_ui_text2" scope="row">•  Residence proof </td>
<td height="25" bgcolor="#FFFFFF" class="new_ui_text2">•  Partnership Deed &amp; other mandatory documents etc.</td>
</tr>
<tr>
<td height="25" align="left" bgcolor="#FFFFFF" class="new_ui_text2" scope="row">•  Salary slip </td>
<td height="25" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
<td height="25" align="left" bgcolor="#FFFFFF" class="new_ui_text2" scope="row">•  Guarantors &amp; their same set of documents </td>
<td height="25" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
</table>
<br/>
<h3 class="h1-newpl">Associated Banks</h3>
<br />
<div class="banks_associated_box"><img src="images/citibank-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/ing-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/indusind-bank-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/bajaj-finserv-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/standard-chartered-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/hdfc-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/hdb-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/fullerton-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/kotak-associated.png" width="91" height="36"></div>
<div class="banks_associated_box"><img src="images/fullerton-associated.png" width="91" height="36"></div>
<div style="clear:both;"></div>

<div style="clear:both;"></div>
</div>
<div id="fade" class="black_overlay"></div>
<div style="clear:both; height:10px;"></div>
<?php include "footer.php"; ?>
</body>
</html>