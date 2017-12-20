<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_PL";

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
	

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;

		$UserID = $_SESSION['UserID'];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		//$Reference_Code = generateNumber(4);
		$Type_Loan = FixString($Type_Loan);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		 $Dated = ExactServerdate();
		
	$IsPublic = 1;

		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		$IP = getenv("REMOTE_ADDR");
		
if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "PersonalLoan";
			$_SESSION['Temp_Type_Loan']="Req_Personal_Loan";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $Name;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Reference_Code'] = $Reference_Code;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
		}
	else
		{
			$_SESSION['Temp_Type'] = "PersonalLoan";
			$_SESSION['Temp_Type_Loan']="Req_Personal_Loan";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_FName'] = $Name;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Reference_Code'] = $Reference_Code;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			}


	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
			Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
		$crap = " ".$Name." ".$City;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
	
			 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			 $cntr=0;
	$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$cntr]['UserID'];
				$data = array('UserID'=>$UserID, 'Name'=>$Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP);
			}
			else
			{
				
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
					
				$data = array('UserID'=>$UserID, 'Name'=>$Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP);
			}
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);	
			$_SESSION['Temp_LID'] = $ProductValue;
		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
	
	

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Loan</title>
<link rel="stylesheet" href="http://www.deal4loans.com/css/personalloans.css" type="text/css" />
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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


</script>
<Script Language="JavaScript" Type="text/javascript">


function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="140"  height="20" align="left" >Any type of loan(s) running? </td>  <td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" colspan="2" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home<input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" />Personal</td></tr>        <tr> <td  width="60" height="20" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" />Car</td>          <td  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" />Property</td></tr><tr><td height="22"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" />Other</td></tr></table></td></tr>		 <tr>    <td align="left" height="25" >How many EMI paid?  </td>           <td colspan="3" align="left" width="158" height="18" ><select name="EMI_Paid" style="width:120px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select>  </td>	</tr></table>';
			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

	function submitform(Form)
	{
var newmyOption;
var btn2;
	var btn3;
	var myOption;
	var i;
	/*if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.personalloan_form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			else if(isNaN(Form.RePhone.value)|| Form.RePhone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.RePhone.focus();
			  return false;  
		}
        else if (Form.RePhone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.RePhone.focus();
				return false;
        }
else if (Form.RePhone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 Form.RePhone.focus();
                return false;
        }
			
		}
	}*/
	if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}
	if (Form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment status to Continue");
		Form.Employment_Status.focus();
		return false;
	}
	if(Form.IncomeAmount.value=="")
		{
			alert("Please fill your income.");
			Form.IncomeAmount.focus();
			return false;
		}
		if(Form.Loan_Amount.value=="" )
		{
			alert("Please fill your Loan Amount.");
			Form.Loan_Amount.focus();
			return false;
		}
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;
newmyOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.Card_Vintage.selectedIndex==0)
				{
						alert("Please select since how long you holding credit card");
						Form.Card_Vintage.focus();
						return false;
				}
				if (Form.Credit_Limit.value=="")
				{
						alert("Please fill credit limit");
						Form.Credit_Limit.focus();
						return false;
				}

				}
					newmyOption = i;
	
			}
		}
	
		if (newmyOption == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}


	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
