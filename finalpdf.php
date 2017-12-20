<?php
$msg = "<body style='margin:0px; padding:0px; font-family:Arial; font-size:12px; color:#333; line-height:18px;'><table width='850'  border='0' align='center' style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'>";
$msg .="<tr><td width='850' align='left' valign='middle'><img width='750' height='1040' src='http://www.deal4loans.com/pdf/images/4.jpg'></td></tr><tr><td width='850' align='left' valign='middle'></td></tr><tr>  <td width='850' align='left' valign='middle'><img width='750' height='1040' src='http://www.deal4loans.com/pdf/images/5.jpg'></td></tr><tr><td width='850' align='left' valign='middle'></td></tr><tr>  <td width='850' align='left' valign='middle'><img width='700' height='850' src='http://www.deal4loans.com/pdf/images/6.jpg' width='750' height='850'></td></tr></table></body>";

echo "".$msg;

$cltname = "form-part2";
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

?> 
<br />
<a href="http://www.deal4loans.com/pdf/<? echo $file_name; ?>" target="_blank">Download</a>
 
