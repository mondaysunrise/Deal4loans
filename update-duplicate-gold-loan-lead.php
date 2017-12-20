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
	$lead_date = $_POST['lead_date'];
	$Reference_Code = generateNumber(4);

$SMSMessage = "Dear Customer,your activation code is :".$Reference_Code." .Use it in step further to get best quotes, And Help us to serve you better.";
			if(strlen(trim($Phone)) > 0)
			{
				SendSMS($SMSMessage, $Phone);
			}

$getpersonal_Lead="select Name, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, DOB, Updated_Date,Email From Req_Loan_Gold where RequestID=".$custid;
list($alreadyExist,$myrow)=Mainselectfunc($getpersonal_Lead,$array = array());
$Name = $myrow['Name'];
	$City =$myrow['City'];
	$City_Other =$myrow['City_Other'];
	$Mobile_Number = $myrow['Mobile_Number'];
	$Net_Salary = $myrow['Net_Salary'];
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
<title>Apply and Compare gold Loan India</title>
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

function addtooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Enter correct Mobile Number to Activate you Loan Request';
			//}
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
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > Apply Gold Loan</span>
 
  <div id="txt">	
     <div class="faqContainer">
	 <h1>
You have already applied with us for Gold Loan
on <? echo $showDate; ?>. Your application is under process.
You will hear from our team to process your application.<br />
You have requestid to change your contact details, please verify here.
<!--If you havent heard from us and want to change your contact Details <a class="flip" onclick="checkdata();" style="cursor:pointer;">Click Here...</a>--></h1>
<form name="loan_form" method="post" action="/duplicate-gold-loan-values.php"
" onSubmit="return chkform();">
 <input type="hidden" name="lead_date"  value="<? echo $Updated_Date; ?>">
      <input type="hidden" name="Reference_Code"  value="<? echo $Reference_Code; ?>">
		<input type="hidden" name="custid"  value="<? echo $custid; ?>">
		<input type="hidden" name="oldmobile_no"  value="<? echo $Mobile_Number; ?>">
				<input type="hidden" name="Phone"  value="<? echo $Phone; ?>">
<div id="getdetails" >
						<table width="458" border="0" cellspacing="0" align="center" cellpadding="0">
  <tr>
          <td valign="middle" style="background-repeat:no-repeat;">&nbsp;</td>
        </tr>
        <tr>
          <td height="74" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;"><h1 >Your Gold Loan Details</h1></td>
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
                <input type="text" name="Phone" id="Phone" style="width:124px;" maxlength="10" onchange="intOnly(this);insertData();" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="<?php echo $Mobile_Number; ?>" onFocus="addtooltip();"></td>
            </tr>
          
            <tr>
              <td height="30" class="frmbldtxt">City </td>
              <td class="frmbldtxt">
                  <?php echo $strCity; ?>
                            </td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt">Annual Income</td>
              <td class="frmbldtxt"><?php echo $Net_Salary; ?></td>
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
              <td colspan="2"><input type="checkbox" name="accept" style="border:none;" checked />
                I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
                agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
            </tr>
            <tr>
              <td colspan="2" align="center" valign="top"><!--	 <input name="image"  value="Submit" type="image" src="images/sbmt-btn.gif" width="64" height="30" style="border:0px;" /> -->
                  <input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/>
                &nbsp;
                <!--<input name="image"   value="Reset" type="image" src="images/rst-bttn.gif" width="64" height="30"  border="0" style="border:0px;"/> --></td>
            </tr>
           
          </table></td>
      </tr>
        <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
      </tr>
      </table>
 
  </div>
  </form>
  </div>
  </div>

<?php include '~Bottom-new.php';?>
</div>
</body>
</html>