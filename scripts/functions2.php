<?php
if((strlen(strpos($_SERVER['HTTP_ORIGIN'], "taichinhonline")) > 0) || (strlen(strpos($_SERVER['HTTP_REFERER'], "taichinhonline")) > 0))
{
	header("Location: 404.html");
	exit();
}
if((strlen(strpos($_SERVER['SERVER_SIGNATURE'], "www.deal4loans.com")) > 0))
{
}
else
{
	header("Location: 404.html");
	exit();
}
  if($_SERVER['HTTPS']=="on")
  {
     $redirect= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     header("Location:$redirect");
  }
	error_reporting(0);
	$SiteName="Deal4Loans";
	$AdminName="Admin-$SiteName";
	include "valueValidation.php";
   ////////////////////////////////////////Radio Checked
	function AmIChecked($key,$val){
	return ($key==$val)?"Checked":"";
	}
   ////////////////////////////////////////Combo Selected
   function AmISelected($text, $key, $val){
	$Selected = ($key==$val)?" Selected":"";	
	return "<option value=\"$val\"$Selected>$text</option>";
   }

   ////////////////////////////////////////
	function dir_name()
	{
	$strDir;
	$strDir = dirname($_SERVER['PHP_SELF']);

	if(substr($strDir,strlen($strDir)-1,1)!='/')
		$strDir = $strDir."/";		

	return $strDir;
	}
   ////////////////////////////////////////

   function getCityList($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "Please Select");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
   	   $strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
	   $strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
   	   $strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
   	   $strCity = $strCity.AmISelected("Bhiwadi", $key, "Bhiwadi");
   	   $strCity = $strCity.AmISelected("Bhopal", $key, "Bhopal");
	   $strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
   	   $strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
	   $strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
   	   $strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
	   $strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
   	   $strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
	   $strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
   	   $strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
   	   $strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
	   $strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
   	   $strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
   	   $strCity = $strCity.AmISelected("Guwahati", $key, "Guwahati");
	   $strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
   	   $strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
	   $strCity = $strCity.AmISelected("Indore", $key, "Indore");
   	   $strCity = $strCity.AmISelected("Jabalpur", $key, "Jabalpur");
   	   $strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
	   $strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
   	   $strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
   	   $strCity = $strCity.AmISelected("Kochi", $key, "Kochi");
	   $strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
   	   $strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
	   $strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
   	   $strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
	   $strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
   	   $strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
	   $strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
   	   $strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
	   $strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
   	   $strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
	   $strCity = $strCity.AmISelected("Noida", $key, "Noida");
   	   $strCity = $strCity.AmISelected("Patna", $key, "Patna");
   	   $strCity = $strCity.AmISelected("Pune", $key, "Pune");
   	   $strCity = $strCity.AmISelected("Ranchi", $key, "Ranchi");
	   $strCity = $strCity.AmISelected("Raipur", $key, "Raipur");
	   $strCity = $strCity.AmISelected("Rewari", $key, "Rewari");
	   $strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
   	   $strCity = $strCity.AmISelected("Surat", $key, "Surat");
	   $strCity = $strCity.AmISelected("Thane", $key, "Thane");
	   $strCity = $strCity.AmISelected("Thiruvananthapuram", $key, "Thiruvananthapuram");
   	   $strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
	   $strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
	   $strCity = $strCity.AmISelected("Vadodara", $key, "Vadodara");
   	   $strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
	   $strCity = $strCity.AmISelected("Vizag", $key, "Vizag");
	   $strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}

   ////////////////////////////////////////Yes/No
   function getCityList1($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Select your City", $key, "Select Your City");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
   	   $strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
	   $strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
   	   $strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
	   $strCity = $strCity.AmISelected("Bhiwadi", $key, "Bhiwadi");
   	   $strCity = $strCity.AmISelected("Bhopal", $key, "Bhopal");
	   $strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
   	   $strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
	   $strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
   	   $strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
	   $strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
   	   $strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
	   $strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
   	   $strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
   	   $strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
	   $strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
   	   $strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
   	   $strCity = $strCity.AmISelected("Guwahati", $key, "Guwahati");
	   $strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
   	   $strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
	   $strCity = $strCity.AmISelected("Indore", $key, "Indore");
   	   $strCity = $strCity.AmISelected("Jabalpur", $key, "Jabalpur");
   	   $strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
	   $strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
   	   $strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
   	   $strCity = $strCity.AmISelected("Kochi", $key, "Kochi");
	   $strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
   	   $strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
	   $strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
   	   $strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
	   $strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
   	   $strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
	   $strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
   	   $strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
	   $strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
   	   $strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
	   $strCity = $strCity.AmISelected("Noida", $key, "Noida");
   	   $strCity = $strCity.AmISelected("Patna", $key, "Patna");
   	   $strCity = $strCity.AmISelected("Pune", $key, "Pune");
   	   $strCity = $strCity.AmISelected("Ranchi", $key, "Ranchi");
	   $strCity = $strCity.AmISelected("Raipur", $key, "Raipur");
   	   $strCity = $strCity.AmISelected("Rewari", $key, "Rewari");
	   $strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
   	   $strCity = $strCity.AmISelected("Surat", $key, "Surat");
	   $strCity = $strCity.AmISelected("Thane", $key, "Thane");
	   $strCity = $strCity.AmISelected("Thiruvananthapuram", $key, "Thiruvananthapuram");
   	   $strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
	   $strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
	   $strCity = $strCity.AmISelected("Vadodara", $key, "Vadodara");
   	   $strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
	   $strCity = $strCity.AmISelected("Vizag", $key, "Vizag");
	   $strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}
	//for compaign//
	function getCityListComp($key){
	  $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "Please Select");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
		$strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
		$strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
		$strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
		$strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
		$strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
		$strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
		$strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
		$strCity = $strCity.AmISelected("Jalandhar", $key, "Jalandhar");
		$strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
		$strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
		$strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
		$strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
		$strCity = $strCity.AmISelected("Pune", $key, "Pune");
		$strCity = $strCity.AmISelected("Surat", $key, "Surat");
		$strCity = $strCity.AmISelected("----------------", $key, "Please Select");
		$strCity = $strCity.AmISelected("Ananthpur", $key, "Ananthpur");
		$strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
		$strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
		$strCity = $strCity.AmISelected("Bhimavaram", $key, "Bhimavaram"); 
		$strCity = $strCity.AmISelected("Bhiwadi", $key, "Bhiwadi");
		$strCity = $strCity.AmISelected("Bhopal", $key, "Bhopal");
		$strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
		$strCity = $strCity.AmISelected("Calicut", $key, "Calicut");		
		$strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
		$strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
		$strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
		$strCity = $strCity.AmISelected("Dindigul", $key, "Dindigul");
		$strCity = $strCity.AmISelected("Eluru", $key, "Eluru");
		$strCity = $strCity.AmISelected("Ernakulam", $key, "Ernakulam");
		$strCity = $strCity.AmISelected("Erode", $key, "Erode");
		$strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
		$strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
		$strCity = $strCity.AmISelected("Guntur", $key, "Guntur");	   
		$strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
		$strCity = $strCity.AmISelected("Guwahati", $key, "Guwahati");
		$strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
		$strCity = $strCity.AmISelected("Indore", $key, "Indore");
		$strCity = $strCity.AmISelected("Jabalpur", $key, "Jabalpur");		
		$strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
		$strCity = $strCity.AmISelected("Kakinada", $key, "Kakinada");
		$strCity = $strCity.AmISelected("Karaikkal", $key, "Karaikkal");
		$strCity = $strCity.AmISelected("Karimnagar", $key, "Karimnagar");
		$strCity = $strCity.AmISelected("Karur", $key, "Karur");
		$strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
		$strCity = $strCity.AmISelected("Khammam", $key, "Khammam");
		$strCity = $strCity.AmISelected("Kishangarh", $key, "Kishangarh");
		$strCity = $strCity.AmISelected("Kochi", $key, "Kochi");
		$strCity = $strCity.AmISelected("Kozhikode", $key, "Kozhikode");
		$strCity = $strCity.AmISelected("Kumbakonam", $key, "Kumbakonam");	
		$strCity = $strCity.AmISelected("Kurnool", $key, "Kurnool");
		$strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
		$strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
		$strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
		$strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
		$strCity = $strCity.AmISelected("Nagerkoil", $key, "Nagerkoil");
		$strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
		$strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
		$strCity = $strCity.AmISelected("Nellore", $key, "Nellore");
		$strCity = $strCity.AmISelected("Nizamabad", $key, "Nizamabad");
		$strCity = $strCity.AmISelected("Noida", $key, "Noida");
		$strCity = $strCity.AmISelected("Ongole", $key, "Ongole");
		$strCity = $strCity.AmISelected("Ooty", $key, "Ooty");
		$strCity = $strCity.AmISelected("Patna", $key, "Patna");
		$strCity = $strCity.AmISelected("Pondicherry", $key, "Pondicherry");
		$strCity = $strCity.AmISelected("Pudukottai", $key, "Pudukottai");
		$strCity = $strCity.AmISelected("Rajahmundry", $key, "Rajahmundry");
		$strCity = $strCity.AmISelected("Ramagundam", $key, "Ramagundam");
		$strCity = $strCity.AmISelected("Raipur", $key, "Raipur");
		$strCity = $strCity.AmISelected("Rewari", $key, "Rewari");
		$strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
		$strCity = $strCity.AmISelected("Salem", $key, "Salem");
		$strCity = $strCity.AmISelected("Srikakulam", $key, "Srikakulam");
		$strCity = $strCity.AmISelected("Thane", $key, "Thane");
		$strCity = $strCity.AmISelected("Thanjavur", $key, "Thanjavur");
		$strCity = $strCity.AmISelected("Thrissur", $key, "Thrissur");
		$strCity = $strCity.AmISelected("Thiruvananthapuram", $key, "Thiruvananthapuram");
		$strCity = $strCity.AmISelected("Tirunelveli", $key, "Tirunelveli");
		$strCity = $strCity.AmISelected("Tirupathi", $key, "Tirupathi");
		$strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
		$strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
		$strCity = $strCity.AmISelected("Tuticorin", $key, "Tuticorin");
		$strCity = $strCity.AmISelected("Vadodara", $key, "Vadodara");
		$strCity = $strCity.AmISelected("Vellore", $key, "Vellore");
		$strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
		$strCity = $strCity.AmISelected("Vizag", $key, "Vizag");
		$strCity = $strCity.AmISelected("Vizianagaram", $key, "Vizianagaram");
		$strCity = $strCity.AmISelected("Warangal", $key, "Warangal");
		$strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}
   //////////////////////////////////////////////
