<?php
    require 'scripts/db_init.php';
 

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-7, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

/*$Query ="Select * from Req_Loan_Home where (Bidder_Count>0  and ( Dated between '".$min_date."' and '".$max_date."')) GROUP BY `Email`";*/

$Query ="SELECT RequestID,Loan_Amount,Name,Dated,Email FROM Req_Loan_Home WHERE ( Bidder_Count >0 AND (Dated BETWEEN '2008-12-01 00:00:00' AND '2009-01-31 23:59:59') and City in ('Delhi','Noida','Gurgaon','Gaziabad','Faridabad','Thane','Navi Mumbai','Bangalore','Kolkata','Chennai','Mumbai','Pune','Hyderabad','Ahmedabad')) GROUP BY `Email`";
//$Query ="Select RequestID,Loan_Amount,Name,Dated,Email from Req_Loan_Home where RequestID='61512'";
echo "<br>".$Query;

 list($recordcount,$getrow)=MainselectfuncNew($Query,$array = array());
		$cntr=0;
		
//$Result = ExecQuery($Query);
//$NumRows = mysql_num_rows($Result);

while($cntr<count($getrow))
        {
	 $RequestID = trim($getrow[$cntr]['RequestID']);
	 $Loan_Amount = trim($getrow[$cntr]['Loan_Amount']);
	 $Email = trim($getrow[$cntr]['Email']);
	 $Name = trim($getrow[$cntr]['Name']);
	  $Updated_Date = trim($getrow[$cntr]['Dated']);
	  list($dated, $time) = split('[ ]', $Updated_Date);

	 //echo "hello ".$RequestID."<br>";
//select bidders 
$selectBidders=("select BidderID From Req_Feedback_Bidder1 where AllRequestID='".$RequestID."' and Reply_Type=2");
//echo "<br>";
$newbidderid="";

 list($recordcount,$row)=MainselectfuncNew($selectBidders,$array = array());
		$i=0;


//echo "select BidderID From Req_Feedback_Bidder1 where AllRequestID='".$RequestID."' and Reply_Type=1";
while($cntr<count($row))
        {
		$bidderid=$row[$i]['BidderID'];

		$newbidderid[]=$bidderid;
	$i = $i +1; }
	 $getbidderidarray=@implode(',',$newbidderid);
	// echo "<br>";
	// echo $getbidderidarray;
	// echo "<br>";
$j=0;
$getupbiname="";
			for($j=0;$j<count($newbidderid);$j++)
			{
			$selectBidderName=ExecQuery("select Bidder_Name from Bidders_List where BidderID='".$newbidderid[$j]."'");
			//echo "select Bidder_Name from Bidders_List where BidderID='".$newbidderid[$j]."'";
			$biname = mysql_fetch_array($selectBidderName);
			$k=$j+1;
			//echo "".$k.")".$biname['Bidder_Name']."<br>";
			$getbiname=$biname['Bidder_Name'];
			$getupbiname[] =$getbiname;
$getbiddernamearray=@implode(',',$getupbiname);
			}
			

	//echo $getbiddernamearray."<br>";

	$Subject ="Kindly share your feedback on Home Loan Quotes from Banks";
$content="<form name='plmailer_feebdback' action='http://www.deal4loans.com/emailer/hl_mailer_thanks.php' method='POST'>
<input type='hidden' name='getrequestid' value='".$RequestID."'>
<input type='hidden' name='getcount' value='".count($getupbiname)."'>
<input type='hidden' name='biddernamearr' value='".$getbiddernamearray."'>
<input type='hidden' name='bidderidarr' value='".$getbidderidarray."'>
<table width='560' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#edf2f7'>
  <tr bgcolor='#FFFFFF' >
    <td align='center' valign='bottom'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; padding:15px 0px 5px 0px; '>If you are not able to view this mailer properly, please <a href='http://www.deal4loans.com/emailer/hlfeedback-mailer.php?requestid=".$RequestID."' target='_blank'>Click  here</a></td>
  </tr>
  <tr>
  <tr>
	<Td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='264' height='89' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/hdr-lft.gif' width='264' height='89' /></td>
        <td width='296' height='89' ><img src='http://www.deal4loans.com/emailer/hl-mailer/hdr-rgt-hl.jpg' width='296' height='89' /></td>
      </tr>
    </table></Td>
  </tr>
  <td><table width='560' border='0' cellspacing='0' cellpadding='0'>
      <tr>
	
        <td width='1' bgcolor='#7cabda'></td>
        <td><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
          
          <tr>
<td align='left' ><table width='550' border='0' align='center' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='414' height='30' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; line-height:18px;'>Dear ".$Name.", </td>
                  <td width='136' height='117' rowspan='2' align='center'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color: #000000; font-weight:bold;' ><img src='http://www.deal4loans.com/emailer/hl-mailer/ipd.gif' width='112' height='117' /><br />
Win IPOD!!&nbsp;&nbsp;</td>
                </tr>
                <tr>
                  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; line-height:18px;'> Team Deal4Loans is continuously working towards delighting their customers.
Your suggestions &amp; feedback can give you a <b>Chance to Win an IPOD</b> as they are important to us.  You had applied with us for Home Loan amounting Rs.".$Loan_Amount." dated ".$dated.". We had forwarded your request to following banks:</td>
                  </tr>
              </table></td>

            
          </tr>
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; line-height:18px; padding:5px 0px 5px 8px;'>";//get biddername here
			$k=0;
			for($k=0;$k<count($getupbiname);$k++)
			{
				$l=$k+1;
			 $content.="".$l.") ".$getupbiname[$k]."<br>";
			}
			
			  
	$content.="</td>
          </tr>
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; line-height:18px; padding:5px 0px 0px 8px; '>Would  appreciate if you can let us know on followings:</td>
          </tr>
          <tr>
            <td valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td height='30' align='center' valign='bottom'><table width='410' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='15' height='22' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/lft-crv.gif' width='15' height='22' /></td>
                    <td align='center' bgcolor='#2061a1' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; padding:0px 10px; '>Did you receive a call from following Banks</td>
                    <td width='15' height='22' align='right' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/rgt-crv.gif' width='15' height='22' /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; '>	
				<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>";
			////////////PUT IN BANKS WISE
			$r=0;
			for($r=0;$r<count($getupbiname);$r++)
			{
				
				 $content.="<tr bgcolor='#cbdef3'>
                    <td width='248' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>".$getupbiname[$r]."</td>
                    <td  align='right' ><input type='radio' value='Yes'  name='receive_call_".$r."' /></td>
                    <td width='27' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Yes</td>
                    <td  align='right' ><input type='radio' value='No'  name='receive_call_".$r."' /></td>
                    <td width='216' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>No</td>
                  </tr>";
			
			}
			
                 /* <tr bgcolor='#cbdef3'>
                    <td width='248' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>HDFC Bank</td>
                    <td  align='right' ><input type='radio' value='Yes'  name='hdfc' /></td>
                    <td width='27' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Yes</td>
                    <td  align='right' ><input type='radio' value='No'  name='hdfc' /></td>
                    <td width='216' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>No</td>
                  </tr>
				  
               <tr bgcolor='#dfeaf6'>
                    <td width='248' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>Fullerton</td>
                    <td width='37' align='right' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;  padding-left:10px;'><span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>
                      <input type='radio' value='Yes'  name='fullerton_bank' />
                    </span></td>
                    <td width='27' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;  padding-left:3px;'>Yes</td>
                    <td width='30' align='right' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;  padding-left:3px;'><input type='radio' value='No'  name='fullerton_bank' />
                    </td>
                    <td width='216' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;  padding-left:3px;'>No</td>
                  </tr>
                  <tr bgcolor='#cbdef3'>
                    <td width='248' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>ABN AMRO</td>
                    <td align='right' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:10px;'><span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>
                      <input type='radio' value='Yes'  name='abn' />
                    </span></td>
                    <td align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Yes</td>
                    <td align='right' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:10px;'><input type='radio' value='No'  name='abn' />
                    </td>
                    <td align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>No</td>
                  </tr>
                
			  ///END OF BANK WISE*/
              
            $content.=" </table></td>
              </tr><tr>
                <td height='30' align='center' valign='bottom'><table width='410' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='15' height='22' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/lft-crv.gif' width='15' height='22' /></td>
                      <td align='center' bgcolor='#2061a1' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; padding:0px 10px; '>Did you finalize your loan  with any of the banks</td>
                      <td width='15' height='22' align='right' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/rgt-crv.gif' width='15' height='22' /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align='center' valign='bottom'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
                  <tr bgcolor='#cbdef3'>
                    <td width='250' align='right'><input type='radio' value='Yes' name='finalize_requirement'  /></td>
                    <td width='308' height='22' align='left' bgcolor='#cbdef3' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Yes</td>
                  </tr>
                  <tr bgcolor='#dfeaf6'>
                    <td width='250' align='right'><input type='radio' value='No'  name='finalize_requirement' /></td>
                    <td width='308' height='22' align='left' bgcolor='#dfeaf6' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>No</td>
                  </tr>
                  
                </table></td>
              </tr>
              <tr>
                <td height='30' align='center' valign='bottom'> 
                  <table width='410' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='15' height='22' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/lft-crv.gif' width='15' height='22' /></td>
                      <td align='center' bgcolor='#2061a1' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; padding:0px 10px; '>If yes, then which of the following banks?</td>
                      <td width='15' height='22' align='right' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/rgt-crv.gif' width='15' height='22' /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align='center'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>";
				//////////////////////
				$j=0;
			for($j=0;$j<count($getupbiname);$j++)
			{
				 $content.="<tr bgcolor='#cbdef3'>
                    <td  align='right' ><input type='radio' value='".$getupbiname[$j]."'  name='which_banks' /></td>
                    <td width='308' height='22' align='left'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px; padding-left:3px;'>".$getupbiname[$j]."</td>
                  </tr>";
			}
                  
				  $content.="</table></td>
              </tr>
               <tr>
                <td height='30' align='center' valign='bottom'><table width='410' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='15' height='22' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/lft-crv.gif' width='15' height='22' /></td>
                      <td align='center' bgcolor='#2061a1' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; padding:0px 10px; '>Did you finalize your loan  with any of the banks</td>
                      <td width='15' height='22' align='right' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/rgt-crv.gif' width='15' height='22' /></td>
                    </tr>
                </table></td>
              </tr>
			  <tr>
                <td align='center' valign='bottom'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
                 <tr bgcolor='#cbdef3'>
                    <td width='40%' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>Documents</td>
                    <td width='6%'  align='right' ><input type='radio' value='Yes'  name='documents_pick' /></td>
                    <td width='11%' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Yes</td>
                    <td width='4%'  align='right' ><input type='radio' value='No'  name='documents_pick' /></td>
                    <td width='38%' align='left' bgcolor='#cbdef3' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>No</td>
                   
                  </tr>
                  <tr bgcolor='#cbdef3'>
                     <td width='40%' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;' >Loan Amount</td>
					 <td width='59%' colspan='4'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='text'  name='loan_amount' value='".$Loan_Amount."'/></td>
                    
                    
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height='30' valign='bottom' ><table width='410' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='15' height='22' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/lft-crv.gif' width='15' height='22' /></td>
                      <td align='center' bgcolor='#2061a1' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; padding:0px 10px; '>My experience with the banks for the services offered:</td>
                      <td width='15' height='22' align='right' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/rgt-crv.gif' width='15' height='22' /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; '><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>";
				
				$j=0;
			for($j=0;$j<count($getupbiname);$j++)
			{
				 $content.="<tr bgcolor='#cbdef3'>
                    <td width='27%' height='22' align='right'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:16px;'>".$getupbiname[$j]."</td>
                    <td width='6%'  align='right' ><input type='radio' value='Excellent'  name='experience_bank_".$j."' /></td>
                    <td width='11%' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Excellent</td>
                    <td width='4%'  align='right' ><input type='radio' value='Good'  name='experience_bank_".$j."' /></td>
                    <td width='8%' align='left' bgcolor='#cbdef3' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Good</td>
                    <td width='4%'  align='right' ><input type='radio' value='Average'  name='experience_bank_".$j."' /></td>
                    <td width='10%' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Average</td>
                    <td width='4%'  align='right' ><input type='radio' value='Bad'  name='experience_bank_".$j."' /></td>
                    <td width='26%' align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding-left:3px;'>Bad</td>
                  </tr>";
			}
                  

                   $content.="<tr bgcolor='#efeeee'>
                    <td height='35' colspan='10' align='center' valign='bottom' bgcolor='#edf2f7'  >
                      <input type='submit' name='Submit' value='Submit' style='background-color:#2061a1; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#ffffff; font-weight:bold; border:none; width:100px; height:30px;' /></td>
                    </tr>";
                  $content.="</table></td>
              </tr>
              
              
            </table>			</td>
          </tr>
          <tr>
            <td align='left' valign='bottom' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; line-height:17px; padding:5px;'>Regards,<br />
              Team Deal4loans </td>
          </tr>
		  
          
        </table></td>
        <td width='1' bgcolor='#7cabda'></td>
      </tr>
    </table></td>
</tr>  <tr>
    <td bgcolor='#FFFFFF'><img src='http://www.deal4loans.com/emailer/pl-mailer/bot-line.gif' width='560' height='25' /></td>
  </tr>
</table>
</form>";

//echo  $content."<br><br>";
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Deal4loans <live@loansbychoice.comm>' . "\r\n";
				$headers .= "Return-Path: <live@loansbychoice.com>\r\n";  // Return path for errors
				$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//	mail($Email, $Subject,$content,$headers);
				echo "done";
				echo "<br>Count: ".$i."  Email: ".$Email."  Name: ".$Name."  RequestID: ".$RequestID;

  $cntr=$cntr+1;
  }

?>
<!--
</body>
</html>-->
