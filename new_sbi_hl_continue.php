<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";
//print_r($_POST);
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
	$Net_Salary = $_POST['Net_Salary'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	//$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	$hdfclife=$_REQUEST['hdfclife'];
	//$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
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
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
				//echo "<br>else".$InsertProductSql;
			}
			
				$ProductValue = Maininsertfunc ($Type_Loan, $data);
			
			if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}
			
			list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SBI Home Loan | SBI | Documents Requirement and EMI of SBI Home Loans India | Deal4loans</title>
<meta name="keywords" content="SBI Home Loan, SBI Bank, Home Loan India, Documents for Home Loan, EMI">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="SBI provides easy Home Loan at very low interest and with less document formality. Get home loan from State Bank of India at easy EMI option.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>





<Script Language="JavaScript">



function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.loan_form.day.value=="" || document.loan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
	 if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.loan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
	if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.loan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
		if(document.loan_form.year.value!="")
	{
	  if((document.loan_form.year.value < "1945") || (document.loan_form.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.loan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	
	if (document.loan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		document.loan_form.Pincode.focus();
		return false;
	}
	}
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
	//alert(document.loan_form.Property_Identified.length);
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt ==0)
		{ 
			if(document.loan_form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				document.loan_form.Property_Loc.focus();
				return false;
			}
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

function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="20"  align="left" valign="middle" class="frmbldtxt"><b style="color:#373737;">Property Location</b></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:150px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '';
			
		return true;

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
</script>
<Script Language="JavaScript">
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
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
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

	window.onload = ajaxFunctionMain;

/*function OnloadCalls()
	{
		ajaxFunction();
		
		
	}
	window.onload = OnloadCalls;*/
</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > Apply Home Loan</span>
  
	<div id="txt"><h1  >State Bank Of India Home Loan</h1>
   The Most Preferred  Home Loan provider SBI Bank offers a <a href="http://www.deal4loans.com/home-loans.php" title="Home Loan">Home Loan</a> with Attractive Interest Rates with Latest Schemes and Benefits. <a href="http://www.deal4loans.com/loans/banks/sbi-state-bank-of-india-loan/">SBI</a> also  provides a <a href="http://www.deal4loans.com/home-loans.php" title="Housing loan">Housing loan</a> with different schemes. Schemes Are:- <br>
1. SBI Easy Home Loan<br>
2. SBI Advantage Home Loan<br>
3. SBI Housing Finance Scheme<br>
4. SBI Happy Home Loans<br>
5. SBI Life Style Loan<br>
6. SBI Green Home Loan<br>
7. SBI Home Plus<br>
8. SBI Home Line<br>
9. SBI MY HOME CAMPAIGN<br>

 

 	 
 <form name="loan_form" method="post" action="apply-home-loan-thank.php" onSubmit="return chkform();">
	<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>" />
							<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
							
							<input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>" />
							<input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
							<input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>" />	
							<input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $Loan_Amount; ?>" />
							<input type="hidden" name="City_Other" id="City_Other" value="<?php echo $City_Other; ?>" /></td>
              <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
         
          <tr>
            <td colspan="5" style="padding:2px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply For SBI Home Loan</h1></td>
  </tr>
</table></td>
            </tr>

          <tr>
            <td colspan="5" valign="top" class="frmbldtxt"></td>
            </tr>
           <tr>
             <td  colspan="5" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td width="19%" height="25" class="frmbldtxt" style="padding-top:3px; ">DOB :</td>
                     <td width="33%" height="25" class="frmbldtxt"  style="padding-top:3px; "><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"  tabindex="1"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"tabindex="2" />
                         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="3"/></td>
                     
                     <td width="17%" height="25" class="frmbldtxt" style="padding-top:3px; ">Occupation :</td>
                     <td width="31%" height="25" class="frmbldtxt"  style="padding-top:3px; "><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="5" >
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                      <td height="25" class="frmbldtxt">Pincode :</td>
                     <td height="25" class="frmbldtxt">
                       <input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  tabindex="4" /></td>
                     <td height="25" align="left" class="frmbldtxt">Property Value :</td>
                     <td height="25" class="frmbldtxt"><input type="text" name="Property_Value"  id="Property_Value" style="width:148px;" maxlength="30"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="6" /></td>
                   </tr>
                   <tr valign="middle">
                    <td height="25" colspan="2" class="frmbldtxt">Total Monthly EMI for all running loans :
                     </td><td width="17%" height="25">&nbsp;</td>
					   <td width="31%" height="25" class="frmbldtxt"  style="padding-top:3px; "> <input type="text" name="obligations" id="obligations" style="width:148px;"    onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="9"/></td>
                     </tr>
					 <tr valign="middle">
                    <td height="25" colspan="2" class="frmbldtxt">When you are planning to take loan: &nbsp;</td><td width="17%" height="25">&nbsp;</td>
					 <td width="31%" height="25" class="frmbldtxt"  style="padding-top:3px; " > <select name="Loan_Time" style="width:140px;" tabindex="10">
                            <OPTION value="-1" selected>Please select</OPTION>
							<OPTION value="15 days">15 days</OPTION>
							<OPTION value="1 month">1 months</OPTION>
							<OPTION value="2 months">2 months</OPTION>
							<OPTION value="3 months">3 months</OPTION>
							<OPTION value="3 months above">more than 3 months</OPTION>
							</select>  </td>
                    
                     </tr>
                  
                  
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" class="frmbldtxt">Property Identified :</td>
                <td class="frmbldtxt"> <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="addIdentified();" style="border:none;" tabindex="14" />
      Yes&nbsp;&nbsp;
      <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" tabindex="7" />
      No               </td>
              </tr>
			   <tr>
                <td height="25" class="frmbldtxt" colspan="2"><div id="myDiv1"></div>           </td>
              </tr>
	       </table></td>
               </tr>
             </table></td>
           </tr>
		    <tr>
             <td height="22"  colspan="5" align="left" class="frmbldtxt"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;" tabindex="18">&nbsp; Co- Applicant</td>
           </tr>
		 
           <tr>
             <td  colspan="5" align="left" class="frmbldtxt">
			 			
												<div style="display:none; " id="divfaq1">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="12%" class="frmbldtxt" height="30"><b> Name :</b></td>
          <td width="23%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_name" id="co_name" style="width:149px;" tabindex="19" maxlength="30" value="<?php echo $co_name; ?>" >
            </span></td>
          <td width="11%" align="left"><b>DOB : </b></td>
          <td width="21%" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
            <input name="co_month" type="text" id="co_month" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="21" />
            <input name="co_year" type="text" id="co_year" style="width:53px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="22" /></td>
          <td width="16%" height="30" class="frmbldtxt"><b> Net Monthly Income : </b></td>
          <td width="17%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:148px;" value="<?php echo $income; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="23" />
          </span></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2" class="frmbldtxt"><b> Total Monthly EMI for all running loans : </b></td>
          <td align="left"><span class="frmbldtxt">
            <input type="text" name="co_obligations" id="co_obligations" tabindex="24" style="width:148px;" value="<?php echo $obligations; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
          </span></td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
                    </tr>
		</table>
      	 
     </div>
									
			 </td>
           </tr>
           
           <tr>
             <td height="22"  colspan="4" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked>
              I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
			  <td width="25%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
           </tr>


          
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form>
	</div>
<b>Current Rate of Interest</b>
 <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
   <tr>
     <td height="25" align="center" bgcolor="#494949" class="tblwt_txt">Loan Schemes </td>
     <td align="center" bgcolor="#494949" class="tblwt_txt">1st Year </td>
	  <td align="center" bgcolor="#494949" class="tblwt_txt">2nd and 3rd year
</td>
   <td align="center" bgcolor="#494949" class="tblwt_txt">After 3rd Year
</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">SBI HI-FIVE Loan <br /> 
       Loan Amount upto Rs. 5 Lacs     </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.00% (p.a.)<br />
       Fixed interest rate
</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
	   Floating Interest Rates<br />
	   <b>OR</b><br />
	   10.50% (p.a.)<br />
	   Fixed Interest Rates

</td>
   <td align="center" valign="top"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
     Floating Interest Rates<br />
     <b>OR</b><br />
10.50% (p.a.)<br />
Fixed Interest Rates </td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">SBI Easy Home Loan <br />
    Loan Amount upto Rs. 50 Lacs </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.00% (p.a.)<br /> 
       Fixed interest rate
</td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.50% (p.a.)<br />
       Fixed Interest Rate
</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
     Floating Interest Rate
<br />
<b>OR</b><br />
10.50% (p.a.)<br />
Fixed Interest Rate

</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">SBI Advantage Home Loan <br />
    Loan Amount Above Rs. 50 Lacs </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.00% (p.a.)<br /> 
       Fixed interest rate </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
       Fixed Interest Rates </td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">10.00% (p.a.)<br />
     Floating Interest Rate
<br />
     <b>OR</b><br />
11.00% (p.a.)<br />
Fixed Interest Rate
 </td>
   </tr>
</table> 
<font color="#FF0000">Note:- Interest rate after three years may be Fixed or Floating as per the borrower’s choice made at the time of sanction.</font><br />
<br />

       <b>Features & Benefits of <a href="sbi-home-loan.php">SBI Home Loan</a></b> <br>
&bull; Purchase/ Construction of House/ Flat<br>
&bull; Purchase of a plot of land for construction of House<br>
&bull; Lowest <a href="http://www.deal4loans.com/home-loans-interest-rates.php" title="Home Loan Interest Rate">Home Loan Interest Rate</a>..<br>

&bull; Extension/ repair/ renovation/ alteration of an existing House/ Flat<br>
&bull; Purchase of Furnishings and Consumer Durables as a part of the project cost.<br>
&bull; Takeover of an existing loan from other Banks/ <a href="home-loan-banks.php">Housing Finance Companies</a>.<br>
&bull; Interest charged on the daily reducing balance<br>
&bull; No penalty on prepayments of <a href="home-loans.php">home loan</a><br>
&bull; No hidden costs<br>
&bull; Option to club income of your spouse and children to compute eligible loan &nbsp;&nbsp;&nbsp;amount<br>
&bull; Provision to club depreciation, expected rent accruals from property proposed  to compute eligible loan amount<br>
&bull; Provision to finance cost of furnishing and consumer durables as part of  project cost<br />
<br />
</p> 


<b>Eligibility Criteria  &amp; Documentation required for <a href="sbi-home-loan.php">SBI Home Loan</a></b>
 <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
   <tr>
     <td height="25" bgcolor="#494949" class="tblwt_txt">&nbsp;</td>
     <td align="center" bgcolor="#494949" class="tblwt_txt">Salaried</td>
	  <td align="center" bgcolor="#494949" class="tblwt_txt">Self employed</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Age</td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">21years to 60years</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">21years    to 70years</td>
   </tr>
   <tr>
   <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Income</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Rs.1,20,000    (p.a.)</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Rs.2,00,000 (p.a.)</td>
   </tr>
   <tr>
    <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Loan    Amount Offered</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5,00,000    - 1,00,00000</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5,00,000 - 2,00,00000</td>
   </tr>
     <tr>
    <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Tenure</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5years-20years</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5years-20years</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Current Experience </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">2years</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">3years</td>
   </tr>
   
   <tr>
    <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Documentation</td>
     <td align="left"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:left; ">1) Application form with photograph<br>
2) Identity &amp; residence proof<br>
3) Last 3 months salary slip <br>
4) Form 16<br>
5) Last 6 months bank salaried credit statements<br> 
6) Processing fee cheque</td>
     <td align="left"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:left; "> 1) Application  form with photograph<br>
       2) Identity &amp; residence proof<br>
       3) Education qualifications certificate &amp; proof of business existence<br>
       4) Business  profile,<br>
       5) Last 3 years profit/loss &amp; balance sheet<br>
       6) Last 6 months bank statements<br>
       7) Processing fee cheque</td>
   </tr>