function plgetCityList($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "Please Select");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
		$strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
		$strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
		$strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
		$strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
		$strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
		$strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
		$strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
		$strCity = $strCity.AmISelected("Jalandhar", $key, "Jalandhar");
		$strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
		$strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
		$strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
		$strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
		$strCity = $strCity.AmISelected("Pune", $key, "Pune");
		$strCity = $strCity.AmISelected("Surat", $key, "Surat");		
		$strCity = $strCity.AmISelected("Ananthpur", $key, "Ananthpur");
		$strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
		$strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
		$strCity = $strCity.AmISelected("Bahadurgarh", $key, "Bahadurgarh");
		$strCity = $strCity.AmISelected("Bhimavaram", $key, "Bhimavaram"); 
		$strCity = $strCity.AmISelected("Bhiwadi", $key, "Bhiwadi");
		$strCity = $strCity.AmISelected("Bhopal", $key, "Bhopal");
		$strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
		$strCity = $strCity.AmISelected("Calicut", $key, "Calicut");		
		$strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
		$strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
		$strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
		$strCity = $strCity.AmISelected("Dindigul", $key, "Dindigul");
		$strCity = $strCity.AmISelected("Eluru", $key, "Eluru");
		$strCity = $strCity.AmISelected("Ernakulam", $key, "Ernakulam");
		$strCity = $strCity.AmISelected("Erode", $key, "Erode");
		$strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
		$strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
		$strCity = $strCity.AmISelected("Guntur", $key, "Guntur");	   
		$strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
		$strCity = $strCity.AmISelected("Guwahati", $key, "Guwahati");
		$strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
		$strCity = $strCity.AmISelected("Indore", $key, "Indore");
		$strCity = $strCity.AmISelected("Jabalpur", $key, "Jabalpur");		
		$strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
		$strCity = $strCity.AmISelected("Kakinada", $key, "Kakinada");
		$strCity = $strCity.AmISelected("Karaikkal", $key, "Karaikkal");
		$strCity = $strCity.AmISelected("Karimnagar", $key, "Karimnagar");
		$strCity = $strCity.AmISelected("Karur", $key, "Karur");
		$strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
		$strCity = $strCity.AmISelected("Khammam", $key, "Khammam");
		$strCity = $strCity.AmISelected("Kishangarh", $key, "Kishangarh");
		$strCity = $strCity.AmISelected("Kochi", $key, "Kochi");
		$strCity = $strCity.AmISelected("Kozhikode", $key, "Kozhikode");
		$strCity = $strCity.AmISelected("Kumbakonam", $key, "Kumbakonam");	
		$strCity = $strCity.AmISelected("Kurnool", $key, "Kurnool");
		$strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
		$strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
		$strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
		$strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
		$strCity = $strCity.AmISelected("Nagerkoil", $key, "Nagerkoil");
		$strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
		$strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
		$strCity = $strCity.AmISelected("Nellore", $key, "Nellore");
		$strCity = $strCity.AmISelected("Nizamabad", $key, "Nizamabad");
		$strCity = $strCity.AmISelected("Noida", $key, "Noida");
		$strCity = $strCity.AmISelected("Ongole", $key, "Ongole");
		$strCity = $strCity.AmISelected("Ooty", $key, "Ooty");
		$strCity = $strCity.AmISelected("Patna", $key, "Patna");
		$strCity = $strCity.AmISelected("Pondicherry", $key, "Pondicherry");
		$strCity = $strCity.AmISelected("Pudukottai", $key, "Pudukottai");
		$strCity = $strCity.AmISelected("Rajahmundry", $key, "Rajahmundry");
		$strCity = $strCity.AmISelected("Ramagundam", $key, "Ramagundam");
		$strCity = $strCity.AmISelected("Raipur", $key, "Raipur");
		$strCity = $strCity.AmISelected("Rewari", $key, "Rewari");
		$strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
		$strCity = $strCity.AmISelected("Salem", $key, "Salem");
		$strCity = $strCity.AmISelected("Srikakulam", $key, "Srikakulam");
		$strCity = $strCity.AmISelected("Thane", $key, "Thane");
		$strCity = $strCity.AmISelected("Thanjavur", $key, "Thanjavur");
		$strCity = $strCity.AmISelected("Thrissur", $key, "Thrissur");
		$strCity = $strCity.AmISelected("Thiruvananthapuram", $key, "Thiruvananthapuram");
		$strCity = $strCity.AmISelected("Tirunelveli", $key, "Tirunelveli");
		$strCity = $strCity.AmISelected("Tirupathi", $key, "Tirupathi");
		$strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
		$strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
		$strCity = $strCity.AmISelected("Tuticorin", $key, "Tuticorin");
		$strCity = $strCity.AmISelected("Vadodara", $key, "Vadodara");
		$strCity = $strCity.AmISelected("Vellore", $key, "Vellore");
		$strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
		$strCity = $strCity.AmISelected("Vizag", $key, "Vizag");
		$strCity = $strCity.AmISelected("Vizianagaram", $key, "Vizianagaram");
		$strCity = $strCity.AmISelected("Warangal", $key, "Warangal");
		$strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}

