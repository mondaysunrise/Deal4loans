<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$requestid = $_SESSION['Temp_LID'];

if($requestid >0)
{
	$getCar_Lead="select Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Car_Type, DOB, Updated_Date,Email From Req_Loan_Car where RequestID=".$requestid;
	list($alreadyExist,$myrow)=MainselectfuncNew($getCar_Lead,$array = array());
	$myrowcontr=count($myrow)-1;

	$Name = $myrow[$myrowcontr]['Name'];
	$Employment_Status = $myrow[$myrowcontr]['Employment_Status'];
	$Company_Name =$myrow[$myrowcontr]['Company_Name'];
	$City =$myrow[$myrowcontr]['City'];
	$City_Other =$myrow[$myrowcontr]['City_Other'];
	$Mobile_Number = $myrow[$myrowcontr]['Mobile_Number'];
	$Net_Salary = $myrow[$myrowcontr]['Net_Salary'];
	$Loan_Amount = $myrow[$myrowcontr]['Loan_Amount'];
	$Car_Type = $myrow[$myrowcontr]['Car_Type'];
	$DOB = $myrow[$myrowcontr]['DOB'];
	$Email = $myrow[$myrowcontr]['Email'];
	$Updated_Date = $myrow[$myrowcontr]['Updated_Date'];
	$explode_Dated = explode(" ", $Updated_Date);
		  $explodeDated = explode("-", $explode_Dated[0]);
		  
		
		$dt = mktime(0, 0, 0, date($explodeDated[1]), date($explodeDated[2]),   date($explodeDated[0]));
		$showDate = date("d M, Y",$dt);
		
	

	if($City=="Others")
	{
		$strCity= $City_Other;
	}
	else
	{
		$strCity= $City;
	}
}
else
{
	echo "<script language=javascript>"." location.href='Contents_Car_Loan_Mustread.php'"."</script>";
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Apply and Compare Business Loan India</title>
<meta name="description" content="Apply Business Loan: Apply for online business loans. Apply for Business Loan to get the offers from HDFC Bank, Citibank, Citibank, SBI etc.">
<meta name="keywords" content="Business Loans India, Apply Business Loans, Compare Business Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript"> 
function checkdata()
{
	//alert(document.getElementById('getdetails'));
	document.getElementById('getdetails').style.visibility="";
}

function addtooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Enter correct Mobile Number to Activate you Insurance Request';
			//}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML!="")
		{
		
//			if(document.loan_form.Phone.value!="")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
		//	}
		}
		
		return true;

	}

</script>
<Script Language="JavaScript">

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
}
	

</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x: hidden;
	background-color: #FFF;
}
.red {
	color: #F00;
}
-->
.aplfrm {
	background: none repeat scroll 0 0 #F6FCFF;
	border-left: 5px solid #A2D7F6;
	border-right: 5px solid #A2D7F6;
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
  <div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Car Loan</a></div>
  <div class="intrl_txt">
    <div style="clear:both; height:15px;"></div>
    <div id="txt">
      <div class="faqContainer"> <span class="text" style="color:#4c4c4c; font-size:16px; text-align:center; font-weight:bold;" > You have already applied with us for Car Loan
        on <? echo $showDate; ?>. Your application is under process.
        You will hear from our team to process your application.<br />
        If you havent heard from us and want to change your contact Details <a class="flip" onclick="checkdata();" style="cursor:pointer;">Click Here...</a></span>
        <form name="loan_form" method="post" action="update-duplicate-car-loan-lead.php
" onSubmit="return chkform();">
          <div id="getdetails" style="visibility:hidden;" >
          <input type="hidden" name="lead_date"  value="<? echo $lead_date; ?>">
          <input type="hidden" name="custid"  value="<? echo $requestid; ?>">
          <input type="hidden" name="oldmobile_no"  value="<? echo $Mobile_Number; ?>">
          <div class="agent-form">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="74" colspan="2" valign="middle" align="center"><span class="text" style="color:#4c4c4c; font-size:18px; font-weight:bold; text-align:center;">Your Car Loan Details</span></td>
              </tr>
              <tr>
                <td width="188" height="30" class="frmbldtxt"><b>Full Name</b></td>
                <td class="frmbldtxt"><?php echo $Name; ?></td>
              </tr>
              <tr>
                <td height="30" class="frmbldtxt">DOB</td>
                <td class="frmbldtxt"><?php echo $DOB;?></td>
              </tr>
              <tr>
                <td height="30" class="frmbldtxt">City </td>
                <td class="frmbldtxt"><?php echo $strCity; ?></td>
              </tr>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>