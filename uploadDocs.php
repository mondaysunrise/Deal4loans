<?php
ob_start();
require 'scripts/db_init.php';
require 'scripts/db_init_fil.php';

$getLastDocSql = "select RequestID from Req_Compaign where Compaign_ID=1699";
list($recordcount,$getLastDocQuery)=MainselectfuncNew($getLastDocSql,$array = array());
$lastID = $getLastDocQuery[0]['RequestID'];

$getDocSql = "select * from upload_documents where RequestID>'".$lastID."' and Reply_Type=1";
list($numgetDoc,$getDocQuery)=MainselectfuncNew($getDocSql,$array = array());
for($jj=0;$jj<$numgetDoc;$jj++)
{
	$Appointment_Letter = $getDocQuery[$jj]['Appointment_Letter'];
	$Form16  = $getDocQuery[$jj]['Form16'];
	$Salary_Slip = $getDocQuery[$jj]['Salary_Slip'];
	$Bank_Statement  = $getDocQuery[$jj]['Bank_Statement'];
	$Pancard  = $getDocQuery[$jj]['Pancard'];
	$Voterid = $getDocQuery[$jj]['Voterid'];
	$Passport = $getDocQuery[$jj]['Passport'];
	$Driving_License  = $getDocQuery[$jj]['Driving_License'];
	$Photo = $getDocQuery[$jj]['Photo'];
	$LIC_Policy = $getDocQuery[$jj]['LIC_Policy'];
	$Telephone_Bill = $getDocQuery[$jj]['Telephone_Bill'];
	$Electricity_Bill  = $getDocQuery[$jj]['Electricity_Bill'];
	$Loan_Track  = $getDocQuery[$jj]['Loan_Track'];
	$CC_Photocopy = $getDocQuery[$jj]['CC_Photocopy'];
	$mode  = $getDocQuery[$jj]['mode'];
	$status = $getDocQuery[$jj]['status'];
	$RequestID = $getDocQuery[$jj]['RequestID'];
	$Reply_Type = $getDocQuery[$jj]['Reply_Type'];
	$DocID = $getDocQuery[$jj]['DocID'];
	
	$insertSql = "INSERT INTO upload_documents (DocID, Reply_Type, RequestID, Appointment_Letter, Form16, Salary_Slip, Bank_Statement, Pancard, Voterid, Passport, Driving_License, Photo, LIC_Policy, Telephone_Bill, Electricity_Bill, Loan_Track, CC_Photocopy, mode, status) VALUES ('$DocID', '$Reply_Type', '$RequestID', '$Appointment_Letter', '$Form16', '$Salary_Slip', '$Bank_Statement', '$Pancard', '$Voterid', '$Passport', '$Driving_License', '$Photo', '$LIC_Policy', '$Telephone_Bill', '$Electricity_Bill', '$Loan_Track', '$CC_Photocopy', '$mode', '$status')";
	echo $insertSql."<br>";
	
		$updateleadSql = "update Req_Compaign set RequestID='".$RequestID."' where Compaign_ID=1699";

	echo $updateleadSql."<br>";

	


}

?>