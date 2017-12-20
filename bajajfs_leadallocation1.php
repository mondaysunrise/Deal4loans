<?php
require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

//Your Leads for V1 on (20-12-2011) : Name - YYYYYY, Mobile - 9999999
echo $marvcity="Delhi";$Net_Salary=700000;$Mobile_Number=9811215138;$Name="testlead";$bajajvalue=1272;

$sentflag=bajajfs($marvcity,$Net_Salary,$Mobile_Number,$Name,$bajajvalue);
echo $sentflag;

function bajajfs($city,$net_salary,$mobile,$name,$bajajvalue)
{
	//echo $city." - ".$net_salary." - ".$mobile."".$name." - ".$mobile."".$bajajvalue;

	if(($city=="Chennai" || $city=="Bangalore" || $city=="Hyderabad" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad" || $city=="Ahmedabad" || $city=="Kolkata") && $net_salary>=480000)
	{
		echo "hello";
		$getbid="select BidderID from Bidders_List Where (City like '%".$city."%' and Reply_Type=1 and Restrict_Bidder=1 and BidderID in (2423,3842,3335))";
		list($num_rows1,$bidrow) = Mainselectfunc($getbid,$array = array());	

		$bidno="select * from Req_Compaign Where (BidderID=".$bidrow["BidderID"]." and Sms_Flag=1)";
			list($num_rows2,$bidcno) = Mainselectfunc($bidno,$array = array());	
		$bidcontactno = $bidcno["Mobile_no"];
		 $currentdate=date('d-m-Y');
		$smstext="Your Leads for pl on (".$currentdate.") : Name - ".$name.", Mobile - ".$mobile.", City - ".$city;
$rcno=9811215138;
			if(strlen(trim($bidcontactno)) > 0)
		{
			 SendSMSforLMS($smstext, $bidcontactno);
			 //SendSMSforLMS($smstext."-".$bidcontactno, $rcno);
		}

		$dataUpdate = array('bajajf_sent'=>'1');
		$wherecondition = "(bajaj_finservid=".$bajajvalue.")";
		Mainupdatefunc ('bajaj_finserv_mailer_leads', $dataUpdate, $wherecondition);

		$sentflag=1;

	}
	else if(($city=="Pune" || $city=="Vijaywada" || $city=="Vijayawada" || $city=="Vizag" || $city=="Vishakapatnam" || $city=="Madurai" || $city=="Surat" || $city=="Rajkot" || $city=="Indore" || $city=="Nagpur" || $city=="Aurangabad" || $city=="Cochin" || $city=="Kochi" ||  $city=="Ernakulam" || $city=="Chandigarh" || $city=="Mohali" ||  $city=="Panchkula" || $city=="Kharar" || $city=="Ziragpur" || $city=="Ludhiana" || $city=="Jalandhar" || $city=="Jaipur" || $city=="Jodhpur" || $city=="Baroda" || $city=="Vadodara" || $city=="Nasik" || $city=="Mysore" || $city=="Panipat" || $city=="Panipat" || $city=="Karnal" || $city=="Yamunanagar") && $net_salary>=360000)
	{
		
		$getbid="select BidderID from Bidders_List Where (City like '%".$city."%' and Reply_Type=1 and Restrict_Bidder=1 and BidderId in (2423,3842,3335))";
		list($num_rows1,$bidrow) = Mainselectfunc($getbid,$array = array());
			list($num_rows2,$bidcno) = Mainselectfunc($bidno,$array = array());	
		$bidcontactno = $bidcno["Mobile_no"];
		 $currentdate=date('d-m-Y');
		$smstext="Your Leads for pl on (".$currentdate.") : Name - ".$name.", Mobile - ".$mobile.", City - ".$city;

		$rcno=9811215138;

		if(strlen(trim($bidcontactno)) > 0)
		{
			SendSMSforLMS($smstext, $bidcontactno);
		}

		$dataUpdate = array('bajajf_sent'=>'1');
		$wherecondition = "(bajaj_finservid=".$bajajvalue.")";
		Mainupdatefunc ('bajaj_finserv_mailer_leads', $dataUpdate, $wherecondition);
		$sentflag=1;
	}
	else
	{	
		

		$rcno=9811215138;
		if(strlen(trim($bidcontactno)) > 0)
		{
			//SendSMSforLMS($smstext, $bidcontactno);
			SendSMSforLMS($smstext, $rcno);
		}

$sentflag=0;
	}

	return($sentflag);
}


?>