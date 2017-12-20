<?php
	header("Location: personal-loans.php");
	exit();
	
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
		$Dated = ExactServerdate();
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
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		
		
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "1";
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
		//echo "tataaig:".$Sql."<br>";
		//exit();

	}

		//$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
		if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
	
			//SQL Query
			
					$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage,Updated_Date,IP_Address,Accidental_Insurance)
						VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code','$source','$From_Pro','$Card_Vintage',Now(),'$IP','$Accidental_Insurance')"; 
				//echo "QUERY!: ".$sql;
			//	exit();
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
				$result = ExecQuery($sqlquery);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) 
				{
					do
					{
						$Email_New=$myrow["Email"];
						//$Name_New=$myrow["FName"];
					}while ($myrow = mysql_fetch_array($result));
				}
					mysql_free_result($result);
			}
	
			$Email = trim($Email);
			$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			//echo $query."kk";
			$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
			$msgUserDoesNotExist = "Email does not exists in the database";
			$result = ExecQuery($query);
			$rows = mysql_num_rows($result);		
			echo mysql_error();
	
			
			if ($myrow = mysql_fetch_array($result)) 
			{
				do
				{
					$_SESSION['Temp_Flag_Message'] = "1";
					$_SESSION['Temp_Flag'] = "1";
					$_SESSION['Temp_UserID'] = $myrow["UserID"];
				}while ($myrow = mysql_fetch_array($result));
				mysql_free_result($result);
						
				$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
				
				 list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
				$k=0;
				//$res_user=ExecQuery($qry_user);
				//$row_user=mysql_fetch_array($res_user);
				$UserID1=$row_user[$k]["UserID"];
				
				//$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage,Updated_Date,IP_Address,Accidental_Insurance) VALUES ('$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code', '$source','$From_Pro','$Card_Vintage',Now(),'$IP' ,'$Accidental_Insurance')";
				
						
		$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance);
		$table = 'Req_Loan_Personal';
		$insert = Maininsertfunc ($table, $dataInsert);
  
				
				$result = ExecQuery($sql);
				$Lid = mysql_insert_id();
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
				
				$result = ExecQuery($sql);
				$Lid = mysql_insert_id();
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

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Personal Loans| Personal Loans India| Personal loans Online</title>
<meta name="description" content="Get online information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="personal loans India, Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore,Personal loans Online">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script src="scripts/scroller.js" type="text/javascript"></script>

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
	if(loan_form.City.value=="Others")
	{
		loan_form.City_Other.disabled = false;
	}
	else
	{
		loan_form.City_Other.disabled = true;
	}
}   


function netsalarytab()
{
	//alert(document.getElementById('Employment_Status').value);
	 if (( loan_form.Employment_Status.value=="0" ))
       {
               document.getElementById('nettab').innerHTML = "Net Salary (yearly)<font size='1' color='#FF0000'>*</font>";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
               document.getElementById('nettab').innerHTML = "Net Take Home(Monthly Salary)<font size='1' color='#FF0000'>*</font>";
			     //document.getElementById('plantype1').innerHTML = strPlan;
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

function addBankdetails()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table class="quick"><tr><td  width="50%">Card held since?</td><td  width="50%"><select size="1" name="Card_Vintage" style="width:125px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option><option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>	<option value="4">more than 12 months</option> </select></td></tr></table>';
				

			}
		}
		
		return true;

	}


function removeBankdetails()
{
		var ni = document.getElementById('myDiv');
		
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
function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.From_Product.length; i++) 
	{
        if(document.loan_form.From_Product[i].checked)
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

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkpersonalloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
<?
if($_SESSION['UserType']=="") 
{
?>
if(document.personalloan_form.Email.value!="Email Id")
{
	if (!validmail(document.personalloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.personalloan_form.Email.focus();
		return false;
	}
	
}

<?
}
?>
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
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

	
if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if (Form.Phone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 Form.Phone.focus();
                return false;
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

 if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
else if(Form.Company_Name.value.length < 3)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
	alert("Please enter Income to Continue");
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

myOption = -1;
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

				}
					myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
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

</Script>
<script>
function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
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
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank"  > Get free personal accident insurance from TATA AIG</a>';
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
			var get_full_name = document.getElementById('Full_Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="1";

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
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<style>
 .quick {font: 11px verdana; font-weight:normal; color:#042348;}

   .bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	background-color: #529BE4;
	width:80px;
	height:25px;
	font-weight: bold;
}

.verl1bld{
	font:Verdana, Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:bold;
	text-align:left;
	color:#0F74D4;
	text-decoration:none;
	line-height:22px;
}

.nrmlbld{
	font:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	text-align:left;
	color: #333333;
	text-decoration:none;
}

#topbar{
position:absolute;
margin: 202px 0px 0px 0px ;
padding: 0px ;
width: 100px;
float:left;
visibility: hidden;
}

.bluebutton1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	background-color: #529BE4;
	width:80px;
	height:25px;
	font-weight: bold;
}

</style>
<div id="dvMainbanner">
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
   <?php include '~Upper.php';?><?php } ?>
