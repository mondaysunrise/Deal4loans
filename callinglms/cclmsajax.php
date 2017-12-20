<?php
require_once("includes/application-top-inner.php");
$ProVal = $_REQUEST['valIdent'];

?>
<table width="100%">
<tr id="capmaigndv">
                  <td>Campaigns</td>
                  <td>
                  <select name="Campaign" id="Campaign" onchange="getAgentsinCampaign(this.value)">
                      <option value="" <? if($Campaign == "") { echo "selected"; } ?>>Please Select</option>

                  <?php
                  
                  if($ProVal==1)
                  {
                    $qryCheck = "SELECT BidderID, leadidentifier FROM Bidders where leadidentifier in ('diallerleadcc1') group by leadidentifier";//'CallerAccountCity',  
                  }else if($ProVal==2)
                  {
                      $qryCheck = "SELECT BidderID, leadidentifier FROM Bidders where leadidentifier in ('diallercallerccpredictive', 'diallerleadccsmsnew') group by leadidentifier";//'CallerAccountCity', 
                  }
                  elseif($ProVal==3)
                  {
	                $qryCheck = "SELECT BidderID, leadidentifier FROM Bidders where leadidentifier in ('diallerleadcc') group by leadidentifier";//'CallerAccountCity',
                  }
					$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
					$qryCheckResult = $obj->fun_db_query($qryCheck);
					while($row = $obj->fun_db_fetch_rs_object($qryCheckResult))
					{
					?>
                    <option value="<?php echo $row->leadidentifier; ?>" <? if($Campaign == $row->leadidentifier) { echo "selected"; } ?>><?php echo $row->leadidentifier; ?></option>
					<?php								
					}
				  ?></select></td>
                  <td width="25%" style="text-align: right;">Agents</td>
				  <td width="25%">
				  <span id="name_agents">
				  <?php
                                  
				    $qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('".$Campaign."') and leadidentifier!=''";
					$recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
					$qryCheckResult1 = $obj->fun_db_query($qryCheck1);
					$status_text = '';
					?>
					<select name="Agents" id="Agents" ><?php if($recordcount>0) { ?><option value="All" <? if($Agents == "All") { echo "selected"; } ?>>All</option><?php while($row1 = $obj->fun_db_fetch_rs_object($qryCheckResult1)) { $Status = $row1->Status; if($Status ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }  ?><option value="<?php echo $row1->BidderID; ?>" <? if($Agents == $row1->BidderID) { echo "selected"; } ?>><?php echo $row1->BidderID; ?> [<?php echo $row1->Bidder_Name; ?>] (<?php echo $status_text; ?>) </option><?php	 } } else { echo '<option value="">Please Select</option>'; } ?></select>
				  </span>
				  </td>
				  </tr>
                                  </table>
