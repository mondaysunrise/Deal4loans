<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

$showCCOfferSql = "SELECT * FROM `credit_card_banks_eligibility` WHERE cc_bank_flag=1 order by cc_priority ASC";
//$showCCOfferQry = ExecQuery($showCCOfferSql);
//echo "total rows: ".mysql_num_rows($showCCOfferQry);


list($rowscount,$showCCOfferRes)=MainselectfuncNew($showCCOfferSql,$array = array());
		//$Cctr=0;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Credit Card - Compare all banks Credit Cards in India 2017</title>
<meta name="keywords" content="Credit cards India, apply for credit cards, Online Comparison credit cards, Credit card reward points, credit card benefits, Credit Card, Credit Cards" />
<meta name="description" content="Credit Card: Apply Online Now for &#10004;  Free credit cards &#10004; Eligibility Criteria &#10004;  Instant e-Approval &#10004; Quick Apply. Check and Compare Credit cards of different banks Online." />
<link href="css/credit-cards-new-ui.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="css/d4lmenu.css" rel="stylesheet" />
<!--<link rel="stylesheet" href="css/fm.selectator.jquery.css" />-->
<style>
body { 
	margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;
	font-family: sans-serif; font-size:12px;
}
label {
	display: block;
	margin-bottom: 5px;
}
#select1 {
	width: 250px;
	padding: 7px 10px;
}
#select2 {
	padding: 5px;
	width: 350px;
	height: 36px;
}
#select3 {
	width: 350px;
	height: 36px;
}
#select4 {
	width: 350px;
	height: 36px;
}		
#select5 {
	width:350px;
	height:50px;
}
/**
 * Selectator jQuery Plugin
 * A plugin for select elements
 * version 1.1, Dec 10th, 2013
 * by Ingi P. Jacobsen
 */

/* reset */
.selectator * {
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	text-decoration: none;
}
.selectator img {
	display: block;
}

/* dimmer */
#selectator_dimmer {
	background-color: rgba(0,0,0,.1);
	width: 100%;
	height: 100%;
	position: fixed;
	z-index: 100;
}

/* Main box */
.selectator {
	border: 1px solid #d0d1d4;
	box-sizing: border-box;
	background-color: #fff;
	display: inline-block;
	text-decoration: none;
}
.selectator.multiple {
	padding-right: 20px !important;
	padding-bottom: 5px !important;
}
.selectator.single {
	height: 36px;
	padding: 7px 10px !important;
}
.selectator:after {
	position: absolute;
	cursor: pointer;
	content: '\25BC';
	font-size: 90%;
	right: 4px;
	color: #0572b3;
	top: 50%;
	line-height: 0;
}

/* chosen items holder */
        .selectator_chosen_items {
	display: inline;
}
.single .selectator_chosen_items {
	display: block;
}

/* chosen item */
          .selectator_chosen_item {
	display: inline-block;
	background-color: #39f;
	border-radius: 2px;
	color: #fff;
	padding: 4px 20px 4px 4px;
	font-size: 13px;
	margin: 2px;
	position: relative;
	vertical-align: top;
}
.single   .selectator_chosen_item {
	background-color: transparent;
	color: #000;
	display: block;
	text-decoration: none;
	padding: 0;
	margin: 0;
	font-size: inherit;
}
.multiple .selectator_chosen_item {
	margin: 5px 0 0 5px;
	padding: 3px 20px 2px 5px;
}
/* chosen item - left */
          .selectator_chosen_item_left {
	float: left;
	width: 25px;
}
          .selectator_chosen_item_left img {
	height: 23px;
}
.multiple .selectator_chosen_item_left {
	float: left;
	width: 22px;
}
.multiple .selectator_chosen_item_left img {
	height: 18px;
}
/* chosen item - title */
          .selectator_chosen_item_title {
	
}
.single   .selectator_chosen_item_title {
	height: auto;
}
.multiple .selectator_chosen_item_title {
	float: left;
	padding-top: 2px;
}
/* chosen item - subtitle */
.selectator_chosen_item_subtitle {
	display: none;
}
/* chosen item - right */
.selectator_chosen_item_right {
	float: right;
	width: 20px;
	background-color: #ccc;
	font-size: 15px;
	color: #fff;
	text-align: center;
	border-radius: 3px;
	padding: 3px;
	margin-right: 20px;
}
.multiple .selectator_chosen_item_right {
	display: none;
}

/* chosen item remove button */
          .selectator_chosen_item_remove {
	display: inline-block;
	font-weight: bold;
	color: #fff;
	margin: 0 0 0 5px;
	padding: 6px 5px 4px 5px;
	cursor: pointer;
	font-size: 11px;
	line-height: 10px;
	vertical-align: top;
	border-radius: 0 2px 2px 0;
	position: absolute;
	right: 0;
	top: 0;
	bottom: 0;
}
          .selectator_chosen_item_remove:hover {
	color: #000;
	background-color: #8cf;
}
.single   .selectator_chosen_item_remove {
	display: none;
}
.multiple .selectator_chosen_item_remove {
	padding: 7px 5px 4px 5px;
}
.multiple .selectator_chosen_item_remove:hover {
	
}
.multiple .selectator_input,
.multiple .selectator_textlength {
	padding: 1px 0 0 0;
	margin: 7px 0 2px 5px;
}




