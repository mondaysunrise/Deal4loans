<?php
	header("Location: apply-business-loans.php");
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$retrivesource = $_SESSION['source'];

       $page_Name = "BusinessLoan";
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
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$Full_Name = FixString($Full_Name);
		//$Company_Name = FixString($Company_Name);
		//$LName = FixString($LName);
		$Reference_Code = generateNumber(4);
		$Name= $Full_Name;
		$Email = FixString($Email);
		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Landline = FixString($Landline);
		$Pincode = FixString($Pincode);
		$City = FixString($City);
		$Activate = FixString($Activate);
		$City_Other = FixString($City_Other);
		$Industry = FixString($Industry);
		///$Constitution = FixString($Constitution);
		$Year_Of_Establishment = FixString($Year_Of_Establishment);
		$Net_Salary = FixString($Net_Salary);
		$Loan_Amount = FixString($Loan_Amount);
		$Day=FixString($day);
		$Annual_Turnover = ($Annual_Turnover);
		$Month=FixString($month);
		$source=FixString($source);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
		 $IsPublic = 1;
if($_SESSION=="")
		{
	 $_SERVER['Temp_Type'] = "BusinessLoan";
		$_SERVER['Temp_Name'] = $Name;
		$_SERVER['Temp_Industry'] = $Industry;
		//$_SERVER['Temp_Constitution'] = $Constitution;
		$_SERVER['Temp_Year_Of_Establishment'] = $Year_Of_Establishment;		
		$_SERVER['Temp_Pincode'] = $Pincode;
		$_SERVER['Temp_Reference_Code'] = $Reference_Code;
		$_SERVER['Temp_FName'] = $Full_Name;
		//$_SERVER['Temp_LName'] = $Full_Name;
		$_SERVER['Temp_Phone'] = $Phone;
		$_SERVER['Temp_Flag'] = "0";
		$_SERVER['Temp_Email'] = $Email;
		$_SERVER['Temp_DOB'] = $DOB;
		$_SERVER['Temp_City'] = $City;
		$_SERVER['Temp_City_Other'] = $City_Other;
		$_SERVER['Temp_Net_Salary'] = $Net_Salary;
		$_SERVER['Temp_Loan_Amount'] = $Loan_Amount;
		$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
		else{
		$_SESSION['Temp_Type'] = "BusinessLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_Industry'] = $Industry;
		//$_SESSION['Temp_Constitution'] = $Constitution;
		$_SESSION['Temp_Year_Of_Establishment'] = $Year_Of_Establishment;		
		$_SESSION['Temp_Pincode'] = $Pincode;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_FName'] = $Full_Name;
		//$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Flag'] = "0";
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		}

if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where  IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}

		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		//echo "<br>";
		 $crapValue = validateValues($crap);
	//	echo  $crapValue;
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
				//SQL Query
				if(isset($_SESSION['UserType'])) 
				{
					//$sql = "INSERT INTO Req_Business_Loan (UserID, Name, Email, Mobile_Number, City, City_Other, Pincode, Industry , Year_Of_Establishment, Net_Salary, Loan_Amount, IsPublic, DOB, Dated, source, Reference_Code, Annual_Turnover, Std_Code, Landline)
					//VALUES ( '$UserID', '$Name', '$Email', '$Phone', '$City', '$City_Other', '$Pincode', '$Industry' , '$Year_Of_Establishment','$Net_Salary', '$Loan_Amount', '$IsPublic', '$DOB', Now(), '$source', '$Reference_Code', '$Annual_Turnover',  '$Std_Code', '$Landline' )";
				
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email,  "Mobile_Number"=>$Phone, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Industry"=>$Industry, "Year_Of_Establishment"=>$Year_Of_Establishment, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "IsPublic"=>$IsPublic, "DOB"=>$DOB, "Dated"=>$Dated, "source"=>$source, "Reference_Code"=>$Reference_Code, "Annual_Turnover"=>$Annual_Turnover, "Std_Code"=>$Std_Code, "Landline"=>$Landline );
$table = 'Req_Business_Loan';
$insert = Maininsertfunc ($table, $dataInsert);
				}
				else
				{
					//$sql = "INSERT INTO Req_Business_Loan (UserID, Name, Email, Mobile_Number, City, City_Other, Pincode, Industry , Year_Of_Establishment, Net_Salary, Loan_Amount,  IsPublic, DOB, Dated, source, Reference_Code, Annual_Turnover, Std_Code, Landline)
					//VALUES ( '','$Name', '$Email', '$Phone', '$City', '$City_Other', '$Pincode', '$Industry' , '$Year_Of_Establishment','$Net_Salary', '$Loan_Amount', '$IsPublic', '$DOB', Now(), '$source', '$Reference_Code', '$Annual_Turnover', '$Std_Code', '$Landline' )";
		
		$dataInsert = array("UserID"=>'', "Name"=>$Name, "Email"=>$Email,  "Mobile_Number"=>$Phone, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Industry"=>$Industry, "Year_Of_Establishment"=>$Year_Of_Establishment, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "IsPublic"=>$IsPublic, "DOB"=>$DOB, "Dated"=>$Dated, "source"=>$source, "Reference_Code"=>$Reference_Code, "Annual_Turnover"=>$Annual_Turnover, "Std_Code"=>$Std_Code, "Landline"=>$Landline );
$table = 'Req_Business_Loan';
$insert = Maininsertfunc ($table, $dataInsert);
		
					if($Email=="")
					{
						if ($_SESSION['flag']==1)
							{ 
							header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
						echo mysql_error();
						//echo "<script language=javascript>"." location.href='Req_Business_Loan_Ext.php?flag=1'"."</script>";
							}
							else
						{
							    header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
						echo mysql_error();
								//echo "<script language=javascript>"." location.href='User_Register_New.php'"."</script>";
						}
		
					}		
		
				}
		
		
				$Email = trim($Email);
				$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
				$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
				$msgUserDoesNotExist = "Email does not exists in the database";
				$result = ExecQuery($query);
				$rows = mysql_num_rows($result);		
				echo mysql_error();
		
				if(isset($_SESSION['UserType']))
						{
					$result = ExecQuery($sql);
					$rows = mysql_num_rows($result);
					$SMSMessage = "Dear $Full_Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
					if(strlen(trim($Phone)) > 0)
					SendSMS($SMSMessage, $Phone);
					$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "User_Register_New.php");
					echo $Msg;
					echo mysql_error();
						}
				else if ($myrow = mysql_fetch_array($result)) 
				{
					do
					{
						$_SESSION['Temp_UserID'] = $myrow["UserID"];
					}while ($myrow = mysql_fetch_array($result));
					mysql_free_result($result);
					$_SESSION['Temp_Flag'] = "1";
					
					$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
					$res_user=ExecQuery($qry_user);
					$row_user=mysql_fetch_array($res_user);
					$UserID1=$row_user["UserID"];
					
					$sql = "INSERT INTO Req_Business_Loan (UserID, Name, Email, Mobile_Number, City, City_Other, Pincode, Industry , Year_Of_Establishment, Net_Salary, Loan_Amount, IsPublic, DOB, Dated, source, Reference_Code, Annual_Turnover,Std_Code, Landline )
					VALUES ( '$UserID1', '$Name', '$Email', '$Phone', '$City', '$City_Other', '$Pincode', '$Industry' , '$Year_Of_Establishment','$Net_Salary', '$Loan_Amount', '$IsPublic', '$DOB', Now(), '$source', '$Reference_Code', '$Annual_Turnover','$Std_Code', '$Landline' )";
					$result = ExecQuery($sql);
					$SMSMessage = "Dear $Full_Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
					if(strlen(trim($Phone)) > 0)
						SendSMS($SMSMessage, $Phone);
					if ($_SESSION['flag']==1)
							{ 
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
						echo mysql_error();
						//echo "<script language=javascript>"." location.href='Thank_Business_Loan.php?flag=1'"."</script>";
							}
							else
						{
								header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
						echo mysql_error();
								//echo "<script language=javascript>"." location.href='User_Register_New.php'"."</script>";
						}
				}
				
				else
					{
					$result = ExecQuery($sql);
					$rows = mysql_num_rows($result);
		
					//getEligibleBidders("home","$City","$Phone");
					$_SESSION['Temp_Flag'] = "0";
					$strDir = dir_name();
						if($Email!="")
						{
								if ($_SESSION['flag']==1)
					{ 
						header("Location: /User_Register_New.php?flag=1");
						echo mysql_error();
					}
					else
					{ 
						
						header("Location: /User_Register_New.php");
						echo mysql_error();
					}
						}
					}
				echo mysql_error();
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
		
    }
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Business Loan India Apply Compare | Self Employed Loans</title>
<meta name="description" content="Get online information and comparison on business loans from all business loan providing banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc. Apply for Business Loan to get the offers from HDFC Bank, Citibank, Citibank, SBI etc.">
<meta name="keywords" content="Business Loans India, Apply Business Loans, Compare Business Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
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

