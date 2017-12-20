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

if($BidderIDstatic != '7362'){
	echo 'You are not authorised to view this page.';
	exit;
}

//Get User Info
$getBiddersInfoArr = array();
$getBiddersInfoSql = "SELECT * FROM `Bidders` WHERE leadidentifier = 'sbidocslms' AND BidderID NOT IN ('7362') ORDER BY `BidderID` ASC";
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
</head>
<body class="d4l">
	<section class="sbi-document-lms no-pd-btm">
		<div class="container container-lms">
			<div class="col-md-12">
				<div class="highlight-box">
					<table class="table-bordered table">
						<tr>
							<th width="5%">S.No.</th>
							<!--<th width="15%">BidderID</th>-->
							<th width="25%">Email</th>
							<th width="45%">Password</th>
							<th width="15%">Source Code</th>
						</tr>
						<?php
						$i=1;
						foreach($getBiddersInfoArr as $bidderinfo){
						?>
						<tr>
							<td width="5%"><?php echo $i; ?></td>
							<!--<td width="15%"><?php echo $bidderinfo['BidderID']; ?></td>-->
							<td width="25%"><?php echo $bidderinfo['Email']; ?></td>
							<td width="45%"><?php echo $bidderinfo['PWD']; ?></td>
							<td width="15%"><?php echo $bidderinfo['Profile']; ?></td>
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
</body>
</html>
