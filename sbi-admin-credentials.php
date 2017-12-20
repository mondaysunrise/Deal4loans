<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && !empty($_REQUEST['BidderIDstatic']))
{
	 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
}
else
{
	$BidderIDstatic=$_SESSION['BidderID'];
}

$checkSuperAdminSql = "SELECT * FROM `Bidders` WHERE BidderID = '".$BidderIDstatic."' AND leadidentifier = 'sbidocslms' AND Selection_Category = 2";
$checkSuperAdminResult = d4l_ExecQuery($checkSuperAdminSql);
$checkSuperAdminRows = d4l_mysql_num_rows($checkSuperAdminResult);

if(!$checkSuperAdminRows){
	echo 'You are not authorised to view this page.';
	exit;
}

if($_POST['method'] == 'ChangePassword'){
	//echo '<pre>';print_r($_POST);exit;

	$bidderid = $_POST['bidderid'];
	$old_password = $_POST['oldpass'];
	$new_password = $_POST['newpass'];
	
	$checkOldPassSql = "SELECT * FROM `Bidders` WHERE BidderID = '".$bidderid."' AND PWD = '".$old_password."'";
	$checkOldPassResult = d4l_ExecQuery($checkOldPassSql);
	$checkOldPassRows = d4l_mysql_num_rows($checkOldPassResult);
	if($checkOldPassRows > 0){
		$updateNewPassSql = "Update Bidders SET PWD = '".$new_password."' WHERE BidderID = '".$bidderid."'";
		$updateNewPassResult = d4l_ExecQuery($updateNewPassSql);
		$response['message'] = 'Password changed successfully';
		$response['errorcode'] = 0;
	}
	else{
		$response['message'] = 'Incorrect Old Password';
		$response['errorcode'] = 1;
	}

	echo json_encode($response);
	exit;
	
	
}



//Get User Info
$getBiddersInfoArr = array();
$getBiddersInfoSql = "SELECT * FROM `Bidders` WHERE leadidentifier = 'sbidocslms' AND Selection_Category != 2 ORDER BY `BidderID` ASC";
$getBiddersInfoResult = d4l_ExecQuery($getBiddersInfoSql);
while($getBiddersInfoResponse = d4l_mysql_fetch_assoc($getBiddersInfoResult)){
	$getBiddersInfoArr[] = $getBiddersInfoResponse;
}

?>
<html>
<head>
<meta charset="utf-8">
<title>SBI Documents</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="css/sbi-document-styles.css" type="text/css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style type="text/css">
.mr-tp-btm-5{ margin-top:0.5rem; margin-bottom:0.5rem;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="d4l">
	<section class="sbi-document-lms no-pd-btm">
		<div class="container container-lms">
			<div class="col-md-12">
				<div class="highlight-box">
					<table class="table-bordered table">
						<tr>
							<th width="5%">S.No.</th>
							<th width="20%">Email</th>
							<th width="20%">Password</th>
							<th width="10%">Source Code</th>
							<th width="40%">Change Password</th>
						</tr>
						<?php
						$i=1;
						foreach($getBiddersInfoArr as $bidderinfo){
						?>
						<tr>
							<td width="5%"><?php echo $i; ?></td>
							<td width="20%"><?php echo $bidderinfo['Email']; ?></td>
							<td width="20%"><?php echo $bidderinfo['PWD']; ?></td>
							<td width="10%"><?php echo $bidderinfo['Profile']; ?></td>
							<td width="40%" style="text-align:center;"><a href="#ChangePasswordModal" class="password" data-toggle="modal" data-id="<?php echo $bidderinfo['BidderID']; ?>">Edit</a></td>
						</tr>
						<?php
							$i++;
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="ChangePasswordModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="bidderid" value="" />
					<div id="errorMessage" style="color: red; margin-bottom: 15px; text-align: center;"></div>
					<div id="successMessage" style="color: green; margin-bottom: 15px; text-align: center; display:none;"></div>
					<table>
						<tr>
							<th width="20%">Old Password</th>
							<td width="20%"><input type="password" name="old_password" id="old_password" class="form-control mr-tp-btm-5"></td>
						</tr>
						<tr>
							<th width="20%">New Password</th>
							<td width="20%"><input type="password" name="new_password" id="new_password" class="form-control mr-tp-btm-5"></td>
						</tr>
						<tr>
							<th width="20%">Confirm Password</th>
							<td width="20%"><input type="password" name="confirm_password" id="confirm_password" class="form-control mr-tp-btm-5"></td>
						</tr>
						<tr>
							<th width="20%"></th>
							<td width="20%"><button name="btnpassword" id="btnpassword" class="btn btn-primary">Submit</button></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
<script type="text/javascript">
$(document).ready(function() {
	
	$('.password').on('click', function(){
		var bidderid = $(this).data('id');
		$('.modal-body #bidderid').val(bidderid);
		
		//Reset Modal Items
		$('#errorMessage').text('');
		$('#successMessage').text('');
		$('#old_password').val('');
		$('#new_password').val('');
		$('#confirm_password').val('');
	});
	
	$('#btnpassword').on('click', function(){
		var oldpass = $('#old_password').val();
		var newpass = $('#new_password').val();
		var confirmpass = $('#confirm_password').val();
		var bidderid = $('#bidderid').val();
		
		if(oldpass == ''){
			$('#errorMessage').text('Enter Old Password');
		}
		else if(newpass == ''){
			$('#errorMessage').text('Enter New Password');
		}
		else if(confirmpass == ''){
			$('#errorMessage').text('Enter Confirm Password');
		}
		else if(confirmpass != newpass){
			$('#errorMessage').text('Password do not match');
		}
		else{
			$.ajax({
				type: 'POST',
				data: {
					method: 'ChangePassword',
					bidderid: bidderid,
					oldpass: oldpass,
					newpass: newpass
				},
				success: function (res) {
					//console.log(res);
					var response = JSON.parse(res);
					if(response.errorcode == 1){
						$('#errorMessage').text(response.message);
					}
					else{
						$('#errorMessage').hide();
						$('#successMessage').show();
						$('#successMessage').text(response.message);

						window.setTimeout(function(){
							window.location.reload();
						}, 1500);
					}
				}
			});
		}
	});
});


</script>
</body>
</html>
