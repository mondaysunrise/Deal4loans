<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Credit Cards - Deal4loans</title>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="list_hdfc.js"></script>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;
	background-image:url(new-images/hdfc-gold/bg.gif);

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}
form{
margin:0px;
padding:0px;

}

.bldtxt{
font-weight:bold;
color:#4f4d4d;
 }


.txt ul{
	margin:0px;
	padding:0px;
}

.txt ul li{
	background: url(new-images/hdfc-gold/arrow.gif) no-repeat 0px 6px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

	/* START CSS NEEDED ONLY IN DEMO */

	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:195px;	/* Width of box */
		height:100px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:9px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
		
	
</style>

<Script Language="JavaScript">


function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	var a=Form.Pancard.value;
	
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	   Form.Pancard.focus();
	  return false;
	}
	
	if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
	{
			alert("The Forth position should be 'P'. ");
			 Form.Pancard.focus();
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




function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}


function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}



function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #eadbc8; ">
  <tr>
    <td height="200" valign="top"><table width="946" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="237" height="185"><img src="new-images/hdfc-gold/hdr1.gif" width="237" height="185" /></td>
        <td width="227"><img src="new-images/hdfc-gold/hdr2.gif" width="227" height="185" /></td>
        <td width="242"><img src="new-images/hdfc-gold/hdr3.gif" width="242" height="185" /></td>
        <td width="240"><img src="new-images/hdfc-gold/hdr4.gif" width="240" height="185" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="8" cellpadding="0">
      <tr valign="top">
        <td width="484"><table cellspacing="0" cellpadding="4" width="100%" border="0">
      
        
        <tr> 
          <td width="100%" align="left" valign="top" class="txt">
		  <ul>
		  <li><b>Attractive Reward Points</b>*<br />
             Earn 1 reward point per Rs 150 spent on the Gold Credit Card.</li>
		   <li><b>Rewards points redemption</b><br />
After earning all those reward points on your HDFC Bank Gold Credit Card, redeem them for exciting gifts and services! You could even convert them to airline miles with India's leading airlines through the MyRewards programme.</li>
		   <li><b>Worldwide acceptance</b><br />
Accepted at over 23 million Merchant Establishments around the world, including 110,000 Merchant Establishments in India.</li>
		   <li><b>Revolving credit facility </b><br />
Pay a minimum amount, which is 5% (subject to a minimum amount of Rs.200) of your total bill amount or any higher amount whichever is convenient and carry forward the balance to a better financial month. For this facility you pay a nominal charge of just 3.25% per month (39.0% annually).</li>
		   <li><b>Free Add-on card</b><br />
You can share these wonderful features with your loved ones too - we offer the facility of an add-on card for your spouse, children or parents. Allow us to offer add-on cards to you FREE OF COST with our compliments.</li>
		   <li><b>Interest free credit facility </b><br />
Avail of up to 50 days of interest free period from the date of purchase (subject to the submission of the charge by the Merchant).</li>
		   <li><b>Zero liability on lost card</b><br />
If you happen to lose your Card, report it immediately to our 24-hour call centre. After reporting the loss, you carry zero liability on any fraudulent transactions on your card.</li>
		   </ul>
 
          </td>
        </tr>

    </table></td>
        <td width="450" valign="top">
		<?php
		$requestid = $_GET['id'];
		$sql = "select * from req_hdfc_lead where RequestID= '".$requestid."' " ;
		list($numRows,$query)=Mainselectfunc($sql,$array = array());
		$Name = $query[0]['Name'];
		$Email = $query[0]['Email'];
		$Phone = $query[0]['Phone'];
		
		?>
		<form name="loan_form" method="post" action="validate-credit-cards-continue.php" onSubmit="return submitform(document.loan_form);">
<input type="hidden" name="requestid" value="<?php echo $requestid; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center" style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></div>
		<table width="450"  border="0" align="right" cellpadding="0" cellspacing="0" background="new-images/hdfc-gold/frm-bg.gif"  >
			  <tr>
                <td width="450" height="42"    align="center" valign="bottom"><img src="new-images/hdfc-gold/frm-hdng.gif" width="450" height="42" /></td>
			 </tr>
			  <tr>
                <td  align="center" valign="top" > <table width="98%"  border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15" colspan="3" align="right" ></td>
    </tr>
  <tr>
	<td width="192" height="30" align="right" class="bldtxt">Full Name</td>
	<td width="12" align="center" class="bldtxt">:</td>
	<td width="235" align="left"><?php echo $Name; ?>	</td>
  </tr>
   <tr>
	<td height="30" align="right" class="bldtxt">Mobile No. </td>
	<td align="center" class="bldtxt">:</td>
	<td align="left">+91 
	  <?php echo $Phone; ?></td>
  </tr>
  <tr>
	<td height="30" align="right" class="bldtxt">Email Id </td>
	<td align="center" class="bldtxt">:</td>
	<td align="left"><?php echo $Email; ?></td>
  </tr>
  <tr>
	<td width="175"  height="26" align="right" class="bldtxt">Pancard</td>
	<td width="16" align="center" class="bldtxt"> : </td>
	<td align="left"><input type="text" name="Pancard" id="Pancard" maxlength="10" /> </td>
  </tr>

  <tr valign="bottom">
    <td height="40" colspan="3" align="center"><input  type="image" src="new-images/hdfc-gold/sbtn.gif" style="border: 0px;"></td>
    </tr>
</table>
 </td>
              </tr>
			  <tr>
			    <td height="15"  align="center" valign="top" bgcolor="#FFFFFF"><img src="new-images/hdfc-gold/frm-btm.gif" width="450" height="15" /></td>
		      </tr>
</table>
</form>
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
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
