 <link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />

<Script Language="JavaScript">
function cityother() { 	if(document. creditcard_form.City.value=="Others")	{	Form.City_Other.disabled = false;	}	else	{		Form.City_Other.disabled = true;	} } 

function ckhcreditcard(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var cnt=-1;

	if((Form.resiaddress1.value=="") || Form.resiaddress1.value=="Line 1" || (Trim(Form.resiaddress1.value))==false)
	{
        document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Residence Address</span>";		
		Form.resiaddress1.focus();
		return false;
	}
	if((Form.pincode.value==""))
	{
        document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Enter Pincode</span>";		
		Form.pincode.focus();
		return false;
	}
	
	if((Form.pincode.value.length<6))
	{
       
	    document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Pincode length should be six character</span>";		
		Form.pincode.focus();
		return false;
	}
	
	
	var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	 	document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";	
		 Form.panno.focus();
		 return false;
	}
	if (Form.panno.value.charAt(3)!="P" && Form.panno.value.charAt(3)!="p")
	{
			document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";	
			Form.panno.focus();
			return false;
	}
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		Form.City.focus();
		return false;
	}
	if (Form.State.selectedIndex==0)
	{
		document.getElementById('stateVal').innerHTML = "<span  class='hintanchor'>Enter State to Continue!</span>";	
		Form.State.focus();
		return false;
	}	
	
	if((Form.panno.value==""))
	{
        document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please Enter Pan Card Number</span>";		
		Form.panno.focus();
		return false;
	}
	
	for(j=0; j<Form.Gender.length; j++) 
	{
        if(Form.Gender[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
			document.getElementById('genderVal').innerHTML = "<span  class='hintanchor'>Select Gender!</span>";	
		return false;
	}
	
}
function validateDiv(div)
{	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}

</script>
<div class="cc-form-wrapper">
  <div class="cc_terms_box">
    <h2 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong><? //echo $subjectLine;?></strong></h2>
  </div>
  <div class="animmated-margin" id="getImageScroll"> <img src="images/credit-card-animatedtext.gif"  style="width:100%; max-width:574px;  margin-bottom:7px;" height="23" /></div>
  <div style="clear:both;"></div>
  <form  name="creditcard_form" id="creditcard_form" action="credit-card-thank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
      <input type="hidden" name="RequestID" value="<? echo $rqid; ?>">
    <div style="clear:both;"></div>
    <div class="p-details"><strong>Personal Details</strong></div>
    <div style="clear:both;"></div>
    
    <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="cc-form-text">Residential address <span class="red">*</span></td>
          </tr>
          <tr>
<td height="25"><input name="resiaddress1" type="text" class="d4l-input" value="Line 1"
       onfocus="(this.value == 'Line 1') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Line 1')"   onkeydown="validateDiv('resiaddressVal');" maxlength="40" />
            </td>
          </tr>
        </table>
		 <div id="resiaddressVal"></div>
    </div>
          <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="cc-form-text">Residence Pincode <span class="red">*</span></td>
          </tr>
          <tr>
            <td height="25"><input type="text" name="pincode" id="pincode" class="d4l-input" onkeydown="validateDiv('pincodeVal');" maxlength="6"/>
              <div id="pincodeVal"></div></td>
          </tr>
        </table>
    </div>
    
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text"> Pan Card <span class="red">*</span></td>
        </tr>
        <tr>
          <td height="25"><input type="text" class="d4l-input" name="panno" id="panno" onkeydown="validateDiv('pannoVal');"  maxlength="10"/><div id="pannoVal"></div></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Residential address </td>
        </tr>
        <tr>
          <td height="25"><input name="resiaddress2" type="text" class="d4l-input" value="Line 2"
       onfocus="(this.value == 'Line 2') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Line 2')" maxlength="40" /></td>
        </tr>
      </table>
    </div>
    
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Residence City</td>
        </tr>
        <tr>
          <td height="25"><select name="City" id="City" class="d4l-select" style="height:24px;" onchange="validateDiv('cityVal');" tabindex="7">
              <?=plgetCityList($City)?>
            </select>
			<div id="cityVal"></div>
			
		  </td>
        </tr>
        <tr>
          <td height="15"></td>
        </tr>
      </table>
    </div>
    <div id="addSubmit">
    <? if(strlen($ccrow["City_Other"])>0) 
			{ ?>
      <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text"> Other CIty </td>
        </tr>
        <tr>
          <td height="25" class="cc-form-text">
			<input type="text" class="d4l-input" name="City_Other" id="City_Other" onkeydown="validateDiv('CityOtherVal');" value="<? echo $ccrow["City_Other"]; ?>" /><div id="CityOtherVal"></div>
			        
            </td>
        </tr>
      </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
        </table>
           </div><? } ?>   </div>
    
      <div style="clear:both;">    </div>
       
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Residential address </td>
        </tr>
        <tr>
          <td height="25"><input name="resiaddress3" type="text" class="d4l-input" value="Line 3"
       onfocus="(this.value == 'Line 3') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Line 3')" maxlength="40" /></td>
        </tr>
      </table>
<div id="resiaddressVal"></div>     
    </div>
    <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="cc-form-text">Residence State</td>
          </tr>
          <tr>
            <td height="25"><select name="State" id="State" class="d4l-select" style="height:24px;" onchange="validateDiv('stateVal');" tabindex="7">
              <?=getStateList($State)?>
            </select>
              <div id="stateVal"></div></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
        </table>
       
    </div>
    <div id="addSubmit">
      <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text"> Gender </td>
        </tr>
        <tr>
          <td height="25" class="cc-form-text"><input type="radio" name="Gender" id="Gender" value="Male" onchange="validateDiv('genderVal');" />
            Male 
              <input type="radio" name="Gender" id="Gender" value="Female" onchange="validateDiv('genderVal');" /> 
              Female
              <div id="dialog-modal" > </div>
			  <div id="genderVal"></div>            
            </td>
        </tr>
      </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
        </table>
           </div></div>
           <div class="new-input-box">
        <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text" style="float:right !important;"><input type="submit" class="cc-get-quotebtn" value="Get Quote"/>
            </td>
        </tr>
      </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
        </table>
           </div>
                  
    <div style="clear:both;"></div><div class="cc_bnt_b"> </div> <div style="clear:both;"><div style="clear:both;"></div></div>
  </form> 
</div>
 <div style="clear:both; height:10px;"></div>