////////////Credit Card City List///////////////////////////////////////

 function CCgetCityList($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "Please Select");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
	   $strCity = $strCity.AmISelected("Ambala", $key, "Ambala");
	   $strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
	   $strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
   	   $strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
   	   $strCity = $strCity.AmISelected("Bhiwadi", $key, "Bhiwadi");
   	   $strCity = $strCity.AmISelected("Bhopal", $key, "Bhopal");
	   $strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
   	   $strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
	   $strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
   	   $strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
	   $strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
   	   $strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
	   $strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
   	   $strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
	   $strCity = $strCity.AmISelected("Ernakulam", $key, "Ernakulam");
	   $strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
	   $strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
   	   $strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
   	   $strCity = $strCity.AmISelected("Guwahati", $key, "Guwahati");
	   $strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
   	   $strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
	   $strCity = $strCity.AmISelected("Indore", $key, "Indore");
   	   $strCity = $strCity.AmISelected("Jabalpur", $key, "Jabalpur");
   	   $strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
	   $strCity = $strCity.AmISelected("Jalandhar", $key, "Jalandhar");
	   $strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
   	   $strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
	   $strCity = $strCity.AmISelected("Kharar", $key, "Kharar");
	   $strCity = $strCity.AmISelected("Kochi", $key, "Kochi");
	   $strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
   	   $strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
	   $strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
   	   $strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
	   $strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
	   $strCity = $strCity.AmISelected("Mohali", $key, "Mohali");
   	   $strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
	   $strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
   	   $strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
	   $strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
   	   $strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
	   $strCity = $strCity.AmISelected("Noida", $key, "Noida");
	   $strCity = $strCity.AmISelected("Panchkula", $key, "Panchkula");
	   $strCity = $strCity.AmISelected("Patiala", $key, "Patiala");
	   $strCity = $strCity.AmISelected("Patna", $key, "Patna");
   	   $strCity = $strCity.AmISelected("Pune", $key, "Pune");
	   $strCity = $strCity.AmISelected("Rajkot", $key, "Rajkot");
	   $strCity = $strCity.AmISelected("Ranchi", $key, "Ranchi");
	   $strCity = $strCity.AmISelected("Raipur", $key, "Raipur");
	   $strCity = $strCity.AmISelected("Rewari", $key, "Rewari");
	   $strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
   	   $strCity = $strCity.AmISelected("Surat", $key, "Surat");
	   $strCity = $strCity.AmISelected("Thane", $key, "Thane");
	   $strCity = $strCity.AmISelected("Thiruvananthapuram", $key, "Thiruvananthapuram");
   	   $strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
	   $strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
	   $strCity = $strCity.AmISelected("Vadodara", $key, "Vadodara");
   	   $strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
	   $strCity = $strCity.AmISelected("Vizag", $key, "Vizag");
	   $strCity = $strCity.AmISelected("Ziragpur", $key, "Ziragpur");
	   $strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}

