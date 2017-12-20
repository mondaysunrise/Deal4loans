 <script  type="text/javascript">
 function validmail(email1) 
{
	invalidChars = " :,;/";
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
function chkform()
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
		alert("Please enter the type of loan you are looking for");
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.fullname.value=="")
	{
		alert("Please fill your name.");
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		alert("Please fill your mobile no.");
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
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
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 document.loan_form.mobile.focus();
                return false;
		}
/*	if(document.loan_form.mobile.value!="")
	{
		if (!validmobile(document.loan_form.mobile.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.mobile.focus();
			return false;
		}
	}
*/
	if(document.loan_form.email_id.value=="")
	{
		alert("Please fill your email id.");
		document.loan_form.email_id.focus();
		return false;
	}
	 if(document.loan_form.email_id.value!="")
	{
		if (!validmail(document.loan_form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.email_id.focus();
			return false;
		}
		
	
	}
	 if (document.loan_form.city.selectedIndex==0)
	{
		alert("Please Select City");
		document.loan_form.city.focus();
		return false;
	}
	if(document.loan_form.net_salary.value=="")
	{
		alert("Please fill your Net salary (Yearly).");
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		alert("Please fill your Net salary (Yearly).");
		document.loan_form.net_salary.focus();
		return false;
	}
	
	if(!document.loan_form.accept.checked)
	{
		alert("Accept the Terms and Condition");
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


function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.city.value=="Delhi" || document.loan_form.city.value=='Delhi' || document.loan_form.city.value=='Noida'  ||  document.loan_form.city.value=='Gurgaon'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Gaziabad'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Greater Noida'  || document.loan_form.city.value=='Chennai'  ||  document.loan_form.city.value=='Mumbai'  ||  document.loan_form.city.value=='Thane'  ||  document.loan_form.city.value=='Navi mumbai'  ||  document.loan_form.city.value=='Kolkata'  ||  document.loan_form.city.value=='Kolkota'  ||  document.loan_form.city.value=='Hyderabad'  ||  document.loan_form.city.value=='Pune'  || document.loan_form.city.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; color: #1C50B0;">Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.loan_form.city.value=="Delhi" || document.loan_form.city.value=='Delhi' || document.loan_form.city.value=='Noida'  ||  document.loan_form.city.value=='Gurgaon'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Gaziabad'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Greater Noida'  || document.loan_form.city.value=='Chennai'  ||  document.loan_form.city.value=='Mumbai'  ||  document.loan_form.city.value=='Thane'  ||  document.loan_form.city.value=='Navi mumbai'  ||  document.loan_form.city.value=='Kolkata'  ||  document.loan_form.city.value=='Kolkota'  ||  document.loan_form.city.value=='Hyderabad'  ||  document.loan_form.city.value=='Pune'  || document.loan_form.city.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; color: #1C50B0;" >Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}
</script>
<div style=" width:250px; float:right;">
<table width="250" border="0" cellpadding="0" cellspacing="0" id="bgclr">
    <tr>
      <td align="center" valign="middle" id="frmtp">
	  <? if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-standard-chartered-bank")) > 0)) 
	
		 {?>	 
	Apply for Standard Chartered 
	 <? 
	 }
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "sbi-home-loan")) > 0))
	 {?>
	Apply for SBI
	 <? 
	 }
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "lic-housing-home-loan")) > 0))
	{
	?>
	Apply for LIC Housing
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-ingvysya-bank")) > 0))
	{
	?>
	Apply for ING VYSYA Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "icici-hfc-home-loan")) > 0))
	{
	?>
	Apply for ICICI Bank Home Loan
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-idbi-homefinance")) > 0))
	{
	?>
	Apply for IDBI Home Finance
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "hdfc-bank-home-loan")) > 0))
	{
	?>
	Apply for HDFC Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "dhfl")) > 0))
	{
	?>
	Apply for DHFL
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "deutsche-bank-home-loan")) > 0))
	{
	?>
	Apply for Deutsche Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-axis-bank")) > 0))
	{
	?>
	Apply for Axis Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-citibank")) > 0))
	{
	?>
	Apply for Citibank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-idbi-bank")) > 0))
	{
	?>
	Apply for IDBI Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-reliance")) > 0))
	{
	?>
	Apply for Reliance
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-kotak-mahindra-bank")) > 0))
	{
	?>
	Apply for Kotak Mahindra Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-citifinancial")) > 0))
	{
	?>
	Apply for Citifinancial
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-icici-bank")) > 0))
	{
	?>
	Apply for ICICI Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-axis-bank")) > 0))
	{
	?>
	Apply for Axis Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-deutsche-bank")) > 0))
	{
	?>
	Apply for Deutsche Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-hsbc-bank")) > 0))
	{
	?>
	Apply for HSBC Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-ingvysya-bank")) > 0))
	{
	?>
	Apply for ING VYSYA Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-reliance")) > 0))
	{
	?>
	Apply for Reliance
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-abn-bank")) > 0))
	{
	?>
	Apply for ABN AMRO Bank
	<?
	}				
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-sbi")) > 0))
	{
	?>
	Apply for SBI Personal Loan
	<? 
	}  else 
	{?>
	  <div id="frmtpbg"></div>
	  <? 
	}
	?>	</td>
    </tr>
	  <tr>
	 <td valign="top" style="padding-top:10px;">
	 	<form name="loan_form" method="post" action="/Right.php" onsubmit="return chkform();">

		<table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
	 <tr>
	 
	   <td width="87" align="left" class="frmtxt">Product</td>
	     <td width="151" height="25" align="left">
	 <select style="width:137px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	   <option value="Req_Business_Loan">Business Loan</option>
	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" /></td>
		  </tr>
	 <tr>
	 <td align="left" class="frmtxt"> Name</td>
	 <td height="25" align="left" ><input type="text" name="fullname" style="width:133px;" maxlength="30" /></td>
	 </tr>
	<tr>
	 <td align="left" class="frmtxt">Mobile</td>
	 <td height="25" align="left" class="frmtxt">+91
	   <input type="text" style="width:105px;" maxlength="10" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" name="mobile" /></td>
	 </tr>
	 <tr>
	 <td align="left" class="frmtxt">Email id</td>
	 <td height="25" align="left" ><input type="text" name="email_id" style="width:131px;" /></td>
	 </tr>
	 <tr>
	 <td class="frmtxt">City</td>
	 <td height="25" align="left" ><select name="city" style="width:136px;" onchange="tataaig_comp();" >
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="frmtxt"  >Net Salary (Yearly)</td>
	 <td height="25" align="left" ><input type="text" name="net_salary"  onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" style="width:133px;" /></td>
	 </tr>	 <tr><td colspan="2"><div id="tataaig_compaign" name="tataaig_compaign"></div></td></tr>
	 <tr align="left">
	   <td height="45" colspan="2"> <input type="checkbox" name="accept" style="border:none;" checked>
I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a></td>
	   </tr>
	 <tr><td colspan="2" align="center"> <input type="submit" value="" class="qucksbtn" /> </td></tr>
	 </table>
	 </form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
  </table>

	</div>
<div style="float:right; width:250px; margin-top:10px;">
<?php
if(((strlen(strpos($_SERVER['SCRIPT_NAME'], "index.php")) == 0)))
{
?>
<div>
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
</script><br />
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
<?php
}
else
{

?>
<div id="tabvanilla" class="widget">

           <ul class="tabnav" style="padding-bottom:5px;">
           <li><a href="#recent">Home Loan</a></li>
           <li><a href="#popular">Personal Loan</a></li>
           </ul>

            <div id="recent" class="tabdiv" >
	<div style="background:url(new-images/rgt-tpimg.jpg); background-repeat:no-repeat; width:250px; height:41px; text-align:center; line-height:35px;"><b>Home Loan Interest Rates </b></div>
			<div style=" background:url(new-images/rgt-bg.gif); background-repeat:repeat-y; width:250px;">
			      <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<? $gethlrates=("Select ndtv_rates,bank_name From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (2,5,7,141))");
	 list($recordcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
		$cntr=0;
	
	while($cntr<count($hlrow))
        {
	?>
   
  <tr>
    <td width="60%" height="22"><? echo $hlrow[$cntr]["bank_name"]; ?></td>
    <td width="40%"><b><? echo $hlrow[$cntr]["ndtv_rates"]; ?></b></td>
    </tr>
  <tr>
    <td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
    </tr>
	<?php
	$cntr = $cntr+1;
	
	}
	?>
	 <tr>
	 <td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666;">T and C APPLY*</a></td>
    <td height="25" align="right" valign="bottom"><a href="home-loans-interest-rates.php">Know more...</a></td>
    </tr>
</table>
            </div>
<div style="background:url(new-images/bg-bt.jpg); background-repeat:no-repeat; width:250px; height:19px;"></div>
            </div><!--/recent-->
			
			<div id="popular" class="tabdiv">
			<div style="background:url(new-images/rgt-tpimg.jpg); background-repeat:no-repeat; width:250px; height:41px; text-align:center; line-height:35px;"><b>Personal Loan Interest Rates </b></div>
			<div style=" background:url(new-images/rgt-bg.gif); background-repeat:repeat-y; width:250px;">
      <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="56%" height="22">Citibank</td>
    <td width="44%"><b>16.50%-18.50%</b></td>
    </tr>
	 <tr>
    <td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
    </tr>
  <tr>
    <td height="22">Fullerton</td>
    <td><b>23%-28%</b></td>
    </tr>
	 <tr>
    <td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
    </tr>
  <tr>
    <td height="22">HDFC Bank </td>
    <td><b>14.50%-24%</b></td>
    </tr>
	 <tr>
    <td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
    </tr>
	 <tr>
	   <td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666;">T and C APPLY*</a></td>
	 <td height="25"  align="right" valign="bottom"><a href="personal-loan-interest-rate.php">Know more...</a></td>
    </tr>
</table>
            </div>
<div style="background:url(new-images/bg-bt.jpg); background-repeat:no-repeat; width:250px; height:19px;"></div>

            </div><!--/popular-->

         </div>
		 
<div align="center">
<span style="font-size:11px; color:#333333; width:240px; line-height:25px; text-align:center;">Advertisement</span>
<a href="https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=fuel&site=DEAL4LOANS&creative=BANNER&section=D4LBFBIO&agencyCode=IAPL&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4LBFBIO" target="_blank"><img src="new-images/annualR_240x100.gif" border="0"></a>
</div>
		 <?php
		 }
		 ?>
		 
		 
</div>