/* input box */
                        .selectator_input,
                        .selectator_textlength {
	border: 0;
	display: inline-block;
	margin: 0;
	background-color: transparent;
	font-size: 13px;
	outline: none;
	padding: 6px 0 0 0;
}
.single                 .selectator_input {
	border: 1px solid #7f9db9;
	position: absolute;
	bottom: -40px;
	left: -1px;
	z-index: 101;
	padding: 10px 25px;
	width: 100%;
	width: calc(100% + 2px);
	border-bottom: 0;
	background-color: #f6f6f6;
	color: #333;
	font-size: inherit;
}
.single.options-hidden  .selectator_input {
	opacity: 0;
	position: absolute;
	left: -10000px;
}
.single.options-visible .selectator_input {
	opacity: 1;
}
.disable_search         .selectator_input {
	opacity: 0;
	padding: 0 1px 1px 0 !important;
}

/* options holder */
                           .selectator_options {
	margin: 0;
	padding: 0;
	border: 1px solid #7f9db9;
	border-radius: 0 0 3px 3px;
	font-family: sans-serif;
	position: absolute;
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	z-index: 101;
	background-color: #fff;
	overflow-y: scroll;
	max-height: 250px;
	list-style: none;
	left: -1px;
	right: -1px;
}
.single                    .selectator_options {
	padding-top: 0;
	border-top: 0;
}
       .disable_search     .selectator_options {
	border-top: 1px solid #7f9db9;
}
.single.disable_search     .selectator_options {
	padding-top: 0;
}
.selectator.options-hidden .selectator_options {
	display: none;
}

/* option item group header */
.selectator_group_header {
	padding: 5px;
	font-weight: bold;
}

/* option item group holder */
.selectator_group {
	margin: 0;
	padding: 0;
	list-style: none;
}

