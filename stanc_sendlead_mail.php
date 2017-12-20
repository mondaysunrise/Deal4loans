<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
function getReqValue($pKey){
    $titles = array(
        '1476' => 'Ajitkumar.Srivastava@sc.com,Nitin-kumar.Goel@sc.com',
        '1477' => 'Vigneshvirudha.giri@sc.com'
       		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

 
  function getReqCity($pKey){
    $titles = array(
        '1476' => 'Delh',
        '1477' => 'Mumbai'
		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforcitifin()
	{
	$session_id=session_id();
	$citifinid = array('1476','1477');

	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	//$min_date="2010-06-26 00:00:00";
	//$max_date="2010-06-26 23:59:59";
	for($k=0;$k<count($citifinid);$k++)
		 {
			 
	$citifinquery="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = ".$citifinid[$k]." and Req_Feedback_Bidder1.Reply_Type=2 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
 list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());
	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["Property_Identified"]==0){ $property_identified="No";}
			elseif($row_result[$i]["Property_Identified"]==1) { $property_identified="Yes";}
			else { $property_identified="";}

			if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'pincode'=>$row_result[$i]['Pincode'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'descr'=>$row_result[$i]['Add_Comment'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'budget'=>$row_result[$i]['Budget'], 'residence_address'=>$row_result[$i]['Residence_Address'], 'property_identified'=>$property_identified, 'property_loc'=>$row_result[$i]['Property_Loc'], 'loan_time'=>$row_result[$i]['Loan_Time'], 'doe'=>$row_result[$i]['Allocation_Date'], 'add_comment'=>$row_result[$i]['comment_section']);
	
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
		$emailid=getReqValue($citifinid[$k]);
		 }
	
	//echo $qry1."<br>";
	
	$qry="select name, dob, email, std_code, landline, std_code_o, landline_o, mobile_number, emp_status, c_name, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc, budget, residence_address, loan_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
		
	
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
 

$citifincity=getReqCity($citifinid[$k]);
//echo $citifincity."hello::";
$newToday = date('d')."".date('m')."".date('y');
	// Open the file and erase the contents if any
	$newfileatt = "StandardChartered/Stanc".$newToday."(".$citifincity.").xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$citifincity);
			 }
		 }
		 
	
	}
	function sendexcelfileattachment($emailid,$session_id,$citifincity)
	{
		$newToday = date('d')."".date('m')."".date('y');
	//echo $emailid."<br>";
	$to = "".$emailid.""; 
	//$to = "ranjana5chauhan@gmail.com"; 
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "HomeLoan Leads @ deal4loans.com".$newToday."(".$citifincity.")"; 
    
       
	   $fileatt = "StandardChartered/Stanc".$newToday."(".$citifincity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "Stanc".$newToday."(".$citifincity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: ashish.rana@sc.com,sethpri@gmail.com"."\n";
		//$headers .= "Bcc: mehra3@gmail.com,extra4testing@gmail.com"."\n";
		$headers .= "Bcc: extra4testing@gmail.com,pratibha@deal4loans.in"."\n";

    
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