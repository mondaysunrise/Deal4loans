<?php
require 'scripts/db_init.php';
$leadidentifier = $_REQUEST['leadidentifier'];
$qryCheck = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('".$leadidentifier."')";
$result=ExecQuery($qryCheck );
$recordcount = mysql_num_rows($result);
$status_text = '';
?>
<option value="All" >All</option><?php while($row=mysql_fetch_array($result)) { $Status = $row["Status"]; if($Status ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }  ?><option value="<?php echo $row["BidderID"]; ?>"><?php echo $row["BidderID"]; ?> [<?php echo $row["Bidder_Name"]; ?>] (<?php echo $status_text; ?>) </option><?php	} ?>