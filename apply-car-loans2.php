<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$retrivesource = $_SESSION['source'];
       $page_Name = "CarLoan";

	    if ($_SESSION['flag']==1)
		{
		$source="partner1";
		}

	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		
		//$PWD1 = FixString($PWD1);
		$FName = FixString($FName);
		$LName = FixString($LName);
		$Name=$FName." ".$LName;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Car_Insurance = FixString($Car_Insurance);
		$Std_Code2 = FixString($Std_Code2);
		$Employment_Status = FixString($Employment_Status);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Activate =FixString($Activate);
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($Net_Salary);
		$Car_Make = FixString($Car_Make);
		$Pincode = FixString($Pincode);
		$Contact_Time = FixString($Contact_Time);
		$Car_Model = FixString($Car_Model);
		$Car_Type = FixString($Car_Type);
		$Loan_Tenure = FixString($Loan_Tenure);
		$Loan_Amount = FixString($Loan_Amount);
		$activation_code = FixString($activation_code);
		$reference_code = FixString($reference_code);
		$Descr = FixString($Descr);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
	   $IsPublic = 1;
	   if($reference_code==$activation_code)
		{
		   $Is_Valid=1;
		}
		else
		{
			$Is_Valid=0;
		}
		
		/* FIX STRINGS */
	if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "CarLoan";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $FName;
			$_SERVER['Temp_LName'] = $LName;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Phone1'] = $Phone1;
			$_SERVER['Temp_Phone2'] = $Phone2;
			$_SERVER['Temp_Std_Code1'] = $Std_Code1;
			$_SERVER['Temp_Std_Code2'] = $Std_Code2;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Flag'] = "0";
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_Car_Make'] = $Car_Make;
			$_SERVER['Temp_Car_Model'] = $Car_Model;
			$_SERVER['Temp_Car_Type'] = $Car_Type;
			$_SERVER['Temp_Loan_Tenure'] = $Loan_Tenure;
			$_SERVER['Temp_Loan_Amount'] = $Loan_Amount;
			$_SERVER['Temp_Descr'] = $Descr;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
	
	else
		{
			$_SESSION['Temp_Type'] = "CarLoan";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_FName'] = $FName;
			$_SESSION['Temp_LName'] = $LName;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_Phone1'] = $Phone1;
			$_SESSION['Temp_Phone2'] = $Phone2;
			$_SESSION['Temp_Std_Code1'] = $Std_Code1;
			$_SESSION['Temp_Std_Code2'] = $Std_Code2;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Email'] = $Email;
			$_SESSION['Temp_Flag'] = "0";
			$_SESSION['Temp_Employment_Status'] = $Employment_Status;
			$_SESSION['Temp_Company_Name'] = $Company_Name;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			$_SESSION['Temp_Net_Salary'] = $Net_Salary;
			$_SESSION['Temp_Car_Make'] = $Car_Make;
			$_SESSION['Temp_Car_Model'] = $Car_Model;
			$_SESSION['Temp_Car_Type'] = $Car_Type;
			$_SESSION['Temp_Loan_Tenure'] = $Loan_Tenure;
			$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
			$_SESSION['Temp_Descr'] = $Descr;
			$_SESSION['Temp_IsPublic'] = $IsPublic;
	    }
if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where  IncompeletID=".$Activate;		
	Maindeletefunc($DeleteIncompleteSql,$array = array());
	}

		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
			if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		
		list($First,$Last) = split('[ ]', $Name);
		
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Car loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);

		if(isset($_SESSION['UserType'])) 
		{
			
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance, "Is_Valid"=>$Is_Valid, "Reference_Code"=>$reference_code, "Updated_Date"=>$Dated);
		$table = 'Req_Loan_Car';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		}

		else
		{
		

$dataInsert = array("UserID"=>'', "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance, "Is_Valid"=>$Is_Valid, "Reference_Code"=>$reference_code, "Updated_Date"=>$Dated);
		$table = 'Req_Loan_Car';
		$insert = Maininsertfunc ($table, $dataInsert);
			
			
			if($Email=="")
			{
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
					{ 
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
				echo mysql_error();
				
					}
					else
				{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
				echo mysql_error();
						
				}

			}		

		}


	
			$_SESSION['Temp_Flag'] = "1";
			
			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
		$cntr=0;
			$UserID1=$row_user[$cntr]["UserID"];
		
			$dataInsert = array("UserID"=>'', "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance, "Is_Valid"=>$Is_Valid, "Reference_Code"=>$reference_code);
		$table = 'Req_Loan_Car';
		$insert = Maininsertfunc ($table, $dataInsert);
			
			

			if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
					{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
				echo mysql_error();

					}
					else
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
				echo mysql_error();
					
					}
		
		}
		
		else
			{
				//getEligibleBidders("car","$City","$Phone");
			$strDir = dir_name();
			if($Email!="")
			{
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
			{ 
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
				echo mysql_error();
			}
			else
			{ 
				
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
				echo mysql_error();
			}
			}
			}
		//echo $result;
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
			}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL = $_POST["PostURL"]."?msg=".$msg;
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
  
	//echo $sql;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Apply Car Loans online in India | Compare Car Loans | Deal4loans</title>
