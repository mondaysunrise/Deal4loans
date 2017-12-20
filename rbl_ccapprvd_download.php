<?
session_start();	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];

function DetermineAgeGETDOB ($YYYYMMDD_In)
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

    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	$Dated = ExactServerdate();
		
	$qry1=str_replace("\'", "'", $qry1);

    $exclusiveLead = '';
	
	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
	
	while($cntr<count($row_result))
        {
					$exclusiveLead = '';
				
				if($row_result[$cntr]["Bidder_Count"]==1)
				{				
				$exclusiveLead = "Exclusive Lead";
				}
		
			if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
				$getDOB = str_replace("-","", $row_result[$cntr]["DOB"]);
				$age = DetermineAgeGETDOB($getDOB);	
			$Dateofallocation = $row_result[$cntr]["Allocation_Date"];			
			if($row_result[$cntr]["Existing_Relationship"]==1)
				{
					$Existing_Relationship="Account Holder";
				}
				if($row_result[$cntr]["Existing_Relationship"]==2)
				{
					$Existing_Relationship="Loan Running";
				}
				if($row_result[$cntr]["Existing_Relationship"]==3)
				{
					$Existing_Relationship="Credit Card Holder";
				}
				if($row_result[$cntr]["Existing_Relationship"]==0)
				{
					$Existing_Relationship="";
				}

			$dob=$row_result[$cntr]["DOB"];
			$arrcardname="";
$cardname="";
	if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }

		 $applied_card_name = $row_result[$cntr]["applied_card_name"];
		$arrcardname=explode(",",$applied_card_name);
		$findme   = 'RBL';
		for($ar=0;$ar<count($arrcardname);$ar++)
			{
				$pos = strpos($arrcardname[$ar], $findme);	
				if(strlen($pos)>0)
				{
					$cardname=$arrcardname[$ar];
				}
			}
		
		$DATEOFCALLING = date("d-M-y", strtotime($Dateofallocation));
		
		$tugetdetails ="Select * from  rbl_creditcard where cc_requestID=".$row_result[$cntr]["RequestID"];
		 list($recordcountRbl,$rowtu)=MainselectfuncNew($tugetdetails,$array = array());
		$i=0;
		$appointment_address=$rowtu[$i]["rblappointment_address"];
			

		$dataInsert = array("session_id"=>$session_id, "doe"=>$DATEOFCALLING, "city"=>$row_result[$cntr]["City"], "name"=>$row_result[$cntr]["Name"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "is_modified"=>$rowtu[$i]["ReferenceCode"], "product_type"=>$cardname, "landline"=>$row_result[$cntr]["Landline"], "residence_address"=>$appointment_address, "pincode"=>$row_result[$cntr]["Pincode"], "c_name"=>$row_result[$cntr]["Company_Name"], " email"=>$row_result[$cntr]["Email"], "apt_dt"=>$rowtu[$i]["rblappointment_date"], "loan_time"=>$rowtu[$i]["rblappointment_time"], "Documents"=>$rowtu[$i]["rbldocuments"], "address_apt"=>$rowtu[$i]["rblappointment_place"], "dob"=>$age, "net_salary"=>$row_result[$cntr]["Net_Salary"], "add_comment"=>$row_result[$cntr]["Add_Comment"], "referred_page"=>'Robin Singh');
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);


		
		$result1=ExecQuery($qry1);
	 $cntr=$cntr+1; }			
		
$qry="select doe AS DATEOFCALLING, city AS City, name AS Name, mobile_number AS MobileNo, is_modified  AS ReferenceCode, product_type AS CardName, landline AS Landline, residence_address AS AppointmentAddress, pincode AS Pincode, c_name AS CompanyName,   email AS Email, apt_dt AS ApptDate, loan_time AS ApptTime, Documents, address_apt AS ApptPlace, dob AS Age,net_salary AS AnnualIncome, add_comment AS Comments, referred_page AS telacller from temp where session_id='".$session_id."' order by doe DESC";

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	
	 list($num_rows,$row)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
	
	$result = ExecQuery($qry);
	echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	
	
	
	
	$dataInsert = array("BidderID"=>$_SESSION['BidderID'], "BidderName"=>$_SESSION['UName'], "BidderProduct"=>$_SESSION['ReplyType'], "BidderTable"=>$qry2, "BidderSession"=>$session_id, "NoofRecords"=>$num_rows, "Dated"=>$Dated, "MinDate"=>$mindate, "MaxDate"=>$maxdate);
$table = 'BidderDownloadCount';
$insert = Maininsertfunc ($table, $dataInsert);
  
	
	
	
	 $field_names = getFieldNames($qry);
	
	
for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
	
	for($dnld=0;$dnld<count($row);$dnld++)
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
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data;	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
?>
