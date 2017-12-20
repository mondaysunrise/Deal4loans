<?php
require 'scripts/db_init.php';
require 'scripts/db_init_wishfin.php';
//require 'scripts/functions.php';
$Dated = ExactServerdate();
$lead_allocation_logic=171;
$leadidentifier='wishfin_whatsapp_cc';

	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$wf_id = $row["total_lead_count"];

$date= date('Y-m-d');
$hour = date("H")-2;
$min_date = $date." 00:00:00";
//$min_date = "2017-11-11 17:00:00";
$max_date = $date." ".$hour.":00:00";


$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
$days30date=date('Y-m-d',$tomorrow);
$days30datetime = $days30date." 00:00:00";
$currentdate= date('Y-m-d');
$currentdatetime = date('Y-m-d')." 23:59:59";


$sql = "select *, xkyknzl5dwfyk4hg_whatsapp_chatbot_product_group.id as u_id from xkyknzl5dwfyk4hg_whatsapp_chatbot_product_group inner join xkyknzl5dwfyk4hg_whatsapp_chatbot_group_detail ON xkyknzl5dwfyk4hg_whatsapp_chatbot_product_group.group_id=xkyknzl5dwfyk4hg_whatsapp_chatbot_group_detail.group_id where product_type='CC' AND (xkyknzl5dwfyk4hg_whatsapp_chatbot_product_group.date_created between '".$min_date."' AND '".$max_date."' ) AND end_of_journey=0 AND xkyknzl5dwfyk4hg_whatsapp_chatbot_product_group.id>'".$wf_id."' AND `last_sequence_number`>2";
echo $sql."<br><br>";
$qry = wf_ExecQuery($sql);
echo $num =wf_mysql_num_rows($qry);
//die();
for($i=0;$i<$num;$i++)
{
	$id = wf_mysql_result($qry,$i,'u_id');
	$group_id = wf_mysql_result($qry,$i,'group_id');
	$mobile_number=wf_mysql_result($qry,$i,'mobile_number');
	$last_sequence_number=wf_mysql_result($qry,$i,'last_sequence_number');
	$getLeadDetailsSql = "SELECT xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.id AS id, xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.question_id AS question_id,   xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.answer AS answer, wc_qus.attribute_name AS attribute_name FROM xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire LEFT JOIN  xkyknzl5dwfyk4hg_whatsapp_chatbot_questions AS wc_qus ON wc_qus.id = xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.question_id WHERE   xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.group_id = '".$group_id."' AND xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.valid = 1 AND xkyknzl5dwfyk4hg_whatsapp_chatbot_questionnaire.status = 1 AND wc_qus.wait_for_response = 1";
	$qryLeadDetails = wf_ExecQuery($getLeadDetailsSql);
	$numLeadDetails =wf_mysql_num_rows($qryLeadDetails);
	
	$postData= '';
	$postData['Mobile_Number'] = $mobile_number;
	$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$mobile_number."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9873678914','9999570210','9555060388') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($checkDupNum,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;

	if($checkDupNum>0)
	{
		$ProductValue = $myrow[$myrowcontr]['RequestID'];
	}
	else
	{
		foreach($qryLeadDetails as $questionarieData)
		{
			 if ($questionarieData['attribute_name'] == 'fullname') 
			 {
			 	$postData['Name'] = $questionarieData['answer'];
			 }
			 else if ($questionarieData['attribute_name'] == 'emailid') 
			 {
			 	$postData['Email'] = $questionarieData['answer'];
			 }
			 else if ($questionarieData['attribute_name'] == 'creditcardbank') 
			 {
			 	$noCardArray = array('no', 'none');
	            if (in_array(strtolower($questionarieData['answer']), $noCardArray)) {
	                $postData['CC_Holder'] = 0;
	                
	            } else {
	            	$postData['CC_Holder'] = 1;
	                $postData['No_of_Banks'] = $questionarieData['answer'];
	            }
			 }
			 else if ($questionarieData['attribute_name'] == 'annualincome') 
			 {
			    if (strpos(strtolower($questionarieData['answer']), 'lacs') !== false) {
	                $questionarieData['answer'] = trim(rtrim(strtolower($questionarieData['answer']), 'lacs'));
	            }
	            if($questionarieData['answer'] < 100) {
	                $questionarieData['answer'] = $questionarieData['answer'] * 100000;
	            }
	            $questionarieData['answer'] = (int) str_replace(",", "", $questionarieData['answer']);
			 
			 	$postData['Net_Salary'] = $questionarieData['answer'];
			 }
			 else if ($questionarieData['attribute_name'] == 'occupation') 
			 {
			 	$postData['Employment_Status'] = (strtolower($questionarieData['answer']) == "salaried") ? 1 : 0;
			 }
			 else if ($questionarieData['attribute_name'] == 'city') 
			 {
			 	$postData['City'] = $questionarieData['answer'];
			 }
			 else if ($questionarieData['attribute_name'] == 'companyname') 
			 {
			 	$postData['Company_Name'] = $questionarieData['answer'];
			 }
			 else if ($questionarieData['attribute_name'] == 'dob') 
			 {
				$questionarieData['answer'] = getformattedDateOfBirth($questionarieData['answer']);
			 	$postData['DOB'] = $questionarieData['answer'];
			 }
		}
		
		$postData['source']='Wishfin_Whatsapp_Leads';
		$postData['Dated']=$Dated;
		$postData['Updated_Date']=$Dated;
		$ProductValue = Maininsertfunc ("Req_Credit_Card", $postData);
		echo "<pre>";
		print_r($postData);
		echo "<br>";
	}

	echo $updateqry= "Update xkyknzl5dwfyk4hg_whatsapp_chatbot_product_group set d4l_id='".$ProductValue."' Where (id='".$id."')";
	$updateqryresult = wf_ExecQuery($updateqry);
	echo "<br>";
	
	echo $updateqry= "Update lead_allocation_table set total_lead_count='".$id."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	$updateqryresult = d4l_ExecQuery($updateqry);
	
}
			
 function getformattedDateOfBirth($dob)
 {
   return reformatDate(str_replace("-", "/", $dob));
 }
 function reformatDate($date, $fromFormat = 'd/m/Y', $toFormat = 'Y-m-d') 
 {
    $formattedDate = $date;
    if (!empty($date)) {
        $dateAux = date_create_from_format($fromFormat, $date);
        $formattedDate = date_format($dateAux, $toFormat);
    }
    return $formattedDate;
 }




?>