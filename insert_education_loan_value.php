<?php
ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

//print_r($_POST);

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$Type_Loan = $_POST['Type_Loan'];
		$finalurl=$_POST["PostURL"];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$Residence_City = FixString($City);
		$Gender = FixString($gender);
		$Residence_City_Other = FixString($City_Other);
		$Course = FixString($Course);
		$Country = FixString($Country);
		$Collateral_Security =FixString($Collateral_Security);
		//$cpp_card_protect = FixString($cpp_card_protect);
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$source = FixString($source);
		$Employment_Status = FixString($Employment_Status);
		$Course_Name = FixString($Course_Name);
		$Coborrower_Income = FixString($Coborrower_Income);
		$hdfclife = FixString($hdfclife);
		$Dated = ExactServerdate();	
		$hdfc_credila=0;
		
		//$IP_Remote = getenv("REMOTE_ADDR");
		//if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
		//else { $IP=$IP_Remote;	}
                
                $IP=ExactCustomerIP();
                
		if(strlen($Course_Name)>0)
		{
			$chkcrs='select hdfccourse_name from hdfc_credila_ncourse_list Where (hdfccourse_name like "%'.$Course_Name.'%")';
			list($chkcrsnum,$chkcrsresult)=MainselectfuncNew($chkcrs,$array = array());
			if($chkcrsnum>0)
			{
				$hdfc_credila=0;
			}
			else
			{
				$hdfc_credila=1;
			}
		}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		$Reference_Code = generateNumber(4);
			
	function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'7' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}


//if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
if(($validMobile==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Education Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361','9555060388','9311773341') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."')";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-education-loan-lead.php'"."</script>";
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
		
		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'Gender'=>$Gender, 'Loan_Amount'=>$Loan_Amount, 'Residence_City'=>$Residence_City, 'Residence_City_Other'=>$Residence_City_Other, 'Country'=>$Country, 'Course'=>$Course, 'Collateral_Security'=>$Collateral_Security, 'IP_Address'=>$IP, 'source'=>$source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Reference_Code'=>$Reference_Code, 'Employment_Status'=>$Employment_Status, 'Course_Name'=>$Course_Name, 'Coborrower_Income'=>$Coborrower_Income, 'hdfc_credila'=>$hdfc_credila);
	//	echo "<br>if".$InsertProductSql;
	}
	else
	{
		$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>'1');
		$UserID = Maininsertfunc("wUsers", $wUsersdata);

		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'Gender'=>$Gender, 'Loan_Amount'=>$Loan_Amount, 'Residence_City'=>$Residence_City, 'Residence_City_Other'=>$Residence_City_Other, 'Country'=>$Country, 'Course'=>$Course, 'Collateral_Security'=>$Collateral_Security, 'IP_Address'=>$IP, 'source'=>$source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Reference_Code'=>$Reference_Code, 'Employment_Status'=>$Employment_Status, 'Course_Name'=>$Course_Name, 'Coborrower_Income'=>$Coborrower_Income, 'hdfc_credila'=>$hdfc_credila);
		//echo "<br>else".$InsertProductSql;
		}

 $ProductValue = Maininsertfunc ("Req_Loan_Education", $dataInsert);
 
//Send SMS
ProductSendSMStoRegis($Phone);
 
 
	/*if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email);
		}*/
		
if($hdfclife==1)
		{
			$Product=9;
			Insert_HdfcLife($Name, $Residence_City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}
		$SMSMessage = "Dear $Name,your activation code is: $Reference_Code. Use it in step 2 of loan app form to get quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				{
					//SendSMS($SMSMessage, $Phone);
				}
	$_SESSION['Temp_LID'] = $ProductValue;

	header("Location: thank-apply-education-loans.php");
	exit();	

		}
}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}

	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Apply for Education Loan | Deal4Loans India</title>
<meta name="keywords" content="Apply Education Loans, Compare Education Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore" />
<meta name="description" content="Apply Online Education Loans through Deal4loans.com Get instant information on gold loans from all gold loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. " />
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript">
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

function addElement()
{
	
		var ni = document.getElementById('myDiv');
		 var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td height="25"><font color="#330101">Reconfirm Mobile No.</font></td>	<td width="158" ><input size="18" type="text" style="margin-left:8px;" maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}

function chkeducaionloan(Form)
{

		if(Form.Reference_Code1.value=="")
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

</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container"  >  
  <span><a href="index.php">Home</a> > Apply Education Loan</span>
  <div style="padding-top:15px; ">
  
<font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong>
          <?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?>
          </strong></font>
            <form name="eduloan_form"  action="thank-apply-education-loans.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply Education Loan</h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center"><input type="hidden" name="Type_Loan" value="Req_Loan_Education">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="RequestID" value="<?php echo $ProductValue; ?>">
</td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td width="25%" height="28" class="frmbldtxt" style="padding-top:3px; ">Activation Code</td>
                     <td width="34%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Reference_Code1" id="Reference_Code1" style="width:150px;" maxlength="4"  tabindex="1" /></td>
                     </tr>
                   <tr valign="middle">
                     <td height="28" colspan="2" class="frmbldtxt"><input   type="checkbox" style="border:none;"  name="confirm" value="hello"  id="confirm"  onClick="addElement();" > <font color="#330101"> If you havent received activation code sms</font> </td>
                     </tr>
                     <tr valign="middle">
                     <td height="28" colspan="2" class="frmbldtxt">
                     <div id="myDiv"></div>
                     </td></tr>
                 </table></td>
               </tr>
             </table></td>
          </tr>     
          <tr>
            <td width="55%" align="left" class="frmbldtxt"  style="font-weight:normal;">&nbsp;</td>
            <td width="45%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
          </tr>
            </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form><br />
  
   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div></body>
</html>
