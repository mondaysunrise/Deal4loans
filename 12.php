<style type="text/css">
#footermain {width:100%; height:58px; position:fixed; bottom:0%; left:0%;}
#footerdiv_id {border-top: 1px solid #a0a0a0; background-color:#21405F; overflow:none; width:100%; height:58px; position:fixed; bottom:0%; left:0%;}
#footerhide{position: absolute;bottom: 58px;right: 5px;width: 30px; height: 15px;cursor:pointer; background-color:#21405F;padding-top:5px;border-top: 1px solid #a0a09e; border-left: 3px solid #a0a09e; border-right: 3px solid #a0a09e; border-top-right-radius:5px;border-top-left-radius:5px;}
#footershow{position: absolute;bottom: 0px;right: 5px;width: 30px;height: 15px;cursor:pointer;background-color:#21405F; padding-top:5px;border-top: 1px solid #a0a09e; border-left: 1px solid #a0a09e; border-right: 1px solid #a0a09e; border-top-right-radius:5px;border-top-left-radius:5px;}
.footerdownarrow {width: 0; height: 0; border-left: 7px solid transparent;border-right: 7px solid transparent; border-top: 7px solid #88a943;}

.footeruparrow {width: 0; height: 0; border-left: 7px solid transparent;border-right: 7px solid transparent; border-bottom: 7px solid #88a943;}
.footerblockarrow {width: 6px; height: 7px; background-color: #88a943;}
</style>
<script  type="text/javascript">
function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function validmobile(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.mobile, 'Mobile number', 10))
		return false;

return true;
}
function chkformR()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


	if(document.loan_form.fullname.value=="")
	{
		document.getElementById('nameRVal').innerHTML = "<span  class='hintanchorqa'>Fill Your Name.</span>";	
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
			document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
            alert("Enter numeric value");
			  document.loan_form.mobile.focus();
			  return false;  
		}
        if (document.loan_form.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.mobile.focus();
				return false;
        }
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8") && (document.loan_form.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.loan_form.mobile.focus();
                return false;
		}
	if(document.loan_form.email_id.value=="")
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter  Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	var str=document.loan_form.email_id.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	if (document.loan_form.city.selectedIndex==0)
	{
		document.getElementById('cityRVal').innerHTML = "<span class='hintanchorqa'>Please Select City!</span>";
		document.loan_form.city.focus();
		return false;
	}
	if(document.loan_form.net_salary.value=="")
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill your Net salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill Your Net Salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
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
</script>
<div id="footermain" >
<center id="footershow" onmouseup="document.getElementById('footerdiv_id').style.display='block'"><div class="footeruparrow"></div><div class="footerblockarrow"></div></center>
<div id="footerdiv_id" >
<center id="footerhide" onmouseup="document.getElementById('footerdiv_id').style.display='none'"><div class="footerblockarrow"></div><div class="footerdownarrow"></div></center>
<form name="loan_form" method="post" action="Right.php" onsubmit="return chkformR();">
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" >
<tr>
	<td align="center" valign="top" bgcolor="#21405F" ><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="95" align="left" valign="top" class="text" style="  color:#FFF; font-size:17px; ">Get<br>Quote</td>
	<td  align="right" valign="top" width="838">
		<table width="838" border="0" cellpadding="0" cellspacing="3">
<tr>
<td class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" />
<input type="hidden" name="Type_Loan" value="Req_Loan_Home" />
Name </td><td class="text" style="  color:#FFF; font-size:11px;  " height="23"> <input name="fullname" id="fullname" type="text" style="width:105px; height:14px;" onkeydown="validateDiv('nameRVal');" tabindex="2" />
<div id="nameRVal"></div>   
</td>
<td class="text" style="  color:#FFF; font-size:11px;  " height="23">Mobile </td><td class="text" style="  color:#FFF; font-size:11px;  " height="23">
+91 
<input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:92px; height:14px;" onkeydown="validateDiv('phoneRVal');" tabindex="3"  />
<div id="phoneRVal"></div>   
</td>
<td class="text" style="  color:#FFF; font-size:11px;  " height="23">Email </td><td class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="email_id" id="email_id" type="text" style="width:105px; height:14px;" onkeydown="validateDiv('emailRVal');" tabindex="4" />
<div id="emailRVal"></div>   
</td>
<td class="text" style="  color:#FFF; font-size:11px;  " height="23">City </td><td class="text" style="  color:#FFF; font-size:11px;  " height="23">
<select name="city" id="city" style=" height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:110px;" onchange="validateDiv('cityRVal');" tabindex="5" >
<?=plgetCityList($City)?>
</select>
<div id="cityRVal"></div>   
</td>
<td class="text" style="  color:#FFF; font-size:11px;  " height="23">Net Salary</td><td class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="net_salary" id="net_salary" type="text" style="width:105px; height:14px;" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('netSalaryRVal');" tabindex="6"  />
<div id="netSalaryRVal"></div>   
</td>
</tr>
<tr>
<td align="right" valign="top" colspan="9" class="text9" style=" color:#FFF; font-size:10px; margin-top:0px; ">
  <input name="accept" type="checkbox" checked="checked"  tabindex="7"/>  
     I Agree to&nbsp;privacy policy and&nbsp;Terms &amp; Conditions.
     <div id="acceptRVal"></div></td><td  align="center" valign="top"  style= "margin-left:0px;"><input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/>
</td>
</tr>

</table>
        </td>
       <!-- <td align="right" valign="top"> <a href='#' class='close_notification' title='Click to Close'><img src="new-images/12-em-cross.png" width="12" height="12" alt="Close" onClick="hide('hideme')" border="0" /></a></td> -->
</tr>

</table></td>
</tr>
</table>
</form>
</div>
</div>
