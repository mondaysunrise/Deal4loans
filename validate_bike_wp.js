var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(){
var containerid = 'contentarea';	
var bikemanufacturer = document.bikeloan_form.bike_manufacturer.value;
var url;
url = "/getBikeValue.php?bikemanufacturer=" + bikemanufacturer;
//alert(url);
	
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}

function chkcarloan(Form)
{
	
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var j;
	var cnt=-1;
	var curr_dt = '';
	curr_dt = new Date().getFullYear();
 	var maxage = curr_dt - 62;
	var minage = curr_dt - 18;
	
 	if (document.bikeloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.bikeloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.bikeloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.bikeloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status!</span>";	
		document.bikeloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.bikeloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.bikeloan_form.Net_Salary.focus();
		return false;
	}
if (document.bikeloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.bikeloan_form.City.focus();
		return false;
	}
 
if((document.bikeloan_form.Name.value=="") || (Trim(document.bikeloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.bikeloan_form.Name.focus();
		return false;
	}

	if(document.bikeloan_form.Name.value!="")
	{
		if(containsdigit(document.bikeloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.bikeloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.bikeloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.bikeloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.bikeloan_form.Name.focus();
			return false;
		}
  }
		if(document.bikeloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.bikeloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.bikeloan_form.Phone.value)|| document.bikeloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.bikeloan_form.Phone.focus();
		return false;  
	}
	if (document.bikeloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.bikeloan_form.Phone.focus();
		return false;
	}
	if ((document.bikeloan_form.Phone.value.charAt(0)!="9") && (document.bikeloan_form.Phone.value.charAt(0)!="8") && (document.bikeloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.bikeloan_form.Phone.focus();
		return false;
	}
	
	if(document.bikeloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.bikeloan_form.Email.focus();
		return false;
	}
	
	var str=document.bikeloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.bikeloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.bikeloan_form.Email.focus();
		return false;
	}
	
	if(document.bikeloan_form.day.value=="" || document.bikeloan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.bikeloan_form.day.focus();
		return false;
	}
	if(document.bikeloan_form.day.value!="")
	{
		if((document.bikeloan_form.day.value<1) || (document.bikeloan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.bikeloan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.bikeloan_form.day, 'Day', 2))
		return false;
	
	if(document.bikeloan_form.month.value=="" || document.bikeloan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.bikeloan_form.month.focus();
		return false;
	}
	if(document.bikeloan_form.month.value!="")
	{
		if((document.bikeloan_form.month.value<1) || (document.bikeloan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.bikeloan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.bikeloan_form.month, 'month', 2))
		return false;

	if(document.bikeloan_form.year.value=="" || document.bikeloan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.bikeloan_form.year.focus();
		return false;
	}
	if(document.bikeloan_form.year.value!="")
	{
		if((document.bikeloan_form.year.value < maxage) || (document.bikeloan_form.year.value >minage))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.bikeloan_form.year.focus();
			return false;
		}
	}

	if(!checkData(document.bikeloan_form.year, 'Year', 4))
		return false;
		
	
	if((document.bikeloan_form.City.value=="Others") && ((document.bikeloan_form.City_Other.value=="" || document.bikeloan_form.City_Other.value=="Other City"  ) || !isNaN(document.bikeloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.bikeloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.bikeloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.bikeloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.bikeloan_form.City_Other.focus();
  		return false;
  	}
  }
  
if((document.bikeloan_form.Company_Name.value=="") || (document.bikeloan_form.Company_Name.value=="Company Name")|| (Trim(document.bikeloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.bikeloan_form.Company_Name.focus();
		return false;
	}
	else if(document.bikeloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.bikeloan_form.Company_Name.focus();
		return false;
	}

if (document.bikeloan_form.bike_manufacturer.selectedIndex==0)
{
	document.getElementById('bikeMVal').innerHTML = "<span  class='hintanchor'>Enter Bike Manufacturer!</span>";	
	document.bikeloan_form.bike_manufacturer.focus();
	return false;
}	
if (document.bikeloan_form.bike_model.selectedIndex==0)
{
	document.getElementById('bikeModelVal').innerHTML = "<span  class='hintanchor'>Enter Bike Model!</span>";	
	document.bikeloan_form.bike_model.focus();
	return false;
}
	if(!document.bikeloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.bikeloan_form.accept.focus();
		return false;
	}
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni3 = document.getElementById('other_Details');
	ni1.innerHTML = '<div style="padding-left:20px;" ><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="27%"  align="left" style="font-size:19px; color:#FFFFFF; padding-top:5px;"> Personal Details</td><td style="font-size:13px; font-weight:normal; color:#fff;"></td></tr></table></div> <div style="clear:both;"></div><div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>  </tr><tr>    <td  height="25"><input name="Name" id="Name"  class="pl_input_b" type="text" onkeydown="validateDiv(\'nameVal\');" tabindex="5"  /><div id="nameVal"></div></td>    </tr>    </table>    </div><div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></td>  </tr><tr>       <td height="25">      <table><tr><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">+91</td><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" class="pl_input_b" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onblur="return Decorate1(\' \')" onfocus="addtooltip();" tabindex="6" onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table>              </td>    </tr>        </table>    </div><div class="pl_input_box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>   </tr><tr>    <td height="25" >      <input type="text" name="Email" id="Email"   class="pl_input_b"  tabindex="7" onkeydown="validateDiv(\'emailVal\');" /> <div id="emailVal"></div> </td>    </tr>  </table></div>   <div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td>   </tr><tr>    <td height="25" ><input name="day" type="text" id="day"  value="DD" class="pl_dd" onblur="onBlurDefault(this,\'dd\');" onkeydown="validateDiv(\'dobVal\');" onfocus="onFocusBlank(this,\'dd\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="8"/> <input  name="month" type="text" onkeydown="validateDiv(\'dobVal\');" id="month" class="pl_dd" value="MM" onblur="onBlurDefault(this,\'mm\');" onfocus="onFocusBlank(this,\'mm\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="9"/> <input name="year" type="text" id="year" class="pl_yy_b" value="YYYY" onblur="onBlurDefault(this,\'yyyy\');" onfocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="10"/><div id="dobVal"></div> </td>    </tr>        </table>    </div>';
	var ni20 = document.getElementById('City').value;
	if(ni20=='Others')
	{
		ni3.innerHTML ='<div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</span></td>    </tr><tr>    <td height="25">                     <input type="text" name="City_Other"  value="Other City" onfocus="this.select();" class="pl_input_b" tabindex="8" onkeydown="validateDiv(\'othercityVal\');"  />                        <div id="othercityVal"></div>   </td>    </tr>        </table>    </div> <div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name:</span></td> </tr><tr>      <td height="25" >      <input type="text" name="Company_Name" class="pl_input_b" onfocus="addrest();" onkeydown="validateDiv(\'companyNameVal\');" tabindex="11" onKeyUp="/ajax_showOptions(this,\'getCountriesByLetters\',event)" autocomplete="off"/> <div id="companyNameVal"></div>    </td>    </tr>  </table></div><div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bike Make:</span></td>   </tr><tr>     <td height="25" >  <select name="bike_manufacturer" id="bike_manufacturer"  onChange="ajaxpage(); addSBIOFR();" style="height:25px; width:170px;"><option value="">Select Brand</option>  	<option value="Bajaj">Bajaj</option>          	<option value="Hero">Hero</option>          	<option value="Honda">Honda</option>          	<option value="Hyosung">Hyosung</option>          	<option value="Mahindra">Mahindra</option>          	<option value="PIAGGIO VESPA">PIAGGIO VESPA</option>          	<option value="Royal Enfield">Royal Enfield</option>          	<option value="Suzuki">Suzuki</option>          	<option value="TVS">TVS</option>          	<option value="Yamaha">Yamaha</option> </select>        <div id="bikeMVal"></div>                </td>    </tr>        </table>    </div>   <div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" style=" color:#FFF; font-size:12px;"><em>Bike Model:</em></td>  </tr><tr>    <td  style=" color:#FFF; font-size:12px;">      <div class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;" id="contentarea"><select name="bike_model" id="bike_model"  style="height:25px;" ><option value="">Select Model</option></select></div> <div  id="bikeModelVal"></div>    </td>    </tr>   </table></div><div style="clear:both;"></div><div class="pl_terms_box" style="text-align:left;"><input type="checkbox"  name="accept" style="border:none;" tabindex="15" > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#FFF; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#FFF; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>                  <div class="pl_bnt_b"><input type="submit" class="cl-get-quotebtn" value="Get Quote" tabindex="16"/></div>   <div style="clear:both;"></div>';
	}
	else
	{
		ni3.innerHTML ='<div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name:</span></td> </tr><tr>      <td height="25" >     <input type="text" name="Company_Name" class="pl_input_b" onfocus="addrest();" onkeydown="validateDiv(\'companyNameVal\');" tabindex="11" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" autocomplete="off"/> <div id="companyNameVal"></div>    </td>    </tr>  </table></div><div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bike Make:</span></td>   </tr><tr>     <td height="25" >  <select name="bike_manufacturer" id="bike_manufacturer"  onChange="ajaxpage(); addSBIOFR();" class="pl_select_b"><option value="">Select Brand</option>  	<option value="Bajaj">Bajaj</option>          	<option value="Hero">Hero</option>          	<option value="Honda">Honda</option>          	<option value="Hyosung">Hyosung</option>          	<option value="Mahindra">Mahindra</option>          	<option value="PIAGGIO VESPA">PIAGGIO VESPA</option>          	<option value="Royal Enfield">Royal Enfield</option>          	<option value="Suzuki">Suzuki</option>          	<option value="TVS">TVS</option>          	<option value="Yamaha">Yamaha</option> </select><div id="bikeMVal"></div> </td></tr></table></div>   <div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" style=" color:#FFF; font-size:12px;"><em>Bike Model:</em></td>  </tr><tr>    <td  style=" color:#FFF; font-size:12px;"><div class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;" id="contentarea"><select name="bike_model" id="bike_model" class="pl_select_b"><option value="">Select Model</option></select></div> <div  id="bikeModelVal"></div>    </td>    </tr>   </table></div><div style="clear:both;"></div><div class="pl_terms_box" style="text-align:left;"><input type="checkbox"  name="accept" style="border:none;" tabindex="15" > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#FFF; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#FFF; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>                  <div class="pl_bnt_b"><input type="submit" class="cl-get-quotebtn" value="Get Quote" tabindex="16"/></div>   <div style="clear:both;"></div>';
	}
	
}

function fornValidate()
{
	if (document.bikeloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.bikeloan_form.Loan_Amount.focus();
		return false;
	}	
	
		
	if (document.bikeloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status!</span>";	
		document.bikeloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.bikeloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.bikeloan_form.Net_Salary.focus();
		return false;
	}
if (document.bikeloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.bikeloan_form.City.focus();
		return false;
	}
}
function addSBIOFR()
{
	var niSBIOFR = document.getElementById('sbiCardOffer');
	var cit = document.getElementById('City').value;
	var salry = document.getElementById('Net_Salary').value;

	if(niSBIOFR.innerHTML=='')
	{
		if((cit=="Ahmedabad" || cit=="Bangalore" || cit=="Baroda" || cit=="Bhopal" || cit=="Bhubaneshwar" || cit=="Calcutta" || cit=="Chennai" || cit=="Coimbatore" || cit=="Faridabad" || cit=="Gaziabad" || cit=="Gurgaon" || cit=="Hyderabad" || cit=="Indore" || cit=="Indore" || cit=="Jaipur" || cit=="Lucknow" || cit=="Mumbai" || cit=="Nagpur" || cit=="Delhi" || cit=="Noida" || cit=="Chandigarh" || cit=="Ludhiana" || cit=="Jalandhar" || cit=="Aurangabad" || cit=="Tirupur" || cit=="Nasik" || cit=="Rajkot" || cit=="Jamnagar") && salry>=210000)
		{
			niSBIOFR.innerHTML = '<table border="0" cellpadding="0" cellspacing="0" style="width:85%; border:thin #FFF solid;padding-left:10px; font-size:14px; color:#fff;">  <tr>   <td colspan="3" class="termtext"><input  name="sbiCCOffer"" type="checkbox" value="1" checked/>Apply for SBI Credit Card with Zero Fee, choose from a wide range with great deals on Shopping, Dinning &Travel credit cards .</td>  </tr></table><br>';	
		}
		else
		{
			niSBIOFR.innerHTML = '';
		}
	}
	else
	{
		if((cit=="Ahmedabad" || cit=="Bangalore" || cit=="Baroda" || cit=="Bhopal" || cit=="Bhubaneshwar" || cit=="Calcutta" || cit=="Chennai" || cit=="Coimbatore" || cit=="Faridabad" || cit=="Gaziabad" || cit=="Gurgaon" || cit=="Hyderabad" || cit=="Indore" || cit=="Indore" || cit=="Jaipur" || cit=="Lucknow" || cit=="Mumbai" || cit=="Nagpur" || cit=="Delhi" || cit=="Noida" || cit=="Chandigarh" || cit=="Ludhiana" || cit=="Jalandhar" || cit=="Aurangabad" || cit=="Tirupur" || cit=="Nasik" || cit=="Rajkot" || cit=="Jamnagar") && salry>=210000)
		{
			niSBIOFR.innerHTML = '<table border="0" cellpadding="0" cellspacing="0" style="width:85%; border:thin #FFF solid; padding-left:10px; font-size:14px; color:#fff;">  <tr>   <td colspan="3" class="termtext"><input name="sbiCCOffer" type="checkbox" value="1" checked/>Apply for SBI Credit Card with Zero Fee, choose from a wide range with great deals on Shopping, Dinning &Travel credit cards .</td>  </tr></table><br>';	
		}
		else
		{
			niSBIOFR.innerHTML = '';
		}

	}
	return true;
}