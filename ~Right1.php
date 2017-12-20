 <?php
require 'scripts/db_init.php';
?>
 <?php
 if(!isset($_SESSION['UserType']))
{

//ob_start();
 //session_start();
  if ((($_REQUEST['flag'])!=1))
	{


?>

<!--/////////////if clause for credit card offers//////////////////////////////////////////////////////-->
   
	<?php
		if((strlen(strpos($_SERVER['REQUEST_URI'], "credit-card-offers")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "credit-card-archives")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "credit-cards-offers")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "earn-credit-card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Faqs")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Eligibility")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Mustread")) > 0))
		{
	?>

	<script>
		function valButton5() {
		var cnt = -1;
		var i;
		for(i=0; i<document.CC_offers_mailer.From_Product.length; i++) 
		{
			if(document.CC_offers_mailer.From_Product[i].checked)
			{
				cnt=i;
				
			}
		}
		if(cnt > -1)
		{ 
			return true;
		}
		else
		{
			return false;
		}
	}            
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
function ccofferform(Form)
{
	if(document.CC_offers_mailer.name.value=="") 
			{
				alert("Please fill your name.");
				document.CC_offers_mailer.name.focus();
				return false;
			}
			if(document.CC_offers_mailer.mobile.value=="") 
			{
				alert("Please fill your mobile.");
				document.CC_offers_mailer.mobile.focus();
				return false;
			}
			
	 if(isNaN(document.CC_offers_mailer.mobile.value)|| document.CC_offers_mailer.mobile.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in mobile no");
			  document.CC_offers_mailer.mobile.focus();
			  return false;  
		}
        if (document.CC_offers_mailer.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.CC_offers_mailer.mobile.focus();
				return false;
        }
        if ((document.CC_offers_mailer.mobile.value.charAt(0)!="9") && (document.CC_offers_mailer.mobile.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 document.CC_offers_mailer.mobile.focus();
                return false;
        }

		if(document.CC_offers_mailer.email.value=="") 
			{
				alert("Please fill your Email.");
				document.CC_offers_mailer.email.focus();
				return false;
			}
			
		if(document.CC_offers_mailer.email.value!="")
		{
			if (!validmail(document.CC_offers_mailer.email.value))
			{
				//alert("Please enter your valid email address!");
				document.CC_offers_mailer.email.focus();
				return false;
			}
		
	
		}
if (document.CC_offers_mailer.city.selectedIndex==0)
	{
		alert("Please select city to Continue");
		document.CC_offers_mailer.city.focus();
		return false;
	}


}

var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
		
		function getdivdetailsdc()
		{
			//alert('hello');
			//alert(document.getElementById('card_type').value);
			var card_type=document.getElementById('card_type').value;		
			if((card_type!=""))
			{
				var queryString = "?card_type=" + card_type;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_ccdetails.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						// alert(ajaxRequest.responseText);
						var ajaxDisplay = document.getElementById('myDiv1');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					  

					   
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	window.onload = ajaxFunction;
</script>
<script language="JavaScript" type="text/javascript" src="scripts/rollovers.js"></script>
	<script language="JavaScript">
	  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						else
							{
								
								//eval(document.getElementById("divfaq"+j)).style.display="none"
								//eval(document.getElementById("imgfaq"+j)).src='/images/plus.gif'
							}
					}
			}
							//window.onload=showdetailsFaq
</script>
<script type="text/javascript">
function addBankdetails1()
{
        var ni = document.getElementById('myDiv1');
            if(ni.innerHTML=="")
        {
                  
				   ni.innerHTML = '<table width="230" border="0" align="right" cellspacing="0" cellpadding="0" style="border-top:1px dashed #2a84da; border-bottom:1px dashed #2a84da;"><tr><td class="bldtxt" valign="middle"> <img src="images/plus2.gif" alt="" onClick="showdetailsFaq(1,12)" id="imgfaq1"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaq(1,12)" style="cursor:pointer; font-weight:bold;" >ABN AMRO </span><div style="display: none;" id="divfaq1">';

        }
    return true;
    }


function removeBankdetails1()
{
        var ni = document.getElementById('myDiv1');
       
       
        if(ni.innerHTML!="")
        {
        ni.innerHTML = '';
        }
        return true;

    }
</script>
<style type="text/css">

.nrmltxt{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#07468c; 
	font-weight:normal;
	line-height:18px;
}

.nrmltxt span{ 
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#07468c; 
}

.bldtxt{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#07468c; 
	font-weight:bold;
}


</style>
 <div id="dvColumn3"> 
      <div id="dvRightBanner">
<div align="center"><form  name="CC_offers_mailer" action="credit-card-archives-continue.php" method="POST" ONsubmit="return ccofferform(document.CC_offers_mailer);"><input type="hidden" name="source"  value="<? echo $_REQUEST['source'];?>"><table width="235" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td bgcolor="#2a84da" align="center" width="100%" style="color:#FFFFFF; font-family:verdana; font-weight:bold; font-size:13px;" height="40" >Register here for latest Discounts, Offers & Reward information on Credit Card & Debit Cards</td>
</tr>
                  <tr>
                  
<td valign="top" align="center" bgcolor="#FFFFFF" style="border:1px solid #2a84da; padding-top:10px;"><table width="97%" border="0" align="right" cellpadding="0" cellspacing="0"  >
                      
                      <tr>
                        <td width="83" align="left" valign="middle" class="bldtxt">Name<font color="#FF0000">*</font></td>
                        <td width="145"  align="left" valign="middle"><input type="text" name="name" style="width:125px;" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td width="83" height="26" align="left" valign="middle" class="bldtxt">Mobile<font color="#FF0000">*</font></td>
                        <td align="left" valign="middle"  class="bldtxt">91 
                          <input type="text" name="mobile" style="width:105px;" maxlength="10" /></td>
                      </tr>
                      <tr>
                        <td width="83" height="26" align="left" valign="middle" class="bldtxt">Email Id<font color="#FF0000">*</font></td>
                        <td align="left" valign="middle"><input type="text" name="email" style="width:125px;" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td width="83" height="26" align="left" valign="middle" class="bldtxt">City<font color="#FF0000">*</font></td>
                        <td align="left" valign="middle"><select name="city" style="width:129px;" onchange="tataaig_comp();">
								  <option value="-1" selected>Please Select</option><option value="Ahmedabad">Ahmedabad</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Bhubneshwar">Bhubneshwar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuttack">Cuttack</option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gaziabad">Gaziabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysore">Mysore</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi 
                                  Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Patna">Patna</option>
                                <option value="Pune">Pune</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Sahibabad">Sahibabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Thane">Thane</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Vishakapatanam">Vishakapatanam</option>
                                <option value="Others">Others</option></select></td>
                      </tr>
					  <!------------------------------------------------------------>
					   <tr>
					    <td height="25" colspan="2" align="center" valign="middle" class="bldtxt">Want Offers, Discounts & Reward information On</td>
			    </tr>
					   <tr>
					     <td height="25" colspan="2" align="center" valign="middle"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                             <td  ><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" onClick="getdivdetailsdc();" style="border:none;" /></td>
                             <td class="bldtxt">Credit Card</td>
                             <td ><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc" onclick="getdivdetailsdc();"  style="border:none;"/></td>
                             <td class="bldtxt">Debit Card</td>
                           </tr>
                         </table></td>
		        </tr>
				

					  <tr><td colspan="2" class="nrmltxt"><div id="myDiv1" name="myDiv1"></div></td>
					  </tr> 
					
                      <tr>
                        <td height="35" colspan="2" align="center" valign="middle"><input name="submit" value="Subscribe" type="submit" style="font-size:12px; font-weight:bold; background-color:#2a84da; color:#FFFFFF; width:80px; height:24px; border:none;"/></td>
                      </tr>
                    </table></td>
       
                  </tr>
                  
                </table></form>
</div>

</div>
</div>
</div>
<? }
		
		else
		{?>
		 <div id="dvColumn3"> 
      <div id="dvRightBanner">
	  <style type="text/css">
  select {font:11px verdana; padding:2px; margin:0px; border: 1px solid #68718A;}
  input {font:11px verdana; padding:2px; margin:0px; border: 1px solid #68718A;}
 .quick {font: 11px verdana;}
 .bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #529BE4;
	border: 1px solid #529BE4;
	font-weight: bold;
}
.blueborder {
	border: 1px solid #529BE4;
}

 </style>
 <script Language="JavaScript" Type="text/javascript">
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
        if (document.loan_form.mobile.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.mobile.focus();
                return false;
		}

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

  <div id="dvColumn3">  
   
	<?php 

if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0") > 0)
{
?>
<!-- IE 6.0 -->
	 <table width="237" border="0" align="center" cellpadding="0" cellspacing="0"  class="blueborder" >
<?php
}
else {
?>

	 <table width="237" border="0" align="center" cellpadding="0" cellspacing="0"  class="blueborder" >


	<?php } ?>

	 <tr bgcolor="#529BE4">
	 <td height="20" colspan="2" align="center" class="quick"  style="font-size:13px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;color:#FFFFFF;">Apply Here </td>
	 </tr><tr><td bgcolor="#FFFFFF">
	 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">

	 <table  border="0" height="100" width="98%" cellpadding="2" cellspacing="0" >
	 
	 
	 <td width="40%" align="left" class="quick">Product Type</td>
	 <td width="70%" align="right">
	 <select style="width:138px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	  <option value="Req_Loan_Education">Education Loan</option>
<option value="Req_Loan_Gold">Gold Loan</option>
	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"  width="4"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>"></td>
		  </tr>
	 <tr>
	 <td align="left" class="quick">Full Name</td>
	 <td align="right" ><input type="text" name="fullname" style="width:130px;" maxlength="30"></td>
	 </tr>
	<tr>
	 <td align="left" class="quick">Mobile</td>
	 <td align="right" class="quick">+91
	   <input type="text" style="width:100px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="mobile"></td>
	 </tr>
	 <tr>
	 <td align="left" class="quick">Email id</td>
	 <td align="right" ><input type="text" name="email_id" style="width:130px;"></td>
	 </tr>
	 <tr>
	 <td class="quick">City</td>
	 <td ><select name="city" style="width:138px;">
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="quick">Net Salary (Yearly)</td>
	 <td ><input type="text" name="net_salary"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
	 </tr>
	 <tr><td colspan="2" style="color:#000000; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px; font-weight:normal; text-align:left;" ><input type="checkbox"  name="accept" style="border:none;" checked >I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<br /></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Get Quote" >&nbsp;
            </td></tr>
	 </table>
	 </form></td></tr>
	 
	 
	   
</table>

<div align="center" style="width:250px; clear:both; padding:3px 0px;
">
<?php 
if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-lic-housing1")) > 0))
	 {
	 
	 }
	 else
	 { 
	 
 }?>
                

  <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3">
			  <? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="13" height="47" align="left" valign="top"><img src="/images/step-lft-corn.gif" width="13" height="47" /></td>
                    <td align="center" valign="middle"  background="/images/step-pnl-bg.gif" class="step-hd-text"   >How Does it Work?</td>
                    <td width="13" height="47" align="right" valign="top"><img src="/images/step-rgt-corn.gif" width="13" height="47" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td width="76" height="105" valign="top"  bgcolor="#D98E1A" class="steps-text" style="padding-top:15px;" ><img src="/images/stp1.gif" width="32" height="31" /><br />
                Post your loan requirement </td>
              <td width="86" valign="top" bgcolor="#D08108" class="steps-text" style="padding-top:15px;"  ><img src="/images/stp2.gif" width="31" height="31" /><br />
                Get &amp; Compare  offers from all banks </td>
              <td width="78" valign="top" bgcolor="#BE740A" class="steps-text" style="padding-top:15px;"  ><img src="/images/stp3.gif" width="31" height="31" /><br />
                Go with the lowest bidder </td>
            </tr>
           </table>
		  <?php
		  }
		  ?>
		  
</div>
	</div>
	 
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "t_y")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "t_y1")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loan-thank")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-apply-thank")) > 0))
	 {
	//echo "hello qazwwxxc";
	$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if((($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan")) && ($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		
		 {
			 ?>
			 
</div>
	<? }
}

	?>
	 
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-banks")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks")) > 0))
	 {?>
	 
	 
</div>	  <? }

