<?
session_start();	
//include ("includes/check_login.php");
	//require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	//echo $session_id;
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
	//$value=explode(",", $_POST["qry2"]);
       // $qry2=$value[1];
//echo "gff=".$qry2;
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
	$search_result=ExecQuery($qry1);
      

	
	while($row_result=mysql_fetch_array($search_result))
	{

		if( $qry2=="Req_Loan_Personal")
        //      if( $qry2==1)
		{
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result["Marital_Status"]==1) { $marital_status="Single"; } else { $marital_status="Married"; }
			if($row_result["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
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

			//$Dateofallocation = $row_result["Allocation_Date"];
			
			if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result["Dated"];
			}
			//echo $Dateofallocation;
			//exit();

			$dob_loan=$row_result["dob"];
			if(strlen($dob_loan)>0)
			{
			$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["IsProcessed"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."')";
			
			$result1=ExecQuery($qry1);
			//echo "".$qry1."<br>";
		
		
		}

		if($qry2=="Req_Loan_Home")
          //     if($qry2==2)
		{
			if($row_result["Property_Identified"]==0){ $property_identified="No";}
			elseif($row_result["Property_Identified"]==1) { $property_identified="Yes";}
			else { $property_identified="";}

			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result["Dated"];
			}
			
			
			$dob_loan=$row_result["dob"];
			if(strlen($dob_loan)>0)
			{
			$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, pincode, total_exp, std_code, landline, std_code_o, landline_o, mobile_number, net_salary, descr, loan_amount, Feedback, budget, residence_address, property_identified, property_loc, loan_time, doe) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Pincode"]."', '".$row_result["Total_Experience"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."',    '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Add_Comment"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Budget"]."', '".$row_result["Residence_Address"]."', '".$property_identified."', '".$row_result["Property_Loc"]."', '".$row_result["Loan_Time"]."', '".$Dateofallocation."')";
			//echo "".$qry1."<br>";
				$result1=ExecQuery($qry1);
		}

		if($qry2=="Req_Loan_Car")
        //       if($qry2==3)
		{
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result["Car_Make"]==1) { $car_make="Chevrolet"; }  
			if($row_result["Car_Make"]==2) { $car_make="Fiat"; }  
			if($row_result["Car_Make"]==3) { $car_make="Ford"; }  
			if($row_result["Car_Make"]==4) { $car_make="General Motors"; }  
			if($row_result["Car_Make"]==5) { $car_make="Hindustan Motors"; }  
			if($row_result["Car_Make"]==6) {$car_make="Honda"; }  
			if($row_result["Car_Make"]==7) {$car_make="Hyundai"; }  
			if($row_result["Car_Make"]==8) {$car_make="Lexus"; }  
			if($row_result["Car_Make"]==9) {$car_make="Mahindra & Mahindra"; }  
			if($row_result["Car_Make"]==10) {$car_make="Maruti Udyog Ltd"; }  
			if($row_result["Car_Make"]==11) {$car_make="Mercedes Benz"; }  	if($row_result["Car_Make"]==12) {$car_make="Nissan India"; }  		if($row_result["Car_Make"]==14) {$car_make="Porsche"; }  
			if($row_result["Car_Make"]==15) {$car_make="Skoda Auto"; }  
			if($row_result["Car_Make"]==16) {$car_make="Tata Motors"; }  
			if($row_result["Car_Make"]==17) {$car_make="Toyota Kirlosker"; }
			if($row_result["Car_Make"]==18) {$car_make="Others"; }  
			$dob_loan=$row_result["dob"];
			
			if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result["Dated"];
			}
			
			if(strlen($dob_loan)>0)
			{
			$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, std_code, landline, mobile_number, std_code_o, landline_o, net_salary, car_make, car_model, loan_amount, pincode, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$car_make."', '".$row_result["Car_Model"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["Feedback"]."', '".$row_result["Contact_Time"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["IsProcessed"]."', '".$Dateofallocation."')";
			//echo "".$qry1."<br>";
			$result1=ExecQuery($qry1);

		}

       if($qry2=="Req_Credit_Card")
			{
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result["Card_Vintage"]==1)
		{	$card_vintage="Less than 6 months";}
		if($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		if($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		if($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
			if($row_result["CC_Holder"]==0) { $cc_holder="No"; } 
			if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }
			if($row_result["Vehicle_Owned"]==0) { $vehicle_owned="2 Wheeler"; } 
			if($row_result["Vehicle_Owned"]==1) { $vehicle_owned="4 Wheeler"; } 
			if($row_result["Vehicle_Owned"]==2) { $vehicle_owned="Other"; } 
			$dob_loan=$row_result["dob"];
			
			if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result["Dated"];
			}
			
			if(strlen($dob_loan)>0)
			{
			$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, total_exp, mobile_number, std_code, landline, std_code_o, landline_o , net_salary, descr, vehicle_owned, cc_holder, Feedback, count_views, count_replies, is_modified, is_processed, pancard, no_of_banks, card_vintage, doe) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$row_result["Descr"]."', '".$vehicle_owned."', '".$cc_holder."', '".$row_result["Feedback"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["IsProcessed"]."', '".$row_result["Pancard"]."',  '".$row_result["No_of_Banks"]."', '".$card_vintage."', '".$Dateofallocation."')";
//echo "".$qry1."<br>";
				$result1=ExecQuery($qry1);
		}
        
        if($qry2=="Req_Loan_Against_Property")
			{
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
			 if($row_result["Property_Type"]==0) { $property_type="Commercial office Space"; } 
			if($row_result["Property_Type"]==1) { $property_type="Appartment"; }  if($row_result["Property_Type"]==2) { $property_type="Industrial House"; } if($row_result["Property_Type"]==3) { $property_type="Showroom"; }
			if($row_result["Property_Type"]==4) { $property_type="Factory"; }  if($row_result["Property_Type"]==5) { $property_type="Plot"; } if($row_result["Property_Type"]==6) { $property_type="Godown"; }
			if($row_result["Property_Type"]==7) { $property_type="Bungalow"; }
			$dob_loan=$row_result["dob"];
			
			if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result["Dated"];
			}
			
			
			if(strlen($dob_loan)>0)
			{
				$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code"]."',  '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Pincode"]."', '".$row_result["Descr"]."', '".$property_type."', '".$row_result["Property_Value"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["IsProcessed"]."', '".$Dateofallocation."')";
			//echo "".$qry1."<br>";
				$result1=ExecQuery($qry1);
		
		}

		if( $qry2=="Req_Business_Loan")
        //      if( $qry2==1)
		{
			if($row_result["Loan_Any"]==0) { $loan_any="N/A"; } if($row_result["Loan_Any"]==1) { $loan_any="Car Loan"; } if($row_result["Loan_Any"]==2) { $loan_any="Home Loan"; } if($row_result["Loan_Any"]==3) { $loan_any="Personal Loan"; } if($row_result["Loan_Any"]==4) { $loan_any="Other"; }
		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
		if($row_result["Card_Vintage"]==1)
		{	$card_vintage="Less than 6 months";}
		if($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		if($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		if($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		if($row_result["Annual_Turnover"]==1){ $annual_turnover="Below 25 Lacs";}
		elseif($row_result["Annual_Turnover"]==2){ $annual_turnover="25-50 Lacs";}
		elseif($row_result["Annual_Turnover"]==3){ $annual_turnover="50-75 Lacs";}
		elseif($row_result["Annual_Turnover"]==4){ $annual_turnover="75-1 Crore";}
		elseif($row_result["Annual_Turnover"]==5){ $annual_turnover="1-1.25 crore";}
		elseif($row_result["Annual_Turnover"]==6){ $annual_turnover="1.25 cr& above";}
		else {$annual_turnover=""; }

if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result["Dated"];
			}

		$qry1="insert into temp (session_id, name, email, city, city_other, mobile_number, net_salary, industry, constitution, year_of_establishment, loan_amount, pincode, doe, cc_holder, card_vintage, no_of_banks, loan_any, emi_paid, annual_income ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["Email"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Industry"]."', '".$row_result["Constitution"]."', '".$row_result["Year_Of_Establishment"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$cc_holder."','".$card_vintage."', '".$row_result["CC_Bank"]."', '".$loan_any."', '".$row_result["EMI_Paid"]."', '".$annual_turnover."' )";
			$result1=ExecQuery($qry1);
			//echo "".$qry1."<br>";
		
		
		}


	}
if($qry2=="Req_Loan_Personal")
  //     if($qry2==1)
		{
		$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid, loan_amount, Feedback, card_vintage, card_limit, doe from temp where session_id='".$session_id."' order by doe DESC ";
		}
if($qry2=="Req_Loan_Home")
	// if($qry2==2)
         	{
			$qry="select name, dob, email, std_code, landline, std_code_o, landline_o, mobile_number, emp_status, c_name, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc, budget, residence_address, loan_time, doe from temp where session_id='".$session_id."' order by doe DESC";
		}
	if($qry2=="Req_Credit_Card")
        //   if($qry2==3)
		{
			$qry="select  name, dob, email, emp_status, c_name, city, city_other, total_exp, mobile_number, std_code, landline, std_code_o, landline_o , net_salary, descr, vehicle_owned, cc_holder, Feedback, pancard, no_of_banks, card_vintage, doe from temp where session_id='".$session_id."' order by doe DESC";
		
		}

	if($qry2=="Req_Loan_Against_Property")
        // if($qry2==5)
		{
		$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, doe from temp where session_id='".$session_id."' order by doe DESC";
	
		}
	if($qry2=="Req_Loan_Car")
           //if($qry2==4)
		{
		$qry="select  name, dob, email, emp_status, c_name, city, city_other, std_code, landline, mobile_number, std_code_o, landline_o, net_salary, car_make, car_model, loan_amount, pincode, Feedback, contact_time, doe from temp where session_id='".$session_id."' order by doe DESC";
		}
		if($qry2=="Req_Business_Loan")
           //if($qry2==4)
		{
		$qry="select  name, email, city, city_other, mobile_number, net_salary, industry, constitution, year_of_establishment, loan_amount, pincode, doe AS DateOfEntry,cc_holder  As creditcardholder, no_of_banks, loan_any, emi_paid , annual_income from temp where session_id='".$session_id."' order by doe DESC";
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
	
//	echo $CountInsertSql;
	//exit();


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
