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

 if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		document.getElementById('productRVal').innerHTML = "<span  class='hintanchorqa'>Select Product</span>";	
		document.loan_form.Type_Loan.focus();
		return false;
	}
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

<div style="float:right; clear:right; background-color:#dde4e9; width:300px;  margin-top:5px;">
<div class="text3" style="width:300px; margin:auto; height:auto; font-size:11px; color:#88a943; margin-top:0px;">
<table align="center">
<tr><td align="center" style="color:#000000;"><div id="smpl_rslt" style="size:16px; margin-bottom:2px; font-weight:bold;"><span >Sample Results</span></div></td></tr>
<tr>
<td align="left"><div id="tblpaymentsDetails" align="center" style="color:#000000;"><table align="center" cellpadding="0" cellspacing="0" width="300">
  <tr>
  <td align="left">
 <table id='pmtTab' style='clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; ' width="300">  <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='numHead'>Year</td>
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='oldBal'>Principal</td>
      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='pt'>Interest</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'id='oil' >Balance Amount</td>
    </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">1</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 31,083</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 208,533</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 1,968,917</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">2</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 34,509</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 205,107</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 1,934,408</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">3</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 38,311</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 201,305</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 1,896,097</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">4</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 42,537</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 197,079</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,853,560</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">5</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 47,221</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 192,395</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,806,339</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">6</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 52,426</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 187,190</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,753,913</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">7</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 58,203</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 181,413</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,695,710</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">8</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 64,618</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 174,998</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,631,092</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">9</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 71,740</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 167,876</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,559,352</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">10</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 79,644</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 159,972</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,479,708</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">11</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 88,422</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 151,194</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,391,286</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">12</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 98,165</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 141,451</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,293,121</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">13</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 108,983</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 130,633</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,184,138</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">14</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 120,994</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 118,622</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,063,144</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">15</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 134,327</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 105,289</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 928,817</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">16</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 149,132</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 90,484</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 779,685</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">17</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 165,567</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 74,049</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 614,118</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">18</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 183,812</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 55,804</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 430,306</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">19</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 204,069</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 35,547</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 226,237</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">20</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 226,407</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 13,056</td>
   <td height="18" align="center" width="64"  class="default_td">Rs. 0</td>
  </tr>
  </table>
  </td></tr></table></div></td>
</tr>

</table>
<div class="emi_aply_block">
<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkformR();">
<table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td height="10" align="center" valign="top"><img src="images/bgtopr.jpg" width="270" height="10" /></td>
</tr>
<tr>
	<td align="left" valign="top" ><table border="0" cellpadding="0" cellspacing="0" >
<tr>
	
	<td  align="left" valign="top" width="270" bgcolor="#21405F">
		<div class="emi_aply_block"><table width="270" border="0" cellpadding="0" cellspacing="3" align="center">
		<tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:18px;  text-align:center; ">
				<strong>Apply Here</strong>			</td>
		</tr>
	<tr>
	<td width="99"  height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
		Product</td>
	<td width="161"  class="text" style="  color:#FFF; font-size:11px;  ">
		
		<select name="Type_Loan" id="Type_Loan"  onchange="validateDiv('productRVal');"  style=" height:20px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:150px;" tabindex="1" >
			<option value="1">Please select</option>
			<option value="Req_Loan_Personal">Personal Loan</option>
			<option value="Req_Loan_Home">Home Loan</option>
			<option value="Req_Loan_Car">Car loan</option>
			<option value="Req_Loan_Against_Property">Loan against Property</option>
			<option value="Req_Credit_Card">Credit Card</option>
			<option value="Req_Loan_Education">Education Loan</option>
			<option value="Req_Loan_Gold">Gold Loan</option>
		</select>
	<div id="productRVal"></div>
	</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
<input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" />
Full Name</td><td width="161" class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="fullname" id="fullname" type="text" style="width:145px; height:14px;" onKeyDown="validateDiv('nameRVal');" tabindex="2" />
<div id="nameRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Mobile</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
+91 
<input name="mobile" id="mobile" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:122px; height:14px;" onKeyDown="validateDiv('phoneRVal');" tabindex="3"  />
<div id="phoneRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Email ID </td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<input name="email_id" id="email_id" type="text" style="width:145px; height:14px;" onKeyDown="validateDiv('emailRVal');" tabindex="4" />
<div id="emailRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<select name="city" id="city" style=" height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:150px;" onChange="validateDiv('cityRVal');" tabindex="5" >
<?=plgetCityList($City)?>
</select>
<div id="cityRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Net Salary (Yearly)</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
<input name="net_salary" id="net_salary" type="text" style="width:145px; height:14px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" onKeyDown="validateDiv('netSalaryRVal');" tabindex="6"  />
<div id="netSalaryRVal"></div>   
</td>
</tr>
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; ">
  <input name="accept" type="checkbox" checked="checked"  tabindex="7"/>  
     I Agree to&nbsp;<a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">privacy policy</a> and&nbsp; <a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">Terms and Conditions</a>.
     <div id="acceptRVal"></div>
