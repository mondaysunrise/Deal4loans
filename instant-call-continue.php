<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Persoanl Loan Instant Call</title>

<link href="ivr-personal-loan.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
	//require 'test/scripts/database_conn.php';
	require 'scripts/db_init.php';
       require 'scripts/db_init_in.php';
	require 'ivrfunction.php';	
//print_r($_POST);
//exit();
//if(isset($_POST['submit']))

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$ProductType = 14;
		$FullName = $_REQUEST['full_name'];
		$EmailID = $_REQUEST['email'];
		$City = $_REQUEST['city'];
		
		$day = $_REQUEST['day'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		
		$DOB = $year."-".$month."-".$day;
		
		$Employement_Status = $_REQUEST['Employement_Status'];
		$Net_Salary = $_REQUEST['Net_Salary'];
		
		$MobileNumber = $_REQUEST['mobile_no'];
		$TimeSlab = $_REQUEST['TimeSlab'];
		$MobileNumber = "0".$MobileNumber;
		$IP = getenv("REMOTE_ADDR"); 
		
		$StartTime = $_REQUEST['StartTime'];
		$ExpStartTime = explode(":",$StartTime);
		$EndTime = $_REQUEST['EndTime'];
		$ExpEndTime = explode(":",$EndTime);
		$Dated = ExactServerdate();

		$ShowDate = date("Y-m-d H:i:s");
//		echo "<br>";
	//	echo $ShowDate;
//	echo "<br>";
		$varTime1  = mktime($ExpStartTime[0],$ExpStartTime[1], $ExpStartTime[2], date("m")  , date("d"), date("Y"));
		$checkTime1 = date("Y-m-d H:i:s", $varTime1);
		$varTime2  = mktime($ExpEndTime[0],$ExpEndTime[1], $ExpEndTime[2], date("m")  , date("d"), date("Y"));
		$checkTime2 = date("Y-m-d H:i:s", $varTime2);
		/*
		echo $checkTime1;
		echo "<br>";
		echo $checkTime2;
		echo "<br>";
		*/
	//	$StartTime = "10:00:00";
	//	$EndTime = "10:40:59";	
	//	$EndTime = "17:59:59";
		$Day = date("l");
		
		if($ShowDate > $checkTime1 && $ShowDate < $checkTime2 && $Day!='Sunday')			
		{
			$TimePreference = 1;	
		}
		else
		{
			$TimePreference = 0;
		}
//		echo "<br>TimePreference:: ".$TimePreference."<br>";
		//Routing call to Monday if time after 6 on saturday 
		
		if($TimePreference == 1)
		{
			
			//$SqlCall="INSERT INTO Req_PL_ivr (Name, Email, Phone, City, DOB, Employement_Status, Net_Salary,  Dated, Source, IP_Address,CallonDay) Values ('$FullName', '$EmailID', '$MobileNumber', '$City', '$DOB', '$Employement_Status', '$Net_Salary', Now(), '$Source', '$IP','$Day')";
			//echo "hello::".$SqlCall;
			//echo "<br>";
	$dataInsert = array("Name"=>$FullName, "Email"=>$EmailID, "Phone"=>$MobileNumber, "City"=>$City, "DOB"=>$DOB, "Employement_Status"=>$Employement_Status, "Net_Salary"=>$Net_Salary, "Dated"=>$Dated, "Source"=>$Source, "IP_Address"=>$IP, "CallonDay"=>$Day);
$table = 'Req_PL_ivr';
$insert = Maininsertfunc ($table, $dataInsert);
	
	
			//$QueryCall=ExecQuery($SqlCall);
			$Customerid = mysql_insert_id();
			$Product = "Req_PL_ivr";
			$Message="<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $FullName,</b></font></td><td align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'><br><font face='Verdana' style='font-size:11px;' color='#0F74D4'>Loans by choice not by chance!!</font></td></tr><tr><td colspan='2'><font face='Verdana' size='2'>&nbsp;</font><p><font size='2' face='Verdana'>Your search for   Personal Loan ends here. <b>Deal4Loans   -</b> <b>&ldquo;A Gateway to Compare Personal Loan Rates &amp; Instant Loan Approval&rdquo;</b> <b>in a single call.</b> Our Comparative Interactive Voice Response Service (<b>CIVRS</b>) Model gets you connected to <b>Direct Bank Teams</b> &amp; ensures <b>Best Personal Loan Deal</b> .</font></p><p>Use our <b><U><a href='http://www.deal4loans.com/chat/checklist.pdf'>Checklist</a></U></b> to ease your comparison process &amp; compare the bank offers.</p><p><font size='2' face='Verdana'>Your <b>Profile Summary</b>:</font><font face='Verdana' size='2'><p>Your Name: $FullName<br>Location: $City<br>Email Id: $EmailID<br>Contact :$MobileNumber</p><p><b>What is Personal Loan?</b><br>A personal loan is an unsecured loan so it means that the bank assumes that they are taking a high risk in giving out such loans.</p><p><b>Interest rate Charged?</b><br>Banks charge interest at rates between 14% and 40% depending on the profile of the individual. Generally the rate applicable to an applicant decreases with increasing salary.</p></font><p><font size='2' face='Verdana'><b>Basic Parameters for assessing an applicant's profile:</b></font><font face='Verdana' size='2'><li> Your Salary/Income-Tax-Returns. </li><li> Company/Business profile. </li><li> Total work experience/current work experience. </li></font><li><font size='2' face='Verdana'> Your Residential Address/status. </font></li><font face='Verdana' size='2'>&nbsp;</font><li><font size='2' face='Verdana'> Your Current Loans / Exposure.</font></li><font face='Verdana' size='2'>&nbsp;</font><li><font size='2' face='Verdana'> Your Credit/Default profile.</font></li><font face='Verdana' size='2'>&nbsp;</font><li><font size='2' face='Verdana'> How do I compare Personal Loans- refer to the <a href='http://www.deal4loans.com/chat/checklist.pdf'>checklist</a></font></li><font face='Verdana' size='2'></ul></p><br></font><p><font size='2' face='Verdana'><b>Banker's Preferences for an applicant:</b></font><font face='Verdana' size='2'>&nbsp;</font><ul><li> <font size='2' face='Verdana'><b>Stable Job:</b> Banks generally want an applicant who has a stable job and hence check the current and total work experience.</font></li><li> <font size='2' face='Verdana'><b>Residential status:</b> If you own a house that is a perfect situation for bank to lend. But even if you have taken an accommodation on rent so long as the lease documents are in place, there should be no problems.</font></li><li> <font size='2' face='Verdana'><b>Past Credit Profile:</b> Banks verify whether you have defaulted any of your previous loan repayments. This is done against both internal systems and third party systems like CIBIL/Satyam. </font></li></ul><font face='Verdana' size='2'><p>Regards<br>Team<b> <a href='http://www.deal4loans.com/index.php?source=plAM'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></p></font></td></tr></table><table width='100%' ><tr><td align='center'> <a href='http://www.deal4loans.com/index.php?source=plivr' target='_blank'><font face='Verdana' size='2'>Deal4Loans.com</font></a></td><td align='center'> | </td><td align='center'><a href='http://www.bimadeals.com/index.php' target='_blank'><font face='Verdana' size='2'>Bimadeals.com</font></a></td align='center'><td align='center'> | </td><td align='center'><a href='http://www.askamitoj.com' target='_blank'><font face='Verdana' size='2'>Askamitoj.com</font></a></td align='center'><td align='center'> | </td><td align='center'><a href='http://www.deal4loans.com/Contents_Blogs.php'>Blogs</a></td align='center'><td align='center'> | </td><td align='center'><a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'><font face='Verdana' size='2'>Testimonials</font></a></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'To: '.$FullName.' <'.$EmailID.'>' . "\r\n";
				$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";

				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($EmailID,'Thank You for Applying on Deal4loans.com', $Message, $headers);
		
		
			$StrBidders = getBidders($Customerid,$Product,$City);
			
		

 			
		}
		else
		{
			if($Day=="Sunday" || $Day=="Saturday")
			{
				$CallonDay = "Monday";
			}
			
			//$SqlCall="INSERT INTO Req_PL_ivr (Name, Email, Phone, City, DOB, Employement_Status, Net_Salary,  Dated, Source, IP_Address, TimeSlab, CallonDay) Values ('$FullName', '$EmailID', '$MobileNumber', '$City', '$DOB', '$Employement_Status', '$Net_Salary', Now(), '$Source', '$IP','$TimeSlab','$CallonDay' )";
			//echo "hello::".$SqlCall;
			//echo "<br>";
	
			//$QueryCall=ExecQuery($SqlCall);
			$dataInsert = array("Name"=>$FullName, "Email"=>$EmailID, "Phone"=>$MobileNumber, "City"=>$City, "DOB"=>$DOB, "Employement_Status"=>$Employement_Status, "Net_Salary"=>$Net_Salary, " Dated"=>$Dated, "Source"=>$Source, "IP_Address"=>$IP, "TimeSlab"=>$TimeSlab, "CallonDay"=>$CallonDay);
$table = 'Req_PL_ivr';
$insert = Maininsertfunc ($table, $dataInsert);
		}
	//	echo "<br>";
//echo "hello::".$SqlCall;
	//	echo "<br>";
?>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" background="images/ivr-pl-lft-shadow.gif" style="background-repeat:repeat-y; background-position:left top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="443" height="142" align="left" valign="top"><img src="images/ivr-pl-logo.gif" width="443" height="142" /></td>
          </tr>
          <tr>
            <td background="images/ivr-pl-lft-shadow.gif" style="background-repeat:repeat-y; background-position:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="26" height="154" align="left" valign="top"><img src="images/ivr-pl-left-big-shadow.gif" width="26" height="154" /></td>
                <td width="113" height="154" align="left" valign="top"><img src="images/ivr-stop-watch.gif" width="113" height="154" /></td>
                <td width="304" height="154" align="left" valign="top"><img src="images/ivr-pl-blue-thank-cont.gif" width="304" height="154" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td  align="left" valign="top" background="images/ivr-pl-thank-bot-bg.gif" style="background-repeat:no-repeat; background-position:left top;">&nbsp;</td>
          </tr>
          
          
        </table></td>
        <td width="325" valign="top"  background="images/ivr-pl-rgt-shadow.gif" style="background-repeat:repeat-y; background-position:right bottom;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="337" height="142" align="right" valign="top"><img src="images/ivr-pl-rgt-img.gif" width="337" height="142" /></td>
          </tr>
          <tr>
            <td width="337" height="133" align="right" valign="top"><img src="images/ivr-pl-wmn-rgt.gif" width="337" height="133" /></td>
          </tr>
          
        </table>
          <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top" style="background-repeat:no-repeat; background-position:left top;"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
	<tr>
	<td width="8" valign="top" background="images/ivr-pl-lft-shadow.gif" style="background-repeat:repeat-y; background-position:top;">&nbsp;</td>
	    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          
          
          <tr>
            <td  colspan="2" align="left" valign="top" class="bdytext" style="padding:20px; padding-bottom:0px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
            <td colspan="2" align="left" style="padding-bottom:5px;" ><b>Dear  <?php echo $FullName; ?></b>,<br />As per the details mentioned you are eligible for below mentioned banks. To get connected to the banks.</td>
          </tr>
              <tr>
                <td align="left" valign="top" style="padding-right:5px;">
                  
                  Save Time | No   wait for Calls | Get Connected to Direct Bank Teams | Instant Quotes for Loan   Approval<b><br />
                  <br />
                  What to   Compare?<br />
                 </b> 
                    <b style="line-height:22px;">1. Compare EMIs across Banks keep Loan   Amount &amp; Tenure Constant<br />
                    2. Processing   Time
                    <br />
                    3. Documents Required<br />
</b>
                    <!--Know More ( Must Read   Link)--></td>
                <td align="left" valign="top">
				<?php
				$ListBidders = explode(',', $StrBidders);
				if($ListBidders>2)
				{		
				?>
				<table width="400" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#EEEEEE" style="border:1px solid #BDBABA; padding:6px 0px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center" valign="top" class="heading-text" style="font-size:15px;">Press</td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" style="padding-left:146px;"><table width="99" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td width="99" height="39" align="center" valign="top" <?php if(isset($ListBidders[1]))	{ ?> background="images/ivr-pl-thnk-curv.gif" class="heading-text" style="padding-top:10px; background-repeat:no-repeat;" <?php } ?>>
	<?php
	if(isset($ListBidders[1]))
	{
		$RetrieveBidder = "select Bidder_Name from PLivrBidders where BidderID='".$ListBidders[1]."'";
		//$RetrieveBidderQuery = ExecQuery($RetrieveBidder);
	//	$RetrieveNumRows = mysql_num_rows($RetrieveBidderQuery);
	 list($RetrieveNumRows,$getrow)=MainselectfuncNew($RetrieveBidder,$array = array());
		$cntr=0;
	
	
		$Bidder_Name =$getrow[$cntr]['Bidder_Name'];
		echo $Bidder_Name;
	}
	?>	</td>
  </tr>
  <tr>
    <td align="center" valign="top"><img src="images/ivr-pl-top-arrow.gif" width="14" height="27" /></td>
  </tr>
</table>	</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="130" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="130" height="43" align="left" style="padding-top:3px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
                                  <tr>
                                    <td width="99"  height="39" align="center" valign="top" <?php
	if(isset($ListBidders[0]))
	{ ?> background="images/ivr-pl-thnk-curv.gif" class="heading-text" style="padding-top:9px; background-repeat:no-repeat;" <?php } ?> >
<?php
	if(isset($ListBidders[0]))
	{
		$RetrieveBidder = "select Bidder_Name from PLivrBidders where BidderID='".$ListBidders[0]."'";
		//$RetrieveBidderQuery = ExecQuery($RetrieveBidder);
		//$RetrieveNumRows = mysql_num_rows($RetrieveBidderQuery);
		 list($RetrieveNumRows,$Myrow)=MainselectfuncNew($RetrieveBidder,$array = array());
		$i=0;
		
		$Bidder_Name = $Myrow[$i]['Bidder_Name'];
		echo $Bidder_Name;
	}
?>	</td>
                                    <td width="31" height="14" align="right" valign="middle"><?php
	if(isset($ListBidders[1]))
	{ ?><img src="images/ivr-pl-lft-arrow.gif" width="31" height="14" /><?php } ?></td>
                                  </tr>
                                  <tr>
                                    <td  height="5" colspan="2" align="center" valign="top"  ></td>
                                    </tr>
                                  <tr>
                                    <td  height="39" align="center" valign="top" <?php
	if(isset($ListBidders[3]))
	{ ?> background="images/ivr-pl-lft-crv.gif" class="heading-text" style="padding-top:9px; background-repeat:no-repeat; padding-left:16px;" <?php } ?> >
									<?php
	if(isset($ListBidders[3]))
	{
		$RetrieveBidder = "select Bidder_Name from PLivrBidders where BidderID='".$ListBidders[3]."'";
		//$RetrieveBidderQuery = ExecQuery($RetrieveBidder);
		//$RetrieveNumRows = mysql_num_rows($RetrieveBidderQuery);
		 list($RetrieveNumRows,$Arrrow)=MainselectfuncNew($RetrieveBidder,$array = array());
		$j=0;
		
		$Bidder_Name = $Arrrow[$j]['Bidder_Name'];
		echo $Bidder_Name;
	}
	?>									</td>
                                    <td width="31" height="14" align="right" valign="middle"><?php
	if(isset($ListBidders[3]))
	{
	?> <img src="images/ivr-pl-lft-arrow.gif" width="31" height="14" />
	<?php } ?>	</td>
                                  </tr>
                                </table>								</td>
                              </tr>
                              
                            </table></td>
                            <td width="130" align="center" valign="middle">
							<img src="images/ivr-pl-mobile-key.gif" width="130" height="178" /></td>
                            <td valign="top">
	
	<?php			
	if(isset($ListBidders[2]))
	{ 
	?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="31" height="14" align="left" valign="middle" ><img src="images/ivr-pl-rgt-arrow.gif" width="31" height="14" /></td>
                                <td width="99" height="39" align="center" valign="middle" background="images/ivr-pl-thnk-curv.gif" style="background-repeat:no-repeat;" class="heading-text" >
<?php
	
		$RetrieveBidder = "select Bidder_Name from PLivrBidders where BidderID='".$ListBidders[2]."'";
		//$RetrieveBidderQuery = ExecQuery($RetrieveBidder);
		//$RetrieveNumRows = mysql_num_rows($RetrieveBidderQuery);
		 list($RetrieveNumRows,$Getrow)=MainselectfuncNew($RetrieveBidder,$array = array());
		$k=0;
		
		$Bidder_Name = $Getrow[$k]['Bidder_Name'];
		echo $Bidder_Name;
?>								</td>
                              </tr>
                            </table>
							
<?php
	}
	?>							</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" style="padding-left:145px;">
						<img src="images/ivr-pl-menu.gif" width="99" height="68" />						</td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
				<?php
				}
				?>				</td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td  colspan="2" align="center" class="bdytext" style="text-align:center;" ><a href="http://www.askamitoj.com/" target="_blank">Ask Amitoj.com</a> | <a href="http://www.Bimadeals.com" target="_blank">Bimadeals.com</a> | <a href="http://www.deal4loans.in" target="_blank">Deal4loans.in</a> </td>
          </tr>
          
          <tr>
            <td  height="3" colspan="2" bgcolor="#A7A110"></td>
          </tr>
        </table></td>
        <td width="8" background="images/ivr-pl-rgt-shadow.gif" style="background-repeat:repeat-y; background-position:top; width:8px;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>

<?php
}
else 
{
	$msg = "NotAuthorised";
	$PostURL = "instant-call.php?msg=".$msg;
	header("Location: $PostURL");
}
?>

</body>
</html>


