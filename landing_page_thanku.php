<?php

	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }



	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		
		$Name = FixString($Name);
		//$LName = FixString($LName);
		
		//$Name=$FName." ".$LName;
		
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		
		$DOB=$Year."-".$Month."-".$Day;

		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Reference_Code = generateNumber(4);
		$CC_Holder = FixString($CC_Holder);
		$City_Other = FixString($City_Other);
		$Type_Loan = FixString($Type_Loan);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($IncomeAmount);
		$Residence_Address = FixString($Residence_Address);
		$Marital_Status = FixString($Marital_Status);
		$Pancard = FixString($Pancard);
		$From_Product = $_REQUEST['From_Product'];
		//echo "hello".$From_Product."<br>";
		$Net_Salary_Monthly = $Net_Salary / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;
		$LName = "";
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  // echo "bye".$From_Pro."<br>";
			
		$IP = getenv("REMOTE_ADDR");

		$Creative=$_REQUEST['creative'];
		$Section=$_REQUEST['section'];
		$_SESSION['Temp_Type'] = "PersonalLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_Pancard'] = $Pancard;
		//$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_From_Pro'] = $From_Pro;
		$_SESSION['Temp_Residence_Address'] = $Residence_Address;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Std_Code_O'] = $Std_Code_O;
		$_SESSION['Temp_Std_Code'] = $Std_Code;
		$_SESSION['Temp_Landline_O'] = $Landline_O;
		$_SESSION['Temp_Type_Loan'] = $Type_Loan;
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
		$_SESSION['Temp_Pincode'] = $Pincode;
		$_SESSION['Temp_Contact_Time'] = $Contact_Time;
		//$_SESSION['Temp_Years_In_Company'] = $Years_In_Company;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		//$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		//$_SESSION['Temp_CC_Holder'] = $CC_Holder ;
		
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	
		

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
			

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address)
			VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address' )"; 
			
		}
		
		else
			{
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB,  CC_Holder,  Reference_Code, Residence_Address)
			VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address' )"; 
		}

		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
		$result = ExecQuery($query);
		$rows = mysql_num_rows($result);		
		echo mysql_error();

		if(isset($_SESSION['UserType']))
			{
				$result = ExecQuery($sql);
				$rows = mysql_num_rows($result);
				//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
		{
			$SMSMessage ="Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
			//SendSMS($SMSMessage, $Phone);
		}
		

			$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
			echo $Msg;
			//echo "<script language=javascript>location.href='t_y.php?r_url=myRequests.php'"."</script>";
			echo mysql_error();
				}
		else if ($myrow = mysql_fetch_array($result)) 
		{
			do
			{
				$_SESSION['Temp_UserID'] = $myrow["UserID"];
			}while ($myrow = mysql_fetch_array($result));
			mysql_free_result($result);
			$_SESSION['Temp_Flag'] = "1";

			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			$res_user=ExecQuery($qry_user);
			$row_user=mysql_fetch_array($res_user);
			$UserID1=$row_user["UserID"];
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address')"; 
	
		
			$result = ExecQuery($sql);
			//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
			{
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
			//SendSMS($SMSMessage, $Phone);;
			}
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home"))
			echo "<script language=javascript>location.href='landing_page_thanku.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
			//}
			//echo "<script language=javascript>location.href='thanku.php'</script>";
		}
		
		else
			{
			$result = ExecQuery($sql);
			//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			
			
			$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
						echo "<script language=javascript>location.href='landing_page_thanku.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
						}
					//echo "<script language=javascript>location.href='thanku.php'</script>";
					echo mysql_error();
				}
			}
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
    }

	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}


	$EmailID = $_SESSION['Temp_Email'];

	//$Email_New = $_SESSION['Temp_Email_New'];

	$Name_New = $_SESSION['Temp_Name_New'];

	$Net_Salary_Monthly = $_SESSION['Temp_Net_Salary_Monthly'];

	$Item_ID = $_SESSION['Temp_Item_ID'];

	$Type_Loan1 = $_SESSION['Temp_Type_Loan'];

	//$Message1 = $_SESSION['Temp_Message1'];

	$Flag_Message = $_SESSION['Temp_Flag_Message'];

	$Msg = "";

	$UserID_Message = "";
	
	 $From_Pt = $_SESSION['Temp_From_Pro'] ;
	$FName = $_SESSION['Temp_FName'];
	
	$LName = $_SESSION['Temp_LName'];
	
	$DOB = $_SESSION['Temp_DOB'];
	
	//$PWD1 = $_SESSION['Temp_PWD1'];
	
	$Phone = $_SESSION['Temp_Phone'];

	$IsPublic = $_SESSION['Temp_IsPublic'];

	//Query to check if user exists

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
		$sql = "INSERT INTO wUsers (Email,FName,LName,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$EmailID','$Name','$LName','$Phone','$DOB',Now(),Now(),0,'$IsPublic')";
		$result = mysql_query($sql);
			
		if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
		{
		$SMSMessage = "Dear $Name,Thanks for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.Activation code: $Reference_Code";
		//if(strlen(trim($Phone)) > 0)
		//SendSMS($SMSMessage, $Phone);
		}
		else
			{
		$SMSMessage = "Dear $Name,Thank you for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.";
			//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			}
		if($Type_Loan=="Req_Loan_Personal")
			{
				$Message2="<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $Name,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for registering on www.deal4loans.com.<br>Your registration details are as follows:<p>Your Email ID: $EmailID<br><p>We are committed towards providing you with a platform to - compare and choose the best deal from our participating banks.</p><p>Do read the attached note on Personal Loans- it might help you in your loan seeking process.<br><br>Need Cash? is the how banks typically sell Personal Loans - a product that you should opt during times of any cash crunch.A personal loan is an unsecured loan so it means that the bank assumes that they are taking a high risk in giving out such loans.</p><p>The applicable rates can vary from 14% to 40% depending on the individual profile.All banks have their own criteria of assesing an applicant's profile but the basic parameters are:</p><ul><li>      Your Salary/Income-Tax-Returns.</li><li>       Company/Business profile.</li><li>    Total work experience/current work experience.</li><li>       Your residential Address/status.</li><li>       Your credit/default profile.</li></ul><p>Generally the rate applicable to an applicant decreases with increasing salary. The bank sees a higher capability at your end to repay a loan, hence a lower perceived risk.</p><p>If you work in large company banks are ok with lower rates. Call centres/BPOs are not treated at par with other profiles as they tend to have high attrition rates. Banks generally want an applicant who has a stable job and hence check the current and total work experience. So if you have been working in one company for last 5 years a bank is more willing to lend a loan to you.</p><p>Residential status : If you own a house thats a perfect situation for bank to lend. But even if you have taken an accommodation on rent so long as the lease documents are in place, there should be no problems.</p><p>Past Credit Profile: Banks verify whether you have defaulted any of your previous loan repayments. This is done against both internal systems and third party systems like Cibil/Satyam .So now its really  tough to have bad debts with one bank and take loan from other banks.</p><p>Generally banks check these things before giving loans. In simple terms they check your ability to pay and gauge your intention to pay. So when you negiotiate with bank remember what are your advantages and disadvantages and bargain with them on those terms. </p><p>As a customer you should avoid doing the following while applying for a loan:</p><ul><li>   Incorrect address on application form.</li><li>   Not disclosing earlier loans. </li><li>   Cheque bounces in your bank accounts as this affects your credit record</li></ul><p>Hope this has helped you understand the Personal Loan product better. <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php'>Know More</a>...</p><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		}

		elseif($Type_Loan=="Req_Loan_Home")
			{
			 $Message2= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center>	<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse'bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr>	<td align='center'>&nbsp;</td></tr>	</table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear Deal4loans Customer,</b></font></td><td	align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for applying a home loan on <a href='http://www.deal4loans.com/' style='text-decoration:none;'>www.deal4loans.com.</a>We are committed to provide you with a platform to compare & choose the best deal from the various offers that our participating banks will extend to you.</p><p>Do read the attached note on home loans. It might help you in your loan seeking process.</p><p>Home Loan is a secured loan involving a long-term pledge with the bank so before signing the papers do consider the followings:<ul><b><li>	Fixed or Floating Interest Rate - </b><a href='http://www.deal4loans.com/Contents_home_loan_fixed_floating_rate_of_interest.php' >Know more</a> & choose accordingly. </li><b><li>	Product Features ?</b> <a href='http://www.deal4loans.com/Contents_types_of_home_loan.php' >Read more.</a> </li><b><li>	Pre-payment Charges -</b> Check the maximum amount that can be paid in a single year. And the charges for paying more than this.</li><b><li>	Processing Fees -</b> Some banks charge processing fees when they pick-up the documents & others after sanctioning the loan. Do check is processing fee is reimbursed or not if your file is not approved due to any reasons.</li><b><li>	Documents required -</b><a href='http://www.deal4loans.com/Contents_Home_Loan_Eligibility.php'> Check the list and keep them ready. </a></li><b><li>	Identify Property -</b> Do ensure that your property has an approved and sanctioned plan.</li> </ul><p>The typical process for a Home Loan is:<br><br><img src='http://www.deal4loans.com/images/homel.gif'  ></p><p>The basic parameters on which your loan application will be decided are:<ul><li>	Your Salary/ITR</li><li>	Your Profile</li><li>	Total work experience</li><li>	Your credit/default profile</li><li>	Academic & Professional Background</li><li>	Family Credit History.</li></ul></p><p><a href='http://www.deal4loans.com/Contents_Home_Loan_Article1.php'>Read More</a> about How your Loan application will be evaluated.</p><p>As a customer you should avoid doing the following while applying for a loan:<ul><li>	Incorrect address on application forms.</li><li>	Not disclosing earlier loans.</li><li>	Cheque bounces in your bank accounts as this affects your credit record.</li></ul></p><p>Hope this has helped you understand the Home Loan product better. For any further query do read other articles on our website on home loans <a href=' http://www.deal4loans.com/Contents_Home_Loan_Mustread.php' style='text-decoration:none;'> Click Here.</a></p><p>Regards<br>Team Deal4loans</p><p>More on deal4loans -<br><a href='http://www.deal4loans.com/Contents_Blogs.php'>Blogs- </a>Share your experience, queries with others.<br><a href='http://www.deal4loans.com/Contents_Feedback.php'>Testimonials-</a> Express your appreciation!!<br><a href='http://www.deal4loans.com/Loan_Query.php'>LoanQueries-</a> Ask your queries.</p></td>	</tr>	</table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td>	</tr>	</table></td></tr>	</table>";
			}
			
			
		else {

				$Message2= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $Name,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>Thank you for Registering with deal4loans. Your one stop solution for all your loan and insurance deals. Your registration details are as follows:<p>Your Email ID: $EmailID<br><p>You will receive various deals from banks and insurance companies both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";

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

				mail($EmailID,'Welcome to Deal4loans '.$fname, $Message2, $headers);

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
							
							$sub_sql = ExecQuery("Update Req_Life_Insurance SET UserID=".$UserID." Where Email='".$EmailID."'");

						mysql_free_result($sub_sql);

					}

				}

				

				/* Dump Resultset */

				mysql_free_result($result);
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Thank You</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

			<style>
.style1{
font-size:12px;
line-height:150%;
color:68718A;
font-weight:bold;
font-Family:Verdana;
}
.style4{
font-size:10px;
font-weight:bold;
color:666699;
font-Family:Verdana;
}
.style3{
font-size:12px;
color:68718A;
font-weight:bold;
line-height:150%;
font-Family:Verdana;
}
.style2{
font-size:12.5px;
color:white;

font-weight:bolder;
font-Family:Verdana;
}
input, select {font:12px Arial; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Arial; padding:0px; margin:0px; border: 0px}
</style> 
	<script language="javascript">
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
	function valvalidate() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.validate.length; i++) 
		{
			if(document.loan_form.validate[i].checked)
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

	function valButton3() {
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
	
	function submitform2(Form)
	{

	var btn2;
	var btn3;
	var myOption;
	var i;
	//btn2=valButton2();
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
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
		if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn3=valButton3();
					if(!btn3)
					{
						alert('Do you have any other loan.');
						return false;
					}
	
				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
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
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td align="left" class="style4" width="210" height="20"><font class="style4">Reconfirm Mobile No.</font></td>	<td colspan="3" align="left" width="196" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="RePhone" ></td></tr></table>';
			}
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}

function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" width="100%"><tr><td align="left"  width="200" class="style4"  height="20"><font class="style4">Property Location 	</td><td  width="196" align="center"  height="20"><select size="1" align="center"   name="Property_Loc" class="style4">	  <?=getCityList1($City)?>	 </select>			</td>			</tr>	</table>';
			}
			
		}
			
		return true;
	}
