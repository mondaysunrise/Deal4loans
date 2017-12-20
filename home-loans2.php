<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$retrivesource = $_SESSION['source'];
    $page_Name = "PersonalLoan";
	

	  if ($_REQUEST['flag']==1 || $_SESSION['flag']==1)
		{
			$source="partner1";
		}
		
	$Msg = "";
	$Item_ID = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		$Full_Name = FixString($Full_Name);
		//$LName = FixString($LName);
		$Name=$Full_Name;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Activate=FixString($Activate);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		//$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Card_Vintage = FixString($Card_Vintage);
		$Reference_Code = generateNumber(4);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City_Other = FixString($City_Other);
		$Employment_Status = FixString($Employment_Status);
		if($Employment_Status==1)
		{
		$Net_Salary = FixString($Net_Salary);
		$Net_Salary = $Net_Salary*12;
		}
		else
		{
			$Net_Salary = FixString($Net_Salary);
		}
		//$Contact_Time = FixString($Contact_Time);
		$Net_Salary_Monthly = $Net_Salary / 12;
		$IsPublic = 1;
		$IP = getenv("REMOTE_ADDR");
		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
			
if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "PersonalLoan";
			$_SERVER['Temp_Card_Vintage'] = $Card_Vintage;
			$_SERVER['Temp_Name'] = $Full_Name;
			$_SERVER['Temp_FName'] = $Full_Name;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Phone1'] = $Phone1;
			$_SERVER['Temp_Std_Code1'] = $Std_Code1;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Reference_Code'] = $Reference_Code;
			$_SERVER['Temp_Message'] = $Message;
			$_SERVER['Temp_Message1'] = $Message1;
			$_SERVER['Temp_Flag'] = "0";
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Email_New'] = $Email_New;
			$_SERVER['Temp_Net_Salary_Monthly'] = $Net_Salary_Monthly;
			$_SERVER['Temp_Item_ID'] = $Item_ID;
			$_SERVER['Temp_Name_New'] = $Name_New;
			$_SERVER['Temp_Flag_Message'] = "0";
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_CC_Holder'] = $CC_Holder;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
		else
			{
				$_SESSION['Temp_Type'] = "PersonalLoan";
				$_SESSION['Temp_Card_Vintage'] = $Card_Vintage;
				$_SESSION['Temp_Name'] = $Full_Name;
				$_SESSION['Temp_FName'] = $Full_Name;
				$_SESSION['Temp_Phone'] = $Phone;
				$_SESSION['Temp_Phone1'] = $Phone1;
				$_SESSION['Temp_Std_Code1'] = $Std_Code1;
				$_SESSION['Temp_DOB'] = $DOB;
				$_SESSION['Temp_Reference_Code'] = $Reference_Code;
				$_SESSION['Temp_Message'] = $Message;
				$_SESSION['Temp_Message1'] = $Message1;
				$_SESSION['Temp_Flag'] = "0";
				$_SESSION['Temp_Email'] = $Email;
				$_SESSION['Temp_Email_New'] = $Email_New;
				$_SESSION['Temp_Net_Salary_Monthly'] = $Net_Salary_Monthly;
				$_SESSION['Temp_Item_ID'] = $Item_ID;
				$_SESSION['Temp_Name_New'] = $Name_New;
				$_SESSION['Temp_Flag_Message'] = "0";
				$_SESSION['Temp_Company_Name'] = $Company_Name;
				$_SESSION['Temp_City'] = $City;
				$_SESSION['Temp_City_Other'] = $City_Other;
				$_SESSION['Temp_Employment_Status'] = $Employment_Status;
				$_SESSION['Temp_Net_Salary'] = $Net_Salary;
				//$_SESSION['Temp_Marital_Status'] = $Marital_Status;
				$_SESSION['Temp_CC_Holder'] = $CC_Holder;
				//$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
				$_SESSION['Temp_IsPublic'] = $IsPublic;
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
		$Product_Name = "1";
		
		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);

	}

		//$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
		if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
			$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
	
			//SQL Query
			
			$dataArray = array('UserID'=>'', 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Count_Views'=>'0', 'Count_Replies'=>'0', 'IsModified'=>'0', 'IsProcessed'=>'0', 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance);
				
				if($Email=="")
				{
					if ($_REQUEST['flag']==1)
						{ 
					echo "<script language=javascript>"." location.href='User_Register_New.php?flag=1'"."</script>";
						}
						else
					{
							echo "<script language=javascript>"." location.href='User_Register_New.php'"."</script>";
					}
				}
				
			//}
			
			$Email_New = $Email;
			$Name_New = $Name;
			if(isset($_SESSION['UserType'])) 
			{
				$UName = $_SESSION['UName'];
				$sqlquery = "Select *  from wUsers where UserID='".$UserID."'";
			
			 list($recordcount,$myrow)=MainselectfuncNew($sqlquery,$array = array());
		$cntr=0;
				if ($cntr<count($myrow)) 
				{
					do
					{ $cntr = $cntr+1;
						$Email_New=$myrow["Email"];
						//$Name_New=$myrow["FName"];
					}while ($cntr<count($myrow));
				}
					mysql_free_result($result);
			}
	
			$Email = trim($Email);
			$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			//echo $query."kk";
			$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
			$msgUserDoesNotExist = "Email does not exists in the database";
			 list($rows,$myrow)=MainselectfuncNew($query,$array = array());
			$p=0;
			
			
			if ($p<count($myrow)) 
			{
				do
				{
					$p = $p +1;
					$_SESSION['Temp_Flag_Message'] = "1";
					$_SESSION['Temp_Flag'] = "1";
					$_SESSION['Temp_UserID'] = $myrow["UserID"];
				}while ($p<count($myrow));
				mysql_free_result($result);
						
				$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
				list($alreadyExist,$row_user)=MainselectfuncNew($qry_user,$array = array());
				$myrowcontr=count($row_user)-1;
				$UserID1 = $row_user[$myrowcontr]["UserID"];
				
				
				$dataArray = array('UserID'=>$UserID1, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Count_Views'=>'0', 'Count_Replies'=>'0', 'IsModified'=>'0', 'IsProcessed'=>'0', 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance);
				
				$Lid = Maininsertfunc ('Req_Loan_Personal', $dataArray);

				$_SESSION['Temp_LID'] = $Lid;
				if($Accidental_Insurance=="1")
				{
				InsertTataAig($Lid, "Req_Loan_Personal");
				}
				$SMSMessage = "Dear $FName,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
				
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
						{ 			
				echo "<script language=javascript>"."location.href='User_Register_New.php?flag=1'"."</script>";
						}
						else
				{
					echo "<script language=javascript>"."location.href='User_Register_New.php'"."</script>";
				}
				
			}
			
			else
			{
				$_SESSION['Temp_Flag_Message'] = "1";
				
				$Lid = Maininsertfunc ('Req_Loan_Personal', $dataArray);

				if($Accidental_Insurance=="1")
				{
					InsertTataAig($Lid, "Req_Loan_Personal");
				}
				$_SESSION['Temp_LID'] = $Lid;

				//	$rows = mysql_num_rows($result);
				$strDir = dir_name();
	//			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."User_Register_New.php");
				if($Email!="")
				{
					if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
						{ 
						echo "<script language=javascript>"."location.href='User_Register_New.php?flag=1"."</script>"; 
						/*	header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php?flag=1");*/
							echo mysql_error();
						}
					else
						{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
							echo mysql_error();
						}
				}
			}
				echo mysql_error();
	
			if ($result == 1 && isset($_SESSION['UserType']))
			{
				$Msg = getAlert("Your request has been added. !!", TRUE, "User_Register_New.php");
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


  	  	  	  	  <? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>  


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home loan | Housing loans | Home loan India | Home Loans Eligibility | Deal4loans</title>
<meta name="keywords" content="Home Loan, Home Loans, Home Loan India, Home loans India, Home Loans Eligibility">
<meta name="Description" content="Home loan information from deal4loans.com. Compare Home Loan EMI, Rates, Processing fees etc."><link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
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

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
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


function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
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
	 /* if((space.test(Form.day.value)) || (Form.day.value=="dd"))
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
	}*/
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
	alert("Kindly fill in your Mobile Number!");
	Form.Phone.focus();
	return false;
	}
	
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value");
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.Phone.focus();
					return false;
			}
			if (Form.Phone.value.charAt(0)!="9")
			{
					alert("The number should start only with 9");
					 Form.Phone.focus();
					return false;
			}
	
	
	
	if(Form.Email.value!="")
	{
		if (!validmail(Form.Email.value))
		{
			Form.Email.focus();
			return false;
		}
		
	}
	
	
	if(Form.City.selectedIndex==0)
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

	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{
		alert("Please enter Annual income to Continue");
		Form.IncomeAmount.focus();
		return false;
	}
	
	 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{
	alert("Kindly fill in your Loan Amount (Numeric Only)!");
	Form.Loan_Amount.focus();
	return false;
	}
	else if(containsalph(Form.Loan_Amount.value)==true)
	{
	alert("Loan Amount contains characters!");
	Form.Loan_Amount.focus();
	return false;
	}
	
	
	if(!Form.accept.checked)
	{
	alert("Accept the Terms and Condition");
	Form.accept.focus();
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

function othercity1()
{
	if(document.home_loan.City.value=='Others')
	{
		document.home_loan.City_Other.disabled=false;
		document.home_loan.City_Other.focus();
	}
	else
	{
		document.home_loan.City_Other.disabled=true;
		document.home_loan.City_Other.focus();
	}
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
  		
			
 <SCRIPT LANGUAGE="JavaScript">
  <!--
 /*function func()
 {
  document.getElementById("onCloseValue").value= "0";
 }
 
 window.onbeforeunload = function(e){
  if(document.getElementById("onCloseValue").value == "1")
  {
    	window.open("closedby_hl.php", "tinyWindow", 'width=510,height=390, scrollbars')
  }
 }*/
  //-->

   function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.home_loan.City.value=="Delhi" || document.home_loan.City.value=='Delhi' || document.home_loan.City.value=='Noida'  ||  document.home_loan.City.value=='Gurgaon'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Gaziabad'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Greater Noida'  || document.home_loan.City.value=='Chennai'  ||  document.home_loan.City.value=='Mumbai'  ||  document.home_loan.City.value=='Thane'  ||  document.home_loan.City.value=='Navi mumbai'  ||  document.home_loan.City.value=='Kolkata'  ||  document.home_loan.City.value=='Kolkota'  ||  document.home_loan.City.value=='Hyderabad'  ||  document.home_loan.City.value=='Pune'  || document.home_loan.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.home_loan.City.value=="Delhi" || document.home_loan.City.value=='Delhi' || document.home_loan.City.value=='Noida'  ||  document.home_loan.City.value=='Gurgaon'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Gaziabad'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Greater Noida'  || document.home_loan.City.value=='Chennai'  ||  document.home_loan.City.value=='Mumbai'  ||  document.home_loan.City.value=='Thane'  ||  document.home_loan.City.value=='Navi mumbai'  ||  document.home_loan.City.value=='Kolkata'  ||  document.home_loan.City.value=='Kolkota'  ||  document.home_loan.City.value=='Hyderabad'  ||  document.home_loan.City.value=='Pune'  || document.home_loan.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}


function addtooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.home_loan.Phone.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
				

			}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.home_loan.Phone.value!="")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
  </SCRIPT>
  <script>
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
				ajaxRequest.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
			 
		}

	window.onload = ajaxFunction;


