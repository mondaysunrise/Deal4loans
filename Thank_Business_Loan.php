<?php

	require 'scripts/session_check.php';

	require 'scripts/db_init.php';

	require 'scripts/functions.php';

	
	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}

$Msg = "";
	$UserID_Message = "";

	if($_SESSION=="")
	{
	$EmailID = $_SERVER['Temp_Email'];
	$City = $_SERVER['Temp_City'];
	$Type_Loan = $_SERVER['Temp_Type'];
	$Name_New = $_SERVER['Temp_Name_New'];
	$Net_Salary_Monthly = $_SERVER['Temp_Net_Salary_Monthly'];
	$Item_ID = $_SERVER['Temp_Item_ID'];
	$Flag_Message = $_SERVER['Temp_Flag_Message'];
	$Reference_Code2= $_SERVER['Temp_Reference_Code'];
	$FName = $_SERVER['Temp_FName'];
	$LName = $_SERVER['Temp_LName'];
	$DOB = $_SERVER['Temp_DOB'];
	$Phone = $_SERVER['Temp_Phone'];
	$CC_Holder = $_SERVER['Temp_CC_Holder'];
	$IsPublic = $_SERVER['Temp_IsPublic'];
	}
	else
	{
	$EmailID = $_SESSION['Temp_Email'];
	$City = $_SESSION['Temp_City'];
	$Type_Loan = $_SESSION['Temp_Type'];
	$Name_New = $_SESSION['Temp_Name_New'];
	$Net_Salary_Monthly = $_SESSION['Temp_Net_Salary_Monthly'];
	$Item_ID = $_SESSION['Temp_Item_ID'];
	$Flag_Message = $_SESSION['Temp_Flag_Message'];
	$Reference_Code2= $_SESSION['Temp_Reference_Code'];
	$FName = $_SESSION['Temp_FName'];
	$LName = $_SESSION['Temp_LName'];
	$DOB = $_SESSION['Temp_DOB'];
	$Phone = $_SESSION['Temp_Phone'];
	$CC_Holder = $_SESSION['Temp_CC_Holder'];
	$IsPublic = $_SESSION['Temp_IsPublic'];

	}//Query to check if user exists

	$result = ExecQuery("select IsPublic from wUsers where Email='$EmailID' ");

	echo mysql_error();

	$num_rows = mysql_num_rows($result);



	if($num_rows > 0)
	{
		mysql_free_result($result);
		$Msg = "** User with this email id already exists. !! ";
	}
	else
	{
		$sql = "INSERT INTO wUsers (Email,FName,LName,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$EmailID','$FName','$LName','$Phone','$DOB',Now(),Now(),0,'$IsPublic')";
		$result = mysql_query($sql);
		$last_inserted = mysql_insert_id();
		
		
		
		if(($Type_Loan =="PersonalLoan") || ($Type_Loan =="CreditCard") || ($Type_Loan =="HomeLoan") || ($Type_Loan =="BusinessLoan"))
		{
		$SMSMessage = "Dear $FName,Thanks for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.Activation code: $Reference_Code2";
		if(strlen(trim($Phone)) > 0)
		SendSMS($SMSMessage, $Phone);
		}
		else
			{
		$SMSMessage = "Dear $FName,Thank you for Registering with deal4loans.Your registration details are as follows: EmailID: $EmailID.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
			}
	
	if($Type_Loan == "PersonalLoan") 
			
		{
			$Message2="<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $FName,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for applying for a personal loan on www.deal4loans.com.Thank you for registering on www.deal4loans.com.<br>Your registration details are as follows:<p>Your Email ID: $EmailID<br><p>We are committed towards providing you with a platform to - compare and choose the best deal from our participating banks.</p><p>Do read the attached note on Personal Loans- it might help you in your loan seeking process.<br><br>Need Cash? is the how banks typically sell Personal Loans - a product that you should opt during times of any cash crunch.A personal loan is an unsecured loan so it means that the bank assumes that they are taking a high risk in giving out such loans.</p><p>The applicable rates can vary from 14% to 40% depending on the individual profile.All banks have their own criteria of assesing an applicant's profile but the basic parameters are:</p><ul><li>   Your Salary/Income-Tax-Returns.</li><li>       Company/Business profile.</li><li>    Total work experience/current work experience.</li><li>       Your residential Address/status.</li><li>       Your credit/default profile.</li></ul><p>Generally the rate applicable to an applicant decreases with increasing salary. The bank sees a higher capability at your end to repay a loan, hence a lower perceived risk.</p><p>If you work in large company banks are ok with lower rates. Call centres/BPOs are not treated at par with other profiles as they tend to have high attrition rates. Banks generally want an applicant who has a stable job and hence check the current and total work experience. So if you have been working in one company for last 5 years a bank is more willing to lend a loan to you.</p><p>Residential status : if you own a house thats a perfect situation for bank to lend. But even if you have taken an accommodation on rent so long as the lease documents are in place, there should be no problems.</p><p>Past Credit Profile: Banks verify whether you have defaulted any of your previous loan repayments. This is done against both internal systems and plus third party systems like Cibil/Satyam .So now its really  tough to have bad debts with one bank and take loan from other banks.</p><p>Generally banks check these things before giving loans. In simple terms they check your ability to pay and gauge your intention to pay. So when you negiotiate with bank remember what are your advantages and disadvantages and bargain with them on those terms. </p><p>As a customer you should avoid doing the following while applying for a loan:</p><ul><li>   Incorrect address on application form.</li><li>   Not disclosing earlier loans. </li><li>   Cheque bounces in your bank accounts as this affects your credit record</li></ul><p>Hope this has helped you understand the Personal Loan product better. <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php'>Know More</a>...</p><p>More From <a href='http://www.deal4loans.com/'>Deal4loans.com</a>:-<ul><li><a href='http://www.deal4loans.com/Contents_Blogs.php'>Blogs:</a> Share your views on any loans related topics.</li><li><a href='http://www.deal4loans.com/Loan_Query.php'>Queries:</a> Ask anything and everything from our experts.</li><li><a href='http://www.deal4loans.com/Contents_Feedback.php'>Feedback:</a> Help us improve by giving your all important feedback.</li></ul><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		}
		elseif($Type_Loan =="CreditCard") 
			{
				$Message2="<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear Deal4loans Customer,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for applying a Credit Card on <a href='http://www.deal4loans.com' target='_blank'>www.deal4loans.com</a>.We are committed to provide you with a platform to compare & choose the best deal that fits your credit needs from the various offers that our participating banks will extend to you. </p><p>Your Name: $Name<br>Location: $City<br>Income/Salary: $Net_Salary<br>Email Id: $Email<br>Contact : $Phone</p><p>This is your second / third / fourth / fifth credit card.You are regularly paying only the minimum amount due on your current credit card.You could do with an increase in your credit limit on your current credit card.You already have a loan or an emi repayment plan running on your current credit card.If you answered YES to any or all the above statements, your real requirement may not be a credit card. Do visit the Personal loan Section on <a href='http://www.deal4loans.com/' target='_blank'>www.deal4loans.com</a> to evaluate your loan eligibility. Alternatively you could write to us at <A HREF='mailto:debtconsolidation@deal4loans.com'>debtconsolidation@deal4loans.com</a> to get a personalized debt consolidation plan. </p></p>Do read the attached note on Credit Cards.It might help you in “Knowing your Plastic”</p><p>Credit Cards also known as plastic money is one of the most convenient ways of making payments while shopping and helps in maintaining records of all purchases made by us. The major advantage of plastic money is that you don’t have to carry cash plus offers you safety with privileges like discount coupons, invitations to events, bonus points, cash-back and even a free insurance.</p><p>Major component of your credit card is its limit that varies from individual to individual. </p><p><font color='0F74D4'><b>How to read the monthly credit card statements</b></font><br>Below are the points mentioned that you should look carefully in your statements:-Statement Period, Summary of transactions, Payment due date, MAD, TAD, Statement generation date, Available cash limit, credit limit etc., <a href='http://www.deal4loans.com/Contents_Credit_Card_Article8.php' target='_blank' style='text-decoration:none;'>Click here </a>to know in detail.</p><p><font color='0F74D4'><b>Payment Mechanism</b></font><br>Ensure to pay your card outstanding on time to avoid penalties & charges. <a href='http://www.deal4loans.com/Contents_Credit_Card_Article10.php' target='_blank'>Know More</a></p><p><font color='0F74D4'><b>Protect your card</b></font><br>Credit card frauds are on a rise. Some useful tips to tackle card frauds like sign you card, don’t leave your receipt etc.,<a href='http://www.deal4loans.com/Contents_Credit_Card_Article3.php' style='text-decoration:none;' target='_blank'> Know More..</a></p><p><font color='0F74D4'><b>Reward Points & Cash Back Offers on your card</b></font><br>In today’s age card comes with bundle of offers. Check for the offers available on your cards & use your card accordingly.<a href='http://www.deal4loans.com/Latest_Offer.php' style='text-decoration:none;' target='_blank'> Know More..</a></p><p><font color='0F74D4'><b>Facilities on your card</b></font><br>There have been times you are not able to pay card dues on time & you avail card facilities like balance transfer, EMI conversion etc, Before entering into such deals compare the rate of interest & charges which bank will charge to those what is charged against personal loan. It’s always advisable to go for a personal loan for hefty amounts as if you are not able to make payment even once then you will be charged with additional credit card interest which may range from 36-40%. </p><p>Hope this has helped you understand the Credit card product better. For any further query do read other articles on our website on credit card at <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank'>Mustread </a></p><p><b>Regards</b><br>Team Deal4loans.com</p><p>More on deal4loans.com<br><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank'>Blogs</a>- Share your experience, queries with others .<br><a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'>Testimonials</a>- Express your appreciation!! <br><a href='http://www.deal4loans.com/Loan_Query.php' target='_blank'>LoanQueries</a>- Ask your queries<br><a href='http://www.deal4loans.com/Contents_chat.php' target='_blank'>Live Chat</a>- Get the best quote for your loan requirement online</p></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
			}

		elseif ($Type_Loan == "HomeLoan")
			{
			$Message2= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center>	<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse'bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr>	<td align='center'>&nbsp;</td></tr>	</table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear Deal4loans Customer,</b></font></td><td	align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for applying a home loan on <a href='http://www.deal4loans.com/' style='text-decoration:none;'>www.deal4loans.com.</a>We are committed to provide you with a platform to compare & choose the best deal from the various offers that our participating banks will extend to you.</p><p>Do read the attached note on home loans. It might help you in your loan seeking process.</p><p>Home Loan is a secured loan involving a long-term pledge with the bank so before signing the papers do consider the followings:<ul><b><li>	Fixed or Floating Interest Rate - </b><a href='http://www.deal4loans.com/Contents_home_loan_fixed_floating_rate_of_interest.php' >Know more</a> & choose accordingly. </li><b><li>	Product Features –</b> <a href='http://www.deal4loans.com/Contents_types_of_home_loan.php' >Read more.</a> </li><b><li>	Pre-payment Charges -</b> Check the maximum amount that can be paid in a single year. And the charges for paying more than this.</li><b><li>	Processing Fees -</b> Some banks charge processing fees when they pick-up the documents & others after sanctioning the loan. Do check is processing fee is reimbursed or not if your file is not approved due to any reasons.</li><b><li>	Documents required -</b><a href='http://www.deal4loans.com/Contents_Home_Loan_Eligibility.php'> Check the list and keep them ready. </a></li><b><li>	Identify Property -</b> Do ensure that your property has an approved and sanctioned plan.</li> </ul><p>The typical process for a Home Loan is:<br><br><img src='http://www.deal4loans.com/images/homel.gif'  ></p><p>The basic parameters on which your loan application will be decided are:<ul><li>	Your Salary/ITR</li><li>	Your Profile</li><li>	Total work experience</li><li>	Your credit/default profile</li><li>	Academic & Professional Background</li><li>	Family Credit History.</li></ul></p><p><a href='http://www.deal4loans.com/Contents_Home_Loan_Article1.php'>Read More</a> about How your Loan application will be evaluated.</p><p>As a customer you should avoid doing the following while applying for a loan:<ul><li>	Incorrect address on application forms.</li><li>	Not disclosing earlier loans.</li><li>	Cheque bounces in your bank accounts as this affects your credit record.</li></ul></p><p>Hope this has helped you understand the Home Loan product better. For any further query do read other articles on our website on home loans <a href=' http://www.deal4loans.com/Contents_Home_Loan_Mustread.php' style='text-decoration:none;'> Click Here.</a></p><p>Regards<br>Team Deal4loans</p><p>More on deal4loans -<br><a href='http://www.deal4loans.com/Contents_Blogs.php'>Blogs- </a>Share your experience, queries with others.<br><a href='http://www.deal4loans.com/Contents_Feedback.php'>Testimonials-</a> Express your appreciation!!<br><a href='http://www.deal4loans.com/Loan_Query.php'>LoanQueries-</a> Ask your queries.</p></td>	</tr>	</table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td>	</tr>	</table></td></tr>	</table>";
			}

		else {

				$Message2= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $FName,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>Thank you for Registering with deal4loans. Your one stop solution for all your loan. Your registration details are as follows:<p>Your Email ID: $EmailID<br><p>You will receive various deals from banks both at your EMAIL ID. <br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";

		}
/*
				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'To: '.$fname.' <'.$EmailID.'>' . "\r\n";

				$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				mail($EmailID,'Welcome to Deal4loans - '.$fname, $Message2, $headers);

	}
		if ($Flag_Message == 1)
		{
			$sqltest = ExecQuery("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest)) 
			{
				$Item_ID = $myrow["RequestID"];
			}
			mysql_free_result($sqltest);
			$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest1))
			{
				$UserID_Message=$myrow["UserID"];
			}
			mysql_free_result($sqltest1);

				

		}
			if ($Flag_Message == 2)

			{

				$sqltest = ExecQuery("Select RequestID from Req_Credit_Card order by RequestID desc limit 1");

				echo mysql_error();

				if ($myrow = mysql_fetch_array($sqltest))

				{

					$Item_ID=$myrow["RequestID"];

				}

				mysql_free_result($sqltest);

				$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");

				echo mysql_error();

				if ($myrow = mysql_fetch_array($sqltest1))

				{

					$UserID_Message=$myrow["UserID"];

				}

				mysql_free_result($sqltest1);

				

			}

			if ($result == 1) 

			{	

				if(strlen(trim($EmailID)) > 0 )
				{
					$sql = ExecQuery("Select *  from wUsers where Email='".$EmailID."'");

					echo mysql_error();

					if ($myrow = mysql_fetch_array($sql)) 

					{

						$UserID=$myrow["UserID"];

						

						/* Get Resultset */

						mysql_fetch_array($sql);



							$sub_sql = ExecQuery("Update Req_Loan_Personal SET UserID=".$UserID.", Count_Replies='1', IsModified='1' Where Email='".$EmailID."'");



							$sub_sql = ExecQuery("Update Req_Loan_Home SET UserID=".$UserID." Where Email='".$EmailID."'");

							$sub_sql = ExecQuery("Update Req_Loan_Against_Property SET UserID=".$UserID." Where Email='".$EmailID."'");


							$sub_sql = ExecQuery("Update Req_Credit_Card SET UserID=".$UserID." Where Email='".$EmailID."'");


							$sub_sql = ExecQuery("Update Req_Loan_Car SET UserID=".$UserID." Where Email='".$EmailID."'");
							
							$sub_sql = ExecQuery("Update Req_Business_Loan SET UserID=".$UserID." Where Email='".$EmailID."'");

						mysql_free_result($sub_sql);

					}

				}

				

				/* Dump Resultset */

				mysql_free_result($result);

				if(($Type_Loan!="CreditCard") && ($Type_Loan!="PersonalLoan") && ($Type_Loan!="HomeLoan") && ($Type_Loan!="BusinessLoan"))
					{

						session_unset();
					 }
				$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}



		

			//else

			//	$Msg = "** There was a problem with your registration process. Please try again. !! ";
		

