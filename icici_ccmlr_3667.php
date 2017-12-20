<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

function retrivedataforICICI()
	{
	$session_id=session_id();
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);
//$currentdate ="2013-08-06";
	$min_date=$currentdate." 00:00:00";
	$max_date=$currentdate." 23:59:59";

	$citifinquery="Select * from icici_credit_card Where (icici_eligible_flag=1 and (icici_dated between '".($min_date)."' and '".($max_date)."'))";

	list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["icici_feedback"]=="" || $row_result[$i]["icici_feedback"]=="FollowUp" || $row_result[$i]["icici_feedback"]=="Logged In" ||  $row_result[$i]["icici_feedback"]=="Appointment fixed" || $row_result[$i]["icici_feedback"]=="Appointment postponed") 
			  { $icici_ccstatus="Open"; } else { $icici_ccstatus="Closed"; }
				
		if($row_result[$i]["icici_emp_status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
		if($row_result[$i]["icici_exist_rel"]==1) { $exist_rel="Yes"; } else { $exist_rel="No"; }

	if($row_result[$i]["icici_typrofrel"]==1) { $typrofrel="Account Holder"; }  if($row_result[$i]["icici_typrofrel"]==2) { $typrofrel="Loan Running";}
	if($row_result[$i]["icici_typrofrel"]==3) { $typrofrel="Others";}
		if($row_result[$i]["icici_typrofrel"]==0) { $typrofrel="";}
		
	$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['icici_name'], 'dob'=>$row_result[$i]['icici_dob'], 'email'=>$row_result[$i]['icici_email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['icici_employer'], 'city'=>$row_result[$i]['icici_city'], 'mobile_number'=>$row_result[$i]['icici_mobileno'], 'net_salary'=>$row_result[$i]['icici_income'], 'Feedback'=>$row_result[$i]['icici_feedback'], 'doe'=>$row_result[$i]['icici_dated'], 'add_comment'=>$row_result[$i]['icici_comment'], 'descr'=>'ICICI Bank Platinum Chip Credit Card', 'apt_dt'=>$icici_ccstatus, 'city_other'=>$row_result[$i]['icici_city_other'], 'is_processed'=>$exist_rel, 'Documents'=>$typrofrel);
		$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
		 }

	$qry="select name AS Name, dob AS DOB, email AS EmailID, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity,  mobile_number AS MobileNo, net_salary AS AnnualIncome, Feedback, doe AS DateOfEntry, add_comment AS Comment, descr AS CardType, apt_dt AS Status, is_processed AS ExistingRel, Documents AS TypeofRel from temp where session_id='".$session_id."' order by doe DESC";

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
	$newfileatt = "/home/deal4loans/public_html/ccdwnld/icici".$newToday."mlr3667.xls";
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
$to = "rajiv.chaddha@icicibank.com"; 
	$cc = "nishant.mandal@icicibank.com, shweta.sharma@deal4loans.com, balbir.singh@deal4loans.com, Namrata.medhi@deal4loans.com"; 
	
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Deal4Loans mailer Fresh Leads Allocated On ".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/ccdwnld/icici".$newToday."mlr3667.xls";
        $fileatttype = "application/xls"; 
        $fileattname = "icici".$newToday."mlr3667.xls";
        
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
	   $headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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
	retrivedataforICICI();
}
?>