if((strlen(strpos($_SERVER['REQUEST_URI'], "viewnewsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "newsletter-archives-main")) > 0) )
	 {	
			  $newsqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
	list($recordcount,$newsresult)=MainselectfuncNew($newsqry,$array = array());
			  ?>
			  <Div align="center"><font style="Font-size:14px; font-family:Century Gothic;font-weight:bold;" >Newsletter Menu</font></div><table>
			  <?
		 for($h=0;$h<$recordcount;$h++)
		 {
			$News_Content = $newsresult[$h]['News_Content'];
			$News_Subject = $newsresult[$h]['News_Subject'];
			$News_Date = $newsresult[$h]['News_Month'];
			$subject = substr($News_Subject, 0, 25);
		 ?>
		 <tr>
		<td><font face="Verdana" size="1" color="0F74D4">&#8226;</font> <font style="Font-size:11px; font-family:Verdana;"> <a href="javascript:ajaxpage('<? echo "/".$News_Content;?>', 'contentarea');"><?echo  $News_Date."-".$subject."...";?></a></font><BR/></td></tr>
		 <?
		 }
		 
		 ?>
		 </table>
		<div id="dvRightBanner150"><img src="/images/spacer.gif" alt="" height="288" width="150" /></div>

	 <? } ?>

	  <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "viewnewsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "newsletter-archives-main")) > 0) )
	 {
			  $newsqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
			 	list($recordcount,$newsresult)=MainselectfuncNew($newsqry,$array = array());
			  ?>
			  <Div align="center"><font style="Font-size:14px; font-family:Century Gothic;font-weight:bold;" >Newsletter Menu</font></div><table>
			  <?
		 for($h=0;$h<$recordcount;$h++)
		 {
				$News_Content = $newsresult[$h]['News_Content'];
			$News_Subject = $newsresult[$h]['News_Subject'];
			$News_Date = $newsresult[$h]['News_Month'];
			$subject = substr($News_Subject, 0, 25);
		 ?>
		 <tr>
		<td><font face="Verdana" size="1" color="0F74D4">&#8226;</font> <font style="Font-size:11px; font-family:Verdana;"> <a href="javascript:ajaxpage('<? echo "/".$News_Content;?>', 'contentarea');"><?echo  $News_Date."-".$subject."...";?></a></font><BR/></td></tr>
		 <?
		 }
		 
		 ?>
		 </table>
		<div id="dvRightBanner150"><img src="/images/spacer.gif" alt="" height="288" width="150"></div>

	 <? } ?>

	  

<?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Calculators")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "loan-amortization")) > 0) )
	 {?>
	  
		<div style="clear:both;" > 
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
              <td height="40" colspan="3" align="center" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style="color:#333333;" ><b>Personal Loan Rate of Interest</b><br />
<div align="center">( Last edited on : <? echo $currentdate; ?> )</div></td>
          </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" class="steps-text" ><table border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank<br>
                      <img src="images/spacer.gif" width="48" height="8" border="0"></td>
                  <td width="64" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                  of Interest</td>
                  <td width="48" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Processing<br />
                    Fee</td>
                  <td width="50" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
				<? $getplrates="Select cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1)";
			 	list($plrowcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
for($j=0;$j<$plrowcount;$j++)
{
?>
  <tr>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="<? echo $plrow["bank_url"]; ?>" style="color:#335599;"><? echo $plrow[$j]["bank_name"]; ?></a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$j]["cat_a"]."-".$plrow[$j]["others"]; ?><br /></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$j]["processing_fee"]; ?></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
				 
			 <a href="http://www.deal4loans.com/apply-personal-loans.php" target="_blank" style="color:#335599;">APPLY</a>
						 </td>
                </tr>


<? }?>
				 </table></td>
            </tr>
            <tr>
              <td height="40" colspan="3" align="center" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style="color: #333333;" ><b>Home Loan Rate of Interest</b><br />
              <div align="center">( Last edited on : <? echo $currentdate; ?> )</div></td>
            </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" class="steps-text" ><table border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank<br>
<img src="images/spacer.gif" width="48" height="1" border="0"></td>
                  <td width="70" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                    of Interest</td>
                  <td width="47" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Prepayment<br>
                    charges</td>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
				<? $gethlrates="Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (203,3,8,5) and flag=1)";
	 	list($hlrowcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
for($j=0;$j<$hlrowcount;$j++)
	{
	?>
	 <tr>
			  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;"><a href="<?  echo $hlrow['bank_url'];?>" style="color:#335599;"><? echo $hlrow[$j]["bank_name"]; ?></a></td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $hlrow[$j]["ndtv_rates"]; ?></td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
			
		<a href="http://www.deal4loans.com/home-loan-apply.php" target="_blank" style="color:#335599;">APPLY</a>
						 </td>
                
	<? }?>
              </table></td>
            </tr></table>
          
 
</div>
    
     </div>  <div align="center" style="bgcolor:#FFFFFF; font-size:11px;">Advertisement</div>
	 <div align="center" ><!--<a href="https://asia.citi.com/india/loan/home-loan.htm?eOfferCode=D4LHL116&agencyCode=IAPL&campaignCode=BNL&creative=BANNER&productCode=HL&section=D4LHL116&site=DEAL4LOANS&category=HL" target="_blank"><img src="../new-images/v3-HL-Banners-160x600_1.jpg"></a>-->
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
	 <!--<div align="center" style="clear:both;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="250" height="150">
  <param name="movie" value="new-images/250x150.swf" />
  <param name="quality" value="high" />
  <embed src="new-images/250x150.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="250" height="150"></embed>
</object></div>-->
	
	  <? }?>
	
	  </div></div> 
	  
	   <? 
	   }
 else
 { ?>
<?}?>
<?
}?>