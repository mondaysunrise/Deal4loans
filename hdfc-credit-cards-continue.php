<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		
function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}
	
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Name = $_POST['Name'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB = $year."-".$month."-".$day;
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	
	$Gender = $_POST['Gender'];
	
	$Employment_Status = $_POST['Employment_Status'];
	$company_name = $_POST['company_name'];
	$Net_Salary = $_POST['Net_Salary'];
	$hdfc_account = $_POST['hdfc_account'];
	$average_balance = $_POST['average_balance'];
	$Applied_status = $_POST['Applied_status'];
	$cc_status = $_POST['cc_status'];
	$salary_mode = $_POST['salary_mode'];
	//echo "<br>";
	$getDOB = $year."".$month."".$day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	$CountOfTable = $_POST['CountOfTable'];
	$ccBankName = "";
	$ccBankTime = "";
	$ccBankLimit = "";
	for($cT=0;$cT<=$CountOfTable;$cT++)
	{
		$cc_bank_name = $_POST['cc_bank_name_'.$cT];
		$cc_bank_year = $_POST['cc_bank_year_'.$cT];
		$cc_bank_month = $_POST['cc_bank_month_'.$cT];
		$cc_bank_time = $cc_bank_year."-".$cc_bank_month;
		$cc_bank_limit = $_POST['cc_bank_limit_'.$cT];
		$ccBankName[] = $cc_bank_name;
		$ccBankTime[] = $cc_bank_time;
		$ccBankLimit[] = $cc_bank_limit;
	}
	
//	print_r($ccBankLimit);
	$maxCCLimit = max($ccBankLimit);
	
	$ccBank_Name = implode(",",$ccBankName);
	$ccBank_Time = implode(",",$ccBankTime);
	$ccBank_Limit = implode(",",$ccBankLimit);
	
	if($City == "Others")
	{
		$CityC = $City_Other;
	}
	else
	{
		$CityC = $City;
	}
	
	 $checkCCLimitSql = "SELECT * FROM hdfc_card_for_card where city = '".$CityC."'";
	list($CheckNumRows,$checkCCLimitQuery)=MainselectfuncNew($checkCCLimitSql,$array = array());
 	$card_limit = $checkCCLimitQuery[0]['card_limit'];
	
	$Dated = ExactServerdate();
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Phone'=>$Phone, 'DOB'=>$DOB, 'Residence_Type'=>'', 'Gender'=>$Gender, 'City'=>$City, 'City_Other'=>$City_Other, 'Employement_Type'=>$Employement_Type, 'Monthly_Salary'=>$Net_Salary, 'Last_Applied'=>$Applied_status, 'HDFC_Account'=>$hdfc_account, 'Credit_Card'=>$cc_status, 'Dated'=>$Dated, 'Source'=>'', 'cc_bank_name'=>$cc_bank_name, 'cc_bank_time'=>$cc_bank_time, 'cc_bank_limit'=>$cc_bank_limit, 'company_name'=>$company_name, 'salary_mode'=>$salary_mode);
		$table = 'req_hdfc_lead';
		$lid = Maininsertfunc ($table, $dataInsert);
	if($Age>20 && $Applied_status=="No" && ($salary_mode!="cash"))
	{
		$getCompanySql ="select * from hdfc_company_list_gold where COMPANY_NAME = '".$company_name."'";
		list($getCompanyNum,$getCompanyQuery)=MainselectfuncNew($getCompanySql,$array = array());
		if($getCompanyNum>0)
		{
			$Category = $getCompanyQuery[0]['Category'];
			$explodeCategory = explode(" ", $Category);
			$checkCategory = implode("_", $explodeCategory);
		//echo "<br>";
			//print $checkCategory;
		//echo "<br>";
			if($Employment_Status=="Salaried" && ($hdfc_account=="Salary Account"  || $hdfc_account=="No") )
			{
			//inhouse
				$cutoff = "inhouse";
				if($hdfc_account=="No")
				{
					$checkCategory = "Cat_V";
				}
			}
			else if($Employment_Status=="Salaried" &&  ($hdfc_account=="Non-Salary Account" || $hdfc_account=="No") )
			{
				//opm
				$cutoff = "opm";	
				if($hdfc_account=="No")
				{
					$checkCategory = "Cat_Z";
				}
			}
			
			if($City == "Others")
			{
				$City = $City_Other;
			}
			
			$checkCitySql = "select * from hdfc_salary_cut_gold where city = '".$City."' and cutoff='".$cutoff."'";
			list($checkCityNum,$checkCityQuery)=MainselectfuncNew($checkCitySql,$array = array());
			$salarycut = $checkCityQuery[0][$checkCategory];
			
				if(($Net_Salary >=$salarycut && $salarycut>0 ) || (($maxCCLimit >= $card_limit) && $card_limit>0 && $maxCCLimit>0))
				{
					$finalWords = "You are eligible for the card.";
				}
				else
				{
					$finalWords = "You are not eligible for the card due to less Salary.";
				}	
		}
		else
		{
			if($Employment_Status=="Salaried" )
			{
			
				$cutoff = "opm";
				 $checkCitySql = "select * from hdfc_salary_cut_gold where city = '".$City."' and cutoff='".$cutoff."'";
			
				list($checkCityNum,$checkCityQuery)=MainselectfuncNew($checkCitySql,$array = array());					
				$salarycut = $checkCityQuery[0]['Cat_Z'];
			
				if(($Net_Salary >=$salarycut && $salarycut>0 ) || (($maxCCLimit >= $card_limit) && $card_limit>0 && $maxCCLimit>0) )
				{
					$finalWords = "You are eligible for the card.";
				}
				else
				{
					$finalWords = "You are not eligible for the card due to less Salary.";
				}	
				 
			}
			else
			{
				$finalWords = "You are not eligible for the card.";
			}
		}
	}
	else
	{
		$finalWords = "You are not eligible for the card.";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Credit Cards - Deal4loans</title>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="list_hdfc.js"></script>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;
	background-image:url(new-images/hdfc-gold/bg.gif);

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}
form{
margin:0px;
padding:0px;

}

.bldtxt{
font-weight:bold;
color:#4f4d4d;
 }


.txt ul{
	margin:0px;
	padding:0px;
}

.txt ul li{
	background: url(new-images/hdfc-gold/arrow.gif) no-repeat 0px 6px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

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
		width:195px;	/* Width of box */
		height:100px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:9px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	

</style>
<script type="text/javascript">
function validationPancard()
{
	var a=document.getElementById('Pancard').value;
	
	var regex1=/^[A-Z]{5}\d{4}[A-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  return false;
	}
}


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


	
function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	var a=Form.Pancard.value;
	
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	   Form.Pancard.focus();
	  return false;
	}
	
	if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
	{
			alert("The Forth position should be 'P'. ");
			 Form.Pancard.focus();
			return false;
	}
	
	if(Form.Address.value=="")
	{
	alert("Kindly fill in your Address!");
	document.loan_form.Address.select();
	return false;
	}
	
	if(Form.Pincode.value=="")
	{
	alert("Kindly fill in your Pincode!");
	document.loan_form.Pincode.select();
	return false;
	}
	
	if(Form.Designation.value=="")
	{
	alert("Kindly fill in your Designation!");
	document.loan_form.Designation.select();
	return false;
	}
	
	if(Form.work_email.value!="")
	{

		var str=Form.work_email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
		
		
		if(aa==-1)
		{
			alert("Please enter the valid Email Address");
			Form.work_email.focus();
			return false;
		}
		else if(bb==-1)
		{
			alert("Please enter the valid Email Address");
			Form.work_email.focus();
			return false;
		}
		
	}


	
	
	if(Form.landline_no.value!="")
	{
		if(Form.std_code.value=="")
		{
			alert("Please fill your STD Code for Residence Landline number.");
			Form.std_code.focus();
			return false;
		}
	}
	
	if(Form.identity_proof.selectedIndex==0)
	{
		alert("Please select Identity Proof");
		Form.identity_proof.focus();
		return false;
	}
	if(Form.address_proof.selectedIndex==0)
	{
		alert("Please select Address Proof");
		Form.address_proof.focus();
		return false;
	}
	
	
	

}
	
	</script>