function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="style4" width="250" height="20" ><font class="style4">Any type of loan(s) running? </font></td> <td colspan="3" class="bodyarial11" width="250" ><table border="0">	 <tr><td class="style4" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style4"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style4"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  class="style4" width="250" height="20" ><font class="style4">How many EMI paid? </font>  </td>   <td colspan="3" align="left" width="250" height="18"><select name="EMI_Paid"  style="float: left" class="style4"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			}
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0"><tr><td align="left"  class="style4"  height="20">&nbsp;<input type="checkbox" name="update" class="noBrdr" ></td><td  align="left"  height="20"><font class="style4">Can we tell you about some properties	</td></tr>	</table>';
			}
		}
		
		return true;

	}
function addElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left"  class="style4" width="200" height="20" ><font class="style4">I have an active credit card from ? </font></td> <td colspan="3" class="bodyarial11" width="300"><table border="0"> <tr><td class="style4" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>		';
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
	</script>

	
	<!--div align="center"!-->
	<table width="850" style="border: 1px solid #68718A;">
	<?if ($source=="naukri"){?>
	<tr>
	<td colspan="5" width="840"><img src="images/landing_naukri.gif" ></td>
	</tr>
	<?}
else {?>
<tr>
	<td colspan="5" width="840"><img src="images/matrimonial.gif" height="25" width="190"></td>
	</tr>
<?}?>
	<tr>

		<td colspan="5" align="center" width="847"><img src="images/naukri_pl.gif">
		</td>

	</tr>
	<tr>
		<td width="4">&nbsp;</td>
		<td width="470" valign="top" align="right" >
			<table border="0" width="460">
				<tr>
					<td colspan="2" valign="top" width="463" ><img src="images/3steps.gif" align="left" >
					</td>
				</tr>
				
				<tr>
					<td width="28"><table  height="55" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="4"></td>
				</tr>
				<tr>
					<td height="13"><img src="images/arrow2.gif"></td>
				</tr>
				<tr>
					<td height="13" ><img src="images/arrow2.gif"></td>
				</tr>
				<tr>
					<td height="13"  ><img src="images/arrow2.gif"></td>
				</tr>
				</table>
					<td align="left" height="58" width="431" ><font class="style1"> Post your personal loan requirement.<br />
					Get &amp; compare offers from all Banks.<br />
					Go with the lowest bidder.</font> </td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all loan requirements</font></td>
				</tr>
				<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" > ABN AMRO, Deutsche, Citibank, Centurian, HSBC & Standard chartered </font><font class="style1">and choose the best deal!</font></td>
						</tr>
				<tr>
					<td colspan="2" width="463"></td>
				</tr>
				<tr>
						<!--<td colspan="2" style="padding-left:22px; " bgcolor="0A71D9"><font color="white" style="font-weight:bold;">-->
					<td colspan="2" width="463"><table width="100%" border="0" >
				<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Testimonials</font></td>
				</tr>
				<tr>
					<td width="10">&nbsp;</td>
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</font><br>
		
			<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >- Divya&nbsp; </font>
				</td>
					</tr>		
					
	<tr>

					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips to get the best deals on personal loans.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
					<td valign="top" width="431" ><font class="style3"> Personal loans are provided on the basis of your income, mainly estimation given by banks is on the basis of your income & most of loans are happening on the basis of the track record of the customer with any bank. Credit card usage/payments also impact your personal loan eligibility & rates as it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Personal loan are .<ul><li>

     Eligibility </li>
     Interest rates best suited. </li>

