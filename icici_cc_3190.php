<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
function getReqValue($pKey){
    $titles = array(
	'3179' => 'abhimanyu.bhasker@icicibank.com', 
	'3183' => 'manoharan.narasimhan@icicibank.com',
	'3184' => 'swayam.prabha@icicibank.com',
	'3185' => 'viji.nair@icicibank.com',
	'3186' => 'reema.chakravarty@icicibank.com', 
	'3188' => 'debjit.datta@icicibank.com',
	'3189' => 'amneet.ghuma@icicibank.com',
	'3190' => 'shvetasharma77@gmail.com'
       		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function getCCid($pKey){
    $titles = array(
'3179' => 'jacob.joseph@icicibank.com',
'3183' => 'sathish.govindan@icicibank.com',
'3184' => 'sandeepan.kashyap@icicibank.com',
'3185' => 'samuel.paul@icicibank.com',
'3186' => 'agarwal.am@icicibank.com', 
'3187' => 'niraj.tripathi@icicibank.com', 
'3188' => 'binku.dutta@icicibank.com',
'3189' => 'neelesh.sharma@icicibank.com',

       		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

 
function getReqCity($pKey){
    $titles = array(
'3179' => 'Bangalore',
'3183' => 'Chennai',
'3184' => 'Delhi',
'3185' => 'Hyderabad',
'3186' => 'Jaipur',
'3187' => 'Mumbai',
'3188' => 'Kolkata',
'3189' => 'Pune',
'3190' => 'Complete'
		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforICICI()
	{
	$session_id=session_id();
	$iciciid = array('3179','3183','3184','3185','3186','3187','3188','3189','3190');

	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	for($k=0;$k<count($iciciid);$k++)
		 {
			if($iciciid[$k]=="3190")
			 {
				$citifinquery="SELECT * FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID in (3179,3183,3184,3185,3186,3187,3188,3189) and Req_Feedback_Bidder_CC.Reply_Type=4 and Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";

			 }
		else
			 {
					$citifinquery="SELECT * FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID in (".$iciciid[$k].") and Req_Feedback_Bidder_CC.Reply_Type=4 and Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
			 }
	$search_result=ExecQuery($citifinquery);
	$recordcount = mysql_num_rows($search_result);
	//echo "i m in else".$citifinquery."<br><br>";
 
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			
			$Dateofallocation = $row_result["Allocation_Date"];
			
			if($row_result["Existing_Relationship"]==1)
				{
				$Existing_Relationship="Account Holder";
				}
				if($row_result["Existing_Relationship"]==2)
				{

$Existing_Relationship="Loan Running";
				}
				if($row_result["Existing_Relationship"]==3)
				{
					$Existing_Relationship="Credit Card Holder";
				}
				if($row_result["Existing_Relationship"]==0)
				{
				$Existing_Relationship="";
				}
		$strdesrc=$row_result["Descr"];

		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, descr,Feedback, pancard, no_of_banks,  property_type,doe,add_comment,employer,bank_name,cc_holder, std_code, landline ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$strdesrc."',  '".$row_result["Feedback"]."', '".$row_result["Pancard"]."',  '".$row_result["No_of_Banks"]."', '".$row_result["Pancard_No"]."', '".$Dateofallocation."','".$row_result["comment_section"]."', '".$row_result["Account_No"]."','".$Existing_Relationship."','".$cc_holder."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."')";
			$result1=ExecQuery($qry1);
		 }
	
	$emailid = getReqValue($iciciid[$k]);
	$ccemailid = getCCid($iciciid[$k]);
	
	$qry="select  name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, net_salary AS AnnualIncome, cc_holder AS CardHolder, Feedback, pancard AS Pancard, property_type As PancardNumber, no_of_banks AS AlredyCardHolderOfBank, card_vintage AS CardVintage, doe, add_comment AS Comments  from temp where session_id='".$session_id."' order by doe DESC";

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	$result = ExecQuery($qry);
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
		 
	}
	//$value = '"' . $header . '"' . "\t";
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
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
	$newfileatt = "/home/deal4loans/public_html/ccdwnld/icici".$newToday."".$iciciid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$iciciid[$k],$ccemailid);
			 }
		 }
	}

	function sendexcelfileattachment($emailid,$session_id,$iciciid,$ccemailid)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

	$to = $emailid; 
	$cc = $ccemailid; 
	$bdcity=getReqCity($iciciid);
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "ICICI Credit Card Leads @ deal4loans.com(".$bdcity.")".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/ccdwnld/icici".$newToday."".$iciciid.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "icici".$newToday."".$iciciid.".xls";
   
        
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
	$result1 = ExecQuery($qry1);
    
    }
main();
function main()
{
	retrivedataforICICI();
}
?>