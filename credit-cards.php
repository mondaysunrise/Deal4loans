<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

# Rating Reviews
$session_id = session_id();
$page_name = $_SERVER['PHP_SELF'];

$showRatingSql = "select avg(rating) as avgR, count(page_name) as total_review from product_rating where page_name='".$page_name."' and status=1";
list($defrowCount,$showRatingQry)=MainselectfuncNew($showRatingSql, $array = array());

$avg_rating = round($showRatingQry[0]['avgR']);

//$total_records = mysql_result($showRatingQry,1);
$showtotalReviewSql = "select id from product_rating where page_name='".$page_name."' and status=1";
list($total_records,$showtotalReviewQry)=MainselectfuncNew($showtotalReviewSql, $array = array());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 
<title>Credit Card | Credit Cards in India 2015</title>
<meta name="keywords" content="Credit cards India, apply for credit cards, Online Comparison credit cards, Credit card reward points, credit card benefits, Credit Card, Credit Cards"/>
<meta name="description" content="Credit Card: Apply Online Now for &#10004;  Best Card &#10004; Eligibility Criteria &#10004;  Instant e-Approval &#10004; Quick Apply. Check and Compare Credit cards of different banks Online."/>

<link href="css/cc_121.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list-clhdfc.js"></script>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
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
	
	form{
		display:inline;
	}
	/*.............tool tip by prabhat......*/
