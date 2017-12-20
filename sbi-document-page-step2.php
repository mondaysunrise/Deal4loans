<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$set1_doc_name = '';

$Dated=ExactServerdate();
$reqid = $_REQUEST['reqid'];
$status = $_REQUEST['status'];
$requestID = base64_decode($reqid);
$StatusCode = base64_decode($status);

//If page land directly from website then 4. If page land from any LMS then respective type
$productflag = isset($_REQUEST['productflag']) ? $_REQUEST['productflag'] : '4';

//Get User Details From Req_Credit_Card
$slct="SELECT * FROM Req_Credit_Card WHERE RequestID='".$requestID."'";
$slctResult = d4l_ExecQuery($slct);
$slctResponse = d4l_mysql_fetch_array($slctResult);
$Name = $slctResponse['Name'];
$City = $slctResponse['City'];
$Employment_Status = $slctResponse['Employment_Status'];
if($Employment_Status == 1){
	$occupation_type = 1;
}
else{
	$occupation_type = 0;
}

//Get User Details From sbi_credit_card_5633
$slct1="SELECT * FROM sbi_credit_card_5633 WHERE RequestID='".$requestID."' AND productflag = '".$productflag."'";
$slct1Result = d4l_ExecQuery($slct1);
$slct1Response = d4l_mysql_fetch_array($slct1Result);
$CardName = trim($slct1Response['CardName']);
$CompanyName = trim($slct1Response['CompanyName']);

//Get Company Category
$company_category = '';
$getCompanyNameSql = "SELECT * FROM sbi_cc_company_list WHERE sbi_companyname = '".$CompanyName."'";
$getCompanyNameResult = d4l_ExecQuery($getCompanyNameSql);
$getCompanyNameResponse = d4l_mysql_fetch_array($getCompanyNameResult);
$company_category = $getCompanyNameResponse["sbi_category"];

//Get Card Type
$card_type = '';
if($CardName=="SBI Card Prime"){
	$card_type="VPTL"; $PromoCode="SCEA";
}
elseif($CardName=="Yatra SBI Card"){
	$card_type="SYT1"; $PromoCode="YAEA";
}
elseif($CardName=="IRCTC SBI Platinum Card"){
	$card_type="IRCP";  $PromoCode="IREA";
}
elseif($CardName=="Air India SBI Signature Card"){
	$card_type="AISU"; $PromoCode="SCEA";
}
elseif($CardName=="Air India SBI Platinum Card"){
	$card_type="AIPU"; $PromoCode="SCEA";
}
elseif($CardName=="SBI SimplySave"){
	$card_type="SSU2"; $PromoCode="SCEA";
}
elseif($CardName=="SimplyCLICK Contactless SBI Card"){
	$card_type="CSC2"; $PromoCode="SCEA";
}
elseif($CardName=="SimplyCLICK SBI Card"){
	$card_type="CSC2"; $PromoCode="SCEA";
}
elseif($CardName=="Mumbai Metro SBI Card"){
	$card_type="MMSU";  $PromoCode="SCEA";
}
elseif($CardName=="SBI ELITE Card"){
	$card_type="VISC";  $PromoCode="SCEA";
}
elseif($CardName=="Fbb SBI STYLEUP Contactless Card"){
	$card_type="FBBS"; $PromoCode="SCEA";
}
else{
	$card_type="SSU2"; $PromoCode="SCEA";
}

//Get source_code from city
$getSourceCodeQry = "SELECT * FROM sbi_cc_city_state_list WHERE city like'%".strtoupper($City)."%' GROUP BY city LIMIT 0,1";
$getSourceCodeResult = d4l_ExecQuery($getSourceCodeQry);
$getSourceCodeResponse = d4l_mysql_fetch_assoc($getSourceCodeResult);
$source_code = $getSourceCodeResponse["source_code"];


$document_set1 = array('Pay Slip/Salary Slip', 'Credit Card Statement', 'ITR and Bank Statement');
$document_set2 = array('Pay Slip/Salary Slip', 'Credit Card Statement', 'ITR and Bank Statement', 'Form 16 and Bank Statement');
$document_set3 = array('Credit Card Statement', 'ITR and Bank Statement');
$document_set4 = array('Credit Card Statement', 'ITR and Bank Statement');

$payslipArr = array('Slip for 1st month','Slip for 2nd month');
$creditcardArr = array('Credit Card Statement','Credit Card Face');
$itrArr = array('ITR Statement','Acknowledge Slip','Bank Statement');
$form16Arr = array('Form 16','Bank Statement');


$uploadDocument1ProofStatus = $uploadDocument1ProofMessage = $uploadDocument2ProofStatus = $uploadDocument2ProofMessage = '';
$errorMessage = $successMessage = '';
$doc_category = 'Surrogate';