<li>    Processing Fees. </li>

<li>    Pre-payment/Foreclosure charges.</li> 

<li>   Document required. </li>

<li>     Turn Around Time.</li></ol></td></tr>
<tr><td colspan="2">

 

					
					<a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a></td></tr>

	 
 				</font>
				</td>
			</tr>
				
		  
	
		</table></td>
				
		<td bgcolor="DAEAF9" width="314" valign="top" align="center" >
			<table border="0" height="100%" cellspacing="0" cellpadding="0" width="300">
				<tr>
					<td width="280"></td> <td width="90"></td></tr>
					<tr>
					<td align="center" colspan="2"><font style="font-family:Verdana;"><h5>Step 2 of 2</h5></font></td>
				</tr>
				<tr>
					<td rowspan="2" align="center" valign="bottom"colspan="2" width="370"><font style="font-family:Verdana; font-weight:bold;font-size:12px">Please tell more about yourself </font>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td width="300">
						<table border="0" width="300" align="center" cellpadding="0" cellspacing="4" >

				<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitform2(document.loan_form);">
				<tr>
				    <td align="left"  class="style4" width="230" height="20" ><font class="style4">Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="270" height="18">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="style4" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="4" align="left"  class="style4"  height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onclick="addElement();" value="hello" id="validate" >
				   <font class="style4">if you havent received activation code sms</font>
				  </td>
				</tr>
				<tr><td colspan="4" id="myDiv" ></td></tr>
				<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Primary Account in which bank? 					</td>
					<td  align="left" colspan="3" width="270" height="20"><input type="text" size="18"  name="Primary_Acc"  class="style4" style="float: left" >
					</td>
				</tr>	
				
			
				 <tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">No. of years in this Company</font></td>
					 <td align="left" colspan="3" width="270" height="20">
					<input type="text" name="Years_In_Company" class="style4" size="18" maxlength="15" ></td>
				</tr>
				<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">Total Experience(Years)/
					 Total Years in Business</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Total_Experience" onfocus="this.select();" style="float: left">
					</td>
			   </tr>
				
				</tr>
					<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">Any Loan running?</font></td>
					<td align="left" width="50" height="20"><input type="radio"  class="NoBrdr"  value="1"  name="LoanAny" class="NoBrdr" onclick="addElementLoan();"><font class="style4">Yes</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" class="NoBrdr"  name="LoanAny" class="NoBrdr" onclick="removeElementLoan();" value="0" ><font class="style4">No</font></td><td >&nbsp;</td>
				</tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>

				
								
					</table>
					</td>
					</tr>
					
					<tr><td width="400" colspan="3" height="2">&nbsp;</td></tr>		
					 <tr><td>&nbsp;</td></tr>
				
					<tr>
						<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

					
				

				 <tr><td colspan="2">&nbsp;</td></tr>
			 <tr><td colspan="2">&nbsp;</td></tr>
			 <tr><td colspan="2">&nbsp;</td></tr>
					</table></td>
				
			</td>
			<td width="62">&nbsp;</td>
		</tr>
		<tr bgcolor="DAEAF9"><td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td></tr>

		</table>
	<!--/div!-->
	</form>


<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>
</body>
</html>

