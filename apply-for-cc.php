<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$City = $_SESSION['City'];
	$maxage=date('Y')-62;
	$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Credit Card | Deal4Loans</title>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-cclist.js"></script>
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


.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}
  
     
	
	/*--------------step2 css-----------------*/
	
	 
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

//
</script>
<Script Language="JavaScript" Type="text/javascript">

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

function ckhcreditcard(Form)
{	
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;

if((space.test(Form.day.value)) || (Form.day.value=="dd")  )
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

<?php
if($City=="Others")
{
?>
if(Form.City_Other.value=='')
{
	alert("Kindly fill in your other City!");
	Form.City_Other.focus();
	return false;
}
<?php
}
?>


if((Form.Pincode.value=='PinCode') || (Form.Pincode.value==''))
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}

if(Form.Company_Name.value=="") 
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
else if(Form.Company_Name.value.length < 3)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}

   myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.No_of_Banks.selectedIndex==0)
				{
						alert("Please select Bank from which you are holding credit card");
						Form.No_of_Banks.focus();
						return false;
				}

				}
					myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}

}

function addElement()
{
	var ni1 = document.getElementById('myDivCC1');
	var ni2 = document.getElementById('myDivCC2');
	//alert(document.loan_form.CC_Holder.value);
	ni1.innerHTML = '<b>Bank Name</b>';
	ni2.innerHTML = '<select size="1" name="No_of_Banks" id="No_of_Banks" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="Other">Other</option></select>';
	return true;
}

function removeElement()
{
	var ni1 = document.getElementById('myDivCC1');
	var ni2 = document.getElementById('myDivCC2');
	//alert(document.loan_form.CC_Holder.value);
	ni2.innerHTML = '';
	ni1.innerHTML = '';
	return true;
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

</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:40px;" >
<div id="logo_sml">
	<img src="new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
</td></tr>
<tr><td>
<table width="1004"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>               
       <td align="center" valign="middle" style="color: #643E02; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">60% of your application for quote from all Banks is complete.</td>            
      </tr>
	  <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  
      <tr>               
       <td align="center" valign="middle" ><img src="new-images/hl/ajax-loader.gif" width="220" height="19" /></td>            
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding-top:4px; "><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
   
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="21" height="21" align="left" valign="top"><img src="new-images/pl/lft-tp-curv.gif" width="21" height="21" /></td>
    <td style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21" align="right" valign="top"><img src="new-images/pl/rgt-tp-curv.gif" width="21" height="21" /></td>
  </tr>
  <tr>
    <td  style="border-left:1px solid #d4d4d4 ">&nbsp;</td>
    <td><form name="creditcard_form"  action="apply-for-cc-continue.php" method="POST" onsubmit="return ckhcreditcard(document.creditcard_form); ">
	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
	<input type="hidden" name="Net_Salary" id="Net_Salary" value="<? echo $_SESSION['Net_Salary']; ?>">
	<input type="hidden" name="City" id="City" value="<? echo $_SESSION['City']; ?>">

		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                     <tr align="center" bgcolor="#f4f4f4">
              <td height="25" colspan="2" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; "> Credit Card Quote Request</td>
              </tr>
            <tr>
              <td height="10" colspan="2" ></td>
              </tr>
         <tr align="left">
				  <td width="234" height="26" class="bldtxt">DOB</td>
				  <td width="313"><input name="day" type="text" id="day" value="dd" style="width:40px; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:40px; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:47px; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
				  </tr>
             <?php
			 if($_SESSION['City']=="Others")
			 {
			 ?>
              <tr align="left">
				  <td height="26" class="bldtxt">Other City </td>
				  <td><input name="City_Other" id="City_Other" type="text" style="width:140px; "  /></td>
				  </tr>
             <?php
			 }
			 ?>
                  	<tr align="left">
				  <td height="26" class="bldtxt">Pincode</td>
				  <td><input name="Pincode" id="Pincode" type="text"  MAXLENGTH="6" style="width:140px; " onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
				  </tr>
                  <tr align="left">
				  <td height="26" class="bldtxt">Company Name </td>
				  <td><input name="Company_Name" id="Company_Name" type="text" style="width:140px; " onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" /></td>
				  </tr>
				  <tr>
				  <td colspan="2" align="left">  <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; '></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></td>
				  </tr>
				<tr align="left">
				  <td height="26" class="bldtxt" >Are you a Credit card holder?</td>
				  <td class="bldtxt">
<input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onclick="addElement();" >
Yes
<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeElement();">
No</td>
				  </tr>
				<tr align="left">
                <td  class="bldtxt" id="myDivCC1"> </td>
				  <td colspan="2" id="myDivCC2" ></td>
		  </tr>
            <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <? } ?>
            <tr>
              <td colspan="2" id="myDivLoan"></td>
            </tr>
           
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="2" align="center"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></td>
            </tr>
          </table>
		  </form></td>
    <td  style="border-right:1px solid #d4d4d4 ">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="new-images/pl/lft-btm-crv.gif" width="21" height="21" /></td>
    <td  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21"><img src="new-images/pl/rgt-btm-curv.gif" width="21" height="21" /></td>
  </tr>
</table>

</td>
      
              
             
      </tr>
    </table></td>
  </tr>
</table>
</td></tr></table>
</body>
</html>
