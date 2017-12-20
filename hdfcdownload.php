<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
function getReqValue($pKey){
    $titles = array(
        '662' => 'rituc@hdfc.com,jyotik@hdfc.com',
        '663' => 'thamayan@hdfc.com',
		'664' => 'sumanc@hdfc.com,abhikg@hdfc.com',
        '665' => 'satyaswaroop@hdfc.com,rajar@hdfc.com',
		'666' => 'jating@hdfc.com',
        '667' => 'appannanp@hdfc.com,anithan@hdfc.com,ruhip@hdfc.com',
		'668' => 'pratikm@hdfc.com,yashwantp@hdfc.com',
        '669' => 'tjaishanker@hdfc.com,shrenickk@hdfc.com',
		'831' => 'pharshal@hdfc.com',
		'832' => 'debjitd@hdfc.com',
		'833' => 'gagann@hdfc.com,upendran@hdfc.com',
		'834' => 'chhavig@hdfc.com',
		'835' => 'satyabratd@hdfc.com',
		'839' => 'prabhujeevb@hdfc.com,vania@hdfc.com',
		'843' => 'ratnakara@hdfc.com,urhomeguide.luck@hdfc.com',
		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

  function getReqCity($pKey){
    $titles = array(
        '662' => 'Delhi',
        '663' => 'Bangalore',
		'664' => 'Kolkata',
        '665' => 'Hyderabad',
		'666' => 'Ahmedabad',
        '667' => 'Mumbai',
		'668' => 'Pune',
        '669' => 'Chennai',
		'831' => 'Nasik',
		'832' => 'Nagpur',
		'833' => 'Coimbatore',
		'834' => 'Jaipur',
		'835' => 'Bhubneshwar',
		'839' => 'Chandigarh',
		'843' => 'Lucknow',

		   );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforhdfc()
	{
	$session_id=session_id();
	$hdfcid = array(
		'662','663','664','665','666','667','668','669','831','832','833','834','835','839','843'
		);

	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	//$min_date="2008-07-11 00:00:00";
	//$max_date="2008-07-11 23:59:59";
	for($k=0;$k<count($hdfcid);$k++)
		 {
	$hdfcquery="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = ".$hdfcid[$k]." and Req_Feedback_Bidder1.Reply_Type=2 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
	 list($recordcount,$row_result)=MainselectfuncNew($hdfcquery,$array = array());
		$cntr=0;
 
	while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result[$cntr]["Marital_Status"]==1) { $marital_status="Single"; } else { $marital_status="Married"; }
			if($row_result[$cntr]["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result[$cntr]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$cntr]["Residential_Status"]==3) { $residential_status="Company Provided"; }
			if($row_result[$cntr]["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result[$cntr]["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
			if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }

			
			if($row_result[$cntr]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result[$cntr]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result[$cntr]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result[$cntr]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result[$cntr]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result[$cntr]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result[$cntr]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result[$cntr]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

			//$Dateofallocation = $row_result[$cntr]["Allocation_Date"];
			
			if($row_result[$cntr]["Allocation_Date"] > "2007-10-19 00:00:00")
			{
				$Dateofallocation = $row_result[$cntr]["Allocation_Date"];
			}
			else 
			{
				$Dateofallocation = $row_result[$cntr]["Dated"];
			}
	
		$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$row_result[$cntr]["DOB"], "email"=>$row_result[$cntr]["Email"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "year_in_comp"=>$row_result[$cntr]["Years_In_Company"], "total_exp"=>$row_result[$cntr]["Total_Experience"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "std_code"=>$row_result[$cntr]["Std_Code"], "landline"=>$row_result[$cntr]["Landline"], "std_code_o"=>$row_result[$cntr]["Std_Code_O"], "landline_o"=>$row_result[$cntr]["Landline_O"], "net_salary"=>$row_result[$cntr]["Net_Salary"], "marital_status"=>$marital_status, "residential_status"=>$residential_status, "vehicle_owned"=>$vehicle_owned, "loan_any"=>$row_result[$cntr]["Loan_Any"], "emi_paid"=>$emi_paid, "cc_holder"=>$cc_holder, "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "Feedback"=>$row_result[$cntr]["Feedback"], "count_views"=>$row_result[$cntr]["Count_Views"], "count_replies"=>$row_result[$cntr]["Count_Replies"], "is_modified"=>$row_result[$cntr]["IsModified"], "is_processed"=>$row_result[$cntr]["IsProcessed"], "pincode"=>$row_result[$cntr]["Pincode"], "doe"=>$Dateofallocation, "card_vintage"=>$card_vintage, "card_limit"=>$row_result[$cntr]["Card_Limit"], "ip_address"=>$row_result[$cntr]["IP_Address"], "residence_address"=>$row_result[$cntr]["Residence_Address"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
		
		$emailid=getReqValue($hdfcid[$k]);
		   $cntr=$cntr+1;
		   }
	
	 $qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode,residence_address, net_salary, loan_amount, doe from temp where session_id='".$session_id."' order by doe DESC";
		
	
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
 

$hdfccity=getReqCity($hdfcid[$k]);
//echo $hdfccity."hello::";
$newToday = date('d')."".date('m')."".date('y');
	// Open the file and erase the contents if any
	$newfileatt = "hdfc/HDFC".$newToday."(".$hdfccity.").xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$hdfccity);
			 }
		 }
	
	}
	function sendexcelfileattachment($emailid,$session_id,$hdfccity)
	{
		$newToday = date('d')."".date('m')."".date('y');
	
	$to = "".$emailid.""; 
	//$to = "ranjana5chauhan@gmail.com"; 
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Homeloan Leads @ deal4loans.com".$newToday."(".$hdfccity.")"; 
    
       
	   $fileatt = "hdfc/HDFC".$newToday."(".$hdfccity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "HDFC".$newToday."(".$hdfccity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: sethpri@gmail.com,bhawna.sharma@bimadeals.in"."\n";
		//$headers .= "Bcc: mehra3@gmail.com,extra4testing@gmail.com"."\n";
		$headers .= "Bcc: extra4testing@gmail.com"."\n";

    
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
	retrivedataforhdfc();
}
?>