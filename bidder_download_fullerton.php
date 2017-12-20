<?
session_start();	

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
//echo "hello".$_SESSION['BidderID'];
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
	//$value=explode(",", $_POST["qry2"]);
       // $qry2=$value[1];
//echo "gff=".$qry2;
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
      	$exclusiveLead = '';
      	$appointmentsLead = '';		
	while($row_result=mysql_fetch_array($search_result))
	{
		if( $qry2=="Req_Loan_Personal")
        //      if( $qry2==1)
		{
			$uniqueid ="PL".$row_result["Feedback_ID"]."S".$row_result['sentbidder'];
			$exclusiveLead = '';
			$sqlExclusive = "select  BidderID  from Req_Feedback_Bidder1 where (AllRequestID = '".$row_result["RequestID"]."' and Reply_Type='1')";
			$queryExclusive = ExecQuery($sqlExclusive);
			$numRowsExclusive = mysql_num_rows($queryExclusive);
			if($numRowsExclusive==1)
			{
				$exclusiveLead = "Exclusive Lead";
			}	
	      	$appointmentsLead = '';
			$getAppointmentSql = "SELECT * FROM fil_appointments where RequestID='".$row_result["RequestID"]."'";
			$getAppointmentQuery = ExecQuery($getAppointmentSql);
			$getAppointmentNum = mysql_num_rows($getAppointmentQuery);
			if($getAppointmentNum>0)
			{
		      	$appointmentsLead = 'Appointment Fixed';
			}	
			
			if($row_result["Is_Permit"]==1)
				{
					$Is_Permit= "had Credit Card or Loan in last 12 months";
				}
				else
				{
					$Is_Permit= "";
				}

			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result["Residential_Status"]==1) { $residential_status="Owned By Parent/Sibling"; }  if($row_result["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result["Residential_Status"]==4) { $residential_status="Owned By Self/Spouse"; }  
			if($row_result["Residential_Status"]==5) { $residential_status="Rented - With Family"; }  
			if($row_result["Residential_Status"]==6) { $residential_status="Rented - With Friends"; }  
			if($row_result["Residential_Status"]==7) { $residential_status="Paying Guest"; }  
			if($row_result["Residential_Status"]==8) { $residential_status="Hostel"; }  

			if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
		
			if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

if($row_result["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
		if($row_result["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
		if($row_result["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
		if($row_result["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }

if($row_result["Company_Type"]==0)	{	$Company_Type="";}
if($row_result["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
if($row_result["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
if($row_result["Company_Type"]==3)	{	$Company_Type="Limited";}
if($row_result["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
if($row_result["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

if($row_result["eligible"]==1)
			{
				$eligible="Yes";
			}
			elseif($row_result["eligible"]==2)
			{
				$eligible="No";
			}
			else
			{
				$eligible=" ";
			}

			if($row_result["interest_stat"]==1)
			{
				$interest_stat="Yes";
			}
			elseif($row_result["interest_stat"]==2)
			{
				$interest_stat="No";
			}
			else
			{
				$interest_stat=" ";
			}
					$Dateofallocation = $row_result["Allocation_Date"];
		

			if(strlen($row_result["Hdfc_Eligibility"])>0)
			{
				$hdfceligibility=$row_result["Hdfc_Eligibility"];
			}
			else
			{
				$hdfceligibility="Not Eligibile";
			}

			if(strlen($row_result["Citibank_Eligibility"])>0)
			{
				$citieligibility=$row_result["Citibank_Eligibility"];
			}
			else
			{
				$citieligibility="Not Eligibile";
			}

			if(strlen($row_result["Barclays_Eligibility"])>0)
			{
				$barclayeligibility=$row_result["Barclays_Eligibility"];
			}
			else
			{
				$barclayeligibility="Not Eligibile";
			}

			$dob=$row_result["DOB"];


			$tellCallSql = "select * from fullerton_allocation_track where RequestID='".$row_result["RequestID"]."'";
			$tellCallQuery = ExecQuery($tellCallSql);
			$TName  = mysql_result($tellCallQuery,0,'BName');
			$TMobile  = mysql_result($tellCallQuery,0,'Mobile');

$keyFBidders = '';
		$bidderSql = "select Bidders_List.BidderID as BidderID from Bidders_List left join Bidders on Bidders.BidderID= Bidders_List.BidderID and Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 where (Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 and Bidders.Define_PrePost='PostPaid')";
	
	
	$bidderQuery = ExecQuery($bidderSql);
	$numbidder = mysql_num_rows($bidderQuery);
	$arrBidderID = '';
	for($i=0;$i<$numbidder;$i++)
	{
		$BidID  = mysql_result($bidderQuery,$i,'BidderID');
		$arrBidderID[] = $BidID;
	}

	//print_r($arrBidderID);
	$keyFBidders = array_search($_SESSION['BidderID'], $arrBidderID);
	if(strlen($keyFBidders)>0)
	{
	  $getAppointmentSql = "SELECT address_apt,changeapp_time,appdate,docs FROM fil_appointments where RequestID='".$row_result["RequestID"]."'";
	  $getAppointmentQuery = ExecQuery($getAppointmentSql);
	  $getAppointmentNum = mysql_num_rows($getAppointmentQuery);
      if($getAppointmentNum>0)
	  {
	   		$address_apt = mysql_result($getAppointmentQuery,0,'address_apt');	
			$changeapp_time = mysql_result($getAppointmentQuery,0,'changeapp_time');
			$time = '';
			if($changeapp_time=="08:00:00")
			{
				$time =  "8(am)-9(am)";
			}	
			else if($changeapp_time=="09:00:00")
			{
				$time =  "9(am)-10(am)";
			}
			else if($changeapp_time=="10:00:00")
			{
				$time =  "10(am)-11(am)";
			}
			else if($changeapp_time=="11:00:00")
			{
				$time =  "11(am)-12(pm)";
			}
			else if($changeapp_time=="12:00:00")
			{
				$time =  "12(pm)-1(pm)";
			}
			else if($changeapp_time=="13:00:00")
			{
				$time =  "1(pm)-2(pm)";
			}
			else if($changeapp_time=="14:00:00")
			{
				$time =  "2(pm)-3(pm)";
			}
			else if($changeapp_time=="15:00:00")
			{
				$time =  "3(pm)-4(pm)";
			}
			else if($changeapp_time=="16:00:00")
			{
				$time =  "4(pm)-5(pm)";
			}
			else if($changeapp_time=="17:00:00")
			{
				$time =  "5(pm)-6(pm)";
			}
			else if($changeapp_time=="18:00:00")
			{
				$time =  "6(pm)-7(pm)";
			}
			else if($changeapp_time=="19:00:00")
			{
				$time =  "7(pm)-8(pm)";
			}
			
			$appdate = mysql_result($getAppointmentQuery,0,'appdate');	
			$docs = mysql_result($getAppointmentQuery,0,'docs');
			$apt_dt = $appdate.", ".$time;
		  }
	
	
	
		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number,net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents, employer, plan_interested, descr, login_date, apt_dt, docs, address_apt, unique_id ) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."',  '".$row_result["Net_Salary"]."','".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$hdfceligibility."', '".$citieligibility."', '".$barclayeligibility."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."','".$eligible."','".$interest_stat."','".$row_result["post_login_stat"]."','".$row_result["last_update_dated"]."', '".$apt_dt."', '".$docs."', '".$address_apt."', '".$uniqueid."')";

	}
 else if($_SESSION['BidderID']==1535 || $_SESSION['BidderID']==1536 || $_SESSION['BidderID']==1537 || $_SESSION['BidderID']==1538 || $_SESSION['BidderID']==1542 || $_SESSION['BidderID']==1139 || $_SESSION['BidderID']==1129 || $_SESSION['BidderID']==1130 || $_SESSION['BidderID']==1137 || $_SESSION['BidderID']==1140 || $_SESSION['BidderID']==1244 || $_SESSION['BidderID']==1249 )
			{
	$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents, employer, plan_interested, descr, login_date, unique_id) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$hdfceligibility."', '".$citieligibility."', '".$barclayeligibility."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."','".$eligible."','".$interest_stat."','".$row_result["post_login_stat"]."','".$row_result["last_update_dated"]."', '".$uniqueid."')";
			}
			else if($_SESSION['BidderID']==1150)
			{
				$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number,net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents, employer, plan_interested, descr, login_date,referred_page, unique_id) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."',  '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$hdfceligibility."', '".$citieligibility."', '".$barclayeligibility."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."','".$eligible."','".$interest_stat."','".$row_result["post_login_stat"]."','".$row_result["last_update_dated"]."','".$row_result["Add_Comment"]."', '".$uniqueid."')";
			}
			else
			{
				
$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,car_model,car_type,is_valid, current_age, changeapp_time, unique_id) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$hdfceligibility."', '".$citieligibility."', '".$barclayeligibility."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."','".$row_result["Residence_Address"]."','".$row_result["Primary_Acc"]."','".$Company_Type."','".$Salary_Drawn."','".$row_result["axis_executive_name"]."', '".$TMobile."', '".$TName."','".$Is_Permit."', '".$exclusiveLead."', '".$appointmentsLead."', '".$uniqueid."')";
			}
			$result1=ExecQuery($qry1);
			//echo "".$qry1."<br>";
		
		
		}

		if($qry2=="Req_Loan_Home")
          //     if($qry2==2)
		{
			$uniqueid ="HL".$row_result["Feedback_ID"]."S".$row_result['sentbidder'];
			if($row_result["Property_Identified"]==0){ $property_identified="No";}
			elseif($row_result["Property_Identified"]==1) { $property_identified="Yes";}
			else { $property_identified="";}

			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			$Dateofallocation = $row_result["Allocation_Date"];
		
			$bank_name="Deal4loans";
			$total_exp ="Home Loan";

			$qry1="insert into temp (session_id, name, dob, email, emp_status, city, city_other, pincode, total_exp,mobile_number, net_salary, descr, loan_amount, Feedback, budget, property_identified, property_loc, loan_time, doe,add_comment,request_id,property_value, bank_name , employer,c_name, unique_id ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Pincode"]."', '".$total_exp."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Add_Comment"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Budget"]."', '".$property_identified."', '".$row_result["Property_Loc"]."', '".$row_result["Loan_Time"]."', '".$Dateofallocation."', '".$row_result["comment_section"]."', '".$row_result["Feedback_ID"]."', '".$row_result["Property_Value"]."', '".$bank_name."', '".$row_result["axis_executive_name"]."','".$row_result["Company_Name"]."', '".$uniqueid."')";
			//echo "".$qry1."<br>";
				$result1=ExecQuery($qry1);
		}

		if($qry2=="Req_Loan_Car")
        //       if($qry2==3)
		{
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result["Car_Type"]==1) { $car_type="New"; }
			if($row_result["Car_Type"]==0) { $car_type="Old"; }  
				
		
			if($row_result["Car_Booked"]==1)
			{			 $Car_Booked="Yes";			}
			else if ($row_result["Car_Booked"]==2)
			{			$Car_Booked="No";			}
			else
			{			$Car_Booked="";			}

$acc_no= $row_result["Account_No"];
			$descr= $Car_Booked;
		

			$Dateofallocation = $row_result["Allocation_Date"];

		$pieces = explode(",", $row_result["CL_Bank"]);
		$specialP="";
for($i=0;$i<count($pieces);$i++)
{
	if($pieces[$i]=="HDFC")
	{
		$specialP=$pieces[$i];
	}
	
}

			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, car_model, loan_amount, pincode, Feedback, contact_time, is_processed, doe,add_comment, descr,pancard,referred_page) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."',  '".$row_result["Net_Salary"]."', '".$row_result["Car_Model"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["Feedback"]."', '".$row_result["Contact_Time"]."', '".$car_type."', '".$Dateofallocation."','".$row_result["comment_section"]."','".$descr."','".$acc_no."','".$specialP."')";
			//echo "".$qry1."<br>";
			$result1=ExecQuery($qry1);

		}

       if($qry2=="Req_Credit_Card")
			{
		  
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			
			$Dateofallocation = $row_result["Allocation_Date"];
			
			if($row_result["Existing_Relationship"]==1)
				{
				$Existing_Relationship="Account Holder";
				}
				if($row_result["Existing_Relationship"]==2)
				{

$Existing_Relationship="Loan Running";
				}
				if($row_result["Existing_Relationship"]==3)
				{
					$Existing_Relationship="Credit Card Holder";
				}
				if($row_result["Existing_Relationship"]==0)
				{
				$Existing_Relationship="";
				}

			$dob=$row_result["DOB"];

if($_SESSION['BidderID']==2009)
				{
	$desrc=$row_result["Descr"];
	$strdesrc="";
	$arrdesrc = explode(",",$desrc);
	for($ar=0;$ar<count($arrdesrc);$ar++)
	{
		if($arrdesrc[$ar]=="HDFC Platinum Plus Card" || $arrdesrc[$ar]=="HDFC Gold Card")
		{
			$strdesrc=$arrdesrc[$ar];
			//$strdesrc.=$strdesrc.",";
		}
		
	}
	
		}
	else
		{
		$strdesrc=$row_result["Descr"];
		}
	if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, descr,Feedback, pancard, no_of_banks,  property_type,doe,add_comment,employer,bank_name,cc_holder, std_code, landline ) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$strdesrc."',  '".$row_result["Feedback"]."', '".$row_result["Pancard"]."',  '".$row_result["No_of_Banks"]."', '".$row_result["Pancard_No"]."', '".$Dateofallocation."','".$row_result["comment_section"]."', '".$row_result["Account_No"]."','".$Existing_Relationship."','".$cc_holder."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."')";
//echo "".$qry1."<br>";
				$result1=ExecQuery($qry1);
		}
       
        if($qry2=="Req_Loan_Against_Property")
			{
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	
			$Dateofallocation = $row_result["Allocation_Date"];
					
			$dob=$row_result["DOB"];

			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, pincode, property_value, loan_amount, Feedback, doe,add_comment, request_id) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Pincode"]."', '".$row_result["Property_Value"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$Dateofallocation."','".$row_result["comment_section"]."','".$row_result["Feedback_ID"]."')";
			//echo "".$qry1."<br>";
				$result1=ExecQuery($qry1);
		
		}

if( $qry2=="Req_Loan_Gold")
		{

	$qry1="insert into temp (session_id, name, email, city, city_other, mobile_number, net_salary, loan_amount, dob, doe) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["Email"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Loan_Amount"]."', '".$row_result["DOB"]."', '".$row_result["Allocation_Date"]."')";
			$result1=ExecQuery($qry1);

		}
		if($qry2=="Req_Loan_Education")
		{
			if($row_result["Course"]==2) { $Course="Post Graduation Courses";}
			if($row_result["Course"]==3) {$Course="Graduation Courses";}
			if($row_result["Course"]==4) {$Course="Other Courses";}
			if($row_result["Course"]=="") {$Course="";}

			if($row_result["Employment_Status"]==1) { $Employment_Status="Salaried";}
			if($row_result["Employment_Status"]==2) { $Employment_Status="Self Employed";}
			if($row_result["Employment_Status"]==3) { $Employment_Status="Not Earning";}
			if($row_result["Employment_Status"]==0) { $Employment_Status="";}

if($row_result["Country"]==1) {$Country="India";}
if($row_result["Country"]==2) {$Country="UK";}
if($row_result["Country"]==3) {$Country="USA";}
if($row_result["Country"]==4) {$Country="Other Country";}
if($row_result["Country"]==0) {$Country="";}

if($row_result["Residence_City"]=="Others" && strlen($row_result["Residence_City_Other"])>0)
			{
				$City=$row_result["Residence_City_Other"];
			}
			else
			{
				$City=$row_result["Residence_City"];
			}

			$qry1="insert into temp (session_id, name, email, city, city_other, mobile_number, emp_status, loan_amount, dob, doe,is_processed) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["Email"]."', '".$City."', '".$row_result["Residence_City_Other"]."', '".$row_result["Mobile_Number"]."', '".$Employment_Status."', '".$row_result["Loan_Amount"]."', '".$Course."', '".$row_result["Allocation_Date"]."','".$Country."')";
			$result1=ExecQuery($qry1);

		}
		
	}
if($qry2=="Req_Loan_Personal")
  //     if($qry2==1)
		{
			$keyFBidders = '';
		$bidderSql = "select Bidders_List.BidderID as BidderID from Bidders_List left join Bidders on Bidders.BidderID= Bidders_List.BidderID and Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 where (Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 and Bidders.Define_PrePost='PostPaid')";
	
	
	$bidderQuery = ExecQuery($bidderSql);
	$numbidder = mysql_num_rows($bidderQuery);
	$arrBidderID = '';
	for($i=0;$i<$numbidder;$i++)
	{
		$BidID  = mysql_result($bidderQuery,$i,'BidderID');
		$arrBidderID[] = $BidID;
	}

	//print_r($arrBidderID);
	$keyFBidders = array_search($_SESSION['BidderID'], $arrBidderID);
	if(strlen($keyFBidders)>0)
	{
			$qry="select unique_id, name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments, apt_dt as AppointmentTime, docs as DocsforAppointment, address_apt as AppointmentAddress, add_comment,doe from temp where session_id='".$session_id."' order by doe DESC ";
	
	
	}	
	else if($_SESSION['BidderID']==1023)
			{

			$qry="select unique_id, name, dob, emp_status, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, address_apt AS SalryDrawn, city AS City, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary, loan_any, emi_paid, is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit,  ip_address,bank_name AS PrimaryAcc , Documents AS AvailableDocuments,add_comment,doe,count_views AS HdfcEligibility, count_replies AS citiEligibility, is_modified AS BarclaysEligibility, car_model as TelecallerName, car_type as TeleCallerMobile, is_valid AS Surrogateexist , current_age as ExclusiveLead, changeapp_time as Appointment from temp where session_id='".$session_id."' order by doe DESC ";
			}	
	else if($_SESSION['BidderID']==996 || $_SESSION['BidderID']==997 || $_SESSION['BidderID']==998 || $_SESSION['BidderID']==1000 || $_SESSION['BidderID']==1012 || $_SESSION['BidderID']==1015 || $_SESSION['BidderID']==1037 || $_SESSION['BidderID']==1050)
			{

			$qry="select unique_id, name, dob, email, mobile_number,emp_status, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, address_apt AS SalryDrawn, city AS City, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary, loan_any, emi_paid, is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit,  ip_address,bank_name AS PrimaryAcc , Documents AS AvailableDocuments,add_comment,doe,count_views AS HdfcEligibility, count_replies AS citiEligibility, is_modified AS BarclaysEligibility, car_model as TelecallerName, car_type as TeleCallerMobile, is_valid AS Surrogateexist , current_age as ExclusiveLead, changeapp_time as Appointment from temp where session_id='".$session_id."' order by doe DESC ";
			}
		else if($_SESSION['BidderID']==1535 || $_SESSION['BidderID']==1536 || $_SESSION['BidderID']==1537 || $_SESSION['BidderID']==1538 || $_SESSION['BidderID']==1542 || $_SESSION['BidderID']==1139 || $_SESSION['BidderID']==1129 || $_SESSION['BidderID']==1130 || $_SESSION['BidderID']==1137 || $_SESSION['BidderID']==1140 || $_SESSION['BidderID']==1244 || $_SESSION['BidderID']==1249 )
		{
				
$qry="select unique_id, name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,doe,employer AS Eligibility, plan_interested AS Interested, descr AS PostLoginStat, login_date AS LastUpdateOn  from temp where session_id='".$session_id."' order by doe DESC ";			
}
else if($_SESSION['BidderID']==1150)
			{
	$qry="select unique_id, name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment AS Comments, referred_page AS Remarks,doe,employer AS Eligibility, plan_interested AS Interested, descr AS PostLoginStat, login_date AS LastUpdateOn  from temp where session_id='".$session_id."' order by doe DESC ";	
	
			}
			else if($_SESSION['BidderID']==1728)
			{
					$qry="select unique_id, name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,residence_address AS LowestRateFrmOtherBank, doe  from temp where session_id='".$session_id."' order by doe DESC ";
			}
			else if($_SESSION['BidderID']==2454)
			{
				$qry="select unique_id, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,add_comment,doe,property_type AS CompanyType, referred_page AS AgentName  from temp where session_id='".$session_id."' order by doe DESC ";

			}
			else
			{
					$qry="select unique_id, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,add_comment,doe,property_type AS CompanyType  from temp where session_id='".$session_id."' order by doe DESC ";
			}

		}
if($qry2=="Req_Loan_Home")
	// if($qry2==2)
         	{
				if($_SESSION['BidderID']==1329)
				{
			$qry="select request_id AS ReqID,name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
				}
else if($_SESSION['BidderID']==1727 || $_SESSION['BidderID']==1779 || $_SESSION['BidderID']==2118 || $_SESSION['BidderID']==2119 || $_SESSION['BidderID']==2120 || $_SESSION['BidderID']==2121 || $_SESSION['BidderID']==2122 || $_SESSION['BidderID']==2123 || $_SESSION['BidderID']==2124)
				{

			$qry="select name AS CUSTOMER_NAME, total_exp AS PRODUCT,city AS CITY, residence_address AS CONTACT_ADDRESS, mobile_number AS MOBILE_NO, email AS EMAIL_ID, bank_name AS LEAD_GENERATION_MODE, emp_status AS PROFESSION, add_comment AS REMARKS,loan_amount AS ESTIMATED_LOAN_AMOUNT, descr AS REMARKS from temp where session_id='".$session_id."' order by doe DESC";
				}
else if($_SESSION['BidderID']==1583 || $_SESSION['BidderID']==1584)
				{
$qry="select  name AS Name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, net_salary AS NetSslary, descr AS PropertyType, loan_amount AS LoanAmt, Feedback, property_identified AS PropertyIdentified, property_loc AS PropertyLoc, property_value AS PropertyValue, residence_address AS ResiAddress, loan_time AS LoanTime, doe AS DateOfEntry, add_comment AS Comments, employer AS ExecutiveName from temp where session_id='".$session_id."' order by doe DESC";
				}
				else
				{
			$qry="select  name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
				}
		}
	if($qry2=="Req_Credit_Card")
       	{
			if($_SESSION['BidderID']==904 || $_SESSION['BidderID']==903)
			{
			$qry="select  name, dob, email, emp_status, c_name, city, city_other,residence_address,property_value As OfficeAddress, mobile_number, net_salary, descr,  cc_holder, Feedback, pancard, property_type As PancardNumber, no_of_banks, card_vintage, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
			}
			else if($_SESSION['BidderID']==2009)
			{
				$qry="select  name, dob, email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS Mobile, std_code AS StdCode, landline AS Landline,net_salary AS AnnualIncome, cc_holder AS CardHolder,descr AS CardOpted, Feedback,doe AS DateOfEntry, bank_name AS ExistRelation, employer AS AccountNo from temp where session_id='".$session_id."' order by doe DESC";
			}
			else
			{
				$qry="select  name, dob, email, emp_status, c_name, city, city_other, mobile_number, std_code AS StdCode, landline AS Landline, net_salary, cc_holder, Feedback, pancard, property_type As PancardNumber, no_of_banks, card_vintage, doe, add_comment, employer AS AccountNo  from temp where session_id='".$session_id."' order by doe DESC";
			}
			//echo "hello".$qry."<br>";
		
		}

	if($qry2=="Req_Loan_Against_Property")
        // if($qry2==5)
		{
			if($_SESSION['BidderID']==2245)
			{
		$qry="select request_id AS RequestID, name, dob, email, mobile_number, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
			}
			else
			{
		$qry="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
			}
	
		}
	if($qry2=="Req_Loan_Car")
      	{
			if($_SESSION['BidderID']==1825)
			{
				$qry="select  name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_make AS CarMake, car_model CarModel, is_processed AS CarType ,loan_amount AS LoanAmount, pincode AS Pincode, Feedback, doe AS DateOfEntry, add_comment AS Comment, descr AS CarBooked,pancard AS AccountNo,referred_page AS SpecialPreference from temp where session_id='".$session_id."' order by doe DESC";

			}
			else
			{
				$qry="select  name, dob, email, emp_status, c_name AS CompanyName, city, city_other, mobile_number, net_salary, car_make, car_model, is_processed AS CarType ,loan_amount, pincode, Feedback, contact_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";

			}
		
		}
		if($qry2=="Req_Business_Loan")
           //if($qry2==4)
		{
		$qry="select  name, email, city, city_other, mobile_number, net_salary, industry, constitution, year_of_establishment, loan_amount, pincode, doe AS DateOfEntry,cc_holder  As creditcardholder, no_of_banks, loan_any, emi_paid , annual_income,residential_status,marital_status As OfficeStatus from temp where session_id='".$session_id."' order by doe DESC";
		}
if($qry2=="Req_Loan_Gold")
{
	$qry="select  name AS Name, email AS Email, dob AS DOB, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, loan_amount AS LoanAmount, doe AS DateOfEntry from temp where session_id='".$session_id."' order by doe DESC";
}
if($qry2=="Req_Loan_Education")
{
	$qry="select name AS Name, email AS Email, mobile_number AS Mobile_No, city AS City, is_processed AS Country_of_Interest, dob AS Course_of_Interest, loan_amount AS Require_Education_Loan, emp_status AS Income_Status, doe AS DateOfEntry from temp where session_id='".$session_id."' order by doe DESC";
}

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	//echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	$CountInsertSql = "insert into BidderDownloadCount (BidderID, BidderName, BidderProduct, BidderTable, BidderSession, NoofRecords, Dated, MinDate, MaxDate) values ('".$_SESSION['BidderID']."', '".$_SESSION['UName']."', '".$_SESSION['ReplyType']."', '".$qry2."', '".$session_id."',  '".$num_rows."', Now(), '".$mindate."', '".$maxdate."') ";
	
	$CountInsertQuery  = ExecQuery($CountInsertSql);
	
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}
	
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $data .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	  $data = str_replace("\r", "", $data);
	
	
	# Nice to let someone know that the search came up empty.
	# Otherwise only the column name headers will be output to Excel.
	if ($data == "") {
	  $data = "\nno matching records found\n";
	}
	
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/octet-stream");
	
	# replace excelfile.xls with whatever you want the filename to default to
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data; 
	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
	//*/

?>
