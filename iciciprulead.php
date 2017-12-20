<?php
//This file will need bimadealsdb connection string. THen we can do this.
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
require 'scripts/db_init_bima.php';
$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$Today = date("Y-m-d", $yesterday); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";

echo $query1="select RequestID from Req_Compaign Where ( Bank_Name='ICICIPru Bimadeals' and Compaign_ID=3733)";
echo "<br>";

 list($recordcount,$qrow)=MainselectfuncNew($query1,$array = array());
		$cntr=0;

$RequestID = $qrow[$cntr]['RequestID'];
//$Dated = $qrow['Dated'];
$Dated = date("Y-m-d")." 00:00:00";
//374669
//327938
if($RequestID>0)
{
	$search_query = "select * from client_campaign_leads where (client_name='iciciprulife' and (clientld_date >='".$Dated."') and clientld_city in ('Ahmedabad','Bangalore','Baroda','Chennai','Delhi','Hyderabad','Kolkata','Mumbai','Pune','Surat','Vizag') and clientldid> '".$RequestID."')";

}

	//echo "hello1".$search_query."<br>";
	 list($recorcount,$Myrow)=MainselectfuncNew($search_query,$array = array());
	
	echo  $recorcount."<br>";
	
	//$recorcount = 0;
if($recorcount>0)
{
	//while($row = mysql_fetch_array($result))
	for($j=0;$j<$recorcount;$j++)
	{
		$RequestID= $Myrow[$j]['clientldid']; //$row["Feedback_ID"];
		$mRequestID = $Myrow[$j]['requestid'];
		$getMoreSql = "select * from Req_Credit_Card where RequestID='".$mRequestID."'";
		list($recorcount,$Arrow)=MainselectfuncNew($getMoreSql,$array = array());
		
		
		$first = $Myrow[$j]['clientld_name']; //$row["Name"];
		$mobile= $Myrow[$j]['clientld_mobile']; //$row["Phone"];
		$dob= $Arrow[0]['DOB']; //$row["DOB"];
		$email= $Myrow[$j]['clientld_email']; //$row["Email"];
		 $city= $Myrow[$j]['clientld_city'];
		if($city=="Others")
        {
            $city= $Myrow[$j]['City_Other']; //$row["City_Other"];
        }
        else
        {
	          $city= $Myrow[$j]['clientld_city'];
        }
		$dated = $Myrow[$j]['Allocation_Date']; //$row["Allocation_Date"];
		

			if(strtoupper($city)==strtoupper("Ahmedabad"))
			{
				$cityval="3";
			}
			elseif(strtoupper($city)==strtoupper("Bangalore"))
			{
				$cityval="11";
			}
			elseif(strtoupper($city)==strtoupper("Baroda"))
			{
				$cityval="13";
			}
			elseif(strtoupper($city)==strtoupper("Vadodara"))
			{
				$cityval="13";
			}
			elseif(strtoupper($city)==strtoupper("Chandigarh"))
			{
				$cityval="22";
			}
			elseif(strtoupper($city)==strtoupper("Chennai"))
			{
				$cityval="24";
			}
			elseif(strtoupper($city)==strtoupper("Coimbatore"))
			{
				$cityval="26";
			}
			elseif(strtoupper($city)==strtoupper("Delhi"))
			{
				$cityval="491";// 20 -04- 2009 change made as per told by bhavya 
			}
			elseif(strtoupper($city)==strtoupper("Gurgaon"))
			{
				//$cityval="492";
				$cityval="491";// 20 -04- 2009 change made as per told by bhavya 
			}
			elseif(strtoupper($city)==strtoupper("Gaziabad"))
			{
				//$cityval="492";
				$cityval="491";// 20 -04- 2009 change made as per told by bhavya 
			}
			elseif(strtoupper($city)==strtoupper("Noida"))
			{
				//$cityval="492";
				$cityval="491";// 20 -04- 2009 change made as per told by bhavya 
			}
			elseif(strtoupper($city)==strtoupper("Greater Noida"))
			{
				//$cityval="492";
				$cityval="491";// 20 -04- 2009 change made as per told by bhavya 
			}
			elseif(strtoupper($city)==strtoupper("Hyderabad"))
				{
					$cityval="43";
				}
			elseif(strtoupper($city)==strtoupper("Indore"))
				{
					$cityval="45";
				}	
			elseif(strtoupper($city)==strtoupper("Jaipur"))
				{
					$cityval="48";
				}
			elseif(strtoupper($city)==strtoupper("Jalandhar"))
				{
					$cityval="49";
				}
			elseif(strtoupper($city)==strtoupper("Kanpur"))
				{
					$cityval="54";
				}
			elseif(strtoupper($city)==strtoupper("Kolkata"))
				{
					$cityval="20";
				}
			elseif(strtoupper($city)==strtoupper("Lucknow"))
				{
					$cityval="59";
				}
			elseif(strtoupper($city)==strtoupper("Mumbai"))
				{
					$cityval="67";
				}
				elseif(strtoupper($city)==strtoupper("Navi Mumbai"))//added on 290910 as defined in the bidder
				{
					$cityval="67";
				}
				elseif(strtoupper($city)==strtoupper("Thane"))//added on 290910 as defined in the bidder
				{
					$cityval="67";
				}
			elseif(strtoupper($city)==strtoupper("Nagpur"))
				{
					$cityval="69";
				}
			elseif(strtoupper($city)==strtoupper("Ludhiana"))
				{
					$cityval="60";
				}
			elseif(strtoupper($city)==strtoupper("Patna"))
				{
					$cityval="79";
				}
			elseif(strtoupper($city)==strtoupper("Pune"))
				{
					$cityval="80";
				}
			elseif(strtoupper($city)==strtoupper("Rajkot"))
				{
					$cityval="83";
				}
			elseif(strtoupper($city)==strtoupper("Surat"))
				{
					$cityval="92";
				}
			elseif(strtoupper($city)==strtoupper("Vijaywada"))
				{
					$cityval="100";
				}
			elseif(strtoupper($city)==strtoupper("Vizag"))
			{
				$cityval="473";
			}
			elseif(strtoupper($city)==strtoupper("Visakhapatnam"))
			{
				$cityval="473";
			}
			else
			{
				$cityval=ucwords(strtolower($city));
			}
//http://202.189.245.74//IPRU_INTERNET/insertsms.asp?Lead_id=506930&gender=&age=&email=&refsite=bimadeals&adunit=&channel=bimadeals&campaign=OCT_10&source=SMS_LIFE&product=Life&Agency=271&Lead=INCOMING_WEB&Mode=PREFIXED_APPOINTMENT&Full%20Name=KAUSIK%20GHOSAL&mobile=919007539656&city=20&Lead_time=2010-09-21%2000:16:46 

$param="";

		 $Lead_id = $Myrow[$j]['requestid']; // $row["RequestID"];
		 $Lead_time = date("Y-m-d H:i:s");
		  $nLead_time = date("Y/m/d H:i:s A");
		 $first_name = $first; 
		 $age = date('Y')-substr($dob,0,4);  
	//	 $title = "Mr"; 
		 $email = $email;
		 $mobile = $mobile;
		 $campaign = date("M")."_".date("y");
//		 $param["first_name"] = $first;
		 
		
		
//		 if($cityval==491 || $cityval==43 || $cityval==80)// New URL		 
		 if($cityval==43 || $cityval==80 || $cityval==22 || $cityval==60 || $cityval==45  || $cityval==491 || $cityval==3 || $cityval==92 || $cityval==13|| $cityval==24 )// New URL
		 {
		 
			//intouch data
			
		//http://122.160.232.126/apps/ipru.php?Lead_id=214&gender=Male&age=32&email=test@rediffmail.com&refsite=BimaDeals&adunit=&channel=Alliance&campaign=Apr_11&source=BimaDeals&product=Life&Agency=271&Lead=INCOMING_WEB&Mode=PREFIXED_APPOINTMENT&Full%20&name=rupa&first_name=rupa&mobile=8080483308&city=67&dob=2012&AnnInc=1000000&Lead_time=4/26/2011%2010:38:26%20AM
		//http://122.160.232.126/apps/ipru.php?Lead_id=301036&gender=&age=36&email=S.srinivas_75%40yahoo.co.in&refsite=BimaDeals&adunit=&channel=Alliance&campaign=Nov_11&source=BimaDeals&product=Life&Agency=271&Lead=INCOMING_WEB&Mode=PREFIXED_APPOINTMENT&Full%20&name=S+Srinivas+RAO&first_name=S+Srinivas+RAO&mobile=9030293627&city=43&dob=0107&AnnInc=250000&Lead_time=2011-11-30%2010:38:26%20AM 

			 $expDOB = explode("-", $dob);
			 $year = $expDOB[2]."".$expDOB[1]."".$expDOB[0]; 
			 $nyear=$expDOB[2]."".$expDOB[1];
			 
		 $param["Lead_id"] = $Lead_id;
		 $param["gender"] = $gender;
		 $param["age"] = $age;
		 $param["email"] = $email;
		 $param["refsite"] = "BimaDeals";
		 $param["adunit"] = "";
		 $param["channel"] = "Alliance";
		 $param["campaign"] = $campaign;
		 $param["source"] = "Deal4loans";
		 $param["product"] = "Life";
		 $param["Agency"] = "271";
		 $param["Lead"] = "INCOMING_WEB";		
		 $param["Mode"] = "PREFIXED_APPOINTMENT";
		 $param["Full%20&name"] = $first;
		 $param["first_name"] = $first;
		 $param["mobile"] = $mobile;
		 $param["city"] = $cityval;
		
		 $Net_Salary= mysql_result($getMoreQuery,0,'Net_Salary'); //$row["Net_Salary"];
		 $param["dob"] = $nyear;
		 $param["AnnInc"] = $Net_Salary;
		 $param["Lead_time"] = $nLead_time;
		
			//intouch data
			
		 }
 		 else
		 {
		 
		  $param["Lead_id"] = $Lead_id;
		 $param["gender"] = $gender;
		 $param["age"] = $age;
		 $param["email"] = $email;
		 //$param["refsite"] = "bimadeals";
		 //$param["adunit"] = "";
		 //$param["channel"] = "bimadeals";
		 //$param["campaign"] = $campaign;
		 //$param["source"] = "SMS_LIFE";
		 //$param["product"] = "Life";
		 $param["Agency"] = "271";
		 $param["Lead"] = "INCOMING_WEB";		
		 $param["Mode"] = "PREFIXED_APPOINTMENT";
		 $param["Full%20Name"] = $first;
		 $param["mobile"] = $mobile;
		 $param["city"] = $cityval;
		 
			 $param["refsite"] = "bimadeals";
			 $param["adunit"] = "";
			 $param["channel"] = "bimadeals";
			 $param["campaign"] = $campaign;
			 $param["source"] = "Deal4loans";
			 $param["product"] = "Life";
			 
			 $param["Lead_time"] = $Lead_time;
		 }
	
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

echo "<br>";
echo $request;
echo "<br>";


// 		 if($cityval==491 || $cityval==43 || $cityval==80)// New URL
 		 if($cityval==43 || $cityval==80 || $cityval==22 || $cityval==60 || $cityval==45  || $cityval==491 || $cityval==3 || $cityval==92 || $cityval==13 || $cityval==24 )// New URL
		 {
			$host = "122.160.232.126";  //intouch
			$script = "/apps/ipru.php"; //intouch
			//$host = "114.143.97.208";
			//$script = "//IPRU_INTERNET/insertsms.asp";
		    $url = "http://122.160.232.126/apps/ipru.php?".$request;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec ($ch);
		    print_r($content); 
			curl_close ($ch);  
		 }
 		 else
		 {
			//First prepare the info that relates to the connection
			$host = "114.143.97.208";
		//	$script = "/lom/insurance/hi_submit.php";
			$script = "//IPRU_INTERNET/insertsms.asp";
			
			$request_length = strlen($request);
			$method = "GET"; // must be POST if sending multiple messages
			if ($method == "GET") 
			{
			  $script .= "?$request";
			}
		
			//Now comes the header which we are going to post. 
			$header = "$method $script HTTP/1.1\r\n";
			$header .= "Host: $host\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: $request_length\r\n";
			$header .= "Connection: close\r\n\r\n";
			$header .= "$request\r\n";
		
			//echo $header;
			//echo "<br>";
		
			//Now we open up the connection
			$socket = @fsockopen($host, 80, $errno, $errstr); 
			if ($socket) //if its open, then...
			{ 
			  fputs($socket, $header); // send the details over
			  while(!feof($socket))
			  {
				$output[] = fgets($socket); //get the results 
			  }
			  fclose($socket); 
			} 

		 }
	
	
	//echo "<br>";
	print_r($output);
//if($cityval==491 || $cityval==43 || $cityval==80 || $cityval==492)
if($cityval==43 || $cityval==80 || $cityval==22 || $cityval==60 || $cityval==45  || $cityval==491 || $cityval==3 || $cityval==24 || $cityval==20)// New URL
		{
	$fnal = $output[39];
		}
		else
		{
	$str = $output[11];
	$explodeStr = explode("#", $str);
	$fnal = $explodeStr[2];

		}
		echo "<br>";

		
		$dataInsert = array("name"=>$first, "age"=>$age, "mobile"=>$mobile, "city"=>$cityval, "feedback_id"=>$Lead_id, "RequestID"=>$RequestID, "Dated"=>$Dated, "status"=>$explodeStr[2]);
$table = 'icicipru_track_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
			echo "<br>";	
		echo $updateSql = "update Req_Compaign set RequestID='".$RequestID."' where (Compaign_ID=3733)";
		
		
		mysql_query($updateSql);
			echo "<br>";
	}


		
}

$currDate =  date("Y-m-d H:i:s");
if($currDate>date("Y-m-d")." 23:45:00")
{
$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";

$sql = "select * from icicipru_track_leads where Dated between '".$min_date."' and '".$max_date."' group by RequestID";
	
	 list($num,$rowArr)=MainselectfuncNew($sql,$array = array());

	$email = "mehra3@gmail.com";
	$Message = "Count : ".$num;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'To: '.$full_name.' <'.$email.'>' . "\r\n";
	$headers .= 'From: bimadeals <no-reply@bimadeals.com>' . "\r\n";
	
	$headers  = 'From: bimadeals <no-reply@bimadeals.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@bimadeals.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($email,'ICICI Pru Leads Count', $Message, $headers);

echo "Upendrs";

}

if($recorcount>25)
{
	$email = "mehra3@gmail.com";
	$Message = "Count : ".$recorcount;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'To: '.$full_name.' <'.$email.'>' . "\r\n";
	$headers .= 'From: bimadeals <no-reply@bimadeals.com>' . "\r\n";
	
	$headers  = 'From: bimadeals <no-reply@bimadeals.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@bimadeals.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($email,'ICICI Pru Leads Count', $Message, $headers);

echo "Upendrs";

}

?>