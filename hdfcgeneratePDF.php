<table cellpadding="0" cellspacing="0" width="275" >
<tr><td width="183" align="center" style="font-size:15px; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif;"><p>Download the Application Form</p>
  <p>&nbsp;</p></td>
</tr>
<tr><td>
<?php

error_reporting(0);
ini_set('max_execution_time', 1600);
require 'scripts/db_init.php';
//require 'scripts/functions.php';

function create_zip($files = array(),$destination = '',$overwrite = false) {
 if(file_exists($destination) && !$overwrite) { return false; }

 $valid_files = array();

 if(is_array($files)) {

 foreach($files as $file) {

 if(file_exists($file)) {
 $valid_files[] = $file;
 }
 }
 }

 if(count($valid_files)) {

 $zip = new ZipArchive();
 if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
 return false;
 }
 //add the files
 foreach($valid_files as $file) {
 $zip->addFile($file,$file);
 }

 //close the zip
 $zip->close();

 //check to make sure the file exists
 
 return file_exists($destination);
 }
 else
 {
 return false;
 }
}

function getSingleWords($str)
{
    $length = strlen($str);
    $f = "";
    for($i=0;$i<$length;$i++)
    {
        $val = $i;
        $rest = substr($str, $val, 1);
		$f[] = strtoupper($rest);
    }
    $implo = implode(",",$f);
    return $f;//Returns Array
}

function appendZero($number,$fill=2)
{
	return str_pad($number, $fill, '0', STR_PAD_LEFT);
}

$ProductValue=$_REQUEST['vid'];
//$ProductValue='444';
//echo "select * from hdfc_car_loan_leads Where (RequestID='".$ProductValue."')";
$getValuesSql = "select * from hdfc_car_loan_leads Where (car_loan_ReqId='".$ProductValue."')";
list($numRowsRange,$getValuesQuery)=MainselectfuncNew($getValuesSql,$array = array());

$Name = $getValuesQuery[0]['Name'];
//$display_name = getSingleWords($Name);
$NameArr = explode(" ",$Name);
$FnameFrPDF = $NameArr[0];


$Gender = $getValuesQuery[0]['gender'];
if($Gender=='Male')
	{
		$GenderVal = "M";	
	}
if($Gender=='Female')
	{
		$GenderVal = "F";	
	}
$Pin = $getValuesQuery[0]['Residence_Pincode'];
$pinCodeVal = getSingleWords($Pin);


if(count($NameArr)==2)
{
	$fName = getSingleWords($NameArr[0]);
	$lName = getSingleWords($NameArr[1]);
	//$count1 = 40 - count($lName);
	$fullName = $fName. " ".$lName;
	$count1 = strlen($fullName);
	
	$finalNameArr = '';
	for($z=0;$z<$count1;$z++)
	{
		if(strlen($fName[$z])>0)
		{
			$finalNameArr[] = 	$fName[$z];
		}
		else
		{
			$finalNameArr[] = 	'';
		}
	}
	$display_name = array_merge($finalNameArr, $lName);
	
	//print_r($display_name);
}
else if(count($NameArr)==2)
{
	$fName = getSingleWords($NameArr[0]);
	$mName = getSingleWords($NameArr[1]);
	$lName = getSingleWords($NameArr[2]);
	$fNameArr = '';
	$mNameArr = '';
	$lNameArr = '';
	for($z=0;$z<12;$z++)
	{
		if(strlen($fName[$z])>0)
		{
			$fNameArr[] = 	$fName[$z];
		}
		else
		{
			$fNameArr[] = 	'';
		}
	}
	
	for($z=0;$z<11;$z++)
	{
		if(strlen($mName[$z])>0)
		{
			$mNameArr[] = 	$mName[$z];
		}
		else
		{
			$mNameArr[] = 	'';
		}
	}
	
	for($z=0;$z<12;$z++)
	{
		if(strlen($lName[$z])>0)
		{
			$lNameArr[] = 	$lName[$z];
		}
		else
		{
			$lNameArr[] = 	'';
		}
	}
		
	$mergeName_1 = array_merge($fNameArr,$mNameArr);
	$display_name = array_merge($mergeName_1,$lNameArr);
	
	
}
else
{
	$display_name = getSingleWords($Name);

}

