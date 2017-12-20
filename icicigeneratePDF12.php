<table cellpadding="0" cellspacing="0" width="275" >
<tr><td width="183" align="center" style="font-size:15px; font-weight:bold; font-family:Verdana,Arial; "><p>Download the Application Form</p>
  <p>&nbsp;</p></td>
</tr>
<tr><td>
<?php
@set_time_limit(600);
require 'scripts/db_init.php';
require 'scripts/functions.php';

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

if($Employment_Status==1) { $empStat ='Salaried'; } else {$empStat ='Self Employed';}

$AppID = "U1";


$msg = "<body style='margin:0px; padding:0px; font-family:Arial; font-size:12px; color:#333; line-height:18px;'><table width='850'  border='0' style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'>";
$msg .= "<tr>  <td width='850' align='left' valign='middle'>";

$msg .="<table width='750' border='0' align='center' cellpadding='3' cellspacing='0' style='border:#F0F0F0 solid thin;'><tr><td height='35' colspan='4' valign='left' style='font-family:Arial; font-size: 22px;color: #171616;'><img src='http://www.deal4loans.com/images/newimages/eligibility-check-hdfc-logo.jpg' border='0' height='43' width='96'></td></tr><tr><td height='35' colspan='4' style='font-family:Arial; font-size: 16px;color: #171616;font-weight: bold;'>Professional Details</td></tr><tr><td width='138' style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Profession</td>
<td width='228' style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$empStat."</td>
<td width='112' style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Company Name</td>
<td width='236' style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Company_Name."</td>
</tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>PAN Card no.</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Pancard."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Loan amount</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Loan_Amount."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td><span style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Tenure</span></td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Tenure."</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td height='35' colspan='4' style='font-family:Arial; font-size: 16px;color: #171616;font-weight: bold;'>Personal Details</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Name</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;' colspan='3'>".$name_abbr." ".$FName." ".$MName." ".$LName."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td><span style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Gender</span></td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Gender."</td><td><span style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Date of Birth </span></td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$DOB."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Mobile No.</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Phone."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>No of Dependents</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$no_dependents."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Email</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Email."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Net Salary</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Net_Salary."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Educational Qualification </td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$Education."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>HDFC Cust ID or<br />A/C no</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$customer_id."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td height='35' colspan='2' style='font-family:Arial; font-size: 16px;color: #171616;font-weight: bold;'>Office Address</td><td colspan='2' style='font-family:Arial; font-size: 16px;color: #171616;font-weight: bold;'>Residence Address</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'> Line 1</td><td>".$off_add_line1."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Line 1</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_add_line1."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'> Line 2</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$off_add_line2."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Line 2 </td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_add_line2."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Line 3</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$off_add_line3."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Line 3</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_add_line3."</td></tr><tr><td colspan='4'>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Land Mark</td><td>".$off_landmark."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Land Mark</td><td>".$resi_landmark."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>State</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$off_State."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;' >State</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_State."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>City</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_City."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>City</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_City."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Land Line</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$off_landline."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Land Line</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$resi_landline."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>Coupon Code</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>".$coupon_code."</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>&nbsp;</td><td style='font-family:Arial; font-size: 12px;color: #FF0000;font-weight: normal;'>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>&nbsp;</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>&nbsp;</td><td style='font-family:Arial; font-size: 12px;color: #171616;font-weight: normal;'>&nbsp;</td><td style='font-family:Arial; font-size: 14px; font-weight:bold; color: #FF0000;font-weight: normal;'>Verified</td></tr></table>";

$msg .="</td></tr>";
$msg .="</table></body>";

$cltname = $AppID;
    require_once('html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','en');
	$html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->WriteHTML($msg);
	$dir = "pdf/"; 
    $hello = getcwd();
	$crdate = date("dmY");
   $file_dir = ($hello . "/" . $dir); 
//    $file_dir = $dir;
  // echo "<br>";
   $file_name = ($cltname . ".pdf"); 
	// $file_name = ($cltname . ".pdf"); 
    $file_path = ($file_dir.$file_name); 
	$html2pdf->Output($dir.$file_name, 'F'); 
// echo  "File - ".$file_name;


$fileName1= "pdf/".$file_name;

$files_to_zip = array($fileName1);
//print_r($files_to_zip);
$file =  $AppID.".zip";

$file_path = "pdf/".$file;

$result = create_zip($files_to_zip,$file_path);
?> 
<a href="http://www.deal4loans.com/<? echo $fileName1; ?>" target="_blank" style="text-decoration:none; font-weight:bold; font-size:13px;">Click to Download Form</a>
<br /><br />
<a href="http://www.deal4loans.com/pdf/<? echo $file; ?>" target="_blank" style="text-decoration:none; font-weight:bold; font-size:13px;">Click to Download Form</a>
<br /><br />
<!--<a href="http://www.deal4loans.com/pdf/form-part2.pdf" target="_blank"  style="text-decoration:none; font-weight:bold; font-size:13px;">Download Form Part 2</a> -->
</td></tr></table>