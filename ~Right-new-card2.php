<script Language="JavaScript" Type="text/javascript">
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
        if ((document.CC_offers_mailer.mobile.value.charAt(0)!="9") && (document.CC_offers_mailer.mobile.value.charAt(0)!="8") && (document.CC_offers_mailer.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
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
	
if(!document.CC_offers_mailer.accept.checked)
	{
		alert("Accept the Terms and Condition");
		document.CC_offers_mailer.accept.focus();
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
/**AJAX SCRIPT**************************************************************/


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
/***********************************************************/

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.CC_offers_mailer.card_type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<tr>                       <td width="75" height="26" align="left" class="frmtxt">Credit Card</td>                        <td align="left"><select name="city" style="width:135px; font-size:11px;"><option>Please Select</option> <option>CC Card</option></select></td></tr>';
				

			}
		}
		
		return true;

	}
	function addDCElement()
{
		var ni = document.getElementById('myDCDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.CC_offers_mailer.card_type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<tr>                       <td width="75" height="26" align="left" class="frmtxt">Debit Card</td>                        <td align="left"><select name="city" style="width:135px; font-size:11px;"><option>Please Select</option> <option>CC Card</option></select></td></tr>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.CC_offers_mailer.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}


	
/*function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.CC_offers_mailer.city.value=="Delhi" || document.CC_offers_mailer.city.value=='Delhi' || document.CC_offers_mailer.city.value=='Noida'  ||  document.CC_offers_mailer.city.value=='Gurgaon'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Gaziabad'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Greater Noida'  || document.CC_offers_mailer.city.value=='Chennai'  ||  document.CC_offers_mailer.city.value=='Mumbai'  ||  document.CC_offers_mailer.city.value=='Thane'  ||  document.CC_offers_mailer.city.value=='Navi mumbai'  ||  document.CC_offers_mailer.city.value=='Kolkata'  ||  document.CC_offers_mailer.city.value=='Kolkota'  ||  document.CC_offers_mailer.city.value=='Hyderabad'  ||  document.CC_offers_mailer.city.value=='Pune'  || document.CC_offers_mailer.city.value=='Bangalore')
			{
				//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked /> <a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.CC_offers_mailer.city.value=="Delhi" || document.CC_offers_mailer.city.value=='Delhi' || document.CC_offers_mailer.city.value=='Noida'  ||  document.CC_offers_mailer.city.value=='Gurgaon'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Gaziabad'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Greater Noida'  || document.CC_offers_mailer.city.value=='Chennai'  ||  document.CC_offers_mailer.city.value=='Mumbai'  ||  document.CC_offers_mailer.city.value=='Thane'  ||  document.CC_offers_mailer.city.value=='Navi mumbai'  ||  document.CC_offers_mailer.city.value=='Kolkata'  ||  document.CC_offers_mailer.city.value=='Kolkota'  ||  document.CC_offers_mailer.city.value=='Hyderabad'  ||  document.CC_offers_mailer.city.value=='Pune'  || document.CC_offers_mailer.city.value=='Bangalore')
			{
				//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked /> <a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}*/
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
                  
				   ni.innerHTML = '<table width="230" border="0" align="right" cellspacing="0" cellpadding="0" style="border-top:1px dashed #2a84da; border-bottom:1px dashed #2a84da;"><tr><td class="frmtxt" valign="middle"> <img src="images/plus2.gif" alt="" onClick="showdetailsFaq(1,12)" id="imgfaq1"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaq(1,12)" style="cursor:pointer; font-weight:bold;" >ABN AMRO </span><div style="display: none;" id="divfaq1">';

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
 

<div style="float:right;">
<table width="250" border="0" cellpadding="0" cellspacing="0" id="bgclr">
    <tr>
      <td align="center" valign="middle" id="frmbgtp" >Register here for latest Discounts, Offers & Reward information on Credit Card & Debit Cards</td>
    </tr>
	 
	 <tr>
	 
	 <td valign="top" style="padding-top:10px;">
<form  name="CC_offers_mailer" action="credit-card-archives-continue.php" method="POST" ONsubmit="return ccofferform(document.CC_offers_mailer);"><input type="hidden" name="source"  value="<? echo "Internal Campaign-Upendra";?>">
  <table width="95%" border="0" align="right" cellpadding="0" cellspacing="0"  >
    <tr>
      <td width="83" align="left" valign="middle" class="frmtxt"><b>Name</b></td>
      <td width="145"  align="left" valign="middle"><input type="text" name="name" style="width:133px;" maxlength="30" /></td>
    </tr>
    <tr>
      <td width="83" height="26" align="left" valign="middle" class="frmtxt"><b>Mobile</b></td>
      <td align="left" valign="middle"  class="frmtxt">+91
        <input type="text" name="mobile" style="width:103px;" maxlength="10" /></td>
    </tr>
    <tr>
      <td width="83" height="26" align="left" valign="middle" class="frmtxt"><b>Email Id</b></td>
      <td align="left" valign="middle"><input type="text" name="email" style="width:133px;" maxlength="60" /></td>
    </tr>
    <tr>
      <td width="83" height="26" align="left" valign="middle" class="frmtxt"><b>City</b></td>
      <td align="left" valign="middle"><select name="city" style="width:138px;" onchange="tataaig_comp();">
          <option value="-1" selected="selected">Please Select</option>
        <option value="Ahmedabad">Ahmedabad</option>
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
          <option value="Others">Others</option>
      </select></td>
    </tr>

    <tr>
      <td height="45" colspan="2" align="center" valign="middle" class="frmtxt" style="text-align:center;"><b>Want Offers, Discounts &amp; Reward information On</b></td>
    </tr>
    <tr>
      <td height="25" colspan="2" align="center" valign="middle"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  ><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" onclick="getdivdetailsdc();" style="border:none;" /></td>
            <td class="frmtxt"><b>Credit Card</b></td>
            <td ><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc" onclick="getdivdetailsdc();"  style="border:none;"/></td>
            <td class="frmtxt"><b>Debit Card</b></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2" class="nrmltxt"><div id="myDiv1" name="myDiv1"></div></td>
    </tr>
    <tr>
      <td colspan="2" class="nrmltxt" style="font-size:9px;"> <input type="checkbox" name="accept" style="border:none;" checked> I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a></td>
    </tr>

    <tr>
      <td height="35" colspan="2" align="center" valign="middle"><input type="submit" value="" class="qcksbscrb"  /></td>
    </tr>
  </table>
</form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
  </table>
  <table width="250" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td valign="top">

 
<div style="text-align:center; padding-top:15px;" align="center"><span>Advertisement</span>

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
<br /><br />
<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=86&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a1ea6152' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=86&amp;source=intCampaign&amp;n=a1ea6152' border='0' alt=''></a></noscript>

<br /><br />

		 </div>
</td></tr></table>
</div>