?>

<html>



<head>

<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Registration</title>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function addElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Ho1der.value);
				ni.innerHTML = '<table border="0"><tr> <td class="bodyarial11" >I have an active credit card from ? </td> <td  class="bodyarial11" ><table border="0"> <tr><td class="bodyarial11" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="bodyarial11"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="bodyarial11"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="bodyarial11"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="bodyarial11"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="bodyarial11" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></td></tr><tr> <td align="left" class="bodyarial11">Cards held since?</td><td  align="left"  colspan="3" ><select size="1" name="Card_Vintage"><option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option><option value="3">9 to 12 months</option> <option value="4">more than 12 months</option></select> </td></tr><tr><td class="bodyarial11">Credit Card Limit?</td><td  align="left"  colspan="3" width="240" height="25"><select size="1"  name="Credit_Limit"><option value="0">Please select</option><option value="1">25000 to 50000</option> <option value="2">50001 to 75000</option><option value="3">75001 to 1 lakh </option> <option value="4">1 lakh & above</option></select> </td></tr>	</table>';
			}
		}
		
		return true;
	}

function removeElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
		}
		
		return true;
	}
 function addElement()
{
	
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td align="left" class="bodyarial11" width="200" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="300" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="RePhone" ></td></tr></table>';
			
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}


