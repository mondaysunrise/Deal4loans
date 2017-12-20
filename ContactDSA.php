<?php
	require 'scripts/functions.php';
	session_start();
	$msg = "Thank You, You will be soon contacted by our Executives";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		$Message = $_REQUEST['Message'];
		$From_Contact = $_REQUEST['From_Contact'];
		
		$Type_Of_Enquiry =$_REQUEST['Type_Of_Enquiry'];
		
		if($Type_Of_Enquiry=='2' || $Type_Of_Enquiry=='3')
		{
			if($Type_Of_Enquiry=='2')
				$Subject = 'DSA /Bank';
			else if($Type_Of_Enquiry=='3')
				$Subject = 'DSA /Bank';
			
			$Bank_Associated =$_REQUEST['Bank_Associated'];
			$Product =$_REQUEST['Product'];
			
			$n       = count($Product);
			$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			 	 $From_Pro .= "$Product[$i], ";
			 	$i++;
		   }
			
			$City =$_REQUEST['City'];
			$Landline =$_REQUEST['Landline'];
			$Content = '<table border="0" cellspacing="0" width="485" bgcolor="#529BE4" style="border-collapse: collapse" bordercolor="#529BE4"><tr><td valign="top" align=center><table width="440" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm" bgcolor="FFFFFF"><tr>                <td colspan="2">&nbsp;</td>     </tr> <tr>                <td colspan="2" align="center"><strong>'.$Subject.'</strong></td>     </tr>          <tr>                <td width="40%" class="bodyarial11"><strong>Name</strong></td>  <td width="60%">'.$From_Name.'</td>   </tr>   <tr>                <td class="bodyarial11"><strong>Email ID</strong></td>         <td> '.$From_Email.'</td></tr><tr>   <td class="bodyarial11"><strong>Contact No</strong></td>         <td> '.$From_Contact.'</td>   </tr>     <tr>     <td width="40%" class="bodyarial11"><strong>Bank Associated</strong></td>        <td width="60%">'.$Bank_Associated.'</td>  </tr>  <tr>     <td width="40%" class="bodyarial11" valign="top"><strong>Products Dealing</strong></td>        <td width="60%">'.$From_Pro.'</td>  </tr>  <tr>     <td class="bodyarial11"><strong>City</strong></td>        <td> '.$City.'</td>  </tr><tr><td class="bodyarial11"><strong>Landline Number</strong></td>        <td> '.$Landline.'</td>  </tr>   <tr>     <td valign="top" class="bodyarial11"><strong>Comments</strong></td>         <td>'.$Message.'</td>   </tr>   </table></td>   </tr><tr><td bgcolor="#529BE4">&nbsp;</td></tr></table>';
		}
		else if($Type_Of_Enquiry=='1')
		{
			$Subject = 'Loan Seeker';
			$Content = '<table border="0" cellspacing="0" width="485" bgcolor="#529BE4" style="border-collapse: collapse" bordercolor="#529BE4"><tr><td valign="top" align=center><table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm"  bgcolor="FFFFFF"><tr><td colspan="2">&nbsp;</td>     </tr>       <tr><td colspan="2" align="center"><strong>'.$Subject.'</strong></td></tr><tr><td width="40%" class="bodyarial11"><strong>Name</strong></td><td width="60%">'.$From_Name.'</td></tr><tr><td class="bodyarial11"><strong>Email ID</strong></td><td> '.$From_Email.'</td></tr><tr><td class="bodyarial11"><strong>Contact No</strong></td><td> '.$From_Contact.'</td></tr>  <tr>     <td valign="top" class="bodyarial11"><strong>Comments</strong></td><td>'.$Message.'</td> </tr>   </table></td>   </tr><tr><td bgcolor="#529BE4">&nbsp;</td></tr>   </table>';
		
		}
		
	
		$msg = "Thank You, You will be soon contacted by our Executives";
		$From_Name = FixString($From_Name);
		$From_Email = FixString($From_Email);
		$From_Contact = FixString($From_Contact);
		$Message = FixString($Message);
		$Message1 = $Message." "."Contact no: ".$From_Contact;
		
