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
  if(move_uploaded_file($tmpfile, "upload/".$filename)){
    	$status='Success';
	
	$checkSql = "select DocID  from docs_uploaded_fil where RequestID='".$RequestID."' and Doc_Name='".$Doc_Name."'";
	list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());
	if($numRows>0)
	{
		$DataArray = array("Filename"=>$filename);
		$wherecondition ="(RequestID='".$RequestID."' and Doc_Name='".$Doc_Name."')";
		Mainupdatefunc ('docs_uploaded_fil', $DataArray, $wherecondition);
	}
	else
	{
	$data = array( "RequestID"=>$RequestID , "Doc_Name"=>$Doc_Name , "Filename"=>$filename);
		$insert = Maininsertfunc ('docs_uploaded_fil', $data);
	}


///////////
	$check_Sql = "select DocID  from upload_documents where RequestID='".$RequestID."' and Reply_Type='1'";
	list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());

	if($num_Rows>0)
	{
		$DataArray = array("Income_Proof"=>$filename);
		$wherecondition ="(RequestID='".$RequestID."'and Reply_Type='1')";
		Mainupdatefunc ('upload_documents', $DataArray, $wherecondition);
	}
	else
	{
		$data = array("Reply_Type"=>$Reply_Type , "RequestID"=>$RequestID , "Income_Proof"=>$filename , "mode"=>$source , "BidderID"=>$BidderID);
		$insert = Maininsertfunc ('upload_documents', $data);

		$DataArray = array("upload_flag"=>'1');
		$wherecondition ="(RequestID = '".$RequestID."')";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
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