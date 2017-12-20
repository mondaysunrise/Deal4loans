<?php
	require 'scripts/session_check_online.php';
	require 'scripts/functions.php';
	//session_start();
	 $page_name = "Home Loan";

	$source="Ref-".$_SESSION['UName'];

	?>
	
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style/new-bima.css" rel="stylesheet" type="text/css" />


<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td  background='http://www.deal4loans.com/images/logutbg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td bgcolor='#FFFFFF'>&nbsp;</td></tr></table></td></tr></table>";
	}
?>



  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->

<style>
  
body{	
background-color:#FFFFFF!important;
background-image:none!important;
}

h1{	font-family:Arial,Helvetica,sans-serif;
	font-size:17px;
	text-align:center;
	color:#443133;
	margin:0px;
	padding:15px 0px 3px 0px;
	line-height:19px;
	margin-bottom:10px;
	font-weight: bold;
}

.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
 
</style>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<style  >
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;

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
.orgtext{
	color:#d75b10;
	line-height:16px;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
}

.nrmltxt{
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

.nrmltxt span{
	font-weight:bold;
	color:#a9643a;
	font-size:12px;

}

.bldtxt{
	font-weight:bold;
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

/* START CSS NEEDED ONLY IN DEMO */
	
#mainContainer{
	width:660px;
	margin:0 auto;
	text-align:left;
	height:100%;		
	border-left:3px double #000;
	border-right:3px double #000;
	}
#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
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
	
form{
	display:inline;
	}
 
#slider{
	width:590px;
	margin:0 0 0 50px;
 }	

#slider ul, #slider li{
	margin:0;
	padding:0;
	list-style:none;
}

#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;
	height:65px;
	overflow:hidden; 
}
		
	
#slider li div{
	display:block;
	float:left;
	width:143px;
 }

p#controls{
	margin:-76px 0 0 15;
	position:relative;
	width:650px;
} 
	
		
#prevBtn, #nextBtn{ 
	display:block;
	overflow:hidden;
	text-indent:-8000px;		
	width:36px;
	height:80px;
	position:absolute;
}	

#nextBtn{ 
	left:605px;
}														
#prevBtn a, #nextBtn a{  
	display:block;
	width:36px;
	height:84px;
	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center;
 
}	

#nextBtn a{ 
	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center;
}												
 </style>
<Script Language="JavaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
}

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
}
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}




function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
	alert("Kindly fill in your Name!");
	Form.Name.focus();
	return false;
	}
	else if(containsdigit(Form.Name.value)==true)
	{
	alert("Name contains numbers!");
	Form.Name.focus();
	return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
	alert("Kindly fill in your Mobile Number!");
	Form.Phone.focus();
	return false;
	}
	
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value");
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.Phone.focus();
					return false;
			}
			if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
					alert("The number should start only with 9 or 8 or 7");
					 Form.Phone.focus();
					return false;
			}
	
	
	
	if(Form.Email.value!="Email Id")
	{
		if (!validmail(Form.Email.value))
		{
			Form.Email.focus();
			return false;
		}
		
	}
	
	
	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{
	alert("Kindly fill in your other City!");
	Form.City_Other.focus();
	return false;
	}

	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{
		alert("Please enter Annual income to Continue");
		Form.IncomeAmount.focus();
		return false;
	}
	
	 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{
	alert("Kindly fill in your Loan Amount (Numeric Only)!");
	Form.Loan_Amount.focus();
	return false;
	}
	else if(containsalph(Form.Loan_Amount.value)==true)
	{
	alert("Loan Amount contains characters!");
	Form.Loan_Amount.focus();
	return false;
	}
	
	
	if(!Form.accept.checked)
	{
	alert("Accept the Terms and Condition");
	Form.accept.focus();
	return false;
	}
	
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

function containsalph(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
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

function othercity1()
{
	if(document.home_loan.City.value=='Others')
	{
		document.home_loan.City_Other.disabled=false;
		document.home_loan.City_Other.focus();
	}
	else
	{
		document.home_loan.City_Other.disabled=true;
		document.home_loan.City_Other.focus();
	}
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

function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>

  <script>
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}


function addtooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
			//}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML!="")
		{
		
//			if(document.loan_form.Phone.value!="")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
		//	}
		}
		
		return true;

	}
		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequest.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
			 
		}

	window.onload = ajaxFunction;


</script>
</head>

<body onbeforeunload="HandleOnClose('closedby_hl.php')">

<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>

    <td align="center" valign="top">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td width="200" valign="top" ><?php include '~Partners_Left.php';?></td>
        <td width="600" height="580" valign="top">
		  <table  width="438" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
			<tr align="left">
			  <td height="10" colspan="2" ></td>
			  </tr>
			<tr align="left">
				  <td height="58" colspan="2" align="center" background="images/logintop_bg.gif"><h1>Home Loan Registration</h1></td>
			  </tr>
			<tr align="left">
			  <td colspan="2" align="center" background="images/login-form-login-bg.gif"  > <!-- <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php// if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div> --></td>
			  </tr>
				 
              <tr>
                <td valign="top"  background="images/login-form-login-bg.gif" >
								<form name="home_loan" action="hl_registration_continue.php" onSubmit="return submitform(document.home_loan);" method="post">

<table width="95%"  border="0" align="right" cellpadding="0" cellspacing="0"  >
				
				  <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
									<input type="hidden" name="bidderid" value="<? echo $_SESSION['BidderID']; ?>">
                                    <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
                                    <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
                                    <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
                                    <input type="hidden" name="source" value="<? echo $source; ?> ">
                                    <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
                                    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">  
				<tr align="left">
				  <Td width="14%" class="frmbldtxt">&nbsp;</Td>
				<Td width="35%" height="27" class="frmbldtxt">First Name </Td>
 				<Td width="51%"><INPUT TYPE="hidden" NAME="onCloseValue" id="onCloseValue" value="1">
				<input type="text" name="Name" id="Name" style="width:140px;"/></Td>
				</tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Mobile No. </Td>
				  <Td>+91 
	  <input name="Phone" id="Phone" type="text" style="width:116px; " onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10"  /></Td>
				  </tr>
				   <tr>
		  <td colspan="3"><div id="myDiv1" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Email Id </Td>
				  <Td><input name="Email" id="Email" type="text"  style="width:140px; "  onblur="onBlurDefault(this,'Email Id');" onFocus="removetooltip();"  onChange="insertData();"/></Td>
				  </tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">City</Td>
				  <Td><select size="1" align="left" style="width:144px;"  name="City" id="City" onChange="othercity1(this); insertData(); " /><?=getCityList1($City)?>    </select>
 
	  </Td>
				  </tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Other City </Td>
				  <Td><input disabled value="Other City"  onfocus="this.select();" name="City_Other" id="City_Other" style="width: 140px;"  onBlur="onBlurDefault(this,'Other City');"></Td>
				  </tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Annual Income </Td>
				  <Td><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome'); onBlurDefault(this,'Annual Income');">
				  </Td>
				  </tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Loan Amount </Td>
				  <Td><input   name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); onBlurDefault(this,'Loan Amount');">
				</Td>
				  </tr>

				<tr align="center" valign="middle">
				  <Td height="50" colspan="3"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
				</form>
				</td>
              </tr>
             
              <tr>
                <td width="438" height="16" align="left" valign="top" ><img src="images/loginbt_bg.gif" width="438" height="16" /></td>
              </tr>
			  <tr align="left">
			  <td height="10" colspan="2" ></td>
			  </tr>
              
            </table>
		
		</td>
		<td width="50">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
