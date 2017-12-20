<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript">
function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
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

function retain(strPlan)
{
	if(document.loan_form.Email.value!="")
	{
	   if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
       return true;
	}
function Decoration(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decoration1(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var curr_dt = '';
	curr_dt = new Date().getFullYear();
	var maxage = curr_dt - 62;
	var minage = curr_dt - 18;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";
		document.loan_form.Loan_Amount.focus();
		return false;
	}
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}	
	if(document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}
					
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	
	if(document.loan_form.FName.value=="")
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.FName.focus();
		return false;
	}
	 if(document.loan_form.FName.value!="")
	{
	 if(containsdigit(document.loan_form.FName.value)==true)
	{
	   document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.FName.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.FName.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.FName.value.charAt(i)) != -1) {
  	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
	document.loan_form.FName.focus();

  	return false;
  	}
  }
	
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	
	if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}

if(document.loan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
		document.loan_form.Age.focus();
		return false;
	}
	

	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }
  
if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Company Name"))
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.loan_form.Company_Name.focus();
		return false;
	}
	else if(document.loan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.loan_form.Company_Name.focus();
		return false;
	}

	if (document.loan_form.Property_Value.value=="")
	{
		document.getElementById('propertyVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>";
		document.loan_form.Property_Value.focus();
		return false;
	}
	
	if (document.loan_form.Property_Type.value=="")
	{
		document.getElementById('propertyTypeVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>";
		document.loan_form.Property_Type.focus();
		return false;
	}	
		
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.loan_form.accept.focus();
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

function addSalaryText(empStat)
{
		var ni1 = document.getElementById('netSalText');
		
		if(empStat==1)
		{
	    	ni1.innerHTML = 'Net Salary (Yearly):';
		}
		else if(empStat==0)
		{
			ni1.innerHTML = 'Net Income (ITR):';
		}
		else
		{
			ni1.innerHTML = 'Net Salary/Income (Yearly/ITR):';
		}
		return true;
}	


function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	var txtview = '<table style="border:1px solid #FFF; color:#FFF; padding:2px;"><tr><td colspan="2" class="frmbldtxt" height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt"> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td> </tr> </table>';	
	hdfclifecamp(ni1,cit,txtview);
}

var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function insertData()

		{
			var get_full_name = document.getElementById('FName').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="3";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}
				}

				ajaxRequestMain.send(null); 
			 
		}

	window.onload = ajaxFunctionMain;


function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('other_Details');
	var ni5 = document.getElementById('imgDisplay');
	
	
	ni3.innerHTML = '<div style="margin-top:10px;"><div class="p-details"><strong>Personal Details</strong></div><div class="termtext"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div> <div style="clear:both;"></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr> <td  height="25"><span class="lap-form-text">Full Name:</span></td>  </tr><tr>    <td  height="25"><input name="FName" id="FName"  class="d4l-input" type="text" onKeyDown="validateDiv(\'nameVal\');" tabindex="5" autocomplete="off" /><div id="nameVal"></div></td>    </tr>    </table>    </div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="lap-form-text">Mobile:</td>  </tr><tr>       <td height="25">      <table width="100%"><tr><td class="lap-form-text">+91</td><td class="text" style=" padding-top:3px; text-transform:none;">                           <input type="text" class="d4l-input" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" onBlur="return Decorate1(\' \')" onFocus="addtooltip();" tabindex="6" onKeyDown="validateDiv(\'phoneVal\');" autocomplete="off" /><div id="phoneVal"></div> </td></tr></table>              </td>    </tr>        </table>    </div><div class="new-input-box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>      <td height="25" ><span class="lap-form-text">Email ID :</span></td>   </tr><tr>    <td height="25" >      <input type="text" name="Email" id="Email"   class="d4l-input"  tabindex="7" onKeyDown="validateDiv(\'emailVal\');" autocomplete="off" /> <div id="emailVal"></div> </td>    </tr>  </table></div>  <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="lap-form-text">Age:</td>   </tr><tr>    <td height="25" ><select onchange="validateDiv(\'AgeVal\');" class="d4l-select" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div> </td>    </tr>        </table>    </div>';
	var ni20 = document.getElementById('City').value;
	if(ni20=='Others')
	{
		ni1.innerHTML = '<div style="clear:both;"></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" class="lap-form-text">Other City:</td>  </tr><tr>    <td  height="25"> <input name="City_Other" id="City_Other" type="text" class="d4l-input" onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');" tabindex="10" autocomplete="off" /><div id="othercityVal"></div>  </td>    </tr>    </table>    </div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="lap-form-text">Company Name:</td>  </tr><tr><td height="25">  <input name="Company_Name" id="Company_Name" type="text"  class="d4l-input" onkeydown="validateDiv(\'companyNameVal\');" tabindex="12" autocomplete="off" /><div id="companyNameVal"></div></td>    </tr>    </table>    </div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="lap-form-text">Value of Property:</td></tr><tr><td height="25"><input name="Property_Value" id="Property_Value" maxlength="8" onkeypress="intOnly(this);"   type="text" onkeydown="validateDiv(\'propertyVal\');" tabindex="13" class="d4l-input" autocomplete="off" />     <div id="propertyVal"></div></td>    </tr>    </table>    </div><div class="new-input-box"><table width="100%"><tr><td class="lap-form-text">Property Type: </td></tr><tr><td><select name="Property_Type" id="Property_Type" class="d4l-select" onchange="validateDiv(\'propertyTypeVal\');" tabindex="12" /><option value="">Property Type</option><option value="1">Residential</option> <option value="2">Commercial</option> </select><div id="propertyTypeVal"></div></td></tr></table> </div><div style="clear:both;"></div><div class="lap_terms_box lap-form-text"><input type="checkbox"  name="accept" style="border:none;" tabindex="14"  checked="checked" > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="lap-form-text" style="text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style="text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div><div class="lap_bnt_b"><input type="submit" class="lap-get-quotebtn" value="Get Quote" tabindex="15"/></div><div style="clear:both;"></div><div ><div id="hdfclife"></div></div>';
	}
	else
	{
		ni1.innerHTML = '<div style="clear:both;"></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="lap-form-text">Company Name:</td>  </tr><tr><td height="25">  <input name="Company_Name" id="Company_Name" type="text"  class="d4l-input" onkeydown="validateDiv(\'companyNameVal\');" tabindex="12" autocomplete="off" /><div id="companyNameVal"></div></td>    </tr>    </table>    </div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="lap-form-text">Value of Property:</td></tr><tr><td height="25"><input name="Property_Value" id="Property_Value" maxlength="8" onkeypress="intOnly(this);"   type="text" class="d4l-input" onkeydown="validateDiv(\'propertyVal\');" tabindex="13" autocomplete="off" /> <div id="propertyVal"></div></td>    </tr> </table> </div><div class="new-input-box"><table width="100%"><tr><td class="lap-form-text">Property Type: </td></tr><tr><td><select name="Property_Type" id="Property_Type" class="d4l-select" onchange="validateDiv(\'propertyTypeVal\');" tabindex="12" /><option value="">Property Type</option><option value="1">Residential</option> <option value="2">Commercial</option> </select><div id="propertyTypeVal"></div></td></tr></table> </div><div style="clear:both;"></div><div class="lap_terms_box lap-form-text"><input type="checkbox"  name="accept" style="border:none;" tabindex="14"  checked="checked" > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style="text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="lap_bnt_b"><input type="submit" class="lap-get-quotebtn" value="Get Quote" tabindex="15"/></div><div style="clear:both;"></div><div ><div id="hdfclife"></div></div>';
		
	
	}
	
		ni5.innerHTML = '<img src="images/Loan-against-property-animatedtext.gif" style="width:100%; max-width:574px; width:23; margin-top:10px;" />';
}
</script>
<script>
function fornValidate()
{
	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	 if (document.loan_form.Employment_Status.value==0)
	{
		if (document.loan_form.Annual_Turnover.selectedIndex==0)
	{
		document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover to Continue!</span>";	
		document.loan_form.Annual_Turnover.focus();
		return false;
	}
	}
 if(document.loan_form.Employment_Status.value==1)
	{
	if((document.loan_form.Company_Name.value=="") || (document.personalloan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.loan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.loan_form.Company_Name.focus();
		return false;
	}
	else if(document.loan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.loan_form.Company_Name.focus();
		return false;
	}
	}

		if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.IncomeAmount, 'Annual Income',0))
		return false;

	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
}
</script>