function citycheck()
{
	if(loan_form.City.value=="Others")
	{
		//alert("OTHERS");
		loan_form.City_Other.disabled = false;
	}
	else
	{
	//alert("Disabled");
		loan_form.City_Other.disabled = true;
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

function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
<?	if ($_SESSION['flag']==1)
	{?>
	if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}
	<? } ?>
<?
if($_SESSION['UserType']=="") 
{
?>	
	if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		
	}
	
<?
}
?>
	if(document.loan_form.Full_Name.value=="")
	{
		alert("Please fill your Full name.");
		document.loan_form.Full_Name.focus();
		return false;
	}
	if(document.loan_form.Full_Name.value!="")
	{
	 if(containsdigit(document.loan_form.Full_Name.value)==true)
	{
	alert("Full Name contains numbers!");
	document.loan_form.Full_Name.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.Full_Name.value.charAt(i)) != -1) {
  	alert ("Full Name has special characters.\n Please remove them and try again.");
	document.loan_form.Full_Name.focus();

  	return false;
  	}
  }
	
	if(document.loan_form.day.value=="")
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
	
	if(document.loan_form.month.value=="")
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
	if(document.loan_form.year.value=="")
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
        if (document.loan_form.Phone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.Phone.focus();
         	return false;
        }    

	if(document.loan_form.Std_Code.value=="")
	{
		
			alert("Please enter your Std Code");
			document.loan_form.Std_Code.focus();
			return false;
		
	}
	if(document.loan_form.Landline.value=="")
	{
		
			alert("Please enter your Residence / Office No");
			document.loan_form.Landline.focus();
			return false;
		
	}
	
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please select City Name to Continue");
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
	
	if (document.loan_form.Year_Of_Establishment.selectedIndex==0)
	{
		alert("Please select Year of establishment");
		document.loan_form.Year_Of_Establishment.focus();
		return false;
	}
	
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;
	if (document.loan_form.Annual_Turnover.selectedIndex==0)
	{
		alert("Please select Annual Turnover");
		document.loan_form.Annual_Turnover.focus();
		return false;
	}
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
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
</Script>
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
			var get_full_name = document.getElementById('Full_Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="6";

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
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if ($_REQUEST['flag']!=1)
	{ ?>
   <?php include '~Upper.php';?><?php } ?>
                       <div id="dvbannerContainer"><?php include 'header_bl.php';?></div>

  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    <?php if(isset($_SESSION['UserType']))
	{?>
   <table width="380" border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="380"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
<td width="10" height="26" align="left" valign="top"><img src="images/frm-lft-bg.gif" width="10" height="26"></td>
<td align="center" bgcolor="#3178BB"><h1 class="head2" style="color:#FFFFFF;">Business Loan Request</h1></td>
<td width="10" height="26" align="right" valign="top"><img src="images/frm-rgt-bg.gif" width="10" height="26"></td>
</tr></table></td></tr>
<tr><td align="center"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>


        <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
		    <table width="320" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table border="0" width="380" cellpadding="4" cellspacing="0" bgcolor="#F2F6FA"   style="border:1px solid #6B9ECE;" id="frm" >
                  <tr>
                    <td colspan="2" align="center"><input type="hidden" name="Activate" id="Activate" >
                        <input type="hidden" name="source" value="<? echo $retrivesource; ?>"></td>
                  </tr>
                  <tr>
                    <td width="150" class="formtext">Full Name<font size="1" color="#FF0000">*</font></td>
                    <td class="formtext"><input type="text" name="Full_Name" id="Full_Name" style="width:152px;" maxlength="30" onChange="insertData();"></td>
                  </tr>
                  <? if(!isset($_SESSION['UserType'])) {?>
                  <tr>
                    <td class="formtext">Your Email Address</td>
                    <td class="formtext"><input type="text" name="Email" id="Email" style="width:152px;" onChange="insertData();"></td>
                  </tr>
                  <? }?>
                  <!--<tr>
       <td class="formtext">First Name<font size="1" color="#FF0000">*</font></td>
       <td class="formtext"><input type="text" name="FName" size="20" maxlength="30"></td>
     </tr>-->
                  <tr>
                    <td colspan="2"><input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
                  </tr>
                  <tr>
                    <td class="formtext">DOB<font size="1" color="#FF0000">*</font></td>
                    <td class="formtext"><input name="day" type="text" id="day" value="DD" style="width:40px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
                        <input name="month" type="text" id="month" value="MM" style="width:40px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
                        <input name="year" type="text" id="year" value="YYYY" style="width:57px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
                  </tr>
                  <tr>
                    <td class="formtext">Mobile (For SMS Alerts)<font size="1" color="#FF0000">*</font></td>
                    <td class="formtext"> +91
                        <input type="text" name="Phone" id="Phone" style="width:125px;" maxlength="10" onChange="intOnly(this);insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                  </tr>
                  <tr>
                    <td class="formtext">Residence / Office No.<font size="1" color="#FF0000">*</font></td>
                    <td class="formtext"><input onFocus="insertData();" type="text" name="Std_Code" style="width:40px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
                        <input type="text" name="Landline" style="width:105px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
                  </tr>
                  <tr>
                    <td class="formtext">City Name<font size="1" color="#FF0000">*</font></td>
                    <td><select style="width:150px;" name="City" id="City" onChange="citycheck();insertData();">
                        <?=getCityList($City)?>
                      </select>                    </td>
                  <tr>
                    <td class="formtext">Others</td>
                    <td width="212" class="formtext"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" style="width:150px;"></td>
                  </tr>
                  <!--<tr>
     <td class="formtext">Pincode<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="formtext"><input type="text" name="Pincode" onFocus="this.select();" size="10" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"></td>
     </td>
   </tr>
    <tr>
     <td class="formtext">Name of Co/Business<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="formtext"><input type="text" id="Company_Name"  name="Company_Name" onFocus="this.select();" size="20"  ></td>
     </td>
   </tr>
  <tr>
	 <td class="formtext">Which Industry You belongs to?</td>
   <td>
	   <select size="1"  name="Industry" class="style4">
		  <option value="1">Please Select</option> 
		  <option value="Automobile ">Automobile</option> 
		  <option value="Chemical">Chemical</option> 
		  <option value="Construction">Construction</option>
		  <option value="Education">Education</option>
		  <option value="Engineering">Engineering</option>
		  <option value="Gems &jewellery">Gems &jewellery</option> 
		  <option value="IT & ITES">IT & ITES</option> 
		  <option value="Logistics">Logistics</option> 
		  <option value="Pharmaceutical">Pharmaceutical</option>
		  <option value="Retail">Retail</option>
		  <option value="Service">Service</option>
		  s<option value="Textiles">Textiles</option> 
		  <option value="Transportation">Transportation</option> 
		  <option value="Travel trade">Travel trade</option> 
		  <option value="Wholesale trader">Wholesale trader</option>
		  <option value="Others">Others</option>
	  </select>
  </td>
  </tr>
  <tr>
	 <td class="formtext">Type of Company ?</td>
   <td>
   <select size="1"  name="Constitution" class="style4">
  <option value="1">Please Select</option> 
     <option value="Individual">Individual</option> 
 <option value="Partnership Firm">Partnership Firm</option>
  <option value="Proprietorship Firm">Proprietorship Firm</option>
  <option value="Public Limited">Public Limited</option>
  <option value="Private Limited">Private Limited</option>
   <option value="Trust">Trust</option>
  <option value="Assosiation">Association</option>
  <option value="Society">Society</option>
    <option value="Others">Others</option>
   </select>
  </td>
  </tr>-->
                  <tr>
                    <td class="formtext">Year of Establishment <font size="1" color="#FF0000">*</font></td>
                    <td><select name="Year_Of_Establishment" style="width:150px;">
                        <option value="1">Please Select</option>
                        <?for($i=1950; $i<=2007; $i++)
	 {
		 echo "<option value='$i'>".$i."</option>";
	 }?>
                    </select></td>
                  </tr>
                  <tr>
                    <td class="formtext">Annual Income<font size="1" color="#FF0000">*</font></td>
                    <td class="formtext"><input type="text" name="Net_Salary" id="Net_Salary" style="width:150px;" onBlur="getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onKeyUp="getDigitToWords('Net_Salary','formatedSalary','wordSalary'); intOnly(this);" onKeyPress="intOnly(this);">
                        <br>
                        <span id='formatedSalary' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordSalary' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
                  </tr>
                  <tr>
                    <td class="formtext">Annual Turnover <font size="1" color="#FF0000">*</font></td>
                    <td><select style="width:150px;"  name="Annual_Turnover" class="style4">
                        <option value="-1">Please Select</option>
                        <option value="1">Below 25 Lacs</option>
                        <option value="2">25-50 Lacs</option>
                        <option value="3">50-75 Lacs</option>
                        <option value="4">75-1 Crore</option>
                        <option value="5">1-1.25 crore</option>
                        <option value="6">1.25 cr& above</option>
                      </select>                    </td>
                  </tr>
                  <tr>
                    <td class="formtext">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
                    <td class="formtext"><input type="text"  id="Loan_Amount" name="Loan_Amount" style="width:150px;" maxlength="30" onBlur="getDigitToWords('Loan_Amount','formatedIncome','wordIncome');" onKeyUp="getDigitToWords('Loan_Amount','formatedIncome','wordIncome'); intOnly(this);" onKeyPress="intOnly(this);">
                        <br>
                        <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" valign="top"><!--	 <input name="image"  value="Submit" type="image" src="images/sbmt-btn.gif" width="64" height="30" style="border:0px;" /> -->
                        <input value="" type="submit" style=" background-image:url(images/sbmt-btn.gif); border:0px; width:64px; height:30px; margin-bottom:0px;"  />
                      &nbsp;
                      <!--<input name="image"   value="Reset" type="image" src="images/rst-bttn.gif" width="64" height="30"  border="0" style="border:0px;"/> -->
                      <input  value="" type="reset"    border="0"  style=" background-image:url(images/rst-bttn.gif); border:0px; width:64px; height:30px; margin-bottom:0px;"/>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><font style="font-weight:normal; font-size:9;">Clicking "Submit" means that you agree to the terms of the Deal4Loans <a href="Privacy.php" target="_blank">Terms and Condition</a> and <a href="Privacy.php" target="_blank">Privacy</a> statement.</font> </td>
                  </tr>
                </table></td>
              </tr>
            </table><br>

		  </form></td></tr>
          </table></td></tr></table>
 </div>
 <?php 
 //echo "dddd".$sify;

  include '~Right2.php';
 
  ?>

  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><?php }?>

  </body>
</html>