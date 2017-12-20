<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$file_id='file';
$status='';
$filename=$_FILES[$file_id]['name'];
$tmpfile=$_FILES[$file_id]['tmp_name'];
$RequestID = $_POST['RequestID'];
  $Reply_Type = $_POST['Reply_Type'];
  $source = $_POST['source'];
$BidderID = $_POST['BidderID'];

$filename = $RequestID."_".$filename;

if(!$_FILES[$file_id]['name']) {
	echo returnStatus("<font color=\'red\'>no file specified</font>");
	return;
}

/*copy file over to tmp directory */
if(move_uploaded_file($tmpfile, "upload/".$filename)){
	
	$d ='';
 	$checkSql = "select *  from upload_documents where RequestID='".$RequestID."' and Reply_Type='".$Reply_Type."'";
	list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());
	if($numRows>0)
	{
		$DataArray = array("Appointment_Letter"=>$filename);
		$wherecondition ="(RequestID = '".$RequestID."' and  Reply_Type='".$Reply_Type."')";
		Mainupdatefunc ('upload_documents', $DataArray, $wherecondition);
	}
	else
	{
		$data = array("Reply_Type"=>$Reply_Type , "RequestID"=>$RequestID , "Voterid"=>$filename , "mode"=>$source , "BidderID"=>$BidderID);
		$table = 'upload_documents';
		$insert = Maininsertfunc ($table, $data);

		$DataArray = array("upload_flag"=>'1');
		$wherecondition ="(RequestID = '".$RequestID."')";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);	
	}
	$status='Success';
	
}else{
	$status='<font color=\'red\'>Failed</font>';
}
//echo $sql ;
echo returnStatus($status);


function returnStatus($status){
	return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete_15) top.uploadComplete_15('".$status."');}window.onload=init;
	</script></body></html>";
}

?>