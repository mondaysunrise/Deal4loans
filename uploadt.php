<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

  $file_id='file';
  $status='';
  $filename=$_FILES[$file_id]['name'];
  $tmpfile=$_FILES[$file_id]['tmp_name'];
  $statement = $_POST['statement'];
  $req = $_POST['req'];


  if(!$_FILES[$file_id]['name']) {
    	echo returnStatus("<font color=\'red\'>no file specified</font>");
    	return;
  }
  $strfilename =  $req."_4_".$filename;

  /*copy file over to tmp directory */
  if(move_uploaded_file($tmpfile, "upload/".$strfilename)){
    $status='Success';

	$checkSql = "select DocID  from upload_documents where RequestID='".$req."' and Reply_Type=4";
	list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());
	if($numRows>0)
	{
		$DataArray = array("Bank_Statement"=>$strfilename);
		$wherecondition ="(RequestID = '".$req."' and  Reply_Type='4')";
		Mainupdatefunc ('upload_documents', $DataArray, $wherecondition);
	}
	else
	{
		$data = array("Reply_Type"=>'4', "RequestID"=>$req , "Bank_Statement"=>$strfilename , "mode"=>'');
		$table = 'upload_documents';
		$insert = Maininsertfunc ($table, $data);

		$DataArray = array("Loan_Amount"=>'1');
		$wherecondition ="(RequestID = '".$req."')";
		Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);	
	}

  }else{
    $status='<font color=\'red\'>Failed</font>';
  }
  echo returnStatus($status);

function returnStatus($status){
		return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete) top.uploadComplete('".$status."');}window.onload=init;
	</script></body></html>";
	}
?>