//echo 'CompCat-'.$company_category;
//echo 'CardType-'.$card_type;
//echo 'OccuType-'.$occupation_type;

//Get doc set
//$card_type = 'SSU2';
//$occupation_type = 0;
//$company_category = 'B';

/*
//Check if exact match for all values(occupation_type, company_category, card_id)
$getFirstDocSetSql = "SELECT * FROM sbi_documents_decision_table WHERE occupation_type = '".$occupation_type."' AND company_category = '".$company_category."' AND FIND_IN_SET('".$card_type."', card_id)";
$getFirstDocSetResult = d4l_ExecQuery($getFirstDocSetSql);
$getFirstDocSetNumRows = d4l_mysql_num_rows($getFirstDocSetResult);
if($getFirstDocSetNumRows > 0){
	$getFirstDocSet = d4l_mysql_fetch_assoc($getFirstDocSetResult);
	$doc_set= $getFirstDocSet["doc_set"];
}
else{
	//Check for selected values(occupation_type, company_category)
	$getDocSetSql = "SELECT * FROM sbi_documents_decision_table WHERE occupation_type = '".$occupation_type."' AND company_category = '".$company_category."'";
	$getDocSetResult = d4l_ExecQuery($getDocSetSql);
	while($getDocSetArr = d4l_mysql_fetch_assoc($getDocSetResult)){
		$finalgetDocSetArr[] = $getDocSetArr;
	}
	echo '<pre>';print_r($finalgetDocSetArr);

	if(count($finalgetDocSetArr) == 1){
		$doc_set= $finalgetDocSetArr[0]["doc_set"];
	}
	else{
		foreach($finalgetDocSetArr as $value){
			echo $getFinalSetSql = "SELECT * FROM sbi_documents_decision_table WHERE id = '".$value['id']."' AND FIND_IN_SET('".$card_type."', card_id)";
			$getFinalSetResult = d4l_ExecQuery($getFinalSetSql);
			
			$doc_set= $value["doc_set"];
		}
	}
}

*/

if($company_category == 'A' && $occupation_type == 1){
	$doc_set = 1;
}
elseif($company_category == 'B' && $occupation_type == 1){
	if(strpos('SCU2,SSU2', $card_type) !== false){
		$doc_set = 2;
	}
	else{
		$doc_set = 1;
	}
}
elseif($company_category == 'C' && $occupation_type == 1){
	$doc_set = 3;
}
elseif($occupation_type == 1){
	$doc_set = 3;
}
elseif($occupation_type == 0){
	$doc_set = 4;
}
//echo 'Doc set - '.$doc_set;exit;

if($doc_set == 1){
	$document_set = $document_set1;
}
elseif($doc_set == 2){
	$document_set = $document_set2;
}
elseif($doc_set == 3){
	$document_set = $document_set3;
}
elseif($doc_set == 4){
	$document_set = $document_set4;
}
else{
	$document_set = $document_set1;
}

