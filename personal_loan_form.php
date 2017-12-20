<?php $_SERVER['REQUEST_URI'];
if($_SERVER['REQUEST_URI']=='/hdfc-personal-loan-eligibility.php')
{
	$newsource="HD SEO 1";
	$subjectLine="Apply HDFC Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-hsbc-bank.php')
{
	$newsource="HS SEO 1";
	$subjectLine="Apply HSBC Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-icici-bank.php')
{
	$newsource="IC SEO 1";
	$subjectLine="Apply ICICI Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/barclays-finance-personal-loan-eligibility.php')
{
	$newsource="BA SEO 1";
	$subjectLine="Apply Barclays Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/fullerton-personal-loan-eligibility.php')
{
	$newsource="FUL SEO 1";
	$subjectLine="Apply Fullerton Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/citibank-personal-loan-eligibility.php')
{
	$newsource="Ci SEO 1";
	$subjectLine="Compare Personal loans from Major Banks";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-hdb-financial-services.php')
{
	$newsource="HDB SEO 1";
	$subjectLine="HDB Financial Services Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-ing-vysya-bank.php')
{
	$newsource="ING Vysya SEO 1";
	$subjectLine="Apply ING Vysya Personal Loan";
}

?>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>
<script language="JavaScript" type="text/javascript" src="suggest.js"></script>
<style type="text/css">
	
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
	</style>

<script Language="JavaScript" Type="text/javascript">

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


function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.From_Product.length; i++) 
	{
        if(document.personalloan_form.From_Product[i].checked)
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


function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr align="left"><td   class="frmbldtxt"><b>Card held since?</b></td><td style="padding-left:20px;"><select size="1" name="Card_Vintage" style="width:150px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></td></tr></table>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}

function chkpersonalloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";




if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
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

if((space.test(Form.day.value)) || (Form.day.value=="dd"))
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
else if((Form.year.value < "1950") || (Form.year.value >"1994"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

	
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }

if(document.personalloan_form.Email.value!="Email Id")
{
	if (!validmail(document.personalloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.personalloan_form.Email.focus();
		return false;
	}
	
}
if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}
 
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
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
/*for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }*/
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
if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
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
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}


if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income") || (Form.Net_Salary.value=="Monthly Income"))
{
	alert("Please enter Income to Continue");
	Form.Net_Salary.focus();
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

myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.Card_Vintage.selectedIndex==0)
				{
						alert("Please select since how long you holding credit card");
						Form.Card_Vintage.focus();
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

	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
	
	
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
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
function validateemailv2(email)
{
// a very simple email validation checking.
// you can add more complex email checking if it helps
var splitted = email.match("^(.+)@(.+)$");
if(splitted == null) return false;
if(splitted[1] != null )
{
var regexp_user=/^\"?[\w-_\.]*\"?$/;
if(splitted[1].match(regexp_user) == null) return false;
}
if(splitted[2] != null)
{
var regexp_domain=/^[\w-\.]*\.[a-za-z]{2,4}$/;
if(splitted[2].match(regexp_domain) == null)
{
var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
if(splitted[2].match(regexp_ip) == null) return false;
}// if
return true;
}
return false;
}
function othercity1()
{
	if(document.personalloan_form.City.value=='Others')
	{
		document.personalloan_form.City_Other.disabled=false;
	}
	else
	{
		document.personalloan_form.City_Other.disabled=true;
		document.personalloan_form.City_Other.focus();
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

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.personalloan_form.City.value;
	var otrcit = document.personalloan_form.City_Other.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function chgtxtsal()
{
	var nitxt = document.getElementById('chgtxt');
	var niadtxt = document.getElementById('adtxt');
	var citemp = document.personalloan_form.Employment_Status.value;
	if(citemp==0)
	{
		nitxt.innerHTML ="Annual ITR :";
		niadtxt.innerHTML="Annual Turnover: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='Annual_Turnover' id='Annual_Turnover'  style='width:154px;'>		<option value='1'> 0 - 30 Lacs</option>		<option value='2'> 30 Lacs - 60 Lacs</option>		<option value='3'> 60 Lacs - 1 Cr</option>		<option value='4'> 1 Cr & above</option>		</select>";	
	}
	else 
	{
		
		nitxt.innerHTML ="Annual Income :";	
		niadtxt.innerHTML="";	
	}
	
}
</script>


<form name="personalloan_form"  action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 <tr>
        <td style=" padding:5px;"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20"  bgcolor="#FFFFFF" class="frmbldtxt" ><h2 style="margin:0px; padding:0px;">Apply <?php echo $subjectLine; ?></h2></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center"><input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="<?php echo $newsource; ?>"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="25" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                     <td height="25" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="18%" height="25" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="31%" height="25" class="frmbldtxt"  style="padding-top:3px; "><select name="City" style="width:154px;" onchange="othercity1(); addhdfclife();">
<option value="Please Select">Please Select</option>
  <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Bhubneshwar">Bhubneshwar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuttack">Cuttack</option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gaziabad">Gaziabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysore">Mysore</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi 
                                  Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Patna">Patna</option>
                                <option value="Pune">Pune</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Sahibabad">Sahibabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Thane">Thane</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Vishakapatanam">Vishakapatanam</option>
                                <option value="Others">Others</option>
	 </select></td>
                   </tr>
                   <tr valign="middle">
                     <td height="25" class="frmbldtxt">DOB :</td>
                     <td height="25" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" id="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" onKeyUp="searchSuggest();" tabindex="8" /><div id="CityOLayer"></div></td>
                   </tr>
                   <tr valign="middle">
                     <td height="25" class="frmbldtxt">Mobile :</td>
                     <td height="25" class="frmbldtxt">+91
                         <input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();"  tabindex="5"/></td>
                     <td height="25" class="frmbldtxt">Pincode :</td>
                     <td height="25" class="frmbldtxt"><input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="25" class="frmbldtxt">Email ID :</td>
                     <td width="32%" height="25" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                     <td width="18%" height="25" class="frmbldtxt">Company Name :</td>
                     <td width="31%" height="28" class="frmbldtxt"><input name="Company_Name" id="Company_Name" type="text" tabindex="10"   style=" width:148px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="25">&nbsp;</td>
					 <td height="25">&nbsp;</td>
					 <td height="25">&nbsp;</td>
                     <td height="28">&nbsp;</td>
                   </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td height="25" class="frmbldtxt">Occupation :</td>
                <td class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="11" onChange="chgtxtsal();" >
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
              </tr>
              <tr>
                <td height="25" class="frmbldtxt"><div id="chgtxt">Annual Income :</div></td>
                <td class="frmbldtxt"><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="12" />
                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
			   <tr>
			  <td colspan="2" class="frmbldtxt"><div id="adtxt"></div></td></tr>
              <tr>
                <td height="25" class="frmbldtxt">Loan Amount :</td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="13" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
           
              <tr>
                <td height="25" class="frmbldtxt">Credit Card Holder?</td>
                <td class="frmbldtxt"> 
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="14"  value="1" onClick="addElement();">Yes &nbsp;&nbsp;
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="15" value="0" onClick="removeElement();">No</td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><div id="myDiv"></div> </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
          </tr>
            
          <tr>
            <td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">
              <input type="checkbox" name="accept" style="border:none;" checked>
I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a></td>
            <td width="24%" rowspan="2" valign="top"><input type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
          </tr>
          <tr>
		  <td align="left" style="padding:5px;"> <div id="hdfclife"></div></td>
          </tr>

          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form>