<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//require('class.image-resize.php');
  $file_id='file';
  $status='';
  $filename=$_FILES[$file_id]['name'];
  $tmpfile=$_FILES[$file_id]['tmp_name'];
  $RequestID = $_POST['RequestID'];
  $Doc_Name = $_POST['Doc_Name'];
 
 
$filename = $RequestID."_".$filename;
$uploadfile = "upload_icici/".$filename;
  if(!$_FILES[$file_id]['name']) {
    	echo returnStatus("<font color=\'red\'>no file specified</font>");
    	return;
  }
  /*copy file over to tmp directory */
  if(move_uploaded_file($tmpfile, "upload_icici/".$filename)){
		
		
		require('class.image-resize.php');
$obj = new img_opt();
// set maximum width within wich the image should be resized
$obj->max_width(300);
// set maximum height within wich the image should be resized
// for example size of the area in which image to be displayed
$obj->max_height(300);
$obj->image_path("upload_icici/".$filename);
// call the functio to resize the image
$a = $obj->image_resize();

    	$status='Success';

		$DataArray = array("photo_proof_doc"=>$filename);
		$wherecondition ="(iciciappid='".$RequestID."')";
		Mainupdatefunc ('icici_exclusive_app_docs', $DataArray, $wherecondition);

  }else{
    $status='<font color=\'red\'>Failed</font>';
  }
  echo returnStatus($status);


	function returnStatus($status){
		return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete_5) top.uploadComplete_5('".$status."');}window.onload=init;
	</script></body></html>";
	}

?>