<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			foreach($_POST as $a=>$b)
				$$a=$b;
	$cust_emailid = $_POST['cust_emailid'];
	$cust_mobileno = $_POST['cust_mobileno'];
	$product_type = $_POST['product_type'];
	
	if($product_type=="Req_Loan_Home" || $product_type=="Req_Loan_Personal")
			{
	if((strlen($cust_mobileno)>0) && (strlen($cust_emailid)>0))
			{
		$CheckSql = "select Name,RequestID, Email, Net_Salary, Mobile_Number, City, DOB, Updated_Date,Bidder_Count from ".$product_type." where  Mobile_Number=$cust_mobileno and Email='".$cust_emailid."' "; 
		
					}
		elseif (strlen($cust_mobileno)>0)
			{
		$CheckSql = "select RequestID, Name, Email, Net_Salary, Mobile_Number, City, DOB, Updated_Date,Bidder_Count from ".$product_type." where  Mobile_Number=$cust_mobileno"; 
		    }
		elseif (strlen($cust_emailid)>0)
			{
		$CheckSql = "select Name, Email,RequestID, Mobile_Number, Net_Salary, City, DOB, Updated_Date,Bidder_Count from ".$product_type." where Email='".$cust_emailid."' "; 
			}
			}
	else
			{
		if((strlen($cust_mobileno)>0) && (strlen($cust_emailid)>0))
			{
		$CheckSql = "select Name,RequestID, Email, Net_Salary, Mobile_Number, City, DOB, Dated,Bidder_Count  from ".$product_type." where  Mobile_Number=$cust_mobileno and Email='".$cust_emailid."' "; 
		
					}
		elseif (strlen($cust_mobileno)>0)
			{
		$CheckSql = "select RequestID, Name, Email, Net_Salary, Mobile_Number, City, DOB, Dated,Bidder_Count  from ".$product_type." where  Mobile_Number=$cust_mobileno"; 
		    }
		elseif (strlen($cust_emailid)>0)
			{
		$CheckSql = "select Name, Email,RequestID, Mobile_Number, Net_Salary, City, DOB, Dated,Bidder_Count  from ".$product_type." where Email='".$cust_emailid."' "; 
			}
			}
			//echo "query".$CheckSql;
			
			//$result=ExecQuery($CheckSql);
			 list($recordcount,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$cntr=0;
			

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

 
  <table width="100%" border="0">
 <tr><td align="center" width="100%">
 <img src="images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='index.php'"/>
 <div align="center">

<!--  <p class="bodyarial11"><?=$Msg?></p> -->
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
				<td> Email id &nbsp;  <input type="text" name="cust_emailid" size="30"><b> OR </b> &nbsp;Mobile &nbsp;
				  <input type="text" name="cust_mobileno" size="10">
				</td>
				
				<tr>
				<td>Select product &nbsp;<select name="product_type">
				<option <? if ($product_value == "Req_Loan_Personal" || $product_type=="Req_Loan_Personal") {echo "selected";}?> value="Req_Loan_Personal">Personal Loan</option>
				</select>
				</td>
				</tr>
				<tr>
				 <td colspan="2" align="center" class="bodyarial11"><br>
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
		<tr>
		<td class="head1">Requestid</td>
			<td class="head1">Name</td>
			<td class="head1">Email</td>
			<td class="head1">Mobile</td>
			<td class="head1">Net_Salary</td>
			<td class="head1">City</td>
			<td class="head1">DOB</td>
			<td class="head1">Doe</td>
			<td class="head1">Bidder Name</td>
			<td class="head1">Feedback</td>
		</tr>
		
		<?while($row=mysql_fetch_array($result))
		{?>

		<tr>
		<td class="bodyarial11"><a href="get_pl_details_edit.php?id=<? echo urlencode($row['RequestID']); ?>" target="_blank"><?php echo $row["RequestID"]; ?></a></td>
			<td class="bodyarial11"><?php echo $row["Name"]; ?></td>
			<td class="bodyarial11"><?php echo $row["Email"]; ?></td>
			<td class="bodyarial11"><?php echo $row["Mobile_Number"];?></td>
			<td class="bodyarial11"><?php echo  $row["Net_Salary"];?></td>
			<td class="bodyarial11"><?php echo  $row["City"];?></td>
			<td class="bodyarial11"><?php echo  $row["DOB"];?></td>
			<td class="bodyarial11"><?php if($product_type=="Req_Loan_Personal") { echo $row["Updated_Date"];} else {echo $row["Dated"];}?></td>
			<!--<td class="bodyarial11"><?php echo  $row["Bidder_Count"];?></td>-->

<td class="bodyarial11">
	 <?php 
		 
				$BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder1.BidderID As bid FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID and Bidders_List.Reply_Type =1 WHERE AllRequestID = '".$row["RequestID"]."' AND Req_Feedback_Bidder1.Reply_Type =1";
	//echo $BiddersChurn;
	 list($NumRowBiddersChurnSql,$newrow)=MainselectfuncNew($BiddersChurn,$array = array());
		$cntr=0;
	
	//$BiddersChurnSql = ExecQuery($BiddersChurn);
	//$NumRowBiddersChurnSql = mysql_num_rows($BiddersChurnSql);
	while($cntr<count($newrow))
        {
			$BidderID[]=$newrow[$cntr]["Bidder_Name"]."(".$newrow[$cntr]["bid"].")";
			$cntr=$cntr+1;
		}
			
	//echo count($strShowBidders);?>
	<?
	echo implode(',', $BidderID);
		
	 ?>
	 
	 </td>
	 <td  class="bodyarial11">
	 <?php
	// $Product = getReqValue($product_type);
	 $GETFeedbackSql = "select Feedback from Req_Feedback where AllRequestID=".$row["RequestID"]." and  Reply_Type=".$Product_code;
	list($NumRowBiddersChurnSql,$rowFeed)=MainselectfuncNew($GETFeedbackSql,$array = array());
		$i=0;
	
	//$GETFeedbackQuery = ExecQuery($GETFeedbackSql);
	//$rowFeed = mysql_fetch_array($GETFeedbackQuery);
	echo $Followup_Date = $rowFeed[$i]['Feedback'];
	 ?>
	 
	 
	 
	 </td>
		</tr>
		<?			}?>
		</table>
		<?php
		}
		?>
 <br>
 
 <br>



    </div>
 </td></tr></table>
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
