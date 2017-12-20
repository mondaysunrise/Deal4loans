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
		list($alreadyExist,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$RowGetDatecontr=count($RowGetDate)-1;
		$Dated = ExactServerdate();
		$TDated = $RowGetDate[$RowGetDatecontr]['Dated'];
		$TCity = $RowGetDate[$RowGetDatecontr]['City'];
		$Mobile = $RowGetDate[$RowGetDatecontr]['Mobile_Number'];
		$Product_Name = "2";
		
		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
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
			$myrowcontr=count($myrow)-1;
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
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);		
			
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			}
			
			$ProductValue = Maininsertfunc ($Type_Loan, $data);
			//exit();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.";
			if(strlen(trim($Phone)) > 0)
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
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
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose the Best Deal.">
<meta name="keywords" content=" Property Loans to buy Flats, Apartments, Bungalow, studio apartments, Designer flats.
Property Loans for property in Delhi, Bangalore, Mumbai,  Pune, Chennai, Hyderabad, Chandigarh, Ahmedabad. ">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />
<style type="text/css">
.bnksname {	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#403c3c;
	font-weight:bold;
}
.qote {	background-image:url(new-images/hl-quote.gif) ;
	background-repeat:no-repeat ;
	width:127px ;
	height:33px ;
	font-size:0px;
	color:#f4efe0;
}
</style>

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

