 $(function() {
$( "#salary_account" )
.change(function() {
var count= $("#salary_account :selected").length;
$( "#salAccountVal" ).text( count + " Options selected" );
});

});

function cityother() { 	if(document. creditcard_form.City.value=="Others")	{	document.creditcard_form.City_Other.disabled = false;	}	else	{		document.creditcard_form.City_Other.disabled = true;	} } 

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
		
	if(document.creditcard_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Select Age!</span>";	
		document.creditcard_form.Age.focus();
		return false;
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
{	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}


function addElement()
{
	var ni = document.getElementById('myDiv');
	var niicici = document.getElementById('icici_rqdfield');
	var cit = document.creditcard_form.City.value;
	var sal = document.creditcard_form.Net_Salary.value;
		
	ni.innerHTML = '<div class="new-input-box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr>      <td height="25" class="cc-form-text">Bank Name :</td>    </tr>    <tr>      <td height="25"><select size="1" name="No_of_Banks" id="No_of_Banks" class="d4l-select"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="RBL Bank">RBL Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select><div id="ccbnknmeVal"></div>  </td>    </tr></table></div>';

	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
	{
		niicici.innerHTML='<div class="new-input-box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Card Vintage :</td></tr><tr><td height="25"><select size="1" name="Card_Vintage" class="d4l-select" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="ccvintageVal"></div></td>    </tr></table></div><div class="new-input-box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Credit Limit :</td></tr><tr><td height="25">  <select size="1" name="Credit_Limit" id="Credit_Limit" class="d4l-select" onchange="validateDiv(\'cclimitVal\');" ><option value="0">Please select</option><option value="1">Upto 75,000</option><option value="2">75,000 to 1,50,000 </option><option value="3">1,50,000 & Above</option></select><div id="cclimitVal"></div></td></tr></table></div>';
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
	var txtview= '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	hdfclifecamp(ni1,cit,txtview);	
}

function addothercity()
{	
	var ni = document.getElementById('Othercity');
	var cit = document.creditcard_form.City.value;
	if(cit=="Others")
	{
		ni.innerHTML ='<input name="City_Other" id="City_Other" type="text" class="d4l-input"  onKeyUp="searchSuggest();" placeholder="Other City" onkeydown="validateDiv(\'othercityVal\');"  />					    <div id="othercityVal">';
	}
	else
	{
		ni.innerHTML ='';
	}
}
function addloanElement()
{
	var niloan= document.getElementById('addloandt');

niloan.innerHTML='<div class="new-input-box" style="width:210px !important;"><table border="0" width="98%"><tr><td height="25" colspan="2"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Type of Existing loan ? :</span></td></tr><tr><tr><td class="text" style="color:#FFF; font-size:11px;" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" value="hl" >Home</td>				<td class="text" style="color:#FFF; font-size:11px;" ><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" >Personal</td></tr>		<tr>				<td class="text" style="color:#FFF; font-size:11px;" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" >Car</td>				<td class="text" style="color:#FFF; font-size:11px;"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" >Property</td></tr>			<tr>				<td class="text" style="color:#FFF; font-size:12px;" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other" >Other</td><td class="text" style="color:#FFF; font-size:11px;"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="cdl">Consumer Durable</td>			</tr> 		</table><div id="Loan_Any"></div></div><div class="new-input-box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bank of Existing Loan? :</span>&nbsp;<a href="#" class="tooltiploan"> <img src="/images/questionmark-tooltip.png" width="16" height="16" border="0" /><span> Select multiple Banks if more than one Existing Loan.</span></a></td></tr><tr><td height="25"><select name="loanbank_name[]" id="loanbank_name" style="width:210px; height:40px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange=" validateDiv(\'loanbnkVal\');"  multiple><option name="">Please Select</option>				  <option value="HDFC Bank">HDFC Bank</option>				  <option value="ICICI Bank">ICICI Bank</option>				  <option value="IndusInd Bank">IndusInd Bank</option>				  <option value="Kotak Bank">Kotak Bank</option>			  <option value="RBL Bank">RBL Bank</option>	  <option value="Standard Chartered">Standard Chartered</option>				  <option value="Others">Others</option></select><div id="loanbnkVal" style="font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#fd4c1d;"></div></td></tr></table></div><div style="clear:both;  height:10px;"></div>';

}

function removeloanElement()
{
	var niloan= document.getElementById('addloandt');

	niloan.innerHTML='';
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	ni5.innerHTML ='<img src="/images/credit-card-animatedtext.gif"  style="width:100%; max-width:574px;  margin-bottom:7px;" height="23" />';
if(document.creditcard_form.Employment_Status.value==0)
	{
		ni1.innerHTML='<div class="p-details"><div><strong>Personal Details</strong></div><div class="termtext"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div> <div style="clear:both;"></div><div class="new-input-box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Full Name :</td></tr><tr><td height="25"> <input name="Full_Name" id="Full_Name" type="text" class="d4l-input" onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>     </td></tr></table></div><div class="new-input-box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Mobile :</td></tr><tr><td height="25"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input"  onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table></div><div class="new-input-box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Email :</td></tr><tr><td height="25">  <input name="Email" id="Email" type="text" class="d4l-input"  onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="new-input-box" style="padding-right:15px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Age:</td></tr><tr><td height="25" > <select onkeydown="validateDiv(\'AgeVal\');" class="d4l-select" name="Age" id="Age"> <option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option></select><div id="AgeVal"></div></td></tr></table></div><div style="clear:both;  height:10px;"></div><div class="new-input-box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Any Existing loan ?:</span></td></tr><tr><td height="25" style="color:#FFF">   <input type="radio" value="1" name="Loan_Any_sel" id="Loan_Any_sel" style="border:none;" onClick="addloanElement();"> Yes <input type="radio" value="2" name="Loan_Any_sel" id="Loan_Any_sel" style="border:none;" onClick="removeloanElement();">No<div id="LoanAnyselVal"></div>   </td></tr></table></div><div id="addloandt"></div><div class="new-input-box" style="padding-right:15px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Credit Card Holder? :</td></tr><tr><td height="25" class="cc-form-text">   <input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();">Yes<input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"> No<div id="ccholderVal"></div>   </td></tr></table></div><div style="clear:both;"></div><div id="myDiv"></div><div id="icici_rqdfield"></div><div style="clear:both; height:5px;"></div>';
	}
	else
	{

		ni1.innerHTML = '<div class="p-details"><div><strong>Personal Details</strong></div><div class="termtext"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div> <div style="clear:both;"></div><div class="new-input-box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Full Name :</td></tr><tr><td height="25"> <input name="Full_Name" id="Full_Name" type="text" class="d4l-input"  onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>     </td></tr></table></div><div class="new-input-box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Mobile :</td></tr><tr><td height="25"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table></div><div class="new-input-box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Email :</td></tr><tr><td height="25">  <input name="Email" id="Email" type="text" class="d4l-input"  onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="new-input-box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Age:</td></tr><tr><td height="25" ><select onkeydown="validateDiv(\'AgeVal\');" class="d4l-select" name="Age" id="Age"><option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><div id="AgeVal"></div>  </td></tr></table></div><div style="clear:both;"></div><div class="new-input-box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Company Name :</td></tr><tr><td height="25"> <input name="Company_Name" id="Company_Name" type="text" autocomplete="off" class="d4l-input" onkeydown="validateDiv(\'companyNameVal\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  value="Type Slowly for Autofill" onblur="onBlurDefault(this,\'Type Slowly for Autofill\');" onfocus="onFocusBlank(this,\'Type Slowly for Autofill\');"/><div id="companyNameVal"></div></td></tr></table></div><div class="new-input-box"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cc-form-text">Credit Card Holder? :</td></tr><tr><td height="25" class="cc-form-text" >   <input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();"> Yes <input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"> No <div id="ccholderVal"></div>   </td></tr></table></div><div style="clear:both;"></div><div id="myDiv"></div><div id="icici_rqdfield"></div><div style="clear:both;height:5px;"></div>';	
	
	}
	ni3.innerHTML = '<div style="clear:both;"></div><div class="p-details termtext">  <input name="accept" type="checkbox" checked="checked" />I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="/Privacy.php" target="_blank" rel="nofollow"   style=" color:#ffc017; text-decoration:underline;">Privacy policy</a> and <a href="/Privacy.php" target="_blank" rel="nofollow"  style=" color:#ffc017; text-decoration:underline;">Terms and Conditions</a>. <div id="acceptVal"></div></div><div class="cc_bnt_b"> <input type="submit" class="cc-get-quotebtn" value="Get Quote"/></div> <div style="clear:both;"></div> <div id="hdfclife"></div>                    <div style="clear:both;"></div>';
}

