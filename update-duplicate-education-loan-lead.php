<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$requestid = $_SESSION['Temp_LID'];


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$custid= $_POST['custid'];
	$Phone = $_POST['Phone'];
	$oldmobile_no = $_POST['oldmobile_no'];
	echo $Phone."<br>";
	$lead_date = $_POST['lead_date'];
	$Reference_Code = generateNumber(4);

$SMSMessage = "Dear Customer,your activation code is :".$Reference_Code." .Use it in step further to get best quotes, And Help us to serve you better.";

			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);


$getpersonal_Lead="select Name, Residence_City, Residence_City_Other, Mobile_Number, Loan_Amount, DOB, Updated_Date,Email From Req_Loan_Education where RequestID=".$custid;
list($alreadyExist,$myrow)=Mainselectfunc($getpersonal_Lead,$array = array());
	$Name = $myrow['Name'];
	$City =$myrow['Residence_City'];
	$City_Other =$myrow['Residence_City_Other'];
	$Mobile_Number = $myrow['Mobile_Number'];
	$Loan_Amount = $myrow['Loan_Amount'];
	$DOB = $myrow['DOB'];
	$Email = $myrow['Email'];
	$Updated_Date = $myrow['Updated_Date'];
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


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Apply and Compare Education Loan India</title>
<meta name="description" content="Apply Business Loan: Apply for online business loans. Apply for Business Loan to get the offers from HDFC Bank, Citibank, Citibank, SBI etc.">
<meta name="keywords" content="Business Loans India, Apply Business Loans, Compare Business Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript"> 
function checkdata()
{
	//alert(document.getElementById('getdetails'));
	document.getElementById('getdetails').style.visibility="";
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
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > Education Loan > Apply Education Loan</span>
 
  <div id="txt">	
     <div class="faqContainer">
 
<h1>You have already applied with us for Education Loan
on <? echo $showDate; ?>. Your application is under process.
You will hear from our team to process your application.<br /></h1>
<form name="loan_form" method="post" action="/duplicate-education-loan-values.php" onSubmit="return chkform();">

   <input type="hidden" name="lead_date"  value="<? echo $Updated_Date; ?>">
      <input type="hidden" name="Reference_Code"  value="<? echo $Reference_Code; ?>">
		<input type="hidden" name="custid"  value="<? echo $custid; ?>">
		<input type="hidden" name="oldmobile_no"  value="<? echo $Mobile_Number; ?>">
				<input type="hidden" name="Phone"  value="<? echo $Phone; ?>">
						<table width="458" border="0" cellspacing="0" align="center" cellpadding="0">
  <tr>
          <td valign="middle" style="background-repeat:no-repeat;">&nbsp;</td>
        </tr>
        <tr>
          <td height="74" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;"><h1 >Your Education Loan Details</h1></td>
      </tr>
  <tr>
          <td valign="top" class="aplfrm" style="padding-left:30px; "><table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
            
            <tr>
              <td width="188" height="30" class="frmbldtxt"><b>Full Name</b></td>
              <td class="frmbldtxt"><?php echo $Name; ?></td>
            </tr>
            
            <tr>
              <td height="30" class="frmbldtxt"><b>Email ID</b></td>
              <td class="frmbldtxt"><?php echo $Email; ?></td>
            </tr>
           
            
            <tr>
              <td height="30" class="frmbldtxt">DOB</td>
              <td class="frmbldtxt"><?php echo $DOB;?></td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt" style="font-weight:normal; "><b>Mobile</b> (For SMS Alerts)</td>
              <td class="frmbldtxt"> +91
               <?php echo $Phone; ?></td>
            </tr>
          
            <tr>
              <td height="30" class="frmbldtxt">City </td>
              <td class="frmbldtxt">
                  <?php echo $strCity; ?>
                            </td>
            </tr>
           
                  <tr>
              <td height="30" class="frmbldtxt">Loan Amount Required</td>
              <td class="frmbldtxt"><?php echo $Loan_Amount; ?>                  </td>
            </tr>
            <tr>
              <td width="188" height="30" class="frmbldtxt"><b>Activation Code</b></td>
              <td class="frmbldtxt"><input type="text" name="Activation_Code" id="Activation_Code" style="width:152px;" maxlength="30"  /></td>
            </tr>
           
            <tr>
              <td colspan="2" align="center" valign="top"><!--	 <input name="image"  value="Submit" type="image" src="images/sbmt-btn.gif" width="64" height="30" style="border:0px;" /> -->
                  <input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/>
                &nbsp;
               </td>
            </tr>
           
          </table></td>
      </tr>
        <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
      </tr>
      </table>
 
  

  </form>
  </div>
  </div>

 
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>