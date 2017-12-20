<?php
require_once("includes/application-top-inner.php");
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
if ($_SESSION['BidderID'] == 7074) { // Admin
    $leadidentifier = 'smsplbajajfinserv';
}
if ($_SESSION['BidderID'] == 7660) { //Admin
    $leadidentifier = 'sms_bflcalling_pl';
}

?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us" />
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252" />
        <title>Personal Loan - BFL Agent Control</title>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css" />
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <style>
            /* Pagination*/
            div.pagination {
                padding: 3px;
                margin: 3px;
            }
            div.pagination a {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #AAAADD;
                text-decoration: none; /* no underline */
                color: #000099;
            }
            div.pagination a:hover, div.pagination a:active {
                border: 1px solid #000099;
                color: #000;
            }
            div.pagination span.current {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #000099;
                font-weight: bold;
                background-color: #2b62b5;
                color: #FFF;
            }
            div.pagination span.disabled {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #CCC;
                color: #CCC;
            }
        </style>
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="font-size:30px; float: left;">BFL Data Calling CRM Agent Control</div><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout-leads-admin.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both; height:15px;"></div>
        <table width="98%" border="0">
            <tr>
                <td align="center" width="100%">
                    <?
                    $qry = "SELECT BidderID,Email,Bidder_Name,Join_Date,Status FROM Bidders WHERE Global_Access_ID LIKE '%" . $_SESSION['BidderID'] . "%' AND leadidentifier='".$leadidentifier."'";
                    $resCount = $objAdmin->fun_get_num_rows($qry);
                    if ($resCount > $limit) {
                        $pagelinks = paginate($limit, $resCount);
                    }
                    $qry.= " order by BidderID DESC";
                    $result = $obj->fun_db_query($qry);

                    //Active Agent Count
                    $ActiveAgent = "SELECT total_no_agents,Citywise FROM lead_allocation_table WHERE Citywise='".$leadidentifier."'";
                    $AgentResult = $obj->fun_db_query($ActiveAgent);
                    $Agentrow = $obj->fun_db_fetch_rs_object($AgentResult);
                    $ActiveAgent = $Agentrow->total_no_agents;
                    ?>
                    <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                        <tr>
                            <td colspan="11"><strong><? echo $start + 1; ?> to <? echo $resCount; ?> 
                                    Out of <? echo $resCount; ?> Records </strong> &nbsp;&nbsp;&nbsp;&nbsp; <div style="float:right; padding-right: 20px;"><span style="color:#00cc66; font-weight: bold;" id="AgentValue"><?php echo $ActiveAgent; ?></span> <span style="color:#00cc66; font-weight: bold;" >Agents Active</span></div></td>
                        </tr>
                        <tr>
                            <td class="head1">Agent ID</td>
                            <td class="head1">Email</td>
                            <td class="head1">Bidder_Name</td>
                            <td class="head1">Join_Date</td>
                            <td class="head1">Status</td>
                            <td class="head1">Action</td>
                        </tr>
                        <?
                        if ($resCount > 0) {
                            $color = 1;
                            while ($row = $obj->fun_db_fetch_rs_object($result)) {
                                $BidderID = $row->BidderID;
                                $status = $row->Status;
                                if ($status == 1) {
                                    $statusPrint = "<span style=\"color:green\">Active</span>";
                                    $checked = "checked";
                                } else {
                                    $statusPrint = "<span style=\"color:red\">In Active</span>";
                                    $checked = "";
                                }

                                if ($color % 2 != 0) {
                                    $colorvar = "#FFF";
                                } else {
                                    $colorvar = "#EEE";
                                }
                                ?>
                                <!--///////////////////////-->
                                <tr  bgcolor="<?php echo $colorvar; ?>">                                                      <td class="bodyarial11"><? echo $BidderID; ?></td>
                                    <td class="bodyarial11"><? echo $row->Email; ?></td>
                                    <td class="bodyarial11"><? echo $row->Bidder_Name; ?></td>
                                    <td class="bodyarial11"><? echo $row->Join_Date; ?></td>
                                    <td class="bodyarial11"><? echo $statusPrint; ?></td>
                                    <td class="bodyarial11"><input type="checkbox" name="agentStatus" id="agentStatus" <?php
                                        if ($status == 1) {
                                            echo "checked";
                                        }
                                        ?>  value="<? echo $BidderID; ?>"/></td>
                                </tr>
                                <?
                                $color++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9" class="bodyarial11" style="color:red; text-align: center;"><strong>No Record Found</strong>
                                </td> 
                            </tr>    
<?php } ?>
                        <tr>
                            <td colspan="9" class="bodyarial11" style="color:red; text-align: right; padding-right: 50px"><input type="button" id="save_value" name="save_value" value="Save" /></td> 
                        </tr> 

                    </table>
                    <br>
                    <table  border="0" cellpadding="5" cellspacing="1" align="center">
                        <tr>
                            <td style="color:#FFF;" align="center" bgcolor="#FFFFFF">
<?php //echo $pagelinks;  ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
            $('#save_value').click(function () {
                var sel = $('input[type=checkbox]:checked').map(function (_, el) {
                    return $(el).val();
                }).get();
                $GetVal = sel;
                $.ajax({
                    type: "POST",
                    url: "ajax-bfl-agents.php",
                    data: 'GetAgentID=' + $GetVal,
                    success: function (data) {
                        $("#AgentValue").html(data);
                        location.reload();
                    }
                });

            })
        </script>
    </body>
</html>