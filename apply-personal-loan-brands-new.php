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
		$Net_Salary = FixString($Net_Salary);
		/*if($Employment_Status==1)
		{
		$Net_Salary = FixString($Net_Salary);
		$Net_Salary = $Net_Salary*12;
		}
		else
		{
			$Net_Salary = FixString($Net_Salary);
		}*/
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
		
		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		//$query = mysql_query($Sql);
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
				$res_user=ExecQuery($qry_user);
				$row_user=mysql_fetch_array($res_user);
				$UserID1=$row_user["UserID"];
				
				$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage,Updated_Date,IP_Address,Accidental_Insurance) VALUES ('$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code', '$source','$From_Pro','$Card_Vintage',Now(),'$IP' ,'$Accidental_Insurance')";
				
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Personal Loan | Deal4Loans India</title>
<meta name="keywords" content="Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	
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
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
	
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>

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


function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.From_Product.length; i++) 
	{
        if(document.personalloan_form.From_Product[i].checked)
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


function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.IncomeAmount.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="addexpandeddiv" ></div>';
				

			}
		}
		
		return true;

	}

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr align="left"><td   class="frmbldtxt"><b>Card held since?</b></td><td style="padding-left:20px;"><select size="1" name="Card_Vintage" style="width:150px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></td></tr></table>';
				

			}
		}
		
		return true;

	}


function removeElement()
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




