<?php
	require 'scripts/functions.php';

		$source=$_REQUEST['source'];
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Loan</title>
<link rel="stylesheet" href="http://www.deal4loans.com/css/personalloans.css" type="text/css" />
<script Language="JavaScript" Type="text/javascript">
function chkpersonalloan(Form)
{
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Name.focus();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
alert("Name contains numbers!");
Form.Name.focus();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.focus();
  	return false;
  	}
  }

if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "1945") || (Form.year.value >"1989"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-20) || Form.year.value < parseInt(mdate-65))
{
alert("Age Criteria! \n Applicants between age group 20 - 65 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

	
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
	
	
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
}}

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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}
function validateemailv2(email)
{
// a very simple email validation checking.
// you can add more complex email checking if it helps
var splitted = email.match("^(.+)@(.+)$");
if(splitted == null) return false;
if(splitted[1] != null )
{
var regexp_user=/^\"?[\w-_\.]*\"?$/;
if(splitted[1].match(regexp_user) == null) return false;
}
if(splitted[2] != null)
{
var regexp_domain=/^[\w-\.]*\.[a-za-z]{2,4}$/;
if(splitted[2].match(regexp_domain) == null)
{
var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
if(splitted[2].match(regexp_ip) == null) return false;
}// if
return true;
}
return false;
}
function othercity1()
{
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
}
}function getnewfield()
{
	//alert("kj");
	 if ((document.personalloan_form.City.value=='Others' ))
       {
               document.getElementById('nettab').innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>    <td >Other City </td>                    <td style='padding-left:15px;' align='center'><input name='City_Other' type='text'  id='City_Other' style=' width:138px; padding:2px 0px; ' /></td>                 </tr></table>";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
               document.getElementById('nettab').innerHTML = "";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}   

</script>
<Script Language="JavaScript" Type="text/javascript">
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
			var get_full_name = document.getElementById('Name').value;
			var get_mobile_no = document.getElementById('Phone').value;
			var get_city = document.getElementById('City').value;
			var get_id = document.getElementById('Activate').value;
			var get_product ="1";
			var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
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

	window.onload = ajaxFunctionMain;</script>
</head>

<body>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" valign="middle" ><table width="97%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="23%"><img src="images/pl/pl-logo.gif" width="155" height="44" /></td>
        <td width="77%" align="left" valign="bottom" id="txt-bld" style="color:#A82C0F;">Personal Loans by Choice not by Chance ! </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#2482F7">
      <tr>
        <td width="470" height="250" valign="middle" style="background-image:url(images/pl/pl-tp-lft-bl.gif); background-repeat:no-repeat; background-position:left top;"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td class="wht-text">Special Tie Ups &amp; Offers for Employees of <br />

              Top Companies In India</td>
          </tr>
          <tr>
            <td align="center" style="padding-top:10px;"><img src="images/pl/d4l-banner.gif" width="444" height="142" /></td>
          </tr>
        </table></td>
        <td valign="top"  style="background-image:url(images/pl/pl-tp-rgt-bl.gif); background-repeat:no-repeat; background-position:right top; padding-top:8px; padding-bottom:8px;">
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAAD29">
             <tr>
              <td  ><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FAAD29">
                  <tr>
                    <td width="16" height="15" align="left" valign="top"><img src="images/pl/pl-frm-bg-tp-lft.gif" width="16" height="15" /></td>
                    <td width="45" height="31" align="right"><img src="images/pl/pl-frm-hdr-rgt.gif" width="15" height="31" /></td>
                    <td align="center" bgcolor="#FF7324" style="color:#FFFFFF; font-size:13px;">Know Your EMI's</td>
                    <td width="45" height="31" align="left"><img src="images/pl/pl-frm-hdr-lft.gif" width="15" height="31" /></td>
                    <td width="16" height="15" align="right" valign="top"><img src="images/pl/pl-frm-bg-tp-rgt.gif" width="16" height="15" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td style="padding-top:10px;">
	<!------------------------------------------------------------------->		
			  <form action="personal_loans_thanks.php" method="post" name="personalloan_form" id="personalloan_form" onsubmit="return chkpersonalloan(document.personalloan_form);">
			  <input type="hidden" name="Type_Loan" value="Req_Loan_Personal" />
                  <input type="hidden" name="creative" value="<? echo $_REQUEST['creative']; ?>" />
                  <input type="hidden" name="section" value="<? echo $_REQUEST['section']; ?>" />
                  <input type="hidden" name="source" value="<? echo $source; ?>" />
                  <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer']; ?>" />
                  <input type="hidden" name="Activate" id="Activate">
                  <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                  <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong>
                    <?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?>
                  </strong></font></div>
			  
			  <table width="95%" border="0" align="right" cellpadding="0" cellspacing="4">
                  <tr>
                    <td width="41%" align="left">Full Name</td>
                    <td width="59%" align="left"><input name="Name" type="text" id="Name" style=" width:140px; padding:2px 0px;" />                    </td>
                  </tr>
                  <tr>
                    <td align="left">DOB</td>
                    <td align="left"><input name="day" type="text" id="day" style=" width:35px; padding:2px 0px;" maxlength="2"/>
                      <input name="month" type="text" id="month" style=" width:35px; padding:2px 0px; " maxlength="2"/>
                      <input name="year" type="text" id="year" style=" width:58px; padding:2px 0px; " maxlength="4"/></td>
                  </tr>
                  <tr>
                    <td align="left">Mobile No.</td>
                    <td align="left">+91
                        <input name="Phone" type="text" id="Phone" style=" width:110px; padding:2px 0px; " maxlength="10" /></td>
                  </tr>
                  <tr>
                    <td align="left">City</td>
                    <td align="left"><select style="width:140px;"  name="City" id="City" onchange="getnewfield(); insertData();"  >
                        <?=getCityList($City)?>
                    </select></td>
                  </tr>
				   <tr>
                        <td colspan="2" align="left" id="nettab"></td>
                      </tr>
                 
                  <tr>
                    <td colspan="2" align="left" valign="top"><input type="checkbox" class="style4" name="accept" style="border:none;" checked>
                     I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" valign="top"><input type="image" name="Submit" src="images/pl/pl-sbtn.gif"  style="width:94px; height:28px; border:none; " /></td>
                  </tr>
              </table>
			  </form><!---------------------------------------------------></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="16" height="15" align="left" valign="top"><img src="images/pl/pl-frm-bg-lgt-botom.gif" width="16" height="15" /></td>
                    <td>&nbsp;</td>
                    <td width="16" height="15" align="right" valign="bottom"><img src="images/pl/pl-frm-bg-bt-botom.gif" width="16" height="15" /></td>
                  </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/pl/pl-hdr-bot-shadow.gif); background-repeat:repeat-x; height:29px;">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"   ></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="26" background="images/pl/pl-top-curv.gif" style="background-repeat:no-repeat; background-position:left bottom; color:#000000; padding-left:45px; text-align:left;">www.Deal4loans.com</td>
      </tr>
      <tr>
        <td  style="font-size:12px; font-weight:bold; text-decoration:none; vertical-align:middle;  text-align:left; color:#174C8D; line-height:18px; border-left:1px solid #3E78FF; border-right:1px solid #3E78FF; padding:8px;">The one-stop shop for best on all Personal loan requirements. Now get offers from <font color="#A82C0F">SBI,  ICICI, HDFC Bank, Deutsche,    Citibank, HSBC, Kotak</font> choose the best deal! </td>
      </tr>
      <tr>
        <td height="9" valign="top"><img src="images/pl/pl-bot-curve.gif" width="780" height="9" /></td>
      </tr>
    </table></td>
  </tr>
 
  <tr>
    <td style="padding-top:8px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="87" align="left" valign="top"><img src="images/pl/pl-lft-shap.gif" width="15" height="87" /></td>
        <td style="border-top:1px solid #3E78FF; border-bottom:1px solid #3E78FF; font-weight:normal; color:#000000; padding:8px; text-align:left;">
