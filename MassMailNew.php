<?php
    require 'scripts/db_init.php';
   // require 'scripts/functions.php';

  
$Query="SELECT RequestID,Email,Name,City,Mobile_Number,Net_Salary,DOB FROM `Req_Loan_Home` WHERE ((`City` in ('Delhi','Noida','Gurgaon','Faridabad','Gaziabad','Faridabad','Greater Noida','Chennai','Mumbai','Thane','Navi mumbai','Kolkata','Kolkota','Hyderabad','Pune','Bangalore') or `City_Other` in ('Delhi','Noida','Gurgaon','Faridabad','Gaziabad','Faridabad','Greater Noida','Chennai','Mumbai','Thane','Navi mumbai','Kolkata','Kolkota','Hyderabad','Pune','Bangalore')) and `Req_Loan_Home`.Accidental_Insurance=0 and Updated_Date between '2008-10-01 00:00:00' and '2008-10-31 23:59:59') group by Email";
 list($NumRows,$getrow)=MainselectfuncNew($Query,$array = array());
		$i=0;


  
while($i<count($getrow))
        {
	$RequestID= trim($getrow[$i]['RequestID']);
    $name= trim($getrow[$i]['Name']);
	$city= trim($getrow[$i]['City']);
	$email= trim($getrow[$i]['Email']);
	$mobile= trim($getrow[$i]['Mobile_Number']);
	$income= trim($getrow[$i]['Net_Salary']);
	$DOB= trim($getrow[$i]['DOB']);
	list($year,$month,$day) = split('[-]', $DOB);

/*	 $EmailID= trim($getrow[$i]['Email']);
	 $Name = trim($getrow[$i]['Name']);
     $LID = trim($getrow[$i]['RequestID']);*/

	
  
   $Subject ="Start your Retirement planning today....";
	$Content = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr>
    <td height='26' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; color:#333333;' >If  you are not able to view this mailer properly, please <a href='http://www.deal4loans.com/emailer/tata-aig-life.php?requestid=".$RequestID."&pro=2' target='_blank'>Click here</a></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='116' height='286' align='left' valign='top'><img src='http://www.bimadeals.com/emailer/tat-aig-life/hdr1.jpg' width='116' height='286' /></td>
        <td width='120'><img src='http://www.bimadeals.com/emailer/tat-aig-life/hdr2.jpg' width='120' height='286' /></td>
        <td width='115'><img src='http://www.bimadeals.com/emailer/tat-aig-life/hdr3.jpg' width='115' height='286' /></td>
        <td width='107'><img src='http://www.bimadeals.com/emailer/tat-aig-life/hdr4.jpg' width='107' height='286' /></td>
        <td width='102'><img src='http://www.bimadeals.com/emailer/tat-aig-life/hdr5.jpg' width='102' height='286' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='192' height='120' valign='middle'><img src='http://www.bimadeals.com/emailer/tat-aig-life/swrn.gif' width='189' height='109' /></td>
        <td valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#021422;'>Retirement is the time in your life, when you sit back, relax and enjoy the fruits of the hard work you have put during your working life. It is also the period to do all the things that you really wanted to do but did not find the time for while you were busy working hard to ensure a good  living and a comfortable lifestyle for your family.</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='372' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='372' height='25' valign='top'><img src='http://www.bimadeals.com/emailer/tat-aig-life/benfts.gif' width='372' height='20' /></td>
          </tr>
          <tr>
            <td valign='top' ><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='10'>&nbsp;</td>
    <td valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#021422; line-height:18px;'>
			&bull; <b style='color:#b65e04;'>Issue age 18 years to 65 years:</b><br />
              Start Saving from as early as age 18<br />
              &bull; <b style='color:#b65e04;'>Flexibility of policy term:</b><br />
              Regular/Limited Premium 10 to 40 years<br />
              &bull; <b style='color:#b65e04;'>Guaranteed additional allocation:</b><br />
              Better chance to get a higher corpus on maturity<br />
              &bull; <b style='color:#b65e04;'>Top up Option:</b><br />
              Invest more money to give your account value a<br />
              better chance to grow.<br />
              &bull; <b style='color:#b65e04;'>Automatic asset allocation:</b><br />
              Advantage of the expertise in fund management<br />
              offered by the Company</td>
  </tr>
</table></td>
          </tr>
        </table></td>
        <td valign='top'>
		<form  name='tataaig_mailer' action='http://www.deal4loans.com/emailer/tata-aig-life.php' method='post'>
		<input type='hidden' value='".$email."' name='email'>
		<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='188' height='52' align='left' valign='top'><img src='http://www.bimadeals.com/emailer/tat-aig-life/frm-tp.gif' width='188' height='52' /></td>
          </tr>
          <tr>
            <td bgcolor='#ececec'>
			
			<table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'>
              <tr>
                <td height='32'><input type='text' value='".$name."' name='name' id='name' style='width:175px;' /></td>
              </tr>
              <tr>
                <td height='32'><input type='text' value='".$day."' name='day' style='width:45px;' /> <input type='text' value='".$month."' name='month' style='width:45px;' /> <input type='text' value='".$year."' name='year' style='width:65px;' /></td>
              </tr>
              <tr>
                <td height='32'><input type='text' value='".$income."' name='income' style='width:175px;' /></td>
              </tr>
              <tr>
                <td height='32'><input type='text' value='".$mobile."' name='mobile' style='width:175px;' /></td>
              </tr>
              <tr>
                <td height='32'><input type='text' value='".$city."' name='city' style='width:175px;' /></td>
              </tr>
              <tr>
                <td height='30' align='center'><input name='submit' type='Submit' value='Submit' style='font-size:11px; font-weight:bold; background-color:#003568; color:#FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; width:80px; height:22px; border:0px;'/></td>
              </tr>
            </table>			</td>
          </tr>
          <tr>
            <td width='188' height='45' align='left' valign='top'><img src='http://www.bimadeals.com/emailer/tat-aig-life/frm-bt.gif' width='188' height='36' /></td>
          </tr>
        </table>
		</form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='58'  valign='middle' bgcolor='#ececec' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#021422;'><b>Tata AIG Life Insurance Company Ltd</b>. (Regn no.: 110),<br />
      Registered &amp; corporate office: Peninsula Towers, 6th Floor, Peninsula Corporate Park,<br />
    Ganpatrao Kadam Marg, Lower Parel, Mumbai 400013.</td>
  </tr>
  <tr>
    <td height='58'  valign='middle' bgcolor='#ececec' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#021422;'>*Please refer to the product brochure for details terms and conditions before concluding a sale.<br />
Tax benefits are as per the income tax act, 1961 and are subject to amendments there in from<br />
time to time</td>
  </tr>
  <tr>
    <td><table width='99%' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='56%' height='25' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color: #666666;'>Insurance is the subject matter of the solicitation.</td>
        <td width='44%' align='right' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#021422;'><a href='http://www.bimadeals.com/emailer/tata-disclaimer.php' target='_blank'>Disclaimer</a></td>
      </tr>
    </table></td>
  </tr>
  </table>";

   
    $countI = $i+1;
			//	$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Tata Aig <live@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <live@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    

	//$email = "ranjana5chauhan@gmail.com";
	//mail($email, $Subject,$Content,$headers);
 echo "<br>Count: ".$countI."  Email: ".$email."  Name: ".$name."  RequestID: ".$RequestID;
       // echo "<br>Count: ".$countI."  Email: ".$email[$i]."  Name: ".$name;
		//echo "<br>Count: ".$countI."  Email: ".$EmailID."  Name: ".$Name;
//}
 $i=$i+1;
}
//mail("ranjana5chauhan@gmail.com", $Subject,$Content,$headers);
?>
 	