</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #eadbc8; ">
  <tr>
    <td height="200" valign="top"><table width="946" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="237" height="185"><img src="new-images/hdfc-gold/hdr1.gif" width="237" height="185" /></td>
        <td width="227"><img src="new-images/hdfc-gold/hdr2.gif" width="227" height="185" /></td>
        <td width="242"><img src="new-images/hdfc-gold/hdr3.gif" width="242" height="185" /></td>
        <td width="240"><img src="new-images/hdfc-gold/hdr4.gif" width="240" height="185" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="8" cellpadding="0">
      <tr valign="top">
        <td width="484"><table cellspacing="0" cellpadding="4" width="100%" border="0">
      
        
        <tr> 
          <td width="100%" align="left" valign="top" class="txt">
		  <ul>
		  <li><b>Attractive Reward Points</b>*<br />
             Earn 1 reward point per Rs 150 spent on the Gold Credit Card.</li>
		   <li><b>Rewards points redemption</b><br />
After earning all those reward points on your HDFC Bank Gold Credit Card, redeem them for exciting gifts and services! You could even convert them to airline miles with India's leading airlines through the MyRewards programme.</li>
		   <li><b>Worldwide acceptance</b><br />
Accepted at over 23 million Merchant Establishments around the world, including 110,000 Merchant Establishments in India.</li>
		   <li><b>Revolving credit facility </b><br />
