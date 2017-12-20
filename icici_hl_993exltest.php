<?php
	session_start();
	require 'scripts/db_init.php';
		require 'scripts/functions_nw.php';
	

function retrivedatafor_icici()
	{
		
	$session_id=session_id();
	
	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$qry="select icici_city AS Cities,icici_month AS Month,date_01,date_02,date_03,date_04,date_05,date_06,date_07,date_08,date_09,date_10,date_11,date_12,date_13,date_14,date_15,date_16,date_17,date_18,date_19,date_20,date_21,date_22,date_23,date_24,date_25,date_26,date_27,date_28,date_29,date_30,date_31,total_count AS TotalCount from  icicihl_lapreport where (stat_flag=1)";

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
	$newfileatt = "/home/deal4loans/public_html/hldwnld/icicihl".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );

$mailcontent= mailcntent();
echo $mailcontent."<br>";
	sendexcelfileattachment( $session_id,$mailcontent);
			
	}

	function sendexcelfileattachment($session_id,$mailcontent)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

	$to ="ranjana5chauhan@gmail.com";

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "ICICI HL Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/hldwnld/icicihl".$newToday.".xls";
        $fileatttype = "application/xls"; 
        echo $fileattname = "icicihl".$newToday.".xls";

        
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
                $mailcontent . "\n\n";
    
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

    }

function mailcntent()
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
list($year,$month,$date) = split('-', $currentdate);
$interval=  $date;
$dayarr="";
for($d=1; $d<=$date; $d++)
	  {
		if($d<10)
		  {
			$dtfield="date_0".$d;
		  }
		  else
		  {
			$dtfield="date_".$d;
		  }
		  $fieldarr[]=$dtfield;
		  $datarr[]=$d;
	  }

$filedstr=implode(",",$fieldarr);

//$citifinid =array('Delhi n NCR','Mumbai n Suburbs','Hyderabad','Bangalore','Pune','Chennai','Kolkata','Jaipur','Chandigarh','Ahmedabad','Cochin','Surat','Vadodara','Coimbatore','Indore','complete');

$citifinid =array('Ahmedabad','Bangalore','Bhopal','Bhubneshwar','Chandigarh','Chennai','Cochin','Coimbatore','Delhi n NCR','Hyderabad','Indore','Jaipur','Kolkata','Lucknow','Mumbai n Suburbs','Pune','Surat','Vadodara','Vishakapatanam','Total');

$content='<table border="1" cellspacing="1" cellpadding="5" >
<tr><td valign="top" align="center" style="background-color:#666666; color:#ffffff;"></td>';

for($r=0; $r<count($datarr);$r++)
  {
	
	$content.='<td valign="top" align="center" style="background-color:#666666; color:#ffffff;">'.$datarr[$r].' Aug '.Date('y').'</td>';
  }

$content.='<td valign="top" align="center" style="background-color:#666666; color:#ffffff;" >Total</td>
</tr>';

  $content.='</table>';
  
echo $content;
return($content);
}
main();
function main()
{
	retrivedatafor_icici();
}
?>