function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.Loan_Any.length; i++) 
	{
        if(document.loan_form.Loan_Any[i].checked)
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

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="bodyarial11" width="200" height="20" >Any type of loan(s) running? </td> <td colspan="3" class="bodyarial11" width="300" ><table border="0">	 <tr><td class="bodyarial11" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="bodyarial11"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="bodyarial11" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="bodyarial11" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  width="200" height="20" class="bodyarial11">How many EMI paid?  </td>   <td colspan="3" align="left" width="300" height="18" ><select name="EMI_Paid"  style="float: left"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}
function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table border="0"><tr>	 <td align="left"  class="bodyarial11" width="200" height="20">Cards held since?</td>		<td  align="left"  colspan="3" width="300" height="20"><select size="1" class="style4" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>	 <option value="2">6 to 9 months</option>	 <option value="3">9 to 12 months</option>	 <option value="4">more than 12 months</option>	 </select> </td></tr>	<tr> <td align="left"  valign="top" class="bodyarial11" width="200" height="20" >I have an active credit card from ? </td> <td colspan="3" class="bodyarial11" width="300"><table border="0"> <tr><td class="bodyarial11" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="bodyarial11" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="bodyarial11"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="bodyarial11"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="bodyarial11"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="bodyarial11" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>';
				

			
		}
		
		return true;

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

