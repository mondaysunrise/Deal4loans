<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";

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
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		list($alreadyExist,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		$myrowcontr=count($myrow)-1;
		
		$TDated = $myrow[$myrowcontr]["Dated"];
		$TCity = $myrow[$myrowcontr]["City"];
		$Mobile = $myrow[$myrowcontr]["Mobile_Number"];
		$Dated=ExactServerdate();
		$Product_Name = "2";
		
		//$Sql = "INSERT INTO `tataaig_leads` ( T_RequestID , T_Product , T_City, Mobile_Number, T_Dated ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";

		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);
	}


		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
				list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
				$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{
			
			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
				//echo "<br>else".$InsertProductSql;
			}
			
				$ProductValue = Maininsertfunc ($Type_Loan, $data);		
			//exit();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			
			list($First,$Last) = split('[ ]', $Name);

			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";
			if(strlen(trim($Phone)) > 0)
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
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
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />
<Script Language="JavaScript">
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



function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			       
       }

       return true;
}
	
function addElement()
{
		var ni = document.getElementById('myDiv');
			var newdiv = document.createElement('div');
		if(ni.innerHTML=="")
		{
			ni.innerHTML = '<table border="0"><tr><td height="20" width="50%" align="left" valign="middle" class="formtext"><span class="form-text">Reconfirm Mobile No.</span></td>	<td colspan="3" align="left" width="50%" height="20" ><input type="text" onChange="intOnly(this);" style="width:113px;" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="RePhone" id="RePhone"></td></tr></table>';

				ni.appendChild(newdiv);
		
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
}

	
	

function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.home_loan.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td height="20"  align="left" valign="middle" class="formtext"><span class="form-text">Property Location</span></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:140px;" name="Property_Loc" id="Property_Loc"><?=getCityList1($City)?></select></td></tr></table>';
			}
			
		}
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.home_loan.Property_Identified.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" class="noBrdr" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
			}
		}
		
		return true;

}	
	
	
	
	function submitform(Form)
	{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	
		var btnvalidate;
		var cnt=-1;
		var i;
		var btn;
	//	btn=valButton(Form.Property_Identified);
	//	btnvalidate=valvalidate();
	
		/*if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				Form.confirm.focus();
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
			 if(isNaN(Form.RePhone.value)|| Form.RePhone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value");
				  Form.RePhone.focus();
				  return false;  
			}
			if (Form.RePhone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.RePhone.focus();
					return false;
			}
			if (Form.RePhone.value.charAt(0)!="9")
			{
					alert("The number should start only with 9");
					 Form.RePhone.focus();
					return false;
			}
			
		}
	}*/
	
	if((space.test(Form.day.value)) || (Form.day.value=="dd"))
	{
	alert("Kindly enter your Date of Birth");
	Form.day.select();
	return false;
	}
	
	else if(!num.test(Form.day.value))
	{
	alert("Kindly enter your Date of Birth(numbers Only)");
	Form.day.focus();
	return false;
	}
	
	else if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.focus();
	return false;
	}
	
	else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
	{
	alert("Kindly enter your Month of Birth");
	Form.month.focus();
	return false;
	}
	
	else if(!num.test(Form.month.value))
	{
	alert("Kindly enter your Month of Birth(numbers Only)");
	Form.month.focus();
	return false;
	}
	
	else if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.focus();
	return false;
	}
	
	else if((Form.month.value==2) && (Form.day.value>29))
	{
	alert("Month February cannot have more than 29 days");
	Form.day.focus();
	return false;
	}
	
	else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
	{
	alert("Kindly enter your Year of Birth");
	Form.year.focus();
	return false;
	}
	
	else if(!num.test(Form.year.value))
	{
	alert("Kindly enter your Year of Birth(numbers Only) !");
	Form.year.focus();
	return false;
	}
	
	else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
	{
	alert("February cannot have more than 28 days.");
	Form.day.focus();
	return false;
	}
	
	else if(Form.year.value.length != 4)
	{
	alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
	Form.year.focus();
	return false;
	}
	else if((Form.year.value < "1945") || (Form.year.value >"1989"))
	{
	alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
	Form.year.focus();
	return false;
	}
	else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
	{
	alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
	Form.year.focus();
	return false;
	}
	
	else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
	{
	alert("Cannot have 31st Day");Form.day.select();
	return false;
	}

	if((Form.Residence_Address.value=='')  || Trim(Form.Residence_Address.value)==false)
	{
		alert("Kindly fill in your Residence Address!");
		Form.Residence_Address.focus();
		return false;
	}

	if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='PinCod') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
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
	
	
	
	 if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please select emplyment status ");
		Form.Employment_Status.focus();
		return false;
	}

		
		
		if(Form.Company_Name.value=="")
		{
			alert("Please fill your Company Name.");
			Form.Company_Name.focus();
			return false;
		}
		
	for(i=0; i<Form.Property_Identified.length; i++) 
	{
        if(Form.Property_Identified[i].checked)
		{
   	 		cnt= i;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt ==0)
		{ 
			if(Form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				Form.Property_Loc.focus();
				return false;
			}
		}
		

		if (Form.Budget.selectedIndex==0)
			{
				alert("Please estimated market value of the property");
				Form.Budget.focus();
				return false;
			}
		if (Form.Loan_Time.selectedIndex==0)
			{
				alert("Please enter when you are planning to take loan");
				Form.Loan_Time.focus();
				return false;
			}
		return true;
	}	

	