function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
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
				ni.innerHTML = '<table border="0"><tr><td height="20"  align="left" valign="middle" class="formtext"><span class="form-text"><b>Property Location</b></span></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;<select style="width:145px;" name="Property_Loc" id="Property_Loc"><?=getCityList1($City)?></select></td></tr></table>';
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
				ni1.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" style="border:none;" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
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

	/*if((Form.Residence_Address.value=='')  || Trim(Form.Residence_Address.value)==false)
	{
		alert("Kindly fill in your Residence Address!");
		Form.Residence_Address.focus();
		return false;
	}*/

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
            <td width="197" height="160" align="left" valign="top"><img src="images/hl_headr_lft1.jpg" width="197" height="160" /></td>
            <td width="175" align="left"><img src="images/hl_header-mdl1.jpg" width="175" height="160" /></td>
            <td width="208"><img src="images/hl_header_rgt1.jpg" width="208" height="160" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td style="padding-top:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" valign="top" background="images/hl_rgt-tp-bg.gif" style="background-repeat:no-repeat; width:272px; height:44px; background-position:top;"><table width="100%" height="260" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding-bottom:5px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="40" align="center" class="heading">Just 3 easy steps!</td>
                        </tr>
                        <tr>
                          <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; padding-bottom:4px; "><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="22" height="20" align="center" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td width="239" class="formtext"> Post your Property Loan requirement</td>
                            </tr>
                            <tr>
                              <td width="22" height="20" align="center" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td class="formtext"> Get &amp; Compare Property Loan Offers</td>
                            </tr>
                            <tr>
                              <td width="22" height="19" align="center" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td class="formtext"> Get the Best Deal for your Property Loan</td>
                            </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                        <tr>
                          <td height="30" align="center" valign="top" class="heading">www.deal4loans.com</td>
                        </tr>
                        <tr>
                          <td class="text" style="padding-bottom:3px;">The one-stop shop for Best on Property Loan 
                      requirements Now Get Offers from</td>
                        </tr>
                        <tr>
                          <td height="261"  align="center" valign="top" background="new-images/hl-logo.gif" style=" background-repeat:no-repeat; background-position:center; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="28">&nbsp;</td>
                                <td align="left" valign="middle" class="bnksname">State Bank of India </td>
                              </tr>
                              <tr>
                                <td height="37">&nbsp;</td>
                                <td align="left" valign="middle" class="bnksname">ICICI Bank </td>
                              </tr>
                              <tr>
                                <td height="28">&nbsp;</td>
                                <td align="left" valign="middle" class="bnksname"> IDBI Bank </td>
                              </tr>
                              <tr>
                                <td width="41%" height="35">&nbsp;</td>
                                <td width="59%" align="left" valign="middle" class="bnksname">LIC Housing Finance </td>
                              </tr>
                              <tr>
                                <td height="35">&nbsp;</td>
                                <td align="left" valign="middle" class="bnksname">Axis Bank </td>
                              </tr>
                              <tr>
                                <td height="35">&nbsp;</td>
                                <td align="left" valign="middle" class="bnksname">HDFC Ltd </td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left"  class="text"></td>
                        </tr>
                        <tr>
                          <td height="38" align="right" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="25" align="right" class="formtext" style="text-align:right; " ><b>www.deal4loans.com</b></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
              <td width="">&nbsp;</td>
              <td width="303" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="600" align="center" valign="middle" background="images/hl_form_bg.gif" style="background-repeat:no-repeat; width:303px; height:44px; background-position:top;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="40" align="center" class="heading">Home Loan Quotes </td>
                        </tr>
                        <tr>
                          <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; "><form  action="home-loan-apply-thank.php" method="post" name="home_loan" id="home_loan" onsubmit="return submitform(document.home_loan);" >
                              <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
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
                                  <td width="130" height="26" align="left" valign="middle" class="formtext"><b>Date of Birth </b></td>
                                  <td width="161"><input type="text" value="dd" name="day" id="day" maxlength="2" style="width:35px;"  onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onblur="onBlurDefault(this,'dd');"  onfocus="onFocusBlank(this,'dd');"/> <input type="text" name="month" id="month" maxlength="2" style="width:35px;"  onchange="intOnly(this);" value="mm"  onkeyup="intOnly(this);" onkeypress="intOnly(this)" onblur="onBlurDefault(this,'mm');"  onfocus="onFocusBlank(this,'mm');" /> <input type="text" maxlength="4" value="yyyy" name="year" id="year" style="width:50px;"  onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" /></td>
                                </tr>
                                <!-- <tr>
                        <td width="120" height="20" align="left" valign="middle" class="formtext">Current Residence Address</td>
                        <td><input type="text" name="Residence_Address" id="Residence_Address" style="width:140px; height:35px;"/></td>
                      </tr> -->
                                <tr>
                                  <td height="26" align="left" valign="middle" class="formtext"><b>Pincode</b></td>
                                  <td><input name="Pincode" type="text" id="Pincode" style="width:140px;" onfocus="this.select();" onchange="intOnly(this);" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  maxlength="6" /></td>
                                </tr>
                                <tr>
                                  <td height="26" align="left" valign="middle" class="formtext"><b>Employment Status </b></td>
                                  <td><select style="width:145px;" name="Employment_Status" id="Employment_Status">
                                      <option selected="selected" value="-1">Employment Status</option>
                                      <option  value="1">Salaried</option>
                                      <option value="0">Self Employed</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td height="26" align="left" valign="middle" class="formtext"><b>Company Name </b></td>
                                  <td><input type="text" name="Company_Name" id="Company_Name" style="width:140px;"/></td>
                                </tr>
                                <tr>
                                  <td width="130" height="26" align="left" valign="middle" class="formtext"><b>Property Identified</b></td>
                                  <td class="formtext"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="addIdentified();" style="border:none;" />
                              Yes&nbsp;&nbsp;
                              <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" />
                              No</td>
                                </tr>
                                <tr>
                                  <td   colspan="2" id="myDiv1"></td>
                                </tr>
                                <tr>
                                  <td   colspan="2" id="myDiv2"></td>
                                </tr>
                                <!-- <tr>
                        <td height="20" align="left" valign="middle" class="formtext"><span class="form-text">Estimated market value of the property?</span></td>
                        <td><select name="Budget" style="width:145px;" >
					<option value="-1" selected>Please Select</option>
                <option value="0-20 Lakhs">0-20 Lakhs </option>
                <option value="20-40 Lakhs">20-40 Lakhs </option>
                <option value="40-75 Lakhs">40-75 Lakhs </option>
                 <option value="Above 75 Lakhs">Above 75 Lakhs</option>
                        </select></td>
                      </tr> -->
                                <tr>
                                  <td height="26" align="left" valign="middle" class="formtext"><span class="form-text"><b>Property Value</b></span></td>
                                  <td><input type="text" name="Property_Value" id="Property_Value" style="width:140px;"/></td>
                                </tr>
                                <tr>
                                  <td height="32" align="left" valign="middle" class="formtext"><span class="form-text"><b>Total Amount of EMI's </b>(Per Month)</span></td>
                                  <td><input type="text" name="obligations" id="obligations" style="width:140px;"    onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="17" /></td>
                                </tr>
                                <tr>
                                  <td height="50" align="left" valign="middle" class="formtext"><span class="form-text"><b>When you are planning to take loan?</b></span></td>
                                  <td><select name="Loan_Time" style="width:144px;">
                                      <option value="-1" selected="selected">Please select</option>
                                      <option value="15 days">15 days</option>
                                      <option value="1 month">1 months</option>
                                      <option value="2 months">2 months</option>
                                      <option value="3 months">3 months</option>
                                      <option value="3 months above">more than 3 months</option>
                                    </select>
                                      <input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>" />
                                      <input type="hidden" name="Type_Loan" value="Req_Loan_Home" />
                                      <input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>" />
                                      <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
                                      <input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $Loan_Amount; ?>" />
                                      <input type="hidden" name="City_Other" id="City_Other" value="<?php echo $City_Other; ?>" />
                                      <input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>" />
                                  </td>
                                </tr>
                                <tr>
                                  <td height="26" align="left" valign="middle" class="formtext" colspan="2"><span class="form-text">
                                    <input type="checkbox" name="co_appli" id="co_appli" value="1" onclick="return showdetailsFaq(1,12);" style="border:none;" tabindex="18" />
                                    <b>Co- Applicant</b></span></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><div style="display:none;" id="divfaq1">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                          <td width="130"  class="formtext" height="30"><b>Name </b></td>
                                          <td width="161" align="left"><span class="formtext">
                                            <input type="text" name="co_name" id="co_name" style="width:140px;" tabindex="19" maxlength="30" />
                                          </span></td>
                                        </tr>
                                        <tr>
                                          <td width="130" align="left" class="formtext"><b>DOB </b> </td>
                                          <td width="161" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:35px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
                                              <input name="co_month" type="text" id="co_month" style="width:35px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="21" />
                                              <input name="co_year" type="text" id="co_year" style="width:50px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="22" /></td>
                                        </tr>
                                        <tr>
                                          <td width="130" height="30" class="formtext"><b>Net Monthly Income </b></td>
                                          <td width="161" align="left"><span class="formtext">
                                            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:140px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="23" />
                                          </span></td>
                                        </tr>
                                        <tr>
                                          <td height="30" class="formtext"><b>Consolidated EMI's</b> (Per Month) </td>
                                          <td align="left"><span class="formtext">
                                            <input type="text" name="co_obligations" id="co_obligations" tabindex="24" style="width:140px;"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
                                          </span></td>
                                        </tr>
                                      </table>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td height="45" colspan="2" align="center" valign="middle"><input value="Get Quotes" name="submit" type="submit" class="qote" style="border:none; " />
                                  </td>
                                </tr>
                              </table>
                          </form></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  style="padding:5px 0px; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td style="background-color:#EFE6CB; border:3px solid #FFFFFF; padding:5px 0px; "><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                              <tr>
                                <td height="30" align="center" valign="top" class="heading">Testimonials</td>
                              </tr>
                              <tr>
                                <td class="text">I am glad that i could get 3 quotes on my loan requirement instantly that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. </td>
                              </tr>
                              <tr>
                                <td align="left"  class="text"></td>
                              </tr>
                              <tr>
                                <td align="right" valign="middle" ><b class="subheading" style=" text-decoration:none;">- By Jeffrey</b></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
	 
      <tr>
<td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="33" align="left" class="heading">Property Loans </td>
  </tr>
  <tr>
    <td class="text"> Property Loans to buy Flats, Apartments, Bungalow, studio apartments, Designer flats. Property Loans for property in Delhi, Bangalore, Mumbai, Pune, Chennai, Hyderabad, Chandigarh, Ahmedabad. </td>
  </tr>
</table></td>      </tr>
    </table></td>
  </tr>
</table>


<?  if((strlen(strpos($_SERVER['HTTP_REFERER'], "flats-home-loan-property.php")) > 0))
	 { ?>	 

<!-- Google Code for Flats-HL Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "tAIHCNPEjgEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=tAIHCNPEjgEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "home-loan-property.php")) > 0))
	 {?>

<!-- Google Code for Property-HL Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "45mqCJWe0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=45mqCJWe0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "appartment-home-loan-property.php")) > 0))
	 {?>

<!-- Google Code for Home Loans Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "p-B1CLH8iAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=p-B1CLH8iAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<? } ?>

</body>
</html>