/////////////////////////////////////////////////////

  function getYesNo($val){
	return ($val==1)?"Yes":"No";
   }
   /////////////////////////////////////////////
	function getimage($val){
		$imge = '<img src="images/newmail.gif">';
		$text1 = '<font size="1" face="Verdana" color="#0000FF">New Reply</font>';
	return ($val==0)?"":"$imge $text1";
   }
   ////////////////////////////////////////
   function getimagebidder($val){
		$imge = '<img src="images/newmail.gif" alt="User Respose to your Reply">';
		$text1 = '<font size="2" color="#003C92">User Reply</font>';
	return ($val==0)?"-":"$imge $text1";
   }
   ////////////////////////////////////////
   function getimagebidderreply($val){
		$imge = '<img src="images/new.gif">';
	return ($val==1)?"":"$imge";
   }
   ////////////////////////////////////////Employment Status
   function getEmpStatus($val){
	return ($val==1)?"Salaried":"Self Employed";
   }
   ////////////////////////////////////////
   function getCarType($val){
	return ($val==1)?"New":"Old";
   }
   ////////////////////////////////////////Residential Status
   function getResidentialStatus($val){
	if($val==1)
	return "Owned";
	if($val==2)
	return "Rented";
	if($val==3)
	return "Company Provided";
   }
   ////////////////////////////////////////Car Make
   function getCarMake($val){
	if($val==1)
	return "Chevrolet";
	if($val==2)
	return "Fiat";
	if($val==3)
	return "Ford";
	if($val==4)
	return "General Motors";
	if($val==5)
	return "Hindustan Motors";
	if($val==6)
	return "Honda";
	if($val==7)
	return "Hyundai";
	if($val==8)
	return "Lexus";
	if($val==9)
	return "Mahindra & Mahindra";
	if($val==10)
	return "Maruti Udyog Ltd";
	if($val==11)
	return "Mercedes Benz";
	if($val==12)
	return "Nissan India";
	if($val==13)
	return "Porsche";
	if($val==14)
	return "Skoda Auto";
	if($val==15)
	return "Tata Motors";
	if($val==16)
	return "Toyota Kirlosker";
	if($val==17)
	return "Others";
   }
   ////////////////////////////////////////Property Type
   function getPropertyType($val){
	if($val==0)
	return "Commercial Office Space";
	if($val==1)
	return "Apartment";
	if($val==2)
	return "Industrial House";
	if($val==3)
	return "Showroom";
	if($val==4)
	return "Factory";
	if($val==5)
	return "Plot";
	if($val==6)
	return "Godown";
	if($val==7)
	return "Bungalow";
   }
   ////////////////////////////////////////Property Type
   function getCodeValue($pKey){
	$titles = array(
		'Marital1' => 'Single',
		'Marital2' => 'Married',
		'Resident1' => 'Owned',
		'Resident2' => 'Rented',
		'Resident3' => 'Company Provided',
		'Vehicle0' => '2 Wheeler',
		'Vehicle1' => '4 Wheeler',
		'Vehicle2' => 'Other',
		'Plan_Interested1' => 'Protection',
		'Plan_Interested2' => 'Investment',
		'Plan_Interested3' => 'Pension',	
		'Plan_Interested4' => 'Savings',
		'Loan0' => 'N/A',
		'Loan1' => 'Personal Loan',
		'Loan2' => 'Home Loan',		
		'Loan3' => 'Car Loan',
		'Loan4' => 'Other',
		'Inv0' => 'One Time',
		'Inv1' => 'Monthly',
		'Inv3' => 'Quarterly',
		'Inv6' => 'Six Monthly',
		'Inv12' => 'Yearly',
		'ReplyType_personal' => '1',
		'ReplyType_home' => '2',
		'ReplyType_car' => '3',
		'ReplyType_cc' => '4',
		'ReplyType_property' => '5',
		'ReplyType_business' => '6',
		'PostedBy1' => 'User',
		'PostedBy2' => 'Bidder'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

   ////////////////////////////////////////
   function getComboOption($strVal, $val){
	return ("<option selected value=$val>$strVal</option>");
   }
   ////////////////////////////////////////

   ////////////////////////////////////////
   function CountReplies(){
   
   }
   ////////////////////////////////////////
   function getRowID($i){
	return (($i %2) == 0)?1:2;
   }

   ////////////////////////////////////////
   function getAlert($msg, $redir, $url){
	$txt = "<script language=javascript>alert('".$msg."');";
	if($redir)
		$txt = $txt." location.href='$url'";

	return $txt."</script>";
   }

   ////////////////////////////////////////
   function getBar(){
	$Bar = "";
	if(!isset($_SESSION['UserType']))
		return $Bar;

	$Bar = "Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=Logout.php>Logout</a> )</b>";
	return $Bar;
   }

   ////////////////////////////////////////
   function FixString($strtofix){
	/** ESCAPES SPECIAL CHARACTERS FOR INSERTING INTO SQL **/
	if (get_magic_quotes_gpc()) { $addslash="no"; } else { $addslash="yes"; }
	if ($addslash == "yes") {  $strtofix = addslashes($strtofix); }
	$strtofix = ereg_replace(  "<", "&#60;", $strtofix );
	$strtofix = ereg_replace(  "'", "&#39;", $strtofix );
	$strtofix = ereg_replace(  "(\n)", "<BR>", $strtofix );
	return $strtofix;
   }

   ////////////////////////////////////////
   function FixNewLine($strtofix){
	return ereg_replace("<BR>", "\n", $strtofix);
   }

   ////////////////////////////////////////
   function setSessionUser($Email, $row){
	 /* Create Session Variables */
	$_SESSION['Email'] = $Email;

	$_SESSION['UserID'] = $row["UserID"];
	$_SESSION['UName'] = $row["FName"]." ".$row["LName"];
	$_SESSION['FName'] = $row["FName"];
	$_SESSION['LName'] = $row["LName"];
	
	list($day,$month,$year)=explode("-",$row["DOB"]);
	$_SESSION['Day'] = $day;
	$_SESSION['Month'] = $month;
	$_SESSION['Year'] = $year;
	
	$_SESSION['Phone'] = $row["Phone"];
	$_SESSION['JoinDate'] = $row["Join_Date"];
	$_SESSION['LastLogin'] = $row["Last_Login"];
	$_SESSION['CountRequests'] = $row["Count_Requests"];
	$_SESSION['IsPublic'] = $row["IsPublic"];
	$_SESSION['UserType'] = "user";
   }

	///////////////////////////////////////////
   function send_mail($to_name,$to_email,$from_name,$from_email,$subject,$message)
	{
    global $SiteName;
    get_admin_info($admin);
    $from_name="$SiteName";
    $from_email=$admin[admin_email];
    $text_ver=str_replace("<br>","\n",$message);
    $t = new htmlMimeMail();
    $from="$from_name <$from_email>";
    $cc="$from_name <$Admin_CCMail>";
    $t->setHtml($message,$text_ver);
    $t->setFrom($from);
    $t->setSubject($subject);
    $mail="$to_name <$to_email>";
    return $t->send(array($mail,''));
	}
   ////////////////////////////////////////
   function setSessionBidder($Login, $row){
	 /* Create Session Variables */
	$_SESSION['Login'] = $Login;

	$_SESSION['BidderID'] = $row["BidderID"];
	$_SESSION['UName'] = $row["Bidder_Name"];
	$_SESSION['Associated_Bank'] = $row["Associated_Bank"];
	$_SESSION['Selection_Category'] = $row["Selection_Category"];
	$_SESSION['City'] = $row["City"];
	$_SESSION['Address'] = $row["Address"];
	$_SESSION['Website'] = $row["Website"];
	$_SESSION['Email'] = $row["Email"];
	$_SESSION['Contact_Num'] = $row["Contact_Num"];
	$_SESSION['Profile'] = $row["Profile"];
	$_SESSION['JoinDate'] = $row["Join_Date"];
	$_SESSION['LastLogin'] = $row["Last_Login"];
	$_SESSION['CountReplies'] = $row["Count_Replies"];
	$_SESSION['hasNewReply'] = $row["Has_New_Reply"];
	$_SESSION['IsVerified'] = $row["Is_Verified"];
	$_SESSION['UserType'] = "bidder";
   }

	function makecomma($input)
	{
	   // This function is written by some anonymous person - I got it from Google
	   if(strlen($input)<=2)
	   { return $input; }
	   $length=substr($input,0,strlen($input)-2);
	   $formatted_input = makecomma($length).",".substr($input,-2);
	   return $formatted_input;
	}

	function formatInIndianStyle($num){
	   // This is my function
	   $pos = strpos((string)$num, ".");
	   if ($pos === false) { $decimalpart="00";}
	   else { $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos); }

	   if(strlen($num)>3 & strlen($num) <= 12){
				   $last3digits = substr($num, -3 );
				   $numexceptlastdigits = substr($num, 0, -3 );
				   $formatted = makecomma($numexceptlastdigits);
				   $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
	   }elseif(strlen($num)<=3){
				   $stringtoreturn = $num.".".$decimalpart ;
	   }elseif(strlen($num)>12){
				   $stringtoreturn = number_format($num, 2);
	   }

	   if(substr($stringtoreturn,0,2)=="-,"){$stringtoreturn = "-".substr($stringtoreturn,2 );}
	   return $stringtoreturn;
	}

	///////////////////////////////////////////////////////////
function convert_word_to_ascii($string) 
{
   $string = stripslashes($string);
   
   if ( stristr($_SERVER['HTTP_USER_AGENT'], "Opera") )
   $search = array('&#8216;',
               chr(96),
               '&#8217;', 
               '&#8222;', 
               '&#8221;',
               '&#8220;',
               '&#8230;',
               '&#8211;');
                           
   if ( stristr($_SERVER['HTTP_USER_AGENT'], "Firefox") || stristr($_SERVER['HTTP_USER_AGENT'], "MSIE") )
   $search = array(chr(145),
               chr(146), 
               chr(96),
               chr(132),
               chr(147),
               chr(148),
               chr(133),
               chr(150)); 
                           
   $replace = array(    "'",
               "'",
               "'",
               '"',
               '"',
               '"',
               '...',
               '-'); 
   $new_string = str_replace($search, $replace, $string);
   return addslashes($new_string);
}

//////////////////////////////////////////////////////////
function generatePassword($plength)
    {
	if(!is_numeric($plength) || $plength <= 0)
        {
            $plength = 8;
        }
        if($plength > 32)
        {
            $plength = 32;
        }

	$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
	mt_srand(microtime() * 1000000);
        for($i = 0; $i < $plength; $i++)
        {
           $key = mt_rand(0,strlen($chars)-1);
           $pwd = $pwd . $chars{$key};
        }
	   for($i = 0; $i < $plength; $i++)
        {
            $key1 = mt_rand(0,strlen($pwd)-1);
            $key2 = mt_rand(0,strlen($pwd)-1);

            $tmp = $pwd{$key1};
            $pwd{$key1} = $pwd{$key2};
            $pwd{$key2} = $tmp;
        }

        return $pwd;
    }

//////////////////////////////////////////////////////////

function getdd($sel_id,&$option,$show_all=0)
{
    $ss=0;
    for($i=1;$i<=31;$i++)
    {
        if($i==$sel_id){$sel="selected";$ss=1;}
        $option.="<option value=\"$i\"$sel>$i</option>";
        $sel="";
    }
    if($show_all==1)
    {
        if($sel_id==-2){$sel="selected";$ss=1;}
        $option="<option value=\"-2\" $sel>All</option>".$option;
    }
    if ($ss==0)
    {
         $option="<option value=\"-1\" selected>Select</option>".$option;
    }
    return 1;
}

////////////////////////////////////////////////////////
function getyy($sel_id,$s_yy,$e_yy,&$option,$show_all=0)
{
    $ss=0;
    for($i=$s_yy;$i<=$e_yy;$i++)
    {
        if($i==$sel_id){$sel="selected";$ss=1;}
        $option.="<option value=\"$i\"$sel>$i</option>";
        $sel="";
    }
    if($show_all==1)
    {
        if($sel_id==-2){$sel="selected";$ss=1;}
        $option="<option value=\"-2\" $sel>All</option>".$option;
    }
    if ($ss==0)
    {
         $option="<option value=\"-1\" selected>Select</option>".$option;
    }
    return 1;
}
////////////////////////////////////////////////////////////
function getmm($sel_id,&$option, $show_all=0)
{
    $mon[1]="January";
    $mon[2]="Febuary";
    $mon[3]="March";
    $mon[4]="April";
    $mon[5]="May";
    $mon[6]="June";
    $mon[7]="July";
    $mon[8]="August";
    $mon[9]="September";
    $mon[10]="October";
    $mon[11]="November";
    $mon[12]="December";
    $ss=0;
    for($i=1;$i<=12;$i++)
    {
        if($i==$sel_id){$sel="selected";$ss=1;}
        $option.="<option value=\"$i\"$sel>$mon[$i]</option>";
        $sel="";
    }
    if($show_all==1)
    {
        if($sel_id==-2){$sel="selected";$ss=1;}
        $option="<option value=\"-2\" $sel>All</option>".$option;
    }
    if ($ss==0)
    {
         $option="<option value=\"-1\" selected>Select</option>".$option;
    }
    return 1;
}
//////////////////////////////////////////////////////////
function get_nb_text($tot_rows,$title,$st_pos=0,&$con_limit,&$nb_text,$nrpp=0)
{
    global $Num_Rows_Per_Page;
    if(!$nrpp)
    {
	$nrpp=$Num_Rows_Per_Page;
    }
    #$nrpp=2;
    #creating next & back conditions
    if(strlen($st_pos)==0){$st_pos=0;}
    $con_limit=" LIMIT $st_pos, $nrpp";
    $con_srch="JavaScript:nb(";
    if($st_pos==0){$HB1="<!--";$HB2="-->";}
    if($st_pos>$nrpp){$HB1="";$HB2="";$st_bpos=($st_pos-$nrpp);}
    if($tot_rows<=$nrpp+$st_pos){$HN1="<!--";$HN2="-->";}
    if($tot_rows>($nrpp+$st_pos)){$HN1="";$HN2="";$st_npos=($st_pos+$nrpp);};
    if(strlen($st_bpos)==0){$st_bpos=0;}
    if(strlen($st_npos)==0){$st_npos=0;}
    $con_back=$con_srch.$st_bpos.")";
    $con_next=$con_srch.$st_npos.")";
    $curr_pos1=$st_pos+1;
    $curr_pos2=$st_pos+$nrpp;
    $last_pos=$tot_rows-$nrpp;
    $con_first="JavaScript:nb(0)";
    $con_last="JavaScript:nb($last_pos)";
    if($st_pos==0){$HF1="<!--";$HF2="-->";}
    if($st_pos+$nrpp>=$tot_rows){$HL1="<!--";$HL2="-->";}
    if($curr_pos2>$tot_rows){$curr_pos2=$tot_rows;}
    if($tot_rows==0){$curr_pos1=0;}
    $nb_text=<<<EOM
            $title $curr_pos1 - $curr_pos2 of $tot_rows &nbsp;
            $HF1<a href="$con_first">$HF2 First $HF1</a>$HF2
            || $HB1<a href="$con_back">$HB2 Previous $HB1</a>$HB2
            || $HN1<a href="$con_next">$HN2 Next$HN1</a>$HN2
            || $HL1<a href="$con_last">$HL2 Last$HL1</a>$HL2
EOM
;
}
//////////////////////////////////////////////////////////
function listbox_date($name, $default=0)
	{ 
    $result="<select name=".$name." size=1>n"; 
    for ($d=1;$d<=31;$d++) { 
        if ($default  == $d) {$selected="selected";} else {$selected="";} 
        $result.="<option value=".$d." $selected>$d</option>n"; 
    } 
    $result.="</select>n"; 
return $result; 
	} 

function listbox_month($name, $default=0)
	{ 
    $result="<select name=".$name." size=1>n"; 
    for ($m=1;$m<=12;$m++) { 
        if ($default  == $m) {$selected="selected";} else {$selected="";} 
        $result.="<option value=".$m." $selected>".date(M, mktime(0,0,0,$m,1,2000))."</option>n"; 
    } 
    $result.="</select>n"; 
return $result; 
	} 

function listbox_year($name, $start, $end, $default=0)
	{ 
    $result="<select name=".$name." size=1>n"; 
    for ($y=$end;$y>=$start;$y--) { 
        if ($default  == $y) {$selected="selected";} else {$selected="";} 
        $result.="<option value=".$y." $selected>$y</option>n"; 
    } 
    $result.="</select>n"; 
return $result; 
	} 


/*This is from Valufirst*/
function SendSMS($SMSMessage, $PhoneNumber)
{
	$request = ""; //initialize the request variable
	
	$param["username"] = "wrsinfohttp"; 
	$param["password"] = "sinfin12"; 
	if(strlen($PhoneNumber)>10)
	{	
		$param["to"] = substr($PhoneNumber,2); //these are the recipients of the message
	}
	else
	$param["to"] = $PhoneNumber;
	
	$param["udh"] = "";
	$param["from"] = "D4LOANS";
	$param["text"] = $SMSMessage; //this is the message that we want to send
	$param['dlr-url'] = "";
	$param["dlr-mask"] = "19";

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	//$host = "bms.air2web.co.in";//if Deal4loans
	$host = "myvaluefirst.com";// if Offermax
	$script = "/smpp/sendsms";
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
	return $output;
}

/*function SendSMS($SMSMessage, $PhoneNumber)
{
	$request = ""; //initialize the request variable
	// D4L
	
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mf678";
	
	

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "bms.air2web.co.in";
	$script = "/failsafe/HttpPublishLink";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
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

	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  $checkstat=$output[7];
	   list($First,$Last) = split('[~]',trim($checkstat));
		list($nwFirst,$geta2wackid) = split('[=]', trim($First));
	  fclose($socket); 
	  	$Promocode = $param["pcode"];
		$selectSql = "select * from track_sms where pcode = '".$Promocode."'";
		$selectQuery = ExecQuery($selectSql);
		$smsCount = mysql_result($selectQuery,0,'smscount');
		if($smsCount==0)
		{
			$incrementSms = 1;
		}
		else
		{
			$incrementSms = $smsCount - 1;
		}
		$reply_type="";
		$custref="";
		$updateSql = "update track_sms set smscount = '".$incrementSms."', date = now() where pcode = '".$Promocode."'";
		$updateQuery = ExecQuery($updateSql);
		} 
		$curntdate=date("Y-m-d H:i:s");
		$smsackSql ="INSERT INTO `sms_acknowledgement` ( `a2wackid` , `custref` , s_dated, product_type ) VALUES ('".$geta2wackid."', '".$custref."', '".$curntdate."', '".$reply_type."')";
		$smsackSqlQuery = ExecQuery($smsackSql);
}*/

/* This is for air2WEB*/
function SendSMSAir2Web($SMSMessage, $PhoneNumber)
{
	/*$request = ""; //initialize the request variable
	// D4L
	
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mf678";
	
	

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "bms.air2web.co.in";
	$script = "/failsafe/HttpPublishLink";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
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

	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  $checkstat=$output[7];
	   list($First,$Last) = split('[~]',trim($checkstat));
		list($nwFirst,$geta2wackid) = split('[=]', trim($First));
	  fclose($socket); 
	  	$Promocode = $param["pcode"];
		$selectSql = "select * from track_sms where pcode = '".$Promocode."'";
		$selectQuery = ExecQuery($selectSql);
		$smsCount = mysql_result($selectQuery,0,'smscount');
		if($smsCount==0)
		{
			$incrementSms = 1;
		}
		else
		{
			$incrementSms = $smsCount - 1;
		}
		$reply_type="";
		$custref="";
		
		}
		$updateSql = "update track_sms set smscount = '".$incrementSms."', date = now() where pcode = '".$Promocode."'";
		$updateQuery = ExecQuery($updateSql);
		$curntdate=date("Y-m-d H:i:s");
		$smsackSql ="INSERT INTO `sms_acknowledgement` ( `a2wackid` , `custref` , s_dated, product_type ) VALUES ('".$geta2wackid."', '".$custref."', '".$curntdate."', '".$reply_type."')";
		$smsackSqlQuery = ExecQuery($smsackSql);*/
}

//////////////////////////////////////////////////////////
function SendSMSforLMS($SMSMessage, $PhoneNumber)
{
	$request = ""; //initialize the request variable
	
	// 6161
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mi@1";
	

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "luna.a2wi.co.in:7501";
	$script = "/failsafe/HttpPublishLink";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
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
	  	$Promocode = $param["pcode"];
		$selectSql = "select * from track_sms where pcode = '".$Promocode."'";
		$selectQuery = ExecQuery($selectSql);
		$smsCount = mysql_result($selectQuery,0,'smscount');
		if($smsCount==0)
		{
			$incrementSms = 1;
		}
		else
		{
			$incrementSms = $smsCount - 1;
		}
		$updateSql = "update track_sms set smscount = '".$incrementSms."', date = now() where pcode = '".$Promocode."'";
		$updateQuery = ExecQuery($updateSql);

	} 
}