Pay a minimum amount, which is 5% (subject to a minimum amount of Rs.200) of your total bill amount or any higher amount whichever is convenient and carry forward the balance to a better financial month. For this facility you pay a nominal charge of just 3.25% per month (39.0% annually).</li>
		   <li><b>Free Add-on card</b><br />
You can share these wonderful features with your loved ones too - we offer the facility of an add-on card for your spouse, children or parents. Allow us to offer add-on cards to you FREE OF COST with our compliments.</li>
		   <li><b>Interest free credit facility </b><br />
Avail of up to 50 days of interest free period from the date of purchase (subject to the submission of the charge by the Merchant).</li>
		   <li><b>Zero liability on lost card</b><br />
If you happen to lose your Card, report it immediately to our 24-hour call centre. After reporting the loss, you carry zero liability on any fraudulent transactions on your card.</li>
		   </ul>
           </td>
        </tr>
    </table></td>
        <td width="450" valign="top">
<?php
if($finalWords=="You are eligible for the card.")
{
	$DataArray = array("eligible"=>"Yes" );
	$wherecondition ="(RequestID='".$lid."')";
	Mainupdatefunc ('req_hdfc_lead', $DataArray, $wherecondition);
?>				
<form name="loan_form" method="post" action="hdfc-credit-cards-thanks.php" onSubmit="return submitform(document.loan_form);">
<input type="hidden" name="lid" value="<?php echo $lid; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="left" style="color:#FF0000; font-weight:bold; padding-left:20px;"><?php  //echo "Need More Info"; ?></div>
<table width="450"  border="0" align="right" cellpadding="0" cellspacing="0" background="new-images/hdfc-gold/frm-bg.gif"  >
<tr>
 <td width="450" height="42"    align="center" valign="bottom"><img src="new-images/hdfc-gold/frm-hdng.gif" width="450" height="42" /></td>
			 </tr>
			  <tr>
                <td  align="center" valign="top" >
				 <table width="98%"  border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
	<td width="175"  height="26" align="right" class="bldtxt">Pancard</td>
	<td width="16" align="center" class="bldtxt"> : </td>
	<td align="left"><input type="text" name="Pancard" id="Pancard" maxlength="10" /> </td>
  </tr>
    <tr>
	<td align="right" class="bldtxt">Address</td>
	<td width="16" align="center" class="bldtxt">:</td>
	<td width="250" align="left"><textarea name="Address" cols="20" rows="4" style="width:140px; "></textarea></td>
  </tr>
  <tr>
	<td  height="26" align="right" class="bldtxt">City</td>
	<td width="16" align="center" class="bldtxt">:</td>
	<td width="250" align="left"><input type="text" name="cit" id="cit" readonly value="<?php echo $City ; ?>" /> </td>
  </tr>
  <tr>
	<td  height="26" align="right" class="bldtxt">Pincode</td>
	<td width="16" align="center" class="bldtxt">:</td>
	<td width="250" align="left"><input type="text" name="Pincode" id="Pincode" maxlength="6" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  /> </td>
  </tr>
    <tr>
	<td  height="26" align="right" class="bldtxt">Designation</td>
	<td width="16" align="center" class="bldtxt">:</td>
	<td width="250" align="left"><input type="text" name="Designation" id="Designation" /></td>
  </tr>
    <tr>
	<td height="26" align="right" class="bldtxt" >Work Email</td>
	<td width="16" align="center" class="bldtxt">:</td>
	<td  width="250" align="left"><input type="text" name="work_email" id="work_email" /></td>
  </tr>
  <tr>
	<td  height="26" align="right" class="bldtxt">Official Number</td>
	<td width="16" align="center" class="bldtxt">:</td>
	<td  width="250" align="left"><input type="text" name="std_code" style="width:35px; color:silver;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"  onfocus="if(this.value=='std'){this.value=''; this.style.color='black';}" onblur="if(this.value==''){this.value='std'; this.style.color='silver';}" value="std">
        <input type="text" name="landline_no" style="width:100px;" maxlength="8" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"></td>
  </tr>
      <tr>
	<td  height="26" colspan="3">
	<table align="center" cellpadding="0" cellspacing="0">
	<tr><td height="26" align="center" class="bldtxt" >Ever defaulted on any loan or credit card?</td>
	</tr><tr><td height="22" align="center" >
	  <input value="false" type="radio" name="cc_default"> Yes
		<input value="No" type="radio"  name="cc_default" checked="checked">No
	
</td></tr>

	<tr><td class="bldtxt">Proof of Identity</td></tr><tr><td>
	<select name="identity_proof" style="width:370px; ">
    <option value="">Select</option>
    <option value="Company ID card">Company ID card</option>
    <option value="PAN Card">PAN Card</option>
    <option value="Driving License">Driving License</option>
    <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Bank pass book">Bank pass book</option>
    <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>
    <option value="Credit/Debit card of other Bank with Photo ">Credit/Debit card of other Bank with Photo </option>
    <option value="I don't have any of the above">I don't have any of the above</option>
</select>
	</td></tr>
	<tr>
	  <td height="10"></td>
	  </tr>
	<tr><td class="bldtxt">Proof of Address</td>
	</tr><tr><td>
	<select name="address_proof"  style="width:370px;">
    <option value="">Select</option>
    <option value="Company ID card">Company ID card</option>
    <option value="Certified letter from Employer">Certified letter from Employer</option>
    <option value="Driving License">Driving License</option>
    <option value="Passport">Passport</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old">Telephone,electricity,water or gas bill less than 2 months old </option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Land line bill on your/family member name (last 3 months)">Land line bill on your/family member name (last 3 months)</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Voters ID (if it has  address)">Voters ID (if it has  address)</option>
    <option value="Rental / Lease Agreement">Rental / Lease Agreement</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>
    <option value="Title deeds / Municipality Tax Receipt">Title deeds / Municipality Tax Receipt</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>
    <option value="Senior citizens card from Indian Railways/Indian Airlines">Senior citizens card from <br />Indian Railways/Indian Airlines</option>
    <option value="I don't have any of the above">I don't have any of the above</option>


</select>
	</td></tr>
	</table>
	
	</td>
  </tr>
 
    
 <tr>
    <td height="40" colspan="3" align="center" valign="middle"><input  type="image" src="new-images/hdfc-gold/sbtn.gif" style="border: 0px;" /></td>
    </tr>
</table>
 </td>
              </tr>
			  <tr>
			    <td height="15"  align="center" valign="top" bgcolor="#FFFFFF"><img src="new-images/hdfc-gold/frm-btm.gif" width="450" height="15" /></td>
		      </tr>
</table>
</form>
<?php
}
else
{
?>
<table width="98%"  border="0" align="right" cellpadding="0" cellspacing="0">
<tr><td class="bldtxt">Dear Customer,<br />
As per Hdfc Gold credit cards eligibility norms, you are not eligible for the credit card.
 
</td></tr></table>
<?php
}
?>
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>