<div class="lap-form-wrapper">
  <form name="loan_form" method="post" action="apply-loan-against-property-continue.php" onSubmit="return chkform();">
    <input type="hidden" name="Activate" id="Activate" >
    <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
    <div style="clear:both;"></div>
    <h2 class="lap-h2"><?php echo $TagLine;?></h2>
    <div id="imgDisplay"><img src="images/Loan-against-property-animatedtext.gif" style="width:100%; max-width:574px; width:23; margin-top:10px;"  /></div>
    <div style="clear:both;"></div>
    <div class="p-details"><strong>Professional Details</strong></div>
    <div style="clear:both;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="lap-form-text">Loan Amount:</td>
        </tr>
        <tr>
          <td height="25"><input name="Loan_Amount" id="Loan_Amount" tabindex="1" type="text" class="d4l-input" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" autocomplete="off" />
            <div id="loanAmtVal"></div></td>
        </tr>
        <tr>
          <td  class="text"><span id='formatedlA'></span><span id='wordloanAmount'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="lap-form-text">Occupation:</td>
        </tr>
        <tr>
          <td height="25"><select   name="Employment_Status"  id="Employment_Status" class="d4l-select" tabindex="2"  onchange="addSalaryText(this.value); validateDiv('empStatusVal');" >
              <option value="-1">Employment Status</option>
              <option value="1">Salaried</option>
              <option value="0">Self Employment</option>
            </select>
            <div id="empStatusVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25"><span class="lap-form-text" id="netSalText">Net Salary/Income <span style="font-size:14px; color:#FFF;">(Yearly/ITR)</span>:</span></td>
        </tr>
        <tr>
          <td height="25"><input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" autocomplete="off" />
            <div id="netSalaryVal"></div></td>
        </tr>
        <tr>
          <td  class="formhlwpbody-text"><span id='formatedIncome'></span> <span id='wordIncome'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25"><span class="lap-form-text">City:</span></td>
        </tr>
        <tr>
          <td height="25" ><select name="City" id="City" class="d4l-select" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
              <?=plgetCityList($City)?>
              <option value="Vapi">Vapi</option>
              <option value="Ankleshwar">Ankleshwar</option>
              <option value="Anand">Anand</option>
              <option value="Anand">Dahod</option>
              <option value="Anand">Navsari</option>
            </select>
            <div id="cityVal"></div></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div id="other_Details">
      <div style="height:15px;"></div>
      <div class="lap_terms_box">
<input type="checkbox"  name="accept" style="border:none;"  checked="checked" >
        I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Terms and Conditions</a>.</div>
      <div class="lap_bnt_b" style="margin-top:6px;">
        <input type="button" class="lap-get-quotebtn" value="Get Quote" onclick="return fornValidate(); "/>
      </div>
      <div style="height:15px;"></div>
    </div>
    <div style="clear:both;"></div>
    <div id="personalDetails"></div>
  </form>
</div>
<div style="clear:both;"></div>