/*function SendSMSforLMS($SMSMessage, $PhoneNumber)
{
		$request = ""; //initialize the request variable
	
	$param["username"] = "wrsinfohttp"; 
	$param["password"] = "sinfin12"; 
	if(strlen($PhoneNumber)>10)
	{	
		$param["to"] = substr($PhoneNumber,2); //these are the recipients of the message
	}
	else
	$param["to"] = $PhoneNumber;
	
	$param["udh"] = "";
	$param["from"] = "LOANS";
	$param["text"] = $SMSMessage; //this is the message that we want to send
	$param['dlr-url'] = "";
	$param["dlr-mask"] = "19";

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	//$host = "bms.air2web.co.in";//if Deal4loans
	$host = "myvaluefirst.com";// if Offermax
	$script = "/smpp/sendsms";
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
	return $output; 
}*/



/////////////////////////////////////////////////////////
// personal, home, car, cc, property, insurance
function getEligibleBidders($strProduct, $strCity, $Phone)
{
	$SMSMessage="Dear user,contacts of Banks/DSA for your request on deal4loans: ";
	$SMSMessageBidders="";
	$ctr=1;
	$mvarType = getCodeValue("ReplyType_$strProduct");
	$mvarCity = strtoupper($strCity);

//	echo "mavrType : ".$mvarType."<BR>";
//	echo "mvarCity : ".$mvarCity."<BR>";

	$strSQL = "SELECT Bidder_Bank, Bidder_Contact, Bidder_Number FROM Eligible_Bidder_List WHERE City LIKE '%".$mvarCity."%' AND Reply_Type=".$mvarType." AND IsValid=1";

//	echo "SQL : ".$strSQL."<BR>";
	$result = ExecQuery($strSQL);
	echo mysql_error();

	If ($myrow = mysql_fetch_array($result))
	{
		do
		{
			$mvar_Bidder_Bank=trim($myrow["Bidder_Bank"]);
			$mvar_Bidder_Contact=trim($myrow["Bidder_Contact"]);
			$mvar_Bidder_Number=trim($myrow["Bidder_Number"]);

//			echo "mvar_Bidder_Bank : ".$mvar_Bidder_Bank."<BR>";
//			echo "mvar_Bidder_Contact : ".$mvar_Bidder_Contact."<BR>";
//			echo "mvar_Bidder_Number : ".$mvar_Bidder_Number."<BR>";

			$SMSMessageBidders=$SMSMessageBidders."(".$ctr.") ".$mvar_Bidder_Bank."-".$mvar_Bidder_Number." ";
			$ctr=$ctr+1;
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
	}
	
	if(strlen(trim($SMSMessageBidders))>0)
	{
//		echo $SMSMessage.$SMSMessageBidders."<BR>";
		if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage.$SMSMessageBidders, $Phone);

	}
}

