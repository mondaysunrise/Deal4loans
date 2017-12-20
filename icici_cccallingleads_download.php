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
	$qry1=str_replace("\'", "'", $qry1);
    $exclusiveLead = '';
	$RuleStatus="";
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
				$getDOB = str_replace("-","", $row_result[$i]["DOB"]);
				$age = DetermineAgeGETDOB($getDOB);	
			$Dateofallocation = $row_result[$i]["Allocation_Date"];			
			if($row_result[$i]["Existing_Relationship"]==1)
				{
					$Existing_Relationship="Account Holder";
				}
				if($row_result[$i]["Existing_Relationship"]==2)
				{
					$Existing_Relationship="Loan Running";
				}
				if($row_result[$i]["Existing_Relationship"]==3)
				{
					$Existing_Relationship="Credit Card Holder";
				}
				if($row_result[$i]["Existing_Relationship"]==0)
				{
					$Existing_Relationship="";
				}

			$dob=$row_result[$i]["DOB"];
			$arrcardname="";
$cardname="";
	if($row_result[$i]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$i]["CC_Holder"]==0) { $cc_holder="No"; }

		 $applied_card_name = $row_result[$i]["applied_card_name"];
		$arrcardname=explode(",",$applied_card_name);
		$findme   = 'ICICI';
		for($ar=0;$ar<count($arrcardname);$ar++)
			{
				$pos = strpos($arrcardname[$ar], $findme);	
				if(strlen($pos)>0)
				{
					$cardname=$arrcardname[$ar];
				}
			}
		
		if(strlen(strpos($cardname, "ICICI Bank Coral Credit Card")) > 0)
		{
			$product_code="Coral JF";
		}
		elseif(strlen(strpos($cardname, "ICICI Bank HPCL coral Credit Card")) > 0)
		{
			$product_code="HPCL TF";
		}
		elseif(strlen(strpos($cardname, "ICICI Bank Platinum Chip Credit Card")) > 0)
		{
			$product_code="CHIP CARD";
		}
			
		$tugetdetailsvyfb ="Select * from icicilms_allocation where (cc_requestid=".$row_result[$i]["UserID"].") order by iciciallocateid DESC";
		 list($rcount1,$tugetdetailsvyfbresult)=Mainselectfunc($tugetdetailsvyfb,$array = array());

		$DATEOFCALLING = $row_result[$i]["Updated_Date"];
		$current_age = date("M_y", strtotime($Dateofallocation));

		$tugetdetails ="Select * from credit_card_cibil_check where (RequestID=".$row_result[$i]["RequestID"].") order by cibilchkid DESC";
		 list($rcount2,$tugetdetailsresult)=Mainselectfunc($tugetdetails,$array = array());

		$tugetstat ="Select flag,RuleStatus from credit_card_cibil_check where (RequestID=".$row_result[$i]["RequestID"]." and flag=1)";
		 list($rcount3,$tugetstatresult)=Mainselectfunc($tugetstat,$array = array());
		$RuleStatus = $rowtustat["RuleStatus"];
				
		$residenceaddress="";
		$officeaddress="";
		$residenceaddress = $rowtu["Address"];
		if($rowtu["appointment_place"]=="Office")
		{
			$officeaddress=$rowtu["appointment_address"];
		}
		else
		{
			if(strlen($officeaddress)>5)
			{
				$residenceaddress = $rowtu["Address"];
			}
			else
			{
			$residenceaddress=$rowtu["appointment_address"];
			}
		}
		if($row_result[$i]["TelecallerID"]==77)
		{
			$telecallernme= "Telecaller 1";
		}
		elseif($row_result[$i]["TelecallerID"]==78)
		{
			$telecallernme= "Telecaller 2";
		}
		elseif($row_result[$i]["TelecallerID"]==79)
		{
			$telecallernme= "Telecaller 3";
		}

		$dataInsert = array('session_id'=>$session_id, 'doe'=>$DATEOFCALLING, 'city'=>$row_result[$i]['City'], 'name'=>$row_result[$i]['Name'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'is_modified'=>$rowtu["ApplicationID"], 'product_type'=>$cardname, 'landline'=>$row_result[$i]['Landline'], 'residence_address'=>$residenceaddress, 'pincode'=>$row_result[$i]['Pincode'], 'landline_o'=>$row_result[$i]['Landline_O'], 'c_name'=>$row_result[$i]['Company_Name'], 'residential_status'=>$officeaddress, 'vehicle_owned'=>$row_result[$i]['Pincode'], 'email'=>$row_result[$i]['Email'], 'apt_dt'=>$rowtu["appointment_date"], 'loan_time'=>$rowtu["appointment_time"], 'Documents'=>$rowtu["documents"], 'address_apt'=>$rowtu["appointment_place"], 'dob'=>$age, 'net_salary'=>$row_result[$i]['Net_Salary'], 'add_comment'=>$row_result[$i]['Add_Comment'], 'property_value'=>$product_code, 'count_views'=>$row_result[$i]['RequestID'], 'referred_page'=>$telecallernme, 'current_age'=>$row_result[$i]['Feedback'], 'constitution'=>$row_result[$i]['verifier_feedback'], 'plan_interested'=>$RuleStatus);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);	
	}			
		
$qry="select doe AS DateOFCalling, city AS City, name AS Name,is_modified AS APPID, product_type AS CardName, landline AS Landline, residence_address AS ResidenceAddress, pincode AS Pincode, landline_o AS LandlineOffNo, c_name AS CompanyName, residential_status AS OfficeAddress, vehicle_owned AS Pincode , apt_dt AS ApptDate, loan_time AS ApptTime, Documents, address_apt AS ApptPlace, dob AS Age, 
			net_salary AS Income, add_comment AS Comments, property_value AS ProductCode, referred_page AS TeleCaller,current_age AS telecallerfeedbk, constitution AS VerifierFeedback, plan_interested AS AutoTUCheck  from temp where session_id='".$session_id."' order by doe DESC";

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());
	$dataBidder = array('BidderID'=>$_SESSION['BidderID'], 'BidderName'=>$_SESSION['UName'], 'BidderProduct'=>$_SESSION['ReplyType'], 'BidderTable'=>$qry2, 'BidderSession'=>$session_id, 'NoofRecords'=>$num_rows, 'Dated'=>$Dated, 'MinDate'=>$mindate, 'MaxDate'=>$maxdate);
    Maininsertfunc ("BidderDownloadCount", $dataBidder);	
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
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data;	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	Maindeletefunc($qry1,$array = array());
?>
