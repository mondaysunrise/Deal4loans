<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		require 'getlistofeligiblebidders.php';
	

//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$leadid = $_REQUEST["leadid"];
		$strCity = $_REQUEST["city"];


		list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($realbankiD)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
	
$strFinalBidder = implode(",",$FinalBidder);


	$DataArray = array("Bidderid_Details"=>$strFinalBidder, 'Allocated'=>'2', 'Dated'=>$Dated);
		$wherecondition ="(RequestID = '".$leadid."')";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<Script Language="JavaScript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

function insertbidid(id)
		{

		var get_leadid = document.getElementById('leadid').value;
		
		var get_bnkid= document.getElementById('bnkid_'+ id).value;
				
		var queryString = "?leadid=" + get_leadid + "&bnkid=" + get_bnkid ;
			//alert(queryString); 	
			ajaxRequest.open("GET", "insert_cl_bidder.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						if(ajaxRequest.responseText=="insert")
						{ 
							document.getElementById('dvid_'+ id).style.visibility="hidden";
							
						}
						else
						{
							//alert('cant save the comment');
						}
					}
				}

				ajaxRequest.send(null); 
			 
		}
	window.onload = ajaxFunction;
	


</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Car Loan through Deal4loans.com. You will get a call from the below mentioned Banks. <br><br></font></b></div>
  <?

	if(count($Final_Bid)>0)
	{ ?>
	<input type="hidden" name="leadid" id="leadid" value="<? echo $leadid; ?>">
		<table cellpadding="0" cellspacing="0" width="550" align="center" style="border:1px #dbf2ff solid;">
			<tr>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid;">Bank Name</td>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" style="border-left:1px #000000 solid;"></td>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center">Dont Want</td>
			</tr>
		<? for($i=0;$i<count($Final_Bid);$i++)
			{ ?>
			
		<tr>
			<td class="fontbld10" align="center" height="45"><? echo $Final_Bid[$i]; ?></td>
			<td class="fontbld10" align="center">
			<input type="checkbox" name="bnkid_<? echo $i;?>" id="bnkid_<? echo $i;?>" value="<? echo $arrFinal_Bid[$i]; ?>"></td>
<td class="fontbld10" align="center"><div name="dvid_<? echo $i;?>" id="dvid_<? echo $i;?>"><input type="button" name="bttn_<? echo $i;?>"  id="bttn_<? echo $i;?>" class="btnclr" value="submit" onClick="insertbidid(<? echo $i;?>);"></div></td>
			</tr>	
		<?	}
		?>
		
		</table>
		</form>
	
	<? $R_URL="thank_cl_continue_direct.php?leadid=$leadid";

	if(strlen($R_URL)>0)

	{

		Header("Refresh: 30 URL=".$R_URL);

	}

 }

	
	?>
  </div>
 </div>
 
 
  <?php include '~Bottom-new.php';?>
</div><!-- </div>-->
</body>
</html>