if(isset($_POST["submit"])) {
	//echo '<pre>';print_r($_FILES);
	$set1_doc_name = $_POST["document_set1_options"];
	if(empty($set1_doc_name)){
		$errorMessage .= '* Document1: Please select document type.<br>';
	}

	foreach($_FILES as $key=>$files){

		$checkset1doc = checkValidDoc($_FILES[$key]);
		
		if($_FILES[$key]['error'] == 4){
			$errorMessage .= '* '.$key.': Please choose document.<br>';
		}
		if($checkset1doc['status'] == 'failure'){
			if($checkset1doc['message'] == 'Invalid_Doc'){
				$errorMessage .= '* '.$key.': Only PDF, JPEG, & TIFF files are allowed.<br>';
			}
			if($checkset1doc['message'] == 'Invalid_Size'){
				$errorMessage .= '* '.$key.': Max file size should be 2 Mb.<br>';
			}
		}
	}

	if(empty($errorMessage)){
		foreach($_FILES as $key1=>$files1){
			//Upload Document1
			$uploadDocument1Proof = uploadImage($_FILES[$key1], $requestID, $key1);
			
			$uploadDocument1ProofStatus = isset($uploadDocument1Proof['status']) ? $uploadDocument1Proof['status'] : '';
			$uploadDocument1ProofMessage = isset($uploadDocument1Proof['message']) ? $uploadDocument1Proof['message'] : '';
			
			if($uploadDocument1ProofStatus == 'success'){
				$doc_type = $set1_doc_name;
				$doc_name = $key1;
				$doc_path =  $uploadDocument1Proof['doc_path'];
				//Insert document in table sbi_documents
				$DataArrayLog = array("RequestID"=>$requestID, "doc_category"=>$doc_category, "doc_type"=>$doc_type, "doc_name"=>$doc_name, "doc_path"=>$doc_path, "source_code"=>$source_code, "created_date"=>$Dated);
				$document_id = Maininsertfunc('sbi_documents', $DataArrayLog);
			}
			else{
				if($uploadDocument1ProofMessage = 'Some_Issue'){
					$errorMessage .= '* '.$key1.': There is some issue in uploading document.<br>';
				}
			}
		}
		
		if(empty($errorMessage)){
			$successMessage = 'Surrogate Documents Uploaded Successfully';
			$_SESSION['surrogate_message'] = $successMessage;
			header('Location: sbi-document-thanks.php?reqid='.$reqid.'&status='.$status);
		}
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SBI Documents</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="css/jquery-selectbox.css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link href="css/sbi-document-styles.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style>
.d4l{}
.d4l .nav>li>a {
   position: relative;
   display: block;
  padding:0px 15px;
}
.d4l .nav>li>a:hover {
  background:none !important;
}
</style>
</head>
<body class="d4l">
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<section class="sbi-document">
	<div class="container">
		<div class="col-md-12">
			<div class="tick"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
			<h1>Congrats <?php echo $Name; ?> !</h1>
			<?php 
			if(isset($_SESSION['kyc_message']) && !empty($_SESSION['kyc_message'])){ ?>
			<p class="text-center font14-medium">Your KYC documents have been uploaded successfully</p>
			<?php 
			}
			else{
			?>
			<p class="text-center font14-medium">Your application for the Instant approval has been submitted successfully.</p>
			<?php
			}?>
			<p class="font14-gray pd-top-55">Share the documents for faster processing of your application</p>
		</div>
		<div>
			<form method="post" enctype="multipart/form-data">
				<div class="col-md-12 mr-33">
					<div class="sbi-document-inner">
						<div class="kyc-text">SURROGATE DOCUMENTS</div>
						<div class="accept-box" data-toggle="modal" data-target="#contentModal">
							<!-- Button trigger modal -->
							  ACCEPTABLE DOCUMENTS
							<!-- Modal -->
						</div>
						<div class="clearfix"></div>
						<p class="description-box"> </p>
						<?php 
						if(!empty($errorMessage)){ 
						?>
						<div class="row" style="color:red; font-size: 15px; margin-left: 0px; margin-top: -20px; padding-bottom: 15px;">
							<?php echo $errorMessage; ?>
						</div>
						<?php 
						}
						else{
						?>
						<div class="row" style="color:green; font-size: 15px; margin-left: 0px; margin-top: -20px; padding-bottom: 15px;">
							<?php echo $successMessage; ?>
						</div>
						<?php
						}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-label">Document Set</div>
								<select id="document_set1_options" name="document_set1_options">
									<option value="">Select document type</option>
									<?php 
									foreach($document_set as $value){
									?>
									<option value="<?php echo $value; ?>" <?php if($set1_doc_name == $value){ echo 'selected'; }?>><?php echo $value; ?></option>
									<?php
									}
									?>
								</select>
								<div style="color: red; margin-top: 5px; font-size: 12px;"></div>
							</div>
						</div>
						<div class="row" id="fileInputs">
							<!--
							<div class="col-md-6 col-sm-6">
								<div>Demo 1</div>
								<input id="document1_value" placeholder="Choose File" disabled="disabled" class="choose-file no-mr-tp" />
								<div class="fileUpload upload-box no-mr-tp">
									<span>Browse</span>
									<input id="document1" name="document1" type="file" class="document1" />
								</div>
							   <div>
									<div class="col-md-12 no-mr-left-15">
										<p class="gray-upload-text">Only PDF, JPEG, & TIFF files are allowed. Max file size should be 1 Mb.</p>
									</div>
								</div>
							</div>
							-->
						</div>
					</div>
				</div>
				<div class="colo-md-12 text-right"> <input type="submit" id="submit" name="submit" value="Submit" class="submit-sbi" /></div>
			</form>
		</div>
	</div>
</section>
<div style="clear:both; height:100px;"></div>
<?php include("footer_sub_menu.php"); ?>

<!-- Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-docs" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentModalLabel">List of Acceptable Surrogate Documents (Ensure you SIGN on the copy before uploading)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body contentmodal-body">
        <table class="table table-responsive table-bordered doctable">
         <thead>
			<tr>
			  <th>Surrogate Document</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td><b>Pay Slip/Salary Slip</b> (Slip for 1st month, Slip for 2nd month)</td>
			</tr>
			<tr>
			  <td><b>Credit Card Statement</b> (Credit Card Statement, Credit Card Face)</td>
			</tr>
			<tr>
			  <td><b>ITR and Bank Statement</b> (ITR Statement, Acknowledge Slip, Bank Statement(Last 2 Months))</td>
			</tr>
			<tr>
			  <td><b>Form 16 and Bank Statement</b> (Form 16, Bank Statement(Last 2 Months))</td>
			</tr>
		  </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="js/jquery-ui.min.js" ></script>
<script src="js/selectbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#document_set1_options").selectBoxIt({
		theme: "default",
	});
	
	createfileuploadelements();
	
	$("#document_set1_options").on('change', function() {
		createfileuploadelements();
	});
	
	function createfileuploadelements(){
		var fileArr = [];
		var selecteddocument = $("#document_set1_options").val();
		$('#fileInputs div').remove();
		if(selecteddocument == 'Pay Slip/Salary Slip'){
			var fileArr = <?php echo json_encode($payslipArr); ?>;
		}
		if(selecteddocument == 'Credit Card Statement'){
			var fileArr = <?php echo json_encode($creditcardArr); ?>;
		}
		if(selecteddocument == 'ITR and Bank Statement'){
			var fileArr = <?php echo json_encode($itrArr); ?>;
		}
		if(selecteddocument == 'Form 16 and Bank Statement'){
			var fileArr = <?php echo json_encode($form16Arr); ?>;
		}
		
		for (var i = 0; i < fileArr.length; i++) {
			var k = i+1;
			var originalfilename = fileArr[i];
			var displayfilename = '';
			var filename = fileArr[i].replace(/ /g,"_");
			if(originalfilename == 'Bank Statement'){
				displayfilename = 'Bank Statement(Last 2 Months)';
			}
			else{
				displayfilename = originalfilename;
			}
			$('#fileInputs').append('<div class="col-md-6 col-sm-6"><div>'+displayfilename+'</div><input id="'+filename+'_value" placeholder="Choose File" disabled="disabled" class="choose-file no-mr-tp" /><div class="fileUpload upload-box no-mr-tp"><span>Browse</span><input id="'+filename+'" name="'+filename+'" type="file" class="document1" onchange="showfilename(this.id, this.value);" /></div><div><div class="col-md-12 no-mr-left-15"><p class="gray-upload-text">Only PDF, JPEG, & TIFF files are allowed. Max file size should be 1 Mb.</p></div></div></div>');
		}
	}

});

