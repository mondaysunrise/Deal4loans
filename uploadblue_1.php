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
  /*copy file over to tmp directory */
  if(move_uploaded_file($tmpfile, "uploadblue/".$filename)){
    	$status='<span style="color:#FF0000; font-size:10px;">Success</span>';
	
	$checkSql = "select DocID  from docs_uploaded_blue where RequestID='".$RequestID."' and Doc_Name='".$Doc_Name."'";
	list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());
	if($numRows>0)
	{
		$DataArray = array("Filename"=>$filename);
		$wherecondition ="(RequestID = '".$RequestID."' and  Doc_Name='".$Doc_Name."')";
		Mainupdatefunc ('docs_uploaded_blue', $DataArray, $wherecondition);
	}
	else
	{
		$data = array("RequestID"=>$RequestID , "Doc_Name"=>$Doc_Name , "Filename"=>$filename);
		$table = 'docs_uploaded_blue';
		$insert = Maininsertfunc ($table, $data);
	}
	

  }else{
    $status='<font color=\'red\'>Failed</font>';
  }
  echo returnStatus($status);


	function returnStatus($status){
		return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete_1) top.uploadComplete_1('".$status."');}window.onload=init;
	</script></body></html>";
	}

?>