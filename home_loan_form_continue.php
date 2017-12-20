<?php //echo $_SESSION['Temp_LID']; 
$maxage=date('Y')-62;
$minage=date('Y')-18;
$City = $_SESSION['Temp_City'];
?>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>

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

if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
			
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
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
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propLocVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}

if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	

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

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Location</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Property_Loc" id="Property_Loc" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select></div><div id="propLocVal"></div></div>';
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '';
			
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

<form name="loan_form" method="post" action="home_loan_form_thank.php" onSubmit="return chkform();">
<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $_SESSION['Temp_LID']; ?>" />
<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
<input type="hidden" name="Phone" id="Phone" value="<?php echo $_SESSION['Temp_Phone']; ?>" />
<input type="hidden" name="City" id="City" value="<?php echo $_SESSION['Temp_City']; ?>" />
<input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $_SESSION['Temp_Net_Salary']; ?>" />	
<input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $_SESSION['Temp_Loan_Amount']; ?>" />
<input type="hidden" name="City_Other" id="City_Other" value="<?php echo $_SESSION['Temp_City_Other']; ?>" />
	<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <?php
            if((strlen(strpos($_SERVER['REQUEST_URI'], "sbi-home-loan-continue.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "lic-housing-home-loan-continue.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-lic-housing-continue.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "bankdeals-continue.php")) > 0))
{
}else
{
?>   <tr>
        <td height="35" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">

        <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><!--<div class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong>Apply <?php //echo $subjectLine; ?></strong></div> -->            <div class="text3" style=" color:#FFF; font-size:16px; text-transform:none; ">
            <strong><span style="color:#8dae48;">Step 2</span> - To Get Online quote from All Banks-Please Input further Details</strong>
           </div>
            </td>
            <td width="196" rowspan="2" valign="top">&nbsp;</td>
          </tr>
        
          </table></td>
      </tr>  <?php } ?>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="11" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; clear:right;">
                        <input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        <input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        	<input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />
                        </div>
                           <div id="dobVal"></div>   
                    </div>
                  </div></td>
                </tr>
              
               <tr>
                <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" style="width:180px; height:18px;" />
         <div id="pincodeVal"></div>
                    </div>
                </div></td>
              </tr>
               
            </table></td>
            <td width="58" align="left" valign="top">&nbsp;</td>
            <td width="185" align="left" valign="top"><table width="192" border="0" cellspacing="0" cellpadding="0">
   <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                 <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                           <option value="-1">Please Select</option>
                           <option value="1" <?php if($Employment_Status==1) echo "selected"; ?>>Salaried</option>
                           <option value="0" <?php if($Employment_Status==0) echo "selected"; ?>>Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div>
                    </div>
                </div></td>
              </tr>
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <input  name="property_value"  id="property_value" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" style="width:180px; height:18px;" onkeydown="validateDiv('propertyValueVal');"  />
         <div id="propertyValueVal"></div>   
                      </div>
                  </div></td>
                </tr>
              
              
            </table></td>
            <td width="50" align="left" valign="top">&nbsp;</td>
            <td width="186" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Monthly EMI for all loans:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  <input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" style="width:180px; height:18px;" />
      
                    </div>
                </div></td>
              </tr>          
            <tr>
                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">When you are planning to take loan: :</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                     <select name="Loan_Time" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">
                                                      <option value="-1" selected>Please select</option>
                                                      <option value="15 days">15 days</option>
                                                      <option value="1 month">1 months</option>
                                                      <option value="2 months">2 months</option>
                                                      <option value="3 months">3 months</option>
                                                      <option value="3 months above">more than 3 months</option>
                                                    </select>
        <div id="netSalaryVal"></div>   
                      </div>
                  </div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
            </table></td>
            <td width="56" align="left" valign="top">&nbsp;</td>
            <td width="214" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
               
              <tr>
                  <td height="58">
                 <div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:17px;">
                    <div style=" float:left; width:70px; height:auto; clear:right; ">Property Identified:</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                   <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" />
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                  <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" />
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
                     <div id="propEditifiedVal"></div>   
                  </div>
                </div></td>
                </tr> <tr>
                <td  id="myDiv1" >
          </td></tr>
                                
            </table></td>
          </tr>
           <tr>
            <td colspan="7" align="left" valign="top" ><div style="display:none; " id="divfaq1">
