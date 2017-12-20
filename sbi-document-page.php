<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$Dated=ExactServerdate();
$reqid = $_REQUEST['reqid'];
$status = $_REQUEST['status'];
$requestID = base64_decode($reqid);
$StatusCode = base64_decode($status);

$slct="SELECT * FROM Req_Credit_Card WHERE RequestID='".$requestID."'";
list($Getnum,$row)=Mainselectfunc($slct,$array = array());
$Name = $row['Name'];
$City = $row['City'];

//Get source_code from city
$getSourceCodeQry = "SELECT * FROM sbi_cc_city_state_list WHERE city like'%".strtoupper($City)."%' GROUP BY city LIMIT 0,1";
$getSourceCodeResult = d4l_ExecQuery($getSourceCodeQry);
$getSourceCodeResponse = d4l_mysql_fetch_assoc($getSourceCodeResult);
$source_code = $getSourceCodeResponse["source_code"];

//KYC documents for identity proof
$identity_proof_documents = array('Copy of Passport', 'Copy of Voter ID card', 'Driving License *', 'Copy of PAN Card', 'UID /Adhar Card', 'Identity card with applicant Photograph issued by Central / State Government Departments, Statutory/Regulatory Authorities, Public Sector Undertakings, Scheduled Commercial Banks, and Public Financial Institutions', 'Letter issued by a gazetted officer, with a duly attested photograph of the person', 'Overseas Citizen of India Card issued by Government along with the passport to NRIs and PIOs', 'Serving certificate with a photo. Issue date should be within 60 days from date of processing.', 'Employer ID card having address details and photo.', 'Employer ID card having address details and photo.');
//KYC documents for address proof
$address_proof_documents = array('Copy of Passport', 'Copy of Voter ID card', 'Driving License *', 'UID /Adhar Card', 'Letter issued by the Unique Identification Authority of India  containing details of name, address and Aadhaar number', 'Overseas Citizen of India Card issued by Government along with the passport to NRIs and PIOs', 'Electricity bill, Telephone bill, Postpaid mobile phone bill, Piped gas bill, Water bill', 'Property or Municipal Tax receipt', 'Bank account or Post Office savings bank account statement', 'Letter of allotment of accommodation from employer issued by State or Central Government departments, statutory or regulatory bodies, public sector undertakings, scheduled commercial banks, financial institutions and listed companies. Similarly, leave and license agreements with such employers allotting official accommodation', 'Pension or family pension payment orders (PPOs) issued to retired employees by Government Departments or Public Sector Undertakings, if they contain the address', 'Foreigners Regional Registration Office (India) Certificate', 'Serving certificate with a photo. Issue date should be within 60 days from date of processing.', 'Employer ID card having address details and photo.', 'Employer ID card having address details and photo.');


$uploadIdentityProofStatus = $uploadIdentityProofMessage = $uploadAddressProofStatus = $uploadAddressProofMessage = '';
$errorMessage = $successMessage = '';
$doc_category = 'KYC';

