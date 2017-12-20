<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
	//require 'scripts/functions.php';
	//session_start();

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

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
		$CheckSql = "select Add_Comment,Name,RequestID, Email, Net_Salary, Mobile_Number, City, DOB, Updated_Date,Bidder_Count from ".$product_type." where  (Mobile_Number=$cust_mobileno and Email='".$cust_emailid."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."')"; 
		
					}
		elseif (strlen($cust_mobileno)>0)
			{
		$CheckSql = "select Add_Comment, RequestID, Name, Email, Net_Salary, Mobile_Number, City, DOB, Updated_Date,Bidder_Count from ".$product_type." where  (Mobile_Number=$cust_mobileno and Updated_Date between '".$days30datetime."' and '".$currentdatetime."')"; 
		    }
		elseif (strlen($cust_emailid)>0)
			{
		$CheckSql = "select Add_Comment, Name, Email,RequestID, Mobile_Number, Net_Salary, City, DOB, Updated_Date,Bidder_Count from ".$product_type." where (Email='".$cust_emailid."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') "; 
			}
			}
	else
			{
		if((strlen($cust_mobileno)>0) && (strlen($cust_emailid)>0))
			{
		$CheckSql = "select Add_Comment, Name,RequestID, Email, Net_Salary, Mobile_Number, City, DOB, Dated,Bidder_Count  from ".$product_type." where  (Mobile_Number=$cust_mobileno and Email='".$cust_emailid."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') "; 
		
					}
		elseif (strlen($cust_mobileno)>0)
			{
		$CheckSql = "select Add_Comment, RequestID, Name, Email, Net_Salary, Mobile_Number, City, DOB, Dated,Bidder_Count  from ".$product_type." where  (Mobile_Number=$cust_mobileno and Updated_Date between '".$days30datetime."' and '".$currentdatetime."')"; 
		    }
		elseif (strlen($cust_emailid)>0)
			{
		$CheckSql = "select Add_Comment, Name, Email,RequestID, Mobile_Number, Net_Salary, City, DOB, Dated,Bidder_Count  from ".$product_type." where (Email='".$cust_emailid."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."')"; 
			}
			}
			//echo "query".$CheckSql;
			$result=d4l_ExecQuery($CheckSql);

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
else
{
	$currentdate=date('Y-m-d');
	$exactcurrentdate= $currentdate." 23:59:59";
	//echo "hello";
	$product_type = $_REQUEST['pt'];
	$mob = $_REQUEST['mob'];

	$CheckSql = "select Name, Email,RequestID,Add_Comment, Mobile_Number, Net_Salary, City, DOB, Updated_Date, Dated,Bidder_Count  from ".$product_type." where (Mobile_Number='".$mob."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."')";
	//echo "ok:".$CheckSql."<br>";
	$result=d4l_ExecQuery($CheckSql);
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
<img src="images/cclogo.gif" alt="Deal4Loans" onClick="javascript:location.href='index.php'"/>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
</head><body>
<div align="center">

<!--  <p class="bodyarial11"><?=$Msg?></p> -->
<FORM NAME="search_entry" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post"  >
			<TABLE ALIGN="center"  CELLPADDING="0" style="border: 1px solid #529BE4;" CELLSPACING="0" BORDER="0" valign="top">
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
				<td>Select product &nbsp;<select name="product_type">
				<option <?if ($product_value == "Req_Loan_Personal" || $product_type=="Req_Loan_Personal") {echo "selected";}?> value="Req_Loan_Personal">Personal Loan</option>
				<option <?if ($product_value == "Req_Loan_Home" || $product_type=="Req_Loan_Home") {echo "selected";}?> value="Req_Loan_Home">Home Loan</option>
				<option <?if ($product_value == "Req_Loan_Car" || $product_type=="Req_Loan_Car") {echo "selected";}?> value="Req_Loan_Car">Car Loan</option>
				<option <?if ($product_value == "Req_Loan_Against_Property" || $product_type=="Req_Loan_Against_Property") {echo "selected";}?> value="Req_Loan_Against_Property">Loan Against Property</option>
				<option <?if ($product_value == "Req_Credit_Card" || $product_type=="Req_Credit_Card") {echo "selected";}?> value="Req_Credit_Card">Credit Card</option>
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
		<!--	<td class="head1">Sent Bidder Count</td>-->
			<td class="head1">Bidder Name</td>
			<td class="head1">Feedback</td>
			<td class="head1">Add Comment</td>
			 
		</tr>
		
		<?while($nrow=d4l_mysql_fetch_array($result))
		{?>

		<tr>
		<td class="bodyarial11"><?php echo $nrow["RequestID"]; ?></td>
			<td class="bodyarial11"><?php echo $nrow["Name"]; ?></td>
			<td class="bodyarial11"><?php echo $nrow["Email"]; ?></td>
			<td class="bodyarial11"><?php echo $nrow["Mobile_Number"];?></td>
			<td class="bodyarial11"><?php echo  $nrow["Net_Salary"];?></td>
			<td class="bodyarial11"><?php echo  $nrow["City"];?></td>
			<td class="bodyarial11"><?php echo  $nrow["DOB"];?></td>
			<td class="bodyarial11"><?php if($product_type=="Req_Loan_Home" || $product_type=="Req_Loan_Personal") { echo $nrow["Updated_Date"];} else {echo $nrow["Dated"];}?></td>
		
			<!--<td class="bodyarial11"><?php echo  $nrow["Bidder_Count"];?></td>-->

<td class="bodyarial11">
	 <?php 
		 if($product_type=="Req_Loan_Home")
			{
				$Product_code="2";
			}
			elseif($product_type=="Req_Loan_Personal")
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
			 $BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder1.BidderID As bid FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID and Bidders_List.Reply_Type =".$Product_code." WHERE AllRequestID = '".$nrow["RequestID"]."' AND Req_Feedback_Bidder1.Reply_Type =".$Product_code;
	//echo $BiddersChurn;
	$BiddersChurnSql = d4l_ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = d4l_mysql_num_rows($BiddersChurnSql);
	while($newrow=d4l_mysql_fetch_array($BiddersChurnSql))
				{
			$BidderID[]=$newrow["Bidder_Name"]."(".$newrow["bid"].")";
			//print_r($BidderID);
				}
			
	//echo count($strShowBidders);?>
	<?
	echo @implode(',', $BidderID);
		
	 ?>
	 
	 </td>
	 <td  class="bodyarial11">
	 <?php
	// $Product = getReqValue($product_type);
	 if($product_type=="Req_Loan_Personal")
			{
	 $GETFeedbackSql = "select Feedback from Req_Feedback_PL where AllRequestID=".$nrow["RequestID"]." and  Reply_Type=".$Product_code;
			}
			else
			{
	$GETFeedbackSql = "select Feedback from Req_Feedback where AllRequestID=".$nrow["RequestID"]." and  Reply_Type=".$Product_code;
			}
	$GETFeedbackQuery = d4l_ExecQuery($GETFeedbackSql);
	$nrowFeed = d4l_mysql_fetch_array($GETFeedbackQuery);
	echo $Followup_Date = $nrowFeed['Feedback'];
	 ?>
	 
	 
	 
	 </td>
	 	<td class="bodyarial11"><?php echo  $nrow["Add_Comment"];?></td>
		</tr>
		<?			}?>
		</table>
		<?php
		}
		?>
 <br>
 
 <br>


   </div>
  


</body>

</html>
