<?php
require 'scripts/db_init.php';
//require 'scripts/db_init_bima.php';
require 'scripts/functions.php';


	session_start();
	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];
		

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		
			$ccname=$_POST['ccname'];
		$ccemail = $_POST["ccemail"];
		$ccdob = $_POST["ccdob"];
		$ccmobile = $_POST["ccmobile"];
		$ccstd_code = $_POST["ccstd_code"];
		$cclandline = $_POST["cclandline"];
		$resilandline =$ccstd_code."-".$cclandline;
		$cclandline_o = $_POST["cclandline_o"];
		$ccstd_code_o = $_POST["ccstd_code_o"];
		$officelandline = $ccstd_code_o."-".$cclandline_o;
		$cccity = $_POST["cccity"];
		$cccity_other = $_POST["cccity_other"];
		$cccompany_name = $_POST["company_name"];
		$designation = $_POST["designation"];
		$ccresidence_address = $_POST["ccresidence_address"];
		$ccoffice_address = $_POST["ccoffice_address"];
		$cccity = $_POST["cccity"];
		$cccity_other = $_POST["cccity_other"];
		$ccpincode = $_POST["ccpincode"];
		$residence_status = $_POST["residence_status"];
		$residence_landmark = $_POST["residence_landmark"];
		$Desired_Name_On_Card = $_POST["Desired_Name_On_Card"];
		$mother_name = $_POST["mother_name"];
		$gender = $_POST["gender"];
		$marital_status = $_POST["marital_status"];
		$no_of_dependent = $_POST["no_of_dependent"];
		$education = $_POST["education"];
		$pan_no = $_POST["pan_no"];
		$vehicle_ownership = $_POST["vehicle_ownership"];
		$mailing_address = $_POST["mailing_address"];
		$bank_name = $_POST["bank_name"];
		$account_type = $_POST["account_type"];
		$account_number = $_POST["account_number"];
		$branch = $_POST["branch"];
		$other_credit_card = $_POST["other_credit_card"];
		$card_limit = $_POST["card_limit"];
		$credit_card_no = $_POST["credit_card_no"];
		$membership_since = $_POST["membership_since"];
		$BidderId = $_POST["BidderId"];
		$ccrequestid = $_POST["ccrequestid"];
		$ccfeedback = $_POST["ccfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Bidder_Id = $_REQUEST['BidderId'];
		$ccadd_comment= $_REQUEST['ccadd_comment'];
		$department = $_POST["department"];
		$occupation = $_POST["occupation"];
		$KotakID = $_POST["KotakID"];
		$Card_Name = $_POST["card_name"];
		$net_salary = $_POST["net_salary"];
		//echo $KotakID."<br>";
		$recording_no = $_POST["recording_no"];
		$Total_Experience = $_POST["Total_Experience"];
		$Dated = ExactServerdate();
	
		
	if(($KotakID)>0)
	{
		if($ccfeedback=="Send Now")
		{
	
		$DataArray = array("Name"=>$ccname, "Mobile_No"=>$ccmobile, "Emailid"=>$ccemail, "DOB"=>$ccdob, "Desired_Name_On_Card"=>$Desired_Name_On_Card, "Mother_Name"=>$mother_name, "Gender"=>$gender, "Marital_Status"=>$marital_status, "No_of_Dependents"=>$no_of_dependent, "Education"=>$education, "Pan_No"=>$pan_no, "Vehicle_Ownership"=>$vehicle_ownership, "Occupation"=>$occupation, "Resi_Status"=>$residence_status, "Resi_Address"=>$ccresidence_address, "Land_Mark"=>$residence_landmark, "Resi_Landline"=>$resilandline, "City"=>$cccity, "Pincode"=>$ccpincode, "Company_Name"=>$cccompany_name, "Address"=>$ccoffice_address, "Landline_No"=>$officelandline, "Department"=>$department, "Designation"=>$designation, "Preferd_Mailing_Address"=>$mailing_address, "Bank_Name"=>$bank_name, "Account_Type"=>$account_type, "Account_No"=>$account_number, "Branch"=>$branch, "Other_Credit_Card"=>$other_credit_card, "Card_Limit"=>$card_limit, "Card_No"=>$credit_card_no, "Membership_Since"=>$membership_since, "Card_Name"=>$Card_Name, "Net_Salary"=>$net_salary, "Recording_No"=>$recording_no, "Total_Experience"=>$Total_Experience, "add_comment"=>$ccadd_comment, "Entry_Dated" =>$Dated);
		$wherecondition ="kotakID=".$KotakID;
		Mainupdatefunc ('kotak_credit_card_details', $DataArray, $wherecondition);
        
	
	
		}
		else
		{
			
	   $DataArray = array("Name"=>$ccname, "Mobile_No"=>$ccmobile, "Emailid"=>$ccemail, "DOB"=>$ccdob, "Desired_Name_On_Card"=>$Desired_Name_On_Card, "Mother_Name"=>$mother_name, "Gender"=>$gender, "Marital_Status"=>$marital_status, "No_of_Dependents"=>$no_of_dependent, "Education"=>$education, "Pan_No"=>$pan_no, "Vehicle_Ownership"=>$vehicle_ownership, "Occupation"=>$occupation, "Resi_Status"=>$residence_status, "Resi_Address"=>$ccresidence_address, "Land_Mark"=>$residence_landmark, "Resi_Landline"=>$resilandline, "City"=>$cccity, "Pincode"=>$ccpincode, "Company_Name"=>$cccompany_name, "Address"=>$ccoffice_address, "Landline_No"=>$officelandline, "Department"=>$department, "Designation"=>$designation, "Preferd_Mailing_Address"=>$mailing_address, "Bank_Name"=>$bank_name, "Account_Type"=>$account_type, "Account_No"=>$account_number, "Branch"=>$branch, "Other_Credit_Card"=>$other_credit_card, "Card_Limit"=>$card_limit, "Card_No"=>$credit_card_no, "Membership_Since"=>$membership_since, "Card_Name "=>$Card_Name, "Net_Salary"=>$net_salary, "Recording_No"=>$recording_no, "Total_Experience"=>$Total_Experience, "add_comment"=>$ccadd_comment);
		$wherecondition ="kotakID=".$KotakID;
		Mainupdatefunc ('kotak_credit_card_details', $DataArray, $wherecondition);
        
	
		}
		

	}
	else
	{

	
	$dataInsert = array("kotakID"=>'', "RequestID"=>$ccrequestid, "Name"=>$ccname, "Mobile_No"=>$ccmobile, "Emailid"=>$ccemail, "DOB"=>$ccdob, "Desired_Name_On_Card"=>$Desired_Name_On_Card, "Mother_Name"=>$mother_name, "Gender"=>$gender, "Marital_Status"=>$marital_status, "No_of_Dependents"=>$no_of_dependent, "Education"=>$education, "Pan_No"=>$pan_no, "Vehicle_Ownership"=>$vehicle_ownership, "Occupation"=>$occupation, "Resi_Status"=>$residence_status, "Resi_Address"=>$ccresidence_address, "Land_Mark"=>$residence_landmark, "Resi_Landline"=>$resilandline, "City"=>$cccity, "Pincode"=>$ccpincode, "Company_Name"=>$cccompany_name, "Address"=>$ccoffice_address, "Landline_No"=>$officelandline, "Department"=>$department, "Designation"=>$designation, "Preferd_Mailing_Address"=>$mailing_address, "Bank_Name"=>$bank_name, "Account_Type"=>$account_type, "Account_No"=>$account_number, "Branch"=>$branch, "Other_Credit_Card"=>$other_credit_card, "Card_Limit"=>$card_limit, "Card_No"=>$credit_card_no, "Membership_Since"=>$membership_since, "Entry_Dated"=>$Dated, "Card_Name"=>$Card_Name, "Net_Salary"=>$net_salary, "Recording_No"=>$recording_no, "Total_Experience"=>$Total_Experience, "add_comment"=>$ccadd_comment);
$table = 'kotak_credit_card_details';
$insert = Maininsertfunc ($table, $dataInsert);
	
	
	}





/////////////////////////////////
	 if(strlen($ccfeedback)>0)
	{
		  if($ccfeedback=="Not Contactable")
		{
			$counter="1";
		}
		else
		{
			$counter="";
		}
		$strSQL="";
		$Msg="";
		$result = ("select FeedbackID,not_contactable_counter from Req_Feedback where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=4");		
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		if($num_rows > 0)
		{
			$notcontactableCounter=$row["not_contactable_counter"];
			$updatedcounter=$notcontactableCounter+1;
		
			$dataRows = array('Feedback'=>$ccfeedback,'not_contactable_counter'=>$updatedcounter, 'Followup_Date'=>$FollowupDate);
			$whereClause = "(FeedbackID=".$row[$cntr]["FeedbackID"].")";
			Mainupdatefunc ('Req_Feedback', $dataRows, $whereClause);
		
		}
		else
		{
			$Dated = ExactServerdate();
			$data = array("AllRequestID"=>$post , "BidderID"=>$Bidder_Id , "Reply_Type"=>'4', "Feedback"=>$changeapp_time , "Followup_Date"=>$FollowupDate ,  "not_contactable_counter"=>$counter );
			$insert = Maininsertfunc ('Req_Feedback', $data);
					
		}

		
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}

	}



}
		
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