$dob = $getValuesQuery[0]['DOB'];
$dob_exp = explode("-",$dob);
$display_dob_year = getSingleWords($dob_exp[0]);
$display_dob_month = getSingleWords($dob_exp[1]);
$display_dob_day = getSingleWords($dob_exp[2]);
$display_dob = array_merge($display_dob_day, $display_dob_month,$display_dob_year);

//$Residential_Status = $getValuesQuery[0]['Residential_Status'];
$Residence_Address = $getValuesQuery[0]['Residence_Address'];
$display_Residence_Address = getSingleWords($Residence_Address);

$Mobile_Number = $getValuesQuery[0]['Mobile_Number'];
$display_mobile = getSingleWords($Mobile_Number);

$Email = $getValuesQuery[0]['Email'];
$display_email = getSingleWords($Email);

$Pancard = $getValuesQuery[0]['Pancard'];
$display_pancard = getSingleWords($Pancard);
//echo "Pancard - ".$Pancard;
$Company_Name = $getValuesQuery[0]['Company_Name'];
$display_c_name = getSingleWords($Company_Name);

//$Company_Type = $getValuesQuery[0]['Company_Type');

$Net_Salary = $getValuesQuery[0]['Net_Salary'];
$display_annual_income = getSingleWords($Net_Salary);

$City = $getValuesQuery[0]['City'];
$display_city = getSingleWords($City);

$ResState = $getValuesQuery[0]['resi_state'];
$Resi_State = getSingleWords($ResState);

$ResTel = $getValuesQuery[0]['Resi_Telephone'];
$ResiTelephone = getSingleWords($ResTel);

$CompEmpAdd =  $getValuesQuery[0]['Off_Address'];
$CompanyEmpAddress = getSingleWords($CompEmpAdd);
$off_city =  $getValuesQuery[0]['off_city'];
$OffCity = getSingleWords($off_city);

$off_state =  $getValuesQuery[0]['off_state'];
$OffState = getSingleWords($off_state);

$off_pincode =  $getValuesQuery[0]['off_pincode'];
$OffPinCode = getSingleWords($off_pincode);

//$Employment_Status = $getValuesQuery[0]['Employment_Status'];

$rand = rand(10, 99);
$AppID = "HDFCForm".$rand."_".$FnameFrPDF;


$msg = "<body style='margin:0px; padding:0px; font-family:Arial; font-size:12px; color:#333; line-height:18px;'><table width='730'  border='0' style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'>";
$msg .= "<tr>  <td width='730' align='left' valign='middle'>";

//Page 1 Start
include "hdfcPDFpg1.php";
//Page 1 End

$msg .="</td></tr>";
//$msg .= "<tr>  <td width='730' align='left' valign='middle'>";
//Page2 Start
include "hdfcPDFpg2.php";
//Page 2 End
//$msg .="</td></tr>";
//$msg .="<tr><td width='850' align='left' valign='middle'></td></tr><tr>  <td width='850' align='left' valign='middle'><img width='750' height='1040' src='http://www.deal4loans.com/pdf/images/hdfc_pg3.jpg'></td></tr><tr><td width='850' align='left' valign='middle'></td></tr><tr>  <td width='850' align='left' valign='middle'><img width='700' height='850' src='http://www.deal4loans.com/pdf/images/hdfc_pg4.jpg' width='750' height='850'></td></tr>";
echo $msg .="</table></body>";
//echo $msg;
	$cltname = $AppID;
  //  echo "<br>".$cltname;
	require_once('html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','en');
	$html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->WriteHTML($msg);
	$dir = "pdf/"; 
    $hello = getcwd();
	$crdate = date("dmY");
    $file_dir = ($hello . "/" . $dir); 
    //$file_dir = $dir;
    //echo "<br>";
    $file_name = ($cltname . ".pdf"); 
	// $file_name = ($cltname . ".pdf"); 
    $file_path = ($file_dir.$file_name); 
	$html2pdf->Output($dir.$file_name, 'F'); 
 //echo  "File - ".$file_name;

$fileName1= "pdf/".$file_name;

//$files_to_zip = array($fileName1, 'pdf/hdfc-form-part2.pdf');
$files_to_zip = array($fileName1);
//print_r($files_to_zip);
$file =  $AppID.".zip";

$file_path = "pdf/".$file;

$result = create_zip($files_to_zip,$file_path);
?> 
<a href="http://www.deal4loans.com/pdf/<? echo $file; ?>" target="_blank" style="text-decoration:none; font-weight:bold; font-size:13px;">Click to Download Form</a>
<br /><br />

</td></tr></table>