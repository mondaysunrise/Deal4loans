<?php
//Commented To and CC

	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	

function retrivedataforicicicl()
	{
	$session_id=session_id();
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);
	$min_date=$currentdate." 00:00:00";
	$max_date=$currentdate." 23:59:59";


	$iciciquery="SELECT Name,DOB,Email,Company_Name,City,City_Other,Mobile_Number,Car_Model,Net_Salary,Pincode,Loan_Amount,Contact_Time,Delivery_Date,Car_Booked,Account_No,Employment_Status,RequestID FROM Req_Feedback_Bidder_CL,Req_Loan_Car WHERE Req_Feedback_Bidder_CL.AllRequestID=Req_Loan_Car.RequestID and Req_Feedback_Bidder_CL.BidderID in (3886,3887) and Req_Feedback_Bidder_CL.Reply_Type=3 and Req_Feedback_Bidder_CL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ";
	list($recordcount,$row_result)=MainselectfuncNew($iciciquery,$array = array());
	for($i=0;$i<$recordcount;$i++)
	{
			$exclusiveLead = '';
			$sqlExclusive = "select BidderID from Req_Feedback_Bidder_CL where (AllRequestID = '".$row_result[$i]["RequestID"]."' and Reply_Type='3')";
			list($numRowsExclusive,$queryExclusive)=MainselectfuncNew($sqlExclusive,$array = array());
			if($numRowsExclusive==1)
			{
				$exclusiveLead = "Exclusive Lead";
			}	
			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result[$i]["Car_Type"]==1) { $car_type="New"; }
			if($row_result[$i]["Car_Type"]==0) { $car_type="Old"; }  
				
		
			if($row_result[$i]["Car_Booked"]==1)
			{			 $Car_Booked="Yes";			}
			else if ($row_result[$i]["Car_Booked"]==2)
			{			$Car_Booked="No";			}
			else
			{			$Car_Booked="";			}

$acc_no= $row_result[$i]["Account_No"];
			$descr= $Car_Booked;

			$Dateofallocation = $row_result[$i]["Allocation_Date"];
			
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'car_model'=>$row_result[$i]['Car_Model'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'pincode'=>$row_result[$i]['Pincode'], 'contact_time'=>$row_result[$i]['Contact_Time'], 'is_processed'=>$car_type, 'doe'=>$Dateofallocation, 'constitution'=>$row_result[$i]['Delivery_Date'], 'current_age'=>$exclusiveLead);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
		}
	
	$qry="select  name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_make, car_model, is_processed AS CarType ,loan_amount, pincode, Feedback, contact_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";

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
	$newfileatt = "/home/deal4loans/public_html/cldwnld/icici".$newToday."3888.xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id);
			 }
	
	}

	function sendexcelfileattachment($emailid,$session_id)
	{
		
		$newToday = date('d')."".date('m')."".date('y');
	$to = "s.dhirendra@icicibank.com,gurpinder.taneja@icicibank.com,amitd.kumar@icicibank.com"; 
	//$to = "ranjana5chauhan@gmail.com"; 

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "ICICI Car Loan Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/cldwnld/icici".$newToday."3888.xls";
        $fileatttype = "application/xls"; 
        $fileattname = "icici".$newToday."3888.xls";
           
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: shweta.sharma@deal4loans.com"."\n";
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
	retrivedataforicicicl();
}
?>