/*		
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$From_Name.' <'.$From_Email.'>' . "\r\n";
*/
	$headers = 'From: '.$From_Name.' <'.$From_Email.'>' . "\r\n";
	$headers .= "Return-Path: <".$From_Email.">\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'Bcc: mehra3@gmail.com' . "\r\n";
	$to = 'deal4loans.info@gmail.com';
	
	mail($to, "$Subject", $Content, $headers);
	echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";
	}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India.">
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information">

<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<Script Language="JavaScript">



function validateMe(theFrm){
				if(!checkData(theFrm.From_Name, 'Your Name', 5))
				return false;
				if(!checkData(theFrm.From_Email, 'Your Email ID', 6))
					{
					return false;
					}
				var str=theFrm.From_Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
					return false;
					}
					if(theFrm.Message.value=="")
					{
						alert("Please Enter Comments");
						theFrm.Message.focus();
					return false;
					}
					
		return true;
    }
    </Script>

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
    <div id="dvNavbg">
      <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/leadbanner.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
   <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0" height="385">
<tr><td align="center" class="head2">Contact Us<td></tr>
<tr><td>&nbsp;</td></tr>
		<tr>
		 <td align="center">
 <form name="friend_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
      <tr>
                <td colspan="2">&nbsp;</td>
     </tr>
      <tr>
                <td width="30%" class="bodyarial11">&nbsp;Your Name</td>
     <td width="70%"><input name="From_Name" type="text" class="form" size="30"></td>
   </tr>
   <tr>
                <td class="bodyarial11">&nbsp;Your Email ID</td>
     <td>
     <input name="From_Email" type="text" class="form" size="30"></td>
   </tr>
     <tr>
                <td class="bodyarial11">&nbsp;Contact No</td>
     <td>
     <input name="From_Contact" type="text" class="form" size="30"></td>
   </tr>
  <tr>     <td width="30%" class="bodyarial11">Bank Associated</td>    <td width="70%"><input name="Bank_Associated" type="text" class="form" size="30"></td>  </tr>  <tr>     <td width="30%" class="bodyarial11" valign="top">Products Dealing</td>    <td width="70%" class="bodyarial11"><input type="checkbox"  id="Product"  name="Product[]" class="noBrdr" value="Personal Loan">      Personal Loan<br> <input type="checkbox"  id="Product"  name="Product[]" class="noBrdr" value="Home Loan">      Home Loan<br> <input type="checkbox"  id="Product"  name="Product[]" class="noBrdr" value="Car Loan">      Car Loan<br> <input type="checkbox"  id="Product"  name="Product[]" class="noBrdr" value="Business Loan">Business Loan<br> <input type="checkbox"  id="Product"  name="Product[]" class="noBrdr" value="Credit Card">Credit Card<br> <input type="checkbox"  id="Product"  name="Product[]" class="noBrdr" value="Loan Against Property">Loan Against Property</td>  </tr>  <tr>     <td class="bodyarial11">City</td>    <td> <input name="City" type="text" class="form" size="30"></td></tr><tr><td class="bodyarial11">Landline Number</td>    <td> <input name="Landline" type="text" class="form" size="30"></td></tr>
   <tr>
     <td valign="top" class="bodyarial11">&nbsp;Comments</td>
     <td><textarea name="Message" cols="40" rows="5" class="form"></textarea></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit..."></td>
   </tr>
   
 <tr>
 <td>&nbsp; </td>
  <td>&nbsp; </td>
 </tr>
 <tr>
 <td>&nbsp; </td>
  <td>&nbsp; </td>
 </tr>


  </table>
                                          </form>  
 </td>
     </tr>
  <tr>
 <td>&nbsp; </td>
  <td>&nbsp; </td>
 </tr>
 <tr>
 <td>&nbsp; </td>
  <td>&nbsp; </td>
 </tr>

 <tr>
 <td>&nbsp; </td>
  <td>&nbsp; </td>
 </tr>
 
			</table>
</td></tr></table>
 
    </div>
   <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
  </div>
<?php include '~Bottom.php';?>
</div>
  </body>
</html>