<STYLE>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
</style>


</head>

<body >
<p align="center"><b>Credit Card Lead Details </b></p>

<?php 
$viewdetails="select RequestID from kotak_credit_card_details where RequestID=".$post." "; 
//echo $viewdetails."<br>";
 list($viewleadscount,$getrow)=MainselectfuncNew($viewdetails,$array = array());
		
if(($viewleadscount)>0)
{
	//echo "if";
	$viewkotakqry="select * from kotak_credit_card_details LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=kotak_credit_card_details.RequestID and Req_Feedback.BidderID= '".$bidid."' where RequestID=".$post." "; 
	list($viewleadscount,$Myrow)=MainselectfuncNew($viewkotakqry,$array = array());
		$i=0;
	

$kotakID = $Myrow[$i]['kotakID'];
$Name = $Myrow[$i]['Name'];
$Mobile = $Myrow[$i]['Mobile_No'];
$Email = $Myrow[$i]['Emailid'];
$DOB = $Myrow[$i]['DOB'];
$Desired_Name_On_Card = $Myrow[$i]['Desired_Name_On_Card'];
$Mother_Name = $Myrow[$i]['Mother_Name'];
$Gender = $Myrow[$i]['Gender'];
$Marital_Status = $Myrow[$i]['Marital_Status'];
$No_of_Dependents = $Myrow[$i]['No_of_Dependents'];
$Education = $Myrow[$i]['Education'];
$Pancard = $Myrow[$i]['Pan_No'];
$Vehicle_Ownership = $Myrow[$i]['Vehicle_Ownership'];
$Occupation = $Myrow[$i]['Occupation'];
$Resi_Status = $Myrow[$i]['Resi_Status'];
$Residence_Address = $Myrow[$i]['Resi_Address'];
$Land_Mark = $Myrow[$i]['Land_Mark'];
$Landline = $Myrow[$i]['Resi_Landline'];
$City = $Myrow[$i]['City'];
$Pincode = $Myrow[$i]['Pincode'];
$Company_Name = $Myrow[$i]['Company_Name'];
$Office_Address = $Myrow[$i]['Address'];
$Landline_O = $Myrow[$i]['Landline_No'];
$Department = $Myrow[$i]['Department'];
$Designation = $Myrow[$i]['Designation'];
$Preferd_Mailing_Address = $Myrow[$i]['Preferd_Mailing_Address'];
$Bank_Name = $Myrow[$i]['Bank_Name'];
$Account_Type = $Myrow[$i]['Account_Type'];
$Account_No = $Myrow[$i]['Account_No'];
$Branch = $Myrow[$i]['Branch'];
$No_of_Banks = $Myrow[$i]['Other_Credit_Card'];
$Card_Limit = $Myrow[$i]['Card_Limit'];
$Card_No = $Myrow[$i]['Card_No'];
$Membership_Since = $Myrow[$i]['Membership_Since'];
$Feedback = $Myrow[$i]['Feedback'];
$Pancard_No = $Myrow[$i]['Pan_No'];
$Card_Name =  $Myrow[$i]['Card_Name'];
$recording_no =  $Myrow[$i]['Recording_No'];
$net_salary = $Myrow[$i]['Net_Salary'];
$Total_Experience =$Myrow[$i]['Total_Experience'];
$ccadd_comment = $Myrow[$i]['add_comment'];

}
else
{
		//echo "else";
$viewqry="select * from Req_Credit_Card LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback.BidderID= '".$bidid."' where Req_Credit_Card.RequestID=".$post." ";
//echo $viewqry."<br>";
list($viewleadscount,$Arrrow)=MainselectfuncNew($viewqry,$array = array());
		$j=0;

$Name = $Arrrow[$j]['Name'];
$Mobile = $Arrrow[$j]['Mobile_Number'];
$Landline = $Arrrow[$j]['Landline'];
$Landline_O = $Arrrow[$j]['Landline_O'];
$Std_Code = $Arrrow[$j]['Std_Code'];
$Std_Code_O = $Arrrow[$j]['Std_Code_O'];
$Residential_Status = $Arrrow[$j]['Residential_Status'];
$City = $Arrrow[$j]['City'];
$City_Other = $Arrrow[$j]['City_Other'];
$Updated_Date = $Arrrow[$j]['Updated_Date'];
$Occupation = $Arrrow[$j]['Employment_Status'];
$Email = $Arrrow[$j]['Email'];
$source = $Arrrow[$j]['source'];
$Pincode = $Arrrow[$j]['Pincode'];
$CC_Holder = $Arrrow[$j]['CC_Holder'];
$Card_Vintage = $Arrrow[$j]['Card_Vintage'];
$followup_date = $Arrrow[$j]['Followup_Date'];
$Feedback = $Arrrow[$j]['Feedback'];
$No_of_Banks = $Arrrow[$j]['No_of_Banks'];
$Residence_Address = $Arrrow[$j]['Residence_Address'];
$Office_Address = $Arrrow[$j]['Office_Address'];
$Company_Name = $Arrrow[$j]['Company_Name'];
$Card_Limit = $Arrrow[$j]['Credit_Limit'];
$Pancard = $Arrrow[$j]['Pancard'];
$Loan_Any = $Arrrow[$j]['Loan_Any'];
$Pancard_No = $Arrrow[$j]['Pancard_No'];
$DOB = $Arrrow[$j]['DOB'];
$Feedback = $Arrrow[$j]['Feedback'];
$net_salary = $Arrrow[$j]['Net_Salary'];



}