</script>
 </head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> > Home Loans</span>

  <div id="txt">
<h1>Home Loans</h1>
	
 <p><b> Overview</b><br>
   Your Home is a place where you relax after coming back from  your day’s tiring work, it is that place where you can give time to your family  &amp; spend beautiful moments with them. To acquire a home which can be  christened your “Own House” is a life-time decision &amp; has to be taken with  a lot of planning &amp; requires huge finances. Your Dream Home is not very far  away with a Home Loan which will fulfill your Dream into a reality. We at <a href="http://www.deal4loans.com/">Deal4Loans</a> are working constantly to get  you the BEST Loan Deal &amp; have brought a small guide which would answer some  important questions related to Home Loan &amp; help you decide your loan deal.<br>
   <br>
   <b>What is a Home loan?</b><br>
Home Loan is a Secured Loan offered against the security of a house/property  which is funded by the bank’s loan, the property could be a personal property  or a commercial one. The Home Loan is a loan taken by a borrower from the bank  issued against the property/security intended to be bought on the part by the  borrower giving the banker a conditional ownership over the property i.e. if  the borrower is failed to pay back the loan, the banker can retrieve the lent  money by selling the property. Get more Information on home loan section click <a href="http://www.deal4loans.com/loans/category/home-loan/" title="Articles about Home Loan">Articles about Home Loan</a> and <a href="http://www.deal4loans.com/Contents_Home_Loan_Mustread.php" title="Home Loan must read">Home Loan must read</a>.<br>
<br>
<b>Most borrowed home loans</b><br>
<b>SBI Home Loan:</b> Before borrowing any loan borrower compare  interest rates. Generally people prefer to take SBI Home Loan because SBI  (State bank of India)  is main centralized and national bank. SBI provides loan at comparatively low  interest rate.<br>
<br>
<b>HDFC Home Loan:</b> HDFC stands for Housing Development Finance  Corporation. This unit is for housing development. HDFC provides loan and low  interest rate. And you are facilitated with ease repayment option. HDFC gives  you an option of easy EMI. Because of flexible feature and transparent policy,  most people prefer HDFC home Loan for their requirement.<br>
<br>
<b>ICICI Home Finance:</b> ICICI Home Finance offers a wide range  of Home Loan products, designed to meet the requirements of customer. : ICICI  Home Finance offers Doorstep service, Speedy loan sanction, Simplified  documentation and Loan amounts ranging from Rs. 2 lakh to Rs. 3 crore Rupees  only.<br>
<br>

