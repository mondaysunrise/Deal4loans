<?php
require 'scripts/session_check.php';
require "scripts/functions.php";
require "scripts/db_init.php";




	function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	

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
		$last_id = FixString($last_id);
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
		$Card_Vintage = FixString($Card_Vintage);
		$City_Other = FixString($City_Other);
		$Type_Loan = FixString($Type_Loan);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($IncomeAmount);
		$Residence_Address = FixString($Residence_Address);
		$Marital_Status = FixString($Marital_Status);
		$Pancard = FixString($Pancard);
		$From_Product = FixString($From_Product);
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
		 $Dated = ExactServerdate();
		
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	
		
		
		
		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other." ".$Descr." ".$Residence_Address;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			if(($Type_Loan=="Req_Loan_Car") || ($Type_Loan=="Req_Loan_Against_Property") || ($Type_Loan=="Req_Loan_Home") || ($Type_Loan=="Req_Credit_Card") )
				{
				$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder,  Reference_Code, Residence_Address,  Updated_Date) VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder',  '$Reference_Code', '$Residence_Address', Now())";
		}
		else {
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB,  CC_Holder, CC_Bank,  Reference_Code, Residence_Address,  Updated_Date) VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$From_Pro',  '$Reference_Code', '$Residence_Address', Now() )"; 
			}
//echo $sql;
	//exit();
		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
	//	echo "<br>".$query;
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
		
		 list($rows,$myrow)=MainselectfuncNew($query,$array = array());
		$cntr=0;
		
		$result = ExecQuery($query);
		//$result = mysql_query($query);
		$rows = mysql_num_rows($result);		
	//	echo mysql_error();

	if ($cntr<count($myrow)) 
		{
			do
			{
				$_SESSION['Temp_UserID'] = $myrow[$cntr]["UserID"];
			 $cntr=$cntr+1;
			} while($cntr<count($myrow));
			mysql_free_result($result);

			$_SESSION['Temp_Flag'] = "1";

			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			//$res_user=ExecQuery($qry_user);
			
			 list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
			$j = 0;
			//$res_user= mysql_query($qry_user);
			//$row_user=mysql_fetch_array($res_user);
			$UserID1=$row_user[$j]["UserID"];
		
		if(($Type_Loan=="Req_Loan_Car") || ($Type_Loan=="Req_Loan_Against_Property") || ($Type_Loan=="Req_Loan_Home") || ($Type_Loan=="Req_Credit_Card"))
		{
				//$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder,  Reference_Code, Residence_Address,  Updated_Date) VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder',  '$Reference_Code', '$Residence_Address', Now())";
		
		$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Marital_Status"=>$Marital_Status, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Pincode"=>$Pincode, "Contact_Time"=>$Contact_Time, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, " Reference_Code"=>$Reference_Code, "Residence_Address"=>$Residence_Address, " Updated_Date"=>$Dated);
$table = $Type_Loan;
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		}
		else {
			//$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, CC_Bank,  Reference_Code, Residence_Address,  Updated_Date) VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$From_Pro', '$Reference_Code', '$Residence_Address', Now())"; 
			
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Marital_Status"=>$Marital_Status, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Pincode"=>$Pincode, "Contact_Time"=>$Contact_Time, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, "CC_Bank"=>$From_Pro, " Reference_Code"=>$Reference_Code, "Residence_Address"=>$Residence_Address, " Updated_Date"=>$Dated);
$table = $Type_Loan;
$insert = Maininsertfunc ($table, $dataInsert);
			
		
			}
//	echo "<br>Email Exists: ";
	//	echo $sql;
	//	echo "<br>";
			//$result = ExecQuery($sql);
			//$result = mysql_query($sql);