</table></p>
<b>Other Products from SBI (State bank of India)</b>
<br>
1. <a href="http://www.deal4loans.com/sbi-home-loan.php" title="SBI Home Loan">SBI  Home Loan</a><br>
2. <a href="http://www.deal4loans.com/personal-loan-sbi.php" title="SBI Personal Loan">SBI  Personal Loan</a><br>
3. <a href="http://www.deal4loans.com/home-loan-sbi.php" title="SBI Housing Loan">SBI  Housing Loan</a> <br>
4. <a href="http://www.deal4loans.com/loans/banks/sbi-credit-cards/" title="SBI Card">SBI Card</a> <br>
<br>
<b>Information on deposits & Loan Schemes and services also available. Call 1800112211<br /> 
(Tollfree from BSNL/MTNL)</b>
<br />

<p><b>Registered Office-</b>State Bank of India<br>
State Bank Bhavan Central Office 8th Floor, <br>
Madame Cama Marg, Nariman Point,<br>
Mumbai - 400021<br>
Maharashtra - India<br>
<br/>
<!--<table width="100%" cellpadding="0"cellspacing="0" align="center" border="0" valign="bottom">
	     <tr><td>
	  <a name="rating">-->
	  <?
//include "Rating/rating-code.php";
?>
<!--</a>
</td></tr><tr><td align="right"><a href="rate-your-banks.php"><b>Rate More Banks</b></a></td></tr></table>
<br>-->
<b>Disclaimer :</b> Please note that the interest rates and  eligibility criteria given here are based on the market research. To enable the  comparisons certain set of data has been reorganized / restructured / tabulated  .Users are advised to recheck the same with the individual companies /  organizations. This site does not take any responsibility for any sudden /  uninformed changes in interest rates.<br />
<br />
<a href="home-loans-interest-rates.php"  class="blue-text" style="text-decoration:underline;"><b>Compare Home Loan Rate of interest</b></a><br/>
      <br>   
  
		<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>




  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>
</html>