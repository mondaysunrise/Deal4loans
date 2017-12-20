<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/session_check_getdata.php';

$securepwd = $_SESSION['securepwd'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			foreach($_POST as $a=>$b)
				$$a=$b;
	$cust_emailid = $_POST['cust_emailid'];
	$cust_mobileno = $_POST['cust_mobileno'];
	$product_type = $_POST['product_type'];
	
	$Dated = ExactServerdate();
	$data = array("whoacessed"=>$securepwd , "email"=>$cust_emailid , "mobile"=>$cust_mobileno , "product"=>$product_type ,   "search_date"=>$Dated );
	$table = 'getdata_logs';
	$insert = Maininsertfunc ($table, $data);

	if($product_type=="Req_Loan_Home" || $product_type=="Req_Loan_Personal" || $product_type=="Req_Loan_Personal_25jan2017")
			{
	if((strlen($cust_mobileno)>0) && (strlen($cust_emailid)>0))
			{
		$CheckSql = "select Name,RequestID, Email, Net_Salary, Mobile_Number, City, DOB, Updated_Date,Bidder_Count, Dated, source, Company_Name,IP_Address from ".$product_type." where  Mobile_Number=$cust_mobileno and Email='".$cust_emailid."' "; 
		
					}
		elseif (strlen($cust_mobileno)>0)
			{
		$CheckSql = "select RequestID, Name, Email, Net_Salary, Mobile_Number, City, DOB, Updated_Date,Bidder_Count, Dated, source, Company_Name,IP_Address from ".$product_type." where  Mobile_Number=$cust_mobileno"; 
		    }
		elseif (strlen($cust_emailid)>0)
			{
		$CheckSql = "select Name, Email,RequestID, Mobile_Number, Net_Salary, City, DOB, Updated_Date,Bidder_Count, Dated, source, Company_Name,IP_Address from ".$product_type." where Email='".$cust_emailid."' "; 
			}
			}
	else if($product_type=="Req_Agent")
			{
		if((strlen($cust_mobileno)>0) && (strlen($cust_emailid)>0))
					{
				$CheckSql = "select A_Name,A_Email,	A_City,	A_Mobile,A_Date,A_Feedback from ".$product_type." where  A_Mobile='".$cust_mobileno."' and A_Email='".$cust_emailid."' "; 
				}
				elseif (strlen($cust_mobileno)>0)
					{
				$CheckSql = "select A_Name,A_Email,	A_City,	A_Mobile,A_Date,A_Feedback from ".$product_type." where  A_Mobile=$cust_mobileno"; 
					}
				elseif (strlen($cust_emailid)>0)
					{
				$CheckSql = "select A_Name,A_Email,	A_City,	A_Mobile,A_Date,A_Feedback from ".$product_type." where A_Email='".$cust_emailid."' "; 
					}

			}
	else
			{
				if($product_type=="Req_Loan_Education")
				{
					$getfields="Name,RequestID, Email, Mobile_Number, Residence_City, DOB, Dated, source";
				}
				else
				{
					$getfields="Name,RequestID, Email, Net_Salary, Mobile_Number, City, DOB, Dated, Bidder_Count, source, Company_Name,IP_Address";
				}
				if((strlen($cust_mobileno)>0) && (strlen($cust_emailid)>0))
					{
				$CheckSql = "select ".$getfields." from ".$product_type." where  Mobile_Number='".$cust_mobileno."' and Email='".$cust_emailid."' "; 
				}
				elseif (strlen($cust_mobileno)>0)
					{
				$CheckSql = "select ".$getfields." from ".$product_type." where  Mobile_Number=$cust_mobileno"; 
					}
				elseif (strlen($cust_emailid)>0)
					{
				$CheckSql = "select ".$getfields." from ".$product_type." where Email='".$cust_emailid."' "; 
					}
			}
			//echo "query".$CheckSql;
	list($NumRows,$row)=MainselectfuncNew($CheckSql,$array = array());
	if(!isset($product_t))
			{
$product_value=$product_type;
			}
			else
			{
$product_value=$product_t;
			}		

	$msg = "Value found";	
	
	
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
 <div align="center">
<?php 
//echo "dd".$_SESSION['Email-getdata']."<br>";
	 if(isset($_SESSION['Email-getdata']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['Email-getdata']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<FORM NAME="search_entry" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post"  >
			<TABLE ALIGN="center"  CELLPADDING="0" style="border: 1px solid #529BE4;" CELLSPACING="0" BORDER="0">
			<tr>
			<td align="center" bgcolor="529BE4"> <b>Fill form to search the details</b>
			</td>
			</tr>
			<tr>
				<td><td></tr>
				<tr>
				<tr>
				<td> Email id &nbsp;<input type="text" name="cust_emailid" size="30"><b> OR </b> &nbsp;Mobile &nbsp;<input type="text" name="cust_mobileno" size="10">
				</td>
				<tr>
				<td><td></tr>
				<tr>
				<td> Select product &nbsp;<select name="product_type">
				<option <? if ($product_value == "Req_Loan_Personal" || $product_type=="Req_Loan_Personal") {echo "selected";}?> value="Req_Loan_Personal">Personal Loan</option>
				<option <? if ($product_value == "Req_Loan_Personal_25jan2017" || $product_type=="Req_Loan_Personal_25jan2017") {echo "selected";}?> value="Req_Loan_Personal_25jan2017">Personal Loan OLD</option>
				<option <? if ($product_value == "Req_Loan_Home" || $product_type=="Req_Loan_Home") {echo "selected";}?> value="Req_Loan_Home">Home Loan</option>
				<option <? if ($product_value == "Req_Loan_Car" || $product_type=="Req_Loan_Car") {echo "selected";}?> value="Req_Loan_Car">Car Loan</option>
				<option <? if ($product_value == "Req_Loan_Against_Property" || $product_type=="Req_Loan_Against_Property") {echo "selected";}?> value="Req_Loan_Against_Property">Loan Against Property</option>
				<option <? if ($product_value == "Req_Credit_Card" || $product_type=="Req_Credit_Card") {echo "selected";}?> value="Req_Credit_Card">Credit Card</option>
				<option <? if ($product_value == "Req_Loan_Education" || $product_type=="Req_Loan_Education") {echo "selected";}?> value="Req_Loan_Education">Education Loan</option>
				<option <? if ($product_value == "Req_Loan_Gold" || $product_type=="Req_Loan_Gold") {echo "selected";}?> value="Req_Loan_Gold">Gold Loan</option>
				<option <? if ($product_value == "Req_Loan_Bike" || $product_type=="Req_Loan_Bike") {echo "selected";}?> value="Req_Loan_Bike">Two wheeler Loan</option>
				<option <? if ($product_value == "Req_Agent" || $product_type=="Req_Agent") {echo "selected";}?> value="Req_Agent">Agent</option>
				</select>
				</td>
				</tr>
				<tr>
				 <td  align="center" class="bodyarial11"><br>
				<input type="submit" class="bluebutton" value="Submit.." >
				</td>
		   </tr>
			</TABLE>
		</FORM>
	<?php
		if(isset($msg))
		{
			
				
		?>
		<table  cellpadding="4" cellspacing="1" class="blueborder" width="60%">
		<tr>
			<td colspan="7" align="center"><strong><?php echo $msg; ?></strong></td>
		</tr>
		<? if($product_value == "Req_Agent")
		{ ?>
			<tr>
				<td class="head1">Name</td>
			<td class="head1">Email</td>
			<td class="head1">Mobile</td>
				<td class="head1">City</td>
					<td class="head1">Doe</td>
						<td class="head1">Feedback</td>
		</tr>
		<? }
		else
		{ ?>
		
		<tr>
		<td class="head1">Requestid</td>
			<td class="head1">Name</td>
			<td class="head1">Email</td>
			<td class="head1">Mobile</td>
			<td class="head1">Net_Salary</td>
			<td class="head1">City</td>
			<td class="head1">DOB</td>
			<td class="head1">Company Name</td>
			<td class="head1">Ip Address</td>
			<td class="head1">Doe</td>
            <td class="head1">Allocation Date</td>
			<td class="head1">Bidder Name</td>
				<td class="head1">Feedback</td>
				<? if($securepwd=="shwet@3011" || $securepwd=="rc0502") {?>
				<td class="head1">Source</td>
				<? } ?>
		</tr>
		<? } ?>
		
		<? 
	for($k=0;$k<$NumRows;$k++)
		{ 
			
		 if($product_type=="Req_Loan_Home")
			{
				$Product_code="2";
			}
			elseif($product_type=="Req_Loan_Personal" || $product_type=="Req_Loan_Personal_25jan2017")
			{
				$Product_code="1";
			}
			elseif($product_type=="Req_Loan_Car")
			{
				$Product_code="3";
			}
			elseif($product_type=="Req_Loan_Against_Property")
			{
				$Product_code="5";
			}
			elseif($product_type=="Req_Credit_Card")
			{
				$Product_code="4";
			}
			elseif($product_type=="Req_Loan_Gold")
			{
				$Product_code="7";
			}
			elseif($product_type=="Req_Loan_Education")
			{
				$Product_code="8";
			}
			elseif($product_type=="Req_Loan_Bike")
			{
				$Product_code="10";
			}
			 $BidderID="";
	
	if($Product_code=="4")
				{
					$feedback_tble="Req_Feedback_Bidder_CC";
				}
				elseif($Product_code=="1")
				{
					$feedback_tble="Req_Feedback_Bidder_PL";
				}
				elseif($Product_code=="2")
				{
					$feedback_tble="Req_Feedback_Bidder_HL";
				}
				elseif($Product_code=="3")
				{
					$feedback_tble="Req_Feedback_Bidder_CL";
				}
				else
				{
					$feedback_tble="Req_Feedback_Bidder1";
				}
	$BiddersChurnSql="SELECT Allocation_Date,Bidder_Name,".$feedback_tble.".BidderID As bid FROM ".$feedback_tble." LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = ".$feedback_tble.".BidderID and Bidders_List.Reply_Type =".$Product_code." WHERE (AllRequestID = '".$row[$k]["RequestID"]."' AND ".$feedback_tble.".Reply_Type =".$Product_code.")";
	//echo $BiddersChurnSql;
	list($NumRowBiddersChurnSql,$newrow)=MainselectfuncNew($BiddersChurnSql,$array = array());
	$myrowcontr=count($newrow)-1;
	 $Allocation_Date = $newrow[$myrowcontr]["Allocation_Date"];
	for($j=0;$j<$NumRowBiddersChurnSql;$j++)
	{
		$BidderID[]=$newrow[$j]["Bidder_Name"]."(".$newrow[$j]["bid"].")";
		
	}

			if($product_value == "Req_Agent")
			{ ?>
		<tr>
				<td class="bodyarial11"><?php echo $row[$k]["A_Name"]; ?></td>
				<td class="bodyarial11"><?php echo $row[$k]["A_Email"]; ?></td>
				<td class="bodyarial11"><?php echo $row[$k]["A_Mobile"]; ?></td>
				<td class="bodyarial11"><?php echo $row[$k]["A_City"]; ?></td>
				<td class="bodyarial11"><?php echo $row[$k]["A_Date"]; ?></td>
				<td class="bodyarial11"><?php echo $row[$k]["A_Feedback"]; ?></td>
		</tr>
			<? }
			else
			{ ?>
		<tr>
		<td class="bodyarial11"><?php echo $row[$k]["RequestID"]; ?></td>
			<td class="bodyarial11"><?php echo $row[$k]["Name"]; ?></td>
			<td class="bodyarial11"><?php echo $row[$k]["Email"]; ?></td>
			<td class="bodyarial11"><?php echo $row[$k]["Mobile_Number"];?></td>
			<td class="bodyarial11"><?php echo  $row[$k]["Net_Salary"];?></td>
			<td class="bodyarial11"><?php if($product_type=="Req_Loan_Education") {echo $row[$k]["Residence_City"];} else {echo $row[$k]["City"];} ?></td>
			<td class="bodyarial11"><?php echo  $row[$k]["DOB"];?></td>
			<td class="bodyarial11"><?php echo  $row[$k]["Company_Name"];?></td>
			<td class="bodyarial11"><?php echo  $row[$k]["IP_Address"];?></td>
			<td class="bodyarial11"><?php if($product_type=="Req_Loan_Home" || $product_type=="Req_Loan_Personal"  || $product_type=="Req_Loan_Personal_25jan2017") { echo $row[$k]["Updated_Date"];} else {echo $row[$k]["Dated"];}?></td>
          <td class="bodyarial11"><?php echo $Allocation_Date; ?></td>  
<td class="bodyarial11"><?php echo implode(',', $BidderID); ?></td>
	 <td  class="bodyarial11">
	 <?php
		 if($Product_code==1)
				{
		 $tble="Req_Feedback_PL";
	 }
	 elseif($Product_code==2)
				{
		 $tble="Req_Feedback_HL";
				}
				else
				{
			$tble="Req_Feedback";
				}
	// $Product = getReqValue($product_type);
	$GETFeedbackSql = "select Feedback from ".$tble." where AllRequestID=".$row[$k]["RequestID"]." and  Reply_Type=".$Product_code;
	list($numrowFeed,$rowFeed)=MainselectfuncNew($GETFeedbackSql,$array = array());
	echo $Followup_Date = $rowFeed[0]['Feedback'];
	 ?>
	  </td>
	  <? if($securepwd=="shwet@3011" || $securepwd=="rc0502") {?>
	  <td class="bodyarial11"><?php echo $row[$k]["source"]; ?></td>
	  <? } ?>
		</tr>
		<?			
		}}?>
		</table>
		<?php
		}
		?> 
    </div> 
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
