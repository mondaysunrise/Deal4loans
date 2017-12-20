<?php
require 'scripts/db_init.php';
//print_r($_REQUEST);
//echo "<br><br><br>";
$json=$_REQUEST["json-post-response"];
$referencenumber=$_REQUEST["requestReferenceNumber"];
list($keyword,$reqno) = split('[_]',$referencenumber);
//echo $keyword."-".$reqno;
$obj = json_decode($json);
//print_r($obj);
echo "<br><br>";
//print_r($obj[0]);
$streligible="";
$jsonnw = $obj[0];
$data=$jsonnw->Eligibility->TenorWise;
$streligible.='<table border=1 cellpadding="5" cellpadding="0" width="600">';
$streligible.="<tr><td>Tenor</td><td>EMI</td><td>Loan Amount</td></tr>";
$EMI72 = $data->{"Tenor 72"}->EMI;
if($EMI72>0)
{	$streligible.="<tr>";
	$streligible.="<td>Tenor 72</td>";
	$streligible.="<td>".$EMI72."</td>";
	$MaxEligibilty72= $data->{"Tenor 72"}->{"Max Eligibilty"}; 
	$streligible.= "<td>Rs. ".round($MaxEligibilty72)."</td>";
	$streligible.="</tr>";
}
$EMI60 = $data->{"Tenor 60"}->EMI;
if($EMI60>0)
{	$streligible.="<tr>";
	$streligible.="<td>Tenor 60</td>";
	$streligible.="<td>".$EMI60."</td>";
	$MaxEligibilty60= $data->{"Tenor 60"}->{"Max Eligibilty"};
	$streligible.= "<td>Rs. ".round($MaxEligibilty60)."</td>";
	$streligible.="</tr>";
}
$EMI48 = $data->{"Tenor 48"}->EMI;
if($EMI48>0)
{	$streligible.="<tr>";
	$streligible.="<td>Tenor 48</td>";
	$streligible.="<td>".$EMI48."</td>";
	$MaxEligibilty48= $data->{"Tenor 48"}->{"Max Eligibilty"};
	$streligible.= "<td>Rs. ".round($MaxEligibilty48)."</td>";
	$streligible.="</tr>";
}
$EMI36 = $data->{"Tenor 36"}->EMI;
if($EMI36>0)
{	$streligible.="<tr>";
	$streligible.="<td>Tenor 36</td>";
	$streligible.="<td>".$EMI36."</td>";
	$MaxEligibilty36= $data->{"Tenor 36"}->{"Max Eligibilty"};
	$streligible.= "<td>Rs. ".round($MaxEligibilty36)."</td>";
	$streligible.="</tr>";
}
$EMI24 = $data->{"Tenor 24"}->EMI;
if($EMI24>0)
{	$streligible.="<tr>";
	$streligible.="<td>Tenor 24</td>";
	$streligible.="<td>".$EMI24."</td>";
	$MaxEligibilty24= $data->{"Tenor 24"}->{"Max Eligibilty"};
	$streligible.= "<td>Rs. ".round($MaxEligibilty24)."</td>";
	$streligible.="</tr>";
}
$EMI12 = $data->{"Tenor 12"}->EMI;
if($EMI12>0)
{	$streligible.="<tr>";
	$streligible.="<td>Tenor 12</td>";
	$streligible.="<td>".$EMI12."</td>";
	$MaxEligibilty12= $data->{"Tenor 12"}->{"Max Eligibilty"};
	$streligible.= "<td>Rs. ".round($MaxEligibilty12)."</td>";
	$streligible.="</tr>";
}
$streligible.="</table>";
$Referenceno=$jsonnw->{"Reference No"};
//echo "<br><br>";
$MCPCheck=$jsonnw->MCP->{"MCP Check"};
$ERefferelResponceType=$jsonnw->ERefferelResponceType;


//[2/4/16, 11:10 AM] upendra kumar (upendraparallel@gmail.com): $insertSql = "INSERT INTO `articles` (`checkjson`) VALUES ('".$json."')";


//if($reqno>0 && strlen($Referenceno)>1)
if($reqno>0)
{	
  $bflqryf="Update bajaj_cibildetails set bajaj_json='".$json."',bajajf_eligibility='".$streligible."',Referenceno='".$Referenceno."',MCPCheck='".$MCPCheck."' Where bajajcibilid=".$reqno;
$bjresult = ExecQuery($bflqryf);

//echo $bflqryf;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Personal Loans Bank - List of Providers in India</title>
<meta name="keywords" content="personal loan banks, banks of personal loan, personal loan banks India, providers of personal loan">
<meta name="description" content="Personal Loan Banks: Here you can find which are the banks who provides personal loans in India.">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div style="margin:auto; height:15px;">
<div style="clear:both; height:30px;"></div>
<table align="center" cellpadding="6" cellspacing="0" width="650" >
<tr><td colspan="2" align="center" >Your details has been forwarded to Bajaj finserv, they will soon contact you.</td></tr>
</td></tr>
</table>
<div style="clear:both;"></div>
<?php if($EMI12>0 && $MCPCheck=="Pass")
{ echo $streligible."<br><br>"; }?>
</div>
</div>
<div style="clear:both; height:300px;"></div>
<div style="font-size:12px;">* The Approval/Rejection of loan is at the sole discretion of Bajaj Finance Ltd (hereinafter referred to as 'Bajaj Finserv Lending') .This scheme is applicable only to citizen of India.</div>
<div style="clear:both; height:100px;"></div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
