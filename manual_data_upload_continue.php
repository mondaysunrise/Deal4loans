<?php
ini_set('max_execution_time', 500);
//error_reporting(E_ALL);
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);
//for session variables
foreach ($_SESSION as $key=>$val)
 $sessionVar.= $key." ".$val."\n";

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

$logfilecontent="";
$logfilecontent.="********************************************************\n";
$logfilecontent.= "Datetime: ".ExactServerdate()."\n";
$logfilecontent.="IP Address: ".$IP."\n";
$logfilecontent.= "Session Variable: ".$sessionVar."\n";
$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
{
	 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
}
else
{
	$BidderIDstatic=$_SESSION['BidderID'];
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
/*function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")*/
</script>
<?php 
	 
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";

?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}
.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}
.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

.successfully-txt{ font-family:Verdana, Geneva, sans-serif; font-size:12px;}
.upoadtext{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#06C; font-weight:bold; padding-bottom:10px;}
.sucess{ color:#093;}
.negative{ color: #F00;}
</style>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
	<tr><td align="right" style="padding-right:10px;">
			<a href="manual_leads_user_view.php" style="color:#FFFFFF;"><b>View User</b></a> &nbsp;&nbsp;<a  href="manual_leads_user_add.php" style="color:#FFFFFF;"><b>Add User</b></a> &nbsp;&nbsp;	<a  href="manual_data_upload.php" style="color:#FFFFFF;"><b>Upload Data</b></a> &nbsp;&nbsp;
	</td></tr>
 <tr><td align="center"> 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle">&nbsp;</td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">

   <tr><td colspan="3">&nbsp;</td></tr>
   <tr>
   <td colspan="3" align="center">
 <table  width="90%" cellpadding="0" cellspacing="0">
   <tr>
     <td valign="middle" colspan="3" class="upoadtext" align="right"> <a href="manual_data_upload.php">Back</a> </td>
       </tr>
   <tr>
     <td valign="middle" colspan="3" class="upoadtext" align="center">  Upload data Status </td>
       </tr>
   <tr>
     <td valign="middle" colspan="3" class="style1" align="center"><p>
     <?php
  
		if ($_SERVER['REQUEST_METHOD']=='POST')
		{
			$source = $_REQUEST['source'];
			$userfile= $_REQUEST['userfile'];	
			
			$getFieldsSql = "select standard_fields, custom_fields, product from manual_user_details where source = '".$source."'";
			$getFieldsQuery = d4l_ExecQuery($getFieldsSql);
			$standard_fields = d4l_mysql_result($getFieldsQuery,0,'standard_fields');
			$custom_fields = d4l_mysql_result($getFieldsQuery,0,'custom_fields');
			$product = d4l_mysql_result($getFieldsQuery,0,'product');
			if(strlen($custom_fields)>3)
			{
				$totalFields = $standard_fields.",".$custom_fields;
			}
			else
			{
				$totalFields = $standard_fields;
			}
			$explodetotalFields = explode(',', $totalFields);
			$countTotalFields = count($explodetotalFields);
			$countminus1 = $countTotalFields - 1;
			$IP_Address = $_SERVER["REMOTE_ADDR"];
		}
 
 	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number!='9811215138' and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
   	
        
	?>
	    <table align="center" width="100%" cellpadding="5" cellspacing="0" border="1" style="border:thin #CCC solid; border-collapse:collapse;"> 
        
		<?php
		if ($_FILES[userfile][size] > 0) { 
			//get the csv file 
			$file = $_FILES[userfile][tmp_name]; 
			$handle = fopen($file,"r"); 
			$insertSql = "INSERT INTO ".$product." (Employment_Status, source, IP_Address, Dated,Updated_Date, ".$totalFields.") VALUES ";
			$countUploadLeads = 0;
			while ($data = fgetcsv($handle,5000,",","'")) 
			{ 	
				$numRows = '';
				if(strlen($data[1])>0)
				{
					$getLeadCheckSql = "select RequestID,source From ".$product." Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9555060388,9311773341) and Mobile_Number='".$data[1]."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
					$getLeadCheckQuery = d4l_ExecQuery($getLeadCheckSql);
					$row = d4l_mysql_num_rows($getLeadCheckQuery);
					$numRows = d4l_mysql_num_rows($getLeadCheckQuery);
				}
				if($data[1]==0 || $data[0]=='Name')
				{
					$numRows=1;
				}
				if($source=="sms_bl_leads" && $row["source"]!='sms_bl_leads')
					{
						$numRows=0;
					}
				
				if($numRows==0)
				{			
					if($source=="sms_bl_leads")
					{
						$insertSql .= " ('0', '".$source."','".$IP_Address."', Now(), Now(), ";
					}
					else 
					{
						$insertSql .= " ('1', '".$source."','".$IP_Address."', Now(), Now(), ";
					}
					
					for($i=0;$i<$countTotalFields;$i++)
					{
						$insertSql .= "'".$data[$i]."'";
						if($i!=$countminus1)
						{ $insertSql .= ", "; }
					}
					$insertSql .= " ), ";
					$countUploadLeads = $countUploadLeads + 1;
				}
			}   
			$insertSql = trim($insertSql);
			$insertSql = rtrim($insertSql, ",");	
			d4l_ExecQuery($insertSql);						 
			//echo $insertSql;			
		}
        ?>    
        <tr><td><?php echo $countUploadLeads." leads uploaded"; ?></td></tr>
    </table>
     
     </p></td>
       </tr>

   <tr>
     <td width="100%" valign="middle" class="style1" colspan="3">
     
     
     
     
     
     
     </td>
	   </tr>
	   </table>
	   </td></tr>
   <tr>
      <td colspan="3">&nbsp;</td></tr>   
  
 
 </table></td>
   </tr>
   <tr>
     <td width="650" height="8" align="center" valign="top" ><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" >&nbsp;</td>
   </tr>
 </table>
	<?php
	$search_date="";

if(ENABLELOGIN==1)
{
	$newFileName = './logfile/'.$pagename.".txt";
	file_put_contents($newFileName,$logfilecontent, FILE_APPEND);
}
		//end of logfile entry
	function timeDiff($firstTime,$lastTime)
{
$firstTime=strtotime($firstTime);
$lastTime=strtotime($lastTime);
$timeDiff = ($lastTime-$firstTime)/86400;
return $timeDiff;
}
 ?>
 </td></tr></table>
</td></tr></table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