<b> Types of Home Loan</b><br>
There are different types of home loans available in the market to cater borrower’s different needs.<br>
<br>
• <b> Home Purchase Loan :  </b> This is the basic type of a home loan which has the purpose of purchasing a new house.<br>
<br>
• <b> Home Improvement Loan :  </b> This type of home loan is for the renovation or repair of the home which is already bought<br>
<br>
• <b> Home Extension Loan :  </b> This type of loan serves the purpose when the borrower wants to extend or expand an existing home, like adding an extra room etc.<br>
<br>
• <b> Home Conversion Loan :</b> &nbsp; It is that loan wherein the borrower has already taken a home loan to finance his current home, but now wants to move to another home. The Conversion Home Loan helps the borrower to transfer the existing loan to the new home which requires extra funds, so the new loan pays the previous loan &amp; fulfills the money required for new home.<br>
• <b> Bridge Loan :</b> &nbsp; This type of loan helps finance the new home of the borrower when he wants to sell the existing home, this is normally a short term loan to the borrower &amp; helps during the interim period when he wants to sell the old home &amp; want to buy a new one, It is given till the time a buyer is found for the old home.<br>
<br>
• <b> Home Construction Loan :</b> &nbsp; This type of loan taken when the borrower wants to construct a new home.<br>
<br>
• <b> Land Purchase Loan :</b> &nbsp; It is that loan which is taken to purchase a land for construction &amp; investment purposes. &nbsp;<br>
<br>
<b> Documents required in Home Loan</b><br>
Generally the documents required to processing your loan application are almost similar across all the banks; however they may differ with various banks depending upon specific requirement etc. Following documents are required by financial institutions to process the loan application:<br>
• Age Proof<br>
• Address Proof<br>
•Income Proof of the applicant &amp; co-applicant<br>
• Last 6 months bank A/C statement<br>
• Passport size photograph of the applicant &amp; co-applicant<br>
<br>
<b> In case of Salaried</b><br>
• Employment certificate from the employer,<br>
• Copies of pay slips for last few months and TDS certificate<br>
• Latest Form 16 issued by employer Bank statements<br>
<br>
<b> In case of Self-employed</b><br>
• Copy of audited financial statements for the last 2 years<br>
• Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company<br>
• Profit and loss account for the last few years<br>
• Income tax assessment order<br>
<br>
<b> Home Loan Process &amp; various steps involved</b><br>
There are various steps involved in getting a Home Loan from selecting your property to filling up the loan application. Following are the various stages in Home Loan:<br>
<br>
• The first step involved in the process is to <b> find your property</b> &nbsp; which is followed by the verification of property documents, post that the documents are examined &amp; simultaneously you can start searching for the lender who can offer the BEST Home Loan Deal after checking your eligibility criteria.<br>
<br>
• <b> Know the Home Loan Eligibility :</b> &nbsp; Banks offer the loan amount only after checking your profile &amp; based on various eligibility criteria’s like age, income &amp; salary banks lend you the money.<br>
<br>
• <b> Select the Best Home Loan after evaluation:</b> &nbsp; <a href="http://www.deal4loans.com/home-loans-interest-rates.php">Comparing home loan interest rates</a> is the primary feature in the home loan selection, however other fees &amp; charges like Application fees, processing fees, legal charges should not be neglected when comparing various loan offers. To check the interest rates &amp; other charges incurred by various banks, Deal4Loans has brought in a &nbsp;<a href="http://www.deal4loans.com/Interest-Rate-Home-Loans.php"> Home Loan Comparison Chart</a> &nbsp;across various Banks.<br>
<br>
• <b> Applying for the Loan :</b> &nbsp; After you have selected your lender, you have to fill in the application form wherein the lender requires complete information about your financial assets &amp; liabilities; other personal &amp; professional details together with the property details &amp; its costs.<br>
<br>
• <b> Documentation &amp; Verification Process :</b> &nbsp; You are required to submit the necessary documents to the bank which will be verified together with the details in the application.<br>
<br>
• <b> Credit &amp; default check :</b> &nbsp; Bank checks out the borrower’s loan eligibility (through repayment capacity) &amp; the amount of loan is confirmed. The borrower’s repayment capacity is reached which is based on the income, salary, age, experience &amp; nature of business etc. Bank also checks credit history through the Cibil Score which plays a critical role in deciding &amp; approving your loan application. Low Credit Score implies that the bank upfront rejects your application on the basis of earlier credit defaults; on the other hand high credit score gives a green signal to your application.<br>
<br>
• <b> Bank sanctions Loan &amp; Offer letter to the borrower :</b> &nbsp; After the credit appraisal of the borrower bank decides the final amount &amp; sanctions the loan, the bank further sends an offer letter to the borrower which constitutes the details like rate of interest, loan tenure &amp; repayment options etc.<br>
<br>
• <b> Acceptance Copy to the Bank :</b> &nbsp; The borrower needs to send an acceptance copy to the bank after the borrower agrees with the terms &amp; conditions in the offer letter.<br>
<br>
• <b> Bank checks the legal documents :</b> &nbsp; The bank further asks the legal documents of property from the borrower to check its authenticity so as to keep them as a security for the loan amount given. The next step involved is the valuation of the property by the bank which determines the loan amount sanctioned by the bank.<br>
<br>
• <b> Signing of agreement &amp; the loan disbursal :</b> &nbsp; The borrower signs the loan agreement &amp; the bank disburses the loan amount.<br>
<br>
<b> Charges in Home Loan</b><br>
Acquiring a Home Loan doesn’t only involve the cost of <a href="http://www.deal4loans.com/home-loans-interest-rates.php">home loan interest rates</a> but it also includes other charges &amp; fee accompanying at various stages of taking the Home loan. You must consider all these charges while comparing the cost structure across banks. Following is the detailed fee structure incurred by banks at different loan stages:<br>
<br>
• <b> Processing Charge :</b> &nbsp; It is a fee payable at the time of submitting the loan application to the bank which is normally non-refundable. The fee ranges between 0.5 per cent and 1 per cent of the loan amount.<br>
<br>
• <b> Administrative Fee :</b> &nbsp; It is a fee incurred by banks at the time of loan sanction; there are few banks who have removed this fee so you must check it with all the banks.<br>
<br>
• <b> Prepayment Penalties :</b> &nbsp; When the borrower pre-pays the loan before the loan tenure, banks charge a penalty which usually varies between 1 per cent and 2 per cent of the pre-paid amount.<br>
<br>
• <b> Legal Charges :</b> &nbsp; Banks also incur some charges from the customer for legal and technical verification of the property.<br>
<br>
• <b> Delayed payment Charges :</b> &nbsp; When there is a delay in the payment of your EMI, banks charge a late payment fee from the borrower which normally ranges from 2% to 3% of the EMI.<br>
<br>
• <b> Cheque bounce charges :</b> &nbsp; Banks charge between Rs. 250 and Rs. 500 for every bounced cheque towards the loan payment because of lack of funds in your account. </p>
<b><a href="http://www.deal4loans.com/home-loan-banks.php"> </a></b>
<p><b ><a href="home-loan-banks.php">Home Loan  Criteria by various banks </a></b><br>
The borrower’s eligibility of getting a home loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse's income,  age, number of dependants qualifications ,  assets, liabilities, stability and continuity of occupation and savings history. You can now check your eligibility for Home Loan through our <a href="http://www.deal4loans.com/home-loan-calculator.php">Home Loan Eligibility Calculator</a> <br>