function SendPLLeadToICICI($first_name, $last_name, $dd, $mm, $year, $tel_m, $tel_r, $email, $city, $other_city, $occupation, $income, $company)
{

/*	if(is_numeric($income))
	{
		$monthlyincome = $income/12;

		if($monthlyincome < 6000)
		{
			$incomeslab = "&lt;  6,000";
		}
		else if($monthlyincome >= 6000 && $monthlyincome < 10000)
		{
			$incomeslab = "6,000 - 10,000";	
		}
		else if($monthlyincome >= 10000 && $monthlyincome < 15000)
		{
			$incomeslab = "10,000 - 15,000";	
		}
		else if($monthlyincome >= 15000 && $monthlyincome < 25000)
		{
			$incomeslab = "15,000 - 25,000";	
		}
		else if($monthlyincome >= 25000 && $monthlyincome < 50000)
		{
			$incomeslab = "25,000 - 50,000";	
		}
		else
		{
			$incomeslab = "&gt;  50,000";	
		}
	}
	else
	{
		$incomeslab = $income;
	}

	if($occupation == "0")
	{
		$stroccupation="Self Employed";
	}
	else if($occupation == "1")
	{
		$stroccupation="Salaried";
	}
	else
	{
		$stroccupation="Salaried";
	}

	$request = ""; //initialize the request variable
	$param["first_name"] = $first_name; 
	$param["last_name"] = $last_name; 
	$param["dd"] = $dd; 
	$param["mm"] = $mm; 
	$param["year"] = $year;
	$param["tel_m"] = $tel_m;
	$param["tel_r"] = $tel_r;
	$param["email"] = $email;
	$param["city"] = strtolower($city);
	$param["other_city"] = strtolower($other_city);
	$param["occupation"] = $stroccupation;
	$param["income"] = $incomeslab;
	$param["company"] = $company;

	$param["refsite"] = "deal4loans";
	$param["adunit"] = "400x400";
	$param["channel"] = "channel";
	$param["campaign"] = "campaign";


	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "65.111.165.214";
	$script = "/icici/lead_submit_new.php";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
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
	} */
}



function generateNumber($plength)
{
	if(!is_numeric($plength) || $plength <= 0)
	{
	    $plength = 8;
	}
	if($plength > 32)
	{
	    $plength = 32;
	}

	$chars = '123456789';
	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)
	{
	   $key = mt_rand(0,strlen($chars)-1);
	   $pwd = $pwd . $chars{$key};
	}
	   for($i = 0; $i < $plength; $i++)
	{
	    $key1 = mt_rand(0,strlen($pwd)-1);
	    $key2 = mt_rand(0,strlen($pwd)-1);

	    $tmp = $pwd{$key1};
	    $pwd{$key1} = $pwd{$key2};
	    $pwd{$key2} = $tmp;
	}

	return $pwd;

}
//Converts Number to Words
//Example 1125 will be one thousand one hundred twenty five
function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
   echo "Number is out of range";
    } 

 	//$Gn = floor($number / 1000000);  /* Millions (giga) */ 
    //$number -= $Gn * 1000000; 

    $Gn = floor($number / 100000);  /* Lakhs (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    /*if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Millions"; 
    } */

	if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lakhs"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 


/*
function validateValues($ab)
{
	$remove = "upendra, lalit, upendra";
	$explodeVal = explode(",", $remove);
	
	//echo $ab;

	$aw = "";
	for($k=0;$k<count($explodeVal);$k++)
	{
			
		if (preg_match("/$explodeVal[$k]/i", $ab)) {
		  $trueVal = "Remove";
		} else {
			$trueVal = "Putin";
		}

		$aw[] =$trueVal;
	}
	//print_r ($aw);
	if(in_array("Remove",$aw))
	{
		$val="Discard";
		return $val;
	}
	else
	{
		$val = "Put";
		return $val;
	}
}
*/