<div id="dvbannerContainer">
	<div id="header-img"><div id="rgt-img">&nbsp;</div>
	<div class="hedr-text">Personal Loans</div>
	<div id="hdr-lft">
	<div id="top-link">
 <ul>
    <li><a href="Contents_Personal_Loan_Eligibility.php">View Eligibility</a></li>
    <li><a href="Request_Loan_Personal_New.php">Apply Now</a></li>
    <li><a href="Contents_Personal_Loan_Mustread.php">Must Read</a></li>
    <li><a href="Contents_Personal_Loan_Faqs.php">FAQs</a></li>
 </ul>
   
	</div>
	</div>
	<div id="corn-img"  class="text-wdth">
    <div id="text"><img src="images/spacer.gif" width="10" height="70" border="0" align="left" /> Are you looking for a way to get your holiday financed for this summer or planning to buy consumer durables for your home or want to gift an expensive solitaire to your wife on your anniversary, Personal Loan comes to your rescue & funds all your financial needs no matter if you dont have any solid asset against which you can take a loan.</div>
	</div>
	</div>
  </div>  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
  <div id="topbar"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >

<td height="47" align="center" valign="middle" background="<?php echo $WebsitePath;?>images/step-pnl-bg.gif" style="font-size:16px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF;">3 Steps</td>
</tr>

<tr >
<td align="center" bgcolor="#D98E1A" class="lftsteps-text"><img src="<?php echo $WebsitePath;?>images/stp1.gif" width="32" height="31" /><br>
  Post Personal Loans Requirement </td>
</tr>

<tr >
<td align="center" bgcolor="#D08108"class="lftsteps-text"><img src="<?php echo $WebsitePath;?>images/stp2.gif" width="31" height="31" /><br>
  Compare & Get Offers from Personal Loans Companies</td>
</tr>

<tr >
<td align="center" bgcolor="#BE740A" class="lftsteps-text"><img src="<?php echo $WebsitePath;?>images/stp3.gif" width="31" height="31" /><br>
  Get the Best Personal Loans Deal! </td>
</tr>
</table>
</div>

<div id="dvMaincontent" style="width:510px; text-align:left;">

<h1 class="pg_heading" >Personal Loans</h1>

 <p>
<b class="verl1bld">What is a Personal loan?</b><br>
Personal Loan is an unsecured loan for personal use which doesn't require any security or collateral and can be availed for any purpose, be it a wedding expenditure, a holiday or purchasing consumer durables, the personal loan is very handy & caters to all your needs.  The amount of loan can be ranged from Rs. 50,000 - Rs. 20 lakh & the tenure for repaying the loan varies from 1 to 5 years. </p>