function form_business(Form)
{

var btn;
var btn2;
var myOption;
var myLoanOption;

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
			
		}
		}
		myOption = -1;
		for (i=Form.CCbusiness.length-1; i > -1; i--) {
			if(Form.CCbusiness[i].checked) {
				if(i==0)
				{
					if(Form.Card_Vintage.selectedIndex==0)
					{
						alert('Card Held since.');
						Form.Card_Vintage.focus();
						return false;
					}

					btn2=valButton2();
					if(!btn2)
					{
						alert('From which bank.');
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
myLoanOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if(Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
					myLoanOption = i;

				
			}
		}
	
		if (myLoanOption == -1) 
		{
			alert("Please select Any loan running or not");
			return false;
		}
		
}


function valButton(btn) {
    var cnt = -1;
	var i;
    for(i=0; i<btn.length; i++) 
	{
        if(btn[i].checked)
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

function submitform3(Form)
	{

		var btn;
		btn=valButton(Form.Property_Identified);
		if(!btn)
			{
				alert('please select you have identified any property or not');
				return false;
			}
		if (Form.Budget.selectedIndex==0)
			{
				alert("Please estimated market value of the property");
				Form.Budget.focus();
				return false;
			}
		if (Form.Loan_Time.selectedIndex==0)
			{
				alert("Please enter when you are planning to take loan");
				Form.Loan_Time.focus();
				return false;
			}
		return true;
	}	

function valButton5() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.From_Product1.length; i++) 
		{
			if(document.loan_form.From_Product1[i].checked)
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
function submitform(Form)
	{
		var btn2;
		var btn3;
		var myOption;
		var i;
		var btn;
		var btn5;
		if(Form.Reference_Code1.value=="")
			{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.loan_form.confirm.focus();
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
			
		}
	}
	
	myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
					btn2=valButton2();
					if(!btn2)
					{
						alert('From which bank.');
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
	 if(btn2)
		{
		if (Form.Card_Vintage.selectedIndex==0)
		{
			alert("Please select since how long you holding credit cards");
			Form.Card_Vintage.focus();
			return false;
		}
		}
				btn5=valButton5();
	if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
				return false;
		}

		return true;
	}

function submitform2(Form)
	{

	var btn2;
	btn2=valButton2();
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}

	if(!btn2)
			{
				alert('Do you have any other credit card from which bank.');
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
</script>

<?if(($Type_Loan!="PersonalLoan") && ($Type_Loan!="CreditCard") && ($Type_Loan!="HomeLoan") && $Type_Loan!="BusinessLoan")
{

 include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if ($_REQUEST['flag']!=1)
	{ ?>
   <?php include '~Upper.php';?><?php } ?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<html>
<head>

<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp;</td>
            <td>
 
 <p><b><font color="#3366CC"> 
 Thank You!!! Your Request has been added Successfully.........</font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
			<?php if ($_REQUEST['flag']!=1)
	{ ?>
	  <?php // include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	
	  </div>  -->
    <?php // include '~Bottom.php';?><?php } ?>

	<?}
	else{
		?>
	<link href="includes/style1.css" rel="stylesheet" type="text/css">
  

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner" align="center"><img src="images/main_banner1.gif"  />
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Please Tell more about yourself<td></tr>
<tr><td>&nbsp;</td></tr>
<?if($Type_Loan=="PersonalLoan")
		{?>
		<tr>
		 <td><?if($_SESSION['flag']==1) {?>
 <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform2(document.loan_form);">
 <? }
  else {?><form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform2(document.loan_form);">
  <? }?>
 <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
  <tr><td><input type="hidden" value="<? echo $Type_Loan; ?>" name="type"></td></tr>
  <tr>
       <td class="bodyarial11">Activation Code</td>
       <td class="bodyarial11"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
 <tr>
     <td class="bodyarial11" width="30%">Primary Account in which bank?<font size="1" color="#FF0000">*</font> </td>
     <td class="bodyarial11" width="70%">
     <input type="text" name="Primary_Acc"  size="15" maxlength="30"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Any type of loan(s) running</td>
    <td  class="bodyarial11"><table border="0">
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td>
	 <td class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="cl">Car</td>
	 <td class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="lap">Property</td>
	 <td class="bodyarial11" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="other">Other</td>
	 </tr></table>
	 
 </td>
   </tr>
   <tr>
     <td class="bodyarial11">How many EMI paid?</td>
     <td class="bodyarial11">
     <input type="text" name="EMI_Paid" value="0" size="15" maxlength="30"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Do you have an active credit card from?<font size="1" color="#FF0000">*</font> </td>
     <td  class="bodyarial11"><table border="0">
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td>
	 <td class="bodyarial11"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td>
	 <td class="bodyarial11"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product[]" value="Standard Chartered"  id="From_Product" class="noBrdr" >Standard Chartered</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td>
	  <td colspan="2" class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Others">Others</table></td>
	 </tr>
    
   <tr>
     <td colspan="2" align="center" class="bodyarial11"><br>
       <input type="submit" class="bluebutton" value="Submit" >
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset" ></td>
   </tr>
   
  </table>
 </form>
 
 </td>
     </tr>
            </table>
		<?}
elseif($Type_Loan=="CreditCard")
	{?>
	<tr>
		 <td><?if($_SESSION['flag']==1) {?>
 <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform(document.loan_form);">
 <?  }
else {
	?>
	<form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">
	<? }?>
 <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
  <tr><td><input type="hidden" value="<? echo $Type_Loan; ?>" name="type"></td></tr>
  <tr>
       <td class="bodyarial11">Activation Code</td>
       <td class="bodyarial11"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
	 <tr>
	 <td colspan="2" class="bodyarial11" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
				   if you havent received activation code sms.
				  </td>
				</tr>
				<tr><td colspan="2" class="bodyarial11" id="myDiv" ></td></tr>
  
   <tr>
     <td class="bodyarial11">Are you a Credit Card Holder of Any Bank?<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="radio" value="1"  name="CC_Holder" class="NoBrdr" onClick="addElement1();">Yes
     <input type="radio" value="0"  name="CC_Holder" class="NoBrdr" onClick="removeElement1();">No</td>
   </tr>
   <tr><td colspan="4" id="myDiv9"></td></tr>
   
	 <tr>
     <td class="bodyarial11">Have you applied with these Banks in last six months?<font size="1" color="#FF0000">*</font> </td>
     <td  class="bodyarial11"><table border="0">
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >Citi Bank</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td>
	 <td class="bodyarial11"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td>
	 <td class="bodyarial11"> <input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td>
	 <td class="bodyarial11"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td>
	 </tr>
	 <tr>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product[]" class="noBrdr" value="SBi">SBI</td>
	 <td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Others">Others</td>
	<td class="bodyarial11"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="0">No</table></td>
	 </tr>
      <tr>
     <td colspan="2" align="center" class="bodyarial11"><br>
       <input type="submit" class="bluebutton" value="Submit" >
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset" ></td>
   </tr>
   
  </table>
 </form>
 
 </td>
     </tr>
            </table>
			<?}

	elseif($Type_Loan=="HomeLoan")
	{?>
	<tr>
		 <td>
		 <?if($_SESSION['flag']==1) {?>
 <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform3(document.loan_form);">
<? } else { ?>
<form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform3(document.loan_form);">
<? }?>
 <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
  <tr><td><input type="hidden" value="<? echo $Type_Loan; ?>" name="type"></td></tr>
  <tr>
       <td class="bodyarial11">Activation Code</td>
       <td class="bodyarial11"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
   <tr>
     <td width="30%" class="bodyarial11">Property Identified<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11">
     <p dir="ltr"><input type="radio" name="Property_Identified" class="NoBrdr"  value="1">Yes
     <input type="radio" name="Property_Identified" class="NoBrdr" value="0">No</td>
   </tr>
	 <tr>
       <td class="bodyarial11">Property Location </td>
       <td class="bodyarial11"><input type="text" name="Property_Loc" size="20" maxlength="30"></td>
     </tr>
	<tr>
		 <td class="bodyarial11">Estimated market value of the property?<font size="1" color="#FF0000">*</font></td>
		<td class="bodyarial11"><select name="Budget" class="style4" >
		<option value="-1" selected>Please Select</option>
		<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
		<option value="7-15 Lakhs">7-15 Lakhs </option>
		<option value="15-20 Lakhs">15-20 Lakhs </option>
		<option value="20-25 Lakhs">20-25 Lakhs </option>
		<option value="Above 25 Lakhs">Above 25 Lakhs</option></select>
	</td>
	</tr>
	<tr>
       <td class="bodyarial11">When you are planning to take loan?</td>
       <td class="bodyarial11"><select name="Loan_Time"  class="style4" >
           <OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 omth">1 months</OPTION>
			<OPTION value="2 month">2 months</OPTION>
			<OPTION value="3 month">3 months</OPTION>
			<OPTION value="3 months above">more than 3 months</OPTION></SELECT>
		</td>
     </tr>

    <tr>
		<td colspan="2" align="center" class="bodyarial11"><br>
       <input type="submit" class="bluebutton" value="Submit">
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset" ></td>
   </tr>
   
  </table>
 </form>
 
 </td>
     </tr>
            </table>

	<?}
	
		elseif($Type_Loan=="BusinessLoan")
		{?>
		
	
 		<tr>
		 <td>
		  <? if($_SESSION['flag']==1) {?><form name="loan_form" method="post" action="Thank_BL.php?flag=1" onSubmit="return form_business(document.loan_form);">
		 <? } 
		 else{ ?>
		 <form name="loan_form" method="post" action="t_y.php" onSubmit="return form_business(document.loan_form);">
		 <? } ?>
			  <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
				<tr><td><input type="hidden" value="BusinessLoan" name="type"></td></tr>
					<tr>
				    <td class="bodyarial11" width="40%">Activation Code? 
				   </td>
				   <td class="bodyarial11" width="60%">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="bodyarial11" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="2" align="left"  class="bodyarial11"  ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
						if you havent received activation code sms
				  </td>
				</tr>
				<tr><td colspan="2" id="myDiv" ></td></tr>
				 <tr>
			<td class="bodyarial11" >Are you a Credit card holder?</td> <td  class="bodyarial11" ><input type="radio"  name="CCbusiness"  class="NoBrdr"  value="1"  onclick="addElementCC();" >Yes
			
			<input type="radio" class="NoBrdr" name="CCbusiness" value="0" onClick="removeElementCC();">No</td></tr>
		 <tr><td colspan="2" id="myDivCC"></td></tr>
		
									<tr>
					<td  class="bodyarial11">Any Loan running?</td>
					<td  class="bodyarial11"  ><input type="radio"  class="NoBrdr"  value="1"  name="LoanAny" class="NoBrdr" onclick="addElementLoan();">Yes<input size="10" type="radio" class="NoBrdr"  name="LoanAny" class="NoBrdr" onclick="removeElementLoan();" value="0" >No</td><tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>
			 <tr>
				 <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit"> 
				   &nbsp;
				   <input type="reset" class="bluebutton" value="Reset"></td>
			   </tr>
							
								
					</table></form>
					</td>
					</tr>
					
					<tr><td width="400" colspan="3" height="2">&nbsp;</td></tr>		
					 <tr><td>&nbsp;</td></tr>
				
					
				
  </table>
 
 </td></tr></table>
 

		<? }?>
			
 </div>

 
	
<?}?>
<?
  include '~Right2.php';
 
  ?>
  
  </div>
  <?php if ($_SESSION['flag']!=1)
	{ 
 include '~Bottom.php';?>
<? }


if($Type_Loan=="CarLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Car_New.php?flag=1";
}
elseif($Type_Loan=="PropertyLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Against_Property_New.php?flag=1";
}
elseif($Type_Loan=="PersonalLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Personal_New.php?flag=1";
}
elseif($Type_Loan=="HomeLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Home_New.php?flag=1";
}
elseif($Type_Loan=="CreditCard")
{
$urldetails="http://www.deal4loans.com/Request_Credit_Card_New.php?flag=1";
}
elseif($Type_Loan=="BusinessLoan")
{
$urldetails="http://www.deal4loans.com/Req_Business_Loan_New.php?flag=1";
}
?>
<?php if(($_SESSION['flag']==1) && (($Type_Loan=="CarLoan")||($Type_Loan=="PropertyLoan")))
	{ ?>
<img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=<?php echo $Type_Loan; ?>&userid=<?php echo $EmailID;?>&url=<?php echo $urldetails;?>" width="0" height="0" />
<? }?>

<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1)
{  
	var google_conversion_value = 1;
	}
	var google_conversion_label = "LEAD";
	//-->
	</script>
	<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
	<noscript>
	<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/?value=1&label=LEAD&script=0">
	</noscript>
</body>
</html>