<ul><li>Personal Loan Quotes are free for customers. It's a totally free service for customers.</li>
<li>All loans repayment period are over 6 months. No short term loans.</li></ul>

       </td>
        <td width="15" height="87" align="right" valign="top"><img src="images/pl/pl-rgt-shap.gif" width="15" height="87" /></td>
      </tr>
	   <tr>
        <td width="15" height="87" align="left" valign="top"><img src="images/pl/pl-lft-shap.gif" width="15" height="87" /></td>
        <td style="border-top:1px solid #3E78FF; border-bottom:1px solid #3E78FF; font-weight:normal; color:#000000; padding:8px; text-align:left;"> 
 
 I want to say thank you to deal4loans.com,when i applied through the site i was really not sure of interest rates of banks.But the comparision from different banks made it too easy.I am glad that i have choosen the right way to go for my loan.
Thanks You Deal4loans.com.<div style="font-weight:bold; float:right;">Prathibha</div>       </td>
        <td width="15" height="87" align="right" valign="top"><img src="images/pl/pl-rgt-shap.gif" width="15" height="87" /></td>
      </tr>
    </table></td>
  </tr>
 <tr>
    <td>&nbsp;</td>
  </tr>
<tr><td><?php include 'footer_landingpage1.php'; ?></td></tr>
 
</table>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>

