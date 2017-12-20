<table cellpadding="0" cellspacing="0" width="275" >
<tr><td width="183" align="center" style="font-size:15px; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif;"><p>Download the Application Form</p>
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


$ProductValue=$_REQUEST['vid'];
//$ProductValue='12';
//echo "select * from pl_icici_leads Where (RequestID='".$ProductValue."')";
$getValuesQuery= ("select * from pl_icici_leads Where (RequestID='".$ProductValue."')");
list($recordcount,$getValuesQuery)=MainselectfuncNew($getValuessQL,$array = array());
$Name = $getValuesQuery[0]['Name'];
//$display_name = getSingleWords($Name);
$NameArr = explode(" ",$Name);
if(count($NameArr)==2)
{
	$fName = getSingleWords($NameArr[0]);
	$lName = getSingleWords($NameArr[1]);
	$count1 = 35 - count($lName);
	
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

$Residential_Status = $getValuesQuery[0]['Residential_Status'];
$Residence_Address = $getValuesQuery[0]['Residence_Address'];
$display_Residence_Address = getSingleWords($Residence_Address);

$Mobile_Number = $getValuesQuery[0]['Mobile_Number'];
$display_mobile = getSingleWords($Mobile_Number);

$Email = $getValuesQuery[0]['Email'];
$display_email = getSingleWords($Email);

$Pancard = $getValuesQuery[0]['Pancard'];
$display_pancard = getSingleWords($Pancard);

$Company_Name = $getValuesQuery[0]['Company_Name'];
$display_c_name = getSingleWords($Company_Name);

$Company_Type = $getValuesQuery[0]['Company_Type'];

$TotalExperience = round($getValuesQuery[0]['Total_Experience']);
$Total_Experience = appendZero($TotalExperience);
$display_Total_Experience = getSingleWords($Total_Experience);

$Net_Salary = $getValuesQuery[0]['Net_Salary'];
$display_annual_income = getSingleWords($Net_Salary);

$Employment_Status = $getValuesQuery[0]['Employment_Status'];

$Years_Company = appendZero($getValuesQuery[0]['Years_Company']);
$display_Years_Company = getSingleWords($Years_Company);

$Months_Company = appendZero($getValuesQuery[0]['Months_Company']);
$display_Months_Company = getSingleWords($Months_Company);

$Total_Exp_Year = appendZero($getValuesQuery[0]['Total_Exp_Year']);
$display_Total_Experience = getSingleWords($Total_Exp_Year);

$Total_Exp_Month = appendZero($getValuesQuery[0]['Total_Exp_Month']);
$display_Total_Exp_Month = getSingleWords($Total_Exp_Month);
	$Dated = $getValuesQuery[0]['Dated'];
	$datedArr = explode(" ", $Dated);
	$dateArr = explode("-", $datedArr[0]);
	 $dt =$dateArr[2]."".$dateArr[1]."".$dateArr[0]; 
	$dt_str =  getSingleWords($dt);

$AppID = $Name;

	
	$app_code = $getValuesQuery[0]['AppID'];
	$app_code_Str = getSingleWords($app_code);


$msg = "<body style='margin:0px; padding:0px; font-family:Arial; font-size:12px; color:#333; line-height:18px;'><table width='850'  border='0' style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'>";
$msg .= "<tr>  <td width='850' align='left' valign='middle'>";

//Page 1 Start
include "iciciPDFpg1.php";
//Page 1 End

$msg .="</td></tr>";
$msg .= "<tr>  <td width='850' align='left' valign='middle'>";
//Page2 Start
include "iciciPDFpg2.php";
//Page 2 End
$msg .="</td></tr>";
$msg .= "<tr>  <td width='850' align='left' valign='middle'>";
//Page2 Start
include "iciciPDFpg3.php";
//Page 2 End
$msg .="</td></tr>";
//$msg .="<tr><td width='850' align='left' valign='middle'><img width='750' height='1040' src='http://www.deal4loans.com/pdf/images/4.jpg'></td></tr><tr><td width='850' align='left' valign='middle'></td></tr><tr>  <td width='850' align='left' valign='middle'><img width='750' height='1040' src='http://www.deal4loans.com/pdf/images/5.jpg'></td></tr><tr><td width='850' align='left' valign='middle'></td></tr><tr>  <td width='850' align='left' valign='middle'><img width='700' height='850' src='http://www.deal4loans.com/pdf/images/6.jpg' width='750' height='850'></td></tr>";
$msg .="</table></body>";

//echo "".$msg;

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

$files_to_zip = array($fileName1, 'pdf/form-part2.pdf');
//print_r($files_to_zip);
$file = $Name.".zip";

$file_path = "pdf/".$file;

$result = create_zip($files_to_zip,$file_path);
?> 
<a href="http://www.deal4loans.com/pdf/<? echo $file; ?>" target="_blank" style="text-decoration:none; font-weight:bold; font-size:13px;">Click to Download Form</a>
<br /><br />
<!--<a href="http://www.deal4loans.com/pdf/form-part2.pdf" target="_blank"  style="text-decoration:none; font-weight:bold; font-size:13px;">Download Form Part 2</a> -->
</td></tr></table>