<a href="http://www.deal4loans.com/Contents_Home_Loan_Article1.php" >Deal4loans has brought in the Home Loan Eligibility Factors by banks</a><br>
<br>
<b >Important Pointers in Home Loan</b><br>
&bull; <b>Increase your Loan eligibility</b><br>
&bull; <b>Credit History :</b> Your chances of getting a home loan are increased if you have a good credit history which is known by banks by checking the borrower’s Cibil score. Now it is very hard to get a loan from another bank when you already have a bad debt with one bank.<br>
<br>
&bull; <b>Clubbing of income :</b> Your eligibility to take a home loan will augment when you club your income with your spouse’s income, bank in this case will calculate your eligibility on the basis of the clubbed income of both the applicants. You can club incomes of spouse, children & parents staying with you and having regular income.<br>
<br>
&bull; <b>Enhance your loan tenure :</b> Longer is the loan tenure, lower will be the EMIs which further increases the repayment capacity of the borrower & in turn enhances the loan eligibility.<br>
<br>
&bull; Step-up Loan: In this type of loan EMIs remain low in the beginning & increase gradually as and when the borrower’s spending power increases. Therefore lower EMIs in the initial years enhances the borrower’s ability to pay & further increases the loan eligibility<br>
<br>
&bull; <b>Increase the down payment :</b> You must know that in a <a href="home-loan-banks.php">home loan bank</a> finances only 85 to 90% for the property & the rest amount has to be funded by the borrower. You should increase the down payment if you have more than required amount which will mitigate your debt considerably. 
<br>
<br>
<b >Tax Benefits in Home Loan</b><br>

