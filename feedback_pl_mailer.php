<?php
    require 'scripts/db_init.php';
 
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-4, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";
//$Query ="Select RequestID, Loan_Amount, Email, Name, Updated_Date  from Req_Loan_Personal where (Bidder_Count>0  and ( Dated between '".$min_date."' and '".$max_date."')) GROUP BY `Email`";
//$Query ="SELECT * FROM `Req_Loan_Personal` WHERE ( Bidder_Count >0 AND (Updated_Date BETWEEN '2009-02-01 00:00:00' AND '2009-03-10 23:59:59')) GROUP BY `Email`";
$Query ="Select RequestID,Loan_Amount,Name,Updated_Date,Email from Req_Loan_Personal where RequestID='1646485'";
echo "<br>".$Query;

list($NumRows,$Result)=MainselectfuncNew($Query,$array = array());
for($i=0;$i<$NumRows;$i++)
 {
	 $RequestID = trim($Result[$i]['RequestID']);
	 $Loan_Amount = trim($Result[$i]['Loan_Amount']);
	 $Email = trim($Result[$i]['Email']);
	 $Name = trim($Result[$i]['Name']);
	  $Updated_Date = trim($Result[$i]['Updated_Date']);
	  list($dated, $time) = split('[ ]', $Updated_Date);

	 //echo "hello ".$RequestID."<br>";
//select bidders 
$selectBidders="select BidderID,Allocation_Date From Req_Feedback_Bidder_PL where AllRequestID='".$RequestID."' and Reply_Type=1";
//echo "<br>";
list($rowNumRows,$row)=MainselectfuncNew($selectBidders,$array = array());

$newbidderid="";

//echo "select BidderID From Req_Feedback_Bidder_PL where AllRequestID='".$RequestID."' and Reply_Type=1";
for($j=0;$j<$rowNumRows;$j++)
	 {
		$bidderid=$row[$j]['BidderID'];
		$Allocation_Date=$row[$j]['Allocation_Date'];
		list($allocatedated, $allocatetime) = split('[ ]', $Allocation_Date);

		$newbidderid[]=$bidderid;
	 }
	 $getbidderidarray=@implode(',',$newbidderid);
	// echo "<br>";
	// echo $getbidderidarray;
	// echo "<br>";
$j=0;
$getupbiname="";
			for($j=0;$j<count($newbidderid);$j++)
			{
			$selectBidderName="select Bidder_Name from Bidders_List where BidderID='".$newbidderid[$j]."'";
			//echo "select Bidder_Name from Bidders_List where BidderID='".$newbidderid[$j]."'";
			list($rowNumRows1,$biname)=MainselectfuncNew($selectBidderName,$array = array());
			$k=$j+1;
			//echo "".$k.")".$biname['Bidder_Name']."<br>";
			$getbiname=$biname[0]['Bidder_Name'];
			$getupbiname[] =$getbiname;
$getbiddernamearray=@implode(',',$getupbiname);
			}
	
$Subject ="Kindly share your feedback on Personal Loan Quotes from Banks";

$content="<form name='plmailer_feebdback' action='http://www.deal4loans.com/emailer/pl_mailer_thanks.php' method='POST'>
<input type='hidden' name='getrequestid' value='".$RequestID."'>
<input type='hidden' name='getcount' value='".count($getupbiname)."'>
<input type='hidden' name='biddernamearr' value='".$getbiddernamearray."'>
<input type='hidden' name='bidderidarr' value='".$getbidderidarray."'>
<table width='560' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#edf2f7'>
  <tr bgcolor='#FFFFFF' >
    <td align='center' valign='bottom'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:15px 0px 5px 0px; '>If you are not able to view this mailer properly, please <a href='http://www.deal4loans.com/emailer/pl-mailer-09.php?requestid=".$RequestID."' target='_blank'>Click  here</a></td>
  </tr>
  <tr>
  <tr>
	<Td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='264' height='89' align='left' valign='top'><img src='http://www.deal4loans.com/emailer/pl-mailer/hdr-lft.gif' width='264' height='89' /></td>
        <td width='296' height='89' ><img src='http://www.deal4loans.com/emailer/pl-mailer/hdr-rgt.gif' width='296' height='89' /></td>
      </tr>
    </table></Td>
  </tr>
  <td><table width='560' border='0' cellspacing='0' cellpadding='0' >
      <tr>	
        <td width='1' bgcolor='#7cabda'></td>
        <td><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
          
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#000000; line-height:18px; padding:5px 5px 0px 8px; '>Dear ".$Name.",</td>
          </tr>
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#000000; line-height:18px; padding:5px 5px 0px 8px; '>
			Team Deal4Loans is continuously working towards delighting their customers. Your suggestions & feedback are important to us. You had applied with us for Personal Loan amounting Rs.".$Loan_Amount." dated ".$dated." Time ".$time.". We have forwarded your request to following banks:</td>
          </tr>
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#000000; line-height:18px; padding:5px 0px 5px 8px; '>";
			//get biddername here
			$k=0;
			for($k=0;$k<count($getupbiname);$k++)
			{
				$l=$k+1;
			 $content.="".$l.") ".$getupbiname[$k]."<br>";
			}			  
	$content.="</td>
          </tr>
          <tr>
            <td align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#000000; line-height:18px; padding:5px 0px 0px 10px;'>Would appreciate if you can let us know on followings:</td>
          </tr>
		   <tr>
            <td valign='top' style='padding-top:5px;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>             
              <tr>
                <td  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; '>	
				<table width='100%' border='0' align='center' cellpadding='4' cellspacing='0'>
				<tr bgcolor='#2061a1'>
                    <td align='center' bgcolor='#2061a1' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFFFFF; padding:0px 10px;' colspan='5' height='30'>Did you receive a call from following Banks within 4 Working Hours</td>
                  </tr>";
			////////////PUT IN BANKS WISE
			$r=0;
			for($r=0;$r<count($getupbiname);$r++)
			{				
				 $content.="
				 <tr bgcolor='#cbdef3'><td colspan='5'>
				 <table width='90%' align='center' cellpadding='4' cellspacing='0'>
				 <tr bgcolor='#cbdef3' >
                    <td height='22' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; line-height:16px; padding-left:10px; border-left:1px solid #666666;' width='20%'>".$getupbiname[$r]."</td>
                    <td align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding-left:3px;' width='15%'><input type='radio' value='Yes'  name='receive_call_".$r."' />
                    Yes</td>
                    <td  align='left' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;'  width='15%'><input type='radio' value='No'  name='receive_call_".$r."' />
                    No</td>
					  <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;' align='center'  width='25%'><textarea rows='1' cols='18' name='receive_call_".$r."'> </textarea></td>
					    <td  align='center' width='25%' style='border-right:1px solid #666666;'><input type='submit' name='submit' value='submit' /></td>
                  </tr></table></td></tr>";			
			}			
                  
            $content.=" </table></td>
              </tr>";
			  
                  $content.="
            </table>			</td>
          </tr>
		  <tr>
            <td>&nbsp;</td>
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
echo  $content."<br><br>";
//$Email="ranjana5chauhan@gmail.com";
/*$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Deal4loans <live@loansbychoice.comm>' . "\r\n";
				$headers .= "Return-Path: <live@loansbychoice.com>\r\n";  // Return path for errors
				$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
				$headers = "From: deal4loans <live@loansbychoice.com>";
				//$headers .= "Return-Path: <live@loansbychoice.com>\r\n";  // Return path for errors
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $content . "\n\n";
//$Email="ranjana5chauhan@gmail.com";
				//mail($Email, $Subject,$message,$headers);
				echo "done";
				echo "<br>Count: ".$i."  Email: ".$Email."  Name: ".$Name."  RequestID: ".$RequestID;
 }

?>
<!--
</body>
</html>-->
