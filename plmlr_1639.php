<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';


$qry="SELECT Email FROM Req_Feedback_Bidder1,Req_Loan_Home WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID =1639 and Req_Feedback_Bidder1.Reply_Type=2 and (Req_Feedback_Bidder1.Allocation_Date Between '2012-04-25 00:00:00' and '2012-05-30 23:59:59' ) ";
//$qry="SELECT Email FROM Req_Loan_Home WHERE RequestID=473421";

list($recordcount,$row)=MainselectfuncNew($qry,$array = array());
		$cntr=0;


while($cntr<count($row))
        {
			echo $email=$row[$cntr]['Email'];
			echo "<br>";

			if(strlen($email)>0)
			{
				$Message2="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>To ensure you get best loan and best deal here is what you should do.<br><br>
<b>Do's</b>
<ol>

<li>
Take offers from 3-4 banks before you take loan</li>
<li>
Get exact Emi/Processing fee /Prepayment charges from the Bank representatives.</li>
<li>Also check with them the processing time of the loan.</li>
<li>Check background/proof of the person you are giving your documents.</li>
<li>Read all documents/agreements before you sign them.</li>
<li>Keep copy of all documents with you.</li></ol>



<b>Dont's</b><br>
<ol>
<li>
Never pay cash to any agent/bank representative.The processing fee is deducted when loan is sanctioned.</li>
<li>Do not apply at 3-4 banks simultaneously with document submission as it will reduce your credit score.</li></ol>


So if you take the above tips, your chances of getting the best deal are satisfaction of the loan process will be higher.<br><br>
We at Deal4loans.com are comparative engine are do not sell loans of any bank by ourselves.We provide platform to compare and get best deal.<a href='http://www.deal4loans.com/Contents_Disclaimer.php'>Disclaimer </a>



			  </td></tr> <tr><td colspan='2' height='110' valign='middle'><a href='http://www.deal4loans.com/earn-credit-card.php?source=plAM' target='_blank'><img src='http://www.deal4loans.com/images/crdt-bann-mlr.gif' width='550' height='101' border='0'/></a></td>
		  </tr>
			  



        </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr><td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>
  </tr>
</table>";
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			

				$SubjectLine = "Do and Dont s when you take loans";

//$Email="ranjana5chauhan@gmail.com,mehra3@gmail.com";
				mail($email, $SubjectLine, $Message2, $headers);


			}
		 $cntr=$cntr+1;}



?>