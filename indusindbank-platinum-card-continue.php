<?php
include "scripts/db_init.php";
include "scripts/functions.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Employment_Status = $_POST['Employment_Status'];
		$full_name = $_POST['full_name'];
		$City = $_POST['City'];
		$email_id = $_POST['email_id'];
		$mobile_no = $_POST['mobile_no'];
		$net_salary = $_POST['IncomeAmount'];
		$company_name = $_POST['company_name'];
		$dd = $_POST['dd'];
		$mm = $_POST['mm'];
		$yyyy = $_POST['yyyy'];
		$dob= $yyyy."-".$mm."-".$dd;
		$indusind_city_other = $_POST['other_city'];
		$existing_rel = $_POST['existing_rel'];
		$typeofrel = $_POST['typeofrel'];
		$salary_account = $_POST['salary_account'];
		
		$age=Date('Y') - $yyyy;
		$IP = getenv("REMOTE_ADDR");

		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";

		$validMobile = is_numeric($mobile_no);
		if((strlen($full_name) >0 && $full_name!="Full Name") && ($validMobile==1) && strlen($mobile_no)>9 && strlen($City)>0)
		{
			$getsel = "select indusind_mobileno,indusind_dated From indusind_credit_card Where (indusind_mobileno='".$mobile_no."' and indusind_mobileno not in ('9811555306','9971396361','9999047207','9811215138','9999570210') and indusind_dated between '".$days30datetime."' and '".$currentdatetime."')";
		list($getselrecordcount,$indusindcds)=MainselectfuncNew($getsel,$array = array());
			$indusindcdscontr = count($indusindcds)-1;
			if($getselrecordcount>0)
			{
				$Updated_Date = $indusindcds[$indusindcdscontr]['indusind_dated'];
				$explode_Dated = explode(" ", $Updated_Date);
				$explodeDated = explode("-", $explode_Dated[0]);
				$dt = mktime(0, 0, 0, date($explodeDated[1]), date($explodeDated[2]),   date($explodeDated[0]));
				$showDate = date("d M, Y",$dt);
				$ehomessage="You have already applied with us for IndusInd Bank Platinum Aura Credit Card on ".$showDate;
			}
			else
			{
				$Dated = ExactServerdate();
				$dataInsert = array('indusind_name'=>$full_name, 'indusind_email'=>$email_id, 'indusind_city'=>$City, 'indusind_mobileno'=>$mobile_no, 'indusind_employer'=>$company_name, 'indusind_income'=>$net_salary, 'indusind_office_landline'=>$office_number, 'indusind_resi_landline'=>$residence_number, 'indusind_source'=>'indusindcc-mailer', 'indusind_dated'=>$Dated, 'indusind_dob'=>$dob, 'indusind_emp_status'=>$Employment_Status, 'indusind_city_other'=>$indusind_city_other, 'indusind_typrofrel'=>$typeofrel, 'indusind_exist_rel'=>$existing_rel, 'indusind_salary_account'=>$salary_account);
				$indusind_crdvalue = Maininsertfunc ('indusind_credit_card', $dataInsert);
		
				if(($City=='Ahmedabad' || $City=='Bangalore' || $City=='Chandigarh' || $City=='Chennai' || $City=='Coimbatore' || $City=='Delhi' || $City=='Hyderabad' || $City=='Indore' || $City=='Jaipur' || $City=='Kanpur' || $City=='Kochi' || $City=='Kolkata' || $City=='Lucknow' || $City=='Ludhiana' || $City=='Mumbai' || $City=='Pune') && (($Employment_Status==1 && $net_salary>=480000) || ($Employment_Status==0 && $net_salary>=780000)))
				{
					$dataUpdate = array('indusind_eligible_flag'=>'1');
					$wherecondition = "(indusindccid=".$indusind_crdvalue.")";
					Mainupdatefunc ('indusind_credit_card', $dataUpdate, $wherecondition);
				}
					else
			{
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$mobile_no."' and Mobile_Number not in ('9811555306','9999047207','9811215138','9999570210') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$email_id."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, Mobile_Number, Net_Salary, DOB, Dated,  source, IP_Address, Updated_Date,applied_card_name, City_Other )	VALUES ( '".$UserID."', '".$full_name."', '".$email_id."', '".$Employment_Status."', '".$company_name."', '".$City."', '".$mobile_no."', '".$net_salary."', '".$dob."', Now(), 'indusindcc-mailer', '".$IP."',Now(),'IndusInd Bank Platinum Aura Credit Card', '".$indusind_city_other."' )"; 
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$full_name, 'Email'=>$email_id, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$company_name, 'City'=>$City, 'Mobile_Number'=>$mobile_no, 'Net_Salary'=>$net_salary, 'DOB'=>$dob, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'applied_card_name'=>'IndusInd Bank Platinum Aura Credit Card', 'City_Other'=>$indusind_city_other);
			}
			else
			{
				$wUsersdata = array("Email"=>$email_id, "FName"=>$full_name, "Phone"=>$mobile_no, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$full_name, 'Email'=>$email_id, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$company_name, 'City'=>$City, 'Mobile_Number'=>$mobile_no, 'Net_Salary'=>$net_salary, 'DOB'=>$dob, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'applied_card_name'=>'IndusInd Bank Platinum Aura Credit Card', 'City_Other'=>$indusind_city_other);
									
			}
				$ProductValue = Maininsertfunc ("Req_Credit_Card", $dataInsert);
			}
				}

		 }
		 }
		 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Indusind Credit Cards</title>
<link href="css/indusind-bank-landing-page-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="bg-wrapper">
<div class="bg-wrapper2">
<div class="logo-ind"><img src="images/indusind-logo-lp.png" width="201" height="22" alt="indusind logo"></div>
<div class="credit-cards"><img src="images/indusind-aura-credit-card-image.png" width="198" height="172" alt="Credit Card Aura"></div>
</div>
</div>
<div style="clear:both;"></div>
<div class="form-wrapper">
  <div class="form-left">  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="center" height="40"><span style="font-family: Arial, Helvetica, sans-serif; font-size:18px; color: #000000;" ><? if(strlen($ehomessage)>2) { echo $ehomessage."<br>"; } else {?>Thank you for applying IndusInd Bank Platinum Aura Credit Card.<br>Our representative will Contact you shortly.<? } ?> </span></td>
      </tr>
      </table>
</div>
<div class="form-right">
  <div class="features_head">Exclusive Privileges: </div>
  <div class="features_head_body">
    <ul>
      <li>Fuel Surcharge waiver.</li>
      <li>Access to over 600+ airport lounges</li>
      <li>Concierge Services</li>
      <li>Enhanced security with EMV Chip</li>
      <li> Exclusive offers on lifestyle,travel and much more</li>
    </ul>
  </div>
  <br />
  <div class="features_head">Rewards Points: </div>
  <div class="features_head_body2">
    <ul>
      <li><b>Platinum Aura Shop Plan</b><br />
        Earn 4X reward points on departmental stores, electronic and restaurants.</li>
      <li><b>Platinum Aura Home Plan</b><br />
        Earn 4X reward points on  household expenses, grocery, mobile/electricity bills and medical spends.</li>
      <li><b>Platinum Aura Travel Plan</b><br />
        Earn 4X reward points on airline, railway tickets, hotel bills and car rentals.</li>
      <li><b>Platinum Aura Party Plan</b><br />
        Earn 4X reward points at restaurants, bars, pubs, departmental stores and theatres.</li>
    </ul>
  </div>
  </div>
<div style="clear:both;"></div>
</div>
</body>
</html>