</script>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:5px solid #E9DCB4; background-color:#F4EFE0;">
  <tr>
    <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="150" height="55" align="center" valign="middle" ><img src="images/hl_logo.gif" width="140" height="45" /></td>
            <td width="420" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#3A0303; font-size:13px; text-decoration:none; font-weight:bold;	">Home Loans by choice not by chance!!</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="197" height="160" align="left" valign="top"><img src="images/hl_headr_lft.jpg" width="197" height="160" /></td>
            <td width="175" align="left"><img src="images/hl_header-mdl.jpg" width="175" height="160" /></td>
            <td width="208"><img src="images/hl_header_rgt.jpg" width="208" height="160" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td style="padding:5px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="303" align="left" valign="top"><table width="100%" height="270" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" valign="middle" background="images/hl_form_bg.gif" style="background-repeat:no-repeat; width:303px; height:44px; background-position:top;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="40" align="center" class="heading">Home Loan Quotes </td>
                  </tr>
                  <tr>
                    <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; ">
					<form name="home_loan"  action="home-loan-apply-thank.php" method="post" onSubmit="return submitform(document.home_loan);" >
					
					<table width="98%" border="0" align="right" cellpadding="0" cellspacing="4">
                    
                     <!-- <tr>
                        <td height="20" align="left" valign="middle" class="formtext"><span class="form-text">Activation Code? </span></td>
                        <td class="subheading"><span class="formtext">
			                  <input type="text" name="Reference_Code1" style="width:140px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" />
                        </span></td>
                      </tr>
                      <tr>
                        <td height="20" colspan="2" align="left" valign="middle" class="subheading"><input  name="confirm" onClick="addElement();" value="hello" id="validate" style="border:none;" type="checkbox" />&nbsp;if you havent received activation code sms </td>
                        </tr>
											
					<tr><td colspan="2" id="myDiv" ></td></tr>-->

                      <tr>
                        <td width="120" height="25" align="left" valign="middle" class="formtext"><b>Date of Birth </b></td>
                        <td width="159"><input type="text" value="dd" name="day" id="day" maxlength="2" style="width:28px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');"/>&nbsp;<input type="text" name="month" id="month" maxlength="2" style="width:28px;"  onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" />&nbsp;<input type="text" maxlength="4" value="yyyy" name="year" id="year" style="width:64px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" /></td>
                      </tr>
                      <!--<tr>
                        <td width="120" height="40" align="left" valign="middle" class="formtext"><b>Current Residence Address</b></td>
                        <td><input type="text" name="Residence_Address" id="Residence_Address" style="width:140px; height:35px;"/></td>
                      </tr>-->
                      <tr>
                        <td height="25" align="left" valign="middle" class="formtext"><b>Pincode</b></td>
                        <td><input name="Pincode" type="text" id="Pincode" style="width:140px;" onFocus="this.select();" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  maxlength="6" /></td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="middle" class="formtext"><b>Employment Status </b></td>
                        <td><select style="width:145px;" name="Employment_Status" id="Employment_Status">
								<option selected value="-1">Employment Status</option>
								<option  value="1">Salaried</option>
								<option value="0">Self Employed</option>
                            </select></td>
                      </tr>
                      <tr>
                        <td height="25" align="left" valign="middle" class="formtext"><b>Company Name </b></td>
                        <td><input type="text" name="Company_Name" id="Company_Name" style="width:140px;"/></td>
                      </tr>
                      <tr>
                        <td width="120" height="20" align="left" valign="middle" class="formtext"><b>Property Identified</b></td>
                        <td class="formtext">
						
						<input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" /> Yes&nbsp;&nbsp;<input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" /> No</td>
                      </tr>
                      	<tr><td colspan="2" id="myDiv1"></td></tr>
						<tr><td colspan="2" id="myDiv2"></td></tr>
					  
					  <tr>
                                  <td height="26" align="left" valign="middle" class="formtext"><b>Property Value</b></td>
                                  <td><input type="text" name="Property_Value" id="Property_Value" style="width:140px;" onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onKeyPress="intOnly(this); getDigitToWords('Property_Value', 'formatedPV','wordloanAmount');" onKeyDown="getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onBlur="getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue');"/></td>
                                </tr>
								 <tr>
                                <td colspan="2" align="left" valign="middle" class="formtext"><span id='formatedPV' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordpropertyvalue' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
                      <tr>
                        <td height="50" align="left" valign="middle" class="formtext"><span class="form-text"><b>When you are planning to take loan?</b></span></td>
                        <td><select name="Loan_Time" style="width:145px;">
                            <OPTION value="-1" selected>Please select</OPTION>
							<OPTION value="15 days">15 days</OPTION>
							<OPTION value="1 month">1 months</OPTION>
							<OPTION value="2 months">2 months</OPTION>
							<OPTION value="3 months">3 months</OPTION>
							<OPTION value="3 months above">more than 3 months</OPTION>
							</select>
							   
							<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>" />
							<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
							
							<input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>" />
							<input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
							<input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>" />							   </td>
                      </tr>
                     
			
                      <tr>
                        <td colspan="2" align="center" valign="middle">
						
						  <input value="Get Quotes" name="submit" type="submit" class="hlbtn" />						</td>
                        </tr>
                    </table>
					</form></td>
                  </tr>
                </table></td>
              </tr>
              
              
            </table></td>
			<td width="">&nbsp;</td>
			
            <td align="center" valign="top" background="images/hl_rgt-tp-bg.gif" style="background-repeat:no-repeat; width:272px; height:44px; background-position:top;"><table width="100%" height="260" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="padding-bottom:5px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="40" align="center" class="heading">Just 3 easy steps!</td>
                      </tr>
                      <tr>
                        <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; padding-bottom:4px; "><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="22" height="20" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td width="245" class="subheading"> Post your Home Loan requirement. </td>
                            </tr>
                            <tr>
                              <td width="22" height="20" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td class="subheading"> Get &amp; Compare Home Loan Offers. </td>
                            </tr>
                            <tr>
                              <td width="22" height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td class="subheading"> Get the Best Deal for your Home Loan. </td>
                            </tr>
                            
                            
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td height="32" align="center" valign="top" class="heading">www.deal4loans.com</td>
                    </tr>
                    <tr>
                      <td class="text">The one-stop shop for Best on Home loan<br />
                        requirements Now get offers from <b class="text" style="font-weight:bold; color:#7d0606;">LIC Home Finance, HDFC Ltd, ICICI, ICICI Home Finance, IDBI, DHFL, SBI, Axis Bank, Canara Bank, Citibank, Deutsche Bank, Deutsche Post Housing Finance, ING VYSYA, Standard Chartered, Punjab National Bank,  SBI-EASY Home Loans, Allahbad Bank, Axis Bank, Bank of India, Bank of Baroda, Bank of Maharashtra </b> and Choose the Best Deal!</td>
                    </tr>
                    
                    <tr>
                      <td align="left"  class="text"></td>
                    </tr>
                    <tr>
                      <td height="40" align="right" ><a href="http://www.deal4loans.com" target="_blank" class="subheading" style="font-size:12px; text-decoration:underline; font-weight:bold;">www.deal4loans.com</a></td>
                    </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF; "><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="33" align="left" class="heading">Testimonials</td>
      </tr>
      <tr>
        <td class="text">I am glad that i could get 3 quotes on my loan requirement instantly that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. </td>
      </tr>
      
      <tr>
        <td height="25" align="right" valign="top"  ><b class="subheading" style=" text-decoration:none;">- By Jeffrey</b></td>
      </tr>
    </table></td>
	
      </tr>
	  <tr>
	  <td height="5"></td>
	  </tr>
	  
      <tr>
<td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="33" align="left" class="heading">Helpful tips <span class="subheading" style=" font-style:normal;">to get the best Home Loan deal.</span></td>
      </tr>
      <tr>
        <td class="text">Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are</td>
      </tr>
      
      <tr>
        <td height="25" align="right" valign="top"  style="padding :8px 0px;"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="subheading" style="line-height:16px;">
&raquo; Eligibility <br />
&raquo; Interest rates best suited. <br />
&raquo; Fixed interest loans or Floating. <br />
&raquo; Other costs. <br />
&raquo; Document required. <br />
&raquo; Penalties. </td>
            <td align="right" valign="bottom"><a href="http://www.deal4loans.com/Contents_Home_Loan_Mustread.php" target="_blank" class="subheading" style="font-size:12px; text-decoration:underline; font-weight:bold;">Know more....</a></td>
          </tr>
        </table>          </td>
      </tr>
    </table></td>      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