<meta name="description" content="Apply Car Loan - Apply for online car loans schemes from all car loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<Script Language="JavaScript">
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
function cityother()
{
	if(document. loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}
function retain(strPlan)
{
	if(document.loan_form.Email.value!="")
	{
	   if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
       return true;
	}
function Decoration(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decoration1(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

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

 
 
	if(document.loan_form.FName.value=="")
	{
		alert("Please fill your first name.");
		document.loan_form.FName.focus();
		return false;
	}
	if(document.loan_form.FName.value!="")
	{
	 if(containsdigit(document.loan_form.FName.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.FName.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.FName.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.FName.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.FName.focus();

  	return false;
  	}
  }
	if(document.loan_form.day.value=="" ||  document.loan_form.day.value=="DD")
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
	
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}

 if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.Phone.focus();
			  return false;  
		}
        if (document.loan_form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.Phone.focus();
				return false;
        }
        if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 document.loan_form.Phone.focus();
                return false;
        }

	if(document.loan_form.Email.value=="")
	{
		alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
			
		}
	if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}	
	}

if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }
  


	if(!checkData(document.loan_form.Company_Name, 'Company Name', 3))
		return false;
		
	
if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	
if(document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual income to Continue");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	
	if (document.loan_form.Loan_Tenure.value=="")
	{
		alert("Please enter Loan Tenure.");
		document.loan_form.Loan_Tenure.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Tenure, 'Loan Tenure',0))
		return false;
		
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
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
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal;">Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" class="style4" > Get free personal accident insurance from TATA AIG</a>';
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

/*function tosendsms()
{
		
			
			var get_mobile_no = document.getElementById('Phone').value;
				//alert();
			//var get_product ="3";

				var queryString = "?get_Mobile=" + get_mobile_no;
				//var queryString = "";
				if(document.getElementById('reference_code').value=='')
				{
					//alert(queryString); 
					ajaxRequestMain.open("GET", "insertactivation.php" + queryString, true);
					
					// Create a function that will receive data sent from the server
					ajaxRequestMain.onreadystatechange = function(){
						if(ajaxRequestMain.readyState == 4)
						{
							//alert(ajaxRequestMain.responseText);
							document.getElementById('reference_code').value=ajaxRequestMain.responseText;
						}
					}
				}

				ajaxRequestMain.send(null); 

}*/


		function insertData()
		{
			var get_full_name = document.getElementById('FName').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;					
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="3";

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


</script>

<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="car-loans.php">Car Loan</a> > Apply Car Loan</span>
 
  <div id="lftbar" style="padding-top:15px; width:100%; ">

 <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>

     <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
	 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
	 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
       <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          
         <tr>
           <td colspan="5" style="padding:12px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
               <tr>
                 <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply Car Loan</h1></td>
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
                       <td height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                       <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="FName" id="FName" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                       <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                       <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onchange="cityother(); tataaig_comp(); insertData();" tabindex="7">
                           <?=getCityList($City)?>
                       </select></td>
                     </tr>
                     <tr valign="middle">
                       <td height="28" class="frmbldtxt">DOB :</td>
                       <td height="28" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                           <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                           <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                       <td height="28" align="left" class="frmbldtxt">Other City :</td>
                       <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" tabindex="8" /></td>
                     </tr>
                     <tr valign="middle">
                       <td height="28" class="frmbldtxt">Mobile :</td>
                       <td height="28" class="frmbldtxt">+91
                           <input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();" onblur="return Decorate1(' ')" onfocus="addtooltip();" tabindex="5"/></td>
                       <td height="28" class="frmbldtxt">Company Name :</td>
                       <td height="28" class="frmbldtxt"><input type="text" name="Company_Name" style="width:148px;" onfocus="addrest();"    tabindex="9"/>
                       </td>
                     </tr>
                     <tr valign="middle">
                       <td width="19%" height="28" class="frmbldtxt">Email ID :</td>
                       <td width="31%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                       <td width="19%" height="28" class="frmbldtxt">Occupation :</td>
                       <td width="31%" height="28" class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="10" >
                           <option value="-1">Employment Status</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                       </select></td>
                     </tr>
                     <tr valign="top">
                       <td height="28" colspan="4" style="color:#373737; padding-top:5px;"><div  id="tataaig_compaign" ></div></td>
                     </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                     <tr>
                       <td height="28" class="frmbldtxt">Annual Income :</td>
                       <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />
                       </td>
                     </tr>
                     <tr>
                       <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
                     </tr>
                     <tr>
                       <td height="28" class="frmbldtxt">Car Type :</td>
                       <td class="frmbldtxt"><select style="width:154px;" name="Car_Type" tabindex="12">
                           <?=AmISelected("New", $Car_Type, "1")?>
                           <?=AmISelected("Used", $Car_Type, "0")?>
                       </select></td>
                     </tr>
                     <tr>
                       <td height="28" class="frmbldtxt" style="font-weight:normal; "><b>Loan Tenure</b><br />
                  (in years)</td>
                       <td class="frmbldtxt"><input type="text" name="Loan_Tenure" style="width:148px;" value="" tabindex="13" /></td>
                     </tr>
                     <tr>
                       <td height="28" class="frmbldtxt">Loan Amount :</td>
                       <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="14" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                       </td>
                     </tr>
                     <tr>
                       <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
                     </tr>
                     
                 </table></td>
               </tr>
           </table></td>
         </tr>
         <tr>
         <td height="22"  colspan="4" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked />
      I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
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
 <?php include '~Bottom-new.php';?>
</div>
</body>
</html>