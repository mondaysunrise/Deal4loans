<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
  $file_id='file';
  $status='';
  $filename=$_FILES[$file_id]['name'];
  $tmpfile=$_FILES[$file_id]['tmp_name'];
  $RequestID = $_POST['RequestID'];
  $Doc_Name = $_POST['Doc_Name'];
 
 
 
 
$filename = $RequestID."_".$filename;
  if(!$_FILES[$file_id]['name']) {
    	echo returnStatus("<font color=\'red\'>no file specified</font>");
    	return;
  }

  if(move_uploaded_file($tmpfile, "upload_icici/".$filename)){
    	$status='Success';

		$DataArray = array("income_proof_doc"=>$filename);
		$wherecondition ="(iciciappid='".$RequestID."')";
		Mainupdatefunc ('icici_exclusive_app_docs', $DataArray, $wherecondition);

  }else{
    $status='<font color=\'red\'>Failed</font>';
  }
  echo returnStatus($status);


	function returnStatus($status){
		return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete_1) top.uploadComplete_1('".$status."');}window.onload=init;
	</script></body></html>";
	}

?>