<div style=" float:left; width:881px; height:auto; margin-left:5px; margin-top:7px;">
  <div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:0px;">
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Co-applicant Name:</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
      <input name="co_name" id="co_name" type="text" style="width:180px; height:18px;" />
     
    </div>
  </div>
  <div style=" float:left; width:183px; height:44px; margin-left:55px; margin-top:0px;">
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Co-applicant DOB:</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
        <div class="text" style=" float:left; clear:right; padding-right:6px;">
          <input name="co_day" id="co_day" type="text" style="width:45px; height:18px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>
        </div>
        <div class="text" style=" float:left; clear:right; padding-right:6px;">
          <input name="co_month" id="co_month" type="text" style="width:45px; height:18px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
        </div>
        <div class="text" style=" float:left; clear:right;">
          <input name="co_year" id="co_year" type="text" style="width:66px; height:18px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
        </div>
        <div id="co_dobVal"></div>
      

    </div>
  </div>
  <div style=" float:left; width:183px; height:47px; margin-left:52px; margin-top:0px;" class="text" >
     <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Gross Annual Salary:</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
      
        <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" />
      </div>
      <div id="co_incomeVal"></div>   
      </div>
  
  
  <div style=" float:left; width:183px; height:47px; margin-left:35px; margin-top:0px;">
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Monthly EMIs :</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
    <input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" style="width:180px; height:18px;" />
    </div>
  </div>
</div>
</div>
<!-- End-->

       </td>
       </tr>
          <tr>
            <td height="40" colspan="9" align="left" valign="top">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="109"  height="44" align="left" valign="top" class="text" style=" float:left; height:auto; color:#FFF; font-size:11px; text-transform:none; clear:right; margin-top:7px; ">
                      <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >
                                Co - applicant
                </td>
                <td width="662" align="left" valign="top" style="padding-top:20px;">
                   <? /*if(($City!="Ahmedabad") && ($City!="Allahabad") && ($City!="Bangalore") && ($City!="Baroda") && ($City!="Bhubaneshwar") && ($City!="Chandigarh") && ($City!="Chennai") && ($City!="Cochin") && ($City!="Cuttack") && ($City!="Delhi") && ($City!="Faridabad") && ($City!="Gaziabad") && ($City!="Greater Noida") && ($City!="Gurgaon") && ($City!="Guwahati") && ($City!="Hyderabad") && ($City!="Indore") && ($City!="Jaipur") && ($City!="Kanpur") && ($City!="Kochi") && ($City!="Kolkata") && ($City!="Lucknow") && ($City!="Mumbai") && ($City!="Noida") && ($City!="Pune") && ($City!="Sahibabad") &&
($City!="Surat") && ($City!="Thane") && ($City!="Vadodara") && $City!="Vijaywada" && ($City!="Vishakapatanam") && ($City!="Vizag" ))  { */
	?>
	<!--<table  style="border:1px solid #FFFFFF; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " height="20"><u><b>Special service only for Deal4loans customers:</b></u></td></tr> <tr><td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " colspan="2"> You are now a step closer to selecting the right Loan Deal for yourself! All you need is a complete picture of all your finances from MyUniverse!. <br><b>30 days free trial of MyUniverse</b></td></tr> <tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="1" checked/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">Yes, Please register me in MyUniverse</td></tr><tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="2"/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">No, Thank you</td></tr>	 </table>-->
 <? //} ?>
               </td>
                <td width="120" align="right" valign="top"><div style=" float:right; width:114px; height:47px; margin-top:0px; clear:right; margin-left:0px;"> <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
              </tr>
            </table>
            </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>
 </form>