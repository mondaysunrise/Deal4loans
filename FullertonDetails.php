<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$min_date=date('Y-m-d')." 00:00:00";
$max_date=date('Y-m-d')." 23:59:59";
//$min_date="2010-03-09 00:00:00";
//$max_date="2010-03-09 23:59:59";

function getReqValue1($pKey){
	$titles = array(
        'Delhi' => '999,1000,1001,1002,1003,1004,1005,1006',
		'Pune' => '996,997,998',
		'Mumbai' => '1015,1017,1018,1019,1020,1021,1022',
		'Hyderabad' => '1012,1010,1011,1013,1014',
		'Kolkata' => '1025,1026,1027,1028',
		'Ahmedabad' => '1029,1030,1031,1032',
		'Bangalore' => '1050,1051,1052',
			'Panipat' => '1089',
			'Sonepat' => '1090',
			'Bahadurgarh' =>	'1091',
			'Kurukshetra'	=> '1092',
			'Hissar'	=> '1093',
			'Shimla'	=> '1095',
			'Chandigarh'	=> '1096',
			'Mandi' => '1097',
			'Patiala' => '1098',
			'Yamunanagar' => '1099',
			'Jalandhar' => '1100',
			'Bathinda' => '1102',
			'Jammu' =>'1103',
			'Pathankot' => '1104',
			'Ropar' =>'1105',
			'Baddi' => '1106',
			'Amritsar' => '1107',
		'Mohali' => '1108',
		'Chennai' => '1037,1038,1039,1040,1041,1042,1043,1044',
		'Kanpur' => '1162',
		'Ludhiana' => '1163',
		'Rishikesh' => '1164',	
		'Haridwar' => '1165',
		'Jhansi' => '1166',
		'Lucknow' => '1167',
		'Meerut' => '1168',
		'Baroda' => '1221',
		'Jaipur' => '1125',
		'Indore' => '1204',
		'Surat' => '1215',
		'Rajkot' => '1222',
		'Bhopal' => '1223',
		'Agra' => '1226',
		'Goa' => '1287',
		'Gwalior' => '1292',
		'Jabalpur' => '1293',
		'Nasik' => '1295',
		'Kurukshetra' => '1092',
		'Raipur' => '1294',
		'Nagpur' => '1284',
			'Trivendrum	' => '1338',
'Cochin' => '1339',
'Thrissur' => '1340',
'Calicut' => '1341',
'Madurai' => '1342',
'Coimbatore' => '1343',
'Tirunelveli' => '1344',
'Nagerkoil' => '1345',
'Tuticorin' => '1346',
'Erode' => '1347',
'Ooty' => '1348',
'Vellore' => '1349',
'Salem' => '1350',
'Trichy' => '1351',
'Pondicherry' => '1352',
'Thanjavur' => '1353',
'Dindigul' => '1354',
'Karur' => '1355',
'Kumbakonam' => '1356',
'Pudukottai' => '1357',
'Karaikkal' => '1358',
'Guntur' => '1359',
'Ongole' => '1360',
'Nellore' => '1361',
'Tirupathi' => '1362',
'Khammam' => '1363',
'Eluru' => '1364',
'Vijaywada' => '1365',
'Rajahmundry' => '1366',
'Srikakulam' => '1367',
'Vizianagaram' => '1368',
'Kakinada' => '1369',
'Bhimavaram' => '1370',
'Warangal' => '1371',
'Kurnool' => '1372',
'Nizamabad' => '1373',
'Karimnagar' => '1374',
'Ananthpur' => '1375',
'Ramagundam' => '1376'


);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }

$fullertoncity = array('Delhi','Pune','Mumbai','Hyderabad','Kolkata','Ahmedabad','Bangalore','Panipat','Sonepat','Bahadurgarh','Kurukshetra','Hissar','Shimla','Chandigarh','Mandi','Patiala',			'Yamunanagar','Jalandhar','Bathinda','Jammu','Pathankot','Ropar','Baddi','Amritsar','Mohali','Kanpur','Ludhiana','Rishikesh','Haridwar','Jhansi','Lucknow','Meerut','Baroda','Jaipur','Indore','Surat','Rajkot','Bhopal','Agra','Goa','Gwalior','Jabalpur','Nasik','Kurukshetra','Raipur','Nagpur','Trivendrum','Cochin','Thrissur','Calicut','Madurai','Coimbatore','Tirunelveli','Nagerkoil','Tuticorin','Erode','Ooty','Vellore','Salem','Trichy','Pondicherry','Thanjavur','Dindigul','Karur','Kumbakonam','Pudukottai','Karaikkal','Guntur','Ongole','Nellore','Tirupathi','Khammam','Eluru','Vijaywada','Rajahmundry','Srikakulam','Vizianagaram','Kakinada','Bhimavaram','Warangal','Kurnool','Nizamabad','Karimnagar','Ananthpur','Ramagundam','Chennai');
$content="<table cellpadding='0' cellspacing='0'><tr><td>";
for($i=0;$i<count($fullertoncity);$i++)
{
	$getitsbranches=getReqValue1($fullertoncity[$i]);

	$qry="SELECT count(RequestID) as count,BidderID FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$getitsbranches.")  and Req_Feedback_Bidder1.Reply_Type=1 and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) group by BidderID with ROLLUP";
	$result=ExecQuery($qry);
	//echo $qry."<br>";
	$recordcount = mysql_num_rows($result);
	$content.="<table width='720' cellspacing='0' cellpadding='0' border='1'>
				<tr>
					<td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; background-color: #FCAA00; color:#FFFFFF;' >Count of leads for ".$fullertoncity[$i]."</td>
				</tr>
				<tr>
					<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' >&nbsp;&nbsp;Branches</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' align='center'>Count</td>
				</tr>";
	while($row = mysql_fetch_array($result))
	{
		$getname=ExecQuery("select Bidder_Name from Bidders_List Where BidderID=".$row['BidderID']."");
		$getbname = mysql_fetch_array($getname);
		$content.="<tr ><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; '>&nbsp;&nbsp;".$getbname['Bidder_Name']."</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; padding-left:4px;' align='center'>&nbsp;&nbsp;".$row['count']."</td></tr>";
	}
//$content.="<tr><td>Total</td><td></td></tr>";
	$content.="<tr><td colspan='2'>&nbsp;</td></tr>";
	$content.="</table>";
	

}
$content.="</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>";
echo $content;
$email="balbirsingh499@gmail.com,h.shuaib@gmail.com,gosainkavi81@gmail.com";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
//$headers .= "Cc: ranjana5chauhan@gmail.com"."\n";
if(($recordcount)>0)
{
	//$email="ranjana5chauhan@gmail.com";
mail($email,'MIS Report From Deal4loans', $content, $headers);
}
//mail("ranjana5chauhan@gmail.com",'MIS Report From Deal4loans', $content, $headers);

?>