function showfilename(id, filevalue){
	$("#"+id+"_value").val(filevalue);
}

</script>
</body>
</html>
<?php
function checkValidDoc($file){
	$responseData = array();

	if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
		// start code for checking mime type of imimage_urlage
		$image_finfo = finfo_open(FILEINFO_MIME_TYPE);
		$image_mime_type = finfo_file($image_finfo, $file['tmp_name']);
		if (!empty($file['tmp_name'])) {
			//$image_filetype = array("image/jpg", "image/jpeg", "image/png", "image/bmp", "image/GIF", "image/JPG", "image/JPEG", "image/PNG", "image/BMP");
			$image_filetype = array("image/jpg", "image/jpeg", "image/tiff", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
			if (!in_array($image_mime_type, $image_filetype)) {
				$responseData = array(
					'status' => 'failure',
					'message' => 'Invalid_Doc',
				);
			}
			finfo_close($image_finfo);
		}
		else if($file['size'] > 2097152) {
			$responseData = array(
				'status' => 'failure',
				'message' => 'Invalid_Size',
			);
		}
		else{
			$responseData = array(
				'status' => 'success',
				'message' => 'Valid_Doc',
			);
		}
	}
	return $responseData;
}

function uploadImage($file, $requestID, $type) {
	$responseData = array();

	if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
		//Save image
		$file_Name = $file['name'];
		$file_tmp_name = $file['tmp_name'];
		$dir = $_SERVER['DOCUMENT_ROOT'] . "/sbi_docs";
		/*
		if (!file_exists($dir.$requestID) && !is_dir($dir.$requestID)) {
			mkdir($dir.$requestID, 777);
		}
		chmod($dir.$requestID, 0777);
		*/
		$file_newfilename = $requestID . '_' . $type . '_' . time();
		$file_name = strtolower(basename($file_Name));
		$file_ext = substr($file_name, strrpos($file_name, '.') + 1);
		$file_ext = "." . $file_ext;
		$file_returnName = $file_newfilename . $file_ext;
		$file_newname = $dir . "/" . $file_newfilename . $file_ext;
		if(move_uploaded_file($file_tmp_name, $file_newname)){
			$responseData = array(
				'status' => 'success',
				'message' => 'Success',
				'doc_path' => $file_returnName,
			);
		}
		else{
			$responseData = array(
				'status' => 'failure',
				'message' => 'Some_Issue',
			);
		}
		$responseData['type'] = $type;
	}

	return $responseData;
}

?>

