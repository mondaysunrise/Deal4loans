<?php

	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	


function getReqValue($pKey){
    $titles = array(
'3078' => 'amit.rai@axisbank.com,Ajit.Lokhande@axisbank.com',
'3079' => 'tamojit.ghosh@axisbank.com,Nishant.Mehra@axisbank.com',
'3080' => 'preetham.kuruvadi@axisbank.com,Abhishek.Jain@axisbank.com',
'3081' => 'Sampson.Gonsalves@axisbank.com,John.Dias@axisbank.com'
      		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }


  function getReqCity($pKey){
    $titles = array(
	'3078' => 'Delhi',
	'3079' => 'Mumbai',
	'3080' => 'Bangalore',
'3081' => 'Complete'

		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforcitifin()
	{
	$session_id=session_id();
	$citifinid = array('3078','3079','3080','3081');

	$Today = date("Y-m-d"); 
	//$Today = "2012-10-18";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	for($k=0;$k<count($citifinid);$k++)
		 {
			if($citifinid[$k]=="3081")
			 {
				$citifinquery="SELECT * FROM Req_Feedback_Bidder_LAP,Req_Loan_Against_Property WHERE Req_Feedback_Bidder_LAP.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder_LAP.BidderID in (3078,3079,3080) and Req_Feedback_Bidder_LAP.Reply_Type=5 and Req_Feedback_Bidder_LAP.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";

			 }
		else
			 {
					$citifinquery="SELECT * FROM Req_Feedback_Bidder_LAP,Req_Loan_Against_Property WHERE Req_Feedback_Bidder_LAP.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder_LAP.BidderID in (".$citifinid[$k].")  and Req_Feedback_Bidder_LAP.Reply_Type=5 and Req_Feedback_Bidder_LAP.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
			 }
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
 
	for($ii=0;$ii<$recordcount;$ii++)
	{
		if($row_result[$ii]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	
			$Dateofallocation = $row_result[$ii]["Allocation_Date"];
					
			$dob=$row_result[$ii]["DOB"];

		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$ii]["Name"], 'dob'=>$dob, 'email'=>$row_result[$ii]["Email"], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$ii]["Company_Name"], 'city'=>$row_result[$ii]["City"], 'city_other'=>$row_result[$ii]["City_Other"], 'mobile_number'=>$row_result[$ii]["Mobile_Number"], 'net_salary'=>$row_result[$ii]["Net_Salary"], 'pincode'=>$row_result[$ii]["Pincode"], 'property_value'=>$row_result[$ii]["Property_Value"], 'loan_amount'=>$row_result[$ii]["Loan_Amount"], 'Feedback'=>$row_result[$ii]["Feedback"], 'doe'=>$Dateofallocation, 'add_comment'=>$row_result[$ii]["comment_section"], 'request_id'=>$row_result[$ii]["Feedback_ID"]);		
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	
	$emailid = getReqValue($citifinid[$k]);

	$qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, net_salary AS Salary,  pincode AS Pincode, property_value AS PropertyValue, loan_amount AS LoanAmount, Feedback, doe AS DateOfEntry, add_comment AS comments from temp where session_id='".$session_id."' order by doe DESC";

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
//$newToday ="280112";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/lapdwnld/axis".$newToday."".$citifinid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$citifinid[$k]);
			 }
		 }
		 
	
	}
	function sendexcelfileattachment($emailid,$session_id,$citifinid)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

	$to = $emailid; 
	
	$bdcity=getReqCity($citifinid);
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Axis Lap Leads @ deal4loans.com(".$bdcity.")".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/lapdwnld/axis".$newToday."".$citifinid.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "axis".$newToday."".$citifinid.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
if($citifinid==3081)
		{
	//echo "1<br>";
	$headers .= "Cc: Balbir.singh@deal4loans.com, neha.gupta@deal4loans.com"."\n";
		}
		else
		{
		//		echo "2:<br>";
		$headers .= "Cc: Sampson.Gonsalves@axisbank.com,John.Dias@axisbank.com,balbir.singh@deal4loans.com, neha.gupta@deal4loans.com"."\n";
		}
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
        
		 
     if( mail( $to, $subject, $message, $headers ) ) {
         
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
	retrivedataforcitifin();
}
?>