function tataaigcity($city)
{
	$tataig=Array('Yavatmal','Yamuna Nagar','Washim','Wardha','Warangal','Waghodia','Vyara','Vizianagaram','Vita','Visnagar','Vishakapatanam','Virudhunagar','Virudhachalam','Viramgam','Viluppuram','Vijianagaram','Vijaywada','Vijayawada','Vijapur','Vidisha','Vellore','Varanasi','Vapi','Vaniyambadi','Valsad','Vadodara','Unnao','Unjha','Umreth','Ujjain','Udupi','Udumalpet','Udaipur','Tuticorin','Tumkur','Trivandrum','Trichy','Trichur','Tonk','Tiruvannamalai','Tiruppur','Tirupattur','Tirupati','Tirupathi','Tirunelveli','Tiruchengode','Tindivanam','Thuraiyur','Thrissur','Thiruvarur','Thiruvallur','Thiruvalla','Theni','Thanjavur','Thane','Tezpur','Tenkasi','Tanuku','Tanjore','Tanda','Tamluk','Tadepalli Gudem','Suri','Surendra Nagar','Suratgarh','Surat','Sumerpur','Sullia','Srikakulam','Sriganganagar','Solapur','Solan','Sivakasi','Sirsi','Sirhind','Silvassa','Siliguri','Sikar','Siddhpur','Sholapur','Shirol','Shimoga','Shimla','Sheoganj','Shajapur','Shahbad','Satna','Satara','Sankheda','Sankagiri','Sangrur','Sangli','Sangareddy','Sambalpur','Samana','Salem','Saharanpur','Sagar','Rourkela','Ropar','Roorkee','Rohtak','Rishikesh','Rawatbhata','Ratnagiri','Rasipuram','Raniganj','Ranchi','Rampuraphul','Rajsamand','Rajpura','Rajnandgaon','Rajnandgao','Rajkot','Rajgurunagar','Rajapalayam','Rajahmundry','Raipur','Raichur','Puttur','Purulia','Pudukottai','Pondicherry','Pollachi','Phaltan','Phagwara','Petlad','Pethvadagaon','Peth Vadgaon','Perambalur','Pattukottai','Patna','Patiala','Pathankot','Pathanamthitta','Patan','Parwanoo','Pardi','Paradeep','Panvel','Panipat','Panhala','Panchkula','Pali','Palghat','Palanpur','Palani','Palakollu','Palakkad','Paithan','Padra','Ooty','Ongole','Nokha','Noida','Nizamabad','Neyveli','Nellore','Nawasehar','Nawanshahar','Navsari','Navi Mumbai','Nasirabad','Nasik','Narsapur','Namakkal','Nalgonda','Nakodar','Nagpur','Nagarkoil','Nagappattinam','Nadiad','Mysore','Mussorie','Mussoorie','Musiri','Muktsar','Mukerian','Morbi','Moradabad','Moodbidri','Monga','Modinagar','Modasa','Mirzabad','Miraj','Midnapore Town','Mhow','Mettur','Mettupalayam','Mehasana','Meerut','Maynaguri','Mayiladythurai','Mathura','Marthandam','Mansa','Mansa','Mannargudi','Manipal','Mangalore','Mandi Gobindgarh','Mandi','Malda','Malappuram','Makrana','Mainpuri','Mainaguri','Mahad','Mahaboobnagar','Madurai','Machilipatnam','Ludhiana','Lucknow','Kurundwad','Kurukshetra','Kursheong','Kurnool','Kurali','Kundapur','Kumbakonam','Kulittalai','Krishnagiri','Kovilpatti','Kottayam','Kotputli','Kota','Korba','Kollam','Kolhapur','Kolaghat','Kishangarh','Killapardi','Khopoli','Kharar','Kharagpur','Khanna','Khammam','Khambhat','Kavali','Kashipur','Karur','Karnal','Karjan','Karimnagar','Karaikudi','Karaikal','Karad','Kapurthala','Kanpur','Kannur','Kankroli','Kanchipuram','Kaloor','Kalol','Kallakunichi','Kalimpong','Kakinada','Kagal','Kadi','Junagadh','Jorhat','Jorhat','Jodhpur','Jharsuguda','Jhalawar','Jaysingpur','Jamshedpur','Jamnagar','Jammu','Jalpaiguri','Jalore','Jalna','Jalgaon','Jalandhar','Jaipur','Jagraon','Jabalpur','Itarsi','Islampur','Islampur','Indore','Idar','Ichapur','Ichalkaranji','Hupri','Hupari','Hubli','Hosur','Hospet','Hoshiarpur','Hissar','Himmatnagar','Himatnagar','Harihar','Haridwar','Hardwar','Hanumangarh','Halol','Haldwani','Haldia','Gwalior','Guwahati','Guwahati','Gurgaon','Gurdaspur','Guntur','Gulbarga','Gudur','Greater Noida','Gondia','Godavrikhani','Gobichettipalayam','Ghaziabad','Gaziabad','Gangapur','Ganganagar','Gandhinagar','Gandhidham','Gadag','Ferozepur','Faridkot','Faridabad','Erode','Eluru','Edappadi','Durgapur','Durg','Dungarpur','Dindigul','Dibrugarh','Dhule','Dharwad','Dharmapuri','Dharapuram','Dharampur','Dhanbad','Dhamtari','Dewas','Dehradun','Deesa','Davengere','Dausa','Dasuya','Darjeeling','Dahod','Dabhoi','Cuttack','Cuddalore','Corba','Coonoor','Coochbehar','Coimbatore','Cochin','Chittorgarh','Chittoor','Chittaranjan','Chiplun','Chingleput','Chikhli','Chikhali','Chidambaram','Chickmangulur','Chengalpet','Chandrapur','Chandigarh','Calicut','Burla','Burdwan','Burdhwan','Bundi','Borsad','Bolpur','Bokaro','Boingaigaon','Bodeli','Bimavaram','Bilimora','Bilaspur','Bikaner','Bidar','Bhusawal','Bhusaval','Bhuj','Bhubneshwar','Bhopal','Bhiwadi','Bhimavaram','Bhilwara','Bhiloda','Bhilai','Bhavanagar','Bhatinda','Bharuch','Bhandara','Bhadravati','Berhampur','Berhampore','Bellary','Belgaum','Behrampur','Beed','Beawar','Bavla','Batala','Baroda','Barmer','Bargarh','Bareilly','Bardoli','Baran','Barabanki','Bantwal','Banswara','Bankura','Banala','Balotra','Ballarpur','Balasore','Baddi','Aurangabad','Atul','Atthur','Asansol','Aruppukottai','Arni','Ariyalur','Aranthangi','Arakonam','Antha','Ankleshwar','Angul& Talcher','Anand','Anakapalli','Amritsar','Amreli','Amravati','Ambejogai','Ambala','Amaravati','Amalapuram','Alwar','Allepy','Allahabad','Alibag','Alappy','Akola','Ajmer','Ahmednagar','Agra','Adoni','Achalpur','Abohar','Pune','Mumbai','Hyderabad','Goa','Delhi','Chennai','Calcutta','Bangalore','Kochi');

if(in_array($city, $tataig))
{
	$exactval="1";
}
else
{
	$exactval="0";
}

return($exactval);
}


function isValidEmail($email){
    $checkPattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
 	$firstCheck = substr($email, 0,1);
  	
	if(!is_numeric($firstCheck))
	{
		 if (eregi($checkPattern, $email)){
         $true = 1;
		 return $true;
     	 }
      	 else {
	  	 $false = 0;
         return $false;
      	 }   
	}	
    else {
	  	 $false = 0;
         return $false;
	}     
}

function SendSMSBySnowWeb($SMSMessage, $PhoneNumber,$Reply_Type,$RequestID)
{
	
	$request = ""; 
	$param["user"] = "deal"; 
	$param["password"] = "deal123"; 
	$param["text"] = $SMSMessage;
	$param["phonenumber"] = $PhoneNumber;
	foreach($param as $key=>$val)
	{ 
	  $request.= $key."=".urlencode($val);
	  $request.= "&"; 
	}
	$request = substr($request, 0, strlen($request)-1);

//http://122.160.50.151:8800/?user=deal&password=deal123&text=Hello+its+cool+now%21%21%21&phonenumber=9971396361
//http://122.160.50.151:8800/?user=deal&password=deal123&text=TestSMS&phonenumber=Mobile

	$host = "122.160.50.151";
	$script = "/";
	//$host = "snowebs.co.in";
	//$script = "/pushsms/sendsms.php";
	$request_length = strlen($request);
	$method = "GET"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
//echo $request;
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";

	//Now we open up the connection
	$socket = @fsockopen($host, 8800, $errno, $errstr); 
//	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  fclose($socket); 
	}  
//	print_r($output);
	
	$array14 = $output[14];

	$explodeArray14 = explode(",", $array14);
	$explodeArray14_1 = explode("=", trim($explodeArray14[1]));
	$getMob = trim($explodeArray14_1[1]);
	$msgLength = strlen($SMSMessage);
 	$countSms = ceil($msgLength/160);

	//if(strlen($getMob)>0)
	//{
		//$insSql = "INSERT INTO tracksms ( Phone , Reply_Type , RequestID, Dated, Status, length, msgcount ) VALUES ('".$getMob."', '".$Reply_Type."', '".$RequestID."', Now(), '".$output[9]."', '".$msgLength."' , '".$countSms."')";
		$insSql = "INSERT INTO tracksms ( Phone , Reply_Type , RequestID, Dated, Status, length, msgcount ) VALUES ('".$PhoneNumber."', '".$Reply_Type."', '".$RequestID."', Now(), '".$output[9]."', '".$msgLength."' , '".$countSms."')";
		$Query = ExecQuery($insSql);
		//echo "<br>".$insSql;
	//}
	if(strlen($output[9])=="")
	{  
		$Phone=9811215138;
		$SMSMessage = "SMS issue at d4l";

		SendSMS($SMSMessage, $Phone);
	}
	return $output; 
	
}