if(isset($_POST["submit"])) {
	$identity_doc_name = $_POST["identity_proof_options"];
	$address_doc_name = $_POST["address_proof_options"];
	
	$checkidentityproofdoc = checkValidDoc($_FILES["identity_proof"]);
	$checkaddressproofdoc = checkValidDoc($_FILES["address_proof"]);
	
	if(empty($identity_doc_name)){
		$errorMessage .= '* Identity Proof: Please select document type.<br>';
	}
	if(empty($address_doc_name)){
		$errorMessage .= '* Address Proof: Please select document type.<br>';
	}
	if($_FILES['identity_proof']['error'] == 4){
		$errorMessage .= '* Identity Proof: Please choose document.<br>';
	}
	if($_FILES['address_proof']['error'] == 4){
		$errorMessage .= '* Address Proof: Please choose document.<br>';
	}
	if($checkidentityproofdoc['status'] == 'failure'){
		if($checkidentityproofdoc['message'] == 'Invalid_Doc'){
			$errorMessage .= '* Identity Proof: Only PDF, JPEG, & TIFF files are allowed.<br>';
		}
		if($checkidentityproofdoc['message'] == 'Invalid_Size'){
			$errorMessage .= '* Identity Proof: Max file size should be 2 Mb.<br>';
		}
	}
	if($checkaddressproofdoc['status'] == 'failure'){
		if($checkaddressproofdoc['message'] == 'Invalid_Doc'){
			$errorMessage .= '* Address Proof: Only PDF, JPEG, & TIFF files are allowed.<br>';
		}
		if($checkaddressproofdoc['message'] == 'Invalid_Size'){
			$errorMessage .= '* Address Proof: Max file size should be 2 Mb.<br>';
		}
	}
	
	if(empty($errorMessage)){
		//Upload Identity Proof
		$uploadIdentityProof = uploadImage($_FILES["identity_proof"], $requestID, 'identity_proof');
		if($uploadIdentityProof['type'] == 'identity_proof'){
			$uploadIdentityProofStatus = isset($uploadIdentityProof['status']) ? $uploadIdentityProof['status'] : '';
			$uploadIdentityProofMessage = isset($uploadIdentityProof['message']) ? $uploadIdentityProof['message'] : '';
			
			if($uploadIdentityProofStatus == 'success'){
				$doc_type = 'Identity Proof';
				$doc_name = $identity_doc_name;
				$doc_path =  $uploadIdentityProof['doc_path'];
				//Insert document in table sbi_documents
				$DataArrayLog = array("RequestID"=>$requestID, "doc_category"=>$doc_category, "doc_type"=>$doc_type, "doc_name"=>$doc_name, "doc_path"=>$doc_path, "source_code"=>$source_code, "created_date"=>$Dated);
				$identity_doc_id = Maininsertfunc('sbi_documents', $DataArrayLog);
			}
			else{
				if($uploadIdentityProofMessage = 'Some_Issue'){
					$errorMessage .= '* Identity Proof: There is some issue in uploading document.<br>';
				}
			}
		}
		
		//Upload address Proof
		$uploadAddressProof = uploadImage($_FILES["address_proof"], $requestID, 'address_proof');
		if($uploadAddressProof['type'] == 'address_proof'){
			$uploadAddressProofStatus = isset($uploadAddressProof['status']) ? $uploadAddressProof['status'] : '';
			$uploadAddressProofMessage = isset($uploadAddressProof['message']) ? $uploadAddressProof['message'] : '';
			
			if($uploadAddressProofStatus == 'success'){
				$doc_type = 'Address Proof';
				$doc_name = $address_doc_name;
				$doc_path =  $uploadAddressProof['doc_path'];
				//Insert document in table sbi_documents
				$DataArrayLog = array("RequestID"=>$requestID, "doc_category"=>$doc_category, "doc_type"=>$doc_type, "doc_name"=>$doc_name, "doc_path"=>$doc_path, "source_code"=>$source_code, "created_date"=>$Dated);
				$address_doc_id = Maininsertfunc('sbi_documents', $DataArrayLog);
			}
			else{
				if($uploadAddressProofMessage = 'Some_Issue'){
					$errorMessage .= '* Address Proof: There is some issue in uploading document.<br>';
				}
			}
		}

		if($identity_doc_id > 0 && $address_doc_id > 0){
			$successMessage = 'KYC Documents Uploaded Successfully';
			$_SESSION['kyc_message'] = $successMessage;
			if($StatusCode == 120){
				header('Location: sbi-document-page-step2.php?reqid='.$reqid.'&status='.$status);
			}else{
				header('Location: sbi-document-thanks.php?reqid='.$reqid.'&status='.$status);
			}
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
			<p class="text-center font14-medium">Your application for the Instant approval has been submitted successfully.</p>
			<p class="font14-gray pd-top-55">Share the documents for faster processing of your application</p>
		</div>
		<div>
			<form method="post" enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="sbi-document-inner">
						<div class="kyc-text">KYC DOCUMENTS</div>
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
								<div class="form-label">Identity Proof</div>
								<select id="identity_proof_options" name="identity_proof_options">
									<option value="">Select document type</option>
									<?php 
									foreach($identity_proof_documents as $value){
									?>
									<option value="<?php echo $value; ?>" <?php if($identity_doc_name == $value){ echo 'selected'; }?>><?php echo $value; ?></option>
									<?php
									}
									?>
								</select>
								<div style="color: red; margin-top: 5px; font-size: 12px;">
									<?php 
									/*
									if(!empty($uploadIdentityProofStatus == 'failure')){
										echo '* '. $uploadIdentityProofMessage;
									}
									*/
									?>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-6">
										<input id="identity_proof_value" placeholder="Choose File" disabled="disabled" class="mr-20 choose-file" />
										<div class="fileUpload upload-box">
											<span>Browse</span>
											<input id="identity_proof" name="identity_proof" type="file" class="identity_proof" />
										</div>
									</div>
									<div class="col-md-6 col-sm-6"></div>
									<div class="clearfix"></div>
									<div class="col-md-12 col-sm-6">
										<p class="gray-upload-text">Only PDF, JPEG, & TIFF files are allowed. Max file size should be 1 Mb.</p>
									</div>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-label">Address Proof</div>
								<select id="address_proof_options" name="address_proof_options">
									<option value="">Select document type</option>
									<?php 
									foreach($address_proof_documents as $value){
									?>
									<option value="<?php echo $value; ?>" <?php if($address_doc_name == $value){ echo 'selected'; }?>><?php echo $value; ?></option>
									<?php
									}
									?>
								</select>
								<div style="color: red; margin-top: 5px; font-size: 12px;">
									<?php 
									/*
									if(!empty($uploadAddressProofStatus == 'failure')){
										echo '* '. $uploadAddressProofMessage;
									}
									*/
									?>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-6">
										<input id="address_proof_value" placeholder="Choose File" disabled="disabled" class="mr-20 choose-file" />
										<div class="fileUpload upload-box">
											<span>Browse</span>
											<input id="address_proof" name="address_proof" type="file" class="address_proof" />
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-md-12">
										<p class="gray-upload-text">Only PDF, JPEG, & TIFF files are allowed. Max file size should be 1 Mb.</p>
									</div>
								</div>
							</div>
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
        <h5 class="modal-title" id="contentModalLabel">List of Acceptable KYC Documents (Ensure you SIGN on the copy before uploading)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body contentmodal-body">
        <table class="table table-responsive table-bordered doctable">
         <thead>
			<tr>
			  <th>KYC Document</th>
			  <th>Accepted As ID Proof</th>
			  <th>Accepted as Address proof</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Copy of Passport</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Copy of Voter’s ID card</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Driving License *</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Copy of PAN Card</td>
			  <td>Yes</td>
			  <td>No</td>
			</tr>
			<tr>
			  <td>UID /Adhar Card</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Letter issued by the Unique Identification Authority of India  containing details of name, address and Aadhaar number</td>
			  <td>No</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Identity card with applicant's Photograph issued by Central / State Government Departments, Statutory/Regulatory Authorities, Public Sector Undertakings, Scheduled Commercial Banks, and Public Financial Institutions</td>
			  <td>Yes</td>
			  <td>No</td>
			</tr>
			<tr>
			  <td>Letter issued by a gazetted officer, with a duly attested photograph of the person;</td>
			  <td>Yes</td>
			  <td>No</td>
			</tr>
			<tr>
			  <td>Overseas Citizen of India Card issued by Government along with the passport to NRIs and PIOs</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Electricity bill, Telephone bill, Postpaid mobile phone bill, Piped gas bill, Water bill</td>
			  <td>No</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Property or Municipal Tax receipt</td>
			  <td>No</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Bank account or Post Office savings bank account statement</td>
			  <td>No</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Letter of allotment of accommodation from employer issued by State or Central Government departments, statutory or regulatory bodies, public sector undertakings, scheduled commercial banks, financial institutions and listed companies. Similarly, leave and license agreements with such employers allotting official accommodation</td>
			  <td>No</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Pension or family pension payment orders (PPOs) issued to retired employees by Government Departments or Public Sector Undertakings, if they contain the address</td>
			  <td>No</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td colspan="3" class="single-colmn">KYC for Defense Personnel</td>
			</tr>
			<tr>
			  <td>Serving certificate with a photo. Issue date should be within 60 days from date of processing.</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
			<tr>
			  <td>Employer ID card having address details and photo.</td>
			  <td>Yes</td>
			  <td>Yes</td>
			</tr>
		<!--	<tr>
			  <td colspan="3" class="single-colmn">KYC for Employees of SBI and Banking Partners</td>
			</tr>
			<tr>
			<td>Employer ID card having address details and photo.</td>
			<td>Yes</td>
			<td>Yes</td>
			</tr>-->
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

    $("#identity_proof_options").selectBoxIt({
		theme: "default",
	});

	$("#address_proof_options").selectBoxIt({
		theme: "default",
	});

	$(".identity_proof").change (function() {
		$("#identity_proof_value").val($(this).val());
	});

	$(".address_proof").change (function() {
		$("#address_proof_value").val($(this).val());
	});

	$('#identity_proof_options').on('change', function(){
		var optionVal = $(this).val();
		if(optionVal != ''){
			$('#address_proof_options option[value="'+optionVal+'"]').remove();
		}
	});

	$('#address_proof_options').on('change', function(){
		var optionVal = $(this).val();
		if(optionVal != ''){
			$('#identity_proof_options option[value="'+optionVal+'"]').remove();
		}
	});

	$('ul#address_proof_optionsSelectBoxItOptions').on('click', function(){
		var selected_address_proof = $('ul#address_proof_optionsSelectBoxItOptions').find('li.selectboxit-focus').text();
		if(selected_address_proof != ''){
			$('ul#identity_proof_optionsSelectBoxItOptions').find('li:contains('+selected_address_proof+')').remove();
		}
	});

	$('ul#identity_proof_optionsSelectBoxItOptions').on('click', function(){
		var selected_identity_proof = $('ul#identity_proof_optionsSelectBoxItOptions').find('li.selectboxit-focus').text();
		if(selected_identity_proof != ''){
			$('ul#address_proof_optionsSelectBoxItOptions').find('li:contains('+selected_identity_proof+')').remove();
		}
	});

});
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