The home loan borrower enjoys Tax Benefits on both Interest paid & the Principal re-paid. Under Section 24(d) of Income Tax, the deduction of interest payable on the home loan is up to a maximum of Rs. 1, 50,000.<br>
Under Section 80(c) of Income Tax, Principal amount for the repayment of loan along with other savings & investments is eligible for tax deduction up to a maximum limit of <br>
          Rs. 1, 00,000.
</p>
	<div align="right"><a href="#pg_up" >Top<img src="/new-images/top.gif" width="12" height="18" alt="Top" border="0"/></a></div>

	</div>

</div></div>
<div id="rgtbar">

<table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#f4e46c">
        
       <tr>
      <td height="50" align="center" valign="middle" class="frmtp"  style=" background-image:url(/new-images/frm-tp.gif); background-repeat:no-repeat;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px; text-align:center;	font-weight:bold;	color:#063149;">Apply for Home Loan </td>
    </tr>
    <td valign="top" style="padding-top:10px;">
<form name="home_loan" action="apply-home-loan-continue.php" onSubmit="return submitform(document.home_loan);" method="post">
		<table width="230" border="0" align="center" cellpadding="0" cellspacing="0" class="quick">
                              <tr>

                                <td width="105" height="23" align="left" valign="middle" class="frmbldtxt">First Name</td>
                                <td width="125" align="left" >
								<INPUT TYPE="hidden" NAME="onCloseValue" id="onCloseValue" value="1">
								<input type="text" name="Name" id="Name" style="width: 120px;"/></td>
                              </tr>
						<!--	  <tr>

                        <td width="120" height="20" align="left" valign="middle" >Date of Birth <font color="#FF0000">&nbsp;</td>
                        <td width="159"><input type="text" value="dd" name="day" id="day" maxlength="2" style="width:25px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');"/>&nbsp;<input type="text" name="month" id="month" maxlength="2" style="width:25px;"  onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" />&nbsp;<input type="text" maxlength="4" value="yyyy" name="year" id="year" style="width:50px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" /></td>
                      </tr>-->
                              <tr>
                                <td width="105" height="23" align="left" valign="middle" class="frmbldtxt">Mobile</td>

                                <td align="left" >+91 <input type="text" onChange="intOnly(this);insertData();" style="width:94px;" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="Phone" id="Phone"  value="" onFocus="addtooltip();"  >
                                </td>
                              </tr>
							   <tr>
		  <td colspan="2"><div id="myDiv" style="color:#671212; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
                              <tr>
                                <td height="23" align="left" valign="middle" class="frmbldtxt">Email</td>
                                <td align="left" ><input   style="width: 120px;" value="" name="Email" id="Email" onBlur="onBlurDefault(this,'Email Id');" onFocus="removetooltip();"  onChange="insertData();">                                </td>
                              </tr>
                              <tr>
                                <td height="23" align="left" valign="middle" class="frmbldtxt">City</td>
                                <td align="left" ><select size="1" align="left" style="width: 122px;"  name="City" id="City" onChange=" insertData(); tataaig_comp(); othercity1(this); " /> <?=getCityList($City)?></td>
                              </tr>
                              <tr>
                                <td height="23" align="left" valign="middle" class="frmbldtxt">Other City </td>
                                <td align="left" ><input disabled value="Other City"  onfocus="this.select();" name="City_Other" id="City_Other" style="width: 120px;"  onBlur="onBlurDefault(this,'Other City');">                                </td>
                              </tr>

						<!--	  <tr>

                        <td height="20" align="left" valign="middle" >Pincode</td>
                        <td><input name="Pincode" type="text" id="Pincode" style="width: 120px;" onFocus="this.select();" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  maxlength="6" /></td>
                      </tr>

					  <tr>
                        <td width="120" height="20" align="left" valign="middle" >Current Residence Address</td>
                        <td><input type="text" name="Residence_Address" id="Residence_Address" style="width:125px; height:35px;"/></td>
                      </tr>
					  -->
					     <tr>
                                <td width="105" height="23" align="left" valign="middle" class="frmbldtxt">Net Salary</td>

                           <td align="left" ><input value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width: 120px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome'); onBlurDefault(this,'Annual Income');">                                </td>
              </tr>
                              <tr>
                                <td align="left" valign="middle"  colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
                              <tr>
                                <td height="23" align="left" valign="middle" class="frmbldtxt">Loan Amount </td>

                                <td align="left" ><input value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width: 120px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); onBlurDefault(this,'Loan Amount');">
                                    <input type="hidden" name="referrer" value="">
                                    <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
                                    <input type="hidden" name="creative" value="">
                                    <input type="hidden" name="section" value="">
                                    <input type="hidden" name="source" value="">
                                    <input type="hidden" name="last_id" value="">
                                <input type="hidden" name="PostURL" value="/apply-home-loan.php">                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="middle" ><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
					 <!-- <tr>
                        <td height="20" align="left" valign="middle" >Company Name </td>
                        <td><input type="text" name="Company_Name" id="Company_Name" style="width: 120px;"/></td>
                      </tr>
					  
					    <tr>
                        <td height="20" align="left" valign="middle" >Employment Status <font color="#FF0000">&nbsp;</td>
                        <td><select style="width: 120px;" name="Employment_Status" id="Employment_Status">
								<option selected value="-1">Employment Status</option>

								<option  value="1">Salaried</option>
								<option value="0">Self Employed</option>
                            </select></td>
                      </tr>
                      
                        <td height="20" align="left" valign="middle" ><span class="form-text">Estimated market value of the property?</span></td>
                        <td><select name="Budget" style="width:145px;" >
					<option value="-1" selected>Please Select</option>
					<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>

					<option value="7-15 Lakhs">7-15 Lakhs </option>
					<option value="15-20 Lakhs">15-20 Lakhs </option>
					<option value="20-25 Lakhs">20-25 Lakhs </option>
					<option value="Above 25 Lakhs">Above 25 Lakhs</option>
                        </select></td>
                      </tr>
                      <tr>

                        <td height="20" align="left" valign="middle" ><span class="form-text">When you are planning to take loan?</span></td>
                        <td><select name="Loan_Time" style="width:145px;">
                            <OPTION value="-1" selected>Please select</OPTION>
							<OPTION value="15 days">15 days</OPTION>
							<OPTION value="1 month">1 months</OPTION>
							<OPTION value="2 months">2 months</OPTION>

							<OPTION value="3 months">3 months</OPTION>
							<OPTION value="3 months above">more than 3 months</OPTION>
							</select>
							   
							<input type="hidden" name="ProductValue" id="ProductValue" value="99309" />
							<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
							
							<input type="hidden" name="Phone" id="Phone" value="9999999999" />
							<input type="hidden" name="City" id="City" value="Delhi" />
							<input type="hidden" name="Net_Salary" id="Net_Salary" value="150000" />							   </td>
                      </tr>
                      <tr>
                        <td width="120" height="20" align="left" valign="middle" >Property Identified</td>
                        <td >
						
						<input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" /> Yes&nbsp;&nbsp;<input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" /> No</td>
                      </tr>

                      	<tr><td colspan="2" id="myDiv"></td></tr>
						<tr><td colspan="2" id="myDiv2"></td></tr>-->
					  
					  <tr>
                              
		      <tr><td colspan="2"><div id="tataaig_compaign"></div></td></tr>
                              <tr>
                                <td height="45" colspan="2" align="left" valign="middle">
								<input type="hidden" name="Activate" id="Activate" >
								<input type="checkbox" name="accept2" style="border:none;">
								I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the Terms And Condition.</td>
                              </tr>
                              <tr>
                                <td   colspan="2" align="center" valign="middle"><input type="image" src="/new-images/sbtn1.gif" style="width:101px; height:33px; border:none;" /></td>
                              </tr>
            </table>
