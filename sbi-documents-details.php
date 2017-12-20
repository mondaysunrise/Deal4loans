<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$RequestID = $_REQUEST["reqid"];
$BidderID = $_REQUEST["biddt"];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$baseurl = $protocol . $_SERVER['HTTP_HOST'];

$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && !empty($_REQUEST['BidderIDstatic']))
{
	 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
}
else
{
	$BidderIDstatic=$_SESSION['BidderID'];
}

if($BidderID != $_SESSION['BidderID']){
	$strDir = dir_name();
	$redirectUrl = "http://".$_SERVER['HTTP_HOST'].$strDir."sbidocumentlogin.php";
	header("Refresh:2; url=".$redirectUrl);
	echo 'Please login with valid credentials.';
	session_destroy();
	exit;
}

//Get User Info
$getUserInfoSql = "SELECT rcc.Name, rcc.Mobile_Number, rcc.City, rcc.Employment_Status, scc.LeadRefNumber FROM Req_Credit_Card as rcc JOIN sbi_credit_card_5633 as scc ON(scc.RequestID = rcc.RequestID) WHERE rcc.RequestID = '".$RequestID."'";
$getUserInfoResult=d4l_ExecQuery($getUserInfoSql);
$getUserInfo = d4l_mysql_fetch_assoc($getUserInfoResult);
$Name = $getUserInfo['Name'];
$Mobile_Number = $getUserInfo['Mobile_Number'];
$City = $getUserInfo['City'];
$Employment_Status = $getUserInfo['Employment_Status'];
$LeadRefNumber = $getUserInfo['LeadRefNumber'];

//Get Docs Info
$getDocsSql = "SELECT * FROM sbi_documents WHERE RequestID = '".$RequestID."' ORDER BY created_date DESC";
$getDocsResult=d4l_ExecQuery($getDocsSql);
while($getDocsResponse = d4l_mysql_fetch_assoc($getDocsResult))
{
	$getDocs[] = $getDocsResponse;
}

//echo '<pre>';print_r($getDocs);
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
				<table class="table table-striped table-bordered">
					<tr>
						<th width="50%">Name</th>
						<td width="50%"><?php echo $Name; ?></td>
					</tr>
					<tr>
						<th>Mobile</th>
						<td><?php echo ccMasking($Mobile_Number); ?></td>
					</tr>
					<tr>
						<th>City</th>
						<td><?php echo $City; ?></td>
					</tr>
					<tr>
						<th>Occupation</th>
						<td><?php if($Employment_Status==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
					</tr>
					<tr>
						<th>Lead Reference Number</th>
						<td><?php echo $LeadRefNumber; ?></td>
					</tr>
				</table>
			</div>
			<div class="col-md-12">
				<div class="highlight-box">
					<table class="table-bordered table">
						<tr>
							<th width="5%">S.No.</th>
							<th width="15%">Category</th>
							<th width="25%">Type</th>
							<th width="45%">Name</th>
							<th width="15%">Download</th>
						</tr>
						<?php
						$i=1;
						foreach($getDocs as $docs){
						?>
						<tr>
							<td width="5%"><?php echo $i; ?></td>
							<td width="15%"><?php echo $docs['doc_category']; ?></td>
							<td width="25%"><?php echo $docs['doc_type']; ?></td>
							<td width="45%" style="max-width: 250px; word-wrap: break-word;"><?php echo $docs['doc_name']; ?></td>
							<td width="15%"><a href="<?php echo $baseurl.'/sbi_docs/'.$docs['doc_path']; ?>" download class="btn btn-primary">Download</a></td>
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
<?php
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

?>
