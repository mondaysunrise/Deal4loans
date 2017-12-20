<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

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

function retrivedataforICICI()
	{
	$session_id=session_id();
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$sms_senddate=date('Y-m-d',$tomorrow);
	$currentdate=date('Y-m-d');
	$min_date=$sms_senddate." 17:00:00";
	$max_date=$currentdate." 17:00:00";

	$citifinquery="SELECT *  FROM Req_Feedback_Bidder_CC,Req_Credit_Card  WHERE Req_Feedback_Bidder_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID in (3662,3663,3664,3665,3666,3778,3820,3821,3822,3823,4499,4500,4501,4502,4503) and Req_Feedback_Bidder_CC.Reply_Type=4  and Req_Feedback_Bidder_CC.Feedback_ID>=1469463 and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."') ";
		 list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
				$exclusiveLead = '';
				
				if($row_result[$i]["Bidder_Count"]==1)
				{				
				$exclusiveLead = "Exclusive Lead";
				}
		
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
			
		$DATEOFCALLING = date("d-M-y", strtotime($Dateofallocation));
		$current_age = date("M_y", strtotime($Dateofallocation));

		$tugetdetails ="Select * from credit_card_cibil_check where (RequestID=".$row_result[$i]["RequestID"]." and RuleStatus ='Approved') order by cibilchkid DESC";
	    list($turowcount,$turow)=Mainselectfunc($tugetdetails,$array = array());
		$TelecallerID = $rowtu["TelecallerID"];
		if($TelecallerID==77)
		{	$PboName="Mritunjay";		}
		elseif($TelecallerID==78)
		{ $PboName="suman ";	}
		elseif($TelecallerID==79)
		{ $PboName="Kuldeep";		}
		else
		{ $PboName="Robin Singh";		}

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

		$dataInsert = array('session_id'=>$session_id, 'doe'=>$DATEOFCALLING, 'current_age'=>$current_age, 'city'=>$row_result[$i]['City'], 'name'=>$row_result[$i]['Name'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'is_modified'=>$rowtu["ApplicationID"], 'product_type'=>$cardname, 'landline'=>$row_result[$i]['Landline'], 'residence_address'=>$residenceaddress, 'pincode'=>$row_result[$i]['Pincode'], 'landline_o'=>$row_result[$i]['Landline_O'], 'c_name'=>$row_result[$i]['Company_Name'], 'residential_status'=>$officeaddress, 'vehicle_owned'=>$row_result[$i]['Pincode'], 'email'=>$row_result[$i]['Email'], 'apt_dt'=>$rowtu["appointment_date"], 'loan_time'=>$rowtu["appointment_time"], 'Documents'=>$rowtu["documents"], 'address_apt'=>$rowtu["appointment_place"], 'dob'=>$age, 'net_salary'=>$row_result[$i]['Net_Salary'], 'add_comment'=>$row_result[$i]['Add_Comment'], 'constitution'=>'Deal4loans', 'source'=>'D4L', 'is_processed'=>'Confirmed', 'car_make'=>'', 'car_type'=>'', 'car_model'=>'', 'loan_tenure'=>'', 'property_value'=>$product_code, 'count_views'=>$row_result[$i]['RequestID'], 'referred_page'=>'PboName', 'property_type'=>'Balbir Singh', 'plan_interested'=>'Neha Gupta');
	$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	

		 }	
		
	$qry="select doe AS DATEOFCALLING, current_age AS CallingMonth, city AS CityName, name ASCustomerName, mobile_number AS MobileNo, constitution AS CampaignName,source AS Source1, car_make AS Source2, car_type AS PqLeads, car_model AS Source3, is_modified AS CibilID, loan_tenure AS SFAID, product_type AS PRODUCT, property_value AS ProductCode, landline AS LandlineNo, residence_address AS ResiAddress, pincode AS ResiPincode, landline_o AS OfficeLandLineNumber, c_name AS CompanyName, residential_status AS OffAddress, vehicle_owned AS OffPincode, email AS EmailID, apt_dt AS DateOfAppointment, loan_time AS TIME, Documents AS DocumentType, address_apt AS AppointmentPlace, referred_page AS PboName, dob AS CmAge, net_salary AS SALARY, property_type AS TLName, plan_interested AS AuditorName, is_processed AS STATUS, count_views AS LeadID, add_comment AS COMMENT from temp where session_id='".$session_id."' order by doe DESC";
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
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
	  $newdata .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$retnewdata = str_replace("\r", "", $header);
	$retnewdata .="\n"; 
	$retnewdata .= str_replace("\r", "", $newdata);

	$newToday = date('d')."".date('m')."".date('y');

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/ccdwnld/icici".$newToday."3667.xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	$iciciid="3667";
	sendexcelfileattachment( $emailid,$session_id,$iciciid,$ccemailid);
			 }
		 }

	function sendexcelfileattachment($emailid,$session_id,$iciciid,$ccemailid)
	{		
		$newToday = date('d')."".date('m')."".date('y');

$to = "vrtcentralmis@icicibank.com,thiruvir.pandian@icicibank.com,nishant.mandal@icicibank.com,p.subhash@ext.icicibank.com"; 
	$cc = "shweta.sharma@deal4loans.com, balbir.singh@deal4loans.com"; 
	
		$from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Deal4Loans Fresh Leads Allocated On ".$newToday; 
          
		$fileatt = "/home/deal4loans/public_html/ccdwnld/icici".$newToday."3667.xls";
        $fileatttype = "application/xls"; 
        $fileattname = "icici".$newToday."3667.xls";   
        
		$file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";    
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: ".$cc.""."\n";
		//$headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
        $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $message . "\n\n";    
        $data = chunk_split( base64_encode( $data ) );                 
        $message .= "--{$mime_boundary}\n" . 
                 "Content-Type: {$fileatttype};\n" . 
                 " name=\"{$fileattname}\"\n" . 
                 "Content-Disposition: attachment;\n" . 
                 " filename=\"{$fileattname}\"\n" . 
                 "Content-Transfer-Encoding: base64\n\n" . 
                 $data . "\n\n" . 
                 "--{$mime_boundary}--\n"; 
        		 
     if( mail( $to, $subject, $message, $headers )) {         
            echo "<p>The email was sent.</p>"; 
             }
        else { 
        
            echo "<p>There was an error sending the mail.</p>";          
        }

	$qry1="delete from `temp` where session_id='".$session_id."'";
	Maindeletefunc($qry1,$array = array());
    }
main();
function main()
{
	retrivedataforICICI();
}
?>