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
	
 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{

		if( $qry2=="Req_Loan_Personal")
        //      if( $qry2==1)
		{
			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
		if($row_result[$i]["Residential_Status"]==0) { $residential_status="not available"; } 
		if($row_result[$i]["Residential_Status"]==1) { $residential_status="Owned By Parent/Sibling"; }  if($row_result[$i]["Residential_Status"]==2) { $residential_status="Rented Staying alone"; } if($row_result[$i]["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result[$i]["Residential_Status"]==4) { $residential_status="Owned By Self/Spouse"; }  
			if($row_result[$i]["Residential_Status"]==5) { $residential_status="Rented - With Family"; }  
			if($row_result[$i]["Residential_Status"]==6) { $residential_status="Rented - With Friends"; }  
			if($row_result[$i]["Residential_Status"]==7) { $residential_status="Paying Guest"; }  
			if($row_result[$i]["Residential_Status"]==8) { $residential_status="Hostel"; }  
			
			if($row_result[$i]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$i]["CC_Holder"]==0) { $cc_holder="No"; }

			
			if($row_result[$i]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result[$i]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result[$i]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result[$i]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result[$i]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result[$i]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result[$i]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result[$i]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
			if($row_result[$i]["Salary_Drawn"]==0) { $Salary_Drawn="Not available"; }
		if($row_result[$i]["Salary_Drawn"]==1) { $Salary_Drawn="Cash"; }
		if($row_result[$i]["Salary_Drawn"]==2) { $Salary_Drawn="Cheque"; }
		if($row_result[$i]["Salary_Drawn"]==3) { $Salary_Drawn="Account Transfer"; }

			if($row_result[$i]["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result[$i]["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result[$i]["Dated"];
			}
			$allocatebidderID= $row_result[$i]["BidderID"];
			$dob_loan=$row_result[$i]["dob"];
			if(strlen($dob_loan)>0)
			{
			$dob=$dob_loan;} else { $dob=$row_result[$i]["DOB"];}
					
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'year_in_comp'=>$row_result[$i]['Years_In_Company'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'marital_status'=>$marital_status, 'residential_status'=>$residential_status, 'vehicle_owned'=>$vehicle_owned, 'loan_any'=>$row_result[$i]['Loan_Any'], 'emi_paid'=>$emi_paid, 'cc_holder'=>$cc_holder, 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'count_views'=>$Salary_Drawn, 'count_replies'=>$row_result[$i]['Primary_Acc'], 'is_modified'=>$row_result[$i]['IsModified'], 'is_processed'=>$row_result[$i]['PL_EMI_Amt'], 'pincode'=>$row_result[$i]['Pincode'], 'doe'=>$Dateofallocation, 'card_vintage'=>$card_vintage, 'card_limit'=>$row_result[$i]['Card_Limit'], 'ip_address'=>$row_result[$i]['IP_Address'], 'add_comment'=>$row_result[$i]['comment_section'], 'Documents'=>$row_result[$i]['identification_proof'], 'bank_name'=>$allocatebidderID);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
		}

		if($qry2=="Req_Loan_Home")
          //     if($qry2==2)
		{
			if($row_result[$i]["Property_Identified"]==0){ $property_identified="No";}
			elseif($row_result[$i]["Property_Identified"]==1) { $property_identified="Yes";}
			else { $property_identified="";}

			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result[$i]["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result[$i]["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result[$i]["Dated"];
			}
			
			
			$dob_loan=$row_result[$i]["dob"];
			if(strlen($dob_loan)>0)
			{
			$dob=$dob_loan;} else { $dob=$row_result[$i]["DOB"];}
					
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'pincode'=>$row_result[$i]['Pincode'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'descr'=>$row_result[$i]['Add_Comment'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'budget'=>$row_result[$i]['Budget'], 'residence_address'=>$row_result[$i]['Residence_Address'], 'property_identified'=>$property_identified, 'property_loc'=>$row_result[$i]['Property_Loc'], 'loan_time'=>$row_result[$i]['Loan_Time'], 'doe'=>$Dateofallocation, 'add_comment'=>$row_result[$i]['comment_section']);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
		}

		
        if($qry2=="Req_Loan_Against_Property")
			{
			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result[$i]["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result[$i]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$i]["Residential_Status"]==3) { $residential_status="Company Provided"; }
			 if($row_result[$i]["Property_Type"]==0) { $property_type="Commercial office Space"; } 
			if($row_result[$i]["Property_Type"]==1) { $property_type="Appartment"; }  if($row_result[$i]["Property_Type"]==2) { $property_type="Industrial House"; } if($row_result[$i]["Property_Type"]==3) { $property_type="Showroom"; }
			if($row_result[$i]["Property_Type"]==4) { $property_type="Factory"; }  if($row_result[$i]["Property_Type"]==5) { $property_type="Plot"; } if($row_result[$i]["Property_Type"]==6) { $property_type="Godown"; }
			if($row_result[$i]["Property_Type"]==7) { $property_type="Bungalow"; }
			$dob_loan=$row_result[$i]["dob"];
			
			if($row_result[$i]["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result[$i]["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result[$i]["Dated"];
			}
			
			
			if(strlen($dob_loan)>0)
			{
				$dob=$dob_loan;} else { $dob=$row_result[$i]["DOB"];}
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'residential_status'=>$residential_status, 'pincode'=>$row_result[$i]['Pincode'], 'descr'=>$row_result[$i]['Descr'], 'property_type'=>$property_type, 'property_value'=>$row_result[$i]['Property_Value'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'count_views'=>$row_result[$i]['Count_Views'], 'count_replies'=>$row_result[$i]['Count_Replies'], 'is_modified'=>$row_result[$i]['IsModified'], 'is_processed'=>$row_result[$i]['IsProcessed'], 'doe'=>$Dateofallocation, 'add_comment'=>$row_result[$i]['comment_section']);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
		}
	}
if($qry2=="Req_Loan_Personal")
  //     if($qry2==1)
		{
			if($_SESSION['BidderID']==1023)
			{
				$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status AS EmpStat, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, count_views AS SalDrawn, city, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary AS Income, loan_any AS LoanRunning, emi_paid AS EMIPaid ,is_processed AS EMI_Amt, count_replies AS PrimaryAcc, loan_amount AS LoanAmt, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,doe,bank_name AS BIdderID   from temp where session_id='".$session_id."' order by doe DESC ";
			}
			else
			{
				$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status AS EmpStat, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, count_views AS SalDrawn, city, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary AS Income, loan_any AS LoanRunning, emi_paid AS EMIPaid ,is_processed AS EMI_Amt, count_replies AS PrimaryAcc, loan_amount AS LoanAmt, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,doe  from temp where session_id='".$session_id."' order by doe DESC ";
			}
		
		}
if($qry2=="Req_Loan_Home")
	// if($qry2==2)
         	{
			$qry="select name, dob, email, std_code, landline, std_code_o, landline_o, mobile_number, emp_status, c_name, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc, budget, residence_address, loan_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
		}
	
	if($qry2=="Req_Loan_Against_Property")
        // if($qry2==5)
		{
		$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
	
		}
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());

	 $field_names = getFieldNames($qry);
	
	
	for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
	
	for($dnld=0;$dnld<count($myrow);$dnld++)
	{
		$myrowarr=$myrow[$dnld];
		
		  $line = '';
		  foreach($myrowarr as $value){	
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
	header("Content-Disposition: attachment; filename=data.ods");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data; 
	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	Maindeletefunc($qry1,$array = array());
	//*/

?>
