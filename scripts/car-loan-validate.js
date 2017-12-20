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
	
 	if (document.carloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.carloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.carloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.carloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status to Continue!</span>";	
		document.carloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.carloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.carloan_form.Net_Salary.focus();
		return false;
	}
if (document.carloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.carloan_form.City.focus();
		return false;
	}
 
if((document.carloan_form.Name.value=="") || (Trim(document.carloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.carloan_form.Name.focus();
		return false;
	}

	if(document.carloan_form.Name.value!="")
	{
		if(containsdigit(document.carloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.carloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.carloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.carloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.carloan_form.Name.focus();
			return false;
		}
  }
		if(document.carloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.carloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.carloan_form.Phone.value)|| document.carloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.carloan_form.Phone.focus();
		return false;  
	}
	if (document.carloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.carloan_form.Phone.focus();
		return false;
	}
	if ((document.carloan_form.Phone.value.charAt(0)!="9") && (document.carloan_form.Phone.value.charAt(0)!="8") && (document.carloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.carloan_form.Phone.focus();
		return false;
	}
	
	if(document.carloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.carloan_form.Email.focus();
		return false;
	}
	
	var str=document.carloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.carloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.carloan_form.Email.focus();
		return false;
	}
	
	if(document.carloan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
		document.carloan_form.Age.focus();
		return false;
	}
	

	if((document.carloan_form.City.value=="Others") && ((document.carloan_form.City_Other.value=="" || document.carloan_form.City_Other.value=="Other City"  ) || !isNaN(document.carloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.carloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.carloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.carloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.carloan_form.City_Other.focus();
  		return false;
  	}
  }
  
if((document.carloan_form.Company_Name.value=="") || (document.carloan_form.Company_Name.value=="Company Name")|| (Trim(document.carloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.carloan_form.Company_Name.focus();
		return false;
	}
	else if(document.carloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.carloan_form.Company_Name.focus();
		return false;
	}
	for(j=0; j<document.carloan_form.Car_Booked.length; j++) 
	{
		 if(document.carloan_form.Car_Booked[j].checked)
		{
			 if(j==0)
				{
				if (document.carloan_form.cldelivery_date.value=="" || document.carloan_form.cldelivery_date.value=="DD-MM-YYYY")
				{
						document.getElementById('delivry_dtVal').innerHTML = "<span  class='hintanchor'>Enter valid delivery date</span>";	
						document.carloan_form.cldelivery_date.focus();
						return false;
				}
				}

			 cnt= j;
		}
	}
	if(cnt == -1) 
		{
			document.getElementById('carbukedVal').innerHTML = "<span  class='hintanchor'> select car Booked or not</span>";	
			return false;
		}
		
	if(!document.carloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.carloan_form.accept.focus();
		return false;
	}
}

function cityother()
{
	if(document.carloan_form.City.value=="Others")
	{
		document.carloan_form.City_Other.disabled = false;
	}
	else
	{
		document.carloan_form.City_Other.disabled = true;
	}
} 

function addibibo(Form)
{
	var ni1 = document.getElementById('getibibo');
	var cit = Form.City.value;
	if(cit!="Please Select")
	{
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function addhdfclife(Form)
{
	var ni1 = document.getElementById('hdfclife');
	var cit = Form.City.value;
	 var txtview= '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	hdfclifecamp(ni1,cit,txtview);
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


function adddel_dt()
{
	var ni = document.getElementById('myDivdel_dt');
	if(ni.innerHTML=="")
		{
			ni.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%"><tr><td height="28" class="cl-form-text" style=" padding-top:3px;  text-transform:none;">Delivery Date</td></tr><tr><td class="text" style=" padding-top:3px;"><input type="text" name="cldelivery_date" id="cldelivery_date" value="DD-MM-YYYY" onblur="onBlurDefault(this,\'DD-MM-YYYY\');" onfocus="onFocusBlank(this,\'DD-MM-YYYY\');" class="d4l-input" onkeydown="validateDiv(\'delivry_dtVal\');"/></div><div id="delivry_dtVal"></div></td></tr></table>';
		}
		return true;
	}


function removedel_dt()
{
		var ni = document.getElementById('myDivdel_dt');
		
		if(ni.innerHTML!="")
		{
			ni.innerHTML = '';
		}
		return true;
	}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.carloan_form.City.value;
	var txtview = '<table  style="border:1px solid #000000; padding:2px; width:100%;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	hdfclifecamp(ni1,cit,txtview);
}


function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('other_Details');
	var ni5 = document.getElementById('imgDisplay');
	
	ni3.innerHTML = '<div class="p-details"><div><strong>Personal Details</strong></div><div class="termtext"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div> <div style="clear:both;"></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" class="cl-form-text">Full Name:</td>  </tr><tr>    <td  height="25"><input name="Name" id="Name"  class="d4l-input" type="text" onkeydown="validateDiv(\'nameVal\');" tabindex="5" autocomplete="off" /><div id="nameVal"></div></td>    </tr>    </table>    </div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Mobile:</td>  </tr><tr>       <td height="25">      <table width="100%"><tr><td class="cl-form-text">+91</td><td><input type="text" class="d4l-input" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onblur="return Decorate1(\' \')" onfocus="addtooltip();" tabindex="6" onkeydown="validateDiv(\'phoneVal\');" autocomplete="off" /><div id="phoneVal"></div> </td></tr></table>              </td>    </tr>        </table>    </div><div class="new-input-box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>      <td height="25" class="cl-form-text">Email ID :</td>   </tr><tr>    <td height="25" >      <input type="text" name="Email" id="Email"   class="d4l-input"  tabindex="7" onkeydown="validateDiv(\'emailVal\');" autocomplete="off" /> <div id="emailVal"></div> </td>    </tr>  </table></div>   <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Age:</td>   </tr><tr>    <td height="25" ><select onchange="validateDiv(\'AgeVal\');" class="d4l-select" name="Age" id="Age"><option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option></select><div id="AgeVal"></div> </td>    </tr>        </table>    </div>';
	var ni20 = document.getElementById('City').value;
	if(ni20=='Others')
	{
		ni1.innerHTML = '<div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td class="cl-form-text">Other City:</td>    </tr><tr>    <td height="25"> <input type="text" name="City_Other" onfocus="this.select();" class="d4l-input" tabindex="8" onkeydown="validateDiv(\'othercityVal\');"  />                        <div id="othercityVal"></div>   </td>    </tr>        </table>    </div> <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td class="cl-form-text">Company Name:</td> </tr><tr>      <td height="25" >      <input type="text" name="Company_Name" class="d4l-input" onfocus="addrest();" onkeydown="validateDiv(\'companyNameVal\');" tabindex="11" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" autocomplete="off"/> <div id="companyNameVal"></div>    </td>    </tr>  </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td class="cl-form-text">Car Type:</td>   </tr><tr>     <td height="25" >  <select  class="d4l-select" name="Car_Type" onchange="validateDiv(\'empStatusVal\');" tabindex="12"><option selected value="-1">Interested In</option>	<option  value="1">New Car</option>	<option value="0">UsedCar</option></select>        <div id="carTypeVal"></div></td>    </tr></table> </div>   <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="cl-form-text">Car Booked:</td>  </tr><tr>    <td class="cl-form-text"><table cellpadding="0" cellspacing="0"><tr><td class="cl-form-text"><input type="radio" value="2" name="Car_Booked" id="Car_Booked" style="border:none;" onClick="adddel_dt();" onkeydown="validateDiv(\'carbukedVal\'); " tabindex="13" > Yes </td><td class="cl-form-text"><input type="radio" value="1" name="Car_Booked" id="Car_Booked" style="border:none;" onClick="removedel_dt();" onkeydown="validateDiv(\'carbukedVal\'); " tabindex="14" > No  <div id="carbukedVal"></div></td></tr></table>      </td>    </tr> <tr>                <td  colspan="2"><div  id="myDivdel_dt"></div>          </td>    </tr>  </table></div><div style="clear:both;"></div><div class="cl_terms_box"><span class="termtext"><input type="checkbox"  name="accept" style="border:none;" tabindex="15" > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="color:#fff; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#fff; text-decoration:underline;">Terms and Conditions</a>.</span><div id="acceptVal"></div></div> <div class="cl_bnt_b"> <input type="submit" class="cl-get-quotebtn" value="Get Quote" tabindex="16"></div>   <div style="clear:both;"></div><div id="hdfclife"></div>  ';
	}
	else
	{
		ni1.innerHTML = ' <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Company Name:</td> </tr><tr>      <td height="25" >  <input name="City_Other" id="City_Other" type="hidden" disabled tabindex="10" />    <input type="text" name="Company_Name" class="d4l-input" onfocus="addrest();" onkeydown="validateDiv(\'companyNameVal\');" tabindex="11" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" autocomplete="off"/> <div id="companyNameVal"></div>    </td>    </tr>  </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Car Type:</td>   </tr><tr>     <td height="25" >  <select  class="d4l-select" name="Car_Type" onchange="validateDiv(\'empStatusVal\');" tabindex="12"><option selected value="-1">Interested In</option>	<option  value="1">New Car</option>	<option value="0">UsedCar</option></select>        <div id="carTypeVal"></div>                </td>    </tr>        </table>    </div>   <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" class="cl-form-text">Car Booked:</td>  </tr><tr>    <td>      <table cellpadding="0" cellspacing="0"><tr><td style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="radio" value="2" name="Car_Booked" id="Car_Booked" style="border:none;" onClick="adddel_dt();" onkeydown="validateDiv(\'carbukedVal\'); " tabindex="13" > Yes </td><td style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="radio" value="1" name="Car_Booked" id="Car_Booked" style="border:none;" onClick="removedel_dt();" onkeydown="validateDiv(\'carbukedVal\'); " tabindex="14" > No  <div id="carbukedVal"></div></td></tr></table>      </td>    </tr> </table></div><div class="new-input-box"><div  id="myDivdel_dt"></div></div><div style="clear:both;"></div><div class="cl_terms_box cl-form-text"><input type="checkbox"  name="accept" style="border:none;" tabindex="15" > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#fff;text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#fff; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div> <div class="cl_bnt_b"><input  type="submit" class="cl-get-quotebtn" value="Get Quote" tabindex="16"/></div>   <div style="clear:both;"></div><div id="hdfclife"></div>';
	}
	ni5.innerHTML = '<img src="images/carloan-animatedtext.gif" width="100%" style="width:100%; max-width:575px;" />';
}


function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function fornValidate()
{
	if (document.carloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.carloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.carloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.carloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status to Continue!</span>";	
		document.carloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.carloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.carloan_form.Net_Salary.focus();
		return false;
	}
if (document.carloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.carloan_form.City.focus();
		return false;
	}
}