<p><b class="verl1bld">Benefits of Personal loan</b><br>
- <b>A Loan without security : </b> A Personal Loan is not a secured loan (bank doesn't ask for any security or collateral) as against a Secured Loan where one is required to pledge a house or other security to acquire a loan.<br>
- <b>Simple Documentation:   </b> A Personal Loan can be accessed with minimal paperwork or documentation & doesn't take much time to procure as against a Secured Loan.<br>

- <b>No specification about the end use of the loan amount : </b> You are not required to disclose the end use of the money borrowed, Banks are concerned about the fact that whether the borrower is able to pay back the loan with interest before the due date or not and they confirm this by checking the income, employment or business & other factors of the borrower.<br>

-  <b>Big Loan amount :  </b> Personal Loan is a means to fulfill bigger loan requirement, you can take a loan ranging from Rs. 50,000 to Rs. 20 lakh.<br>
</p>

<p><b class="verl1bld">Basis to compare Personal Loans</b><br>

-	<b>Compare Interest Rates :</b> Personal Loan can be compared primarily on the basis of interest rates which vary across banks depending on your profile which is further linked to your occupation, salary/income, credit history etc. The interest rate ranges from 12% to 25%, you must go for that loan which is offering you at the minimum rate.<br>
<br>

-	<b>Other Charges :</b>  You should also check on the other charges like processing fee, pre-payment penalties and documentation fee because they increase the overall loan cost and vary widely across banks. <br>
<br>
-	<b>Evaluation of various Loan offers :</b> You should first calculate the entire loan cost across banks which constitutes the rate of interest & banks other charges. Evaluate offers keeping the tenure of the loan constant & compare the rate of interest, EMIs & other charges. This process will help you get the Best Loan deal.<br>
<br>
&nbsp;&nbsp; &bull; <b>EMIs :</b> EMI is the monthly equated installment which constitutes the principal amount and the interest on the principal equally divided across each month in the loan tenure. Use our <a href="http://deal4loans.com/Contents_Calculators.php">EMI Calculator to compare EMIs across banks</a><br>
<br>
&nbsp;&nbsp; &bull; <b>Tenure :</b> Tenure is the time frame for the personal loan payments to be paid back to the bank; it ranges from 1 year to 5 years.  If you have a longer tenure you will end up paying more interest & will have lower EMI, on the other hand shorter loan tenure will carry higher EMIs & the interest amount is less.  You must compare the loan offers by keeping the tenure constant.
<br>
<br>
-	<b>Eligibility Check :</b> Before taking a personal loan you must know the eligibility criteria's offered by various banks on the basis of which they offer loans.  Checking the eligibility parameters will help you find the best loan deal. Check out your eligibility by various banks.<br>
<br>
-	<b>Turnaround time :</b> It becomes one of the most important factors in evaluation of your loan application when you are in a dire need of money. Turnaround time is the time which banks take in processing your loan application; you must check this parameter which varies from bank to bank.
</p>

<p><b  class="verl1bld">Charges involved in Personal Loan</b><br>
The Rate of interest alone should not be judged before you finalize your application, apart from the rate of interest, Personal Loan also constitutes other charges levied by the lender which affect the overall cost of your loan & should be considered while comparing it across banks. Following are the lists of charges:<br><br>

-	<b>Processing fee :</b>  It is a fee charged by banks frosm the borrowers to process their loan application; it is normally between 1-2 percentage of the loan amount.<br>
<br>
-	<b>Prepayment fee :</b> Banks charge borrowers with a fee when they pay the loan EMIs before the tenure which normally is between 2-5% of the outstanding loan amount. <br>
<br>
-	<b>Late penalties :</b> When there is a delay in paying your monthly EMIs of your loan, banks charge a late payment fee with your EMIs. They normally range from 2-3% of the EMI.<br>
<br>
-	<b>Cheque bounce charges :</b> Banks charge between Rs. 250-500 for every bounced cheque given for the payment of the loan amount owing to the insufficient funds in your account.<br>
<br>
-	<b>Documentation charges :</b> These are the charges for verifying the borrowers documents to processing the loan application. These vary from Rs. 500-Rs. 1000.<br>
<br>
-	You should note that the above charges vary across different banks; you should consider these charges before choosing the personal loan as they will determine its real costs.

</p>

<p><b class="verl1bld">Documents required in Personal Loan </b><br>

The documentation process in personal loan is very fast as against secured loans. Following documents are required by financial institutions to process the loan application:<br>
-	Identity proof<br>
-	3 to 6 months Bank statements<br>
-	Residence proof<br>
-	Salary slip<br>
-	Guarantors & their same set of documents<br>

In case of self-employed banks require balance sheets, profit & loss account, partnership deed & other mandatory documents etc.
</p>

<p><b class="verl1bld">Personal Loan Eligibility criteria by various banks </b><br>
Banks offer Personal Loan to borrowers depending on various factors such as income, employment, continuity of business so as to make sure that they repay the loan with interest before the due date. The eligibility criterion of a Personal Loan is primarily based on the work profile of a loan seeker which is broadly divided into the following two classes: <br>
-	Self-employed<br>
-	Salaried<br>
In addition to the above factors banks also consider other aspects such as age, work experience, existing relationship with the bank, repayment capacity etc.<br>

To find your eligibility Criteria across various banks in accordance with the above parameters; Deal4Loans has brought in the <a href="http://deal4loans.com/Contents_Personal_Loan_Eligibility.php">Eligibility Criteria</a> Check for Personal Loan seekers.</p>

<p>
<b class="verl1bld">How does the Cibil Score affect your loan application?</b><br>
This a norm wherein the banks before giving Personal Loan checks the database of all loan borrowers in the country by the Credit Information Bureau of India (CIBIL) which is called the Cibil Score. If there has been a default in your loan payment; your loan application would certainly be rejected. Your Cibil score ranges from 100 to 999, for instance if your credit score is 100 then your loan application might be out rightly rejected. On other hand if it is higher say 800, then your loan application would be processed faster & will be rewarded with lower interest rates & discounts in processing fee & other charges.<br>

You can improve your credit score by repaying your loan EMIs on time and always pay the minimum payment on your credit card to avert from the bad credit score.</p>
  
  
<p><b  class="verl1bld">Reducing Interest Rate or Flat Interest Rate, which is better?</b><br>

The Interest Rates vary between 14% and 25% depending on your profile & payment ability. There are basically two types of interest Rates offered by banks which are
<br>
1.	Reducing Balance Interest Rate<br>
2.	Flat Interest Rate<br>
In the Reducing Interest Rate calculation method, the interest on your loan keeps on reducing as it is calculated on the reduced principle amount which gets reduced daily, monthly, quarterly or annually.<br>
Flat Interest Rate calculation method on other hand implies that your rate of interest remains the same & is calculated over the entire loan period. The outstanding loan amount is never reduced over the loan tenure.<br><br>

It is always advised to take a loan at reducing balance interest rates as the Flat rate calculation comes out to be really expensive.</p>

 <p>
<b class="verl1bld">Important pointers in Personal Loan</b><br>

<b>Increase your loan eligibility :</b> You can increase your eligibility of the loan amount by clubbing your income with your spouses income.<br><br>

<b>Relationships with banks :</b> You can get discounts on interest rates if you take a loan from a bank that you already deal with for your existing relationship, in this case banks will consider your past records of credit repayments and your saving account balance and you will be offered discounts on the basis of your current relationship.<br>
<br>
<b>Cibil Score Check :</b> You must know that your credit history play a very important role in the acceptance of your loan application as CIBIL keeps a record of credit history by collecting your credit data from various financial institutions. A decent credit score not only gives a green signal to your loan application but also offers you lower interest rates by the bank.<br>
<br>
<b>Penalties :</b> If you think of closing your loan earlier, this will invite the pre-payment charges levied by the bank which are upto 5% of the outstanding loan amount. Some banks have this norm wherein you are not allowed to close your loan within the first six months of your loan term. You should also know about the charges taken by the bank for paying your EMI late.
</p>

 </div>

<div style="float:right; width:220px;"><table width="220" border="0" align="right" cellpadding="0" cellspacing="0" >
  <tr>
  <td height="25" align="center" bgcolor="#529be4" class="quick" style=" color:#FFFFFF; font-size:12px; font-weight:bold;" >Apply for Personal Loan </td>
  </tr>
    <td style="border:solid 1px #529be4; border-top:none; padding-top:5px;" align="left">

<form name="personalloan_form"  action="/thank_personalloan.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">


		<table width="230" border="0" align="center" cellpadding="0" cellspacing="4" class="quick" >
		<input type="hidden" name="referrer" value="">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="">
<input type="hidden" name="section" value="">
<input type="hidden" name="source" value="">
<input type="hidden" name="PostURL" value="/personalloans.php">	
			<tr>
			<td>Full Name</td>
			<td align="left" width="131" height="18" ><input  value="Full Name" name="Name"   onBlur="onBlurDefault(this,'Full Name');" onFocus="onFocusBlank(this,'Full Name');" style="width:125px;"></td>
			</tr>
			<tr>

		   <td align="left" height="20"><font >&nbsp;DOB</font></td>
		   <td colspan="2" align="right" height="20">
			<input name="day" value="dd" type="text" id="day"  style="width:25px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" style="width:25px;" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"  onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" style="width:50px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">
		   </td>

		 </tr>
		 
		 <tr>

				<td align="left"  width="87" height="20">&nbsp;Mobile No.</td>
				<td colspan="2" align="right"  height="20" >
				+91
				<input style="width:95px;" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  name="Phone"  onFocus="return Decorate('Please give correct Mobile number,to activate your loan request.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="font-size:10px;width:105px;text-align:center;font-family:verdana;">
				</div></td>
		  </tr>
			<tr>
			<td>Email Id</td>
				<td align="left" height="18" ><input name="Email" value="Email Id" onBlur="onBlurDefault(this,'Email Id');" onFocus="onFocusBlank(this,'Email Id');" style="width:125px;"></td>

			</tr>
			<tr>
			<td>City</td>
		 <td align="left"  >
		  <select size="1" align="left" style="width:125px;"  name="City" onChange="othercity1(this); tataaig_comp();" > <?=getCityList($City)?></select>
		 
		 </td>
	   </tr>

<tr>
<td>Other City</td>
				<td  align="center" >
				<input   disabled value="Other City"   name="City_Other" style="width:125px;" onBlur="onBlurDefault(this,'Other City');" onFocus="onFocusBlank(this,'Other City');"></td>
		  </tr>
			
			<tr>
			<td>Pincode</td>
				<td align="center"  >
				<input   value="Pincode"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  name="Pincode" style="width:125px;" onBlur="onBlurDefault(this,'PinCode');" onFocus="onFocusBlank(this,'Pincode');" maxlength="7"></td>

			</tr>

			
			<tr>
			<td>Employement Status</td>
				<td align="left" >
				<select align="left" style="width:125px;"  name="Employment_Status" id="Employment_Status" onChange="netsalarytab();">
				<option selected value="-1">Employment Status</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>

			</tr>
			
			<tr>
			<td>Company Name</td>
				<td  align="center" height="18">
				<input   name="Company_Name"  value="Company Name" style="width:125px;" onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"></td>
			</tr>
			
			<tr>
			<td>Annual Income</td>
				<td  align="left" height="18">
				<input  value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:125px;" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); if(document.getElementById('Employment_Status').value==1){ onBlurDefault(this,'Net Take Home(Montly Salary)');}else {onBlurDefault(this,'Annual Income');
				};"><br> <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>

				
			</tr>
			<tr>
			<td>Loan Amount</td>
				<td  align="left" height="18">
				<input  value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  style="width:125px;" onKeyDown="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount');"></td>
			</tr>
			<tr>
			<td colspan="2"> <span id='formatedlA' style='font-size:11px; color:#042348; font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; color:#042348; font-Family:Verdana;text-transform: capitalize;'></span></td>
			</tr>
			 <tr>
			<td align="left"   width="87" height="20"><font >Are you a Credit card holder?</font></td> 
			<td    ><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1"  onclick="addBankdetails();" > 
			  Yes&nbsp;&nbsp;
			<input type="radio" class="NoBrdr" name="CC_Holder" value="0" onClick="removeBankdetails();">
			No
</td>
		</tr>	
	    <tr><td colspan="2" id="myDiv"></td></tr>
	    <tr><td colspan="2" id="tataaig_compaign"></td></tr>

    <tr><td colspan="2" >
		  <input type="checkbox"  name="accept" checked="checked" style="border:none;"> 
		I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the Terms And Condition.
</td></tr>
<tr><td colspan="2" align="center"><input name="submit" type="submit"   class="bluebutton1"  value="Submit"    border="0"/></td>
</tr>
		  </table>

	</form>
</td>
  </tr>
  <tr>
  <td  style="padding-top:2px"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px dashed #529BE4;">
  <tr>
    <td height="20" align="center" bgcolor="#529BE4" class="quick" style=" color:#FFFFFF; font-size:12px;" >Testimonial</td>
  </tr>
  <tr>
    <td class="quick" style="font-weight:normal; padding:2px;">&nbsp;</td></tr>
</table>
</td>
</tr>
</table></div>
  
  
  </div>	
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><?php } ?>
	  </div>

  </body>
</html>