</td>
</tr>
<tr>
<td>&nbsp;</td><td  align="center" valign="top"  style= "margin-left:0px;">
<input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/>
</td>
</tr> 
</table>
        </td>
</tr>

</table></td>
</tr>
<tr>
<td height="15" align="center" valign="top"><img src="images/bgbottomr.jpg" width="270" height="10" /></td>
</tr>
</table>
</form></div>


</div>
<div class="emi_aply_block">
<div  align="center"><a href="https://play.google.com/store/apps/details?id=d4l.emicalc.com" target="_blank" rel="nofollow" style="text-decoration:none;"><img src="images/andro36x36.gif" name="Image3" width="33" height="33" border="0" />&nbsp;<img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" /></a></div>
<div style="width:270px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:3px; background-color:#f4f4f4;">
<div style="clear:both; height:5px;"></div>
<div class="text3" style="width:230px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:2px;"><strong>Personal Loan Rate of Interest</strong></div>
<div class="text11" style="width:225px; margin:auto; height:auto;  color:#4c4c4c; margin-top:1px; text-align:left;">( Last updated on <?php echo date('d F Y'); ?> )</div>
<div style="clear:both; height:5px;"></div>
<table border="0" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1" align="center" width="100%">
                <tr>
                  <td width="56" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Bank<br>
                      <img src="images/spacer.gif" width="48" height="8" border="0"></td>
                  <td width="64" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Rate <br />
                  of Interest</td>
                  <td width="48" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Processing<br />
                    Fee</td>
                  <td width="50" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
				<? $getplrates=("Select cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1)");
 list($recordcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
$cntr=0;
while($cntr<count($plrow))
        {
?>
  <tr>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
                  				

                  <a href="<? echo $plrow[$cntr]["bank_url"]; ?>" style="color:#335599;"><? echo $plrow[$cntr]["bank_name"]; ?></a>
                  
                 
                  </td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$cntr]["cat_a"]."-".$plrow[$cntr]["others"]; ?><br /></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$cntr]["processing_fee"]; ?></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
				 
	
			 <a href="<? echo $plrow[$cntr]["bank_url"]; ?>" target="_blank" style="color:#335599;">APPLY</a>
				</td>
      </tr>


<?  $cntr=$cntr+1; }?>
    </table>

<div style="clear:both; height:3px;"></div>

<div style="clear:both; height:5px;"></div>
<div style="width:270px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:2px; background-color:#f4f4f4;">
<div style="clear:both; height:5px;"></div>
<div class="text3" style="width:230px; margin:auto; height:auto; font-size:14px; color:#88a943; margin-top:2px;"><strong>Home Loan Rate of Interest</strong></div>
<div class="text11" style="width:225px; margin:auto; height:auto;  color:#4c4c4c; margin-top:px; text-align:left;">( Last updated on <?php echo date('d F Y'); ?> )</div>
<div style="clear:both; height:3px;"></div>
<table border="0" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
                <tr>
                  <td width="56" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Bank<br>
<img src="images/spacer.gif" width="48" height="1" border="0"></td>
                  <td width="70" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Rate <br />
                    of Interest</td>
                  <td width="47" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Prepayment<br>
                    charges</td>
                  <td width="56" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
				<? $gethlrates=("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (203,3,8,5) and flag=1)");
	
	list($recordhlcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
$k=0;
while($k<count($hlrow))
        {
	
	
	?>
	 <tr>
			  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
              	
              <a href="<?  echo $hlrow[$k]['bank_url'];?>" style="color:#335599;"><? echo $hlrow[$k]["bank_name"]; ?></a>
            
              </td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $hlrow[$k]["ndtv_rates"]; ?></td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">Nil</td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
				
			
		<a href="<?  echo $hlrow[$k]['bank_url'];?>" target="_blank" style="color:#335599;">APPLY</a>

		  </td></tr>
                
	<? $k  =$k +1;}?>
      </table></div>

</div>
<div style="clear:both; height:5px; background-color:#dde4e9;"></div>
<div align="center"> 
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 10/26/09 */
google_ad_slot = "1962172606";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</div>
<br />
</div>