return true;
}
function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Loan_Any.length; i++) 
	{
        if(document.personalloan_form.Loan_Any[i].checked)
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


function lessnetsalary()
{
	//alert("hello");
		var ni = document.getElementById('netsalarylessthen');
	//	 var newdiv = document.createElement('div');
	if((document.getElementById('IncomeAmount').value<="200000") || (document.IncomeAmount.value<="200000"))
	{
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML ='<table width="100%"><tr><td height="30"  width="43%" align="left">Mobile Connection?</td><td width="57%"><input type="radio" value="1"  name="Mobile_Connection"  > Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size="10" type="radio" name="Mobile_Connection"  id="Mobile_Connection" value="2" > No</td></tr><tr><td align="left" height="30">Do you have landline at your Residence?</td> <td align="left"><input type="radio" value="1"  name="Landline_Connection" >  Prepaid      <input size="10" type="radio"  name="Landline_Connection"   value="2" >                         Postpaid</td> </tr><tr><td height="30" align="left" > Salary Drawn?</td><td> <input type="radio"  value="1"  name="Salary_Drawn" > Cash &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size="10" type="radio"  name="Salary_Drawn"   value="3" >Cheque<br /><input type="radio" value="2"  name="Salary_Drawn" >  Account Transfer </td></tr></table>';
                
		}
	}
}
function addElement()
{
	
		var ni = document.getElementById('myDiv');
		 var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td height="25">Reconfirm Mobile No.</td>	<td width="158" ><input size="18" type="text" style="margin-left:8px;" maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}


function addElementccholder()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div  class="form-bg"><span class="form-text">Card held since?</span>&nbsp;<select  size="1" name="Card_Vintage" style="width:132px; margin-left:15px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></div><br><div class="form-bg"><span class="form-text">Credit Card Limit?</span>&nbsp;&nbsp;<input size="18"  name="Credit_Limit" id="Credit_Limit" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" >					';
				

			}
		}
		
		return true;

	}


