<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//error_reporting(0);

	$lead_id =$_REQUEST['lead_id'];
	$feedback =$_REQUEST['feedback'];
	$FollowupDate =$_REQUEST['FollowupDate'];
	$bidder_id = $_REQUEST['bidder_id'];
	$comment = $_REQUEST['comment'];
	$i = $_REQUEST['i'];
	$fbidder_id = $_REQUEST['fbidder_id'];
	$Dated = ExactServerdate();
	
	$retrieve_query="select Allocation_Date from Req_Feedback_Bidder1 where AllRequestID=".$lead_id." and Reply_Type=1";
//echo $retrieve_query."<br>";
	list($recordcount,$getrow)=MainselectfuncNew($retrieve_query,$array = array());
	$cntr=0;
	$lead_date = $getrow[$cntr]['Allocation_Date'];
	
	$checkSql = "select * from pl_feedback where lead_id='".$lead_id."' and bidder_id = '".$bidder_id."'";
	list($numRows,$Arrrow)=MainselectfuncNew($checkSql,$array = array());

if($numRows>0)
	{
	//update
	
	$DataArray = array("feedback"=>$feedback, "update_date"=>$Dated, "comment"=>$comment);
	$wherecondition ="lead_id='".$lead_id."' and bidder_id = '".$bidder_id."'";
	Mainupdatefunc ('pl_feedback', $DataArray, $wherecondition);
		
	}
	else
	{
	//insert
	$dataInsert = array("lead_id"=>$lead_id, "bidder_id"=>$bidder_id, "feedback"=>$feedback, "dated"=>$Dated, "lead_date"=>$lead_date, "comment"=>$comment, "fbidder_id"=>$fbidder_id);
$table = 'pl_feedback';
$insert = Maininsertfunc ($table, $dataInsert);
	
	}
//	echo $query;
	
	if($feedback=="Appointment")
	{
		?>
		<table cellpadding="0" cellspacing="0" border="0">
		<tr><td width="162">Date Of Appointment</td>
		<td width="270"><input type="text" name="doa_<?php echo $i; ?>" id="doa_<?php echo $i; ?>"  /> Eg: <?php echo date("Y-m-d");?></td></tr>
		<tr><td>Time Of Appointment</td><td>
        <select name="toa_<?php echo $i; ?>" id="toa_<?php echo $i; ?>">
										<option value="please select">Time slab</option>

									<option value="00">Call Before going</option>					

										<option value="8(am)-9(am)">8(am)-9(am)</option>
										<option value="9(am)-10(am)">9(am)-10(am)</option>
										<option value="10">10(am)-11(am)</option>
										<option value="10(am)-11(am)">11(am)-12(am)</option>
										<option value="12(am)-1(pm)" >12(am)-1(pm)</option>
										<option value="1(pm)-2(pm)">1(pm)-2(pm)</option>
										<option value="2(pm)-3(pm)">2(pm)-3(pm)</option>
										<option value="3(pm)-4(pm)">3(pm)-4(pm)</option>
										<option value="4(pm)-5(pm)">4(pm)-5(pm)</option>
										<option value="5(pm)-6(pm)">5(pm)-6(pm)</option>
										<option value="6(pm)-7(pm)">6(pm)-7(pm)</option>
										<option value="7(pm)-8(pm)">7(pm)-8(pm)</option>

										</select>	
        
        </td></tr>
		<tr><td>address</td><td><input type="text" name="address_<?php echo $i; ?>" id="address_<?php echo $i; ?>"  /></td></tr>			
		<tr><td></td><td><a onClick="getAppointment(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">&nbsp;&nbsp;Fix Appointment</a></td></tr>
		
		</table>
		<?php
	}
	else
	{
		echo "Feedback Saved";
	}
	
?>