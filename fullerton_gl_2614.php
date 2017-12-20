<?php
//Commented To and CC
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
function retrivedataforcitifin()
	{
	$session_id=session_id();
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$Today=date('Y-m-d',$tomorrow);
	//$Today = "2012-01-28";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$citifinquery="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Gold WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Gold.RequestID and Req_Feedback_Bidder1.BidderID = 2614 and Req_Feedback_Bidder1.Reply_Type=7 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";

	list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());
 
	for($i=0;$i<$recordcount;$i++)
	{
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'email'=>$row_result[$i]['Email'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'dob'=>$row_result[$i]['DOB'], 'doe'=>$row_result[$i]['Allocation_Date']);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		$emailid="artemishr.divakar.jadhav@fullertonindia.com";

	}
	
	//echo $qry1."<br>";
	$qry="select  name AS Name, email AS Email, dob AS DOB, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, loan_amount AS LoanAmount, doe AS DateOfEntry from temp where session_id='".$session_id."' order by doe DESC";
			
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
	$newfileatt = "/home/deal4loans/public_html/fullerton_gl/fullerton".$newToday.".xls";
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
		//$newToday ="280112";
		$newToday = date('d')."".date('m')."".date('y');
	//echo $emailid."<br>";
	$to = "artemishr.divakar.jadhav@fullertonindia.com"; 
	
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Gold Loan Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/fullerton_gl/fullerton".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "fullerton".$newToday.".xls";
   
        
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