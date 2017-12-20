<?php //echo $_SESSION['Temp_LID']; 
$maxage=date('Y')-62;
$minage=date('Y')-18;
$City = $_SESSION['Temp_City'];
?>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="scripts/common.js"></script>

<Script Language="JavaScript">
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkform()
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

if(document.loan_form_hl.day.value=="" || document.loan_form_hl.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form_hl.day.focus();
		return false;
	}
	if(document.loan_form_hl.day.value!="")
	{
		if((document.loan_form_hl.day.value<1) || (document.loan_form_hl.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form_hl.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form_hl.day, 'Day', 2))
		return false;
	
	if(document.loan_form_hl.month.value=="" || document.loan_form_hl.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form_hl.month.focus();
		return false;
	}
	if(document.loan_form_hl.month.value!="")
	{
		if((document.loan_form_hl.month.value<1) || (document.loan_form_hl.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form_hl.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form_hl.month, 'month', 2))
		return false;

	if(document.loan_form_hl.year.value=="" || document.loan_form_hl.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form_hl.year.focus();
		return false;
	}
	if(document.loan_form_hl.year.value!="")
	{
		if((document.loan_form_hl.year.value < "<?php echo $maxage;?>") || (document.loan_form_hl.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form_hl.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form_hl.year, 'Year', 4))
		return false;
			
	if (document.loan_form_hl.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form_hl.Pincode.focus();
		return false;
	}
	if (document.loan_form_hl.Pincode.value!="")
	{
		if(document.loan_form_hl.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form_hl.Pincode.focus();
			return false;
		}
	}

	if (document.loan_form_hl.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form_hl.Employment_Status.focus();
		return false;
	}

	for(j=0; j<document.loan_form_hl.Property_Identified.length; j++) 
	{
        if(document.loan_form_hl.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property identified or not!</span>";	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form_hl.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propLocVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form_hl.Property_Loc.focus();
			return false;
		}
	}

if(!document.loan_form_hl.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	

		document.loan_form_hl.accept.focus();
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

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function addIdentified()
{
	var ni = document.getElementById('myDiv1');
	var ni1 = document.getElementById('myDiv2');
	ni.innerHTML = 'Property Location';
	ni1.innerHTML = '<select name="Property_Loc" id="Property_Loc" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select><div id="propLocVal"></div>';
	return true;
}	
	
function removeIdentified()
{
	var ni = document.getElementById('myDiv1');
	var ni1 = document.getElementById('myDiv2');
	ni.innerHTML = '';
	ni1.innerHTML = '';		
		return true;

}	

 function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
</script>
<form name="loan_form_hl" method="post" action="home_loan_form_thank.php" onSubmit="return chkform();">
<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $_SESSION['Temp_LID']; ?>" />
<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
<input type="hidden" name="Phone" id="Phone" value="<?php echo $_SESSION['Temp_Phone']; ?>" />
<input type="hidden" name="City" id="City" value="<?php echo $_SESSION['Temp_City']; ?>" />
<input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $_SESSION['Temp_Net_Salary']; ?>" />	
<input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $_SESSION['Temp_Loan_Amount']; ?>" />
<input type="hidden" name="City_Other" id="City_Other" value="<?php echo $_SESSION['Temp_City_Other']; ?>" />
   <div class="hli_form_box_continue">
     <div class="hli_input_section">
       
       <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">DOB:</span>          <div id="nameVal"></div>  </td>
        </tr>
      <tr>
        <td>

            
            <input name="day" type="text" class="hli_dd_contine" id="day" onfocus="onFocusBlank(this,'dd');" onblur="onBlurDefault(this,'dd');" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" onkeyup="intOnly(this);" value="dd" maxlength="2" />&nbsp;
            
        
            <input name="month" type="text" class="hli_dd_contine" id="month"  onfocus="onFocusBlank(this,'mm');" onblur="onBlurDefault(this,'mm');" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" onkeyup="intOnly(this);" value="mm" maxlength="2" />&nbsp;
        
          
            <input name="year" type="text" class="hli_yy_contine" id="year" onfocus="onFocusBlank(this,'yyyy');" onblur="onBlurDefault(this,'yyyy');" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" onkeyup="intOnly(this);" value="yyyy" maxlength="4" />
            
            <div id="dobVal"></div>   
            </td>
      </tr>
      </table>
</div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></td>
         </tr>
       <tr>
         <td>   <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" class="hli_select_contine" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
            <div id="empStatusVal"></div></td>
       </tr>
       </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Monthly EMI for all loans:</span></td>
         </tr>
       <tr>
         <td><input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="hli_input_text_contine" /></td>
         </tr>
      </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td width="42%"><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Property Identified:</span></td>
         <td width="58%"><div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                   <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" />
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; color:#FFF; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                  <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" />
                    </div>
              <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; color:#FFF;"> No</div>
                     <div id="propEditifiedVal"></div>   
            </td>
         </tr>
         
     </table>
   </div>
   <div style="clear:both;"></div>
   <div class="hli_input_section" style="margin-top:5px;">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Pincode: </span>            </td>
      </tr>
      <tr>
        <td><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="hli_input_text_contine"/>
         <div id="pincodeVal"></div></td>
      </tr>
      </table>
  </div>
  <div class="hli_input_section" style="margin-top:5px;">
    <table width="99%" border="0" cellspacing="5">
      <tr>
        <td><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</span></td>
      </tr>
      <tr>
        <td> <input  name="property_value"  id="property_value" maxlength="10"   onkeyup="intOnly(this);" class="hli_input_text_contine"  onkeypress="intOnly(this);" type="text" onkeydown="validateDiv('propertyValueVal');"  />
         <div id="propertyValueVal"></div>  </td>
      </tr>
    </table>
  </div>
  
  <div class="hli_input_section" style="margin-top:5px;">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">When you are planning to take loan:</span></td>
      </tr>
      <tr>
        <td> <select name="Loan_Time" class="hli_select_contine" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">
                                                      <option value="-1" selected>Please select</option>
                                                      <option value="15 days">15 days</option>
                                                      <option value="1 month">1 months</option>
                                                      <option value="2 months">2 months</option>
                                                      <option value="3 months">3 months</option>
                                                      <option value="3 months above">more than 3 months</option>
                                                    </select>
        <div id="netSalaryVal"></div></td>
      </tr>
      </table>
  </div>
  <div class="hli_input_section" style="margin-top:5px;">
    <table width="99%" border="0" cellspacing="5">
      <tr>
        <td id="myDiv1" class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"></td>
      </tr>
      <tr>
        <td id="myDiv2">  </td>
      </tr>
    </table>
  </div>
  
  <div style="clear:both;"></div>
   <div style="display:none; " id="divfaq1">
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Co-applicant Name:</span></td>
       </tr>
       <tr>
         <td><input name="co_name" id="co_name" type="text" class="hli_input_text_contine" /></td>
       </tr>
     </table>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Co-applicant DOB:</span></td>
       </tr>
       <tr>
         <td><input name="co_day" id="co_day" type="text" class="hli_dd_contine" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>
         <input name="co_month" id="co_month" type="text" class="hli_dd_contine" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
         <input name="co_year" id="co_year" type="text" class="hli_yy_contine" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />   <div id="co_dobVal"></div></td>
       </tr>
     </table>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Gross Annual Salary:</span></td>
       </tr>
       <tr>
         <td>  <input type="text" name="co_monthly_income" id="co_monthly_income"  class="hli_input_text_contine"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" /></td>
       </tr>
     </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Monthly EMIs :</span></td>
       </tr>
       <tr>
         <td>  <input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" class="hli_input_text_contine" /></td>
       </tr>
     </table>
   </div>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;"> <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >
                                Co - applicant</td>
       </tr>
       </table>
   </div>

   <div class="getquote_btn"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; " value=""/></div>
</div>
  </form>