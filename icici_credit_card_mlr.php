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
		$icici_city_other = $_POST['other_city'];
		$existing_rel = $_POST['existing_rel'];
		$typeofrel = $_POST['typeofrel'];
		$salary_account = $_POST['salary_account'];
		
		$age=Date('Y') - $yyyy;
		$IP = getenv("REMOTE_ADDR");

		$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$company_name.'"';
		list($recordcounthdfccc,$grow)=MainselectfuncNew($gethdfccccompany,$array = array());
		$growcontr=count($grow)-1;

		if($recordcounthdfccc>0)
		{
			$icici_cccategory = $grow[$growcontr]["company_category"];
		}

			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";

$validMobile = is_numeric($mobile_no);
if((strlen($full_name) >0 && $full_name!="Full Name") && ($validMobile==1) && strlen($mobile_no)>9 && strlen($City)>0)
{
	$getsel=("select icici_mobileno,icici_dated From icici_credit_card Where (icici_mobileno='".$mobile_no."' and icici_mobileno not in ('9811555306','9971396361','9999047207','9811215138','9999570210') and icici_dated between '".$days30datetime."' and '".$currentdatetime."')");
	list($getselrecordcount,$icicicds)=MainselectfuncNew($getsel,$array = array());
	$icicicdscontr=count($icicicds)-1;

	if($getselrecordcount>0)
	{
		$Updated_Date = $icicicds[$icicicdscontr]['icici_dated'];
		$explode_Dated = explode(" ", $Updated_Date);
	    $explodeDated = explode("-", $explode_Dated[0]);
		$dt = mktime(0, 0, 0, date($explodeDated[1]), date($explodeDated[2]),   date($explodeDated[0]));
		$showDate = date("d M, Y",$dt);
		$ehomessage="You have already applied with us for ICICI Platinum Chip Credit Card on ".$showDate;
	}
	else
	{
		$Dated = ExactServerdate();
		$data = array('icici_name'=>$full_name, 'icici_email'=>$email_id, 'icici_city'=>$City, 'icici_mobileno'=>$mobile_no, 'icici_employer'=>$company_name, 'icici_income'=>$net_salary, 'icici_office_landline'=>$office_number, 'icici_resi_landline'=>$residence_number, 'icici_source'=>'icicicc-mailer', 'icici_dated'=>$Dated, 'icici_dob'=>$dob, 'icici_emp_status'=>$Employment_Status, 'icici_city_other'=>$icici_city_other, 'icici_typrofrel'=>$typeofrel, 'icici_exist_rel'=>$existing_rel, 'icici_salary_account'=>$salary_account);
		$table = 'icici_credit_card';
		$icici_crdvalue = Maininsertfunc ($table, $data);

		if(($Employment_Status==1 && ((($City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai" || $City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad" || $City=="Greater Noida") && (($existing_rel==1) && $net_salary>=240000) || ($net_salary>=360000)) || (($City=="Surat" || $City=="Nashik" || $City=="Nasik" || $City=="Pune" || $City=="Bangalore" || $City=="Mysore" || $City=="Coimbatore" || $City=="Chennai" || $City=="Hyderabad" || $City=="Secunderabad" || $City=="Vizag" || $City=="Kolkata" || $City=="Hooghly" || $City=="Howrah" || $City=="Ahmedabad" || $City=="Gandhinagar" || $City=="Jamnagar" || $City=="Rajkot" || $City=="Valsad" || $City=="Vapi" || $City=="Bharuch" || $City=="Ankleshwar" || $City=="Vadoadara" || $City=="Baroda" || $City=="Vadodara" || $City=="Chandigarh" || $City=="Mohali" || $City=="Panchkula" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Indore" || $City=="Bhopal" || $City=="Kochi" || $City=="Jaipur" || $City=="Jodhpur" || $City=="Udaipur" || $City=="Jammu" || $City=="Dombivali" || $City=="Kalyan" || $City=="Badlapur" || $City=="Naigaon") && (($existing_rel==1) && $net_salary>=210000) || ($net_salary>=300000)))) || ($Employment_Status==0 && ($existing_rel==1) && $net_salary>=250000))
		{
			$DataArray = array("icici_eligible_flag"=>'1');
			$wherecondition ="(iciciccid=".$icici_crdvalue.")";
			Mainupdatefunc ('icici_credit_card', $DataArray, $wherecondition);
		}
		else
		{
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$mobile_no."' and Mobile_Number not in ('9811555306','9971396361','9999047207','9811215138','9999570210') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
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
			list($CheckNumRows,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
			
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$full_name, 'Email'=>$email_id, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$company_name, 'City'=>$City, 'Mobile_Number'=>$mobile_no, 'Net_Salary'=>$net_salary, 'DOB'=>$dob, 'Dated'=>$Dated, ' source'=>'icicicc-mailer', 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'applied_card_name'=>'ICICI Bank Platinum Chip Credit Card', 'City_Other'=>$icici_city_other);
				//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$email_id, "FName"=>$full_name, "Phone"=>$mobile_no, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID1 = Maininsertfunc ('wUsers', $wUsersdata);	
				$dataInsert = array('UserID'=>$UserID1, 'Name'=>$full_name, 'Email'=>$email_id, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$company_name, 'City'=>$City, 'Mobile_Number'=>$mobile_no, 'Net_Salary'=>$net_salary, 'DOB'=>$dob, 'Dated'=>$Dated, ' source'=>'icicicc-mailer', 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'applied_card_name'=>'ICICI Bank Platinum Chip Credit Card', 'City_Other'=>$icici_city_other);									
			}
			$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);
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
<link href="css/icici-platinum-card.css" type="text/css" rel="stylesheet"  />
<title>ICICI Platinum Chip Card | Deal4loans.com</title>
</head>
<body>
<div class="platinum_top_box">
<div class="platinum_top_box-b">
<div class="logo_platinum"><img src="images/d4l-platinum.png" width="157" height="63"></div>
<div class="logo_platinum_icici"><img src="images/icici-platinum-card-logo.png" width="305" height="62"></div>
 </div>
</div>
<div style="clear:both;"></div>
<div class="platinum_second-wrapper" style="margin-top:15px;">
<div class="platinum_right_box" style="float:none; width:800px; margin:auto;">
<div class="platinum_right_row-a"  style="float:none; width:800px; margin:auto;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="center" height="40"><span style="font-family: Arial, Helvetica, sans-serif; font-size:18px; color: #000000;" ><? if(strlen($ehomessage)>2) { echo $ehomessage."<br>"; } else {?>Thank you for applying ICICI Platinum Chip Credit Card.<br>Our representative will Contact you shortly.<? } ?> </span></td>
      </tr>
    <tr>
      <td width="24%" ><img src="images/icici-patinum-card.jpg"  width="189" height="125"></td>
      <td width="76%" class="text_platinum_bullet">
      <ul>
      <li>Security of a Chip<br>
      </li>
      <li>Minimum 15% savings at participating restaurants<br>
      </li>
      </ul></td>
    </tr>
  </table>
</div>

<div align="right" style="padding:10px;"><img src="images/powered-by-deal4loans.jpg" width="208" height="20"></div>
</div>

</div>
</body>
</html>