a.tooltip {outline:none; }
a.tooltip:hover {text-decoration:none;} 
a.tooltip span { text-align:left;
    z-index:10;display:none; padding:5px;
    margin-top:-50px; 
    width:150px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
a.tooltip:hover span{
    display:inline; position:absolute; color:#111;
    border:1px solid #DCA; background:#fffAF0;}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
    
/*CSS3 extras*/
a.tooltip span
{    border-radius:4px;
   }		
  
 a.tooltiploan {outline:none; }
a.tooltiploan:hover {text-decoration:none;} 
a.tooltiploan span { text-align:left;
    z-index:10;display:none; padding:5px;
    margin-top:-40px; 
    width:150px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
a.tooltiploan:hover span{
    display:inline; position:absolute; color:#111;
    border:1px solid #DCA; background:#fffAF0;}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
    
/*CSS3 extras*/
a.tooltiploan span
{    border-radius:4px;
   }
   
/*...................end tool tip.......*/
</style>
<Script Language="JavaScript">
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
 		
	if(document.creditcard_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}
	if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
	
	var saselect = document.getElementById('salary_account');
			 for(var Sa=0; Sa<saselect.options.length; Sa++) 
			{
				if(saselect.options[Sa].selected)
				{
					cntSa= Sa;
				}
			}
			if(cntSa == -1) 
			{
				alert("Salary or Cuurent account Bank!");	
				return false;
			}

	/*if (document.creditcard_form.salary_account.selectedIndex==0)
	{		
	  	document.getElementById('salAccountVal').innerHTML = "<span  class='hintanchor'>Select Salary Account!</span>";
   		document.creditcard_form.salary_account.focus();		return false;	
	}*/
   
	if((document.creditcard_form.Full_Name.value=="") || (Trim(document.creditcard_form.Full_Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
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
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.creditcard_form.Phone.focus();
		return false;
	}
	if(isNaN(document.creditcard_form.Phone.value)|| document.creditcard_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
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
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	
	var str=document.creditcard_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
		
	if(document.creditcard_form.day.value=="" || document.creditcard_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.creditcard_form.day.focus();
		return false;
	}
	if(document.creditcard_form.day.value!="")
	{
		if((document.creditcard_form.day.value<1) || (document.creditcard_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.creditcard_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.day, 'Day', 2))
		return false;
	
	if(document.creditcard_form.month.value=="" || document.creditcard_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.creditcard_form.month.focus();
		return false;
	}
	if(document.creditcard_form.month.value!="")
	{
		if((document.creditcard_form.month.value<1) || (document.creditcard_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.creditcard_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.month, 'month', 2))
		return false;

	if(document.creditcard_form.year.value=="" || document.creditcard_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.creditcard_form.year.focus();
		return false;
	}
	if(document.creditcard_form.year.value!="")
	{
		if((document.creditcard_form.year.value < "<?php echo $maxage;?>") || (document.creditcard_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.creditcard_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.year, 'Year', 4))
		return false;
	
	
if(document.creditcard_form.City.value=="Others")
	{
	if((document.creditcard_form.City.value=="Others") && ((document.creditcard_form.City_Other.value=="" || document.creditcard_form.City_Other.value=="Other City"  ) || !isNaN(document.creditcard_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.creditcard_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.creditcard_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.creditcard_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.creditcard_form.City_Other.focus();
  		return false;
  	}
  }
	}
	/*add validation for loan existing*/
	if(document.creditcard_form.Employment_Status.value==0)
	{
		 for(l=0; l<document.creditcard_form.Loan_Any_sel.length; l++) 
		{
			if(document.creditcard_form.Loan_Any_sel[l].checked)
			{
				cntl= l;
			}
		}
		if(cntl == -1) 
		{
			alert("Select Any Existing Loan or not!");	
			return false;
		}
		if(cntl ==0)
		{ 
			 for(r=0; r<document.creditcard_form.Loan_Any.length; r++) 
			{
				if(document.creditcard_form.Loan_Any[r].checked)
				{
					cntr= r;
				}
			}
			if(cntr == -1) 
			{
				alert("Type of Existing loan!");	
				return false;
			}
			var laselect = document.getElementById('loanbank_name');
			 for(var lb=0; lb<laselect.options.length; lb++) 
			{
				if(laselect.options[lb].selected)
				{
					cntlb= lb;
				}
			}
			if(cntlb == -1) 
			{
				alert("Bank of Existing Loan!");	
				return false;
			}

		}
	}
	else
	{
		if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(document.creditcard_form.Company_Name.value))==false)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.creditcard_form.Company_Name.focus();
			return false;
		}
		else if(document.creditcard_form.Company_Name.value.length < 3)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.creditcard_form.Company_Name.focus();
			return false;
		}
		if (document.creditcard_form.Pincode.value=="")
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
			document.creditcard_form.Pincode.focus();
			return false;
		}
		if (document.creditcard_form.Pincode.value!="")
		{
			if(document.creditcard_form.Pincode.value.length < 6)
			{
				document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
				document.creditcard_form.Pincode.focus();
				return false;
			}
		}
	}
 for(j=0; j<document.creditcard_form.CC_Holder.length; j++) 
	{
        if(document.creditcard_form.CC_Holder[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Card holder or not!");	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.creditcard_form.No_of_Banks.selectedIndex==0)
		{
			document.getElementById('ccbnknmeVal').innerHTML = "<span  class='hintanchor'>Select card from which Bank!</span>";	
			document.creditcard_form.No_of_Banks.focus();
			return false;
		}
		if(document.creditcard_form.City.selectedIndex >0)
		{
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
			{
		if(document.creditcard_form.Card_Vintage.selectedIndex==0)
		{
			document.getElementById('ccvintageVal').innerHTML = "<span  class='hintanchor'>Please select since how long you holding credit card.</span>";	
			document.creditcard_form.Card_Vintage.focus();
			return false;
		}
		if(document.creditcard_form.Credit_Limit.selectedIndex==0)
		{
			document.getElementById('cclimitVal').innerHTML = "<span  class='hintanchor'>Please select Card Credit Limit.</span>";	
			document.creditcard_form.Credit_Limit.focus();
			return false;
		}
			}
		}
		
	}
		
	if(!document.creditcard_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.creditcard_form.accept.focus();
		return false;
	}
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

function addElement()
{
	var ni = document.getElementById('myDiv');
	var niicici = document.getElementById('icici_rqdfield');
	var cit = document.creditcard_form.City.value;
	var sal = document.creditcard_form.Net_Salary.value;
	
	ni.innerHTML = '<div class="pl_input_box"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr>      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bank Name :</span></td>    </tr>    <tr>      <td height="25"><select size="1" name="No_of_Banks" id="No_of_Banks" class="pl_select_b"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="RBL Bank">RBL Bank</option><option value="Other">Other</option></select><div id="ccbnknmeVal"></div>  </td>    </tr></table></div>';
	
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
	{
		niicici.innerHTML='<div class="pl_input_box"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Card Vintage :</span></td></tr><tr><td height="25"><select size="1" name="Card_Vintage" class="pl_select_b" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="ccvintageVal"></div></td>    </tr></table></div><div class="pl_input_box"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Credit Limit :</span></td></tr><tr><td height="25">  <select size="1" name="Credit_Limit" id="Credit_Limit" class="pl_select_b" onchange="validateDiv(\'cclimitVal\');" ><option value="0">Please select</option><option value="1">Upto 75,000</option><option value="2">75,000 to 1,50,000 </option><option value="3">1,50,000 & Above</option></select><div id="cclimitVal"></div></td></tr></table></div>';
	}	
	return true;
}

function removeElement()
{
		var ni = document.getElementById('myDiv');
		var niicici = document.getElementById('icici_rqdfield');
		
		if(ni.innerHTML!="")
		{
			if(document.creditcard_form.CC_Holder.value="0")
			{
				ni.innerHTML = '';
				niicici.innerHTML = '';
			}
		}		
		return true;
	}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.creditcard_form.City.value;
	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
	ni1.innerHTML = '';
	
	}
	return true;
}
function addloanElement()
{
	var niloan= document.getElementById('addloandt');

niloan.innerHTML='<div class="pl_input_box" style="width:210px !important;"><table border="0" width="98%"><tr><td height="25" colspan="2"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Type of Existing loan ? :</span></td></tr><tr><tr><td class="text" style="color:#FFF; font-size:11px;" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" value="hl" >Home</td>				<td class="text" style="color:#FFF; font-size:11px;" ><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" >Personal</td></tr>		<tr>				<td class="text" style="color:#FFF; font-size:11px;" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" >Car</td>				<td class="text" style="color:#FFF; font-size:11px;"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" >Property</td></tr>			<tr>				<td class="text" style="color:#FFF; font-size:12px;" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other" >Other</td><td class="text" style="color:#FFF; font-size:11px;"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="cdl">Consumer Durable</td>			</tr> 		</table><div id="Loan_Any"></div></div><div class="pl_input_box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bank of Existing Loan? :</span>&nbsp;<a href="#" class="tooltiploan"> <img src="images/questionmark-tooltip.png" width="16" height="16" border="0" /><span>Select multiple Banks if more than one Existing Loan. </span></a></td></tr><tr><td height="25"><select name="loanbank_name[]" id="loanbank_name" style="width:210px; height:40px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange=" validateDiv(\'loanbnkVal\');"  multiple><option name="">Please Select</option>				  <option value="HDFC Bank">HDFC Bank</option>				  <option value="ICICI Bank">ICICI Bank</option>				  <option value="IndusInd Bank">IndusInd Bank</option>				  <option value="Kotak Bank">Kotak Bank</option>			  <option value="RBL Bank">RBL Bank</option>	  <option value="Standard Chartered">Standard Chartered</option>				  <option value="Others">Others</option></select><div id="loanbnkVal" style="font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#fd4c1d;"></div></td></tr></table></div><div style="clear:both;  height:10px;"></div>';

}

function removeloanElement()
{
	var niloan= document.getElementById('addloandt');

	niloan.innerHTML='';
}


function addothercity()
{	
	var ni = document.getElementById('Othercity');
	var cit = document.creditcard_form.City.value;
	if(cit=="Others")
	{
		ni.innerHTML ='<div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City :</span></td></tr><tr><td height="25"> <input name="City_Other" id="City_Other" type="text" class="pl_input_b" onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');"  /><div id="othercityVal"></div></td></tr></table></div>';
	}
	else
	{
		ni.innerHTML ='';
	}
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	var cit = document.creditcard_form.City.value;
	ni5.innerHTML ='<img src="images/animated_cc.gif" width="575" height="21" />';
	if(document.creditcard_form.Employment_Status.value==0)
	{
		ni1.innerHTML ='<div style="padding-left:20px; padding-top:7px;"><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:19px; color:#FFFFFF; padding-top:5px;"> Personal Details</td><td style="font-size:13px; font-weight:normal; color:#96b34b;"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div> <div style="clear:both;"></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name :</span></td></tr><tr><td height="25"> <input name="Full_Name" id="Full_Name" type="text" class="pl_input_b" onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>     </td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile :</span></td></tr><tr><td height="25"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="pl_input_b" onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email :</span></td></tr><tr><td height="25">  <input name="Email" id="Email" type="text" class="pl_input_b" onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;"> DOB:</span></td></tr><tr><td height="25">  <div class="text" style=" float:left; clear:right; padding-right:6px;"><input name="day" id="day" type="text" style="width:32px; height:18px;" value="dd" onblur="onBlurDefault(this,\'dd\');" onfocus="onFocusBlank(this,\'dd\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" /></div><div class="text" style=" float:left; clear:right; padding-right:6px;"><input name="month" id="month" type="text" style="width:32px; height:18px;" value="mm" onblur="onBlurDefault(this,\'mm\');" onfocus="onFocusBlank(this,\'mm\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" /></div><div class="text" style=" float:left; clear:right;"><input name="year" id="year" type="text" style="width:35px; height:18px;" value="yyyy" onblur="onBlurDefault(this,\'yyyy\');" onfocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" /></div><div id="dobVal"></div>  </td></tr></table></div><div style="clear:both;height:7px;"></div><div class="pl_input_box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Any Existing loan ? :</span></td></tr><tr><td height="25">   <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; " ><input type="radio" value="1" name="Loan_Any_sel" id="Loan_Any_sel" style="border:none;" onClick="addloanElement();"></div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> Yes</div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; "><input type="radio" value="2" name="Loan_Any_sel" id="Loan_Any_sel" style="border:none;" onClick="removeloanElement();"></div><div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> No</div><div id="LoanAnyselVal"></div>   </td></tr></table></div><div id="addloandt"></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Credit Card Holder? :</span></td></tr><tr><td height="25">   <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; " ><input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();"></div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> Yes</div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; "><input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"></div><div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> No</div><div id="ccholderVal"></div>   </td></tr></table></div><div style="clear:both;"></div><div id="myDiv"></div><div id="icici_rqdfield"></div><div style="clear:both; height:5px;"></div>';
	}
	else
	{
		ni1.innerHTML = '<div style="padding-left:20px; padding-top:7px;" ><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:19px; color:#FFFFFF; padding-top:5px;"> Personal Details</td><td style="font-size:13px; font-weight:normal; color:#96b34b;"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div> <div style="clear:both;"></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name :</span></td></tr><tr><td height="25"> <input name="Full_Name" id="Full_Name" type="text" class="pl_input_b" onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>     </td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile :</span></td></tr><tr><td height="25"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="pl_input_b" onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email :</span></td></tr><tr><td height="25">  <input name="Email" id="Email" type="text" class="pl_input_b" onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;"> DOB:</span></td></tr><tr><td height="25">  <div class="text" style=" float:left; clear:right; padding-right:6px;"><input name="day" id="day" type="text" style="width:32px; height:18px;" value="dd" onblur="onBlurDefault(this,\'dd\');" onfocus="onFocusBlank(this,\'dd\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" /></div><div class="text" style=" float:left; clear:right; padding-right:6px;"><input name="month" id="month" type="text" style="width:32px; height:18px;" value="mm" onblur="onBlurDefault(this,\'mm\');" onfocus="onFocusBlank(this,\'mm\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" /></div><div class="text" style=" float:left; clear:right;"><input name="year" id="year" type="text" style="width:42px; height:18px;" value="yyyy" onblur="onBlurDefault(this,\'yyyy\');" onfocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" /></div><div id="dobVal"></div>  </td></tr></table></div><div style="clear:both;"></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name :</span></td></tr><tr><td height="25"> <input name="Company_Name" id="Company_Name" type="text" class="pl_input_b" onkeydown="validateDiv(\'companyNameVal\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  value="Type Slowly for Autofill" onblur="onBlurDefault(this,\'Type Slowly for Autofill\');" onfocus="onFocusBlank(this,\'Type Slowly for Autofill\');"/><div id="companyNameVal"></div></td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode :</span></td></tr><tr><td height="25"><input name="Pincode" id="Pincode" type="text" class="pl_input_b" onkeydown="validateDiv(\'pincodeVal\');"  maxlength="6"/><div id="pincodeVal"></div></td></tr></table></div><div class="pl_input_box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Credit Card Holder? :</span></td></tr><tr><td height="25">   <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; " ><input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();"></div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> Yes</div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; "><input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"></div><div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> No</div><div id="ccholderVal"></div>   </td></tr></table></div><div style="clear:both;"></div><div id="myDiv"></div><div id="icici_rqdfield"></div><div style="clear:both;"></div>';	
	
	}
	ni3.innerHTML = '<div style="clear:both;"></div><div class="pl_terms_box"><span class="text" style="color:#FFF; font-size:11px; text-transform:none;">  <input name="accept" type="checkbox" checked="checked" /> I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div>                  <div class="pl_bnt_b"> <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>                  <div style="clear:both;"></div>                   <div id="hdfclife"></div>                    <div style="clear:both;"></div>';
	
	
}
</script>
  
<link href="source.css" rel="stylesheet" type="text/css" /> 
<style type="text/css">
<!--
.style1 {color: #4c4c4c}
-->
</style>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css">

<!-- Code for Aggregate star rating -->
<link rel="stylesheet" href="jquery/jRating.jquery.css" type="text/css" />
<style type="text/css">
body {margin:15px;font-family:Arial;font-size:13px;}
a img{border:0;}
.datasSent, .serverResponse{margin-top:0px; color:#000000;height:20px;padding:5px;float:left;margin-right:5px}
.datasSent{float:left; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000;}
.serverResponse{position:fixed;left:680px;top:100px}
.datasSent p, .serverResponse p {font-style:italic;font-size:12px; padding:0px 0px 0px 0px; margin:0px 0px 0px 0px; }
.exemple{float:left; margin-top:5px; width:150px; padding-left:5px; font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000;}
.clr{clear:both}
pre {margin:0;padding:0}
.notice {background-color:#F4F4F4;color:#666;border:1px solid #CECECE;padding:10px;font-weight:bold;width:600px;font-size:12px;margin-top:10px}

.review_wrapper{ width:662px; padding:5px 0px 5px 0px; background:#fff5d9;}
.review_text{ float:left; width:125px; padding-left:8px; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; margin-top:5px;}
.review_text-right{ float:right; margin-right:8px; padding:5px;  font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000;}
.review_star{ float:left; margin-top:5px; width:125px; padding-left:0px; font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000;}

</style>
<!--//-->

</head>
<body>
<div class="hide_top_menu">
<?php include "top-menu.php"; ?></div>
<!--top-->
<?php include "main-menu2.php"; ?>
<script type="text/javascript" src="script1.js"></script>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">Credit Card</span> </div>
<div style="margin:auto; width:100%; max-width:970px; margin-top:1px;">
<div style="width:100%; max-width:663px; height:33; margin-top:0px; float:left; clear:right;">

<div style="width:100%; max-width:663px; height:33; margin-top:15px; float:left; clear:right;">
<h1 class="text3" style="width:width:100%; max-300px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;"><strong>Credit Card</strong></h1>
<div class="text3" style="width:220px; height:33; margin-top:15px; float:right; clear:right;"><table cellpadding="0" cellspacing="1"><tr><td><img src="images/andro36x36.gif" name="Image3" width="33" height="33" border="0" /></td><td><a href="https://play.google.com/store/apps/details?id=d4l.ccndccardoffers.com" target="_blank"><img src="images/ccndc.gif" name="Image3" width="180" height="20" border="0" /></a></td></tr></table></div>
</div>
<div style=" float:left; width:100%; max-width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" style=" width:100%; max-width:663px;" height="1" /></div>

<!-- Code for Aggregate Star Rating Starts -->
<!--
<div class="pl_titile_wraper" style="width:100%;">
	<div itemscope itemtype="http://schema.org/Product">
    <h1 class="h1-new" itemprop="name" style="float:left; margin-top:25px;">Credit Card</h1>
    
    <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" style="float:right;">
    Rated <span itemprop="ratingValue"><?php echo $avg_rating; ?></span>/5 based on <span itemprop="reviewCount"><?php echo $total_records; ?></span> reviews
    </div>   
    
    <div class="text3" style="width:220px; height:33; margin-top:15px; float:right; clear:right;"><table cellpadding="0" cellspacing="1"><tr><td><img src="images/andro36x36.gif" name="Image3" width="33" height="33" border="0" /></td><td><a href="https://play.google.com/store/apps/details?id=d4l.ccndccardoffers.com" target="_blank"><img src="images/ccndc.gif" name="Image3" width="180" height="20" border="0" /></a></td></tr></table></div>
    <div style="clear:both;"></div>
    <div style="width:100%; border-bottom:thin solid #88a943; padding:0px 0px 0px 0px;"></div>
</div>
<div style="clear:both;"></div>

<div class="review_wrapper">
    <div class="review_text">Rate this product:</div>
    <div class="review_star">
        <div class="exemple5" data-average="<?php echo $avg_rating; ?>" data-id="<?php echo $page_name; ?>"></div>
    </div>
    <div class="datasSent">
        <p></p>
    </div>
    <div class="review_text-right"><a href="http://www.deal4loans.com/Contents_Feedback.php" rel="nofollow" target="_blank">Write review</a></div>
    <div style="clear:both;"></div>  
</div>
<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="jquery/jRating.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('.exemple5').jRating({
		length:5,
		decimalLength:1,
		onSuccess : function(){
			//alert('Success : your rate has been saved :)');
		},
		onError : function(){
			//alert('Error : please retry');
		}
	});
});
</script>
</div>
<div style="clear:both; height:15px;"></div>
-->
<!-- Aggregate Star Rating Ends -->

<div style=" float:left; width:100%; max-width:663px; height:auto; margin-top:1px; text-align:justify; padding-bottom:2px; ">
  <span class="text11" style="color:#4c4c4c;">"Banks introduced the installment plan. The disappearance of cash and the coming of the credit card changed the shape of life in the United States."Jerzy Kosinski , an American Novelist and two times chairman of American Chapter of P.E.N.</span>
<h3 class="text" style="color:#4c4c4c; size:18px;"><b>What is a Credit Card?</b></h3>
  <span class="text11" style="color:#4c4c4c;">A credit card is a small thin plastic card with a magnetic stripe mostly of size 85.60 × 53.98 mm (33/8 × 21/8 in) conforming to the ISO/IEC 7810 ID-1 standard that allows the card holder to pay for their goods or services. When we are paying our expenses through a credit card we are actually borrowing money along the line of credit from the credit card company with a promise to pay it within certain time limit. When the time limit gets exceeded we need to pay a fixed pre-decided interest rate (usually the base rate of the issuing financial institution) on the outstanding amount.<br /></span>
</div>

<div class="pl_form_box"><form name="creditcard_form"  action="get_cc_eligiblebank.php" method="POST" onSubmit="return ckhcreditcard(document.creditcard_form); ">
	<input type="hidden" name="source" value="CC main page">
<input type="hidden" name="PostURL" value="/get_cc_eligiblebank.php">
<div class="pl_form_title"><h2 class="text3" style=" color:#FFF; font-size:15px; text-transform:none; "><strong>Compare Credit Card Eligibility - Process of All Banks.</strong></h2></div>
<div class="pl_blink_text" id="getImageScroll"><img src="images/animated_cc_before.gif" width="575" height="21" /></div>
<div style="clear:both;"></div>
<div style="padding-left:20px; font-size:19px; color:#fff;">Professional Details</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income: </span></td>
    </tr>
    <tr>
      <td height="25"><input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');" autocomplete="off"  />
              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span> </td>
    </tr>
   
  </table>
</div>

<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation :</span></td>
    </tr>
    <tr>
      <td height="25"><select name="Employment_Status" id="Employment_Status" class="pl_select_b" onchange="addPersonalDetails(); validateDiv('empStatusVal');"  style="height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select><div id="empStatusVal" class="alert_msg"></div>  </td>
    </tr>    
  </table>
</div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
    </tr>
    <tr>
      <td height="25"> <select name="City" id="City" class="pl_select_b" style="height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange=" addothercity(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
                        </select>
                         <div id="cityVal"></div></td>
    </tr>
</table>
</div>
<div class="pl_input_box_credit_10">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <td height="25"><table width="100%" cellpadding="0" cellspacing="0"><tr><td><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Salary/Current Account:</span><td><a href="#" class="tooltip"> <img src="images/questionmark-tooltip.png" width="16" height="16" border="0" /><span>
   Select multiple Banks if more than one Bank Account.
    </span></a></td></tr></table></td>
    </tr>
    <tr>
      <td height="25"> <select name="salary_account" id="salary_account" style="height:39px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  class="pl_select_b" onchange="addPersonalDetails(); validateDiv('salAccountVal');"  multiple >
				  <option name="">Please Select</option>
				  <option value="HDFC Bank">HDFC Bank</option>
				  <option value="ICICI Bank">ICICI Bank</option>
				  <option value="Kotak Bank">Kotak Bank</option>
				  <option value="Standard Chartered">Standard Chartered</option>
				  <option value="Others">Others</option>
				  </select>
          <div id="salAccountVal"></div> </td>
    </tr>
  </table>
</div>
<div style="clear:both; height:5px;"></div>
<div id="Othercity">
</div>

<div style="clear:both; height:5px;"></div>
<div id="personalDetails"> <table cellpadding="0" width="98%"> <tr><td style="padding-left:25px;">&nbsp;</td><td width="25%"   align="right" valign="top"><img src="images/get1.gif" border="0" /></td></tr></table></div>
<div id="addSubmit"></div>
 </form></div>
<div class="text11" style=" float:left; width:100%; max-width:663px; height:auto; margin-top:5px; text-align:justify; color:#4c4c4c;">* Quotes are totally free for customers<br />
</div>


<div style=" float:left; width:100%; max-width:663px; height:auto; margin-top:5px; text-align:justify;">
<span class="text" style="color:#4c4c4c; size:18px;"><h3 style="font-weight:normal;">Types of credit card</h3></span>
<p class="text11 style1">The financial institutions in India  offer a wide range of credit cards providing different types of financial benefits.  Some of the popular credit cards in India  are as follows:</p>
<ul>
  <li class="text11 style1"><strong>Premium credit cards</strong> – Provides better service,  better rewards and also higher limits.</li>
  <li class="text11 style1"><strong>Cash back credit cards</strong> - Targeting the working  section of the society these cards gives discount to its card holders which may  vary from 0.25% to 1%.</li>
  <li class="text11 style1"><strong>Secured credit cards</strong> - Beneficial for people  without a credit history like students or poor credit history; this credit card  is generally secured by the savings account of the card holder. </li>
  <li class="text11 style1"><strong>Prepaid credit cards</strong> - As the name suggests the  cardholder needs to load the entire amount   to be loaded into the card before he or she can use it .It  is similar to a  debit card.</li>
  <li class="text11 style1"><strong>Business credit cards</strong> - These cards can be used by  business owners and executives as these enable them to keep transactions  separately for business use.</li>
</ul>

<p class="text11 style1">According to the services offered  by the issuing financial institution credit cards can be categorized into the  following categories:</p>
<ul>
  <li class="text11 style1">Platinum cards</li>
  <li class="text11 style1">Gold cards</li>
  <li class="text11 style1">Classic cards</li>
</ul>

<span class="text" style="color:#4c4c4c; size:18px;"><h3 style="font-weight:normal;">Minimum Criteria for having a credit card in India</h3></span>
 <span class="text11" style="color:#4c4c4c; ">
The minimum eligibility criteria for having a credit card  differs for   different financial  institutions and also depends on the scheme or services they opt. Some basic  criteria are as follows:<br />
<ul>
  <li>Minimum income of Rs 1,50,000 to Rs 1,80,000 ( a  person can be self employed  or salaried)</li>
  <li>Minimum age requirement is 18 years and the  upper age limit is of 65-70 years which may depend on the financial  institutions issuing the card.</li>
<li>A good credit history.</li>
</ul>
</span></div>

<div style=" float:left; width:100%; max-width:663px; height:auto; margin-top:2px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;"><h3 style="font-weight:normal;">How to get a credit card?</h3></span>
<span class="text11" style="color:#4c4c4c; ">
  <ul>
     <li>First, we need to find out the credit card  issuing financial institutions.</li>
    <li>Then, we need to conduct a thorough research about  the interest rates and reward schemes and then find the best plans that suit  our needs.</li>
    <li>We need to fill in the application form with the  correct information and submit the necessary documents (which may include  income proof, copy of bank statement, photographs etc) that we are being asked to  submit.</li>
    <li>The credit card company after assessing the  documents and information would decide about the credit card limit and would  issue the credit card.</li>
  </ul></span>
  </div>

<div style=" float:left; width:100%; max-width:663px; height:auto; margin-top:5px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;"><h3 style="font-weight:normal;">Some credit card issuing companies in India</h3></span>
<span class="text11" style="color:#4c4c4c; ">
  <ul>
    <li>ICICI Bank  - <a href="http://www.deal4loans.com/loans/credit-card/icici-bank-credit-cards-eligibility-documents-apply/">click  to know more about ICICI Credit Card</a></li>
  </ul>
  <p>Suiting our needs  ICICI bank has a large range of credit cards. Some of them are:</p>
  </span><ul>
    <li><span class="text11" style="color:#4c4c4c; ">ICICI Bank Sapphiro  credit card</span></li>
    <li><span class="text11" style="color:#4c4c4c; ">ICICI Bank  Rubyx credit card</span></li>
    <li><span class="text11" style="color:#4c4c4c; ">ICICI Bank Coral  credit card</span></li>
    <li><span class="text11" style="color:#4c4c4c; ">ICICI Bank Instant  Platinum credit card etc</span></li>
    </ul>
   <span class="text11" style="color:#4c4c4c; "><p> 
     <strong>State Bank Of India – <a href="http://www.deal4loans.com/loans/banks/sbi-credit-cards/">Click to Know  more about SBI Card</a></strong></p>
<p style="padding-left:20px;">   
    <strong>Premium cards    </strong>
    <ul>
 <li>SBI  signature card</li>
 <li>   SBI platinum card</li>
<li>    SBI advantage signature card</li>
    <li>SBI advantage platinum card</li>
</ul>
     <strong>Travel and shopping cards  </strong> 
<ul><li>
SpiceJet  SBI Titanium Card</li>
<li>SBI  Gold &amp; More Card</li>
<li> Yatra  SBI Card</li>
 <li>Railway  SBI Platinum Card</li>
<li> SBI  Railway Card</li>
<li>SBI Advantage Gold &amp; More  Card</li></ul>
         <strong>SBI gold credit card    </strong>
    <ul>
  <li>  SBI Advantage Gold Card</li>
 <li>SBI Advantage Plus Card</li>
 </ul>
      <strong>Exclusive cards </strong>
 <ul>
<li>Bank of Maharashtra SBI  Platinum Credit Card</li>
<li>Tata Cards</li>
<li>Bank of Maharashtra SBI Card</li>
<li>Oriental Bank of Commerce SBI  Platinum Card</li>
<li>Oriental Bank of Commerce SBI  Card</li>
<li>Karur Vysya Bank SBI Platinum  Card</li>
<li>Karur Vysya Bank SBI Card</li>
<li>SBI Maruti Card</li>
<li>SBI Dena Bank Secured Card</li>
<li>SBI UBI Card</li>
</ul>
     <strong>SBI Corporate cards</strong>
<ul><li>
SBI Corporate Utility Card</li>
<li>    SBI  Platinum Corporate card</li>
</ul>
</p>
<strong>American Express – <a href="http://www.deal4loans.com/loans/credit-card/american-express-platinum-travel-credit-card-features-eligibility-apply/">Click  to know more about Amex Credit Card</a></strong>
<ul>
    <li>American  Express Platinum Reserve Credit Card</li>
    <li>The NEW Jet  Airways American Express®Platinum Credit Card</li>
    <li>The NEW  American Express Platinum Travel Credit Card</li>
    <li>Air India American Express Credit Card</li>
    <li>The RPM Credit Card from American Express and HPCL etc</li>
  </ul>
  <strong>Citibank – <a href="http://www.deal4loans.com/loans/credit-card/citibank-credit-card-compare-eligibility-features-apply-online/">Click  to know more about Citibank credit card</a></strong>
<ul>    <li>Citibank Rewards Card</li>
    <li>Citibank Cash Back&nbsp;Credit Card</li>
    <li>Citibank PremierMiles Card</li>
    <li>Indian Oil Citibank Platinum Credit Card</li>
    <li>Citibank Ultima Credit Card</a> </li>
  </ul>
  </span>
  </div>
<div style=" float:left; width:100%; max-width:663px; height:auto; margin-top:3px; text-align:right;"><span class="text11" style="color:#4c4c4c; size:18px;"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></span>
</div>
</div> 
<?php include "RightCC.php"; ?>
<div style="clear:both;"></div>
<?php include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu"><?php include "footer_cc.php"; ?></div>
</body>
</html>