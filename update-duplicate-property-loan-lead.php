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

	/*$SMSMessage = "Dear Customer,your activation code is :".$Reference_Code." .Use it in step further to get best quotes, And Help us to serve you better.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
*/

	$getProperty_Lead="select * From Req_Loan_Against_Property where RequestID=".$custid;
list($alreadyExist,$myrow)=Mainselectfunc($getpersonal_Lead,$array = array());
	
	$Name = $myrow['Name'];
	$Email = $myrow['Email'];
	$DOB = $myrow['DOB'];
	$Mobile_Number = $myrow['Mobile_Number'];
	$Employment_Status = $myrow['Employment_Status'];
	$Company_Name =$myrow['Company_Name'];
	$City =$myrow['City'];
	$City_Other =$myrow['City_Other'];
	$Pincode = $myrow['Pincode'];
	$Net_Salary = $myrow['Net_Salary'];
	$Property_Value = $myrow['Property_Value'];
	$Loan_Amount = $myrow['Loan_Amount'];
	
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
<title>Apply and Compare Loans Against Property India</title>
<meta name="description" content="Apply Loans Against Property online. Know the schemes from all loans against property providing banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc. Compare Documents, EMI, Interest rates and Fees.">
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
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
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if(document.loan_form.Activation_Code.value=="")
	{
		alert("Please fill your Activation_Code.");
		document.loan_form.Activation_Code.focus();
		return false;
	}

   
}

</script>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
 <span><a href="index.php">Home</a> > <a href="loan-against-property.php">Loan Against Property</a> > Apply Loan Against Property</span>
  <div id="txt">	
     <div class="faqContainer">
 <h1>You have already applied with us for Loan Against Property
on <? echo $showDate; ?>. Your application is under process.
You will hear from our team to process your application.<br />
</h1>
<form name="loan_form" method="post" action="/duplicate-property-loan-values.php" onSubmit="return chkform();">

   <input type="hidden" name="lead_date"  value="<? echo $Updated_Date; ?>">
      <!--<input type="hidden" name="Reference_Code"  value="<? //echo $Reference_Code; ?>">-->
		<input type="hidden" name="custid"  value="<? echo $custid; ?>">
		<input type="hidden" name="oldmobile_no"  value="<? echo $Mobile_Number; ?>">
				<input type="hidden" name="Phone"  value="<? echo $Phone; ?>">
						<table width="458" border="0" cellspacing="0" align="center" cellpadding="0">
  <tr>
          <td valign="middle" style="background-repeat:no-repeat;">&nbsp;</td>
        </tr>
        <tr>
          <td height="74" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;"><h1 >Your Loan Against Property Details</h1></td>
      </tr>
  <tr>
          <td valign="top" class="aplfrm" style="padding-left:30px; "><table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
              <td height="30" class="frmbldtxt">Full Name</td>
              <td class="frmbldtxt"><?php echo $Name; ?></td>
            </tr>
                       <tr>
              <td width="46%" height="30" class="frmbldtxt">Email ID </td>
              <td width="54%" class="frmbldtxt"><?php echo $Email; ?></td>
            </tr>
           
            <tr>
              <td height="30" class="frmbldtxt">DOB</td>
              <td class="frmbldtxt"><?php echo $DOB; ?></td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt" style="font-weight:normal; "><b>Mobile</b> (For SMS Alerts)</td>
              <td class="frmbldtxt">+91
               <?php echo $Phone; ?></td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt">Occupation</td>
              <td class="frmbldtxt">
			  <?php if($Employment_Status=='-1')
				{echo "";}
				if($Employment_Status=='1')
				{echo "Salaried";}
				if($Employment_Status=='0')
				{echo "Self Employed";}
				
			?></td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt"><b>Company Name</b></td>
              <td class="frmbldtxt"><?php echo $Company_Name; ?></td>
            </tr>
           
            <tr>
              <td height="30" class="frmbldtxt">City</td>
              <td class="frmbldtxt"><?php echo $strCity; ?>       </td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt">Pincode</td>
              <td width="54%" class="frmbldtxt"><?php echo $Pincode; ?>              </td>
            </tr>
        
            <tr>
              <td height="30" class="frmbldtxt" style="font-weight:normal; "><b>Net Salary</b> (Yearly)</td>
              <td class="frmbldtxt"><?php echo $Net_Salary; ?></td>
            </tr>
                      
            <tr>
              <td height="30" class="frmbldtxt">Value of Property</td>
              <td class="frmbldtxt"><?php echo $Property_Value; ?></td>
            </tr>
            <tr>
              <td height="30" class="frmbldtxt">Loan Amount</td>
              <td class="frmbldtxt"><?php echo $Loan_Amount; ?></td>
            </tr>
               <tr><td colspan="2" class="frmbldtxt">Word Verification:   	
	Type the characters you see in the picture below. </td></tr>
			<tr>
              <td>

			  <table width="100%"><tr>
                        
                        <td><img src="scripts/captcha.php" /></td><td width="60px">                           
                            <input type="text" name="captcha" id="captcha" maxlength="4" size="6"/></td>
                    </tr></table></td>
            </tr>    
           <!--<tr>
              <td width="188" height="30" class="frmbldtxt"><b>Activation Code</b></td>
              <td class="frmbldtxt"><input type="text" name="Activation_Code" id="Activation_Code" style="width:90px;" maxlength="30"   onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)" /></td>
            </tr>-->
           
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