</form>
	</td>
  </tr>
  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
  <tr>
  <td bgcolor="#FFFFFF"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"  ><div id="testi"><div align="center" style="width:210px; margin-left:20px; text-align:left; line-height:15px; padding-top:45px;">Hi deal4loans team, the article on home loans was the first article i read and it has given me a good insight into the home loans scenarios.. thanks a ton<br>

<div style="float:right; font-weight:bold; padding-top:10px;">Umesh Sondhi</div></div></div></td>
</tr>
  <tr>
    <td  style="padding-top:2px" bgcolor="#FFFFFF"><table cellspacing="0" cellpadding="0" border="0">
		<tr>
              <td height="40" colspan="3" align="center" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif;" ><b>Home Loan Rate of Interest</b><br />
<div align="center" style="font-size:11px;">( Last edited on : <? echo $currentdate; ?> )</div></td>
          </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" ><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="62" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank</td>
                  <td width="64" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                    of Interest</td>
                  <td width="47" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Prepayment<br />
                    charges</td>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;"><a href="sbi-home-loan.php" style="color:#335599;">SBI</a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8%-11%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/home-loan-apply.php" target="_blank" style="color:#335599;">APPLY</a></td>
                </tr>
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;"><a href="lic-housing-home-loan.php" style="color:#335599;">LIC</a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"> 8.75%-9.25% </td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/home-loan-apply.php" target="_blank" style="color:#335599;">APPLY</a></td>
                </tr>
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;"><a href="icici-hfc-home-loan.php" style="color:#335599;">ICICI HFC</a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8.75%- 9.75%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/home-loan-apply.php" target="_blank" style="color:#335599;">APPLY</a></td>
                </tr>
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;"><a href="hdfc-bank-home-loan.php" style="color:#335599;">HDFC</a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8.75%-9.50%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/home-loan-apply.php" target="_blank" style="color:#335599;">APPLY</a></td>
                </tr>
              </table></td>
            </tr>
           
            </table></td>
  </tr>
</table>
</div>

<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom-new1.php';?><?php } ?>
</div>
</body>
</html>

