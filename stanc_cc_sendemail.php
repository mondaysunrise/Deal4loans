<?php
//Commented To and BCC
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
function retrivedataforscb()
	{
	$session_id=session_id();
	$scbarr = array('Ahmedabad','Bangalore','Chennai','Delhi','Hyderabad','Mumbai','Kolkata','Pune');

	$Today = date("Y-m-d"); 
	//$Today ="2011-01-7";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	//$min_date="2010-12-29 00:00:00";
	//$max_date="2011-01-03 23:59:59";
	for($k=0;$k<count($scbarr);$k++)
		 {
			 if($scbarr[$k]=="Ahmedabad")
			 {
				 $city="'Ahmedabad'";
				 $emailid="Jagruti.parmar@sc.com"; 
			}
			 if($scbarr[$k]=="Bangalore")
			 {
				 $city="'Bangalore'";
				$emailid="Sangeeta-d.rath@sc.com"; 
			}
			 if($scbarr[$k]=="Chennai")
			 {
				 $city="'Chennai'";
				$emailid="Arun.mathew@sc.com"; 
			}
			 if($scbarr[$k]=="Delhi")
			 {
				 $city="'Delhi','Gaziabad','Gurgaon','Noida'";
				$emailid="Deepak.tandon@sc.com,Kanika.malhotra@sc.com"; 
			}
			 if($scbarr[$k]=="Hyderabad")
			 {
				 $city="'Hyderabad'";
				$emailid="Poonam.dubey@sc.com"; 
			}
			 if($scbarr[$k]=="Mumbai")
			 {	
				 $city="'Mumbai','Thane','Navi Mumbai'";
				$emailid="Vivek.bhalla@sc.com,Khyati-mukesh.sanghvi@sc.com"; 
			}
			 if($scbarr[$k]=="Kolkata")
			 {	
				$city="'Kolkata'";
				$emailid="Tridibtulshi.banerjee@sc.com";
			}
			 if($scbarr[$k]=="Pune")
			 {	
				 $city="'Pune'";
				$emailid="Rahul.chanani@sc.com"; 
			}
	$citifinquery="SELECT Name,DOB,Email,Employment_Status,Company_Name,City,City_Other,Pincode,Mobile_Number,Net_Salary,Add_Comment,Pancard,No_of_Banks,Pancard_No,CC_Holder,Allocation_Date,Card_Vintage
FROM Req_Feedback_Bidder1,Req_Credit_Card WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_Bidder1.BidderID =1794 and  Req_Credit_Card.City in (".$city.") and Req_Feedback_Bidder1.Reply_Type=4 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
 list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());


	for($i=0;$i<$recordcount;$i++)
			 {
		if($row_result[$i]["Card_Vintage"]==1)
		{	$card_vintage="Less than 6 months";}
		if($row_result[$i]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		if($row_result[$i]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		if($row_result[$i]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		if($row_result[$i]["CC_Holder"]==0) { $cc_holder="No"; } 
		if($row_result[$i]["CC_Holder"]==1) { $cc_holder="Yes"; }
			
		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'cc_holder'=>$cc_holder, 'pancard'=>$row_result[$i]['Pancard'], 'no_of_banks'=>$row_result[$i]['No_of_Banks'], 'card_vintage'=>$card_vintage, 'property_type'=>$row_result[$i]['Pancard_No'], 'doe'=>$row_result[$i]['Allocation_Date']);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
			
		 }
	
	//echo $qry1."<br>";
	
	$qry="select  name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, descr, cc_holder, pancard, property_type As PancardNumber, no_of_banks, card_vintage, doe, add_comment  from temp where session_id='".$session_id."' order by doe DESC";
		
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
 
//echo $citifincity."hello::";
$newToday = date('d')."".date('m')."".date('y');
//$newToday="120810";
	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/StandardCharteredCC/stanc".$newToday."(".$scbarr[$k].").xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$scbarr[$k]);
			 }
		 }
		
	}
	function sendexcelfileattachment($emailid,$session_id,$citifincity)
	{
		//$newToday="120810";
		$newToday = date('d')."".date('m')."".date('y');
	//echo "mailsent".$emailid."<br>";
	$to = "".$emailid.""; 

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "CreditCard Leads @ deal4loans.com".$newToday."(".$citifincity.")"; 
    
       $fileatt = "/home/deal4loans/public_html/StandardCharteredCC/stanc".$newToday."(".$citifincity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "stanc".$newToday."(".$citifincity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		

    
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
	retrivedataforscb();
}
?>