//exit();
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
			{
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
			}
			if(($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Home"))
			echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
			
			/*echo "<script language=javascript>location.href='thanku.php'</script>";*/
		}
		
		else
		{
			//echo "<br>Email Does not Exist: ";
			// echo $sql;
			//echo "<br>";
			$result = ExecQuery($sql);
			//$result = mysql_query($sql);
			//exit();
			$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					if(($Type_Loan!="Req_Credit_Card") || ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
						echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
						}
					/*echo "<script language=javascript>location.href='thanku.php'</script>";*/
				//	echo mysql_error();
				}
			}
		//echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
		{
		$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
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

	//$result = ExecQuery("select IsPublic from wUsers where Email='$EmailID' ");
	$result = ("select IsPublic from wUsers where Email='$EmailID' ");

 list($num_rows,$getrow)=MainselectfuncNew($result,$array = array());
		

	//echo mysql_error();

	//$num_rows = mysql_num_rows($result);

	if($num_rows > 0)
	{
		mysql_free_result($result);
		$Msg = "** User with this email id already exists. !! ";
	}
	else
	{
		//$sql = "INSERT INTO wUsers (Email,FName,LName,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$EmailID','$Name','$LName','$Phone','$DOB',Now(),Now(),0,'$IsPublic')";
		//$result = mysql_query($sql);
		$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "DOB"=>$DOB, "Join_Date"=>$Dated, "Last_Login"=>$Dated, "Count_Requests"=>0, "IsPublic"=>$IsPublic);
		$table = 'wUsers';
		$insert = Maininsertfunc ($table, $dataInsert);
		
			
		if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Loan_Home"))
		{
		$SMSMessage = "Dear $Name,Thanks for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.Activation code: $Reference_Code";
		if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
		}
		else
		{
		$SMSMessage = "Dear $Name,Thank you for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
		}
	}
	
	if($Type_Loan=="Req_Loan_Personal") 
	{
				$Message2="<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $Name,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for registering on www.deal4loans.com.<br>Your registration details are as follows:<p>Your Email ID: $EmailID<br><p>We are committed towards providing you with a platform to - compare and choose the best deal from our participating banks.</p><p>Do read the attached note on Personal Loans- it might help you in your loan seeking process.<br><br>Need Cash? is the how banks typically sell Personal Loans - a product that you should opt during times of any cash crunch.A personal loan is an unsecured loan so it means that the bank assumes that they are taking a high risk in giving out such loans.</p><p>The applicable rates can vary from 14% to 40% depending on the individual profile.All banks have their own criteria of assesing an applicant's profile but the basic parameters are:</p><ul><li>      Your Salary/Income-Tax-Returns.</li><li>       Company/Business profile.</li><li>    Total work experience/current work experience.</li><li>       Your residential Address/status.</li><li>       Your credit/default profile.</li></ul><p>Generally the rate applicable to an applicant decreases with increasing salary. The bank sees a higher capability at your end to repay a loan, hence a lower perceived risk.</p><p>If you work in large company banks are ok with lower rates. Call centres/BPOs are not treated at par with other profiles as they tend to have high attrition rates. Banks generally want an applicant who has a stable job and hence check the current and total work experience. So if you have been working in one company for last 5 years a bank is more willing to lend a loan to you.</p><p>Residential status : If you own a house thats a perfect situation for bank to lend. But even if you have taken an accommodation on rent so long as the lease documents are in place, there should be no problems.</p><p>Past Credit Profile: Banks verify whether you have defaulted any of your previous loan repayments. This is done against both internal systems and third party systems like Cibil/Satyam .So now its really  tough to have bad debts with one bank and take loan from other banks.</p><p>Generally banks check these things before giving loans. In simple terms they check your ability to pay and gauge your intention to pay. So when you negiotiate with bank remember what are your advantages and disadvantages and bargain with them on those terms. </p><p>As a customer you should avoid doing the following while applying for a loan:</p><ul><li>   Incorrect address on application form.</li><li>   Not disclosing earlier loans. </li><li>   Cheque bounces in your bank accounts as this affects your credit record</li></ul><p>Hope this has helped you understand the Personal Loan product better. <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php'>Know More</a>...</p><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		}
		elseif($Type_Loan=="Req_Credit_Card") 
			{
				$Message2="<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear Deal4loans Customer,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for applying a Credit Card on <a href='http://www.deal4loans.com' target='_blank'>www.deal4loans.com</a>.We are committed to provide you with a platform to compare & choose the best deal that fits your credit needs from the various offers that our participating banks will extend to you. </p><p>Your Name: $Name<br>Location: $City<br>Income/Salary: $Net_Salary<br>Email Id: $Email<br>Contact : $Phone</p><p>This is your second / third / fourth / fifth credit card.You are regularly paying only the minimum amount due on your current credit card.You could do with an increase in your credit limit on your current credit card.You already have a loan or an emi repayment plan running on your current credit card.If you answered YES to any or all the above statements, your real requirement may not be a credit card. Do visit the Personal loan Section on <a href='http://www.deal4loans.com/' target='_blank'>www.deal4loans.com</a> to evaluate your loan eligibility. Alternatively you could write to us at <A HREF='mailto:debtconsolidation@deal4loans.com'>debtconsolidation@deal4loans.com</a> to get a personalized debt consolidation plan. </p></p>Do read the attached note on Credit Cards.It might help you in “Knowing your Plastic”</p><p>Credit Cards also known as plastic money is one of the most convenient ways of making payments while shopping and helps in maintaining records of all purchases made by us. The major advantage of plastic money is that you don’t have to carry cash plus offers you safety with privileges like discount coupons, invitations to events, bonus points, cash-back and even a free insurance.</p><p>Major component of your credit card is its limit that varies from individual to individual. </p><p><font color='0F74D4'><b>How to read the monthly credit card statements</b></font><br>Below are the points mentioned that you should look carefully in your statements:-Statement Period, Summary of transactions, Payment due date, MAD, TAD, Statement generation date, Available cash limit, credit limit etc., <a href='http://www.deal4loans.com/Contents_Credit_Card_Article8.php' target='_blank' style='text-decoration:none;'>Click here </a>to know in detail.</p><p><font color='0F74D4'><b>Payment Mechanism</b></font><br>Ensure to pay your card outstanding on time to avoid penalties & charges. <a href='http://www.deal4loans.com/Contents_Credit_Card_Article10.php' target='_blank'>Know More</a></p><p><font color='0F74D4'><b>Protect your card</b></font><br>Credit card frauds are on a rise. Some useful tips to tackle card frauds like sign you card, don’t leave your receipt etc.,<a href='http://www.deal4loans.com/Contents_Credit_Card_Article3.php' style='text-decoration:none;' target='_blank'> Know More..</a></p><p><font color='0F74D4'><b>Reward Points & Cash Back Offers on your card</b></font><br>In today’s age card comes with bundle of offers. Check for the offers available on your cards & use your card accordingly.<a href='http://www.deal4loans.com/Latest_Offer.php' style='text-decoration:none;' target='_blank'> Know More..</a></p><p><font color='0F74D4'><b>Facilities on your card</b></font><br>There have been times you are not able to pay card dues on time & you avail card facilities like balance transfer, EMI conversion etc, Before entering into such deals compare the rate of interest & charges which bank will charge to those what is charged against personal loan. It’s always advisable to go for a personal loan for hefty amounts as if you are not able to make payment even once then you will be charged with additional credit card interest which may range from 36-40%. </p><p>Hope this has helped you understand the Credit card product better. For any further query do read other articles on our website on credit card at <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank'>Mustread </a></p><p><b>Regards</b><br>Team Deal4loans.com</p><p>More on deal4loans.com<br><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank'>Blogs</a>- Share your experience, queries with others .<br><a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'>Testimonials</a>- Express your appreciation!! <br><a href='http://www.deal4loans.com/Loan_Query.php' target='_blank'>LoanQueries</a>- Ask your queries<br><a href='http://www.deal4loans.com/Contents_chat.php' target='_blank'>Live Chat</a>- Get the best quote for your loan requirement online</p></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
			}
		elseif($Type_Loan=="Req_Loan_Home") 
		{
			 $Message2= "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center>	<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse'bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr>	<td align='center'>&nbsp;</td></tr>	</table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear Deal4loans Customer,</b></font></td><td	align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>We thank you for applying a home loan on <a href='http://www.deal4loans.com/' style='text-decoration:none;'>www.deal4loans.com.</a>We are committed to provide you with a platform to compare & choose the best deal from the various offers that our participating banks will extend to you.</p><p>Do read the attached note on home loans. It might help you in your loan seeking process.</p><p>Home Loan is a secured loan involving a long-term pledge with the bank so before signing the papers do consider the followings:<ul><b><li>	Fixed or Floating Interest Rate - </b><a href='http://www.deal4loans.com/Contents_home_loan_fixed_floating_rate_of_interest.php' >Know more</a> & choose accordingly. </li><b><li>	Product Features ?</b> <a href='http://www.deal4loans.com/Contents_types_of_home_loan.php' >Read more.</a> </li><b><li>	Pre-payment Charges -</b> Check the maximum amount that can be paid in a single year. And the charges for paying more than this.</li><b><li>	Processing Fees -</b> Some banks charge processing fees when they pick-up the documents & others after sanctioning the loan. Do check is processing fee is reimbursed or not if your file is not approved due to any reasons.</li><b><li>	Documents required -</b><a href='http://www.deal4loans.com/Contents_Home_Loan_Eligibility.php'> Check the list and keep them ready. </a></li><b><li>	Identify Property -</b> Do ensure that your property has an approved and sanctioned plan.</li> </ul><p>The typical process for a Home Loan is:<br><br><img src='http://www.deal4loans.com/images/homel.gif'  ></p><p>The basic parameters on which your loan application will be decided are:<ul><li>	Your Salary/ITR</li><li>	Your Profile</li><li>	Total work experience</li><li>	Your credit/default profile</li><li>	Academic & Professional Background</li><li>	Family Credit History.</li></ul></p><p><a href='http://www.deal4loans.com/Contents_Home_Loan_Article1.php'>Read More</a> about How your Loan application will be evaluated.</p><p>As a customer you should avoid doing the following while applying for a loan:<ul><li>	Incorrect address on application forms.</li><li>	Not disclosing earlier loans.</li><li>	Cheque bounces in your bank accounts as this affects your credit record.</li></ul></p><p>Hope this has helped you understand the Home Loan product better. For any further query do read other articles on our website on home loans <a href=' http://www.deal4loans.com/Contents_Home_Loan_Mustread.php' style='text-decoration:none;'> Click Here.</a></p><p>Regards<br>Team Deal4loans</p><p>More on deal4loans -<br><a href='http://www.deal4loans.com/Contents_Blogs.php'>Blogs- </a>Share your experience, queries with others.<br><a href='http://www.deal4loans.com/Contents_Feedback.php'>Testimonials-</a> Express your appreciation!!<br><a href='http://www.deal4loans.com/Loan_Query.php'>LoanQueries-</a> Ask your queries.</p></td>	</tr>	</table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td>	</tr>	</table></td></tr>	</table>";
			}	
		else {

				$Message2= "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $Name,</b></font></td><td		align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>Thank you for Registering with deal4loans. Your one stop solution for all your loan and insurance deals. Your registration details are as follows:<p>Your Email ID: $EmailID<br><p>You will receive various deals from banks and insurance companies both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";

		}

				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				if($fname)
					$SubjectLine = $fname.", Learn to get Best Deal on ".getProductName($Type_Loan);
				else
					$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
					
				mail($EmailID, $SubjectLine, $Message2, $headers);

		
		if ($Flag_Message == 1)
		{
			//$sqltest = ExecQuery("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
			$sqltest = mysql_query("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest)) 
			{
				$Item_ID = $myrow["RequestID"];
			}
			mysql_free_result($sqltest);
			$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");
			//$sqltest1 = mysql_query("Select UserID from wUsers order by UserID desc limit 1");
			//echo mysql_error();
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
					//$sql = ExecQuery("Select *  from wUsers where Email='".$EmailID."'");
					$sql = mysql_query("Select *  from wUsers where Email='".$EmailID."'");

					echo mysql_error();

					if ($myrow = mysql_fetch_array($sql)) 

					{

						$UserID=$myrow["UserID"];
					

						/* Get Resultset */

						mysql_fetch_array($sql);

							$sub_sql = ExecQuery("Update Req_Loan_Personal SET UserID=".$UserID.", Count_Replies='1', IsModified='1' Where Email='".$EmailID."'");
							//$sub_sql = mysql_query("Update Req_Loan_Personal SET UserID=".$UserID.", Count_Replies='1', IsModified='1' Where Email='".$EmailID."'");

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

?>
<html>
<head>
<title>Deal4Loans - Personal Loan | Home Loan | Car Loan | Property Loan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="tabcontent.css" />
<script type="text/javascript" src="tabcontent.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="compareloancontinue.js"></script>
<script Language="JavaScript">
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
	
</script>
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
</head>

<body>
<table width="100%" height="100%" border="0" >
 <tr><td colspan="2" align="center"><img src="images/logopersonal1.gif"> </td></tr>
  <tr> 
    <td width="56%" align="center">
	<?php if($Type_Loan=="Req_Loan_Personal") { ?>
		<div id="flowernote1" style="display:none; position:absolute; left: 90px; width:469px; color:white; top: 150px;">
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
			<td align="left" height="58" width="431" ><font class="style1"> Post your Personal loan requirement.<br />
			Get &amp; compare offers from all Banks.<br />
			Go with the lowest bank.</font> </td>
			</tr>
			<tr>
		
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
						</tr>
						<tr>
		
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all Personal loan requirements</font></td>
						</tr>
						<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, HDFC, Deutsche, Citibank, HSBC, Kotak, Standard Chartered ,and IDBI </font><font class="style1">and choose the best deal!</font></td>
						</tr>
						<tr>
						<td colspan="2" width="463"></td>
						</tr>
						<tr>
						
					<!--<td colspan="2" style="padding-left:22px; " bgcolor="0A71D9"><font color="white" style="font-weight:bold;">-->
					<td colspan="2" width="460"><table width="100%" border="0" >
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
					Helpful tips to look/compare/apply for loans to get the best deal.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
					<td valign="top" width="431" ><font class="style3">Personal loans are provided on the basis of your income, mainly estimation given by banks is on the basis of your income & most of loans are happening on the basis of the track record of the customer with any bank. Credit card usage/payments also impact your personal loan eligibility & rates as it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Personal loan are :<ol>

<li> Eligibility.</li> 

<li> Interest rates best suited. </li>

<li> Processing Fees. </li>

<li> Pre-payment/Foreclosure charges.</li> 

<li> Document required. </li>

<li> Turn Around Time.</li>
</ol>
 <br>
					<a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
	 
 				</font>
				</td>
				</tr>
	
		</table>
</div>
<?php }
else if($Type_Loan=="Req_Credit_Card")
{
 ?>         
      <div id="flowernote3" style="display:none; position:absolute; left: 90px; width:469px; height:540px; color:white; top: 150px;"> 
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
			</table></td>
			
			<td align="left" height="58" width="431" ><font class="style1"> Post your credit card requirement.<br />
			Get &amp; compare offers from all Banks.<br />
			Go with the lowest bank.</font> </td>
			</tr>
			<tr>
		
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
						</tr>
						<tr>
		
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all credit card requirements</font></td>
						</tr>
						<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, ABN AMRO, Deutsche, Citibank, Reliance and SBI </font><font class="style1">and choose the best card!</font></td>
						</tr>
						<tr>
						<td colspan="2" width="463"></td>
						</tr>
						<tr>
						
					<!--<td colspan="2" style="padding-left:22px; " bgcolor="0A71D9"><font color="white" style="font-weight:bold;">-->
					<td colspan="2" width="460"><table width="100%" border="0" >
					<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Over 50,000 satisfied customers</font></td>
						</tr>

					<tr>
						<td width="10">&nbsp;</td>
					<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>Great!  <br>
					
 Good way of helping people like me to decide on what banks to choose.Got my Credit card in 15 days.Awesome!!!!! 

  </font><br>
			
				<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >-  Ratan  &nbsp; </font>
					</td>
						</tr>
					<tr>
						<td width="10">&nbsp;</td>
					<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p> Plastic money<br>The security tips and the regular updates about credit card offers, has helped me drive more mileage out of the plastics in my wallet.   </font><br>
			
				<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >-  Swati &nbsp; </font>
					</td>
						</tr>	
						
				<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips for using a credit card.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<!--<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>-->
					<td valign="top" width="431" colspan="2"><font class="style3"><ol><li> Sign your card as soon as you receive it.</li>
<li> You will also receive the PIN number after a few days. Keep your PIN/account number safe.
<li> Every time you use your card, be aware when your card is being swiped by the cashier so as to ensure no misuse of your card takes place.</li>
<li> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.</li> 
<li> Do not forget to verify your purchases with your billing statements.</li>
<li> After using your card at an ATM, do not throw your receipt behind.</li>

</ol><a href="http://www.deal4loans.com/Contents_Credit_Card_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
 
 

</font></td>
				</tr>
		
		</table>
		 </div>
<?php }
else if($Type_Loan=="Req_Loan_Against_Property")
{
 ?>				  
      <div id="flowernote4" style="display:none; position:absolute; left: 90px; width:469px; height:540px; color:white; top: 150px;"> 
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
			<td align="left" height="58" width="431" ><font class="style1"> Post your Loan Against Property requirement.<br />
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
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, HDFC, GE, Citifinancial </font><font class="style1">and choose the best deal!</font></td>
						</tr>
						<tr>
						<td colspan="2" width="463"></td>
						</tr>
						<tr>
						
					<!--<td colspan="2" style="padding-left:22px; " bgcolor="0A71D9"><font color="white" style="font-weight:bold;">-->
					<td colspan="2" width="460"><table width="100%" border="0" >
					<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Testimonials</font></td>
						</tr>

					<tr>
						<td width="10">&nbsp;</td>
					<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>Blore Loan Against Property <br>

 I am glad that i could get 3 quotes on my loan requirement within just 48 hrs that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. 
  </font><br>
			
				<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >-  By lakshminarayan  &nbsp; </font>
					</td>
						</tr>
				
				<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Why to opt Loan Against Property ?</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><!-- <img src="images/arrow2.gif"> --></td>
					<td valign="top" width="431" ><font class="style3">
 <ul><li>
Capital requirement for Business. </li><li>
For your Child's marriage. </li><li>
Send your child for higher studies! </li><li>
Fund Medical Treatments. </li><li>
In Debt consolidation
</li></ul> </td></tr>
<tr>
					<td height="17" width="28" valign="top"><!-- <img src="images/arrow2.gif"> --></td>
					<td valign="top" width="431" ><font class="style3">HELPFUL TIPS <br>Compare with Banks for Loan amount is based on the value of property and your Income so do compare with banks on the  loan amount . <ul><li>
Interest rates . </li><li>
Processing Fees. </li><li>
Pre-payment/Foreclosure charges. </li><li>
Document required. </li><li>
Discuss your property location with bank so to know whether it can be Mortgaged or not.</li></ul>

<br>
<a href="http://www.deal4loans.com/Contents_Loan_Against_Property_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
 </font></td>
				</tr>
		</table>
</div>					 
<?php } ?>				  
 </td>
    <td width="44%"  rowspan="2">
	<table  width="90%">
	
	<tr><td width="372">
<div id="flowertabs" class="modernbricksmenu2">
<ul>
<?php
if($Type_Loan=="Req_Loan_Personal")
{
 ?>
	<li><a href="#" rel="tcontent1" class="selected" rev="flowernote1">Personal Loan</a></li>
	<?php } 
else if($Type_Loan=="Req_Credit_Card")
{
?>
	
	<li><a href="#" rel="tcontent2" rev="flowernote3" class="selected">Credit Card</a></li>
	
<?php 
}
?>
</ul>
</div></td></tr>
	<tr><td >
	
<div style="border:0px solid gray; width:320px; height:540px; background-color: #EAEAEA; padding: 5px">
<?php 
if($Type_Loan=="Req_Loan_Personal")
{
 ?>
<div id="tcontent1" class="tabcontent">
<table border="0" height="100%" cellspacing="0" cellpadding="0" width="200" align="center">
<tr>
	<td width="278"></td> <td width="84"></td>
</tr>
<tr>			
	<td rowspan="2" align="center" valign="bottom" colspan="2" width="362"><font style="font-family:Verdana; font-weight:bold;font-size:12px"> Personal Loan Request </font></td>
</tr>

<tr><td>&nbsp;</td></tr>

<tr>
	<td width="280"></td> <td width="90"></td>
</tr>
<tr>
	<td align="center" colspan="2"><!-- <font style="font-family:Verdana;"><h5>Step 2 of 2</h5></font> --></td>
</tr>
<tr>
	<td width="278">
	<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitformPL2(document.loan_form);">
	<table>
	<tr>
		<td align="left"  class="style4" width="230" height="20" c><font class="style4">Activation Code? </font>
		</td>
		<td colspan="3" align="left" width="270" height="18">
	<input size="10"  maxlength="4" name="Reference_Code1" class="style4" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')"  onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
		</td>
	</tr>
	<tr>
		<td colspan="4" align="left"  class="style4"  height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate"  >
	<font class="style4">if you havent received activation code sms</font>
		</td>
	</tr>
	<tr>
		<td colspan="4" id="myDiv" ></td>
	</tr>
	<tr>
		<td align="left"  class="style4" width="230" height="20"><font class="style4">Primary Account in which bank? </font>						
		</td>
		<td  align="left" colspan="3" width="270" height="20"><input type="text" size="18"  name="Primary_Acc"  class="style4" style="float: left" >
		</td>
	</tr>
	<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Residential Status			</td>
     <td class="style4" align="left" colspan="3" width="270" height="20"><table><tr><td class="style4"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned</td><td class="style4">
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented</td></tr><tr><td colspan="2" class="style4"><input type="radio" value="3" name="Residential_Status" class="NoBrdr">Company Provided</td></tr></table></td>
   </tr>	
	<tr>
		<td align="left" class="style4" width="230" height="20"><font class="style4">No. of years in this Company</font></td>
		<td align="left" colspan="3" width="270" height="20">
		<input type="text" name="Years_In_Company" class="style4" size="18" maxlength="15" ></td>
	</tr>
	<tr>
		<td align="left" class="style4" width="230" height="20"><font class="style4">Total Experience(Years)/
	Total Years in Business</font></td>
		<td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Total_Experience" onFocus="this.select();" style="float: left">
		</td>
	</tr>
	 <?if (isset($Card_Vintage)>0)
			{?>
					<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">Credit Card Limit?</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Card_Limit" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" style="float: left">
					</td>
			   </tr>

						 <? }
						 ?>
	<tr>
		<td align="left" class="style4" width="280" height="20"><font class="style4">Any Loan running?</font></td>
		<td align="left" width="50" height="20"><input type="radio"  value="1"  name="LoanAny" class="NoBrdr" onClick="addElementLoan();"><font class="style4">Yes</font></td>
		<td align="left" width="50" height="18"  >
	<input size="10" type="radio"  name="LoanAny" class="NoBrdr" onClick="removeElementLoan();" value="0" ><font class="style4">No</font></td>
		<td >&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" id="myDivLoan"></td>
	</tr>
	
		<tr>
			<td colspan="2" align="center" width="4"></td><input type="hidden" name="Card_Vintage" value="<? echo $Card_Vintage ?>"></td>

			</tr>
	
	<tr>
		<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>
	</tr>
	</table>
	</form>
</td>
</tr>
<tr >
	<td  colspan="5" width="847">&nbsp;</td>
</tr>
<!-- 
<tr bgcolor="DAEAF9">
<td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td>
</tr> -->

</table>
  </div>
<?php }
else if($Type_Loan=="Req_Credit_Card")
{
 ?>
<div id="tcontent2" class="tabcontent">
<table border="0" height="100%" cellspacing="0" cellpadding="0" width="200" align="center">
<tr>
	<td width="278"></td> <td width="84"></td>
</tr>

<tr>			
	<td rowspan="2" align="center" valign="bottom" colspan="2" width="362"><font style="font-family:Verdana; font-weight:bold; font-size:12px"> Credit Card Request </font></td>
</tr>

<tr>
	<td width="280"></td> <td width="90"></td>
</tr>
<tr>
	<td align="center" colspan="2"><!-- <font style="font-family:Verdana;">
                      <h5>Step 2 of 2</h5>
                      </font> --></td>
</tr>
<tr>
	<td width="278" colspan="2">
<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitformCC2(document.loan_form);">
				<table>
				<tr>
	<td align="left"  class="style4" width="230" height="20" ><font class="style4">Activation Code? </font>
	</td>
	<td colspan="3" align="left" width="270" height="18">
	<input size="10"  maxlength="10" name="Reference_Code1" class="style4" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
	</td>
</tr>
<tr>
	<td colspan="4" align="left"  class="style4"  height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
	<font class="style4">if you havent received activation code sms</font>
	</td>
</tr>
<tr>
	<td colspan="4" id="myDiv"></td>
</tr>
<tr>
	<td align="left" class="style4" width="150" height="20"><font class="style4">Are you a Credit card holder?</font></td> 
	<td colspan="3" class="bodyarial11" width="290" >
		<table border="0" >
		<tr>
			<td  align="right" width="40" height="20"><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1"  onclick="addElement1();" ><font class="style4">Yes</font></td>
			<td  align="right" width="60" height="18">
		<input type="radio" class="NoBrdr" name="CC_Holder" value="0" onClick="removeElement1();"><font class="style4" >No</font></td>
		</tr>
		</table>
	</td>
</tr>	
<tr>
	<td colspan="4" id="myDiv9"></td>
</tr>
<tr>
	<td align="left"  class="style4" width="290" height="20"><font class="style4">Cards held since?</td>
	<td  align="left"  colspan="3" width="250" height="20"><select size="1" class="style4" name="Card_Vintage">
	<option value="0">Please select</option>
	<option value="1">Less than 6 months</option>
	<option value="2">6 to 9 months</option>
	<option value="3">9 to 12 months</option>
	<option value="4">more than 12 months</option>
	</select>
	</td>
</tr>	
<tr>
	<td align="left"  class="style4" width="100" height="20" ><font class="style4">Have you applied with these Banks in last six months?</font></td>
	<td colspan="3" class="bodyarial11" width="350">
		<table border="0">
		<tr>
			<td class="style4" width="60%"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
			<td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td>
		</tr>
		<tr>
			<td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Canara Bank" >Canara Bank</td>
			<td class="style4"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >Citi Bank</td>
		</tr>
		<tr>
			<td class="style4"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td>
			<td class="style4"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td>
		</tr>
		<tr>
			<td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td>
			<td class="style4"> <input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td>
		</tr>
		<tr>
			<td class="style4" colspan="2"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td>
		</tr>
		<tr>
			<td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="SBi">SBI</td>
			<td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="No">No</td>
		</tr>
		</table>
	</td>
</tr>


<tr><td width="400" colspan="2">&nbsp;</td></tr>		
<tr><td colspan="2">&nbsp;</td></tr>

<tr>
<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

</tr>
				</table>
				<!--/div!-->
				</form>
</td>
</tr>
<tr >
	<td  colspan="5" width="847">&nbsp;</td>
</tr>

<!-- <tr bgcolor="DAEAF9">
	<td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td>
</tr> -->
</table>

</div>
<?php } ?>
<div id="tcontent3" class="tabcontent">
</div>

<div id="tcontent4" class="tabcontent">
</div>

</div>


<br style="clear: left" />

<script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()

</script></td></tr>
	</table>
	
	
	</td>
  </tr>
 <tr><td>
<!-- Google Code for lead Conversion Page -->


<script language="JavaScript" type="text/javascript">

<!--
var google_conversion_id = 1056387586;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";
if (1) {
  var google_conversion_value = 1;
}

var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1056387586/imp.gif?value=1&label=lead&script=0">
</noscript>
 
 </td></tr>
</table>
</body>
</html>