if((Form.Full_Name.value=="") || (Form.Full_Name.value=="Name")|| (Trim(Form.Full_Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Full_Name.focus();
return false;
}
else if(containsdigit(Form.Full_Name.value)==true)
{
alert("Name contains numbers!");
Form.Full_Name.focus();
return false;
}
  for (var i = 0; i < Form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Full_Name.focus();
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

	
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 Form.Phone.focus();
                return false;
        }

if(document.personalloan_form.Email.value!="Email Id")
{
	if (!validmail(document.personalloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.personalloan_form.Email.focus();
		return false;
	}
	
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
/*for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }*/
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


if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income") || (Form.Net_Salary.value=="Monthly Income"))
{
	alert("Please enter Income to Continue");
	Form.Net_Salary.focus();
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


function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
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

function netsalarytab()
{
	//alert(document.getElementById('Employment_Status').value);
	 if (( document.personalloan_form.Employment_Status.value=="0" ) || ( document.personalloan_form.Employment_Status.value=="-1" ))
       {
               document.personalloan_form.Net_Salary.value = "Annual Income";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
               document.personalloan_form.Net_Salary.value = "Monthly Income";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}   

function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.personalloan_form.City.value=="Delhi" || document.personalloan_form.City.value=='Delhi' || document.personalloan_form.City.value=='Noida'  ||  document.personalloan_form.City.value=='Gurgaon'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Gaziabad'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Greater Noida'  || document.personalloan_form.City.value=='Chennai'  ||  document.personalloan_form.City.value=='Mumbai'  ||  document.personalloan_form.City.value=='Thane'  ||  document.personalloan_form.City.value=='Navi mumbai'  ||  document.personalloan_form.City.value=='Kolkata'  ||  document.personalloan_form.City.value=='Kolkota'  ||  document.personalloan_form.City.value=='Hyderabad'  ||  document.personalloan_form.City.value=='Pune'  || document.personalloan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal;" >Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.personalloan_form.City.value=="Delhi" || document.personalloan_form.City.value=='Delhi' || document.personalloan_form.City.value=='Noida'  ||  document.personalloan_form.City.value=='Gurgaon'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Gaziabad'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Greater Noida'  || document.personalloan_form.City.value=='Chennai'  ||  document.personalloan_form.City.value=='Mumbai'  ||  document.personalloan_form.City.value=='Thane'  ||  document.personalloan_form.City.value=='Navi mumbai'  ||  document.personalloan_form.City.value=='Kolkata'  ||  document.personalloan_form.City.value=='Kolkota'  ||  document.personalloan_form.City.value=='Hyderabad'  ||  document.personalloan_form.City.value=='Pune'  || document.personalloan_form.City.value=='Bangalore')
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
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container"  >  
  <span><a href="index.php">Home</a> > <a href="personal-loans.php">Personal loan </a> > Apply Personal Loan</span>
  <div style="padding-top:15px; ">
  
<font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong>
          <?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?>
          </strong></font>
            <form name="personalloan_form"  action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply Personal Loan</h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center"><input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="CompBrand Personal Loan"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">First Name :</td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Full_Name" id="Full_Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="18%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onchange="othercity1(); tataaig_comp(); insertData();" tabindex="7">
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
                     <td height="28" class="frmbldtxt">Pincode :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt">Email ID :</td>
                     <td width="32%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                     <td width="18%" height="28" class="frmbldtxt">Company Name :</td>
                     <td width="31%" height="28" class="frmbldtxt"><input name="Company_Name" id="Company_Name" type="text" tabindex="10"   style=" width:148px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" /></td>
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
                <td height="28" class="frmbldtxt">Occupation :</td>
                <td class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="11" >
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Annual Income :</td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="12" />
                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Loan Amount :</td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="13" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
           
              <tr>
                <td height="28" class="frmbldtxt">Credit Card Holder?</td>
                <td class="frmbldtxt"> 
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="14"  value="1" onClick="addElement();">Yes &nbsp;&nbsp;
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="15" value="0" onClick="removeElement();">No</td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><div id="myDiv"></div> </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
          </tr>
            <tr>
            <td class="frmbldtxt" colspan="2" align="left"> <div  id="tataaig_compaign" ></div></td>
            </tr>
          <tr>
            <td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">
              <input type="checkbox" name="accept" style="border:none;">
I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a></td>
            <td width="24%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
          </tr>
         

          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form><br />

  
   <?
	  $selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	
	 list($rowscount,$myrow)=MainselectfuncNew($selectplbanks,$array = array());
	
	
	//$plbankresult = ExecQuery($selectplbanks);
	//$rowscount = mysql_num_rows($plbankresult);
	  ?>
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="115" valign="top">
          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" >
            <tr><td height="30"bgcolor="#494949" class="txt-hd" style="color: #FFFFFF; text-align:center; font-weight:bold;  border-right:1px solid #d5cfb1;" valign="middle">Banks</td>
	        </tr>
            <tr>
              <td height="40" align="center"bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Rate of Interest </b></td>
            </tr>
            <tr><td height="50" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Processing Fee</b></td>
	        </tr>
            <tr><td height="40" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Loan Amount</b></td>
	        </tr>
            <tr><td height="40" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Prepayment Charges</b></td>
	        </tr>
            <tr><td height="40" align="center"  valign="middle" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Disbursal Time</b></td>
	        </tr>
            <tr><td height="350" align="center" valign="top" bgcolor="#FFFFFF" class="txt-hd" style="border:1px solid #d5cfb1; border-top:none;"><b>Documents</b></td>
            </tr>
      </table>	      </td>
<!--Database Driven -->
        <?
		 if($rowscount>0)
		 {
		 	$i=0;
		
			 while($i<count($myrow))
        {
			 ?>
          
        <td  valign="top">
          <table width="286" align="left" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td height="30" align="center" bgcolor="#494949" class="txt-hd"  style=" color:#FFFFFF; font-weight:bold; border-right:1px solid #d5cfb1;">
              <? echo $myrow[$i]["pl_bank_name"];?></td>
            </tr>
            <tr>
              <td height="40" align="center" class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$i]["pl_bank_roi"];?></b></td>
	        </tr>
            <tr>
              <td height="50" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$i]["pl_bank_processing_fee"];?></b></td>
	        </tr>
            <tr>
              <td height="40" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$i]["pl_bank_loan_amt"];?></b></td>
	        </tr>
            <tr>
              <td height="40" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$i]["pl_bank_prepayment"];?></b> </td>
	        </tr>
            <tr>
              <td height="40" align="center"  class="txt-hd" valign="middle" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b><? echo $myrow[$i]["pl_bank_disbursal_time"];?></b> </td>
	        </tr>
            <tr>
              <td align="left" height="350" class="txt-hd" valign="top" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><? echo $myrow[$i]["pl_bank_documents"];?> </td></tr>
        </table></td>
           <? 
			   $i=$i+1;
			   }
			   }?>
 
      </tr>
    </table>
<div class="sldrpnl" >
	<div id="slider">
		<ul>				
			        <li>
<div><img  src="new-images/slider/thumb/partner_citifinancial.gif" alt="Citifinancial" width="134" height="37"  style="border:none;"/></div>
<div><img  src="new-images/slider/thumb/partner_fullerton.gif" alt="Fullerton India" width="124" height="36"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/hdfc.jpg" alt="HDFC Bank" width="138" height="39"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/barclays.jpg" alt="Barclays Finance" width="138" height="37"  style="border:none;"/></div>

            </li>
            <li>
<div><img  src="new-images/slider/thumb/partner_citibank.gif" alt="Citibank" width="108" height="33"  style="border:none;"/></div>
<div><img  src="new-images/slider/thumb/partner_fullerton.gif" alt="Fullerton India" width="124" height="36"  style="border:none;"/></div>
<div><img  src="new-images/slider/thumb/partner_citifinancial.gif" alt="Citifinancial" width="134" height="37"  style="border:none;"/></div>

<div><img src="new-images/slider/thumb/hdfc.jpg" alt="HDFC Bank" width="138" height="39"  style="border:none;"/></div>
            </li>
		</ul>
	</div>
</div>
	<br />

   
   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div></body>
</html>

