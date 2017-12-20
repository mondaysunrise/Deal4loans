<?php
  
   include "http://www.admissioncorner.com/image/db_init.php";

//$Query ="SELECT * FROM `req_user` WHERE ((`city` in ('Delhi','Noida','Gurgaon','Gaziabad','Faridabad','Sahibabad','Greater Noida')) or (`searchincity`in ('Delhi','Noida','Gurgaon','Gaziabad','Faridabad','Sahibabad','Greater Noida'))) and Dated between '2009-01-31 00:00:00' and '2009-02-31 23:59:59' group by mail";
$Query ="SELECT * FROM `req_user` WHERE uid=12";


 echo "<br>".$Query;
$Result = mysql_query($Query);
$recordcount = mysql_num_rows($Result);
 $NumRows = mysql_num_rows($Result);

//$NumRows=1;
  
  for($i=0;$i<$NumRows;$i++)
 
{
     $EmailID= trim(mysql_result($Result, $i, 'mail'));
	  $Name = trim(mysql_result($Result, $i, 'name'));
     $LID = trim(mysql_result($Result, $i, 'uid'));
	
  
   $Subject ="Looking forward to make your career in the time Recession";
	$Content ="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='164' height='216'><img src='http://www.admissioncorner.com/images/hdr-lft.gif' width='164' height='216' /></td>
        <td width='199' height='216' align='left' valign='top'><img src='http://www.admissioncorner.com/images/hdr-mdle.gif' width='199' height='216' /></td>
        <td width='197' height='216'><img src='http://www.admissioncorner.com/images/hdr-rgt.gif' width='197' height='216' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='1' bgcolor='#db3b09'></td>
        <td   valign='top' ><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'><p><strong>Looking forward to make your career in the booming  fashion</strong><br />
Industries of India where recession is having the least effect. If we talk  about the great depression of 1930, the three most profitable sector at that point of time were Food, Entertainment and garment industry. So we can  understand that it&rsquo;s a very potential sector &amp; <b>FASHION FRATERNITY ACADEMY</b>  which is headed by Alumni of NIFT and Pearl Academy with Rich Experience in the  field of Fashion, Merchandising and Retail industry explore The differing expectations,  experiences and Visions in the fast changing fashion and retail World develop  ways to encourage future Managers to participate. <strong>IN THE LEAGUE OF FASHION.</strong><br><br>
<b>            Apply now for the following courses offered by Fashion Fraternity Academy-</b><br>
&bull; <a href='http://www.admissioncorner.com/thank_you.php?requestid=".$LID."'>Fashion Designing & Retail Marketing Management 2 year program </a><br>
&bull; <a href='http://www.admissioncorner.com/thank_you.php?requestid=".$LID."'>Fashion Designing & Marketing Management 1 year program.</a><br>
&bull; <a href='http://www.admissioncorner.com/thank_you.php?requestid=".$LID."'>Fashion Designing 6 month certificate program.</a> <br><br><br>
  </p>             
                </td>
          </tr>
          <tr>
            <td align='left' valign='bottom' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:16px;'>Regards,<br />
Admission Corner team</td>
          </tr>
        </table></td>
        <td width='1' bgcolor='#db3b09'></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='22'><img src='http://www.admissioncorner.com/images/mlr-btm.gif' width='560' height='22' /></td>
  </tr>
  <tr>
    <td height='22' bgcolor='#f6f2dc' ><table>
      <tr><td width='83' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:18px;'><a href='http://www.admissioncorner.com/about-us.php'>About us</a></td>
    <td width='10' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'>|</td>
    <td width='96' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'><a href='http://www.admissioncorner.com/contact-us.php'>Contact Us</a></td>
    <td width='10' align='center'>|</td>
    <td width='142' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'><a href='http://www.admissioncorner.com/alerts-admissions.php'>Admission Alerts</a></td>
    <td width='10' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'>|</td>
    <td width='185' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;'><a href='http://www.admissioncorner.com/colleges-registration.php'>Institute Registration Form</a></td> 
    </table></td>
  </tr>
</table>";

   
    $countI = $i+1;
				$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: AdmissionCorner <info@admissioncorner.com>' . "\r\n";
				$headers .= "Return-Path: <info@admissioncorner.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    

	
  echo "<br>Count: ".$countI."  Email: ".$EmailID."  Name: ".$Name."  RequestID: ".$LID;
     // mail($EmailID, $Subject,$Content,$headers);

}

?>
 	
