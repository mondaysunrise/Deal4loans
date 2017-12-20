<?php
	session_start();
	require 'scripts/db_init.php';
		require 'scripts/functions_nw.php';
	

function retrivedatafor_Mahindra()
	{
		
	$session_id=session_id();
	
	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	//for($k=0;$k<count($iciciid);$k++)
		// {
	$mahfinquery="SELECT Employment_Status,Allocation_Date,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Pincode,Property_Value,Loan_Amount FROM Req_Feedback_Bidder1,Req_Loan_Against_Property WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder1.BidderID in (3210) and Req_Feedback_Bidder1.Reply_Type=5 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
		list($recordcount,$row)=MainselectfuncNew($mahfinquery,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{

		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	
			$Dateofallocation = $row_result[$i]["Allocation_Date"];
					
			$dob=$row_result[$i]["DOB"];


			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'pincode'=>$row_result[$i]['Pincode'], 'property_value'=>$row_result[$i]['Property_Value'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'doe'=>$Dateofallocation);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	

		 }
	
		$qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, net_salary AS Salary,pincode AS Pincode, loan_amount AS LoanAmount from temp where session_id='".$session_id."' order by doe DESC";

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
	$newfileatt = "/home/deal4loans/public_html/lapdwnld/mahindra".$newToday."".$iciciid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $session_id);
			 }
		 //}
	}

	function sendexcelfileattachment($session_id)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

	//$to = "PAI.MAMTA@mahindra.com,VAIDYA.SATISH@mahindra.com"; 
	$to = "VAIDYA.SATISH@mahindra.com"; 
	
	//$to ="ranjana5chauhan@gmail.com";

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Mahindra LAP Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/lapdwnld/mahindra".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "mahindra".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		// $headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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

function retrivedatafor_Mahindracl()
	{
		
	$session_id=session_id();
	
	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$mahfinquery="SELECT Employment_Status,Allocation_Date,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Pincode,Loan_Amount FROM Req_Feedback_Bidder1,Req_Loan_Car WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Car.RequestID and Req_Feedback_Bidder1.BidderID in (3209) and Req_Feedback_Bidder1.Reply_Type=3 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
			
	list($recordcount,$row)=MainselectfuncNew($mahfinquery,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{

		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	
			$Dateofallocation = $row_result[$i]["Allocation_Date"];
					
			$dob=$row_result[$i]["DOB"];
				
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'pincode'=>$row_result[$i]['Pincode'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'doe'=>$Dateofallocation);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	

		 }
	
		$qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, net_salary AS Salary,pincode AS Pincode, loan_amount AS LoanAmount from temp where session_id='".$session_id."' order by doe DESC";

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
	$newfileatt = "/home/deal4loans/public_html/cldwnld/mahindra".$newToday."".$iciciid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachmentcl( $session_id);
			 }
		 //}
	}

function sendexcelfileattachmentcl($session_id)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

	$to = "VAIDYA.SATISH@mahindra.com"; 
	//$to = "VAIDYA.SATISH@mahindra.com"; 
	
	//$to ="ranjana5chauhan@gmail.com";

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Mahindra CL Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/cldwnld/mahindra".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "mahindra".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		// $headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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
	retrivedatafor_Mahindra();
	retrivedatafor_Mahindracl();
}
?>