if($Card_Limit==1)
{
	$Card_Limit=25000;
}
elseif($Card_Limit==2)
{
	$Card_Limit=50001;
}
elseif($Card_Limit==3)
{
	$Card_Limit=75001;
}
elseif($Card_Limit==4)
{
	$Card_Limit=100000;
}

?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="ccname" id="ccname" value="<? echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="ccemail" id="ccemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="ccdob" size="15" value="<?echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="ccmobile" size="15" value="<?echo $Mobile;?>"></td>
			</tr>
			
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="ccstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="cclandline" size="8" value="<?echo $Landline;?>"></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><input type="text" name="ccstd_code_o"  size="1" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="cclandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Residence Status</b></td>
			<td class="fontstyle"><input type="text" name="residence_status" id="residence_status" value="<? echo $Resi_Status; ?>" ></td>
			<td class="fontstyle" ><b>Residence Landmark.</b></td>
			<td class="fontstyle"><input type="text" name="residence_landmark" rows="2" cols="18" value="<? echo $Land_Mark; ?>"></textarea></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Company Name</b></td>
			<td class="fontstyle"><input type="text" name="company_name" id="company_name" value="<? echo  $Company_Name;?>"></td>
			<td class="fontstyle" ><b>Designation</b></td>
			<td class="fontstyle"><input type="text" name="designation" id="designation" value="<? echo  $Designation;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>
		Department</b></td><td><input type="text" name="department" id="department" value="<?echo $department;?>" ></td>
		<td class="fontstyle"><b>
		
		Occupation</b></td><td><input type="text" name="occupation" id="occupation" value="<? if($kotakID>0)
		{
				echo $Occupation;
		}
		else
		{
			if ($Occupation==1) { echo "Salaried";} elseif($Occupation==0) {  echo "Self Employed"; }
		}?>" ></td>
		<tr>
			<td class="fontstyle"><b>Residence Address</b></td>
			<td class="fontstyle"><textarea name="ccresidence_address" rows="2" cols="18" ><?echo $Residence_Address;?></textarea></td>
			<td class="fontstyle" ><b>Office Address.</b></td>
			<td class="fontstyle"><textarea name="ccoffice_address" rows="2" cols="18"><?echo $Office_Address;?></textarea></td>
		</tr>
		
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="cccity" id="cccity"> <?=getCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="cccity_other" id="cccity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="ccpincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td class="fontstyle"><b>Total Experience</b></td><td><input type="text" name="Total_Experience" size="10" value="<?echo $Total_Experience;?>" ></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Desired Name On Card</b></td>
			<td class="fontstyle"><input type="text" name="Desired_Name_On_Card" id="Desired_Name_On_Card" value="<? echo  $Desired_Name_On_Card;?>"></td>
			<td class="fontstyle"><b>Mother Name</b></td>
			<td class="fontstyle"><input type="text" name="mother_name" id="mother_name" value="<? echo  $Mother_Name;?>"></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Gender</b></td>
			<td class="fontstyle">
			<select name="gender" id="gender">
				<option value="Male" <? if($Gender=="Male") { echo "selected";}?>>Male</option>
				<option value="Female" <? if($Gender=="Female") { echo "selected";}?>>Female</option>
			</select></td>

			<td class="fontstyle"><b>Marital Status </b></td>
			<td class="fontstyle">
			<select name="marital_status" id="marital_status">
				<option value="Single" <? if($Marital_Status=="Single") { echo "selected";}?>>Single</option>
				<option value="Married" <? if($Marital_Status=="Married") { echo "selected";}?>>Married</option>
			</select>
			
			</td>
		</tr>
		
		<tr>
			<td class="fontstyle"><b>No of dependent </b></td>
			<td class="fontstyle"><input type="text" name="no_of_dependent" id="no_of_dependent" value="<? echo  $No_of_Dependents;?>"></td>
			<td class="fontstyle"><b>Education</b></td>
			<td class="fontstyle">
			<select name="education" id="education" >
													<option value="">Please Select</option>
													<option value="Non-Matriculation" <?if($Education=="Non-Matriculation") { echo "selected";} ?>>Non-Matriculation </option>

													<option value="High School" <?if($Education=="High School") { echo "selected";} ?>>High School</option>
													<option value="Graduate" <?if($Education=="Graduate") { echo "selected";} ?>>Graduate</option>
													<option value="Post Graduate" <?if($Education=="Post Graduate") { echo "selected";} ?>>Post Graduate</option>
													<option value="Others" <?if($Education=="Others") { echo "selected";} ?>>Others</option>
												</select>
			</td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Pan No </b></td>
			<td class="fontstyle"><input type="text" name="pan_no" id="pan_no" value="<?echo $Pancard_No;?>"></td>
			<td class="fontstyle"><b>Vehicle Ownership</b></td>
			<td class="fontstyle">
			<select name="vehicle_ownership" id="vehicle_ownership"> 
			<option value="Four Wheeler" <?if($Vehicle_Ownership=="Four Wheeler") { echo "selected";}?> >Four Wheeler</option>
			<option value="Two Wheeler" <?if($Vehicle_Ownership=="Two Wheeler") { echo "selected";}?>>Two Wheeler</option>
			<option value="Both" <?if($Vehicle_Ownership=="Both") { echo "selected";}?>>Both</option>
			<option value="None" <?if($Vehicle_Ownership=="None") { echo "selected";}?>>None</option>
			</select>
			</td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Prefered Mailing Address </b></td>
			<td class="fontstyle"><input type="text" name="mailing_address" id="mailing_address" value="<?echo $Preferd_Mailing_Address;?>"></td>
			<td class="fontstyle"><b>Bank Name</b></td>
			<td class="fontstyle"><input type="text" name="bank_name" id="bank_name" value="<?echo $Bank_Name;?>"></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Account Type </b></td>
			<td class="fontstyle"><input type="text" name="account_type" id="account_type" value="<?echo $Account_Type;?>"></td>
			<td class="fontstyle"><b>Account Number</b></td>
			<td class="fontstyle"><input type="text" name="account_number" id="account_number" value="<?echo $Account_No;?>"></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Branch </b></td>
			<td class="fontstyle"><input type="text" name="branch" id="branch" value="<?echo $Branch;?>"></td>
			<td class="fontstyle"><b>Other Bank Credit Card</b></td>
			<td class="fontstyle"><input type="text" name="other_credit_card" id="other_credit_card" value="<?echo $No_of_Banks;?>"></td>
		</tr>
	
		<tr>
			<td class="fontstyle"><b>Card Limit </b></td>
			<td class="fontstyle"><input type="text" name="card_limit" id="card_limit" value="<?echo $Card_Limit;?>"></td>
			<td class="fontstyle"><b>Credit Card No</b></td>
			<td class="fontstyle"><input type="text" name="credit_card_no" id="credit_card_no" value="<?echo $Card_No;?>"></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Membership Since </b></td>
			<td class="fontstyle"><input type="text" name="membership_since" id="membership_since" value="<?echo $Membership_Since;?>"></td>
			<td class="fontstyle" ><b>Card Name</b>
			<select name="card_name" id="card_name">
			<option value="-1">Please Select</option>
			<option value="Fortune Card" <? if($Card_Name=="Fortune Card") { echo "selected"; }?>>Fortune Card</option>
			<option value="Trump Card" <? if($Card_Name=="Trump Card") { echo "selected"; }?>>Trump Card</option></select></td>
		</tr>

		<tr>
			<td class="fontstyle"><b>Annual Income </b></td>
			<td class="fontstyle"><input type="text" name="net_salary" id="net_salary" value="<?echo $net_salary;?>"></td>
			<td class="fontstyle"><b>Recording No</b></td>
			<td class="fontstyle"><input type="text" name="recording_no" id="recording_no" value="<?echo $recording_no;?>"></td>
		</tr>
			<tr>
			<td colspan="4" class="fontstyle">
			<input type="hidden" name="BidderId" value="<?echo $bidid;?>"><input type="hidden" name="KotakID" id="KotakID" value="<?echo $kotakID;?>"></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="ccrequestid" id="ccrequestid" value="<?echo $post;?>"></td>
		</tr>
		
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>


<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="ccfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	</select>
	</td>
	

	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>

<tr><td>Add Comment</td><td><textarea rows="2" cols="10" name="ccadd_comment" id="ccadd_comment"><? echo $ccadd_comment;?></textarea></td><td colspan="2"></td></tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>

</table>
</form>
</body>
</html>