/* option item */
                  .selectator_option {
	padding: 5px;
	cursor: pointer;
	color: #000;
}
                  .selectator_option.active {
	background-color: #39f;
	color: #fff;
}
.selectator_group .selectator_option {
	padding: 5px 5px 5px 20px;
}
/* option item - left */
.selectator_option_left {
	float: left;
}
.selectator_option_left img {
	height: 30px;
}
/* option item - title */
.selectator_option_title {
	margin-left: 35px;
}
/* option item - subtitle */
.selectator_option_subtitle {
	font-size: 75%;
	color: #888;
	margin-left: 35px;
}
/* option item - right */
.selectator_option_right {
	float: right;
	width: 30px;
	background-color: #ccc;
	font-size: 15px;
	color: #fff;
	text-align: center;
	border-radius: 3px;
	padding: 6px;
}
.table_bgcolor_Border{ background:#A5C0ED;}
.table_bgcolor{ background:#D5E1F7;	}


/*..........new css added on 28-1-2015 starts ................*/
.header-con-main-wrapper{ width:950px; margin:5px auto;}
.header-con-main-wrapper-box1{ width:188px; float:left; font-family:'Roboto Condensed', sans-serif;font-size:15px;color:#FFF; text-align:center; margin-top:10px;}
.header-con-main-wrapper-box2{ width:43px; margin-top:25px ; float:left; font-family:'Roboto Condensed', sans-serif;font-size:27px;color:#FFF; text-align:center;}	
.header-con-main-wrapper-box3{ width:370px; margin:5px auto; float:right; font-family:'Roboto Condensed', sans-serif;font-size:15px;color:#FFF; text-align:center;}
.footer_new_main4_respon{ color:#697e94;}
@media screen and (max-width:880px){
.header-con-main-wrapper{ width:95%; margin:5px auto;}
.header-con-main-wrapper-box1{ width:188px; float:none; font-family:'Roboto Condensed', sans-serif;font-size:15px;color:#FFF; text-align:center; margin:auto;}
.header-con-main-wrapper-box2{ width:43px; margin-top:25px ; float:none; font-family:'Roboto Condensed', sans-serif;font-size:27px;color:#FFF; text-align:center; margin:auto;}
.header-con-main-wrapper-box3{ width:100%; margin:5px auto; float:none; font-family:'Roboto Condensed', sans-serif;font-size:15px;color:#FFF; text-align:center;}

.header-credit-card{ width:100%; background:#00aad3!important; padding-top:10px; padding-bottom:10px;}
.header_inner-credit-card{ width:100%; margin:auto;}
.form_top_wrapper-credit-card{ margin:15px auto; width:90%;}
.h1-credit-card{margin:auto;font-family:'Raleway';font-size:39px;color:#FFF; margin-top:0px;
font-weight:300;text-align:center; text-shadow:#000 1px 2px 2px; padding:25px 0px 5px 0px;}
.logo{ float:left; width:181px;}
.banner-credit-card{ width:100%; height:450px; background:#00aad3!important;}
.banner_a-credit-card{ width:90%; margin:auto;}
}
/*..........new css added on 28-1-2015 ends ................*/	
</style>
<!--For Popup-->
<link rel="stylesheet" href="css/jquery.popdown.css" />
<script  src="js/fm.selectator.jquery.js"></script>
<script>
	$(function () {
		var $activate_selectator1 = $('#activate_selectator1');
		$activate_selectator1.click(function () {
			var $select1 = $('#select1');
			if ($select1.data('selectator') === undefined) {
				$select1.selectator({
					labels: {
						search: 'Search here...'
					}
				});
				$activate_selectator1.val('destroy selectator');
			} else {
				$select1.selectator('destroy');
				$activate_selectator1.val('activate selectator');
			}
		});
		$activate_selectator1.trigger('click');

		var $activate_selectator2 = $('#activate_selectator2');
		$activate_selectator2.click(function () {
			var $select2 = $('#select2');
			if ($select2.data('selectator') === undefined) {
				$select2.selectator({
					useDimmer: true
				});
				$activate_selectator2.val('destroy selectator');
			} else {
				$select2.selectator('destroy');
				$activate_selectator2.val('activate selectator');
			}
		});
		$activate_selectator2.trigger('click');

		var $activate_selectator3 = $('#activate_selectator3');
		$activate_selectator3.click(function () {
			var $select3 = $('#select3');
			if ($select3.data('selectator') === undefined) {
				$select3.selectator({
					useSearch: false
				});
				$activate_selectator3.val('destroy selectator');
			} else {
				$select3.selectator('destroy');
				$activate_selectator3.val('activate selectator');
			}
		});
		$activate_selectator3.trigger('click');

		var $activate_selectator4 = $('#activate_selectator4');
		$activate_selectator4.click(function () {
			var $select4 = $('#select4');
			if ($select4.data('selectator') === undefined) {
				$select4.selectator({
					showAllOptionsOnFocus: true
				});
				$activate_selectator4.val('destroy selectator');
			} else {
				$select4.selectator('destroy');
				$activate_selectator4.val('activate selectator');
			}
		});
		$activate_selectator4.trigger('click');

		var $activate_selectator5 = $('#activate_selectator5');
		$activate_selectator5.click(function () {
			var $select5 = $('#select5');
			if ($select5.data('selectator') === undefined) {
				$select5.selectator({
					useSearch: false
				});
				$activate_selectator5.val('destroy selectator');
			} 
		});
		$activate_selectator5.trigger('click');
	});
</script>
<script type="text/javascript">
function ckhcreditcard(Form)
{
	var j;
	var l;
	var r;
	var cntr=-1;
	var cnt=-1;
	var cntl=-1;
	var cntlb=-1;
	var cntSa=-1;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cit=document.creditcard_form.City.value;
	var sal=document.creditcard_form.Net_Salary.value;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 		
	if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
	if(document.creditcard_form.Net_Salary.value=="" || document.creditcard_form.Net_Salary.value=='e.g. 0000000')
	{
		document.getElementById('netSalaryVal').innerHTML = "<span class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}
	if(document.creditcard_form.Employment_Status.value==1)
	{
		if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(document.creditcard_form.Company_Name.value))==false)
		{
			document.getElementById('companyNameVal').innerHTML = "<span class='hintanchor'>Fill Company Name!</span>";	
			document.creditcard_form.Company_Name.focus();
			return false;
		}
		else if(document.creditcard_form.Company_Name.value.length < 3)
		{
			document.getElementById('companyNameVal').innerHTML = "<span class='hintanchor'>Fill Company Name!</span>";	
			document.creditcard_form.Company_Name.focus();
			return false;
		}
	}
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}	
	if((document.creditcard_form.Full_Name.value=="") || (document.creditcard_form.Full_Name.value=="eg Rama") || (Trim(document.creditcard_form.Full_Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.creditcard_form.Full_Name.focus();
		return false;
	}
	if(document.creditcard_form.Full_Name.value!="")
	{
		if(containsdigit(document.creditcard_form.Full_Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
	}
	for (var i = 0; i <document.creditcard_form.Full_Name.value.length; i++) 
	{
		if (iChars.indexOf(document.creditcard_form.Full_Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
	}
  	if(document.creditcard_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Fill Mobile Number!</span>";
		document.creditcard_form.Phone.focus();
		return false;
	}
	if(isNaN(document.creditcard_form.Phone.value)|| document.creditcard_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Enter numeric value!</span>";
		document.creditcard_form.Phone.focus();
		return false;  
	}
	if (document.creditcard_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	if ((document.creditcard_form.Phone.value.charAt(0)!="9") && (document.creditcard_form.Phone.value.charAt(0)!="8") && (document.creditcard_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	if(document.creditcard_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}

	var str=document.creditcard_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	
	if(str=='xyz@abcd.com')
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	if(document.creditcard_form.Age.selectedIndex==0)
	{
		document.getElementById('ageVal').innerHTML = "<span class='hintanchor'>Select your Age!</span>";	
		document.creditcard_form.Age.focus();
		return false;
	}
	if(document.creditcard_form.No_of_Banks.selectedIndex==0)
	{
		document.getElementById('ccbnknmeVal').innerHTML = "<span class='hintanchor'>Select card from which Bank!</span>";	
		document.creditcard_form.No_of_Banks.focus();
		return false;
	}
	if(!document.creditcard_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.creditcard_form.accept.focus();
		return false;
	}
	return true;
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

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
</script>
<style>
.hintanchor{
	font-size:11px;
	padding:3px;
	border:1px solid red;
	color:red;
	background-color:#DCEEEF;
}
</style>
<!--<link href="css/personal-loans-new-styles.css" type="text/css" rel="stylesheet" />-->
<script async src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<!--<script type="text/javascript" src="modernizr.custom-90229.js"></script>-->
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<!-- Add this for Company list -->
<script async type="text/javascript" src="ajax.js"></script>
<script async type="text/javascript" src="ajax-dynamic-hhtpspllist.js"></script>
<style type="text/css">
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
	z-index:50;
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
	position:relative;
	z-index:5;
}
</style>
<!--//-->

<script type="text/javascript">
function show_personal_details(){

	document.getElementById("personal_details_area").style.display="block";
}

function get_credit_card_offers(){
	
	var el_length = document.frmCategory.select4.length;
	var tot_category = '';
	var i;
	
	for(i=0;i<el_length;i++){
		
		document.getElementById("header-con-main-wrapper").style.display='none';
		document.getElementById("card_info_section").style.display='none';
		document.getElementById("both_sbi_cards").style.display='none';
		document.getElementById("credit-card-info").style.display='none';
		document.getElementById("best-discount-offers").style.display='none';
		
		if(document.frmCategory.select4[i].selected){
			
			if(tot_category!=''){
				tot_category += ","+document.frmCategory.select4[i].value;
			}else{
				tot_category += document.frmCategory.select4[i].value
			}
			
			if(document.frmCategory.select4[i].value==1){
				//alert("Hi: "+document.frmCategory.select4[i].value);
				document.getElementById("credit_card_sbi_signature").style.display='block';
			}
			if(document.frmCategory.select4[i].value==2){
				//alert("Hi: "+document.frmCategory.select4[i].value);
				document.getElementById("credit_card_sbi_signature").style.display='block';
			}
			if(document.frmCategory.select4[i].value==4){
				//alert("Hi: "+document.frmCategory.select4[i].value);
				document.getElementById("credit_card_sbi_gold").style.display='block';
			}		
		}
	}
	document.getElementById("card_category").value=tot_category;
	document.getElementById("content_update").style.display='block';
	if(tot_category==''){
		document.getElementById("card_info_section").style.display='block';
	}
	//alert("Hi "+tot_category);
	
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { 
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			
			document.getElementById("content_update").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax_cc_info.php?cat_tag="+tot_category,true);
	xmlhttp.send();
}

function showCreditCardInfo(){
	//alert("Hi!");
	document.getElementById("credit-card-info").style.display='block';
	document.getElementById("best-discount-offers").style.display='none';
	document.getElementById("content_update").style.display='none';
	document.getElementById("both_sbi_cards").style.display='none';
	document.getElementById("card_info_section").style.display='none';
	document.getElementById("credit_card_sbi_gold").style.display='none';
	document.getElementById("credit_card_sbi_signature").style.display='none';
}
function showBestDiscountOffer(){
	//alert("Hello!");
	document.getElementById("best-discount-offers").style.display='block';
	document.getElementById("credit-card-info").style.display='none';
	document.getElementById("content_update").style.display='none';
	document.getElementById("both_sbi_cards").style.display='none';
	document.getElementById("card_info_section").style.display='none';
	document.getElementById("credit_card_sbi_gold").style.display='none';
	document.getElementById("credit_card_sbi_signature").style.display='none';
}

</script>

</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="banner-credit-card" style="margin-top:70px;">
<div class="banner_a-credit-card">
<div class="h1-credit-card">Select a credit card to compliment your style</div>
<div class="clearfix"></div>
<div class="form_top_wrapper-credit-card">
<div class="box1_tp_form-credit-card" style="background:#ff9833;">I am looking Credit Cards for</div>

<label for="select4"></label>
<form name="frmCategory">
<select id="select4" name="select4" multiple style="width:100% !important;" onChange="get_credit_card_offers();">
  <optgroup class="group_one">
    <option value="1" class="option_ten" data-subtitle="" data-left="<img src='images/travel-offer-icon.jpg'>">Travel Offer</option>
    <option value="2" class="option_one" data-subtitle="" data-left="<img src='images/lifestyle-entertainment.jpg'>">Lifestyle & Entertainment </option>
    <option value="3" class="option_two" data-subtitle="" data-left="<img src='images/cash-back-offer-icon.jpg'>">Cash back Offer</option>
    <option value="4" class="option_two" data-subtitle="" data-left="<img src='images/petro-offer-icon.jpg'>">Petro Offer</option>
    <option value="5" class="option_two" data-subtitle="" data-left="<img src='images/dining-lp--icon.jpg'>">Dining Offer</option>
    <option value="6" class="option_two" data-subtitle="" data-left="<img src='images/zero-fee-offer.jpg'>">0 fee Credit Card</option>
  </optgroup>
</select>
<input value="activate selectator" id="activate_selectator4" type="button" style="display:none;">
</form>
</div>
<!--
<div>
	<a href="javascript: void(0);" onClick="showCreditCardInfo();">Credit Card information</a> Or <a href="javascript: void(0);" onClick="showBestDiscountOffer();">Show me the best discount Offers on Credit Cards</a>
</div>
-->
</div>

<div class="header-con-main-wrapper">  
    <div class="header-con-main-wrapper-box1">
    	<a href="#showCredit" onClick="showCreditCardInfo();"  style="color:#FFFFFF!important;">
        <div>
        <img src="images/card-information-icon.png" width="53" height="39" alt="Credit Card information" border="0">
        </div>
	    Credit Card information
        </a>
    </div>
	<div class="header-con-main-wrapper-box3">
  		
        <div>
        <img src="images/discount-offer-icon.png" width="74" height="44" alt="Discount Offer"><br>
    	Show me the best discount Offers on Credit Cards  
        </div>
	</div>
    <div class="clear"></div>
</div>

</div>

<div class="second-wrapper-credit-card">
<form name="creditcard_form" action="get_cc_eligiblebank.php" method="POST" onSubmit="return ckhcreditcard(document.creditcard_form); ">
<input type="hidden" name="source" value="CC main page">
<input type="hidden" name="PostURL" value="/get_cc_eligiblebank.php">
<input type="hidden" id="card_category" name="card_category" value="" />
<div class="main_form-wrapper_newui">
<div class="p-credit-card" align="left"><strong>Choose a credit card with best features, rewards & offers for maximum benefits</strong> </div>
<div class="clearfix"></div>
<div class="row1-credit-card">
<div class="row1_sub-credit-card">
<div class="row1_sub_a-credit-card">Select type of employment</div>
<div class="row1_sub_b-credit-card">
<select name="Employment_Status" id="Employment_Status" class="select_input-credit-card" onChange="validateDiv('empStatusVal');" tabindex="2">
    <option value="-1">Please Select</option>
    <option value="1">Salaried</option>
    <option value="0">Self Employment</option>
</select>
<div id="empStatusVal" class="alert_msg"></div>

</div>
</div>
<div class="row1_sub_2-credit-card"><div class="row1_sub_c-credit-card">Annual Income</div>
<div class="row1_sub_b">
<input type="text" name="Net_Salary" id="Net_Salary" class="input-credit-card" value="e.g. 0000000" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" onBlur="if(this.value==''){this.value='e.g. 0000000';} getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onChange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');" onFocus="if(this.value=='e.g. 0000000') {this.value='';}" tabindex="3" autocomplete="off"  />
<div id="dialog-modal"></div>
<div id="netSalaryVal"></div>
<span id='formatedIncome' style='font-size:11px; font-weight:normal; font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px; font-weight:normal; font-Family:Verdana;text-transform: capitalize;'></span>

</div>
</div>
</div>
<div class="clearfix"></div>
<div class="third-row-credit-card">
<div class="third-row-inn-a-credit-card">Profession/Company</div>
<div class="third-row-inn-b-credit-card">
<input name="Company_Name" id="Company_Name" type="text" class="input-credit-card" onKeyDown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)"  value="Type Slowly for Autofill" onBlur="onBlurDefault(this,'Type Slowly for Autofill');" onFocus="if(this.value=='Type Slowly for Autofill'){this.value='';}" tabindex="4" />
<div id="companyNameVal"></div>
</div>
</div>
<div class="fourth-row-credit-card">
<div class="fourth-row_a-credit-card">Select your city</div>
<div class="fourth-row_b-credit-card">
<select name="City" id="City" class="select_input-credit-card" onChange="show_personal_details(); validateDiv('cityVal');" tabindex="5">
<?=plgetCityList($City)?>
</select>
<div id="cityVal"></div>
</div>
</div>
<div class="clearfix"></div>

<div id="personal_details_area" style="display:none;">
<div class="personal-detailsabc">
<div class="personal-detailsabc-in"> <strong>Personal Details</strong><br>
<span class="termtext" align="left"> <img src="images/lock-image.png" alt="lock-img" width="9" height="13" />Your details are secure and will not be shared without your consent.</span>
</div>
<div class="clearfix"></div>

<div class="fifth_wrapper-credit-card"><div style="float:left; margin-top:5px; width:50px; font-family:'Roboto Condensed', sans-serif;font-size:17px;">Name</div>
<div class="fifth_row-credit-card"><input name="Full_Name" id="Full_Name" type="text" value="eg Rama" class="input-credit-card" onFocus="if(this.value=='eg Rama'){ this.value='';}" onBlur="if(this.value==''){ this.value='eg Rama'; }" onKeyUp="validateDiv('nameVal');" onKeyDown="validateDiv('nameVal');" tabindex="6" /><div id="nameVal"></div></div>
<div class="fifth_row_b-credit-card"><div class="fifth_cs">Contact details +91 </div>
  <div class="fifth_row_c-credit-card">
    <input name="Phone" id="Phone" maxlength="10" value="0000000000" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" type="text" class="input-credit-card" onKeyDown="validateDiv('phoneVal');" onFocus="if(this.value=='0000000000'){ this.value=''; }" onBlur="if(this.value==''){ this.value='0000000000'; }" tabindex="7" /><div id="phoneVal"></div>
  </div>
</div>
<div class="clearfix"></div>
<div class="sixth-row-credit-card">
<div class="sixth-row-inner-credit-card"><div class="sixth-row-inner-a-credit-card">Email ID </div> <div class="sixth-row-inner-b"><input name="Email" id="Email" type="text" value="xyz@abcd.com" class="input-credit-card" onFocus='if(this.value=="xyz@abcd.com"){ this.value=""; }' onBlur='if(this.value==""){ this.value="xyz@abcd.com"; }' onkeyup="validateDiv('emailVal');" onKeyDown="validateDiv('emailVal');" tabindex="8" />
<div id="emailVal"></div> 
</div></div>
<div class="sixthe_right-credit-card"><div class="sixthe_right-a-credit-card">Age</div>
<div class="sixthe_right-b-credit-card">
<select name="Age" class="select_input-credit-card" onChange="validateDiv('ageVal');" tabindex="9">
	<option value="0">select</option>
    <?php
	for($i=20;$i<=62;$i++){
		echo "<option value=".$i.">".$i."</option>";
	}
	?>
</select>
<div id="ageVal"></div>
</div>

</div>

</div>
<div class="clearfix"></div>
<div class="seventh-wrapper-credit-card">
<div class="seventh-row-a-credit-card">Do you have a credit card?</div>
<div class="seventh-row-b-credit-card">
<select size="1" name="No_of_Banks" id="No_of_Banks" class="select_input-credit-card" onChange="validateDiv('ccbnknmeVal');" tabindex="10">
    <option value="0">Please select</option> 
    <option value="HDFC Bank">HDFC Bank</option> 
    <option value="Standard Chartered">Standard Chartered</option> 
    <option value="Kotak Bank">Kotak Bank</option>
    <option value="ICICI Bank">ICICI Bank</option>
    <option value="RBL Bank">RBL Bank</option>
    <option value="Other">Other</option>
</select>
<div id="ccbnknmeVal"></div>
</div>
</div>

</div>
<div class="clearfix"></div>

<div class="fifth_wrapper-credit-card">
    <div class="fifth_row-credit-card" style="width:80%">
    <input name="accept" type="checkbox" checked="checked" onClick="validateDiv('acceptVal');" /> I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Terms and Conditions</a>.
    <div id="acceptVal"></div>
    </div>
</div>
<div class="clearfix"></div>
</div>

<div class="p-credit-card" style="margin-top:10px;"><input type="image" src="images/blue-quotebtn15.png" border="0" width="157" height="53" /></div>
</div>
</form>
</div>

<div class="bg-creditcard-shadow"><img src="images/bg-shadow-credit-card.png" width="100%" height="22"></div>
<div class="clear"></div>

<div class="clear"></div>
<!--<div id="credit_card_sbi_gold" class="table-credit-card" style="display:none;">
    <a href="https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/GoldNMoreLanding?GEMID1=dis_d4l_sbag2_eapp_mas_010115_ia_e-apply"><img src="images/sbi/728x90_G2.jpg" alt="sbi-gold-card" height="90" width="728" /></a>
</div>
<div id="credit_card_sbi_signature" class="table-credit-card" style="display:none;">
    <a href="https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/SignatureLanding?GEMID1=dis_d4l_sbas1_eapp_mas_010115_ia_e-apply"><img src="images/sbi/728x90_S1.jpg" alt="sbi-signature-card" height="90" width="728" /></a>
</div>

<div id="both_sbi_cards" class="overflow-width" >
    <div id="credit_card_sbi_gold" class="table-credit-card">
    	<a href="https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/GoldNMoreLanding?GEMID1=dis_d4l_sbag2_eapp_mas_010115_ia_e-apply"><img src="images/sbi/728x90_G2.jpg" alt="sbi-gold-card" height="90" width="728" /></a>
    </div>
    <div id="credit_card_sbi_signature" class="table-credit-card">
    	<a href="https://www.sbicard.com/EApplyWeb/EApplyCustomLandingServlet/SignatureLanding?GEMID1=dis_d4l_sbas1_eapp_mas_010115_ia_e-apply"><img src="images/sbi/728x90_S1.jpg" alt="sbi-signature-card" height="90" width="728" /></a>
    </div>-->
</div>

<div id="content_update"></div>

<div id="card_info_section">
<?php
$indx = 0; 
 $i = 0;
 while($i<count($showCCOfferRes))
        {
        
       
       
?>
<div id="credit-card-<?php echo $indx; ?>" class="table-credit-card">
  <table width="100%" border="0" style="pa" cellspacing="0" cellpadding="10">
    <tr>
      <th width="24%" height="25" align="center" scope="row"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="39%" align="left" class="rating-text" scope="row"></td>
          <td width="61%" align="left" class="rating-text"><!--<img src="images/rating-green.png" width="90" height="17">--></td>
        </tr>
      </table></th>
      <td width="1%" rowspan="2" align="center" bgcolor="#00adeb" class="white-text tablebody-text" style="color:#FFF; background:#00adeb;"></td>
      <td width="12%" rowspan="2" align="left" class="tablebody-text" style="border-right:#49d9fb solid thin;"><strong>Joining & Annual Fees</strong> <br /><br /><?php echo $showCCOfferRes[$i]['cc_bank_fee_content']; ?></td>
      <td width="17%" rowspan="2" align="left" class="tablebody-text2" style="border-right:#49d9fb solid thin;"><?php echo $showCCOfferRes[$i]['cc_bank_features']; ?></td>
      <!--<td width="17%" rowspan="2" align="left" class="tablebody-text" style="border-right:#49d9fb solid thin;"><?php //echo $showCCOfferRes[$i]['cc_bank_new_features']; ?></td>-->
      <!--<td width="17%" rowspan="2" align="left" class="tablebody-text"><?php //echo $showCCOfferRes[$i]['cc_other_charges']; ?></td>-->
    </tr>
    <tr>
      <th height="178" align="center" scope="row">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="49%" scope="row"><img src="<?php echo $showCCOfferRes[$i]['card_image']; ?>" width="104" height="70" /></th>
          <td width="51%"><?php echo $showCCOfferRes[$i]['cc_bank_name']; ?></td>
        </tr>
      </table>
      </th>
    </tr>
  </table>
</div>

<?php  $i=$i+1;} ?>

</div>
<a id="showCredit">&nbsp;</a>
<br>
<br>
<br>
<div class="cc-hanger-middle-text">

    <div id="credit-card-info" class="credit-card-info-new1">
    <br />
    	<h3>Credit Card Basics</h3><br />
        <p>The Credit card is the most divisive financial tool available.  If you talk about the history of Credit cards, they started out as Simple and Standard. Each Card issuer had one card with same set of features. Today credit cards come in multiple ranges with varying features, interest rates, annual fees etc. It is really important an individual knows which Card will suit his/her lifestyle and financial situation.</p><br>
  
        <p>A brief description of various kinds of credit cards is as follows:</p><br>
    <p><strong>Standard Credit Cards:</strong> These are the most common kind of credit cards. They do not require a security deposit to prove that the loan can be repaid. The way the Annual Percentage Rate (APR) is offered or calculated on a standard credit card may vary. For instance:</p>
    
        <ol type="1">
            <li><strong>Balance transfer Credit cards:</strong> Balance transfer credit cards allow consumers to transfer a high interest credit card balance onto a credit card with a low interest rate.</li><br>
            <li><strong>Low interest Credit cards:</strong> Low interest credit cards offer either a low introductory APR that jumps to a higher rate after a certain period, or a single low fixed-rate APR.</li>
            
        </ol>
        
        <p><strong>Reward Cards:</strong>  A rewards card can be beneficial for the right kind of user. You can earn free airline tickets, hotel stays, cash back, gift cards and even novelty vacations, etc.</p><br>
        
        <p>Before choosing any reward card, however, one needs to consider his Credit card spending tendencies. Ask yourself are you someone who regularly pays the full monthly balance, or do you carry a balance from month-to-month? The interest rate with a rewards card is quite higher when compared to typical Credit cards.  If you occasionally carry a balance, it is advised to not go for a rewards card. High interest rates coupled with late fee penalties will mean you will end up losing heavy money while chasing petty rewards.</p><br>
        
      <br>

<p style="text-align:center"><strong>Different types of reward cards</strong></p><br>

<p><strong>Cash Back:</strong> This type of credit card allows you to earn cash rewards for making purchases. The more the card is used, the more cash rewards you receive. Most cash back cards earn users around 1% of total purchases. I.e. you typically earn cash back worth Rs 100 on purchases of Rs 10,000. Some cards offer a higher cash back percentage with increased usage; others offer a higher cash back percentage at select merchants or for particular types of purchases.<br>
<em>Examples:</em> Citibank Cash Back Credit Card, Shopping Rewards Card.</p><br>

      <p><strong>General Reward Point Credit Cards:</strong> In Reward points Cards, cardholders can accumulate points towards a reward structure, which is based on usage of card over the period. E.g. Cardholder is awarded 1 reward point for each rupee he/she spends. There are certain Bonus spend rewards as well for certain annual spending such as:</p><br>  
      <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table_bgcolor_Border">
  <tr class="table_bgcolor">
    <td height="30"><strong>&nbsp;&nbsp;Annual Spends</strong></td>
    <td><strong>&nbsp;&nbsp;Bonus Reward Point</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="30">&nbsp;&nbsp;Rs. 2 Lakh</td>
    <td>&nbsp;&nbsp;10,000</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="30">&nbsp;&nbsp;Rs. 3 Lakh</td>
    <td>&nbsp;&nbsp;10,000</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="30">&nbsp;&nbsp;Rs. 4 Lakh</td>
    <td>&nbsp;&nbsp;10,000</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="30">&nbsp;&nbsp;Rs. 5 Lakh</td>
    <td>&nbsp;&nbsp;20,000</td>
  </tr>
</table>
<br>
<p><strong>SBI signature contactless card bonus reward points</strong></p><br>

<p><strong>Hotel/Travel Point Credit cards:</strong> This is a genre of credit cards specific to hotels and travel. Some cards are co-branded with hotels. These credit cards allow you to earn points for all purchases, in addition to bonus points for dollars spent on stays at the respective hotel chain. You can redeem your points for free nights and upgrade at the hotel chain your card is co-branded with. Then there are broader hotel and travel cards with which points can be redeemed for travel, theme park admission, stays at major hotel chains and more.</p><br>
<strong>Examples of such Cards are Yatra SBI Card</strong><br>
<p><strong>Gas Cards:</strong> Gas Cards with points or rebate have a high reward structure for Fuel purchases/Car maintenance. If you drive a lot, consider a gas card for more points on gasoline purchases. Gas cards come in two types: general and brand-specific. A general gas rebate card, for example, may give you 1% cash back for general purchases but rewards you with 5% back for buying gas or having auto maintenance done at any company such as Indian Oil Citibank Platinum Credit Card saves over 5% on your fuel bills.</p><br>
<p><strong>Airline Miles/ Frequent flier credit cards:</strong> There is a subset of reward cards specifically for air travel. This type of card allows consumers to earn airline mile credits whenever they make purchases. Some cards are co-branded with a specific airline, while some are generic and can be redeemed for tickets with a variety of airlines. Points can be redeemed for airline travel, much like frequent flier miles.<br>
Airline Specific Credit Cards: JetPrivilege HDFC Bank World Credit Card<br>
Generic Airline Miles Cards: Complimentary Citibank PremierMiles Credit Card
</p><br>

 <p><strong>Secured Credit Cards:</strong> Secured credit cards require a security deposit for approval. These cards are useful in reestablishing the credit score. The cards have an annual fee and higher annual interest rates. Most often, these cards are used to reestablish credit. A person can use the card to make small purchases that they can easily repay.</p><br>
 <p><strong>Specialty Credit Cards:</strong> These types of cards are for consumers with unique needs for their credit usage, such as business professionals and students. These credit card programs are designed specifically to meet the needs of those individuals.</p>
 <ol>
   <li><strong>Business Credit Card:</strong> These cards are available for business owners and executives and have many of the same features as traditional credit cards. Some of these bonuses include: Business expenses kept separate from personal expenses; special business rewards and savings; expense management reports; additional cards for employees; and higher credit limits. Example: SBI Platinum Corporate Card</li>
  <br>
   <li><strong>Student Credit Cards:</strong> Student credit cards are specifically designed for those enrolled in accredited four-year colleges and universities to help them build a credit history from the ground up. Compared to consumer credit cards, student credit cards are often scaled back somewhat in terms of reward features and other benefits. <em>Example:</em> SBI ADVANTAGE Plus card.</li>
 </ol>
    </div>
    
    
</div>

<div style="clear:both; height:10px;"></div>
<?php include("footer_sub_menu.php"); ?>
	<script type="text/javascript" src="lib/jquery.popdown.js?v=1" /></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.popdown').popdown();
		});
	</script>
</body>
</html>