function mobile_verify($Phone,$client_transaction_id)
{

/* 
$response = file_get_contents("http://www.zipdial.com/zip2auth/v2/transactions/start_transaction?token=04f0294522530730a4671c96a8a35cac6c47714d&clientTransactionId=$client_transaction_id&callerPhone1=$Phone&duration=30&country_code=91"); 

//echo $response;
$explod = explode(",", $response);
//print_r($explod);
//echo "<br>";
$explod2 = explode('":"', $explod[2]);

$image = substr(trim($explod2[1]), 0, strlen(trim($explod2[1]))-1);
//$array = json_decode($response);

$img = str_replace("\/", "/", $image);
//echo "<br><br>";
//$img = $array->img; 
//echo ("<img src='$img'/>"); 

//echo "<br><br>";
$explod3 = explode('":"', $explod[3]);

$transaction_token = substr(trim($explod3[1]), 0, strlen(trim($explod3[1]))-1);
//echo "<br>";
*/

$response = file_get_contents("http://www.zipdial.com/z2v/startTransaction.action?customerToken=04f0294522530730a4671c96a8a35cac6c47714d&clientTransactionId=$client_transaction_id&callerid=$Phone&duration=360&countryCode=91&z2vToken=bc4e3f20bd8c7361c7a088b7b570e9d076516dd5"); 
	//echo $response;
	//echo "<br>";
	$explod = explode(",", $response);
		
	$explod2 = explode('http://www.zipdial.com', $explod[4]);
	//echo $explod2[1];
	$getImg = substr(trim($explod2[1]), 0, strlen(trim($explod2[1]))-2);
//echo $getImg1 = substr(trim($explod2[1]), 0, strlen(trim($explod2[1]))-3);
//echo "<br>";
	$image = "http://www.zipdial.com".$getImg;
	$img = trim(str_replace("\/", "/", $image));
	$explod31 = explode('transaction_token', $explod[2]);
	$explod3 = trim($explod31[1]);
	$transactiontoken =	explode('/', $getImg);
	$transaction_token = $transactiontoken[4];
	if(strlen($explod2[1])>8)
	{
		$viewable = "viewed";
	}
	else
	{
		$viewable = "not viewed";
	}
	
		//	echo "<br>";
 $insertSql = "INSERT INTO z2v_transactions ( client_transaction_id , zipdial_no , transaction_token , mobile , verified , created ,viewable ) VALUES ('".$client_transaction_id."' , '".$zipdial_no."' , '".$transaction_token."' , '".$Phone."' , '".$verified."' , Now(), '".$viewable."')";
 
$insertQuery = mysql_query($insertSql);
	
 return $img;
}

function NewAir2webSendSMS($SMSMessage, $PhoneNumber, $Reply_Type, $RequestID)
{
	/*$request = ""; //initialize the request variable
	// D4L
	
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mf678";
	
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "bms.air2web.co.in";
	$script = "/failsafe/HttpPublishLink";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
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

	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  $checkstat=$output[7];
	   list($First,$Last) = split('[~]',trim($checkstat));
		list($nwFirst,$geta2wackid) = split('[=]', trim($First));
	  fclose($socket); 
	  	
		} 
		$curntdate=date("Y-m-d H:i:s");
		$mnumber ="91".$PhoneNumber;
		$smsackSql ="INSERT INTO `sms_acknowledgement` ( `a2wackid` , air2web_requestid , s_dated, product_type, mnumber ) VALUES ('".$geta2wackid."', '".$RequestID."', '".$curntdate."', '".$Reply_Type."','".$mnumber."')";
		$smsackSqlQuery = ExecQuery($smsackSql);*/
}

//Pager class start
class pager
{
    var $sql;
    var $getvar;
    var $rows;
    var $start;
    var $getvar_val;
    var $pager;
    var $result;
    
    function __construct($sql,$getvar,$length)
    {
        $this->result=null;
        $this->sql = $sql;
        $this->getvar = $getvar;
        $this->rows = 0;
        $this->start = 0;
        $this->getvar_val = 1;
        $this->pager = null;
        $this->SetLength($length);
        $this->GetStart();
        $this->doQuery();
    }
    
    //Sets $length
  function SetLength($length)
  {
      $this->length = (int)$length;
      if($this->length<0)
      {
          $this->length = 0;
      }
  }
  
  function doQuery()
  {
      $sql = trim($this->sql);
      $sql = substr($sql,6);
      $sql = 'SELECT SQL_CALC_FOUND_ROWS '.$sql.' limit '.$this->start.', '.$this->length;
      $this->result = mysql_query($sql);
      $sql = "SELECT FOUND_ROWS()";
      $result = mysql_query($sql);
      $this->rows = mysql_result($result,0);
  }
  
  //getvar_val() gets the
  //$getvar_val is a positive integer - > 0
  function Set_Getvar_val()
  {
      $this->getvar_val = (int)$_GET[$this->getvar];
      if($this->getvar_val<1)
      {
          $this->getvar_val = 1;
      }
  }

  //Gets the start of the data
  function GetStart()
  {
      $this->Set_Getvar_val();
      $this->start = (($this->getvar_val-1)*$this->length);
  }
  
    function show($next="Next",$last="Last",$separator=" ")
    {
        $array = $this->pager();
        $str = array();
        foreach($array as $k => $v)
        {
            if($k!='next'&&$k!='last')
            {
                if($k==$this->getvar_val)
                {
                    $str[] = "<b class='btnpaging-notselected'> ".$k."</b>";
                }
                else
                {
                    $str[] = '<a href="'.$v.'" class="btnpaging">'.$k.'</a>';
                }
            }
        }
        $str = implode($separator, $str);
        $rt = "<div align='middle'><br>"; 
		$rt .= $array['last']===null?"":'<a href="'.$array['last'].'" class="btnpaging">'.$last.'</a>'.$separator;
        $rt .= $str.$separator;
        $rt .= $array['next']===null?"":'<a href="'.$array['next'].'" class="btnpaging">'.$next.'</a>';
		$rt .= "</div>";
        return $rt;
    }
    
     //Returns an array of the links arround the given point
    //['next'] => next page
    //['last'] => last page
    function pager($margin=10)
    {
        $path = $_GET;
        $newpath = $PHP_SELF."?";
        foreach($path as $key => $value)
        {
            if($key!=$this->getvar)
            {
                $newpath .= $key."=".$value;
                $newpath .="&amp;";
            }
        }
        $newpath .= $this->getvar;

        $linkpaths = array();
        $current = $this->start / $this->length + 1;
        $pages = ceil(($this->rows/$this->length));
        $pagerstart = $current-$margin;
        $pagerstart = ($pagerstart<1)?1:$pagerstart;
        $pagerend = $current+$margin;
        
        $pagerend = ( $pagerend > $pages ) ? ( ceil( ( $this->rows / $this->length ) ) ): $pagerend;

        for($i=$pagerstart;$i < ($pagerend+1);$i++)
        {
            $linkpaths[$i] = $newpath."=".($i);
        }
        if($linkpaths[($current+1)]!=null)
        {
            $linkpaths['next']=$linkpaths[($current+1)];
        }
        if($linkpaths[($current-1)]!=null)
        {
            $linkpaths['last']=$linkpaths[($current-1)];
        }
        return $linkpaths;
    }
}
//pager class stop

function  Insert_HdfcLife($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue )
	{
		if($Net_Salary>=300000)
		{
		$hdfclifeSql = "INSERT INTO hdfclife_compleads ( hdfclife_name , hdfclife_email , hdfclife_mobile_number,  hdfclife_city, hdfclife_income , hdfclife_dob,  hdfclife_dated , hdfclife_product, hdfclife_requestid ) VALUES ( '".$Name."', '".$Email."', '".$Phone."', '".$City."', '".$Net_Salary."', '".$DOB."', Now(), '".$Product."', '".$ProductValue."')";
		$hdfclifequery = ExecQuery($hdfclifeSql);
		}
	}

function  Insert_HdfcLife_nw($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue, $Source )
	{
		if($Net_Salary>=300000)
		{
		$hdfclifeSql = "INSERT INTO hdfclife_compleads ( hdfclife_name , hdfclife_email , hdfclife_mobile_number,  hdfclife_city, hdfclife_income , hdfclife_dob,  hdfclife_dated , hdfclife_product, hdfclife_requestid, hdfclife_source ) VALUES ( '".$Name."', '".$Email."', '".$Phone."', '".$City."', '".$Net_Salary."', '".$DOB."', Now(), '".$Product."', '".$ProductValue."','".$Source."')";
		$hdfclifequery = ExecQuery($hdfclifeSql);
		}
	}

?>