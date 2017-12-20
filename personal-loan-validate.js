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

var wrap = $("#wrap");
wrap.on("scroll", function(e) {
    
  if (this.scrollTop > 147) {
    wrap.addClass("pl_newuiwrapper");
  } else {
    wrap.removeClass("pl_newuiwrapper");
  }
  
});	

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

function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }

function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false; }
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
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (document.personalloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		document.personalloan_form.Employment_Status.focus();
		return false;
	}
	 if (document.personalloan_form.Employment_Status.value==0)
	{
		if (document.personalloan_form.Annual_Turnover.selectedIndex==0)
	{
		document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover!</span>";	
		document.personalloan_form.Annual_Turnover.focus();
		return false;
	}
	}
 if(document.personalloan_form.Employment_Status.value==1)
	{
	if((document.personalloan_form.Company_Name.value=="") || (document.personalloan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.personalloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.personalloan_form.Company_Name.focus();
		return false;
	}
	else if(document.personalloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.personalloan_form.Company_Name.focus();
		return false;
	}
	}

		if (document.personalloan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.personalloan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.IncomeAmount, 'Annual Income',0))
		return false;

	if (document.personalloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City!</span>";	
		document.personalloan_form.City.focus();
		return false;
	}
	if((document.personalloan_form.City.value=="Others") && ((document.personalloan_form.City_Other.value=="" || document.personalloan_form.City_Other.value=="Other City"  ) || !isNaN(document.personalloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City!</span>";		
		document.personalloan_form.City_Other.focus();
		return false;
	}

	if((document.personalloan_form.Name.value==""))
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.personalloan_form.Name.focus();
		return false;
	}

	if(document.personalloan_form.Name.value!="")
	{
		if(containsdigit(document.personalloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.personalloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.personalloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.personalloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.personalloan_form.Name.focus();
			return false;
		}
  }
  
 
	
	if(document.personalloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	
	 if(document.personalloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.personalloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.personalloan_form.Phone.focus();
		return false;  
	}
	if (document.personalloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	
		
	if(document.personalloan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
		document.personalloan_form.Age.focus();
		return false;
	}
	
	
	var myOption = -1;
		for (i=document.personalloan_form.CC_Holder.length-1; i > -1; i--) {
			if(document.personalloan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.personalloan_form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						document.personalloan_form.Card_Vintage.focus();
						return false;
					}
				}
					myOption = i;
				}
		}
	
		if (myOption == -1) 
		{
			document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";	
			return false;
		}

	if(!document.personalloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.personalloan_form.accept.focus();
		return false;
	}	
}  

function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	    ni1.innerHTML = '<div class="new-input-box" style="margin-top:10px"><div>Card held since?</div>    <div><select size="1" name="Card_Vintage" class="d4l-select" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div><div id="vintageVal"></div></div></div>';
					
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');		
	ni1.innerHTML = '';
	ni2.innerHTML = '';
	return true;
}	

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function addibibo()
{
	var ni1 = document.getElementById('getibibo');
	var cit = document.personalloan_form.City.value;
	//alert(cit);	
	ni1.innerHTML = '';
	if(cit!="Please Select")
	{
		//alert("ranjana");
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.personalloan_form.City.value;
	var txtview = '<table  style="border:1px solid #000000; padding:2px; width:100%;"><tr><td colspan="2" class="frmbldtxt" style=" font-size:10px;font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="100%" style="font-size:12px; "> I would like to avail of <b> FREE </b> financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	hdfclifecamp(ni1,cit,txtview);
}


function change_empstst()
{

	var occpdiv1 = document.getElementById('chnge_empststName');
	var occpdiv2 = document.getElementById('chnge_empststVal');
	var occupation = document.personalloan_form.Employment_Status.value;
	//alert(occupation);
	if(occupation==0)
	{
	occpdiv1.innerHTML = '<div style="padding-top:12px;">Annual Turnover: </div>';
	occpdiv2.innerHTML = ' <select name="Annual_Turnover" id="Annual_Turnover" class="d4l-select" onChange="validateDiv(\'annualTurnoverVal\');"><option value="">Please Select</option>	<option value="1" > 0 To 40 Lacs</option>	<option value="4" > 40 Lacs To 1 Cr</option><option value="2" > 1Cr - 3Crs </option><option value="3" >3Crs & above</option></select>                        <div id="annualTurnoverVal"></div>            ';
	}
	else
	{
	occpdiv1.innerHTML = '<div style="padding-top:12px;">Company Name: </div>';
	
	occpdiv2.innerHTML = '<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex=11/>                        <div id="companyNameVal"></div>';
	}
}

function othercity1()
{
//alert(document.personalloan_form.City.value);
	//var citydiv1 = document.getElementById('otherCityName');
	var citydiv2 = document.getElementById('otherCityName');
	if(document.personalloan_form.City.value=='Others')	
	{
//	alert(document.personalloan_form.City.value);
		citydiv2.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td height="25"><span>Other City:</span></td></tr><tr><td height="25"><input name="City_Other" id="City_Other" type="text" class="d4l-input" onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');" autocomplete="off" /><div id="othercityVal"></div></td></tr></table>';	
	}
	else
	{
		citydiv2.innerHTML = '';
	}
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	ni1.innerHTML = '<div class="p-details"><div><strong>Personal Details</strong></div><div class="termtext"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25">Full Name:</td>    </tr>    <tr>      <td height="25">   <input name="Name" id="Name" type="text"  class="d4l-input" onkeydown="validateDiv(\'nameVal\');" autocomplete="off" />   <div id="nameVal"></div>  </td>    </tr>    </table></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25">Email ID :</td>    </tr>    <tr>      <td height="25">  <input name="Email" id="Email" type="text" class="d4l-input" onkeypress="validateDiv(\'emailVal\');" autocomplete="off" />          <div id="emailVal"></div>   </td>    </tr>      </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25">Mobile:</td>    </tr>        <tr>      <td height="25"><div style="float:left; margin-top:5px;"><em>+91</em></div>        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4lmob" onkeydown="validateDiv(\'phoneVal\');" autocomplete="off" /><div id="phoneVal"></div>   </td>    </tr>  </table></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25">Age:</td></tr><tr><td height="25"><select onchange="validateDiv(\'AgeVal\');" class="d4l-select" name="Age" id="Age"><option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option></select><div id="AgeVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="new-input-box" style="margin-top:10px">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25">Credit Card:</td></tr><tr><td height="25"> <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" style="border:none;" /> Yes <input size="10" type="radio" style="border:none;" name="CC_Holder"  onclick="removeIdentified();" value="0" > No</td>    </tr>    </table></div><div class="d4l-inputox" id="myDiv1"></div>';
	ni3.innerHTML = '<div style="clear:both; height:5px;"></div><div class="new_terms_box"><span class="termtext">  <input name="accept" type="checkbox" checked="checked" onclick="validateDiv(\'acceptVal\');" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow" text-decoration:underline!important; > partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" text-decoration:underline;>Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="text-decoration:underline;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div>                  <div class="pl_bnt_b"> <input type="submit" class="pl-get-quotebtn" value="Get Quote"/></div>                  <div style="clear:both;"></div>                  <div id="hdfclife"></div>                  <div style="clear:both;"></div>';

}

function fornValidate()
{
	if (document.personalloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (document.personalloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		document.personalloan_form.Employment_Status.focus();
		return false;
	}
	 if (document.personalloan_form.Employment_Status.value==0)
	{
		if (document.personalloan_form.Annual_Turnover.selectedIndex==0)
	{
		document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover!</span>";	
		document.personalloan_form.Annual_Turnover.focus();
		return false;
	}
	}
 if(document.personalloan_form.Employment_Status.value==1)
	{
	if((document.personalloan_form.Company_Name.value=="") || (document.personalloan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.personalloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.personalloan_form.Company_Name.focus();
		return false;
	}
	else if(document.personalloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.personalloan_form.Company_Name.focus();
		return false;
	}
	}

		if (document.personalloan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.personalloan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.IncomeAmount, 'Annual Income',0))
		return false;

	if (document.personalloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";	
		document.personalloan_form.City.focus();
		return false;
	}
	if((document.personalloan_form.City.value=="Others") && ((document.personalloan_form.City_Other.value=="" || document.personalloan_form.City_Other.value=="Other City"  ) || !isNaN(document.personalloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City!</span>";		
		document.personalloan_form.City_Other.focus();
		return false;
	}
}