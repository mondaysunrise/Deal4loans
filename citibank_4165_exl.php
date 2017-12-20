<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
echo "New";
function completeexl()
{
	$session_id=session_id();
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

$min_date=date('Y-m')."-01 00:00:00";
$max_date=$currentdate." 23:59:59";
$citibankid = array('4167','4166');

//get complete leads from allocation table
	for($i=0;$i<count($citibankid);$i++)
	{
		echo $citibankid[$i]."<br><br>";
		if($citibankid[$i]==4167)
		{
	$citibankqry="SELECT * FROM Req_Feedback_Bidder_LAP,Req_Loan_Against_Property WHERE Req_Feedback_Bidder_LAP.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder_LAP.BidderID = ".$citibankid[$i]." and Req_Feedback_Bidder_LAP.Reply_Type=5 and Req_Feedback_Bidder_LAP.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ";
		}
		else
		{
	$citibankqry="SELECT * FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in(4165,4166) and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."'";
		}
	 list($recordcount,$row_result)=MainselectfuncNew($citibankqry,$array = array());

	for($i=0;$i<$recordcount;$i++)	 
	{ 
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

		if($citibankid[$i]==4167)
		{
			$property_loc="";
			$property_identified="";
			$Existing_Bank="";
			$Existing_ROI="";
			$Existing_Loan="";
			$source="LAP";
		}
		else
		{
			if($row_result[$i]["Property_Identified"]==0){ $property_identified="No";}
			elseif($row_result[$i]["Property_Identified"]==1) { $property_identified="Yes";}
			else { $property_identified="";}
			$property_loc=$row_result[$i]["Property_Loc"];
			$Existing_Bank = $row_result[$i]["Existing_Bank"];
			$Existing_ROI = $row_result[$i]["Existing_ROI"];
			$Existing_Loan = $row_result[$i]["Existing_Loan"];
			if(strlen($Existing_Bank)>0)
			{	$source="Home Loan BT"; }else { $source="Home Loan";			}
		}
											

		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'property_identified'=>$property_identified, 'property_loc'=>$property_loc, 'property_value'=>$row_result[$i]['Property_Value'], 'gender'=>$Existing_Bank, 'marital_status'=>$Existing_ROI, 'residential_status'=>$Existing_Loan, 'doe'=>$row_result[$i]['Allocation_Date'], 'source'=>$source);			
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);	

		 }
	}

	//extract from temp now
	$qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, net_salary AS AnnualIncome, loan_amount AS LoanAmt, property_identified AS PropertyIdentified, property_loc AS PropertyLoc, property_value AS PropertyValue, gender AS ExistingBank, marital_status AS ExistingROI, residential_status AS ExistingLoan, source AS Product, doe AS Date  from temp where session_id='".$session_id."' order by doe DESC ";
		
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
	$newfileatt = "/home/deal4loans/public_html/citibankhl4165/citibank".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid, $session_id );
			 }
}

function sendexcelfileattachment($emailid, $session_id)
	{
	$newToday = date('d')."".date('m')."".date('y');
	
	$to = "Pratish.yadava@citi.com,b.sridevi@citi.com,Ayush.kumar@citi.com, Ajatasatru.sahoo@citi.com,shweta.sharma@deal4loans.com"; 
	       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Citibank Leads @ deal4loans.com"; 
           
	   $fileatt = "/home/deal4loans/public_html/citibankhl4165/citibank".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "citibank".$newToday.".xls";
   
           $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		/*if(strlen($emailidcc)>0)
		{
		$headers .= "Cc: ".$emailidcc.""."\n";
		}*/

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
       echo $to ;          
 
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
Function main()
{
	completeexl();
}

?>