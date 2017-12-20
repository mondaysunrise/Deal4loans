<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$startprocess="Select * From lead_allocation_table Where (Citywise like '%CC LMS%' and BidderID=935)";
echo $startprocess."<br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);

$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	//product cc
		$select4mcards ="Select RequestID,City,City_Other From Req_Credit_Card Where (((Req_Credit_Card.Employment_Status=1 and 
		(((Req_Credit_Card.Net_Salary>=210000 and Req_Credit_Card.Net_Salary < 300000) and (Req_Credit_Card.Salary_Account like '%ICICI%')) or (Req_Credit_Card.Net_Salary>=300000) or 
		(Req_Credit_Card.CC_Holder=1 and Req_Credit_Card.Card_Vintage>=4 and Req_Credit_Card.Credit_Limit>=2))) or (Req_Credit_Card.Employment_Status=0 and Req_Credit_Card.Net_Salary>=250000 and ((Req_Credit_Card.Salary_Account like '%ICICI%') or (Req_Credit_Card.No_of_Banks like '%ICICI%')))) and lead_cost=0 and cards_flag=0 and applied_card_name not like '%ICICI%' and RequestID>".$total_lead_count.")";
}
else
{
	$fmiciciallocate="select * from icicilms_allocation Where (1=1) order by iciciallocateid DESC LIMIT 0,1";
	$fmiciciallocateresult = ExecQuery($fmiciciallocate);
	$row1 = mysql_fetch_array($fmiciciallocateresult);
	$ccrequestid = $row1["cc_requestid"];
	
	$select4mcards ="Select RequestID,City,City_Other From Req_Credit_Card Where (((Req_Credit_Card.Employment_Status=1 and 
		(((Req_Credit_Card.Net_Salary>=210000 and Req_Credit_Card.Net_Salary < 300000) and (Req_Credit_Card.Salary_Account like '%ICICI%')) or (Req_Credit_Card.Net_Salary>=300000) or 
		(Req_Credit_Card.CC_Holder=1 and Req_Credit_Card.Card_Vintage>=4 and Req_Credit_Card.Credit_Limit>=2))) or (Req_Credit_Card.Employment_Status=0 and Req_Credit_Card.Net_Salary>=250000 and ((Req_Credit_Card.Salary_Account like '%ICICI%') or (Req_Credit_Card.No_of_Banks like '%ICICI%')))) and lead_cost=0 and cards_flag=0 and applied_card_name not like '%ICICI%' and RequestID>".$ccrequestid.")";
}
echo $select4mcards."<br>";
$select4mcardsresult = ExecQuery($select4mcards);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";
while($row2 = mysql_fetch_array($select4mcardsresult))
{
	$ccrequestID = $row2["RequestID"];
	$city = $row2["City"];
	$other_city = $row2["City_Other"];

	if($city=="Others" && strlen($other_city)>0)
	{
		$checkCity = $other_city;
	}
	else
	{
		$checkCity = $city;
	}

	$citystr="Gurgaon,Hyderabad,Bengaluru,Chennai,Ahmedabad,Mumbai,Pune,Noida,Indore,Navi Mumbai,Delhi,Bhopal,Thane,Greater Noida,Baroda,Faridabad,Kolhapur,Mangalore,Vadodara,Bangalore";
	$cityArr = explode(",", $citystr);
		if(in_array($checkCity, $cityArr) && $ccrequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents from lead_allocation_table Where (Citywise like '%CC LMS%' and BidderID=935)");
			
			$seqid = mysql_fetch_array($sequenceid);
			$last_allocated_to = $seqid["last_allocated_to"];
			$total_no_agents = $seqid["total_no_agents"];
			
		/*	if($total_no_agents>$last_allocated_to)
			{
				$sequence=$last_allocated_to+1;
			}
			else
			{
				$sequence=1;
			}*/

	$bidderID = "69";

			if($ccrequestID>0 && $bidderID>0)
			{
				//insert allocation
				$inserticiciqry="INSERT INTO icicilms_allocation (`cc_requestid`, `bidderid`, `product`, `allocation_date`) VALUES ( '".$ccrequestID."', '".$bidderID."', '4', Now())";
				$inserticiciqryresult = ExecQuery($inserticiciqry);

				echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$ccrequestID."' Where (Citywise like '%CC LMS%' and BidderID=935)";
				$updateqryresult = ExecQuery($updateqry);

			}

		}
}
