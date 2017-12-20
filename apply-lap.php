<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


$maxage=date('Y')-62;
$minage=date('Y')-18;

	$retrivesource = $_SESSION['source'];
$page_Name = "LoanAgainstProperty";
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

		/* FIX STRINGS */
		 
		$FName = FixString($FName);
		$LName = FixString($LName);
		$Name=$FName." ".$LName;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Activate =FixString($Activate);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Std_Code2 = FixString($Std_Code2);
		$Employment_Status = FixString($Employment_Status);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$Residential_Status = FixString($Residential_Status);
		$Residence_Address = FixString($Residence_Address);
		$Property_Type = FixString($Property_Type);
		$Property_Value = FixString($Property_Value);
		$Loan_Amount = FixString($Loan_Amount);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Descr = FixString($Descr);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Dated = ExactServerdate();
		
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
        $IsPublic = 1;
		if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where  IncompeletID=".$Activate;	
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());	
	}

if($_SESSION=="")
		{
		$_SERVER['Temp_Type'] = "PropertyLoan";
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
		$_SERVER['Temp_Total_Experience'] = $Total_Experience;
		$_SERVER['Temp_Net_Salary'] = $Net_Salary;
		$_SERVER['Temp_Residential_Status'] = $Residential_Status;
		$_SERVER['Temp_Residence_Address'] = $Residence_Address;
		$_SERVER['Temp_Property_Type'] = $Property_Type;
		$_SERVER['Temp_Property_Value'] = $Property_Value;
		$_SERVER['Temp_Loan_Amount'] = $Loan_Amount;
		$_SERVER['Temp_Descr'] = $Descr;
		$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
		else
		{
		$_SESSION['Temp_Type'] = "PropertyLoan";
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
		$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_Residential_Status'] = $Residential_Status;
		$_SESSION['Temp_Residence_Address'] = $Residence_Address;
		$_SESSION['Temp_Property_Type'] = $Property_Type;
		$_SESSION['Temp_Property_Value'] = $Property_Value;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_Descr'] = $Descr;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		}

$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
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
			
			$getdetails="select RequestID From Req_Loan_Against_Property  Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$cntr=0;
			
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow[$cntr]['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-property-loan-lead.php'"."</script>";
			}
			else
			{
			
		
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
			if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		


list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for LAP. You will get a call from us to give you quotes & information to get you best deal for loans.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);

		if(isset($_SESSION['UserType'])) 
		{
				
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Residential_Status"=>$Residential_Status, "Property_Type"=>$Property_Type, "Property_Value"=>$Property_Value, "Loan_Amount"=>$Loan_Amount, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Contact_Time"=>$Contact_Time, "Pincode"=>$Pincode, "Residence_Address"=>$Residence_Address, "source"=>$source, "Accidental_Insurance"=>$Accidental_Insurance, "Updated_Date"=>$Dated);
$table = 'Req_Loan_Against_Property';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		}
		else
		{
			
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Residential_Status"=>$Residential_Status, "Property_Type"=>$Property_Type, "Property_Value"=>$Property_Value, "Loan_Amount"=>$Loan_Amount, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Contact_Time"=>$Contact_Time, "Pincode"=>$Pincode, "Residence_Address"=>$Residence_Address, "source"=>$source, "Accidental_Insurance"=>$Accidental_Insurance, "Updated_Date"=>$Dated);
$table = 'Req_Loan_Against_Property';
$insert = Maininsertfunc ($table, $dataInsert);
			
			if($Email=="")
			{
				if ($_SESSION['flag']==1)
					{ 
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
						echo mysql_error();
				/*echo "<script language=javascript>"." location.href='Contents_Loan_Against_Property_Mustread.php?flag=1'"."</script>";*/
					}
					else
				{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
						echo mysql_error();
						/*echo "<script language=javascript>"." location.href='Contents_Loan_Against_Property_Mustread.php'"."</script>";*/
				}
			}

		}
			$_SESSION['Temp_Flag'] = "1";
			
			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
			$j=0;
			$UserID1=$row_user[$j]["UserID"];
			
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Residential_Status"=>$Residential_Status, "Property_Type"=>$Property_Type, "Property_Value"=>$Property_Value, "Loan_Amount"=>$Loan_Amount, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Contact_Time"=>$Contact_Time, "Pincode"=>$Pincode, "Residence_Address"=>$Residence_Address, "source"=>$source, "Accidental_Insurance"=>$Accidental_Insurance, "Updated_Date"=>$Dated);
$table = 'Req_Loan_Against_Property';
$insert = Maininsertfunc ($table, $dataInsert);
			
			
			getEligibleBidders("property","$City","$Phone");
			if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
					{ 
header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
						echo mysql_error();
			/*echo "<script language=javascript>"." location.href='User_Register_New.php?flag=1'"."</script>";*/
					}
					else
					{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
						echo mysql_error();
					/*echo "<script language=javascript>"." location.href='User_Register_New.php'"."</script>";*/
					}
			
		}
		
		else
		{
			getEligibleBidders("property","$City","$Phone");
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
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
			
		
		
		
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL = $_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Apply and Compare Loans Against Property India</title>
<meta name="description" content="Apply Loans Against Property online. Know the schemes from all loans against property providing banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc. Compare Documents, EMI, Interest rates and Fees.">
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
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
	if(document.loan_form.City.value=="Others")
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
		alert("Please fill your full name.");
		document.loan_form.FName.focus();
		return false;
	}
	 if(document.loan_form.FName.value!="")
	{
	 if(containsdigit(document.loan_form.FName.value)==true)
	{
	alert("full Name contains numbers!");
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
	
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="" && document.loan_form.day.value!="DD") 
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
	if(document.loan_form.month.value!="" && document.loan_form.month.value!="MM")
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
		if(document.loan_form.year.value!="" && document.loan_form.year.value!="YYYY")
	{
	  if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
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
		alert("Please fill your Email.");
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
	
	if(!checkData(document.loan_form.Company_Name, 'Company Name', 3))
		return false;
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Net Salary.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Net_Salary, 'Net Salary',0))
		return false;
		
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (document.loan_form.Property_Value.value=="")
	{
		alert("Please enter Property Value.");
		document.loan_form.Property_Value.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Property_Value, 'Value of the Property',0))
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

		function insertData()
		{
			var get_full_name = document.getElementById('FName').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
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

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container"  >  
   <span><a href="index.php">Home</a> > <a href="loan-against-property.php">Loan Against Property</a> > Apply Loan Against Property</span>
  <div style="padding-top:15px; ">
  
<font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong>
          <?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?>
          </strong></font>
             <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;"><table width="423" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="362" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply Loan Against Property</h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center">
 <input type="hidden" name="Activate" id="Activate" >
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>"></td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name </td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="FName" id="FName" style="width:150px;" maxlength="30" onchange="insertData();" tabindex="1" /></td>
                     <td width="18%" height="28" class="frmbldtxt" style="padding-top:3px; ">City </td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select style="width:154px;" name="City" id="City" onchange="cityother(); tataaig_comp(); insertData();" tabindex="7" >
                  <?=getCityList($City)?>
                </select>         </td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">DOB </td>
                     <td height="28" class="frmbldtxt"><input onfocus="insertData();" name="day" type="text" id="day" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="2" />
                  <input name="month" type="text" id="month" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="MM" tabindex="3" />
                  <input name="year" type="text" id="year" style="width:55px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="YYYY" tabindex="4" />       </td>
                     <td height="28" align="left" class="frmbldtxt">Other City </td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled value="Other City" onfocus="this.select();" style="width:150px;" tabindex="8" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">Mobile </td>
                     <td height="28" class="frmbldtxt">+91
                          <input type="text" name="Phone" id="Phone" style="width:123px;" maxlength="10" onchange="intOnly(this);insertData();" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; tabindex="5" /></td>
                     <td height="28" class="frmbldtxt">Pincode </td>
                     <td height="28" class="frmbldtxt">   <input type="text" name="Pincode" onfocus="this.select();" style="width:150px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);" tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt">Email ID </td>
                     <td width="32%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email" style="width:150px;" onchange="insertData();" tabindex="6" /></td>
                     <td width="18%" height="28" class="frmbldtxt">Company Name </td>
                     <td width="31%" height="28" class="frmbldtxt"><input type="text" name="Company_Name" style="width:150px;" tabindex="10" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28">&nbsp;</td>
					 <td height="28">&nbsp;</td>
					 <td height="28">&nbsp;</td>
                     <td height="28">&nbsp;</td>
                   </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td height="28" class="frmbldtxt">Occupation </td>
                <td class="frmbldtxt"><select style="width:154px;" name="Employment_Status" onchange="insertData();" tabindex="11">
                  <option selected="selected" value="1">Salaried</option>
                  <option value="0">Self Employed</option>
              </select></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Net Salary (Yearly)</td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:150px;" onblur="getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onkeyup="getDigitToWords('Net_Salary','formatedSalary','wordSalary'); intOnly(this);" onkeypress="intOnly(this);" tabindex="12" />                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedSalary' style='font-size:11px; font-weight:bold;color:#671212;font-Family:Verdana;'></span><span id='wordSalary' style='font-size:11px;
font-weight:bold;color:#671212;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Loan Amount </td>
                <td class="frmbldtxt"><input type="text"  id="Loan_Amount" name="Loan_Amount" style="width:150px;" maxlength="30" onblur="getDigitToWords('Loan_Amount','formatedIncome','wordIncome');" onkeyup="getDigitToWords('Loan_Amount','formatedIncome','wordIncome'); intOnly(this);" onkeypress="intOnly(this);" tabindex="13" />     </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:#671212;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px; font-weight:bold;color:#671212;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
             
			<tr>
                <td class="frmbldtxt">Value of Property </td><td class="frmbldtxt"><input type="text" name="Property_Value"  style="width:150px;" onkeypress="intOnly(this);" onkeyup="intOnly(this);" tabindex="14" /></td>
              </tr>
              
              
            </table></td>
               </tr>
             </table></td>
          </tr>
              <tr>
            <td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">
		              <input type="checkbox" name="accept" style="border:none;" checked tabindex="15">
I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>
			  </td>
            <td width="24%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value="" tabindex="16"/></td>
          </tr>
         

          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form><br />
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
          <div id="txt"><P >Simply put, a loan against property is what it actually connotes -- a loan given or disbursed against the mortgage of property. This is unlike a <a href="http://www.deal4loans.com/personal-loans.php" title="personal loan">personal  loan</a>, which is disbursed to an individual; no questions asked. The loan is given as a certain percentage of the property's market value (usually around 40 per cent-60 per cent). But the threshold amount too is generally defined by most lending institutions like say, Rs 200,000. This multi-purpose loan puts funds at your disposal to use as you wish. It unlocks the hidden value in the property you own.</P>
 <p><b>Features at Glance</b><br/>
   <br>

 • Loans from Rs2 Lakh onwards depending on your needs<br>
 •  
 Borrow up to 70% of market value of 
 the property<br>
 • 
 Flexibility to choose between an EMI 
 based loan or an overdraft<br>
 • 
 High tenure loans for ease of 
 repayment.<br>
• 
 Attractive interest rates.<br>
 •  
 Simple and speedy processing.<br>
•  Loan for salaried &amp; self-employed 
 individuals <br/>
<br/>
<b>Advantages of taking a Loan Against Property:</b> <br>
<br>


 • Cheaper than Personal Loans: It works out to be much cheaper than a <a href="http://www.deal4loans.com/personal-loans.php" title="personal loans">personal  loans</a>, which is usually issued at interest rates in the region of 16 per cent-21 per cent.<br>

 • Longer Loan Tenure: The tenure for a <a href="http://www.deal4loans.com/loan-against-property.php" title="Loan Against Property">Loan Against Property</a> is usually longer than that for a personal loan. Generally, LAP is given for a maximum tenure of 10 years. <br>

 • Lower EMI: Since the rate of interest is lower, many times, LAP Equated Monthly Installments (EMI) turn out to be cheaper than those under personal loans.<br>

 • Simple documentation and Fast Approvals: LAP being a secured Loan has comparatively faster approvals and minimal documentation.<br />
 <br /><b>Loan Against Property can be taken for following purposes:</b><br>
 • Expanding your business<br>

 • Get your child married<br>

 • Send your child for higher studies<br>

 • Fund your dream vacation<br>

 • Fund Medical Treatments<br><br />
In nutshell, Loan Against Property is a secured multi-purpose loan with larger tenor and lesser rate of interest.

 </p> 
	<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>
   </div>
          
            </td>

      </tr>
    </table>
   
   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div>
</body>
</html>

