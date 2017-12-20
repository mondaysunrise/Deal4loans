<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
	$titles = array(
              '1'=> 'Req_Loan_Personal',
               '2'=>'Req_Loan_Home',
               '3'=>'Req_Loan_Car',
               '4'=>'Req_Credit_Card' ,
               '5'=>'Req_Loan_Against_Property',       
       );
	   
	function getReqTable($pKey){
       $titles = array(
              '1'=> 'Req_Loan_Personal',
              '2'=>'Req_Loan_Home' ,
              '3'=>'Req_Loan_Car' ,
              '4'=>'Req_Credit_Card',
              '5'=>'Req_Loan_Against_Property',
       );

       foreach ($titles as $key=>$value)
           if($pKey==$key)
               return $value;

       return "";
  }


$DayVar = date("D");
$HourVar = date("G");

if(($DayVar=='Wed' || $DayVar=='Thu' || $DayVar=='Fri' || $DayVar=='Sat') && ($HourVar >= 8 || $HourVar < 9))
{

	$today = date("Y-m-d");
	//echo $today = "2007-10-08";
	$explodeToday = explode("-",$today);
	$field_date =  $explodeToday[2];
	$today_fielddate = "Date_".$field_date;
	$yesterday  = mktime(0, 0, 0, date("$explodeToday[1]")  , date("$explodeToday[2]")-1, date("$explodeToday[0]"));
	$yesterdayDate = date("Y-m-d",$yesterday); 
	$explodeYesterday = explode("-",$yesterdayDate);
	$y_fielddate = $explodeYesterday[2];
	$yesterday_fielddate = "Date_".$y_fielddate;
	
	$daybeforeyesterday  = mktime(0, 0, 0, date("$explodeToday[1]")  , date("$explodeToday[2]")-2, date("$explodeToday[0]"));
	$daybeforeyesterdayDate = date("Y-m-d",$daybeforeyesterday); 
	$explodedaybeforeYesterday = explode("-",$daybeforeyesterdayDate);
	$y_daybeforefielddate = $explodedaybeforeYesterday[2];
	$daybeforeyesterday_fielddate = "Date_".$y_daybeforefielddate;
	
	
	$daybefore2  = mktime(0, 0, 0, date("$explodeToday[1]")  , date("$explodeToday[2]")-3, date("$explodeToday[0]"));
	$daybefore2Date = date("Y-m-d",$daybefore2); 
	$explode2daybefore = explode("-",$daybefore2Date);
	$y_2daybeforefielddate = $explode2daybefore[2];
	$daybefore2_fielddate = "Date_".$y_2daybeforefielddate;
	
	$getDateToCompare  = mktime(0, 0, 0, date("$explodeToday[1]")  , date("$explodeToday[2]"), date("$explodeToday[0]"));
	$compareDate = date("l",$getDateToCompare); 
		

		$inputmonth = date("m");
		$sql = "SELECT * FROM BiddersLoginDetails where $daybeforeyesterday_fielddate < 1 and $yesterday_fielddate < 1 and  Month_Details=$inputmonth"; 
		echo "<br>".$sql."<br>";

		list($query_innerNumRows,$query)=MainselectfuncNew($sql,$array = array());
	//echo "<br>".$query_innerNumRows;
	for($i=0;$i<$query_innerNumRows;$i++)
	{
		$Bid = $query[$i]['BidderID'];
		
		$sql_BidderEmail = "SELECT * FROM Bidders_List WHERE Restrict_Bidder=1 and BidderID=".$Bid;
		list($numrows,$query_BidderEmail)=MainselectfuncNew($sql_BidderEmail,$array = array());		
		$BidderIDEMAIL = $query_BidderEmail[0]['BidderID'];
		
		$Bidder_Name = $query_BidderEmail[0]['Bidder_Name'];
		$Reply_Type = $query_BidderEmail[0]['Reply_Type'];
		$getTable = getReqTable($Reply_Type);
		
		$sql_Email = "SELECT * FROM Bidders WHERE BidderID=".$BidderIDEMAIL;
		list($numrows1,$query_Email)=MainselectfuncNew($sql_Email,$array = array());
		$email = $query_Email[0]['BidderEmailID'];
		$city = $query_Email[0]['City']; 
		
		$sql_CountLeads = "SELECT Req_Feedback_Bidder1.AllRequestID FROM Req_Feedback_Bidder1 LEFT JOIN $getTable ON $getTable.RequestID = Req_Feedback_Bidder1.AllRequestID WHERE Req_Feedback_Bidder1.BidderID =$Bid AND $getTable.Dated BETWEEN '$daybeforeyesterdayDate' AND '$yesterdayDate'";
		list($CountLeads,$query_CountLeads)=MainselectfuncNew($sql_CountLeads,$array = array());
		
		echo "BidderID: ".$Bid."&nbsp;&nbsp;&nbsp;&nbsp;CountLeads: ".$CountLeads."&nbsp;&nbsp;&nbsp;&nbsp;Email: ".$email."<BR>";
		if($CountLeads>0)
		{
			if($city)
			{
				$BidderCity = " in ".$city;
			}
		// subject
		//$subject = "Deal4loans: ".$CountLeads."  New Leads Waiting for You. Bidder id".$Bid;
		$subject = "Deal4loans: ".$CountLeads."  New Leads Waiting for You.";
		// message
		$message1 = "<table border='0' cellspacing='0' width='485' cellpadding='0' bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' style='border-collapse: collapse' bordercolor='#529BE4' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><p><font face='Verdana' size='2'><b>Dear Partner,</b><br><br>We at <a href='http://www.deal4loans.com'>Deal4loans.com</a> are always  working towards improving the conversions at your end. <p>We have noticed that you have not logged in to <strong>Deal Engine</strong> &#8211; the <strong>Deal4loans</strong> comprehensive Leads Management System- in the last 48 hrs and this can potentially reduce your conversions.</p> <p>Since your last login &#8211; there have been <strong>".$CountLeads."</strong> new customers<strong> ".$BidderCity."</strong>.</p> <p> Plz note that for higher conversions on Internet Leads it is important that the <strong>Turn-around-time</strong> is minimal i.e. you should call the customer as soon as possible.</p> <p>According to <strong>The Yankee Group</strong>, between <strong>40% to 80%</strong> of new business leads aren't converted simply due to lack of follow-up. Don't commit the same mistake- make the most out of e-channels.</p><p>So act NOW and make sure you derive maximum value out of <strong>Deal4loans</strong> partnership.</p><p> <br>Assuring you of our best service<br>Team<b> <a href=' http://www.deal4loans.com'>deal4loans.com</a></b></p><br></font></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table>";
		
		// To send HTML mail, the Content-type header must be set
		// Additional headers
		//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		/*$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= 'Cc: shweta.sharma@deal4loans.com' . "\r\n";
		$headers .= 'Bcc:ranjana5chauhan@gmail.com' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
$headers = "From: deal4loans <no-reply@deal4loans.com>";
//$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: shweta.sharma@deal4loans.com "."\n";
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $message1 . "\n\n";
		//echo $headers;
		//echo $message;
		// Mail it
			if($email)
			{
			     $currenttime = date('H');
	
				if($currenttime==8)
				{
					mail($email, $subject, $message, $headers);
					echo $email."<br>";
    			        }


			 }
		}	
	}
	
}
else
{
	echo "Not on Specified Date";
}
	
?>