function removeElementccholder()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
	function netsalarytab()
{
	
	 if ((document.getElementById('Employment_Status').value=="0" ))
       {
		 //alert(document.getElementById('Employment_Status').value);
               document.getElementById('nettab').innerHTML = "Annual Income";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
               document.getElementById('nettab').innerHTML = "Net Take Home(Monthly Salary)";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
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
</script>
</head>

<body>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" valign="middle" ><table width="97%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="23%"><img src="images/pl/pl-logo.gif" width="155" height="44" /></td>
        <td width="77%" align="left" valign="middle" id="txt-bld">Personal Loans by Choice not by Chance ! </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
     
        <td width="467" valign="top" ><table width="467" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="467" height="250" bgcolor="#2482F7" style="background-image:url(images/pl/pl-tp-lft-bl.gif); background-repeat:no-repeat; background-position:left top;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="wht-text">Special Tie ups &amp; Offers for Employees of <br />
                    Top Companies In India</td>
                </tr>
                <tr>
                  <td align="center" style="padding-top:10px;"><img src="images/pl/d4l-banner.gif" width="444" height="142" /></td>
                </tr>
            </table></td>
          </tr>
          <tr>
    <td style="background-image:url(images/pl/pl-hdr-bot-shadow.gif); background-repeat:repeat-x; height:29px;">&nbsp;</td>
          </tr>
          <tr>
            <td ><table width="450" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td height="26"   style=" background-image:url(images/pl/pl-2nd-top-curv.gif); height:26px; background-repeat:no-repeat; background-position:left bottom; color:#000000; padding-left:45px; text-align:left;">www.Deal4loans.com</td>
      </tr>
      <tr>
        <td  style="font-size:12px; font-weight:bold; text-decoration:none; vertical-align:middle;  text-align:left; color:#174C8D; line-height:18px; border-left:1px solid #3E78FF; border-right:1px solid #3E78FF; padding:8px;">The one-stop shop for best on all Personal loan requirements. Now get offers from <font color="#A82C0F">SBI,  ICICI, HDFC, Deutsche,    Citibank, HSBC, Kotak</font> choose the best deal! </td>
      </tr>

      <tr>
        <td height="9" valign="top"><img src="images/pl/pl-2nd-bot-curv.gif" width="450" height="9" /></td>
      </tr>
    </table></td>
          </tr>
          <tr>
            <td style="padding-top:8px;" ><table width="450" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="15" height="87" align="left" valign="top"><img src="images/pl/pl-lft-shap.gif" width="15" height="87" /></td>
        <td style="border-top:1px solid #3E78FF; border-bottom:1px solid #3E78FF; font-weight:normal; color:#000000; padding:8px; text-align:left;"><b>Testimonials</b><br>
I think that the launch of a service like www.deal4loans.com will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.<div style="font-weight:bold; float:right;">Divya</div>       </td>


        <td width="15" height="87" align="right" valign="top"><img src="images/pl/pl-rgt-shap.gif" width="15" height="87" /></td>
      </tr>
	  <tr>
        <td width="15" height="87" align="left" valign="top"><img src="images/pl/pl-lft-shap.gif" width="15" height="87" /></td>
        <td style="border-top:1px solid #3E78FF; border-bottom:1px solid #3E78FF; font-weight:normal; color:#000000; padding:8px; text-align:left;">Through Deal4loans.com,i was able to get comparison from different Bank instantly.With this i was able to get rate of interest of different banks.
I am really glad that i got what i wanted.
Thank u for giving me advise too.<div style="font-weight:bold; float:right;">Garima</div>       </td>


        <td width="15" height="87" align="right" valign="top"><img src="images/pl/pl-rgt-shap.gif" width="15" height="87" /></td>
      </tr>


    </table></td>
          </tr>
          <tr>
            <td >&nbsp;</td>
          </tr>
          <tr>
            <td >&nbsp;</td>
          </tr>
        </table></td>
        <td width="313"  align="left" valign="top">
		<div style=" background-image:url(images/pl/pl-tp-rgt-bl.gif); background-repeat:no-repeat; background-position:right top; background-color:#2482F7; padding-top:8px;" >
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAAD29">
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
              <td rowspan="2" valign="top" bgcolor="#FFFFFF"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="250" bgcolor="#2482F7">&nbsp;</td>
                </tr>
                <tr>
    <td style="background-image:url(images/pl/pl-hdr-bot-shadow.gif); background-repeat:repeat-x; height:29px;">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td style="padding:8px;">
			  <form name="personalloan_form"  action="pl_final_thank.php" method="POST" onsubmit="return submitform(document.personalloan_form);">
			  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="4">
			 <!-- <tr>
                  <td height="22" align="left">Activation Code </td>
                      <td align="left"><input name="Reference_Code1" type="text"   id="Reference_Code1" style=" width:135px;  " /></td>
                    </tr>
                <tr>
                  <td height="22" colspan="2" align="left" style="font-size:10px;"><input   type="checkbox" style="border:none;"  name="confirm" value="hello"  id="confirm" onClick="addElement();"  > If you havent received activation code sms</td>
                     </tr>
				   <tr><td colspan="2"><div id="myDiv"></div></td></tr>-->
                <tr>
                  <td width="43%" height="22" align="left">Email Id </td>
                      <td width="57%" align="left"><input name="Email" type="text"  id="Email" style=" width:135px;  " />                    </td>
                    </tr>
                <tr>
                  <td height="22" align="left">Pincode</td>
                      <td align="left"><input name="Pincode" type="text" onchange="intOnly(this);" maxlength="6" id="Pincode" style=" width:135px;  " onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" /></td>
                    </tr>
                <tr>
                  <td align="left">Employment Status </td>
                      <td align="left"><select name="Employment_Status" id="Employment_Status" style=" width:135px; " onChange="netsalarytab();" ><option value="-1">Please Select</option><option value="1">Salaried</option> <option value="0">Self Employed</option></select></td>
                    </tr>
                <tr>
                  <td align="left">Company Name </td>
                      <td align="left"><input name="Company_Name" type="text" id="Company_Name" style=" width:130px;  " /></td>
                    </tr>
               <!-- <tr>
                  <td height="22" align="left">Other City </td>
                      <td align="left"><input name="Name5" type="text"   id="Name5" style=" width:140px;  " /></td>
                    </tr>-->
                <tr>
                  <td  align="left"><div name="nettab" id="nettab">Annual Income</div> </td>
                      <td align="left">  <input name="IncomeAmount" id="IncomeAmount" type="text"  onFocus="this.select();"  onChange="lessnetsalary(); intOnly(this); "  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); " onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "/>
	</td>
                    </tr>
					<tr><td colspan="2"><span id='formatedIncome' style='font-size:11px; font-weight:bold;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;font-weight:bold;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
                <tr>
                  <td  align="left">Loan Amount </td>
                      <td align="left"><input name="Loan_Amount" id="Loan_Amount" type="text"  onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onKeyDown="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount');"> </td>
                    </tr>
					<tr><td colspan="2"><span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
                
                
                <tr>
                  <td align="left">Primary Account in which bank?</td>
                      <td align="left"><input type="hidden" value="PersonalLoan" name="type"><input name="Primary_Acc" type="text" id="Primary_Acc" style=" width:130px;  " /></td>
                    </tr>
                <tr>
                  <td align="left">Residential Status</td>
                      <td align="left"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
       <tr><td ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked> Owned</td><td >
     <input type="radio" style="border:none;" value="2" name="Residential_Status" > Rented</td></tr>
	 <tr>
	 <td colspan="2"><input type="radio" style="border:none;" value="3" name="Residential_Status" > 
	   Company Provided</td></tr></table></td>
                    </tr>
                <tr>
                  <td height="30" align="left">No. of years in  this Company</td>
                      <td align="left"><input name="Years_In_Company" type="text"  id="Years_In_Company" style=" width:135px;  " /></td>
                    </tr>
                <tr>
                  <td align="left">Total Experience (Years)/ Total Years in Business</td>
                      <td align="left"><input name="Total_Experience" type="text"  id="Total_Experience" style=" width:135px;  " /></td>
                    </tr>
					<tr>
                  <td align="left" height="30"> Are you a Credit card holder?</td>
				  <td>
				  <input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onclick="addElementccholder();" >
Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeElementccholder();">
No </td>
                      </tr>
					  		<tr><td colspan="2" ><div id="myDivCC"></div></td></tr>
                <tr>
                  <td height="30" align="left">Any Loan running?</td>
                  <td align="left"><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onClick="addElementLoan();"> 
                  Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  <input size="10" type="radio" style="border:none;" name="LoanAny"  onClick="removeElementLoan();" value="0" > 
                  No </td>
                </tr>
				<tr><td colspan="2" ><div id="myDivLoan"></div></td></tr>
				<tr><td colspan="2"><div id="netsalarylessthen"></div></td></tr>
				  <?php 
		if($City=='Delhi' || $City=='Noida'  ||  $City=='Gurgaon'  ||  $City=='Faridabad'  ||  $City=='Gaziabad'  ||  $City_Other=='Faridabad'  ||  $City_Other=='Greater Noida'  ||  $City=='Chennai'  ||  $City=='Mumbai'  ||  $City=='Thane'  ||  $City=='Navi mumbai'  ||  $City=='Kolkata'  ||  $City=='Kolkota'  ||  $City=='Hyderabad'  ||  $City=='Pune'  || $City=='Bangalore')
{
	
	
	echo '<tr>				<td colspan="2"><input type="checkbox"  name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank"> Get free personal accident insurance from TATA AIG</a></td></tr>';
 
  } 
  ?> 
                <tr>
                  <td height="45" colspan="2" align="center" valign="middle"><input type="image" name="Submit" src="images/pl/pl-sbtn.gif"  style="width:94px; height:28px; border:none; " /></td>
                    </tr>
                </table></form></td>
              </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="16" height="15" align="left" valign="top"><img src="images/pl/pl-2nd-left.gif" width="16" height="15" /></td>
                      <td>&nbsp;</td>
                      <td width="16" height="15" align="right" valign="bottom"><img src="images/pl/pl-2nd-rgt.gif" width="16" height="15" /></td>
                    </tr>
                </table></td>
              <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          </table>

		</div>          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  >&nbsp;</td>
  </tr>
</table>
<!-- Google Code for PL-Company Conversion Page -->
<script language="JavaScript" type="text/javascript">

var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "tAIHCNPEjgEQh8-3_AM";
if (1.0) {
 var google_conversion_value = 1.0;
}
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=tAIHCNPEjgEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</noscript>
</body>
</html>
